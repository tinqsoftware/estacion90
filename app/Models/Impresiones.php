<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Impresiones extends Model
{
    protected $table = 'impresiones';
    
    protected $fillable = [
        'id_pedido',
        'estado',
        'fecha_generacion',
        'fecha_impresion'
    ];

    protected $casts = [
        'fecha_generacion' => 'datetime',
        'fecha_impresion' => 'datetime'
    ];

    /**
     * Relación con el modelo Pedido
     */
    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'id_pedido');
    }

}