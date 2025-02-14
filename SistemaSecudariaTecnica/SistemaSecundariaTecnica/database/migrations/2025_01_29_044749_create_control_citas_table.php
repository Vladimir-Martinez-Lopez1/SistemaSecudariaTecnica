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
        Schema::create('control_citas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expediente_medico_id')->constrained('expediente_medicos')->onDelete('cascade');
            $table->date('fecha');
            $table->string('grado', 50);
            $table->string('grupo', 50);
            $table->string('sexo', 50);
            $table->string('diagnostico', 100);
            $table->string('observaciones', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('control_citas');
    }
};
