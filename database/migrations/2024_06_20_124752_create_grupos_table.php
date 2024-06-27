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
        Schema::create('grupos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion');
            $table->string('foto')->nullable();
            $table->timestamp('fecha_creacion');
            $table->timestamp('fecha_finalizacion')->nullable();
            $table->foreignId('nivel_id')->references('id')->on('nivels')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('profesor_id')->references('id')->on('profesors')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupos');
    }
};
