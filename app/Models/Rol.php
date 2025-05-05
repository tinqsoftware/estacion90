<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    // Nombre de la tabla en la BD (opcional si usas convención roles)
    protected $table = 'roles';

    // Campos asignables de manera masiva
    protected $fillable = [
        'nombre',
        'descripcion',
        'created_at',
        'updated_at'
    ];

    // Relación: un rol tiene muchos usuarios
    public function usuarios()
    {
        return $this->hasMany(User::class, 'id_rol', 'id');
    }
}