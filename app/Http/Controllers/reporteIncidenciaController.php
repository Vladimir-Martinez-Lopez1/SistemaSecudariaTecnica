<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReporteIncidenciaRequest;
use App\Models\Alumno;
use App\Models\ExpedienteDisciplinario;
use App\Models\Reporte_incidencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class reporteIncidenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
    public function update(StoreReporteIncidenciaRequest $request, string $id)
    {   
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
