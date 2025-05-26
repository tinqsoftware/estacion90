<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DireccionUser extends Model
{
    protected $table = 'direccion_user';

    protected $fillable = [
    'id_user',
    'id_distrito',
    'empresa',
    'tipo_nombre',
    'lat',
    'lon',
    'direccion',
    'principal',
    'referencia',
    'created_at',
    'updated_at'
];

    // Relación: La dirección pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    // Relación: La dirección pertenece a un distrito
    public function distrito()
    {
        return $this->belongsTo(Distrito::class, 'id_distrito', 'id');
    }
}
