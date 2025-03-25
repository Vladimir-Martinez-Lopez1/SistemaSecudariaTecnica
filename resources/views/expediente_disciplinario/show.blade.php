@extends('template')

@section('title', 'Ver Expediente Disciplinario')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Expediente Disciplinario</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('expediente_disciplinario.index') }}">Expedientes Disciplinarios</a></li>
            <li class="breadcrumb-item active">Ver Expediente Disciplinario</li>
        </ol>

        <!-- Información del alumno -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-user me-1"></i>
                Información del Alumno
            </div>
            <div class="card-body">
                <p><strong>Número de expediente:</strong> {{ $expediente->id }}</p>
                <p><strong>Alumno:</strong> {{ $expediente->alumno->nombre }} {{ $expediente->alumno->apellido }}</p>
                <p><strong>Matrícula:</strong> {{ $expediente->alumno->matricula }}</p>
            </div>
        </div>



        <!-- Tabla de citatorios -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Tabla Citatorios
            </div>
            <div class="card-body">
                <table id="datatablesCitatorios" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Matricula</th>
                            <th>Nombre del Alumno</th>
                            <th>Nombre del padre</th>
                            <th>Grado</th>
                            <th>Grupo</th>
                            <th>Hora de la cita</th>
                            <th>Fecha de la cita</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expediente->Citatorio as $citatorio)
                            <tr>
                                <td>{{ $expediente->alumno->matricula }}</td>
                                <td>{{ $expediente->alumno->nombre }} {{ $expediente->alumno->apellido }}</td>
                                <td>{{ $citatorio->nombre_padre }}</td>
                                <td>{{ $citatorio->grado }}</td>
                                <td>{{ $citatorio->grupo }}</td>
                                <td>{{ $citatorio->hora_cita }}</td>
                                <td>{{ $citatorio->fecha_cita }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <a
                                            href="{{ route('citatorio.show', ['citatorio' => $citatorio->id, 'from_citatorio' => true]) }}">
                                            <button type="button" class="btn btn-success">Ver</button>
                                        </a>
                                        <a href="{{ route('citatorio.edit', ['citatorio' => $citatorio->id]) }}">
                                            <button type="button" class="btn btn-warning">Editar</button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tabla de Pase de salida -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Tabla Pases de salida Generales
            </div>
            <div class="card-body">
                <table id="datatablesPaseSalida" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Matricula</th>
                            <th>Nombre del alumno(a)</th>
                            <th>Grado|Grupo</th>
                            <th>No. Lista</th>
                            <th>Motivo</th>
                            <th>Hora de salida | Hora de regreso</th>
                            <th>Nombre del profesor</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expediente->Pase_salida as $pase)
                            <tr>
                                <td>{{ $expediente->alumno->matricula }}</td>
                                <td>{{ $expediente->alumno->nombre }} {{ $expediente->alumno->apellido }}</td>
                                <td>{{ $pase->grado }} / {{ $pase->grupo }}</td>
                                <td>{{ $pase->numero_lista }}</td>
                                <td>{{ $pase->motivo }}</td>
                                <td>{{ $pase->hora_salida }} / {{ $pase->hora_regreso }}</td>
                                <td>{{ $pase->solicito }}</td>
                                <td>{{ $pase->fecha_salida }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <a
                                            href="{{ route('pase_salida.show', ['pase_salida' => $pase->id, 'from_pase_salida' => true]) }}">
                                            <button type="button" class="btn btn-success">Ver</button>
                                        </a>
                                        <a href="{{ route('pase_salida.edit', ['pase_salida' => $pase->id]) }}">
                                            <button type="button" class="btn btn-warning">Editar</button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tabla reporte de Incidencia -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Tabla Reportes de Incidencias
            </div>
            <div class="card-body">
                <table id="datatablesReportes" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Matricula</th>
                            <th>Nombre del alumno(a)</th>
                            <th>Grado|Grupo</th>
                            <th>Motivo</th>
                            <th>Modulo</th>
                            <th>Asignatura</th>
                            <th>Nombre del profesor</th>
                            <th>Fecha|hora</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expediente->Reporte_incidencia as $reporte)
                            <tr>
                                <td>{{ $expediente->alumno->matricula }}</td>
                                <td>{{ $expediente->alumno->nombre }} {{ $expediente->alumno->apellido }}</td>
                                <td>{{ $reporte->grado }} / {{ $reporte->grupo }}</td>
                                <td>{{ $reporte->motivo }}</td>
                                <td>{{ $reporte->modulo }}</td>
                                <td>{{ $reporte->asignatura }}</td>
                                <td>{{ $reporte->nombre_profesor }}</td>
                                <td>{{ $reporte->fecha_reporte }} / {{ $reporte->hora_clase }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <a
                                            href="{{ route('reporte_incidencia.show', ['reporte_incidencium' => $reporte->id, 'from_reporte_incidencium' => true]) }}">
                                            <button type="button" class="btn btn-success">Ver</button>
                                        </a>
                                        <a href="{{ route('reporte_incidencia.edit', ['reporte_incidencium' => $reporte->id]) }}">
                                            <button type="button" class="btn btn-warning">Editar</button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tabla de Suspencion de clases -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Tabla Suspenciones
            </div>
            <div class="card-body">
                <table id="datatablesSuspenciones" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Matricula</th>
                            <th>Nombre del alumno(a)</th>
                            <th>Grado|Grupo</th>
                            <th>Nombre del padre</th>
                            <th>Motivo</th>
                            <th>No. días de suspencion</th>
                            <th>Inicio de la suspención</th>
                            <th>Termino de la suspención</th>
                            <th>Nombre del Profesor</th>
                            <th>Fecha del acta</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expediente->Suspencion_clase as $suspencion)
                            <tr>
                                <td>{{ $expediente->alumno->matricula }}</td>
                                <td>{{ $expediente->alumno->nombre }} {{ $expediente->alumno->apellido }}</td>
                                <td>{{ $suspencion->grado }} / {{ $suspencion->grupo }}</td>
                                <td>{{ $suspencion->nombre_padre }}</td>
                                <td>{{ $suspencion->motivo }}</td>
                                <td>{{ $suspencion->numero_dias }}</td>
                                <td>{{ $suspencion->fecha_inicio }}</td>
                                <td>{{ $suspencion->fecha_termino }}</td>
                                <td>{{ $suspencion->nombre_profesor }}</td>
                                <td>{{ $suspencion->fecha_suspencion }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <a
                                            href="{{ route('suspencion_clase.show', ['suspencion_clase' => $suspencion->id, 'from_suspencion_clase' => true]) }}">
                                            <button type="button" class="btn btn-success">Ver</button>
                                        </a>
                                        <a href="{{ route('suspencion_clase.edit', ['suspencion_clase' => $suspencion->id]) }}">
                                            <button type="button" class="btn btn-warning">Editar</button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tabla de pase de salida trabajo Social -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Tabla Pases de Salida por Trabajo Social
            </div>
            <div class="card-body">
                <table id="datatablesPaseSalidaTrabSocial" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Matricula</th>
                            <th>Nombre del alumno(a)</th>
                            <th>Grado|Grupo</th>
                            <th>Motivo</th>
                            <th>Hora de salida | Hora de regreso</th>
                            <th>Nombre del profesor</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expediente->Pase_salida_trab_sociale as $pase)
                            <tr>
                                <td>{{ $expediente->alumno->matricula }}</td>
                                <td>{{ $expediente->alumno->nombre }} {{ $expediente->alumno->apellido }}</td>
                                <td>{{ $pase->grado }} / {{ $pase->grupo }}</td>
                                <td>{{ $pase->motivo }}</td>
                                <td>{{ $pase->hora_salida }} / {{ $pase->hora_regreso }}</td>
                                <td>{{ $pase->solicito }}</td>
                                <td>{{ $pase->fecha_salida }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <a
                                            href="{{ route('pase_salida_trab_sociale.show', ['pase_salida_trab_sociale' => $pase->id, 'from_pase_salida_trab_sociale' => true]) }}">
                                            <button type="button" class="btn btn-success">Ver</button>
                                        </a>
                                        <a
                                            href="{{ route('pase_salida_trab_sociale.edit', ['pase_salida_trab_sociale' => $pase->id]) }}">
                                            <button type="button" class="btn btn-warning">Editar</button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tabla Permiso Trabajo social -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Tabla Permisos por Trabajo Social
            </div>
            <div class="card-body">
                <table id="datatablesPermisosTrabSocial" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Matricula</th>
                            <th>Nombre del alumno(a)</th>
                            <th>Grado|Grupo</th>
                            <th>Motivo</th>
                            <th>Número de dias</th>
                            <th>Fecha de Inicio</th>
                            <th>Fecha de termino</th>
                            <th>Nombre del padre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expediente->Permiso_trab_sociale as $permiso)
                            <tr>
                                <td>{{ $expediente->alumno->matricula }}</td>
                                <td>{{ $expediente->alumno->nombre }} {{ $expediente->alumno->apellido }}</td>
                                <td>{{ $permiso->grado }} / {{ $permiso->grupo }}</td>
                                <td>{{ $permiso->motivo }}</td>
                                <td>{{ $permiso->numero_dias }}</td>
                                <td>{{ $permiso->fecha_inicio }}</td>
                                <td>{{ $permiso->fecha_termino }}</td>
                                <td>{{ $permiso->nombre_padre }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <a
                                            href="{{ route('permiso_trab_sociale.show', ['permiso_trab_sociale' => $permiso->id, 'from_permiso_trab_sociale' => true]) }}">
                                            <button type="button" class="btn btn-success">Ver</button>
                                        </a>
                                        <a
                                            href="{{ route('permiso_trab_sociale.edit', ['permiso_trab_sociale' => $permiso->id]) }}">
                                            <button type="button" class="btn btn-warning">Editar</button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tabla de Justificante de retardo trabajo social -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Tabla Justificantes de Retardo por Trabajo Social
            </div>
            <div class="card-body">
                <table id="datatablesJustificanteTrabSocial" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Matricula</th>
                            <th>Nombre del alumno(a)</th>
                            <th>Grado|Grupo</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expediente->Justi_retardo_sociale as $justificado)
                            <tr>
                                <td>{{ $expediente->alumno->matricula }}</td>
                                <td>{{ $expediente->alumno->nombre }} {{ $expediente->alumno->apellido }}</td>
                                <td>{{ $justificado->grado }} / {{ $justificado->grupo }}</td>
                                <td>{{ $justificado->fecha_permiso }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <a
                                            href="{{ route('justi_retardo_sociale.show', ['justi_retardo_sociale' => $justificado->id, 'from_justi_retardo_sociale' => true]) }}">
                                            <button type="button" class="btn btn-success">Ver</button>
                                        </a>
                                        <a
                                            href="{{ route('justi_retardo_sociale.edit', ['justi_retardo_sociale' => $justificado->id]) }}">
                                            <button type="button" class="btn btn-warning">Editar</button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection

@push('js')
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Inicializar DataTables para todas las tablas
            new simpleDatatables.DataTable("#datatablesInformesSalud");
            new simpleDatatables.DataTable("#datatablesJustificantes");
            new simpleDatatables.DataTable("#datatablesCitatorios");
            new simpleDatatables.DataTable("#datatablesPaseSalida");
            new simpleDatatables.DataTable("#datatablesReportes");
            new simpleDatatables.DataTable("#datatablesSuspenciones");
            new simpleDatatables.DataTable("#datatablesPaseSalidaTrabSocial");
            new simpleDatatables.DataTable("#datatablesPermisosTrabSocial");
            new simpleDatatables.DataTable("#datatablesJustificanteTrabSocial");

            // Configuración adicional común para todas las tablas (opcional)
            const tables = document.querySelectorAll('table[data-datatables]');
            tables.forEach(table => {
                new simpleDatatables.DataTable(table, {
                    perPage: 10, // Mostrar 10 registros por página
                    perPageSelect: [5, 10, 15, 20], // Opciones de paginación
                    labels: {
                        placeholder: "Buscar...",
                        perPage: "{select} registros por página",
                        noRows: "No se encontraron registros",
                        info: "Mostrando {start} a {end} de {rows} registros"
                    }
                });
            });
        });
    </script>
@endpush
