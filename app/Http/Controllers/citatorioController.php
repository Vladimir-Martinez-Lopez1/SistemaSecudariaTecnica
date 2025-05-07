<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCitatorioRequest;
use App\Http\Requests\UpdateCitaMedicaRequest;
use App\Http\Requests\UpdateCitatorioRequest;
use Illuminate\Routing\Controller; // Ensure the correct Controller class is imported
use App\Models\Citatorio;
use App\Models\ExpedienteDisciplinario;
use App\Models\Alumno;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class citatorioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:ver-citatorio|crear-citatorio|editar-citatorio|mostrar-citatorio',['only'=>['index']]);
        $this->middleware('permission:crear-citatorio', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-citatorio', ['only' => ['edit', 'update']]);
        $this->middleware('permission:mostrar-citatorio', ['only' => ['show']]);
    }




    public function index()
    {
        //
        $citatorios = Citatorio::with('expedienteDisciplinario')->get();
        //dd($citatorios);
        return view('citatorio.index', compact('citatorios'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $matricula = Alumno::all();
        return view('citatorio.create', compact('matricula'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCitatorioRequest $request)
    {
        //
        //dd($request);

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

            Citatorio::create([
                'nombre_padre' => $request->nombre_padre,
                'grado' => $request->grado,
                'grupo' => $request->grupo,
                'hora_cita' => $request->hora_cita,
                'fecha_cita' => $request->fecha_cita,
                'nombre_profesor' => $request->nombre_profesor,
                'expediente_disciplinario_id' => $expediente->id,
            ]);

            DB::commit();
            return redirect()->route('citatorio.index')->with('success', 'Citatorio registado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Ocurrió un error al registrar la cita.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, Request $request)
    {

        // Obtener el registro por su ID
        $citatorio = Citatorio::with('expedienteDisciplinario.alumno')->find($id);

        // Verificar si el registro existe
        if (!$citatorio) {
            return redirect()->route('citatorio.index')->with('error', 'El citatorio no existe.');
        }
        // $matricula = $citatorio->expedienteDisciplinario->alumno->matricula;
        $nombre = $citatorio->expedienteDisciplinario->alumno->nombre;
        $apellido = $citatorio->expedienteDisciplinario->alumno->apellido;
        // Determinar si la solicitud proviene de citatorio_general
        $fromCitatorio = $request->query('from_citatorio', false);
        // Pasar los datos a la vista
        return view('citatorio.show', compact('citatorio', 'fromCitatorio', 'nombre', 'apellido'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Citatorio $citatorio)
    // {

    //     // Relación expedienteMedico y alumno
    //     $citatorio->load('expedienteDisiplinario.alumno');
    //     return view('citatorio.edit', ['citatorio' => $citatorio]);
    // }

    public function edit(Citatorio $citatorio)
    {
        // Cargar la relación expedienteDisciplinario.alumno
        $citatorio->load('expedienteDisciplinario.alumno');

        // Obtener todos los alumnos para el select
        $matricula = Alumno::all();

        // Pasar el citatorio y la lista de alumnos a la vista
        return view('citatorio.edit', [
            'citatorio' => $citatorio,
            'matricula' => $matricula,
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCitatorioRequest $request, Citatorio $citatorio)
    {
        try {
            DB::beginTransaction();

            $citatorio->update([
                'nombre_padre' => $request->nombre_padre,
                'grado' => $request->grado,
                'grupo' => $request->grupo,
                'hora_cita' => $request->hora_cita,
                'fecha_cita' => $request->fecha_cita,
                'nombre_profesor' => $request->nombre_profesor,
            ]);

            DB::commit();

            return redirect()->route('citatorio.index')->with('success', 'Citatorio actualizado con éxito.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('citatorio.index')->with('error', 'Error al actualizar el citatorio.');
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
