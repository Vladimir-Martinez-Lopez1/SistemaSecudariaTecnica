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
        Schema::create('alumnos', function (Blueprint $table) {
            
           
            $table->id();
            $table->integer('matricula')->unique();
            $table->string('nombre', 50);
            $table->string('apellido', 50);
            $table->string('grado', 20);
            $table->string('grupo', 50);
            $table->string('nombre_padre', 50);
            $table->timestamps();
            
        
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }
};
