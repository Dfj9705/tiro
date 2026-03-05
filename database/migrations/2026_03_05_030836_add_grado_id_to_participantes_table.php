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
        Schema::table('participantes', function (Blueprint $table) {
            $table->foreignId('grado_id')
                ->nullable()
                ->constrained('grados')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('participantes', function (Blueprint $table) {
            $table->dropForeign(['grado_id']);
            $table->dropColumn('grado_id');
        });
    }
};
