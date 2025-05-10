<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCitatorioRequest extends FormRequest
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
            //
            'nombre_padre' => 'required|max:50',
            'grado' => 'required|in:1,2,3',
            'grupo' => 'required|in:A,B,C,D,E,F',
            'hora_cita' => 'required',
            'fecha_cita' => 'required|date',
            'nombre_profesor' => 'required|string|max:255', // Nombre del profesor es obligatorio
        ];
    }
}
