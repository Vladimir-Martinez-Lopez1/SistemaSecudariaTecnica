<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCitatorioRequest;
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
