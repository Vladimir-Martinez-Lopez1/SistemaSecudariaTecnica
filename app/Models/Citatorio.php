<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Citatorio extends Model
{
    //


    protected $fillable = ['nombre_padre', 'grado','grupo', 'hora_cita', 'fecha_cita', 'expediente_disciplinario_id'];

    public function expedienteDisciplinario(){
        return $this->belongsTo(ExpedienteDisciplinario::class);
    }

}
