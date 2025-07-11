<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuCategorias extends Model
{
    protected $table = 'menu_categorias';

    protected $fillable = [
        'menu_id',
        'categoria_id',
    ];
}
