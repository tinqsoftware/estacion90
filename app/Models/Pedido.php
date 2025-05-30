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
        'referencia_contacto',
        'lat_contacto',
        'lon_contacto',
        'comentarios',
        'fecha_programada',
        'hora_programada',
        'id_tipopago',
        'vuelo',
        'id_comprobantepago',
        'id_horallegada',
        'id_distrito_contacto',
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

    // Relación: tipo de pago
    public function tipoPago()
    {
        return $this->belongsTo(TipoPago::class, 'id_tipopago', 'id');
    }

    // Relación: tipo de comprobante de pago
    public function comprobantePago()
    {
        return $this->belongsTo(ComprobantePago::class, 'id_comprobantepago', 'id');
    }

    // Relación: hora estimada de llegada
    public function horaLlegada()
    {
        return $this->belongsTo(HoraLlegada::class, 'id_horallegada', 'id');
    }

}
