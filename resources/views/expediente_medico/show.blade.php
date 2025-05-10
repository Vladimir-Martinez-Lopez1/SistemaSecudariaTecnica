@extends('template')

@section('title', 'Ver Expediente Médico')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Expediente Médico</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('expedientes_medicos.index') }}">Expedientes Médicos</a></li>
        <li class="breadcrumb-item active">Ver Expediente Médico</li>
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

    <!-- Tabla de informes de salud -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-file-medical me-1"></i>
            Informes de Salud
        </div>
        <div class="card-body">
            <table id="datatablesInformesSalud" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Alumno</th>
                        <th>Grado/Grupo</th> 
                        <th>Diagnóstico</th>
                        <th>Motivo</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Final</th>
                        <th>Médico</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($expediente->informesSalud as $informe)
                        <tr>
                            <td>{{ $informe->fecha }}</td>
                            <td>{{ $informe->expedienteMedico->alumno->nombre ?? 'N/A' }} {{ $informe->expedienteMedico->alumno->apellido ?? '' }}</td>
                            <td>{{ $informe->grado }} /{{ $informe->grupo }} </td>
                            <td>{{ $informe->diagnostico }}</td>
                            <td>{{ $informe->motivo }}</td>
                            <td>{{ $informe->fecha_inicio }}</td>
                            <td>{{ $informe->fecha_final }}</td>
                            <td>{{ $informe->nombre_medico }}</td>

                            <td> <!-- boton para vista show de informe de salud -->
                                <a href="{{ route('informe_salud.show', ['informe_salud' => $informe->id, 'from_expediente_medico' => true]) }}">
                                    <button type="button" class="btn btn-outline-info">Ver</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tabla de justificantes de inasistencia médica -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-file-alt me-1"></i>
            Justificantes de Inasistencia Médica
        </div>
        <div class="card-body">
            <table id="datatablesJustificantes" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Matrícula</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Grado/Grupo</th>
                        <th>Fecha</th>
                        <th>Módulos</th>
                        <th>Médico</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($expediente->justificantesInasistencia as $justificante)
                        <tr>
                            <td>{{ $justificante->expedienteMedico->alumno->matricula }}</td>
                            <td>{{ $justificante->expedienteMedico->alumno->nombre }}</td>
                            <td>{{ $justificante->expedienteMedico->alumno->apellido }}</td>
                            <td>{{ $justificante->grado }} /{{ $justificante->grupo }} </td>
                            <td>{{ $justificante->fecha }}</td>
                            <td>{{ $justificante->modulos }}</td>
                            <td>{{ $justificante->nombre_medico }}</td>
                            <td>  <!-- boton para vista show de justificantes de inasistencia médica--> 
                                <a href="{{ route('justificante_inasistencia_medico.show', ['justificante_inasistencia_medico' => $justificante->id, 'from_expediente_medico' => true]) }}">
                                    <button type="button" class="btn btn-outline-info">Ver</button>
                                </a>
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
            // Inicializar DataTables para ambas tablas
            new simpleDatatables.DataTable("#datatablesInformesSalud");
            new simpleDatatables.DataTable("#datatablesJustificantes");
        });
    </script>
@endpush