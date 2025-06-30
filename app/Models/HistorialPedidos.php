<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialPedidos extends Model
{
     protected $table = 'historial_estado_pedidos';

    protected $fillable = [
        'id_pedido',
        'estado',
        'id_user',
        'created_at',
        'updated_at'
    ];

    // Relación: un historial de pedidos pertenece a un pedido
    public function pedido()

    {
        return $this->belongsTo(Pedido::class, 'id_pedido', 'id');
    }

    // Relación: un historial de pedidos pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

}
