<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ControlCita extends Model
{
    use HasFactory;

    protected $fillable = ['expediente_medico_id', 'fecha', 'grado', 'grupo', 'sexo', 'diagnostico', 'observaciones','estado'];

    public function expedienteMedico(){
        return $this->belongsTo(ExpedienteMedico::class);
    }
}
