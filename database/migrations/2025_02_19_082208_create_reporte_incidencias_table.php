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
            $table->integer('numero_lista');
            $table->string('nombre_profesor', 50);
            $table->string('asignatura', 50);
            $table->string('motivo', 20);
            $table->time('hora_clase', precision: 0);
            $table->longText('observaciones');
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
