<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class banners extends Model
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


    /**
     * Get the user who created this popup.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'id_user_create');
    }


}
