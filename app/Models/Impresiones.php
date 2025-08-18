<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Impresiones extends Model
{
    protected $table = 'impresiones';
    
    // Estados: 0 = ingresado, 1 = impreso
    public const ESTADO_INGRESADO = 0;
    public const ESTADO_IMPRESO = 1;

    protected $fillable = [
        'id_pedido',
        'estado',
        'fecha_generacion',
        'fecha_impresion',
        'impresora'
    ];

    protected $casts = [
        'estado' => 'integer',
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

    /**
     * Accesor opcional: etiqueta legible del estado
     */
    public function getEstadoLabelAttribute(): string
    {
        return match((int) $this->estado) {
            self::ESTADO_IMPRESO => 'Impreso',
            default => 'Ingresado',
        };
    }
}