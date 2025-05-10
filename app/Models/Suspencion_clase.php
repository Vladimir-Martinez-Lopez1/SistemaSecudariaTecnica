<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suspencion_clase extends Model
{
    //
    protected $fillable = [ 'fecha_suspencion','nombre_padre','grado','grupo','motivo','capitulo','articulo','fraccion','inciso', 'numero_dias','fecha_inicio', 'fecha_termino', 'nombre_profesor','expediente_disciplinario_id'];

    public function expedienteDisciplinario(){
        return $this->belongsTo(ExpedienteDisciplinario::class);
    }
}
