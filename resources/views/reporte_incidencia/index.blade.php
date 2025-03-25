@extends('template')

@section('title', 'categorias')


@push('css')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!--alerta -->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush

@section('content')
    @if (session('success'))
        <script>
            let message = "{{ session('success')}}";
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener = ('mouseenter', Swal.stopTimer);
                    toast.addEventListener = ('mouseleave', Swal.resumeTimer);
                }
            });
            Toast.fire({
                icon: "success",
                title: message
            });
        </script>
    @endif

        <div class="container-fluid px-4">

            <h1 class="mt-4">Reporte de Incidencia</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
                <li class="breadcrumb-item active">Reporte de Incidencia</li>
            </ol>

            <div class="mb-4">
            <a href="{{route('reporte_incidencia.create')}}">
                <button type="button" class=" btn btn-primary"> Crear Nuevo Reporte</button>
            </a>
            </div>

            {{-- Tabla reporte de Incidencia --}}
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Tabla Citatorios
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-striped">
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
                            @foreach ($reportes as $reporte)
                                <tr>
                                    <td>{{$reporte->expedienteDisciplinario->alumno->matricula}}</td>
                                    <td>{{$reporte->expedienteDisciplinario->alumno->nombre }} {{ $reporte->expedienteDisciplinario->alumno->apellido }}
                                    </td>
                                    <td>{{$reporte->grado }} / {{ $reporte->grupo }}</td>
                                    <td>{{$reporte->motivo}}</td>
                                    <td>{{$reporte->modulo}}</td>
                                    <td>{{$reporte->asignatura}}</td>
                                    <td>{{$reporte->nombre_profesor}}</td>
                                    <td>{{$reporte->fecha_reporte}} / {{$reporte->hora_clase}} </td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                            <a href="{{ route('reporte_incidencia.show', ['reporte_incidencium' => $reporte->id, 'from_reporte_incidencium' => true]) }}">
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

        </div>

@endsection

@push('js')
    <script src="{{asset('js/datatables-simple-demo.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
@endpush
