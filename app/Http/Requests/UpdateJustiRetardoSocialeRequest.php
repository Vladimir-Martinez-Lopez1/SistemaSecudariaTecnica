<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJustiRetardoSocialeRequest extends FormRequest
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
            'grado' => 'required|in:1,2,3', // Solo permite los grados 1, 2 o 3
            'grupo' => 'required|in:A,B,C,D,E,F', // Solo permite los grupos A, B, C, D, E, F
            'fecha_permiso' => 'required|date|before_or_equal:today', // Fecha de permiso debe ser hoy o antes
        ];
    }
}
