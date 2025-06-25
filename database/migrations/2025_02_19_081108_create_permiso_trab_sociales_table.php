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
        Schema::create('permiso_trab_sociales', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_reporte');
            $table->integer('grado');
            $table->string('grupo');
            $table->text('motivo');
            $table->integer('numero_dias');
            $table->date('fecha_inicio');
            $table->date('fecha_termino'); 
            $table->string('nombre_padre');        
            $table->foreignId('expediente_disciplinario_id')->constrained('expediente_disciplinarios')->onDelete('cascade');          
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permiso_trab_sociales');
    }
};
