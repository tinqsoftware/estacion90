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
        // Obtener pedidos listos para despacho
        $pedidos = $this->getPedidosPreparados();
        
        return view('despacho.despacho', compact('pedidos'));
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
        ->where('estado', 2) // Filtrar pedidos con estado 2
        ->whereDate('created_at', Carbon::today()) // Filtrar solo pedidos de hoy
        ->orderBy('created_at', 'desc')
        ->take(10) // Limitar la cantidad para rendimiento
        ->get();
        
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
                    'nombre' => $comensal->nombre,
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
}