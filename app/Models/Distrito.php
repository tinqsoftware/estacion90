<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    // Si la convención no se cumple (la tabla se llama "distrito" en singular)
    protected $table = 'distrito';

    protected $fillable = [
        'nombre',
        'estado',
        'created_at',
        'updated_at',
    ];

    // Scope: solo distritos activos (estado = 1)
    public function scopeActivos($query)
    {
        return $query->where('estado', 1);
    }

    // Relación: Un distrito tiene muchas direcciones de usuario
    public function direcciones()
    {
        return $this->hasMany(DireccionUser::class, 'id_distrito', 'id');
    }

    // Relación: Un distrito puede ser el distrito de contacto de muchos pedidos
    public function pedidosContacto()
    {
        return $this->hasMany(Pedido::class, 'id_distrito_contacto', 'id');
    }
}
