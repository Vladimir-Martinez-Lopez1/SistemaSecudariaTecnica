<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInfoExpedienteMedicoRequest extends FormRequest
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
        $expedienteId = $this->route('expedientes_medico')->id;

        return [
            'matricula' => 'required|max:11|unique:alumnos,matricula,' . $expedienteId,
            'nombre' => 'required|max:50',
            'apellido' => 'required|max:50',
        ];
    }
}
