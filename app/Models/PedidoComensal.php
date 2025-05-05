<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoComensal extends Model
{
    protected $table = 'pedido_comensales';

    protected $fillable = [
        'id_pedido',
        'nombre_comensal',
        'created_at',
        'updated_at'
    ];

    // Relación: un comensal pertenece a un pedido
    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'id_pedido', 'id');
    }

    // Relación: un comensal puede tener varios detalles
    public function detalles()
    {
        return $this->hasMany(PedidoDetalle::class, 'id_comensal', 'id');
    }
}
