<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeExpedienteMedicoRequest extends FormRequest
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
            'matricula'=>'required|max:11|unique:alumnos,matricula',
            'nombre'=>'required|max:50',
            'apellido'=>'required|max:50',
            'grado'=>'required|max:20',
            'grupo'=>'required|max:50',
            'nombre_padre'=>'required|max:50',
        ];
    }
}
