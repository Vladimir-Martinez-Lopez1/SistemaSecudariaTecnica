<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\storeInformeSaludRequest;
use App\Http\Requests\UpdateInformeSaludRequest;
use Illuminate\Routing\Controller; // Ensure the correct Controller class is imported
use App\Models\ExpedienteMedico;
use App\Models\Alumno;
use App\Models\InformeSalud;
use Illuminate\Support\Facades\DB;
use Exception;

class informeSaludController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:ver-informeSalud|crear-informeSalud|editar-informeSalud|mostrar-informeSalud',['only'=>['index']]);
        $this->middleware('permission:crear-informeSalud', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-informeSalud', ['only' => ['edit', 'update']]);
        $this->middleware('permission:mostrar-informeSalud', ['only' => ['show']]);
    }

    public function index()
    {
        // Obtener los informes de salud con la información del expediente médico y el alumno
        $informes_salud = InformeSalud::with('expedienteMedico.alumno')->get();

        return view('informe_salud.index', compact('informes_salud'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('informe_salud.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeInformeSaludRequest $request)
    {
        //dd($request);
        try {
            DB::beginTransaction();

            $alumno = Alumno::where('matricula', $request->matricula)->firstOrFail();

            if (!$alumno) {
                return redirect()->back()->withErrors(['matricula' => 'No se encontró un alumno con esta matrícula.']);
            }

            $expediente = ExpedienteMedico::where('alumno_id', $alumno->id)->firstOrFail();

            if (!$expediente) {
                return redirect()->back()->withErrors(['matricula' => 'No se encontró un expediente médico para este alumno.']);
            }

            InformeSalud::create([
                'expediente_medico_id' => $expediente->id,
                'grado' => $request->grado,
                'grupo' => $request->grupo,
                'fecha' => $request->fecha,
                'diagnostico' => $request->diagnostico,
                'motivo' => $request->motivo,
                'fecha_inicio' => $request->fecha_inicio,
                'fecha_final' => $request->fecha_final,
                'recomendaciones' => $request->recomendaciones,
                'nombre_medico' => $request->nombre_medico,
            ]);

            DB::commit();

            return redirect()->route('informe_salud.index')->with('success', 'Informe de salud registrado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Ocurrió un error al registrar el informe de salud.']);
        }
    }

    /**
     * Display the specified resource.
     */
    /*public function show(string $id)
    {
        //dd($id);
        // Obtener el informe de salud con sus relaciones
        $informe_salud = InformeSalud::with('expedienteMedico.alumno')->findOrFail($id);

        // Pasar los datos a la vista
        return view('informe_salud.show', compact('informe_salud'));


    }*/
    public function show(string $id, Request $request)
    {
        // Obtener el informe de salud con sus relaciones
        $informe_salud = InformeSalud::with('expedienteMedico.alumno')->findOrFail($id);

        // Determinar si la solicitud proviene de expediente_medico
        $fromExpedienteMedico = $request->query('from_expediente_medico', false);

        // Pasar los datos a la vista
        return view('informe_salud.show', compact('informe_salud', 'fromExpedienteMedico'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InformeSalud $informe_salud)
    {
        //dd($informe_salud);
        $informe_salud->load('expedienteMedico.alumno');
        return view('informe_salud.edit', ['informe_salud' => $informe_salud]);
    }


    public function update(UpdateInformeSaludRequest $request, InformeSalud $informe_salud)
{
    try {
        DB::beginTransaction();

        // Actualizar el informe de salud
        $informe_salud->update([
            'grado' => $request->grado,
            'grupo' => $request->grupo,
            'fecha' => $request->fecha,
            'diagnostico' => $request->diagnostico,
            'motivo' => $request->motivo,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_final' => $request->fecha_final,
            'recomendaciones' => $request->recomendaciones,
            'nombre_medico' => $request->nombre_medico,
        ]);

        DB::commit();

        return redirect()->route('informe_salud.index')->with('success', 'Informe de salud actualizado exitosamente.');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->withErrors(['error' => 'Ocurrió un error al actualizar el informe de salud.']);
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }
}
