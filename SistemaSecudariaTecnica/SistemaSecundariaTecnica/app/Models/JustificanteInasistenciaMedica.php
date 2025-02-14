<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JustificanteInasistenciaMedica extends Model
{
    use HasFactory;

    protected $fillable = ['fecha', 'modulos', 'nombre_medico', 'expediente_medico_id'];

    public function expedienteMedico(){
        return $this->belongsTo(ExpedienteMedico::class);
    }
}
