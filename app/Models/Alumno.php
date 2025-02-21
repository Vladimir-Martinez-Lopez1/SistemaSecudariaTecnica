<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $fillable = ['matricula', 'nombre', 'apellido', 'grado', 'grupo', 'nombre_padre'];

    public function expedienteMedico()
    {
        return $this->hasOne(ExpedienteMedico::class, 'alumno_id');
    }

    public function expedienteDisciplinario()
    {
        return $this->hasOne(ExpedienteDisciplinario::class, 'alumno_id');
    }

    public function controlesCitas()
    {
        return $this->hasMany(ControlCita::class);
    }


}
