<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\storeControlDeCitasRequest;
use App\Http\Requests\UpdateCitaMedicaRequest;
use App\Models\ControlCita;
use App\Models\ExpedienteMedico;
use App\Models\Alumno;
use Illuminate\Support\Facades\DB;
use Exception;

class controlDeCitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Datos Citas médicas y alumno
        $control_de_citas = ControlCita::with('expedienteMedico.alumno')->get();
        return view('control_de_citas.index', compact('control_de_citas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('control_de_citas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeControlDeCitasRequest $request)
    {
        //dd($request);
        try {
            //dd($request);
            DB::beginTransaction();

            $alumno = Alumno::where('matricula', $request->matricula)->firstOrFail();

            if (!$alumno) {
                return redirect()->back()->withErrors(['matricula' => 'No se encontró un alumno con esta matrícula.']);
            }

            $expediente = ExpedienteMedico::where('alumno_id', $alumno->id)->firstOrFail();

            if (!$expediente) {
                return redirect()->back()->withErrors(['matricula' => 'No se encontró un expediente médico para este alumno.']);
            }

            ControlCita::create([
                'expediente_medico_id' => $expediente->id,
                'fecha' => $request->fecha,
                'grado' => $request->grado,
                'grupo' => $request->grupo,
                'sexo' => $request->sexo,
                'diagnostico' => $request->diagnostico,
                'observaciones' => $request->observaciones,
            ]);

            DB::commit();

            return redirect()->route('control_de_citas.index')->with('success', 'Cita médica registrada exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Ocurrió un error al registrar la cita.']);
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
    public function edit(ControlCita $control_de_cita)
    {
        // Relación expedienteMedico y alumno
        $control_de_cita->load('expedienteMedico.alumno');
        return view('control_de_citas.edit', ['control_de_cita' => $control_de_cita]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCitaMedicaRequest $request, ControlCita $control_de_cita)
    {
        try {
            DB::beginTransaction();

            $control_de_cita->update([
                'fecha' => $request->fecha,
                'grado' => $request->grado,
                'grupo' => $request->grupo,
                'sexo' => $request->sexo,
                'diagnostico' => $request->diagnostico,
                'observaciones' => $request->observaciones,
            ]);

            DB::commit();

            return redirect()->route('control_de_citas.index')->with('success', 'Cita médica actualizada con éxito.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('control_de_citas.index')->with('error', 'Error al actualizar la cita médica.');
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
