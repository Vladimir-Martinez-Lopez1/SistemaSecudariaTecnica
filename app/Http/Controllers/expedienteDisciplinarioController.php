<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExpedienteDisciplinarioRequest;
use App\Http\Requests\UpdateExpedienteDisciplinarioRequest;
use App\Models\Alumno;
use App\Models\ExpedienteDisciplinario;
use App\Models\ExpedienteMedico;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class expedienteDisciplinarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    function __construct()
    {
        $this->middleware('permission:ver-expedienteDisciplinario|crear-expedienteDisciplinario|editar-expedienteDisciplinario|mostrar-expedienteDisciplinario',['only'=>['index']]);
        $this->middleware('permission:crear-expedienteDisciplinario', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-expedienteDisciplinario', ['only' => ['edit', 'update']]);
        $this->middleware('permission:mostrar-expedienteDisciplinario', ['only' => ['show']]);
    }
    public function index()
    {
        $expedientes = ExpedienteDisciplinario::with('alumno')->get();
        return view('expediente_disciplinario.index', compact('expedientes'));

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $matricula = Alumno::all();
        return view('expediente_disciplinario.create', compact('matricula'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpedienteDisciplinarioRequest $request)
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

       return redirect()->route('expediente_disciplinario.index')->with('success','Registro exitoso');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Obtener el expediente disciplinario con sus relaciones
        $expediente = ExpedienteDisciplinario::with(['alumno', 'Citatorio', 'Justi_retardo_sociale', 'Pase_salida', 'Pase_salida_trab_sociale', 'Permiso_trab_sociale', 'Suspencion_clase', 'Reporte_incidencia'])->findOrFail($id);

        // Pasar los datos a la vista
        return view('expediente_disciplinario.show', compact('expediente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExpedienteDisciplinario $expedienteDisciplinario)
    {
        $expedienteDisciplinario->load('alumno');
        // dd($expedientes_medico);
        return view('expediente_disciplinario.edit', ['expediente' => $expedienteDisciplinario]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExpedienteDisciplinarioRequest $request, ExpedienteDisciplinario $expedienteDisciplinario)
    {
        try {
            DB::beginTransaction();

            $alumno = $expedienteDisciplinario->alumno;

            $alumno->update([
                'matricula' => $request->matricula,
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
            ]);

            DB::commit();

            return redirect()->route('expediente_disciplinario.index')->with('success', 'Actualización exitosa');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('expediente_disciplinario.index')->with('error', 'Error al actualizar');
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
