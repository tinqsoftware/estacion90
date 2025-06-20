<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class MotoController extends Controller
{
    public function showMoto()
    {
        // Obtener el usuario motorizado actual
        $motorizadoId = Auth::id();
        
        // Obtener pedidos asignados a este motorizado
        $pedidosAsignados = $this->getPedidosAsignadosAMoto($motorizadoId);
        
        // Obtener la fecha actual formateada
        $fechaActual = Carbon::now()->locale('es')->isoFormat('dddd DD MMMM');
        
        return view('motorizado.moto', [
            'pedidos' => $pedidosAsignados, 
            'fechaActual' => $fechaActual
        ]);
    }
    
    /**
     * Obtener pedidos asignados a un motorizado específico
     * 
     * @param int $motoId ID del motorizado
     * @return array Pedidos formateados
     */
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
        ->whereIn('estado', [4, 5]) // Pedidos asignados (4) o en camino (5)
        ->whereDate('created_at', Carbon::today())
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
                'estado' => $pedido->estado,
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
                'lat' => $pedido->lat_contacto,
                'lon' => $pedido->lon_contacto,
            ];
        }
        
        return $pedidosFormateados;
    }
    
    /**
     * Marcar un pedido como "En camino"
     */
    public function marcarEnCamino(Request $request)
    {
        $pedidoId = $request->input('pedido_id');
        
        $pedido = Pedido::find($pedidoId);
        if (!$pedido || $pedido->id_user_moto != Auth::id()) {
            return response()->json(['error' => 'Pedido no encontrado o no asignado a este motorizado', 'success' => false], 404);
        }
        
        $pedido->estado = 5; // En camino
        $pedido->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Pedido marcado como en camino',
            'pedido' => $pedido
        ]);
    }
    
    /**
     * Marcar un pedido como "Entregado"
     */
    public function marcarEntregado(Request $request)
    {
        $pedidoId = $request->input('pedido_id');
        $estado = $request->input('estado', 6); // Por defecto 6 = Entregado
        $motivoNoEntrega = $request->input('motivo', '');
        
        $pedido = Pedido::find($pedidoId);
        if (!$pedido || $pedido->id_user_moto != Auth::id()) {
            return response()->json(['error' => 'Pedido no encontrado o no asignado a este motorizado', 'success' => false], 404);
        }
        
        $pedido->estado = $estado;
        
        // Para entregas correctas - procesar foto si se proporciona
        if ($estado == 6) {
            if ($request->hasFile('foto_evidencia')) {
                $pedido->ruta_evidencia = $this->processAndSaveImage($request->file('foto_evidencia'));
            }
        } 
        // Para casos de no entrega - guardar motivo en ruta_evidencia
        else if (in_array($estado, [10, 11])) {
            $pedido->ruta_evidencia = $motivoNoEntrega;
        }
        
        $pedido->save();
        
        $mensaje = 'Pedido finalizado correctamente';
        if ($estado == 6) {
            $mensaje = 'Pedido marcado como entregado';
        } elseif ($estado == 10) {
            $mensaje = 'Pedido marcado como no entregado: No se encontró';
        } elseif ($estado == 11) {
            $mensaje = 'Pedido marcado como no entregado: Cliente rechazó';
        }
        
        return response()->json([
            'success' => true,
            'message' => $mensaje,
            'pedido' => $pedido
        ]);
    }

    public function obtenerActualizaciones(Request $request)
{
    $motorizadoId = Auth::id();
    $ultimaActualizacion = $request->input('ultima_actualizacion');
    
    $pedidosDB = Pedido::with([
        'detalles.producto', 
        'detalles.comensal', 
        'comensales',
        'tipoPago',
        'comprobantePago',
        'distritoContacto'
    ])
    ->where('id_user_moto', $motorizadoId)
    ->whereIn('estado', [4, 5]) // Pedidos asignados (4) o en camino (5)
    ->whereDate('created_at', Carbon::today())
    ->orderBy('created_at', 'desc');
    
    // Si se proporciona última actualización, filtramos solo pedidos actualizados desde entonces
    if ($ultimaActualizacion) {
        $pedidosDB->where(function($query) use ($ultimaActualizacion) {
            $query->where('created_at', '>', $ultimaActualizacion)
                  ->orWhere('updated_at', '>', $ultimaActualizacion);
        });
    }
    
    $pedidos = $this->formatearPedidos($pedidosDB->get());
    
    return response()->json([
        'pedidos' => $pedidos,
        'ultima_actualizacion' => Carbon::now()->toDateTimeString()
    ]);
}



    /**
     * Procesa y guarda una imagen de evidencia de entrega
     * 
     * @param \Illuminate\Http\UploadedFile $imageFile
     * @return string|null Ruta relativa de la imagen guardada o null si falla
     */
    private function processAndSaveImage($imageFile)
    {
        if (!$imageFile) {
            return null;
        }

        try {
            // Aumentar límite de memoria para procesamiento de imágenes grandes
            ini_set('memory_limit', '512M');
            
            $targetDir = public_path('access/images/evidencias/');
            if (!file_exists($targetDir)) {
                if (!mkdir($targetDir, 0755, true)) {
                    Log::error("No se pudo crear el directorio: $targetDir");
                    return null;
                }
            }

            // Verificar si el directorio tiene permisos de escritura
            if (!is_writable($targetDir)) {
                Log::error("El directorio no tiene permisos de escritura: $targetDir");
                return null;
            }
            
            // Obtener extensión del archivo y preparar nombre
            $originalExtension = strtolower($imageFile->getClientOriginalExtension());
            $mimeType = $imageFile->getMimeType();
            
            // Manejar detectión de formato HEIC
            if ($originalExtension == 'heic' || $mimeType == 'image/heic' || $mimeType == 'image/heif') {
                Log::info("Imagen HEIC detectada: {$originalExtension}, tipo MIME: {$mimeType}");
                $saveExtension = 'jpg';
            } else {
                $saveExtension = $originalExtension;
            }
            
            $filename = time() . '_evidencia_' . uniqid() . '.' . $saveExtension;
            $imagePath = $targetDir . $filename;
            $relativePath = 'access/images/evidencias/' . $filename;

            // Procesar la imagen con Intervention Image
            $manager = new ImageManager(new Driver());
            $img = $manager->read($imageFile->getPathname());
            
            // Redimensionar la imagen manteniendo la relación de aspecto
            $img->resize(1200, 1200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            
            // Guardar la imagen con compresión según formato
            switch ($saveExtension) {
                case 'png':
                    $img->save($imagePath, 80);
                    break;
                case 'gif':
                    $img->save($imagePath);
                    break;
                default:
                    $img->save($imagePath, 85);
            }
            
            return $relativePath;
        } catch (\Exception $e) {
            Log::error("Error al procesar imagen: " . $e->getMessage());
            Log::error("Trace: " . $e->getTraceAsString());
            return null;
        }
    }
}