@extends('template')

@section('title','Informes de salud')

@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!--alerta -->
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Informes de salud</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
        <li class="breadcrumb-item active">Informes de salud</li>
    </ol>



    <div class="mb-4">
        <a href="{{route('informe_salud.create')}}">
            <button type="button" class=" btn btn-primary"> Añadir informe de salud </button>
        </a>
    </div>

    <!-- Tabla de informes de salud -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Informes de salud
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
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
                    @foreach($informes_salud as $informe)
                        <tr>
                            <td>{{ $informe->fecha }}</td>
                            <td>{{ $informe->expedienteMedico->alumno->nombre ?? 'N/A' }} {{ $informe->expedienteMedico->alumno->apellido ?? '' }}</td>
                            <td>{{ $informe->grado }} /{{ $informe->grupo }} </td>
                            <td>{{ $informe->diagnostico }}</td>
                            <td>{{ $informe->motivo }}</td>
                            <td>{{ $informe->fecha_inicio }}</td>
                            <td>{{ $informe->fecha_final }}</td>
                            <td>{{ $informe->nombre_medico }}</td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                    <a href="{{ route('informe_salud.edit', ['informe_salud' => $informe->id]) }}">
                                        <button type="button" class="btn btn-success">Editar</button>
                                    </a>

                                    <a href="{{ route('informe_salud.show', $informe->id) }}">
                                        <button type="button" class="btn btn-warning">Ver</button>
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
<script src="{{asset('js/datatables-simple-demo.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
@endpush
