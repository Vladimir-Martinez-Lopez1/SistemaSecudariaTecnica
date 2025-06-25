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
        Schema::create('reporte_incidencias', function (Blueprint $table) {
            $table->id();
            $table->string('grado', 50);
            $table->string('grupo', 50);
            $table->text('motivo');
            $table->string('modulo', 50);
            $table->string('asignatura', 50);
            $table->string('nombre_profesor', 50);
            $table->time('hora_clase');
            $table->text('observaciones');
            $table->date('fecha_reporte');
            $table->foreignId('expediente_disciplinario_id')->constrained('expediente_disciplinarios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reporte_incidencias');
    }
};
