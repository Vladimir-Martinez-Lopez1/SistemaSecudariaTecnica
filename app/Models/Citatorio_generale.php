<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Citatorio_generale extends Model
{
    //
    protected $fillable = ['fecha_creacion', 'asignatura', 'grado', 'grupo', 'hora_cita', 'fecha_cita', 'nombre_profesor'];
}
