<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class popup extends Model
{
    protected $table = 'popup';
    protected $fillable = [
        'nombre',
        'url_imagen',
        'link',
        'veces_dia',
        'id_user_create',
        'fecha_visible',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'fecha_visible' => 'date',
        'veces_dia' => 'integer',
    ];

    /**
     * Get the user who created this popup.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'id_user_create');
    }

    /**
     * Get the daily view records for this popup.
     */
    public function viewRecords()
    {
        return $this->hasMany(popupdia::class, 'id_popup');
    }
}
