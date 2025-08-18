<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('impresiones', function (Blueprint $table) {
            if (!Schema::hasColumn('impresiones', 'impresora')) {
                $table->string('impresora')->nullable()->after('fecha_impresion');
            }
        });
    }

    public function down(): void
    {
        Schema::table('impresiones', function (Blueprint $table) {
            if (Schema::hasColumn('impresiones', 'impresora')) {
                $table->dropColumn('impresora');
            }
        });
    }
};
