<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('citatorios', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_creacion')->default(DB::raw('CURRENT_DATE')); 
            $table->string('nombre_padre', 50);
            $table->string('grado', 50);
            $table->string('grupo', 50);
            $table->time('hora_cita');
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
        Schema::dropIfExists('citatorios');
    }
};
