<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComprobantePago extends Model
{
    protected $table = 'comprobantepago';

    protected $fillable = [
        'nombre',
        'estado',
        'id_user_create',
        'created_at',
        'updated_at'
    ];

    // Relación: quién creó el comprobante
    public function creador()
    {
        return $this->belongsTo(User::class, 'id_user_create', 'id');
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'id_comprobantepago', 'id');
    }
}
