<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Justi_retardo_sociale extends Model
{
    //
    public function expedienteDisciplinario(){
        return $this->belongsTo(ExpedienteDisciplinario::class);
    }
}
