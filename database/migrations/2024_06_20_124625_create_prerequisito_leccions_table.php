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
        Schema::create('prerequisito_leccions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('leccion_padre_id')->references('id')->on('leccions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('leccion_hijo_id')->references('id')->on('leccions')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prerequisito_leccions');
    }
};
