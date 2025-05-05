<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsignacionReparto extends Model
{
    protected $table = 'asignaciones_reparto';

    protected $fillable = [
        'id_pedido',
        'id_usuario',
        'fecha_asignacion',
        'estado',
        'created_at',
        'updated_at'
    ];

    // Relación: la asignación de reparto pertenece a un pedido
    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'id_pedido', 'id');
    }

    // Relación: la asignación de reparto pertenece a un usuario (repartidor)
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }
}
