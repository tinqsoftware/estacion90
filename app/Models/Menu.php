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
        'created_at',
        'updated_at',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
