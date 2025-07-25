<?php

namespace App\Http\Controllers;

use App\Models\ConfiguracionSistema;
use Illuminate\Http\Request;
use App\Models\Producto;
use Carbon\Carbon;
use App\Models\HoraLlegada;
use App\Models\TipoPago;
use App\Models\ComprobantePago;
use App\Models\Distrito;
use App\Models\DireccionUser;
use Illuminate\Support\Facades\Auth;
use App\Models\PlaneacionMenu;
use App\Models\PedidoDetalle;
use App\Models\Pedido;
use Illuminate\Support\Facades\DB;
use App\Models\PedidoComensal;
use App\Models\User;
use App\Services\HistorialEstadoService;



class PedidoController extends Controller
{


    public function store(Request $request)
{
    $data = $request->all();
    $now = now();
    $fechaHoy = $now->toDateString();
    $delivery = 1.00;
    $monto_total = 0;

    try {
        DB::beginTransaction();

        // AGRUPAR CANTIDADES POR PRODUCTO
        $productosSolicitados = [];
        foreach ($data['comensales'] as $comensal) {
            foreach ($comensal['productos'] as $producto) {
                $id = $producto['id'];
                $cantidad = $producto['cantidad'];
                $productosSolicitados[$id] = ($productosSolicitados[$id] ?? 0) + $cantidad;
            }
        }

        // VALIDAR STOCK
        foreach ($productosSolicitados as $productoId => $cantidadTotalSolicitada) {
            $planeacion = PlaneacionMenu::where('id_producto', $productoId)
                ->where('fecha_plan', $fechaHoy)
                ->first();

            $productoInfo = Producto::with('categoria')->find($productoId);
            $nombreProd = $productoInfo->nombre ?? 'Desconocido';
            $categoria = $productoInfo?->categoria?->nombre ?? 'Sin categoría';

            // Skip stock check for extras
            if (!$planeacion && isset($producto['es_extra']) && $producto['es_extra']) {
                continue;
            }

            if (!$planeacion) {
                return response()->json([
                    'error' => "No hay planificación para: {$nombreProd} ({$categoria})"
                ], 400);
            }

            $stockDisponible = $planeacion->stock_diario;
            $cantidadUsada = PedidoDetalle::where('id_producto', $productoId)
                ->whereHas('pedido', function ($q) use ($fechaHoy) {
                    $q->whereDate('fecha_programada', $fechaHoy)
                    ->where('estado', '!=', 9);
                })
                ->sum('cantidad');

            $restante = $stockDisponible - $cantidadUsada;

            if ($restante < $cantidadTotalSolicitada) {
                return response()->json([
                    'error' => "Stock insuficiente para: {$nombreProd} ({$categoria}). Solo quedan {$restante} y estás intentando pedir {$cantidadTotalSolicitada}. Ajusta tu pedido."
                ], 400);
            }
        }

        // Crear el pedido
        $pedido = new Pedido();
        $pedido->nombre_contacto = $data['nombre'];
        $pedido->telefono_contacto = $data['telefono'];
        $pedido->email_contacto = $data['email'];
        $pedido->id_distrito_contacto = $data['distrito_id'];
        $pedido->direccion_contacto = $data['direccion'];
        $pedido->referencia_contacto = $data['referencia'];
        $pedido->id_usuario = $data['user_id'] ?? null;
        $pedido->desea_comprobante = $data['desea_comprobante'] ?? 0;
        $pedido->lat_contacto = $data['lat'];
        $pedido->lon_contacto = $data['lon'];
        $pedido->id_tipopago = $data['tipo_pago'];
        $pedido->comentarios = $data['comentarios'];
        $pedido->id_comprobantepago = $data['comprobante_pago'];
        $pedido->datos_comprobante = $data['documento_comprobante'] ?? null;
        $pedido->id_horallegada = $data['hora_llegada'];
        $pedido->vuelto = $data['vuelto'] ?? null;
        $pedido->estado = '0';
        $pedido->fecha_programada = $fechaHoy;
        $pedido->hora_programada = $now->addMinutes((int)($data['minutos_llegada'] ?? 0))->format('H:i:s');
        $pedido->save();

        // Registrar el estado inicial en el historial
        HistorialEstadoService::registrarCambioEstado($pedido->id, '0', $data['user_id'] ?? null);

        foreach ($data['comensales'] as $i => $comensal) {
            $nuevoComensal = new PedidoComensal();
            $nuevoComensal->id_pedido = $pedido->id;
            $nuevoComensal->nombre_comensal = $comensal['nombre'] ?? "Comensal " . ($i + 1);
            $nuevoComensal->id_user_cliente = $comensal['user_id'] ?? null;
            $nuevoComensal->save();

            // Get customer's subtotal from the precio_final field that now includes extras
            $subtotalComensal = $comensal['precio_final'] ?? 0;
            $monto_total += $subtotalComensal;

            foreach ($comensal['productos'] as $producto) {
                // Check if it's an extra product
                $esExtra = isset($producto['es_extra']) && $producto['es_extra'];
                
                // For extras, get price directly from the product
                if ($esExtra) {
                    $extraProducto = Producto::find($producto['id']);
                    $precioUnitario = $extraProducto ? $extraProducto->precio : $producto['precio'] ?? 0;
                } else {
                    // Normal product - get price from planeacion
                    $planeacion = PlaneacionMenu::where('id_producto', $producto['id'])
                        ->where('fecha_plan', $fechaHoy)
                        ->first();
                    $precioUnitario = $planeacion?->precio ?? 0;
                }

                $detalle = new PedidoDetalle();
                $detalle->id_pedido = $pedido->id;
                $detalle->id_comensal = $nuevoComensal->id;
                $detalle->id_producto = $producto['id'];
                $detalle->cantidad = $producto['cantidad'];
                $detalle->precio = $precioUnitario;
                $detalle->estado = 0;
                $detalle->save();
            }
        }

        // Add delivery
        $monto_total += $delivery;
        $pedido->monto_total = $monto_total;
        $pedido->save();

        // APLICAR CONFIGURACIÓN DE FLUJO DESPUÉS DE CREAR EL PEDIDO
        $this->aplicarFlujoPedido($pedido->id, $data['user_id'] ?? null);

        DB::commit();

        return response()->json([
            'message' => 'Pedido registrado correctamente',
            'pedido_id' => $pedido->id
        ], 201);

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'error' => 'Error al registrar el pedido: ' . $e->getMessage()
        ], 500);
    }
}


    /**
     * Aplicar el flujo de pedido según la configuración
     */
    private function aplicarFlujoPedido($pedidoId, $userId = null)
    {
        try {
            // Obtener configuración de flujo
            $flujo = ConfiguracionSistema::obtenerFlujoPedidos();
            
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
