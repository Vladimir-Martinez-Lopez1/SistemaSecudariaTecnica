<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suspencion_clase extends Model
{
    //
    public function expedienteDisciplinario(){
        return $this->belongsTo(ExpedienteDisciplinario::class);
    }
}
