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
        Schema::create('practica_estudiantes', function (Blueprint $table) {
            $table->id();
            $table->boolean('completado');
            $table->string('repeticion');
            $table->timestamp('fecha_completado');
            $table->foreignId('practica_id')->references('id')->on('practicas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('estudiante_id')->references('id')->on('estudiantes')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('practica_estudiantes');
    }
};
