<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ejercicio_fases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ejercicio_id')->constrained('ejercicios')->cascadeOnDelete();
            $table->string('nombre', 120);
            $table->unsignedSmallInteger('orden')->default(1);
            $table->unsignedInteger('tiempo_objetivo_seg')->nullable(); // opcional
            $table->timestamps();

            $table->unique(['ejercicio_id', 'orden']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ejercicio_fases');
    }
};
