<?php

namespace App\Http\Controllers;

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






class PedidoController extends Controller
{


    public function store(Request $request)
    {
        $data = $request->all();

        try {
            DB::beginTransaction();

            // 1. Validar stock de cada producto seleccionado
            $fechaHoy = now()->toDateString();
            foreach ($data['productos'] as $producto) {
                $planeacion = PlaneacionMenu::where('producto_id', $producto['id'])
                    ->where('fecha_plan', $fechaHoy)
                    ->first();

                if (!$planeacion) {
                    return response()->json([
                        'error' => "No hay planificación para: {$producto['nombre']} ({$producto['categoria']})"
                    ], 400);
                }

                $stockDisponible = $planeacion->stock_diario;
                $cantidadUsada = PedidoDetalle::where('producto_id', $producto['id'])
                    ->whereHas('pedido', fn ($q) => $q->whereDate('created_at', $fechaHoy)->where('estado', '!=', 'cancelado'))
                    ->sum('cantidad');

                $restante = $stockDisponible - $cantidadUsada;

                if ($restante < $producto['cantidad']) {
                    return response()->json([
                        'error' => "Stock insuficiente para: {$producto['nombre']} ({$producto['categoria']})"
                    ], 400);
                }
            }

            // 2. Crear el pedido
            $pedido = new Pedido();
            $pedido->nombre_cliente = $data['nombre'];
            $pedido->telefono = $data['telefono'];
            $pedido->email = $data['email'];
            $pedido->id_distrito = $data['distrito_id'];
            $pedido->direccion = $data['direccion'];
            $pedido->referencia = $data['referencia'];
            $pedido->lat = $data['lat'];
            $pedido->lon = $data['lon'];
            $pedido->tipo_pago_id = $data['tipo_pago'];
            $pedido->comprobante_pago_id = $data['comprobante_pago'];
            $pedido->documento_comprobante = $data['documento_comprobante'] ?? null;
            $pedido->hora_llegada_id = $data['hora_llegada'];
            $pedido->vuelto = $data['vuelto'] ?? null;
            $pedido->estado = 'pendiente';
            $pedido->save();

            // 3. Insertar comensales y sus productos
            foreach ($data['comensales'] as $i => $comensal) {
                $nuevoComensal = new PedidoComensal();
                $nuevoComensal->pedido_id = $pedido->id;
                $nuevoComensal->nombre = $comensal['nombre'] ?? "Comensal " . ($i + 1);
                $nuevoComensal->user_id = $comensal['user_id'] ?? null;
                $nuevoComensal->save();

                foreach ($comensal['productos'] as $producto) {
                    $detalle = new PedidoDetalle();
                    $detalle->pedido_id = $pedido->id;
                    $detalle->comensal_id = $nuevoComensal->id;
                    $detalle->producto_id = $producto['id'];
                    $detalle->cantidad = $producto['cantidad'];
                    $detalle->precio = $producto['precio'];
                    $detalle->save();
                }
            }

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


    function registrarPedido(array $data)
    {
        DB::beginTransaction();

        try {
            validarStockProductos($data['productos']);

            // 1. Datos generales
            $pedido = new Pedido();
            $pedido->nombre_cliente = $data['nombre'];
            $pedido->telefono = $data['telefono'];
            $pedido->email = $data['email'];
            $pedido->id_distrito = $data['distrito_id'];
            $pedido->direccion = $data['direccion'];
            $pedido->referencia = $data['referencia'];
            $pedido->lat = $data['lat'];
            $pedido->lon = $data['lon'];
            $pedido->tipo_pago_id = $data['tipo_pago'];
            $pedido->comprobante_pago_id = $data['comprobante_pago'];
            $pedido->documento_comprobante = $data['documento_comprobante'] ?? null;
            $pedido->hora_llegada_id = $data['hora_llegada'];
            $pedido->vuelto = $data['vuelto'] ?? null;
            $pedido->estado = 'pendiente';
            $pedido->save();

            // 2. Comensales y sus productos
            foreach ($data['comensales'] as $i => $comensal) {
                $pedidoComensal = new PedidoComensal();
                $pedidoComensal->pedido_id = $pedido->id;
                $pedidoComensal->nombre = $comensal['nombre'] ?? "Comensal " . ($i + 1);
                $pedidoComensal->user_id = $comensal['user_id'] ?? null;
                $pedidoComensal->save();

                foreach ($comensal['productos'] as $producto) {
                    $detalle = new PedidoDetalle();
                    $detalle->pedido_id = $pedido->id;
                    $detalle->comensal_id = $pedidoComensal->id;
                    $detalle->producto_id = $producto['id'];
                    $detalle->cantidad = $producto['cantidad'];
                    $detalle->precio = $producto['precio']; // obtenido desde planeacion_menu
                    $detalle->save();
                }
            }

            DB::commit();
            return $pedido;

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }


}
