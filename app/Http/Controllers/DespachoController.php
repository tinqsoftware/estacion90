<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\User;
use App\Models\Impresiones;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\HistorialEstadoService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        
        // Obtener los motorizados activos
    $motorizados = $this->getMotorizadosActivos();
    
    // Obtener pedidos asignados a cada motorizado
    $pedidosMotorizados = [];
    foreach ($motorizados as $motorizado) {
        $pedidosMotorizados[$motorizado->id] = $this->getPedidosAsignadosAMoto($motorizado->id);
    }
    
    return view('despacho.despacho', compact(
        'pedidos', 
        'pedidosPorAsignar', 
        'motorizados', 
        'pedidosMotorizados'
    ));
}

    /**
 * Obtener los usuarios con rol de motorizado activos
 * 
 * @return \Illuminate\Database\Eloquent\Collection
 */
private function getMotorizadosActivos()
{
    return User::where('id_rol', 3)
        ->where('estado', 1)
        ->orderBy('name')
        ->get();
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
                        $categoriaProducto = $detalle->producto && $detalle->producto->categoria ? $detalle->producto->categoria->nombre : '';
                        $precioUnitario = $detalle->precio;
                        
                        $items[] = [
                            'nombre' => $nombreProducto,
                            'categoria' => $categoriaProducto,
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
                'monto_total' => $pedido->monto_total,
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
        
        $estadoAnterior = $pedido->estado;
        $pedido->estado = $nuevoEstado;
        $pedido->save();
        
        // Registrar cambio de estado en el historial solo si cambió
        if ($estadoAnterior !== $nuevoEstado) {
            HistorialEstadoService::registrarCambioEstado($pedido->id, $nuevoEstado);
            
            // Si el nuevo estado es 2 (Listo para despacho), crear registro de impresión
            if ($nuevoEstado == 2) {
                $this->crearRegistroImpresion($pedido->id);
            }
        }
        
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
        
        $estadoAnterior = $pedido->estado;
        $pedido->id_user_moto = $motoId;
        
        if ($motoId > 0) {
            $pedido->estado = 4; // Asignado a motorizado
        } else {
            $pedido->estado = 3; // Por asignar
        }
        
        $pedido->save();
        
        // Registrar cambio de estado en el historial solo si cambió
        if ($estadoAnterior !== $pedido->estado) {
            HistorialEstadoService::registrarCambioEstado($pedido->id, $pedido->estado);
        }
        
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
        
        $estadoAnterior = $pedido->estado;
        $pedido->estado = 5; // En camino
        $pedido->save();
        
        // Registrar cambio de estado en el historial solo si cambió
        if ($estadoAnterior !== 5) {
            HistorialEstadoService::registrarCambioEstado($pedido->id, 5);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Pedido marcado como en camino',
            'pedido' => $pedido
        ]);
    }

    public function obtenerEstadoPedidos()
    {
        // Solo retornar pedidos activos en el dashboard (estados 4 y 5)
        // Los estados 6, 10, 11 se consideran finalizados y no se muestran
        $pedidosDB = Pedido::whereIn('estado', [4, 5])
            ->whereDate('created_at', Carbon::today())
            ->select('id', 'estado', 'id_user_moto', 'orden_entrega')
            ->get();
        
        return response()->json($pedidosDB);
    }


    /**
     * Generar vista de impresión para un pedido
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function imprimirPedido($id)
    {
        $pedidoDB = Pedido::with([
            'detalles.producto', 
            'detalles.comensal', 
            'comensales',
            'tipoPago',
            'comprobantePago',
            'distritoContacto'
        ])->findOrFail($id);
        
        // Formatear los datos para la vista de impresión
        $pedido = $this->formatearPedidoParaImpresion($pedidoDB);
        
        // Marcar como impreso en la tabla de impresiones
        $this->marcarComoImpreso($id);
        
        return view('despacho.imprimir-pedido', compact('pedido'));
    }

        /**
         * Crear registro en la tabla de impresiones cuando el pedido pasa a estado 2
         */
        private function crearRegistroImpresion($pedidoId)
        {
            $impresionExistente = Impresiones::where('id_pedido', $pedidoId)->first();
            if (!$impresionExistente) {
                Impresiones::create([
                    'id_pedido' => $pedidoId,
                    'estado' => Impresiones::ESTADO_INGRESADO,
                    'fecha_generacion' => Carbon::now(),
                    'fecha_impresion' => null,
                    'impresora' => null,
                ]);
            }
        }

        /**
         * Vista del panel de impresiones (solo rol 6)
         */
        public function vistaImpresiones()
        {
            if (!Auth::check() || Auth::user()->id_rol !== 6) {
                abort(403, 'No autorizado');
            }
            return view('users.users_impresion');
        }

    /**
     * Marcar una impresión como realizada por id_pedido
     *
     * @param int $pedidoId
     * @return void
     */
    private function marcarComoImpreso($pedidoId)
    {
        $impresion = Impresiones::where('id_pedido', $pedidoId)->first();
        if ($impresion && (int) $impresion->estado === Impresiones::ESTADO_INGRESADO) {
            $impresion->update([
                'estado' => Impresiones::ESTADO_IMPRESO,
                'fecha_impresion' => Carbon::now(),
            ]);
        }
    }

    /**
     * Obtener el estado de impresión de un pedido
     *
     * @param int $pedidoId
     * @return string|null
     */
    public function obtenerEstadoImpresion($pedidoId)
    {
        $impresion = Impresiones::where('id_pedido', $pedidoId)->first();
        return $impresion ? $impresion->estado : null;
    }

    /**
     * Listar todas las impresiones pendientes
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function obtenerImpresionesPendientes(Request $r)
    {
        $limit = (int) $r->query('limit', 10);

        $rows = DB::table('impresiones')
            ->where('estado', 'pendiente')
            ->orderBy('id')           // FIFO: primero en entrar, primero en salir
            ->limit($limit)
            ->get(['id', 'id_pedido', 'fecha_generacion']);

        // Solo devolvemos lo necesario
        $items = $rows->map(function ($i) {
            return [
                'id'        => $i->id, // id de la tabla impresiones
                'pedido_id' => $i->id_pedido,
                'generado'  => Carbon::parse($i->fecha_generacion)->toDateTimeString(),
                'pdf_url'   => route('despacho.imprimir', ['id' => $i->id_pedido]), // usa tu mismo imprimirPedido
            ];
        });

        return response()->json([
            'now'   => now()->toDateTimeString(),
            'count' => $items->count(),
            'items' => $items,
        ]);
    }

    /**
     * Marcar una impresión (por ID de impresiones) como impresa
     */
    public function marcarImpresionComoImpresa(Request $r, $id)
    {
        $updated = DB::table('impresiones')
            ->where('id', $id)
            ->where('estado', 'pendiente')
            ->update([
                'estado'          => 'impreso',
                'fecha_impresion' => now(),
                'updated_at'      => now(),
            ]);

        return response()->json(['ok' => (bool) $updated]);
    }

    /**
     * Preview del contenido a imprimir sin marcar como impreso
     */
    public function previewImpresion($impresionId)
    {
        $impresion = Impresiones::with('pedido.detalles.producto', 'pedido.detalles.comensal', 'pedido.comensales', 'pedido.tipoPago', 'pedido.comprobantePago', 'pedido.distritoContacto')
            ->findOrFail($impresionId);
        if (!$impresion->pedido) {
            abort(404, 'Pedido asociado no encontrado');
        }
        $pedido = $this->formatearPedidoParaImpresion($impresion->pedido);
        return view('despacho.imprimir-pedido', compact('pedido'));
    }

    /**
     * Formatear un pedido para la vista de impresión
     * 
     * @param Pedido $pedidoDB
     * @return array
     */
    private function formatearPedidoParaImpresion($pedidoDB)
    {
        // Agrupar los detalles por comensal
        $comensalesDatos = [];
        $totalPedido = 0;
        
        foreach ($pedidoDB->comensales as $comensal) {
            $items = [];
            $totalComensal = 0;
            
            // Obtener los items de este comensal
            foreach ($pedidoDB->detalles as $detalle) {
                if ($detalle->id_comensal == $comensal->id) {
                    $nombreProducto = $detalle->producto ? $detalle->producto->nombre : 'Producto no disponible';
                    $precioUnitario = $detalle->precio;
                    
                    $items[] = [
                        'nombre' => $nombreProducto,
                        'precio' => $precioUnitario,
                        'cantidad' => $detalle->cantidad,
                        'subtotal' => $precioUnitario * $detalle->cantidad
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
        $fechaPedido = Carbon::parse($pedidoDB->created_at);
        $fechaEntrega = $pedidoDB->hora_programada ? 
            Carbon::parse($pedidoDB->hora_programada) : 
            $fechaPedido->copy()->addMinutes(45);
        
        return [
            'id' => $pedidoDB->id,
            'fecha' => $fechaPedido->format('d/m/Y'),
            'hora_pedido' => $fechaPedido->format('h:i A'),
            'hora_entrega' => $fechaEntrega->format('h:i A'),
            'nombre_contacto' => $pedidoDB->nombre_contacto,
            'telefono_contacto' => $pedidoDB->telefono_contacto,
            'direccion' => $pedidoDB->direccion_contacto,
            'referencia' => $pedidoDB->referencia_contacto,
            'distrito' => $pedidoDB->distritoContacto ? $pedidoDB->distritoContacto->nombre : '',
            'metodo_pago' => $pedidoDB->tipoPago ? $pedidoDB->tipoPago->nombre : $pedidoDB->metodo_pago,
            'vuelto' => $pedidoDB->vuelto,
            'comprobante' => $pedidoDB->desea_comprobante ? 'Sí' : 'No',
            'tipo_comprobante' => $pedidoDB->comprobantePago ? $pedidoDB->comprobantePago->nombre : '',
            'documento' => $pedidoDB->datos_comprobante ? json_decode($pedidoDB->datos_comprobante)->numero_documento ?? '' : '',
            'comentarios' => $pedidoDB->comentarios,
            'estado' => $pedidoDB->estado,
            'total' => $pedidoDB->monto_total, // Usar el monto_total del pedido en lugar de calcular
            'comensales' => $comensalesDatos,
        ];
    }

}