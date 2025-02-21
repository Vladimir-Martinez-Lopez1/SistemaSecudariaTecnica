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
        Schema::create('informe_saluds', function (Blueprint $table) {
            $table->id();
            $table->string('grado', 50);
            $table->string('grupo', 50);
            $table->date('fecha');
            $table->string('diagnostico', 150);
            $table->string('motivo', 150);
            $table->date('fecha_inicio');
            $table->date('fecha_final');
            $table->string('recomendaciones', 150);
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
        Schema::dropIfExists('informe_saluds');
    }
};
