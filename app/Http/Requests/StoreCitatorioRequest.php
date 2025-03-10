<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCitatorioRequest extends FormRequest
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
            'matricula' => 'required|exists:alumnos,matricula|integer',
            'grado' => 'required|in:1,2,3',
            'grupo' => 'required|in:A,B,C,D,E,F',
            'hora_cita' => [
                'required',
                'date_format:H:i:s', // Valida que el formato sea HH:MM:SS
                function ($attribute, $value, $fail) {
                    // Extraer la hora (HH) del valor
                    $hora = explode(':', $value)[0];
                    // Validar que la hora esté en el rango permitido
                    if (!in_array((int) $hora, [8, 9, 10, 11, 12, 13, 14, 15, 16])) {
                        $fail('La hora seleccionada no es válida.');
                    }
                },
            ],
            'fecha_cita' => 'required|date',
        ];
    }
}
