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
        Schema::create('historial_estado_pedidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pedido');
            $table->string('estado', 10);
            $table->unsignedBigInteger('id_user')->nullable();
            $table->timestamps();
            
            // Índices para mejorar performance
            $table->index('id_pedido');
            $table->index(['id_pedido', 'created_at']);
            
            // Claves foráneas
            $table->foreign('id_pedido')->references('id')->on('pedidos')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_estado_pedidos');
    }
};
