<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';

    protected $fillable = [
        'nombre',
        'precio',
        'url_imagen',
        'id_categoria',
        'created_at',
        'updated_at',
    ];

    // Relación muchos a muchos con categorías
    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'menu_categorias', 'menu_id', 'categoria_id')
                    ->withTimestamps();
    }

    // Método para obtener nombres de categorías como string
    public function getCategoriasNombresAttribute()
    {
        return $this->categorias->pluck('nombre')->implode(', ');
    }
}
