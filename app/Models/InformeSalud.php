<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InformeSalud extends Model
{
    use HasFactory;

    protected $fillable = ['grado','grupo','fecha', 'diagnostico', 'motivo', 'fecha_inicio', 'fecha_final', 'recomendaciones', 'nombre_medico', 'expediente_medico_id'];

    public function expedienteMedico(){
        return $this->belongsTo(ExpedienteMedico::class);
    }
}
