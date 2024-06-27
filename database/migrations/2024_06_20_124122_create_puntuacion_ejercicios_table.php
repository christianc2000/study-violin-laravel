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
        Schema::create('puntuacion_ejercicios', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('puntuacion_obtenida');
            $table->timestamp('fecha_registro')->nullable();
            $table->foreignId('ejercicio_id')->references('id')->on('ejercicios')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('estudiante_id')->references('id')->on('estudiantes')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('puntuacion_ejercicios');
    }
};
