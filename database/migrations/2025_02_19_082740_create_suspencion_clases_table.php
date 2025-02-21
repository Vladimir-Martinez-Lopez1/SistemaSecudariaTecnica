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
        Schema::create('suspencion_clases', function (Blueprint $table) {
            $table->id();
            $table->integer('numero_lista');
            $table->string('nombre_profesor', 50);
            $table->longText('motivo');
            $table->string('capitulo', 40);
            $table->string('articulo', 40);
            $table->string('fraccion', 40);
            $table->string('inciso', 40);
            $table->integer('numero_dias');
            $table->date('fecha_inicio');
            $table->foreignId('expediente_disciplinario_id')->constrained('expediente_disciplinarios')->onDelete('cascade');
            $table->timestamps();
        });
    }
 
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suspencion_clases');
    }
};
