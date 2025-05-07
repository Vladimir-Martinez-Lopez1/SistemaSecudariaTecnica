<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReporteIncidenciaRequest;
use App\Http\Requests\UpdateReporteIncidenciaRequest;
use App\Models\Alumno;
use Illuminate\Routing\Controller; // Ensure the correct Controller class is imported
use App\Models\ExpedienteDisciplinario;
use App\Models\Reporte_incidencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class reporteIncidenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:ver-reporteIncidencia|crear-reporteIncidencia|editar-reporteIncidencia|mostrar-reporteIncidencia',['only'=>['index']]);
        $this->middleware('permission:crear-reporteIncidencia', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-reporteIncidencia', ['only' => ['edit', 'update']]);
        $this->middleware('permission:mostrar-reporteIncidencia', ['only' => ['show']]);
    }

    public function index()
    {
        //
        $reportes = Reporte_incidencia::with('expedienteDisciplinario.alumno')->get();
        return view('reporte_incidencia.index', compact('reportes'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $matricula = Alumno::all();
        return view('reporte_incidencia.create', compact('matricula'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReporteIncidenciaRequest $request)
    {
        //
        //dd($request->all());
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

            Reporte_incidencia::create([

                'grado' => $request->grado,
                'grupo' => $request->grupo,
                'motivo' => $request ->motivo,
                'modulo' => $request ->modulo,
                'asignatura' => $request ->asignatura,
                'nombre_profesor' => $request ->nombre_profesor,
                'hora_clase' => $request->hora_clase,
                'observaciones' => $request ->observaciones,
                'fecha_reporte' => $request->fecha_reporte,
                'expediente_disciplinario_id' => $expediente->id,
            ]);

            DB::commit();
            return redirect()->route('reporte_incidencia.index')->with('success', 'Reporte registado exitosamente.');

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
    public function show(string $id, Request $request)
    {

        // Obtener el registro por su ID
        $reporte_incidencia = Reporte_incidencia::with('expedienteDisciplinario.alumno')->find($id);

        // Verificar si el registro existe
        if (!$reporte_incidencia) {
            return redirect()->route('reporte_incidencia.index')->with('error', 'El reporte no existe.');
        }
        // $matricula = $citatorio->expedienteDisciplinario->alumno->matricula;
        $nombre = $reporte_incidencia->expedienteDisciplinario->alumno->nombre;
        $apellido = $reporte_incidencia->expedienteDisciplinario->alumno->apellido;
        // Determinar si la solicitud proviene de citatorio_general
        $from_reporte_incidencium = $request->query('from_reporte_incidencium', false);
        // Pasar los datos a la vista
        return view('reporte_incidencia.show', compact('reporte_incidencia', 'from_reporte_incidencium', 'nombre', 'apellido'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reporte_incidencia $reporte_incidencium)
    {
        //dd($reporte_incidencium);
        // Cargar la relación expedienteDisciplinario.alumno
        $reporte_incidencium->load('expedienteDisciplinario.alumno');

        // Obtener todos los alumnos para el select
        $matricula = Alumno::all();

        // Pasar el suspencion_clase y la lista de alumnos a la vista
        return view('reporte_incidencia.edit', [
            'reporte_incidencium' => $reporte_incidencium,
            'matricula' => $matricula,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReporteIncidenciaRequest $request, Reporte_incidencia $reporte_incidencium)
    {
        //dd($request);
        try {


            DB::beginTransaction();

            // Actualizar el registro
            $reporte_incidencium->update([
                'grado' => $request->grado,
                'grupo' => $request->grupo,
                'motivo' => $request ->motivo,
                'modulo' => $request ->modulo,
                'asignatura' => $request ->asignatura,
                'nombre_profesor' => $request ->nombre_profesor,
                'hora_clase' => $request->hora_clase,
                'observaciones' => $request ->observaciones,
                'fecha_reporte' => $request->fecha_reporte,
            ]);

            DB::commit();

            return redirect()->route('reporte_incidencia.index')->with('success', 'Reporte actualizado con éxito.');
        } catch (\Exception $e) {
            DB::rollBack();

            // Redirigir al usuario con un mensaje de error que incluya el motivo de la excepción
            return redirect()->back()
                ->withErrors(['error' => 'Ocurrió un error al actualizar el documento: ' . $e->getMessage()])
                ->withInput(); // Mantener los datos del formulario
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
