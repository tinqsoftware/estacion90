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
        ->whereIn('estado', ['0', '1', '2'])
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
        ->whereIn('estado', ['0', '1', '2'])
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
        ->whereIn('estado', ['0', '1', '2'])
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
        ->whereIn('estado', ['1', '2'])
        ->distinct()
        ->pluck('fecha_programada')
        ->map(function($date) {
            return Carbon::parse($date)->format('Y-m-d');
        })
        ->toArray();
        
    return response()->json($dates);
}
}