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
}
