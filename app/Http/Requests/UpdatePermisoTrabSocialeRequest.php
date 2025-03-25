<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePermisoTrabSocialeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fecha_reporte' => 'required|date',
            'grado' => 'required|in:1,2,3', // Solo permite los grados 1, 2 o 3
            'grupo' => 'required|in:A,B,C,D,E,F', // Solo permite los grupos A, B, C, D, E, F
            'motivo' => 'required|string|max:1000',
            'numero_dias' => 'required|integer|min:1', // Número de días debe ser un entero positivo
            'fecha_inicio' => 'required|date|after_or_equal:today', // Fecha de inicio debe ser hoy o después
            'nombre_padre' => 'required|string|max:255', // Nombre del padre o tutor
        ];
    }
}
