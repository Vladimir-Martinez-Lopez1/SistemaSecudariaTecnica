<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCitatorioGeneraleRequest extends FormRequest
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
            'fecha_creacion' => 'required|date', // Fecha de creación es obligatoria
            'asignatura' => 'required|string|max:255', // Asignatura es obligatoria
            'grado' => 'required|in:1,2,3', // Solo permite los grados 1, 2 o 3
            'grupo' => 'required|in:A,B,C,D,E,F', // Solo permite los grupos A, B, C, D, E, F
            'hora_cita' => 'required|date_format:H:i', // Hora en formato HH:MM
            'fecha_cita' => 'required|date|after_or_equal:today', // Fecha debe ser hoy o después
            'nombre_profesor' => 'required|string|max:255', // Nombre del profesor es obligatorio
        ];
    }
}
