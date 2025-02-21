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
        Schema::create('citatorio_generales', function (Blueprint $table) {
            $table->id();
            $table->integer('numero_lista');
            $table->string('asignatura', 50);
            $table->time('hora_cita', precision: 0);
            $table->date('fecha_cita');
            $table->string('nombre_profesor', 50);
            $table->foreignId('expediente_disciplinario_id')->constrained('expediente_disciplinarios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citatorio_generales');
    }
};
