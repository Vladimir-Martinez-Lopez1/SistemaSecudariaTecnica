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
        Schema::create('justificante_inasistencia_medicas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('modulos', 50);
            $table->string('nombre_medico', 50);
            $table->foreignId('expediente_medico_id')->constrained('expediente_medicos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('justificante_inasistencia_medicas');
    }
};
