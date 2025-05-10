<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reporte_incidencia extends Model
{
    //
    protected $fillable = ['grado','grupo','motivo', 'modulo','asignatura', 'nombre_profesor', 'hora_clase','observaciones', 'fecha_reporte','expediente_disciplinario_id'];

    public function expedienteDisciplinario(){
        return $this->belongsTo(ExpedienteDisciplinario::class);
    }
}
