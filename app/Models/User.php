<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'id_rol',
        'telefono',
        'id_direccion',
    ];
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

     // Un usuario pertenece a un Rol (roles.id -> usuarios.id_rol)
     public function rol()
     {
         return $this->belongsTo(Rol::class, 'id_rol', 'id');
     }
 
     // Un usuario (CLIENTE) puede tener muchos pedidos (pedidos.id_usuario)
     public function pedidos()
     {
         return $this->hasMany(Pedido::class, 'id_usuario', 'id');
     }
 
     // Un usuario (REPARTIDOR) puede tener muchas asignaciones (asignaciones_reparto.id_usuario)
     public function asignacionesReparto()
     {
         return $this->hasMany(AsignacionReparto::class, 'id_usuario', 'id');
     }

     public function direccion()
    {
        return $this->belongsTo(DireccionUser::class, 'id_direccion', 'id');
    }

}
