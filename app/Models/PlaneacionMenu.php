<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlaneacionMenu extends Model
{
    protected $table = 'planeacion_menu';

    protected $fillable = [
        'id_producto',
        'fecha_plan',
        'stock_diario',
        'precio',
        'created_at',
        'updated_at'
    ];

    // Relación: la planeación de menú pertenece a un producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id');
    }
}
