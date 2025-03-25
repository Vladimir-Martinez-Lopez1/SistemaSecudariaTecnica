<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePermisoTrabSocialeRequest;
use App\Http\Requests\UpdatePermisoTrabSocialeRequest;
use App\Models\Alumno;
use App\Models\ExpedienteDisciplinario;
use App\Models\Permiso_trab_sociale;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class permisoTrabSocialeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $permisos = Permiso_trab_sociale::with('expedienteDisciplinario')->get();
        return view('permiso_trab_sociale.index', compact('permisos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $matricula = Alumno::all();
        return view('permiso_trab_sociale.create', compact('matricula'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermisoTrabSocialeRequest $request)
    {
        $data = $request->validated();
        try {
            DB::beginTransaction();

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

            // Guardar los datos en la base de datos
            Permiso_trab_sociale::create([
                'fecha_reporte' => $data['fecha_reporte'],
                'grado' => $data['grado'],
                'grupo' => $data['grupo'],
                'motivo' => $data['motivo'],
                'numero_dias' => $data['numero_dias'],
                'fecha_inicio' => $data['fecha_inicio'],
                'fecha_termino' => $data['fecha_termino'], // Usar el valor calculado
                'nombre_padre' => $data['nombre_padre'],
                'expediente_disciplinario_id' => $expediente->id,
            ]);


            DB::commit();
            return redirect()->route('permiso_trab_sociale.index')->with('success', 'Pase registado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();

            // Redirigir al usuario con un mensaje de error que incluya el motivo de la excepción
            return redirect()->back()
                ->withErrors(['error' => 'Ocurrió un error al registrar el pase: ' . $e->getMessage()])
                ->withInput(); // Mantener los datos del formulario
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, Request $request)
    {

        // Obtener el registro por su ID
        $permiso_trab_sociale = Permiso_trab_sociale::with('expedienteDisciplinario.alumno')->find($id);

        // Verificar si el registro existe
        if (!$permiso_trab_sociale) {
            return redirect()->route('permiso_trab_sociale.index')->with('error', 'El documento de suspencion no existe.');
        }
        // $matricula = $citatorio->expedienteDisciplinario->alumno->matricula;
        $nombre = $permiso_trab_sociale->expedienteDisciplinario->alumno->nombre;
        $apellido = $permiso_trab_sociale->expedienteDisciplinario->alumno->apellido;
        // Determinar si la solicitud proviene de citatorio_general
        $from_permiso_trab_sociale = $request->query('from_permiso_trab_sociale', false);
        // Pasar los datos a la vista
        return view('permiso_trab_sociale.show', compact('permiso_trab_sociale', 'from_permiso_trab_sociale', 'nombre', 'apellido'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permiso_trab_sociale $permiso_trab_sociale)
    {
        //dd($pase_salida);
        // Cargar la relación expedienteDisciplinario.alumno
        $permiso_trab_sociale->load('expedienteDisciplinario.alumno');

        // Obtener todos los alumnos para el select
        $matricula = Alumno::all();

        // Pasar el suspencion_clase y la lista de alumnos a la vista
        return view('permiso_trab_sociale.edit', [
            'permiso_trab_sociale' => $permiso_trab_sociale,
            'matricula' => $matricula,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermisoTrabSocialeRequest $request, Permiso_trab_sociale $permiso_trab_sociale)
    {
        try {
            DB::beginTransaction();

            // Calcular fecha_termino sumando numero_dias a fecha_inicio
            $fechaTermino = \Carbon\Carbon::parse($request->fecha_inicio);
            for ($i = 1; $i < $request->numero_dias; $i++) {
                $fechaTermino->addDay();
                // Si es sábado o domingo, sumar otro día
                while ($fechaTermino->isWeekend()) {
                    $fechaTermino->addDay();
                }
            }
            $fechaTermino = $fechaTermino->format('Y-m-d');

            // Actualizar el registro
            $permiso_trab_sociale->update([
                'fecha_reporte' => $request->fecha_reporte, // Cambié esto de fecha_salida a fecha_reporte
                'grado' => $request->grado,
                'grupo' => $request->grupo,
                'motivo' => $request->motivo,
                'numero_dias' => $request->numero_dias,
                'fecha_inicio' => $request->fecha_inicio,
                'fecha_termino' => $fechaTermino, // Usamos la fecha calculada
                'nombre_padre' => $request->nombre_padre,
                'solicito' => $request->solicito,
            ]);

            DB::commit();

            return redirect()->route('permiso_trab_sociale.index')->with('success', 'Permiso actualizado con éxito.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->withErrors(['error' => 'Ocurrió un error al actualizar el documento: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
