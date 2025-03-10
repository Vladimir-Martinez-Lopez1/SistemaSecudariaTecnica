<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pase_salida extends Model
{
    //
    protected $fillable = ['numero_lista', 'grado','grupo','motivo', 'hora_salida','hora_regreso', 'fecha_salida', 'solicito', 'expediente_disciplinario_id'];

    public function expedienteDisciplinario(){
        return $this->belongsTo(ExpedienteDisciplinario::class);
    }
}
