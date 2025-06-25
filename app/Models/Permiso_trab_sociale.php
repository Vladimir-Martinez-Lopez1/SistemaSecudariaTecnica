<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permiso_trab_sociale extends Model
{
    //
    protected $fillable = ['fecha_reporte','grado','grupo','motivo','numero_dias','fecha_inicio','fecha_termino','nombre_padre','expediente_disciplinario_id',];
    public function expedienteDisciplinario(){
        return $this->belongsTo(ExpedienteDisciplinario::class);
    }
}