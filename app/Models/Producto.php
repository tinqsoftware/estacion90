<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

    protected $fillable = [
        'id_categoria',
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'estado',
        'id_user_create',
        'created_at',
        'updated_at'
    ];

    // Relación: un producto pertenece a una categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id');
    }

    // Relación: un producto tiene muchos registros en planeacion_menu
    public function planeacionesMenu()
    {
        return $this->hasMany(PlaneacionMenu::class, 'id_producto', 'id');
    }

    // Relación: un producto puede estar en muchos detalles de pedido
    public function pedidoDetalles()
    {
        return $this->hasMany(PedidoDetalle::class, 'id_producto', 'id');
    }

    public function creador()
    {
        return $this->belongsTo(User::class, 'id_user_create', 'id');
    }

    
}
