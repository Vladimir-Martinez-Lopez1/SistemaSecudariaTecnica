<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaseSalidaTrabSocialeRequest;
use App\Http\Requests\UpdatePaseSalidaTrabSocialeRequest;
use App\Models\Alumno;
use App\Models\ExpedienteDisciplinario;
use App\Models\Pase_salida_trab_sociale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class paseSalidaTrabSocialeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:ver-paseSalidaSocial|crear-paseSalidaSocial|editar-paseSalidaSocial|mostrar-paseSalidaSocial',['only'=>['index']]);
        $this->middleware('permission:crear-paseSalidaSocial', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-paseSalidaSocial', ['only' => ['edit', 'update']]);
        $this->middleware('permission:mostrar-paseSalidaSocial', ['only' => ['show']]);
    }

    public function index()
    {
        //
        $paseTra = Pase_salida_trab_sociale::with('expedienteDisciplinario')->get();
        return view('pase_salida_trab_sociale.index',compact('paseTra'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $matricula = Alumno::all();
        return view('pase_salida_trab_sociale.create', compact('matricula'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaseSalidaTrabSocialeRequest $request)
    {
        //
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

            Pase_salida_trab_sociale::create([
                'grado' => $request->grado,
                'grupo' => $request->grupo,
                'motivo'=> $request->motivo,
                'hora_salida' => $request->hora_salida,
                'hora_regreso' => $request->hora_regreso,
                'fecha_salida' => $request->fecha_salida,
                'solicito' => $request->solicito,
                'expediente_disciplinario_id' => $expediente->id,
            ]);

            DB::commit();
            return redirect()->route('pase_salida_trab_sociale.index')->with('success', 'Pase registado exitosamente.');

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
        $pase_salida_trab_sociale = Pase_salida_trab_sociale::with('expedienteDisciplinario.alumno')->find($id);

        // Verificar si el registro existe
        if (!$pase_salida_trab_sociale) {
            return redirect()->route('pase_salida_trab_sociale.index')->with('error', 'El pase no existe.');
        }
        // $matricula = $citatorio->expedienteDisciplinario->alumno->matricula;
        $nombre = $pase_salida_trab_sociale->expedienteDisciplinario->alumno->nombre;
        $apellido = $pase_salida_trab_sociale->expedienteDisciplinario->alumno->apellido;
        // Determinar si la solicitud proviene de citatorio_general
        $from_pase_salida_trab_sociale = $request->query('from_pase_salida_trab_sociale', false);
        // Pasar los datos a la vista
        return view('pase_salida_trab_sociale.show', compact('pase_salida_trab_sociale', 'from_pase_salida_trab_sociale', 'nombre', 'apellido'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pase_salida_trab_sociale $pase_salida_trab_sociale)
    {
        //dd($pase_salida);
        // Cargar la relación expedienteDisciplinario.alumno
        $pase_salida_trab_sociale->load('expedienteDisciplinario.alumno');

        // Obtener todos los alumnos para el select
        $matricula = Alumno::all();

        // Pasar el suspencion_clase y la lista de alumnos a la vista
        return view('pase_salida_trab_sociale.edit', [
            'pase_salida_trab_sociale' => $pase_salida_trab_sociale,
            'matricula' => $matricula,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaseSalidaTrabSocialeRequest $request, Pase_salida_trab_sociale $pase_salida_trab_sociale)
    {
        try {

            DB::beginTransaction();

            // Actualizar el registro
            $pase_salida_trab_sociale->update([
                'grado' => $request->grado,
                'grupo' => $request->grupo,
                'motivo'=> $request->motivo,
                'hora_salida' => $request->hora_salida,
                'hora_regreso' => $request->hora_regreso,
                'fecha_salida' => $request->fecha_salida,
                'solicito' => $request->solicito,
            ]);

            DB::commit();

            return redirect()->route('pase_salida_trab_sociale.index')->with('success', 'Pase de salida actualizado con éxito.');
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
