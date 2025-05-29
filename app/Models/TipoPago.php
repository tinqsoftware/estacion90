<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoPago extends Model
{
    protected $table = 'tipopago';

    protected $fillable = [
        'nombre',
        'estado',
        'id_user_create',
        'created_at',
        'updated_at'
    ];

    public function creador()
    {
        return $this->belongsTo(User::class, 'id_user_create', 'id');
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'id_tipopago', 'id');
    }
}
