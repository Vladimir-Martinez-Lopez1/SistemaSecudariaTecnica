<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSuspencionClaseRequest;
use App\Models\Alumno;
use App\Models\ExpedienteDisciplinario;
use App\Models\Suspencion_clase;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class suspencioClaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $suspenciones = Suspencion_clase::with('expedienteDisciplinario')->get();
        return view('suspencion_clase.index', compact('suspenciones'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $matricula = Alumno::all();
        return view('suspencion_clase.create', compact('matricula'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSuspencionClaseRequest $request)
    {
        //dd($request);
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $alumno = Alumno::where('matricula', $request->matricula)->firstOrFail();

            if (!$alumno) {
                return redirect()->back()->withErrors(['matricula' => 'No se encontró un alumno con esta matrícula.']);
            }

            $expediente = ExpedienteDisciplinario::where('alumno_id', $alumno->id)->firstOrFail();

            if (!$expediente) {
                return redirect()->back()->withErrors(['matricula' => 'No se encontró un expediente médico para este alumno.']);
            }

            // Calcular la fecha de término
            $fechaInicio = Carbon::parse($data['fecha_inicio']);
            $fechaTermino = $fechaInicio->copy()->addDays($data['numero_dias'] - 1); // Restar 1 porque el primer día cuenta

            // Ajustar la fecha de término si cae en sábado o domingo
            if ($fechaTermino->isWeekend()) {
                $fechaTermino->next(Carbon::MONDAY); // Redondear al siguiente lunes
            }

            // Agregar la fecha de término al array de datos
            $data['fecha_termino'] = $fechaTermino->toDateString();

            // Crear el registro en la base de datos
            Suspencion_clase::create([
                'fecha_suspencion' => $data['fecha_suspencion'],
                'nombre_padre' => $data['nombre_padre'],
                'grado' => $data['grado'],
                'grupo' => $data['grupo'],
                'motivo' => $data['motivo'],
                'capitulo' => $data['capitulo'],
                'articulo' => $data['articulo'],
                'fraccion' => $data['fraccion'],
                'inciso' => $data['inciso'],
                'numero_dias' => $data['numero_dias'],
                'fecha_inicio' => $data['fecha_inicio'],
                'fecha_termino' => $data['fecha_termino'],
                'nombre_profesor' => $data['nombre_profesor'],
                'expediente_disciplinario_id' => $expediente->id,
            ]);
            DB::commit();
            return redirect()->route('suspencion_clase.index')->with('success', 'Reporte registado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();

            // Redirigir al usuario con un mensaje de error que incluya el motivo de la excepción
            return redirect()->back()
                ->withErrors(['error' => 'Ocurrió un error al registrar el reporte: ' . $e->getMessage()])
                ->withInput(); // Mantener los datos del formulario
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
