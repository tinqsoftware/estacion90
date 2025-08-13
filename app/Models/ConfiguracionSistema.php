<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfiguracionSistema extends Model
{
    use HasFactory;

    protected $table = 'configuracion_sistema';
    
    protected $fillable = [
        'clave',
        'valor',
        'descripcion',
        'estado'
    ];

    public static function obtenerFlujoPedidos()
    {
        $cocina = self::where('clave', 'flujo_pedidos_cocina')->first();
        return $cocina && $cocina->valor == '1' ? 'cocina' : 'despacho';
    }

    public static function cambiarFlujoPedidos($modo)
    {
        if ($modo === 'cocina') {
            self::where('clave', 'flujo_pedidos_cocina')->update(['valor' => '1']);
            self::where('clave', 'flujo_pedidos_despacho')->update(['valor' => '0']);
        } else {
            self::where('clave', 'flujo_pedidos_cocina')->update(['valor' => '0']);
            self::where('clave', 'flujo_pedidos_despacho')->update(['valor' => '1']);
        }
    }

    public static function verificarPasswordFlujo($password)
    {
        $config = self::where('clave', 'password_flujo_pedidos')->first();
        return $config && $config->valor === $password;
    }

    /**
     * Obtener una configuración específica
     *
     * @param string $clave
     * @param string $valorPorDefecto
     * @return string
     */
    public static function obtenerConfiguracion($clave, $valorPorDefecto = '0')
    {
        $config = self::where('clave', $clave)->first();
        return $config ? $config->valor : $valorPorDefecto;
    }

    /**
     * Guardar o actualizar una configuración
     *
     * @param string $clave
     * @param string $valor
     * @param string $descripcion
     * @return void
     */
    public static function guardarConfiguracion($clave, $valor, $descripcion = null)
    {
        self::updateOrCreate(
            ['clave' => $clave],
            [
                'valor' => $valor,
                'descripcion' => $descripcion ?? ucfirst(str_replace('_', ' ', $clave)),
                'estado' => 1
            ]
        );
    }
}
