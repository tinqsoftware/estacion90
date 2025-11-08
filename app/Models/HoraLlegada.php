<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HoraLlegada extends Model
{
    protected $table = 'horallegada';

    protected $fillable = [
        'valor',
        'inicio_rango',
        'fin_rango',
        'tipo',            // 'hora' (minutos) | 'rango' (HH:MM - HH:MM)
        'estado',
        'id_user_create',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'inicio_rango' => 'string',
        'fin_rango'    => 'string',
    ];


    public function creador()
    {
        return $this->belongsTo(User::class, 'id_user_create', 'id');
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'id_horallegada', 'id');
    }
}
