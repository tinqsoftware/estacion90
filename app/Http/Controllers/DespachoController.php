<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DespachoController extends Controller
{
    /**
     * Display the despacho view.
     *
     * @return \Illuminate\View\View
     */
     public function despacho()
    {
        // Obtener pedidos listos para despacho (estado 2)
        $pedidos = $this->getPedidosPreparados();
        
        // Obtener pedidos por asignar (estado 3)
        $pedidosPorAsignar = $this->getPedidosPorAsignar();
        
        // Obtener pedidos asignados a motos
        $pedidosMoto1 = $this->getPedidosAsignadosAMoto(1);
        $pedidosMoto2 = $this->getPedidosAsignadosAMoto(2);
    
    return view('despacho.despacho', compact('pedidos', 'pedidosPorAsignar', 'pedidosMoto1', 'pedidosMoto2'));
}

    /**
     * Display the despacho moto view.
     *
     * @return \Illuminate\View\View
     */
    public function despachoMoto()
    {
        return view('despacho.despacho_moto');
    }

    /**
     * Obtener pedidos nuevos para actualización AJAX
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function obtenerPedidosNuevos()
    {
        $pedidos = $this->getPedidosPreparados();
        return response()->json($pedidos);
    }

    /**
     * Obtener pedidos preparados y formatearlos para la vista
     *
     * @return array
     */
    private function getPedidosPreparados()
    {
        // Obtener pedidos que tienen estado 2 (listos para despacho)
        $pedidosDB = Pedido::with([
                'detalles.producto', 
                'detalles.comensal', 
                'comensales',
                'tipoPago',
                'comprobantePago',
                'distritoContacto'
            ])
            ->whereIn('estado', [2, 8]) // Filtrar pedidos con estado 2 o 8
            ->whereDate('created_at', Carbon::today()) // Filtrar solo pedidos de hoy
            ->orderBy('created_at', 'desc')
            ->take(10) // Limitar la cantidad para rendimiento
            ->get();
        
        return $this->formatearPedidos($pedidosDB);
    }

    /**
     * Obtener pedidos por asignar (estado 3)
     *
     * @return array
     */
    private function getPedidosPorAsignar()
    {
        // Obtener pedidos que tienen estado 3 (pendientes por asignar)
        $pedidosDB = Pedido::with([
            'detalles.producto', 
            'detalles.comensal', 
            'comensales',
            'tipoPago',
            'comprobantePago',
            'distritoContacto'
        ])
        ->where('estado', 3) // Filtrar pedidos con estado 3
        ->whereDate('created_at', Carbon::today()) // Filtrar solo pedidos de hoy
        ->orderBy('created_at', 'desc')
        ->get();
        
        return $this->formatearPedidos($pedidosDB);
    }
    
    /**
     * Formatear los pedidos para la vista
     * 
     * @param \Illuminate\Database\Eloquent\Collection $pedidosDB
     * @return array
     */
    private function formatearPedidos($pedidosDB)
    {
        $pedidosFormateados = [];
        
        foreach ($pedidosDB as $pedido) {
            // Agrupar los detalles por comensal
            $comensalesDatos = [];
            $totalPedido = 0;
            
            foreach ($pedido->comensales as $comensal) {
                $items = [];
                $totalComensal = 0;
                
                // Obtener los items de este comensal
                foreach ($pedido->detalles as $detalle) {
                    if ($detalle->id_comensal == $comensal->id) {
                        $nombreProducto = $detalle->producto ? $detalle->producto->nombre : 'Producto no disponible';
                        $precioUnitario = $detalle->precio;
                        
                        $items[] = [
                            'nombre' => $nombreProducto,
                            'precio' => $precioUnitario,
                            'cantidad' => $detalle->cantidad
                        ];
                        
                        $totalComensal += ($precioUnitario * $detalle->cantidad);
                    }
                }
                
                $comensalesDatos[] = [
                    'nombre' => $comensal->nombre_comensal,
                    'total' => $totalComensal,
                    'items' => $items
                ];
                
                $totalPedido += $totalComensal;
            }
            
            // Formatear la fecha para mostrar
            $fechaPedido = Carbon::parse($pedido->created_at);
            $fechaEntrega = $pedido->hora_programada ? 
                Carbon::parse($pedido->hora_programada) : 
                $fechaPedido->copy()->addMinutes(45);
            
            $pedidosFormateados[] = [
                'id' => $pedido->id,
                'fecha' => $fechaPedido->format('d M Y'),
                'hora_pedido' => $fechaPedido->format('d M h:i A'),
                'hora_entrega' => $fechaEntrega->format('d M h:i A'),
                'nombre_contacto' => $pedido->nombre_contacto,
                'telefono_contacto' => $pedido->telefono_contacto,
                'direccion' => $pedido->direccion_contacto,
                'referencia' => $pedido->referencia_contacto,
                'distrito' => $pedido->distritoContacto ? $pedido->distritoContacto->nombre : '',
                'metodo_pago' => $pedido->tipoPago ? $pedido->tipoPago->nombre : $pedido->metodo_pago,
                'vuelto' => $pedido->vuelto,
                'comprobante' => $pedido->desea_comprobante ? 'Sí' : 'No',
                'tipo_comprobante' => $pedido->comprobantePago ? $pedido->comprobantePago->nombre : '',
                'documento' => $pedido->datos_comprobante ? json_decode($pedido->datos_comprobante)->numero_documento ?? '' : '',
                'comentarios' => $pedido->comentarios,
                'total' => $totalPedido,
                'comensales' => $comensalesDatos,
            ];
        }
        
        return $pedidosFormateados;
    }

    /**
     * Actualizar el estado de un pedido
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function actualizarEstadoPedido(Request $request)
    {
        $pedidoId = $request->input('pedido_id');
        $nuevoEstado = $request->input('estado', 3);
        
        $pedido = Pedido::find($pedidoId);
        if (!$pedido) {
            return response()->json(['error' => 'Pedido no encontrado', 'success' => false], 404);
        }
        
        $pedido->estado = $nuevoEstado;
        $pedido->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Estado del pedido actualizado correctamente',
            'pedido' => $pedido
        ]);
    }

    public function asignarPedidoAMoto(Request $request)
{
    $pedidoId = $request->input('pedido_id');
    $motoId = $request->input('moto_id'); 
    
    $pedido = Pedido::find($pedidoId);
    if (!$pedido) {
        return response()->json(['error' => 'Pedido no encontrado', 'success' => false], 404);
    }
    

    $pedido->id_user_moto = $motoId;
    
    if ($motoId > 0) {
        $pedido->estado = 4; // Asignado a motorizado
    } else {
        $pedido->estado = 3; // Por asignar
    }
    
    $pedido->save();
    
    return response()->json([
        'success' => true,
        'message' => "Pedido asignado a moto $motoId correctamente",
        'pedido' => $pedido
    ]);
}

private function getPedidosAsignadosAMoto($motoId)
{
    $pedidosDB = Pedido::with([
        'detalles.producto', 
        'detalles.comensal', 
        'comensales',
        'tipoPago',
        'comprobantePago',
        'distritoContacto'
    ])
    ->where('id_user_moto', $motoId)
    ->whereIn('estado', [4, 5]) 
    ->whereDate('created_at', Carbon::today())
    ->orderBy('created_at', 'desc')
    ->get();
    
    return $this->formatearPedidos($pedidosDB);
}


public function marcarPedidoEnCamino(Request $request)
{
    $pedidoId = $request->input('pedido_id');
    
    $pedido = Pedido::find($pedidoId);
    if (!$pedido) {
        return response()->json(['error' => 'Pedido no encontrado', 'success' => false], 404);
    }
    
    $pedido->estado = 5; // En camino
    $pedido->save();
    
    return response()->json([
        'success' => true,
        'message' => 'Pedido marcado como en camino',
        'pedido' => $pedido
    ]);
}

public function obtenerEstadoPedidos()
{
    $pedidosDB = Pedido::whereIn('estado', [4, 5])
        ->whereDate('created_at', Carbon::today())
        ->select('id', 'estado', 'id_user_moto')
        ->get();
    
    return response()->json($pedidosDB);
}

}