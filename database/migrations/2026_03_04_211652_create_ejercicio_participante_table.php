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
        Schema::create('ejercicio_participante', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ejercicio_id')->constrained('ejercicios')->cascadeOnDelete();
            $table->foreignId('participante_id')->constrained('participantes');
            $table->unsignedInteger('tiempo_real_seg')->nullable(); // si el tiempo es por ejercicio
            $table->unsignedInteger('total_puntos')->default(0);
            $table->unsignedInteger('total_5x')->default(0); // para “más importancia” / desempate
            $table->timestamps();

            $table->unique(['ejercicio_id', 'participante_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ejercicio_participante');
    }
};
