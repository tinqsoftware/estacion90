<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';

    protected $fillable = [
        'nombre',
        'descripcion',
        'created_at',
        'updated_at'
    ];

    // Relación: una categoría tiene muchos productos
    public function productos()
    {
        return $this->hasMany(Producto::class, 'id_categoria', 'id');
    }

    // Relación muchos a muchos con menús
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_categorias', 'categoria_id', 'menu_id')
                    ->withTimestamps();
    }
}