<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banners extends Model
{
    protected $table = 'banners';
    
    protected $fillable = [
        'url_imagen',
        'link',
        'tipo',
        'fecha_inicio',
        'fecha_fin',
        'id_user_create',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];

    /**
     * Get the user who created this banner.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'id_user_create');
    }

    /**
     * Scope para banners activos
     */
    public function scopeActivos($query)
    {
        $hoy = now()->format('Y-m-d');
        return $query->where('fecha_inicio', '<=', $hoy)
                     ->where('fecha_fin', '>=', $hoy);
    }

    /**
     * Verificar si el banner está activo
     */
    public function getEsActivoAttribute()
    {
        $hoy = now()->format('Y-m-d');
        return $this->fecha_inicio <= $hoy && $this->fecha_fin >= $hoy;
    }

    /**
     * Obtener el estado del banner
     */
    public function getEstadoAttribute()
    {
        $hoy = now()->format('Y-m-d');
        
        if ($hoy >= $this->fecha_inicio && $hoy <= $this->fecha_fin) {
            return 'activo';
        } elseif ($hoy < $this->fecha_inicio) {
            return 'programado';
        } else {
            return 'expirado';
        }
    }
}
