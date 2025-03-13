<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\storeExpedienteMedicoRequest;
use App\Models\Alumno;
use App\Models\ExpedienteMedico;
use App\Models\ExpedienteDisciplinario;
use App\Http\Requests\UpdateInfoExpedienteMedicoRequest;
use Exception;
use Illuminate\Support\Facades\DB;

class expedienteMedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Expedientes y alumnos
        $expedientes = ExpedienteMedico::with('alumno')->get();
        return view('expediente_medico.index', compact('expedientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('expediente_medico.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeExpedienteMedicoRequest $request)
    {
        //dd($request);
        try{
            DB::beginTransaction();
            // Alumno
            $alumno = Alumno::create($request->validated());

            // Expediente Médico asociado al alumno
            ExpedienteMedico::create([
                'alumno_id' => $alumno->id
            ]);

            // Expediente Disciplinario asociado al alumno
            ExpedienteDisciplinario::create([
                'alumno_id' => $alumno->id
            ]);
           
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }

       return redirect()->route('expedientes_medicos.index')->with('success','Registro exitoso');
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
    public function edit(ExpedienteMedico $expedientes_medico)
    {
        $expedientes_medico->load('alumno');
        // dd($expedientes_medico);
        return view('expediente_medico.edit', ['expediente' => $expedientes_medico]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInfoExpedienteMedicoRequest $request, ExpedienteMedico $expedientes_medico)
    {
        try {
            DB::beginTransaction();

            $alumno = $expedientes_medico->alumno;

            $alumno->update([
                'matricula' => $request->matricula,
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
            ]);

            DB::commit();

            return redirect()->route('expedientes_medicos.index')->with('success', 'Actualización exitosa');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('expedientes_medicos.index')->with('error', 'Error al actualizar');
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
