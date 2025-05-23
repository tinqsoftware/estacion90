<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class popupdia extends Model
{
    protected $table = 'popup_dia';
    protected $fillable = [
        'id_user_cliente',
        'id_popup',
        'fecha',
        'cant_vistas',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'fecha' => 'date',
    ];

    /**
     * Get the user/client that owns this popup view record.
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_user_cliente');
    }

    /**
     * Get the popup associated with this record.
     */
    public function popup()
    {
        return $this->belongsTo(popup::class, 'id_popup');
    }
}