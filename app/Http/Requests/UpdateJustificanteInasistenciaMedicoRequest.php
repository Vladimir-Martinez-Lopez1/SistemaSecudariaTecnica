<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJustificanteInasistenciaMedicoRequest extends FormRequest
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
            'fecha' => 'required|date',
            'grado' => 'required|string|max:10',
            'grupo' => 'required|string|max:10',
            'modulos' => 'required|string|max:255',
            'nombre_medico' => 'required|string|max:255',
        ];
    }
}
