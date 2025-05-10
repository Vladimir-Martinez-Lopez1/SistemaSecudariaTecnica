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
        Schema::create('pase_salida_trab_sociales', function (Blueprint $table) {
            $table->id();
            $table->string('grado', 50);
            $table->string('grupo', 50);
            $table->string('motivo', 50);
            $table->time('hora_salida');
            $table->time('hora_regreso');
            $table->date('fecha_salida');
            $table->string('solicito', 50);
            $table->foreignId('expediente_disciplinario_id')->constrained('expediente_disciplinarios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pase_salida_trab_sociales');
    }
};
