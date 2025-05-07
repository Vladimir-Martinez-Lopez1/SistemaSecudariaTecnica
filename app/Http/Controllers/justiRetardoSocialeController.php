<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJustiRetardoSocialeRequest;
use App\Http\Requests\UpdateJustiRetardoSocialeRequest;
use App\Models\Alumno;
use App\Models\ExpedienteDisciplinario;
use App\Models\Justi_retardo_sociale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class justiRetardoSocialeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:ver-justificanteRetardoSocial|crear-justificanteRetardoSocial|editar-justificanteRetardoSocial|mostrar-justificanteRetardoSocial',['only'=>['index']]);
        $this->middleware('permission:crear-justificanteRetardoSocial', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-justificanteRetardoSocial', ['only' => ['edit', 'update']]);
        $this->middleware('permission:mostrar-justificanteRetardoSocial', ['only' => ['show']]);
    }

    public function index()
    {
        //
        $justificados = Justi_retardo_sociale::with('expedienteDisciplinario')->get();
        return view('justi_retardo_sociale.index', compact('justificados'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $matricula = Alumno::all();
        return view('justi_retardo_sociale.create', compact('matricula'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJustiRetardoSocialeRequest $request)
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

            Justi_retardo_sociale::create([

                'grado' => $request->grado,
                'grupo' => $request->grupo,
                'fecha_permiso' => $request->fecha_permiso,
                'expediente_disciplinario_id' => $expediente->id,
            ]);

            DB::commit();
            return redirect()->route('justi_retardo_sociale.index')->with('success', 'Reporte registado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();

            // Redirigir al usuario con un mensaje de error que incluya el motivo de la excepción
            return redirect()->back()
                ->withErrors(['error' => 'Ocurrió un error al registrar el reporte: ' . $e->getMessage()])
                ->withInput(); // Mantener los datos del formulario
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, Request $request)
    {

        // Obtener el registro por su ID
        $justi_retardo_sociale = Justi_retardo_sociale::with('expedienteDisciplinario.alumno')->find($id);

        // Verificar si el registro existe
        if (!$justi_retardo_sociale) {
            return redirect()->route('justi_retardo_sociale.index')->with('error', 'El documento de suspencion no existe.');
        }
        // $matricula = $citatorio->expedienteDisciplinario->alumno->matricula;
        $nombre = $justi_retardo_sociale->expedienteDisciplinario->alumno->nombre;
        $apellido = $justi_retardo_sociale->expedienteDisciplinario->alumno->apellido;
        // Determinar si la solicitud proviene de citatorio_general
        $from_justi_retardo_sociale = $request->query('from_justi_retardo_sociale', false);
        // Pasar los datos a la vista
        return view('justi_retardo_sociale.show', compact('justi_retardo_sociale', 'from_justi_retardo_sociale', 'nombre', 'apellido'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Justi_retardo_sociale $justi_retardo_sociale)
    {
        //dd($pase_salida);
        // Cargar la relación expedienteDisciplinario.alumno
        $justi_retardo_sociale->load('expedienteDisciplinario.alumno');

        // Obtener todos los alumnos para el select
        $matricula = Alumno::all();

        // Pasar el suspencion_clase y la lista de alumnos a la vista
        return view('justi_retardo_sociale.edit', [
            'justi_retardo_sociale' => $justi_retardo_sociale,
            'matricula' => $matricula,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJustiRetardoSocialeRequest $request, Justi_retardo_sociale $justi_retardo_sociale)
    {
        try {

            DB::beginTransaction();

            // Actualizar el registro
            $justi_retardo_sociale->update([
                'grado' => $request->grado,
                'grupo' => $request->grupo,
                'fecha_permiso' => $request->fecha_permiso,
            ]);

            DB::commit();

            return redirect()->route('justi_retardo_sociale.index')->with('success', 'Justificante actualizado con éxito.');
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
