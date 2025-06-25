<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReporteIncidenciaRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        //Combinar los motivos seleccionados y el campo "motivo_otro" en un solo campo
        $motivos = $this->input('motivo', []);

        // Si se seleccionó "Otro" y se proporcionó una descripción, agregarla al array de motivos
        if (in_array('Otro', $motivos) && $this->input('motivo_otro')) {
            $motivos[] = $this->input('motivo_otro');
        }

        // Eliminar la opción "Otro" del array (si está presente)
        $motivos = array_filter($motivos, function ($motivo) {
            return $motivo !== 'Otro';
        });

        // Asignar el array combinado al campo "motivo"
        $this->merge([
            'motivo' => implode(', ', $motivos), // Convertir el array en una cadena separada por comas
        ]);
    }
    public function rules(): array
    {
        return [
            //
            'grado' => 'required|in:1,2,3',
            'grupo' => 'required|in:A,B,C,D,E,F',
            'fecha_reporte' => 'required|date',
            'motivo' => 'required|max:500', // Campo combinado de motivos
            'modulo' => 'required|max:500',
            'asignatura' => 'required|max:500',
            'nombre_profesor' => 'required|max:50',
            'hora_clase' => 'required|date_format:H:i',
            'observaciones' => 'required|max:500', 
            'matricula' => 'required|exists:alumnos,matricula|integer',

        ];
    }
}
