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
        $now = now(); // Fecha y hora actual
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

            

            // 3. Insertar comensales y sus productos
            // Insertar comensales y sus productos
            foreach ($data['comensales'] as $i => $comensal) {
                $nuevoComensal = new PedidoComensal();
                $nuevoComensal->id_pedido = $pedido->id;
                $nuevoComensal->nombre_comensal = $comensal['nombre'] ?? "Comensal " . ($i + 1);
                $nuevoComensal->id_user_cliente = $comensal['user_id'] ?? null;
                $nuevoComensal->save();

                $entrada15 = null;
                $fondo15 = null;
                $entrada20 = null;
                $fondo20 = null;
                $subtotalComensal = 0;

                foreach ($comensal['productos'] as $producto) {
                    $productoInfo = Producto::with('categoria')->find($producto['id']);
                    $categoria = $productoInfo->categoria->id;

                    $planeacion = PlaneacionMenu::where('id_producto', $producto['id'])
                        ->where('fecha_plan', $fechaHoy)
                        ->first();

                    $precioUnitario = $planeacion?->precio ?? 0;

                    // Categorías para detección de menú
                    if ($categoria === 1) $entrada15 = $precioUnitario;
                    elseif ($categoria === 3) $fondo15 = $precioUnitario;
                    elseif ($categoria === 2) $entrada20 = $precioUnitario;
                    elseif ($categoria === 4) $fondo20 = $precioUnitario;
                    else {
                        $subtotalComensal += $precioUnitario * $producto['cantidad'];
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

                // Cálculo de menú
                if (($entrada15 && $fondo15)) {
                    $subtotalComensal += 15;
                } elseif (($entrada20 && $fondo20) || ($entrada20 && $fondo15) || ($entrada15 && $fondo20)) {
                    $subtotalComensal += 20;
                } elseif ($entrada15 || $fondo15) {
                    $subtotalComensal += $entrada15 ?? $fondo15;
                } elseif ($entrada20 || $fondo20) {
                    $subtotalComensal += $entrada20 ?? $fondo20;
                }

                $monto_total += $subtotalComensal;
            }

            // Agregar delivery fijo
            $monto_total += $delivery;
            $pedido->monto_total = $monto_total;
            $pedido->save();

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



}
