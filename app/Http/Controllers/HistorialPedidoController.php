<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Services\HistorialEstadoService;

class HistorialPedidoController extends Controller
{
    /**
     * Obtiene el historial completo de estados de un pedido
     *
     * @param int $pedidoId
     * @return \Illuminate\Http\JsonResponse
     */
    public function obtenerHistorial($pedidoId)
    {
        try {
            $pedido = Pedido::findOrFail($pedidoId);
            $historial = HistorialEstadoService::obtenerHistorialPedido($pedidoId);
            
            // Formatear el historial con nombres de estados
            $historialFormateado = $historial->map(function ($registro) {
                return [
                    'id' => $registro->id,
                    'estado' => $registro->estado,
                    'estado_nombre' => HistorialEstadoService::getNombreEstado($registro->estado),
                    'usuario' => $registro->usuario ? $registro->usuario->name : 'Sistema',
                    'fecha_hora' => $registro->created_at->format('Y-m-d H:i:s'),
                    'fecha_hora_formateada' => $registro->created_at->diffForHumans(),
                ];
            });
            
            return response()->json([
                'success' => true,
                'pedido_id' => $pedidoId,
                'estado_actual' => $pedido->estado,
                'estado_actual_nombre' => HistorialEstadoService::getNombreEstado($pedido->estado),
                'historial' => $historialFormateado
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener el historial: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Obtiene estadísticas de estados para un rango de fechas
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function obtenerEstadisticas(Request $request)
    {
        try {
            $fechaInicio = $request->input('fecha_inicio', now()->startOfMonth()->format('Y-m-d'));
            $fechaFin = $request->input('fecha_fin', now()->format('Y-m-d'));
            
            $estadisticas = Pedido::whereBetween('created_at', [$fechaInicio, $fechaFin])
                ->selectRaw('estado, COUNT(*) as total')
                ->groupBy('estado')
                ->get()
                ->map(function ($item) {
                    return [
                        'estado' => $item->estado,
                        'estado_nombre' => HistorialEstadoService::getNombreEstado($item->estado),
                        'total' => $item->total
                    ];
                });
            
            return response()->json([
                'success' => true,
                'fecha_inicio' => $fechaInicio,
                'fecha_fin' => $fechaFin,
                'estadisticas' => $estadisticas
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener estadísticas: ' . $e->getMessage()
            ], 500);
        }
    }
}
