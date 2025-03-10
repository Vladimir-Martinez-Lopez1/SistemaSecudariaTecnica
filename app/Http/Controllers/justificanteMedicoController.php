<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Models\Alumno;
use App\Models\ExpedienteMedico;
use App\Models\JustificanteInasistenciaMedica;
use App\Http\Requests\UpdateJustificanteInasistenciaMedicoRequest;
use App\Http\Requests\StoreJustificanteInasistenciaMedicoRequest;


class justificanteMedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $justificantes = JustificanteInasistenciaMedica::with('expedienteMedico.alumno')->get();
        return view('justificante_inasistencia_medico.index', compact('justificantes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('justificante_inasistencia_medico.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJustificanteInasistenciaMedicoRequest $request)
    {
        try {
            DB::beginTransaction();

            $alumno = Alumno::where('matricula', $request->matricula)->firstOrFail();

            $expediente = ExpedienteMedico::where('alumno_id', $alumno->id)->firstOrFail();

            JustificanteInasistenciaMedica::create([
                'expediente_medico_id' => $expediente->id,
                'fecha' => $request->fecha,
                'modulos' => $request->modulos,
                'nombre_medico' => $request->nombre_medico,
            ]);

            DB::commit();

            return redirect()->route('justificante_inasistencia_medico.index')->with('success', 'Justificante médico registrado exitosamente.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Ocurrió un error al registrar el justificante.']);
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
    public function edit(JustificanteInasistenciaMedica $justificante_inasistencia_medico)
    {
        $justificante_inasistencia_medico->load('expedienteMedico.alumno');

        return view('justificante_inasistencia_medico.edit', [
            'justificante' => $justificante_inasistencia_medico
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJustificanteInasistenciaMedicoRequest $request, JustificanteInasistenciaMedica $justificante)
    {
        try {
            DB::beginTransaction();

            $justificante->update([
                'fecha' => $request->fecha,
                'modulos' => $request->modulos,
                'nombre_medico' => $request->nombre_medico,
            ]);

            DB::commit();

            return redirect()->route('justificante_inasistencia_medico.index')->with('success', 'Justificante actualizado con éxito.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('justificante_inasistencia_medico.index')->with('error', 'Error al actualizar el justificante.');
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
