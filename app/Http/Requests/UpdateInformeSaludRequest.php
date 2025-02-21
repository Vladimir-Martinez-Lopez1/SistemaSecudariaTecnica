<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInformeSaludRequest extends FormRequest
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
    /* 'grado' => 'required|string|max:50',
            'grupo' => 'required|string|max:50',
            'fecha' => 'required|date',
            'diagnostico' => 'required|string|max:150',
            'motivo' => 'required|string|max:150',
            'fecha_inicio' => 'required|date',
            'fecha_final' => 'required|date|after_or_equal:fecha_inicio',
            'recomendaciones' => 'nullable|string|max:150',
            'nombre_medico' => 'required|string|max:50',
            'expediente_medico_id' => 'nullable|exists:expediente_medicos,id', */
    public function rules(): array
    {
        return [
            'grado' => 'required|string|max:50',
            'grupo' => 'required|string|max:50',
            'fecha' => 'required|date',
            'diagnostico' => 'required|string|max:150',
            'motivo' => 'required|string|max:150',
            'fecha_inicio' => 'required|date',
            'fecha_final' => 'required|date|after_or_equal:fecha_inicio',
            'recomendaciones' => 'nullable|string|max:150',
            'nombre_medico' => 'required|string|max:50',
        ];
    }
}
