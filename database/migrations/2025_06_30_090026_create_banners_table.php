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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('url_imagen');
            $table->string('link')->nullable();
            $table->integer('tipo')->default(1);
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->unsignedBigInteger('id_user_create');
            $table->timestamps();
            
            $table->foreign('id_user_create')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
