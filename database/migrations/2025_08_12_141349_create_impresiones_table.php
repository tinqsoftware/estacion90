<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('impresiones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pedido');
            $table->enum('estado', ['pendiente', 'impreso'])->default('pendiente');
            $table->timestamp('fecha_generacion');
            $table->timestamp('fecha_impresion')->nullable();
            $table->timestamps();
            
            // Índices y restricciones
            $table->foreign('id_pedido')->references('id')->on('pedidos')->onDelete('cascade');
            $table->unique('id_pedido'); // Un pedido solo puede tener un registro de impresión
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('impresiones');
    }
};
