<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaseSalidaRequest;
use App\Http\Requests\UpdatePaseSalidaRequest;
use App\Models\Alumno;
use App\Models\ExpedienteDisciplinario;
use App\Models\Pase_salida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Facade;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class paseSalidaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:ver-paseSalida|crear-paseSalida|editar-paseSalida|mostrar-paseSalida',['only'=>['index']]);
        $this->middleware('permission:crear-paseSalida', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-paseSalida', ['only' => ['edit', 'update']]);
        $this->middleware('permission:mostrar-paseSalida', ['only' => ['show']]);
    }

    public function index()
    {
        //
        $pases = Pase_salida::with('expedienteDisciplinario.alumno')->get();
        return view('pase_salida.index', compact('pases'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $matricula = Alumno::all();
        return view('pase_salida.create', compact('matricula'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaseSalidaRequest $request)
    {
        //dd($request);
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

            Pase_salida::create([
                'numero_lista' => $request->numero_lista,
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
            return redirect()->route('pase_salida.index')->with('success', 'Pase registado exitosamente.');

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
        $pase_salida = Pase_salida::with('expedienteDisciplinario.alumno')->find($id);

        // Verificar si el registro existe
        if (!$pase_salida) {
            return redirect()->route('pase_salida.index')->with('error', 'El citatorio no existe.');
        }
        // $matricula = $citatorio->expedienteDisciplinario->alumno->matricula;
        $nombre = $pase_salida->expedienteDisciplinario->alumno->nombre;
        $apellido = $pase_salida->expedienteDisciplinario->alumno->apellido;
        // Determinar si la solicitud proviene de citatorio_general
        $from_pase_salida = $request->query('from_pase_salida', false);
        // Pasar los datos a la vista
        return view('pase_salida.show', compact('pase_salida', 'from_pase_salida', 'nombre', 'apellido'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pase_salida $pase_salida)
    {
        //dd($pase_salida);
        // Cargar la relación expedienteDisciplinario.alumno
        $pase_salida->load('expedienteDisciplinario.alumno');

        // Obtener todos los alumnos para el select
        $matricula = Alumno::all();

        // Pasar el suspencion_clase y la lista de alumnos a la vista
        return view('pase_salida.edit', [
            'pase_salida' => $pase_salida,
            'matricula' => $matricula,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaseSalidaRequest $request, Pase_salida $pase_salida)
    {
        try {

            DB::beginTransaction();

            // Actualizar el registro
            $pase_salida->update([
                'numero_lista' => $request->numero_lista,
                'grado' => $request->grado,
                'grupo' => $request->grupo,
                'motivo'=> $request->motivo,
                'hora_salida' => $request->hora_salida,
                'hora_regreso' => $request->hora_regreso,
                'fecha_salida' => $request->fecha_salida,
                'solicito' => $request->solicito,
            ]);

            DB::commit();

            return redirect()->route('pase_salida.index')->with('success', 'Pase de salida actualizado con éxito.');
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
