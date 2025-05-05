<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';

    protected $fillable = [
        'id_usuario',
        'estado',
        'monto_total',
        'metodo_pago',
        'desea_comprobante',
        'datos_comprobante',
        'nombre_contacto',
        'email_contacto',
        'telefono_contacto',
        'direccion_contacto',
        'fecha_programada',
        'hora_programada',
        'created_at',
        'updated_at'
    ];

    // Relación: un pedido pertenece a un usuario (puede ser null si es invitado)
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }

    // Relación: un pedido tiene muchos comensales
    public function comensales()
    {
        return $this->hasMany(PedidoComensal::class, 'id_pedido', 'id');
    }

    // Relación: un pedido tiene muchos detalles (que podrían o no estar asociados a un comensal)
    public function detalles()
    {
        return $this->hasMany(PedidoDetalle::class, 'id_pedido', 'id');
    }

    // Relación: un pedido puede tener una o varias asignaciones de reparto 
    // (según tu lógica: 1 a 1 o 1 a muchos)
    public function asignacionesReparto()
    {
        return $this->hasMany(AsignacionReparto::class, 'id_pedido', 'id');
    }

    // Relación: Obtiene el distrito de contacto
    public function distritoContacto()
    {
        return $this->belongsTo(Distrito::class, 'id_distrito_contacto', 'id');
    }

}
