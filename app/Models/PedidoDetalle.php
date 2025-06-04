<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoDetalle extends Model
{
    protected $table = 'pedido_detalles';

    protected $fillable = [
        'id_pedido',
        'id_comensal',
        'id_producto',
        'cantidad',
        'precio',
        'estado',
        'created_at',
        'updated_at'
    ];

    // Relación: el detalle pertenece a un pedido
    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'id_pedido', 'id');
    }

    // Relación: el detalle puede pertenecer a un comensal específico (opcional)
    public function comensal()
    {
        return $this->belongsTo(PedidoComensal::class, 'id_comensal', 'id');
    }

    // Relación: el detalle hace referencia a un producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id');
    }
}
