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
        Schema::create('ejercicio_participante_fase', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ejercicio_participante_id')
                ->constrained('ejercicio_participante')
                ->cascadeOnDelete();

            $table->foreignId('ejercicio_fase_id')
                ->constrained('ejercicio_fases')
                ->cascadeOnDelete();

            $table->unsignedSmallInteger('c_5x')->default(0);
            $table->unsignedSmallInteger('c_5')->default(0);
            $table->unsignedSmallInteger('c_4')->default(0);
            $table->unsignedSmallInteger('c_3')->default(0);
            $table->unsignedSmallInteger('c_2')->default(0);
            $table->unsignedSmallInteger('c_1')->default(0);

            $table->unsignedInteger('tiempo_real_seg')->nullable(); // si el tiempo es por fase
            $table->unsignedInteger('subtotal_puntos')->default(0);
            $table->unsignedInteger('subtotal_5x')->default(0);

            $table->timestamps();

            $table->unique(['ejercicio_participante_id', 'ejercicio_fase_id'], 'epf_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ejercicio_participante_fase');
    }
};
