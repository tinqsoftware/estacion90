<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CocinaController extends Controller
{
    /**
     * Display the cocina view.
     *
     * @return \Illuminate\View\View
     */
   public function index()
{
    $today = Carbon::today()->format('Y-m-d');
    
    // Get orders scheduled for today with status 0, 1 or 2
    $pedidos = Pedido::whereDate('fecha_programada', $today)
        ->whereIn('estado', ['0', '1'])
        ->with(['detalles.producto', 'comensales', 'horaLlegada'])
        ->get();
        
    return view('cocina.cocina', compact('pedidos'));
}
    
    /**
     * Get new orders via AJAX for real-time updates
     */
public function getNewOrders(Request $request)
{
    $today = Carbon::today()->format('Y-m-d');
    $lastId = $request->input('last_id', 0);
    
    $newPedidos = Pedido::whereDate('fecha_programada', $today)
        ->where('id', '>', $lastId)
        ->whereIn('estado', ['0', '1'])
        ->with(['detalles.producto', 'comensales', 'horaLlegada'])
        ->get();
        
    return response()->json($newPedidos);
}



    public function updateStatus(Request $request)
{
    try {
        $pedido = Pedido::findOrFail($request->order_id);
        $pedido->estado = $request->status;
        $pedido->save();
        
        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'error' => $e->getMessage()]);
    }
}

public function getOrdersByDate(Request $request)
{
    $date = $request->input('date', Carbon::today()->format('Y-m-d'));
    
    $pedidos = Pedido::whereDate('fecha_programada', $date)
        ->whereIn('estado', ['0', '1'])
        ->with(['detalles.producto', 'comensales', 'horaLlegada'])
        ->get();
        
    return response()->json($pedidos);
}

/**
 * Get days that have orders in a date range
 */
public function getDaysWithOrders(Request $request)
{
    $startDate = $request->input('start');
    $endDate = $request->input('end');
    
    $dates = Pedido::whereBetween('fecha_programada', [$startDate, $endDate])
        ->whereIn('estado', ['0', '1'])
        ->distinct()
        ->pluck('fecha_programada')
        ->map(function($date) {
            return Carbon::parse($date)->format('Y-m-d');
        })
        ->toArray();
        
    return response()->json($dates);
}

public function updateItemStatus(Request $request)
{
    try {
        // Get the pedido detalle record
        $detalle = \App\Models\PedidoDetalle::where('id_pedido', $request->order_id)
            ->where('id_producto', $request->product_id)
            ->first();

        if (!$detalle) {
            return response()->json([
                'success' => false, 
                'message' => 'Order item not found'
            ]);
        }

        // Update the status
        $detalle->estado = $request->status;
        $detalle->save();

        // Now recalculate the overall order status
        $pedido = Pedido::findOrFail($request->order_id);
        
        // Get all product statuses for this order
        $detalles = $pedido->detalles;
        
        // Determine order status based on product statuses
        $allFinished = true;         // All items have estado=2
        $anyInProcess = false;       // Any item has estado=1
        $anyPending = false;         // Any item has estado=0
        $anyRejected = false;        // Any item has estado=9
        $anyCompleted = false;       // Any item has estado=2
        
        foreach ($detalles as $item) {
            // Check if any item is pending (estado is 0)
            if ($item->estado == '0') {
                $anyPending = true;
                $allFinished = false;
            }
            
            // Check if any item is in process
            if ($item->estado == '1') {
                $anyInProcess = true;
                $allFinished = false;
            }
            
            // Check if any item is completed
            if ($item->estado == '2') {
                $anyCompleted = true;
            }
            
            // Check if any item is rejected
            if ($item->estado == '9') {
                $anyRejected = true;
                $allFinished = false;
            }
        }
        
        // Determine new order status
        if ($allFinished) {
            // All items are completed
            $newOrderStatus = '2';
        } else if ($anyCompleted && $anyRejected && !$anyPending && !$anyInProcess) {
            // Mix of completed and rejected items, but no pending or in-process items
            $newOrderStatus = '8';
        } else if ($anyInProcess || $anyRejected) {
            // Any item is in process OR any item is rejected (with some items still in process)
            $newOrderStatus = '1';
        } else {
            // Default - all items pending
            $newOrderStatus = '0';
        }
        
        // Only update if status changed
        if ($pedido->estado != $newOrderStatus) {
            $pedido->estado = $newOrderStatus;
            $pedido->save();
        }
        
        return response()->json([
            'success' => true,
            'new_order_status' => $newOrderStatus
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false, 
            'message' => $e->getMessage()
        ]);
    }
}
}