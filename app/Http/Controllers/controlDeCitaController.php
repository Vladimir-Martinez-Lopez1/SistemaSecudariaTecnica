<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\storeControlDeCitasRequest;
use App\Http\Requests\UpdateCitaMedicaRequest;
use Illuminate\Routing\Controller; // Ensure the correct Controller class is imported
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
    function __construct()
    {
        $this->middleware('permission:ver-controlDeCita|crear-controlDeCita|editar-controlDeCita|mostrar-controlDeCita',['only'=>['index']]);
        $this->middleware('permission:crear-controlDeCita', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-controlDeCita', ['only' => ['edit', 'update']]);
        $this->middleware('permission:eliminar-controlDeCita', ['only' => ['destroy']]);
    }
    public function index()
    {
        // Citas médicas activas (estado = 1)
        $citas_activas = ControlCita::with('expedienteMedico.alumno')
        ->where('estado', 1)
        ->get();

        // Citas médicas inactivas (estado = 0)
        $citas_inactivas = ControlCita::with('expedienteMedico.alumno')
        ->where('estado', 0)
        ->get();

        return view('control_de_citas.index', compact('citas_activas', 'citas_inactivas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $matricula = Alumno::all();
        return view('control_de_citas.create',compact('matricula'));
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
                'estado' => 1,
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
        //dd($control_de_cita);
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
        try {
            DB::beginTransaction();

            // Buscar la cita médica por su ID
            $cita = ControlCita::findOrFail($id);

            // Cambiar el estado: si está activo (1), desactivarlo (0), y viceversa
            $cita->estado = $cita->estado == 1 ? 0 : 1;
            $cita->save();

            DB::commit();

            // Redirigir al índice con un mensaje de éxito
            return redirect()->route('control_de_citas.index')->with('success', 'Estado de la cita actualizado correctamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('control_de_citas.index')->with('error', 'Ocurrió un error al cambiar el estado de la cita.');
        }
    }
}
