<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCitatorioGeneraleRequest;
use App\Http\Requests\UpdateCitatorioGeneralRequest;
use Illuminate\Routing\Controller; // Ensure the correct Controller class is imported
use App\Models\Citatorio_generale;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;


class citatorioGeneralClaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:ver-citatorioGeneral|crear-citatorioGeneral|editar-citatorioGeneral|mostrar-citatorioGeneral',['only'=>['index']]);
        $this->middleware('permission:crear-citatorioGeneral', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-citatorioGeneral', ['only' => ['edit', 'update']]);
        $this->middleware('permission:mostrar-citatorioGeneral', ['only' => ['show']]);
    }


    public function index()
    {
        //
        $citatorios = Citatorio_generale::get();
        //dd($citatorios);
        return view('citatorio_general.index', compact('citatorios'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('citatorio_general.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCitatorioGeneraleRequest $request)
    {
        $data = $request->validated();
        try {
            DB::beginTransaction();


            // Guardar los datos en la base de datos
        Citatorio_generale::create([
            'fecha_creacion' => $data['fecha_creacion'],
            'asignatura' => $data['asignatura'],
            'grado' => $data['grado'],
            'grupo' => $data['grupo'],
            'hora_cita' => $data['hora_cita'],
            'fecha_cita' => $data['fecha_cita'],
            'nombre_profesor' => $data['nombre_profesor'],
        ]);

            DB::commit();
            return redirect()->route('citatorio_general.index')->with('success', 'Citatorio registado exitosamente.');

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
        $citatorio = Citatorio_generale::find($id);

        // Verificar si el registro existe
        if (!$citatorio) {
            return redirect()->route('citatorio_general.index')->with('error', 'El citatorio no existe.');
        }

        // Determinar si la solicitud proviene de citatorio_general
        $fromCitatorioGeneral = $request->query('from_citatorio_general', false);
        // Pasar los datos a la vista
        return view('citatorio_general.show', compact('citatorio', 'fromCitatorioGeneral'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Citatorio_generale $citatorio_general)
    {
        //dd($citatorio_general);
        // Pasar el citatorio y la lista de alumnos a la vista
        return view('citatorio_general.edit', [
            'citatorio_general' => $citatorio_general,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCitatorioGeneralRequest $request, Citatorio_generale $citatorio_general)
    {

        try {
            DB::beginTransaction();

            $citatorio_general->update([
                'fecha_creacion' => $request->fecha_creacion,
                'asignatura' => $request->asignatura,
                'grado' => $request->grado,
                'grupo' => $request->grupo,
                'hora_cita' => $request->hora_cita,
                'fecha_cita' => $request->fecha_cita,
                'nombre_profesor' => $request->nombre_profesor,
            ]);

            DB::commit();

            return redirect()->route('citatorio_general.index')->with('success', 'Citatorio actualizado con éxito.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('citatorio_general.index')->with('error', 'Error al actualizar el citatorio.');
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
