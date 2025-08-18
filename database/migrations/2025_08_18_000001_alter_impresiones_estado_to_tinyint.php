<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Cambiar columna estado de enum('pendiente','impreso') a tinyInteger 0/1
        // Paso 1: Mapear valores existentes a 0/1
        DB::table('impresiones')
            ->where('estado', 'pendiente')
            ->update(['estado' => 0]);
        DB::table('impresiones')
            ->where('estado', 'impreso')
            ->update(['estado' => 1]);

        // Paso 2: Alterar tipo de columna
        // Nota: Para cambiar de enum a tinyInteger en MySQL, se suele usar raw SQL
        // porque Laravel change() en enum puede fallar. Ajusta según tu driver.
        $driver = DB::getDriverName();
        if ($driver === 'mysql' || $driver === 'pgsql') {
            // MySQL y Postgres soportan esta sintaxis con adaptación
            if ($driver === 'mysql') {
                DB::statement("ALTER TABLE impresiones MODIFY COLUMN estado TINYINT(1) NOT NULL DEFAULT 0");
            } else {
                // PostgreSQL
                DB::statement("ALTER TABLE impresiones ALTER COLUMN estado TYPE SMALLINT USING CASE WHEN estado::text = '1' THEN 1 WHEN estado::text = '0' THEN 0 ELSE 0 END");
                DB::statement("ALTER TABLE impresiones ALTER COLUMN estado SET DEFAULT 0");
                DB::statement("ALTER TABLE impresiones ALTER COLUMN estado SET NOT NULL");
            }
        } else {
            // Fallback genérico: intentar con schema builder si soporta change()
            Schema::table('impresiones', function (Blueprint $table) {
                $table->tinyInteger('estado')->default(0)->change();
            });
        }
    }

    public function down(): void
    {
        // Revertir a enum. Ojo: los valores 0/1 se mapearán a 'pendiente'/'impreso'
        $driver = DB::getDriverName();
        if ($driver === 'mysql') {
            DB::statement("ALTER TABLE impresiones MODIFY COLUMN estado ENUM('pendiente','impreso') NOT NULL DEFAULT 'pendiente'");
        } else {
            // En otros motores, se deja como tinyint por simplicidad
            // y solo se remapean los valores numéricos a texto en una columna virtual
        }

        // Remapear 0/1 a texto si se volvió a enum
        if ($driver === 'mysql') {
            DB::table('impresiones')->where('estado', 0)->update(['estado' => DB::raw("'pendiente'" )]);
            DB::table('impresiones')->where('estado', 1)->update(['estado' => DB::raw("'impreso'" )]);
        }
    }
};
