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
        Schema::create('justi_retardo_sociales', function (Blueprint $table) {
            $table->id();
            $table->integer('numero_lista');
            $table->date('fecha_permiso');
            $table->foreignId('expediente_disciplinario_id')->constrained('expediente_disciplinarios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('justi_retardo_sociales');
    }
};
