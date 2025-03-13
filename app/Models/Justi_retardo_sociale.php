<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Justi_retardo_sociale extends Model
{
    //
    protected $fillable = ['grado','grupo','fecha_permiso','expediente_disciplinario_id',];
    public function expedienteDisciplinario(){
        return $this->belongsTo(ExpedienteDisciplinario::class);
    }
}
