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
        Schema::create('pase_salidas', function (Blueprint $table) {
            $table->id();
            $table->integer('numero_lista');
            $table->string('grado', 50);
            $table->string('grupo', 50);
            $table->string('motivo', 250);
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
        Schema::dropIfExists('pase_salidas');
    }
};
