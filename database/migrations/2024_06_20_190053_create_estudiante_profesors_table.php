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
        Schema::create('estudiante_profesors', function (Blueprint $table) {
            $table->id();
            $table->boolean('estado')->default(true);
            $table->foreignId('profesor_id')->references('id')->on('profesors')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('estudiante_id')->references('id')->on('estudiantes')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiante_profesors');
    }
};
