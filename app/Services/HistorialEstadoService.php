<?php

namespace App\Services;

use App\Models\HistorialPedidos;
use Illuminate\Support\Facades\Auth;

class HistorialEstadoService
{
    /**
     * Estados disponibles para los pedidos
     */
    const ESTADOS = [
        '0' => 'Registrado',
        '1' => 'En proceso de cocina',
        '2' => 'Listo para despacho',
        '3' => 'Por asignar motorizado',
        '4' => 'Asignado a motorizado',
        '5' => 'En camino',
        '6' => 'Entregado',
        '8' => 'Preparando despacho',
        '9' => 'Rechazado',
        '10' => 'No entregado - Cliente ausente',
        '11' => 'No entregado - Otros motivos'
    ];

    /**
     * Registra un cambio de estado en el historial
     *
     * @param int $idPedido
     * @param string $estado
     * @param int|null $idUser
     * @return HistorialPedidos
     */
    public static function registrarCambioEstado($idPedido, $estado, $idUser = null)
    {
        // Si no se proporciona un usuario, usar el usuario autenticado actual
        if ($idUser === null && Auth::check()) {
            $idUser = Auth::id();
        }

        return HistorialPedidos::create([
            'id_pedido' => $idPedido,
            'estado' => $estado,
            'id_user' => $idUser,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /**
     * Obtiene el nombre del estado
     *
     * @param string $estado
     * @return string
     */
    public static function getNombreEstado($estado)
    {
        return self::ESTADOS[$estado] ?? 'Estado desconocido';
    }

    /**
     * Obtiene todo el historial de un pedido
     *
     * @param int $idPedido
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function obtenerHistorialPedido($idPedido)
    {
        return HistorialPedidos::where('id_pedido', $idPedido)
            ->with('usuario')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Obtiene el último estado registrado de un pedido
     *
     * @param int $idPedido
     * @return HistorialPedidos|null
     */
    public static function obtenerUltimoEstado($idPedido)
    {
        return HistorialPedidos::where('id_pedido', $idPedido)
            ->orderBy('created_at', 'desc')
            ->first();
    }
}
