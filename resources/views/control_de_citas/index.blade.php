@extends('template')

@section('title', 'Control de citas')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Control de citas</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Citas médicas</li>
    </ol>

    <div class="mb-4">
        <a href="{{ route('control_de_citas.create') }}">
            <button type="button" class="btn btn-primary">Agendar cita médica</button>
        </a>
    </div>

    <!-- Tabla de citas médicas activas -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Citas médicas activas
        </div>
        <div class="card-body">
            <table id="datatablesSimpleActivas" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Alumno</th>
                        <th>Grado/Grupo</th>
                        <th>Sexo</th>
                        <th>Diagnóstico</th>
                        <th>Observaciones</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($citas_activas as $cita)
                        <tr>
                            <td>{{ $cita->fecha }}</td>
                            <td>{{ $cita->expedienteMedico->alumno->nombre }} {{ $cita->expedienteMedico->alumno->apellido }}</td>
                            <td>{{ $cita->grado }} / {{ $cita->grupo }}</td>
                            <td>{{ $cita->sexo }}</td>
                            <td>{{ $cita->diagnostico }}</td>
                            <td>{{ $cita->observaciones }}</td>
                            <td>{{ $cita->estado }}</td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                    <a href="{{ route('control_de_citas.edit', ['control_de_cita' => $cita->id]) }}">
                                        <button type="button" class="btn btn-primary">Editar Cita</button>
                                    </a>
                                    <form action="{{ route('control_de_citas.destroy', $cita->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-warning">Desactivar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tabla de citas médicas inactivas -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Citas médicas inactivas
        </div>
        <div class="card-body">
            <table id="datatablesSimpleInactivas" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Alumno</th>
                        <th>Grado/Grupo</th>
                        <th>Sexo</th>
                        <th>Diagnóstico</th>
                        <th>Observaciones</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($citas_inactivas as $cita)
                        <tr>
                            <td>{{ $cita->fecha }}</td>
                            <td>{{ $cita->expedienteMedico->alumno->nombre }} {{ $cita->expedienteMedico->alumno->apellido }}</td>
                            <td>{{ $cita->grado }} / {{ $cita->grupo }}</td>
                            <td>{{ $cita->sexo }}</td>
                            <td>{{ $cita->diagnostico }}</td>
                            <td>{{ $cita->observaciones }}</td>
                            <td>{{ $cita->estado }}</td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                    <a href="{{ route('control_de_citas.edit', ['control_de_cita' => $cita->id]) }}">
                                        <button type="button" class="btn btn-primary">Editar Cita</button>
                                    </a>
                                    <form action="{{ route('control_de_citas.destroy', $cita->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-warning">Activar</button>
                                    </form>
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
        new simpleDatatables.DataTable("#datatablesSimpleActivas");
        new simpleDatatables.DataTable("#datatablesSimpleInactivas");
    });
</script>
@endpush
