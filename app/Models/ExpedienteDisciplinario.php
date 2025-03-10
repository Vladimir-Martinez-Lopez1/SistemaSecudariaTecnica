<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExpedienteDisciplinario extends Model
{
    use HasFactory;

    protected $fillable = ['alumno_id'];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'alumno_id');
    }
    public function citatorios()
    {
        return $this->hasMany(Citatorio::class);
    }
    public function justi_retardo_sociales()
    {
        return $this->hasMany(Justi_retardo_sociale::class);
    }
    public function citatorio_generales()
    {
        return $this->hasMany(Citatorio_generale::class);
    }
    public function pase_salida_trab_sociales()
    {
        return $this->hasMany(Pase_salida_trab_sociale::class);
    }
    public function pase_salidas()
    {
        return $this->hasMany(Pase_salida::class);
    }
    public function persmiso_trab_sociales()
    {
        return $this->hasMany(Permiso_trab_sociale::class);
    }
    public function reporte_incidencias()
    {
        return $this->hasMany(Reporte_incidencia::class);
    }
    public function suspencion_clases()
    {
        return $this->hasMany(Reporte_incidencia::class);
    }
}
