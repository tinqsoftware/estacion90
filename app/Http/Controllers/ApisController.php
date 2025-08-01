<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\PedidoDetalle;
use App\Models\PedidoComensal;
use App\Services\HistorialEstadoService;

class ApisController extends Controller
{
    public function obtenerEstadoPedido($id)
{
    try {
        // Verificar que el pedido pertenece al usuario autenticado
        $pedido = Pedido::with(['motorizado', 'historialEstados'])
            ->where('id', $id)
            ->where(function($query) {
                $query->where('id_usuario', Auth::id())
                      ->orWhere('email_contacto', Auth::user()->email);
            })
            ->first();
        
        if (!$pedido) {
            return response()->json([
                'success' => false,
                'message' => 'Pedido no encontrado o no tienes permiso para verlo'
            ], 404);
        }
        
        // Forzamos recarga del estado desde la base de datos para asegurar datos actualizados
        $pedido = Pedido::with(['motorizado', 'historialEstados'])
            ->where('id', $id)
            ->first();
        
        // Asegurar que el estado sea entero
        $pedido->estado = (int) $pedido->estado;
        
        // Obtener tiempos de cada estado desde el historial
        $tiempos = [];
        foreach ($pedido->historialEstados as $historial) {
            $estado = $historial->estado;
            $tiempo = Carbon::parse($historial->created_at)->format('H:i');
            $tiempos["tiempo_estado_{$estado}"] = $tiempo;
        }
        
        // Agregar los tiempos al objeto de pedido
        foreach ($tiempos as $key => $valor) {
            $pedido->$key = $valor;
        }
        
        // Log para depurar
        \Illuminate\Support\Facades\Log::info('Estado actual del pedido #' . $id . ': ' . $pedido->estado);
        
        return response()->json([
            'success' => true,
            'pedido' => $pedido
        ]);
        
    } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error('Error en obtenerEstadoPedido: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Error al obtener el estado del pedido: ' . $e->getMessage()
        ], 500);
    }
}
    
    /**
     * Reordenar un pedido anterior
     */
    public function reordenarPedido(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            
            // Obtener el pedido original
            $pedidoOriginal = Pedido::with(['comensales.detalles.producto'])->findOrFail($id);
            
            // Verificar que el pedido pertenece al usuario autenticado
            if ($pedidoOriginal->id_usuario != Auth::id() && $pedidoOriginal->email_contacto != Auth::user()->email) {
                return response()->json([
                    'success' => false,
                    'message' => 'No tienes permiso para reordenar este pedido'
                ], 403);
            }
            
            // Crear el nuevo pedido con los mismos datos del original
            $nuevoPedido = new Pedido();
            $nuevoPedido->nombre_contacto = $pedidoOriginal->nombre_contacto;
            $nuevoPedido->telefono_contacto = $pedidoOriginal->telefono_contacto;
            $nuevoPedido->email_contacto = $pedidoOriginal->email_contacto;
            $nuevoPedido->id_distrito_contacto = $pedidoOriginal->id_distrito_contacto;
            $nuevoPedido->direccion_contacto = $pedidoOriginal->direccion_contacto;
            $nuevoPedido->referencia_contacto = $pedidoOriginal->referencia_contacto;
            $nuevoPedido->id_usuario = Auth::id();
            $nuevoPedido->desea_comprobante = $pedidoOriginal->desea_comprobante;
            $nuevoPedido->lat_contacto = $pedidoOriginal->lat_contacto;
            $nuevoPedido->lon_contacto = $pedidoOriginal->lon_contacto;
            $nuevoPedido->id_tipopago = $pedidoOriginal->id_tipopago;
            $nuevoPedido->comentarios = $pedidoOriginal->comentarios;
            $nuevoPedido->id_comprobantepago = $pedidoOriginal->id_comprobantepago;
            $nuevoPedido->datos_comprobante = $pedidoOriginal->datos_comprobante;
            $nuevoPedido->id_horallegada = $pedidoOriginal->id_horallegada;
            $nuevoPedido->vuelto = $pedidoOriginal->vuelto;
            $nuevoPedido->estado = '0'; // Estado inicial: Registrado
            $nuevoPedido->fecha_programada = now()->toDateString();
            $nuevoPedido->hora_programada = now()->addMinutes(45)->format('H:i:s'); // 45 minutos estimados
            $nuevoPedido->monto_total = $pedidoOriginal->monto_total;
            $nuevoPedido->save();
            
            // Registrar el estado inicial en el historial
            HistorialEstadoService::registrarCambioEstado($nuevoPedido->id, '0', Auth::id());
            
            // Duplicar los comensales y detalles
            foreach ($pedidoOriginal->comensales as $comensalOriginal) {
                $nuevoComensal = new PedidoComensal();
                $nuevoComensal->id_pedido = $nuevoPedido->id;
                $nuevoComensal->nombre_comensal = $comensalOriginal->nombre_comensal;
                $nuevoComensal->id_user_cliente = Auth::id();
                $nuevoComensal->save();
                
                foreach ($comensalOriginal->detalles as $detalleOriginal) {
                    // Verificar si el producto existe y está disponible
                    if ($detalleOriginal->producto) {
                        $detalle = new PedidoDetalle();
                        $detalle->id_pedido = $nuevoPedido->id;
                        $detalle->id_comensal = $nuevoComensal->id;
                        $detalle->id_producto = $detalleOriginal->id_producto;
                        $detalle->cantidad = $detalleOriginal->cantidad;
                        $detalle->precio = $detalleOriginal->precio;
                        $detalle->estado = 0;
                        $detalle->save();
                    }
                }
            }
            
            // Aplicar configuración de flujo
            $this->aplicarFlujoPedido($nuevoPedido->id, Auth::id());
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Pedido reordenado correctamente',
                'pedido_id' => $nuevoPedido->id
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error al reordenar el pedido: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Aplicar el flujo de pedido según la configuración
     */
    private function aplicarFlujoPedido($pedidoId, $userId = null)
    {
        try {
            // Obtener configuración de flujo (usando el mismo método del PedidoController)
            $flujo = \App\Models\ConfiguracionSistema::obtenerFlujoPedidos();
            
            if ($flujo === 'despacho') {
                $this->aplicarFlujoDespachoDirecto($pedidoId, $userId);
            } else {
                $this->aplicarFlujoCocina($pedidoId, $userId);
            }
        } catch (\Exception $e) {
            // Log del error pero no interrumpir el proceso
            \Illuminate\Support\Facades\Log::error('Error al aplicar flujo de pedido: ' . $e->getMessage());
            // Por defecto aplicar flujo normal a cocina
            $this->aplicarFlujoCocina($pedidoId, $userId);
        }
    }

    /**
     * Flujo normal: Pedido -> Cocina
     * Estados: 0 (pendiente) -> 1 (cocina)
     */
    private function aplicarFlujoCocina($pedidoId, $userId = null)
    {
        $estadoCocina = '1'; // Estado cocina
        
        // Actualizar estado del pedido
        Pedido::where('id', $pedidoId)->update(['estado' => $estadoCocina]);
        
        // Registrar en historial
        HistorialEstadoService::registrarCambioEstado($pedidoId, $estadoCocina, $userId);
    }

    /**
     * Flujo directo: Pedido -> Cocina (automático) -> Despacho
     * Estados: 0 (pendiente) -> 1 (cocina) -> 2 (despacho)
     */
    private function aplicarFlujoDespachoDirecto($pedidoId, $userId = null)
    {
        $estadoCocina = '1';   // Estado cocina
        $estadoDespacho = '2'; // Estado despacho
        
        // Primer registro: paso automático por cocina
        HistorialEstadoService::registrarCambioEstado($pedidoId, $estadoCocina, $userId);
        
        // Cambiar directamente a despacho
        Pedido::where('id', $pedidoId)->update(['estado' => $estadoDespacho]);
        
        // Segundo registro: llegada a despacho
        HistorialEstadoService::registrarCambioEstado($pedidoId, $estadoDespacho, $userId);
    }
}