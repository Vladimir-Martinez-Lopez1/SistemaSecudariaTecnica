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
            $table->string('nombre_padre', 50);
            $table->string('asignatura', 50);
            $table->string('grado', 50);
            $table->string('grupo', 50);
            $table->time('hora_cita');
            $table->date('fecha_cita');
            $table->string('nombre_profesor', 50);
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
