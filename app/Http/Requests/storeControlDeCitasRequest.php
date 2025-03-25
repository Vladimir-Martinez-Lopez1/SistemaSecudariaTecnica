<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeControlDeCitasRequest extends FormRequest
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
            'sexo' => 'required|in:Masculino,Femenino',
            'diagnostico' => 'required|string|max:100',
            'observaciones' => 'nullable|string|max:100',
            'estado' => 'nullable|integer',
        ];
    }
}
