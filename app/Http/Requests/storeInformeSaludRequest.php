<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeInformeSaludRequest extends FormRequest
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
            'matricula' => 'required|exists:alumnos,matricula|integer',
            'fecha' => 'required|date',
            'grado' => 'required|in:1,2,3',
            'grupo' => 'required|in:A,B,C,D,E,F',
            'diagnostico' => 'required|string|max:150',
            'motivo' => 'required|string|max:150',
            'fecha_inicio' => 'required|date',
            'fecha_final' => 'required|date|after_or_equal:fecha_inicio',
            'recomendaciones' => 'required|string|max:150',
            'nombre_medico' => 'required|string|max:50',
        ];
    }
}
