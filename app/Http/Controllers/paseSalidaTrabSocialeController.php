<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaseSalidaTrabSocialeRequest;
use App\Models\Alumno;
use App\Models\ExpedienteDisciplinario;
use App\Models\Pase_salida_trab_sociale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class paseSalidaTrabSocialeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $pase = Pase_salida_trab_sociale::with('expedienteDisciplinario')->get();
        return view('pase_salida_trab_sociale.index',compact('pase'));

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
