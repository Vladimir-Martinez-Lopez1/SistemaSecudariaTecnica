<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpedienteMedico extends Model
{
    use HasFactory;

    protected $fillable = ['alumno_id'];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'alumno_id');
    }

    public function informesSalud()
    {
        return $this->hasMany(InformeSalud::class);
    }

    public function justificantesInasistencia()
    {
        return $this->hasMany(JustificanteInasistenciaMedica::class);
    }

    public function controlesCitas()
    {
        return $this->hasMany(ControlCita::class);
    }
}
