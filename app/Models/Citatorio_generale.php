<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Citatorio_generale extends Model
{
    //
    public function expedienteDisciplinario(){
        return $this->belongsTo(ExpedienteDisciplinario::class);
    }
}
