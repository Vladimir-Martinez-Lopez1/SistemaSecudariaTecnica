<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSuspencionClaseRequest;
use App\Http\Requests\UpdateSuspencioClaseRequest;
use App\Models\Alumno;
use App\Models\ExpedienteDisciplinario;
use App\Models\Suspencion_clase;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class suspencioClaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:ver-suspencionClase|crear-suspencionClase|editar-suspencionClase|mostrar-suspencionClase',['only'=>['index']]);
        $this->middleware('permission:crear-suspencionClase', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-suspencionClase', ['only' => ['edit', 'update']]);
        $this->middleware('permission:mostrar-suspencionClase', ['only' => ['show']]);
    }

    public function index()
    {
        //
        $suspenciones = Suspencion_clase::with('expedienteDisciplinario')->get();
        return view('suspencion_clase.index', compact('suspenciones'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $matricula = Alumno::all();
        return view('suspencion_clase.create', compact('matricula'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSuspencionClaseRequest $request)
    {
        //dd($request);
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $alumno = Alumno::where('matricula', $request->matricula)->firstOrFail();

            if (!$alumno) {
                return redirect()->back()->withErrors(['matricula' => 'No se encontró un alumno con esta matrícula.']);
            }

            $expediente = ExpedienteDisciplinario::where('alumno_id', $alumno->id)->firstOrFail();

            if (!$expediente) {
                return redirect()->back()->withErrors(['matricula' => 'No se encontró un expediente médico para este alumno.']);
            }

            // Calcular la fecha de término
            $fechaInicio = Carbon::parse($data['fecha_inicio']);
            $fechaTermino = $fechaInicio->copy()->addDays($data['numero_dias'] - 1); // Restar 1 porque el primer día cuenta

            // Ajustar la fecha de término si cae en sábado o domingo
            if ($fechaTermino->isWeekend()) {
                $fechaTermino->next(Carbon::MONDAY); // Redondear al siguiente lunes
            }

            // Agregar la fecha de término al array de datos
            $data['fecha_termino'] = $fechaTermino->toDateString();

            // Crear el registro en la base de datos
            Suspencion_clase::create([
                'fecha_suspencion' => $data['fecha_suspencion'],
                'nombre_padre' => $data['nombre_padre'],
                'grado' => $data['grado'],
                'grupo' => $data['grupo'],
                'motivo' => $data['motivo'],
                'capitulo' => $data['capitulo'],
                'articulo' => $data['articulo'],
                'fraccion' => $data['fraccion'],
                'inciso' => $data['inciso'],
                'numero_dias' => $data['numero_dias'],
                'fecha_inicio' => $data['fecha_inicio'],
                'fecha_termino' => $data['fecha_termino'],
                'nombre_profesor' => $data['nombre_profesor'],
                'expediente_disciplinario_id' => $expediente->id,
            ]);
            DB::commit();
            return redirect()->route('suspencion_clase.index')->with('success', 'Reporte registado exitosamente.');

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
        $suspencion_clase = Suspencion_clase::with('expedienteDisciplinario.alumno')->find($id);

        // Verificar si el registro existe
        if (!$suspencion_clase) {
            return redirect()->route('suspencion_clase.index')->with('error', 'El documento de suspencion no existe.');
        }
        // $matricula = $citatorio->expedienteDisciplinario->alumno->matricula;
        $nombre = $suspencion_clase->expedienteDisciplinario->alumno->nombre;
        $apellido = $suspencion_clase->expedienteDisciplinario->alumno->apellido;
        // Determinar si la solicitud proviene de citatorio_general
        $from_suspencion_clase = $request->query('from_suspencion_clase', false);
        // Pasar los datos a la vista
        return view('suspencion_clase.show', compact('suspencion_clase', 'from_suspencion_clase', 'nombre', 'apellido'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Suspencion_clase $suspencion_clase)
    {
        // Cargar la relación expedienteDisciplinario.alumno
        $suspencion_clase->load('expedienteDisciplinario.alumno');

        // Obtener todos los alumnos para el select
        $matricula = Alumno::all();

        // Pasar el suspencion_clase y la lista de alumnos a la vista
        return view('suspencion_clase.edit', [
            'suspencion_clase' => $suspencion_clase,
            'matricula' => $matricula,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSuspencioClaseRequest $request, Suspencion_clase $suspencion_clase)
    {
        try {
            // Calcular la fecha de término
            $fechaInicio = Carbon::parse($request->fecha_inicio);
            $fechaTermino = $fechaInicio->copy()->addDays($request->numero_dias - 1); // Restar 1 porque el primer día cuenta

            // Ajustar la fecha de término si cae en sábado o domingo
            if ($fechaTermino->isWeekend()) {
                $fechaTermino->next(Carbon::MONDAY); // Redondear al siguiente lunes
            }

            DB::beginTransaction();

            // Actualizar el registro
            $suspencion_clase->update([
                'fecha_suspencion' => $request->fecha_suspencion,
                'nombre_padre' => $request->nombre_padre,
                'grado' => $request->grado,
                'grupo' => $request->grupo,
                'motivo' => $request->motivo,
                'capitulo' => $request->capitulo,
                'articulo' => $request->articulo,
                'fraccion' => $request->fraccion,
                'inciso' => $request->inciso,
                'numero_dias' => $request->numero_dias,
                'fecha_inicio' => $request->fecha_inicio,
                'fecha_termino' => $fechaTermino->toDateString(), // Usar la fecha calculada
                'nombre_profesor' => $request->nombre_profesor,
            ]);

            DB::commit();

            return redirect()->route('suspencion_clase.index')->with('success', 'Documento de suspención actualizado con éxito.');
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
