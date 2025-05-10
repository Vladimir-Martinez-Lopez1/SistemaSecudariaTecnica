<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaseSalidaRequest extends FormRequest
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
            'numero_lista' => 'required|integer|min:1',
            'grado' => 'required|in:1,2,3',
            'grupo' => 'required|in:A,B,C,D,E,F',
            'motivo' => 'required',
            'hora_salida' => [
                'required',
                'date_format:H:i', // Valida el formato HH:MM
                function ($attribute, $value, $fail) {
                    // Formatear la hora para que tenga segundos (HH:MM:SS)
                    $horaFormateada = $value . ':00'; // Agregar segundos
        
                    // Asignar el valor formateado (HH:MM:SS) al campo hora_salida
                    $this->merge([$attribute => $horaFormateada]);
                },
            ],
            'hora_regreso' => [
                'required',
                'date_format:H:i', // Valida el formato HH:MM
                function ($attribute, $value, $fail) {
                    // Verificar que fecha_salida y hora_salida estén presentes
                    if (!$this->input('fecha_salida') || !$this->input('hora_salida')) {
                        $fail('La fecha y hora de salida son requeridas.');
                        return;
                    }

                    // Formatear las horas para que tengan segundos (HH:MM:SS)
                    $horaSalida = $this->input('hora_salida') . ':00'; // Agregar segundos
                    $horaRegreso = $value . ':00'; // Agregar segundos
        
                    // Combinar fecha y hora en un solo string
                    $fechaSalida = $this->input('fecha_salida');
                    $fechaHoraSalida = "$fechaSalida $horaSalida";
                    $fechaHoraRegreso = "$fechaSalida $horaRegreso";

                    // Convertir a timestamps para comparar
                    $timestampSalida = strtotime($fechaHoraSalida);
                    $timestampRegreso = strtotime($fechaHoraRegreso);

                    // Validar que la hora de regreso sea mayor que la hora de salida
                    if ($timestampRegreso <= $timestampSalida) {
                        $fail('La hora de regreso debe ser mayor que la hora de salida.');
                    }

                    // Asignar el valor formateado (HH:MM:SS) al campo hora_regreso
                    $this->merge([$attribute => $horaRegreso]);
                },
            ],
            'fecha_salida' => 'required|date',
            'solicito' => 'required|max:50',
            'matricula' => 'required|exists:alumnos,matricula|integer',
            
        ];
    }
   
}
