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

    public function Citatorio()
    {
        return $this->hasMany(Citatorio::class);
    }
    public function Citatorio_generale()
    {
        return $this->hasMany(Citatorio_generale::class);
    }
    public function Justi_retardo_sociale()
    {
        return $this->hasMany(Justi_retardo_sociale::class);
    }
    public function Pase_salida()
    {
        return $this->hasMany(Pase_salida::class);
    }
    public function Pase_salida_trab_sociale()
    {
        return $this->hasMany(Pase_salida_trab_sociale::class);
    }
    public function Permiso_trab_sociale()
    {
        return $this->hasMany(Permiso_trab_sociale::class);
    }
    public function Suspencion_clase()
    {
        return $this->hasMany(Suspencion_clase::class);
    }
    public function Reporte_incidencia()
    {
        return $this->hasMany(Reporte_incidencia::class);
    }
}
