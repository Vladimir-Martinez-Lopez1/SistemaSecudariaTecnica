@extends('template')

@section('title', 'permisoTrabSociale')


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

        <h1 class="mt-4">Permiso de Ausencia por Trabajo Social</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
            <li class="breadcrumb-item active">Permiso de Ausencia</li>
        </ol>

        <div class="mb-4">
            <a href="{{route('permiso_trab_sociale.create')}}">
                <button type="button" class=" btn btn-primary"> Crear Nuevo permiso</button>
            </a>
        </div>


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Tabla permisos
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Matricula</th>
                            <th>Nombre del alumno(a)</th>
                            <th>Grado|Grupo</th>
                            <th>Motivo</th>
                            <th>Número de dias </th>
                            <th>Fecha de Inicio</th>
                            <th>Fecha de termino</th>
                            <th>Nombre del padre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($permisos as $permiso)
                            <tr>
                                <td>{{$permiso->expedienteDisciplinario->alumno->matricula}}</td>
                                <td>{{$permiso->expedienteDisciplinario->alumno->nombre }}
                                    {{ $permiso->expedienteDisciplinario->alumno->apellido }}
                                </td>
                                <td>{{$permiso->grado }} / {{ $permiso->grupo }}</td>
                                <td>{{$permiso->motivo}}</td>
                                <td>{{$permiso->numero_dias}}</td>
                                <td>{{$permiso->fecha_inicio}}</td>
                                <td>{{$permiso->fecha_termino}}</td>
                                <td>{{$permiso->nombre_padre}}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <a href="{{ route('permiso_trab_sociale.show', ['permiso_trab_sociale' => $permiso->id, 'from_permiso_trab_sociale' => true]) }}">
                                            <button type="button" class="btn btn-success">Ver</button>
                                        </a>
                                        <a href="{{ route('permiso_trab_sociale.edit', ['permiso_trab_sociale' => $permiso->id]) }}">
                                            <button type="button" class="btn btn-warning">Editar</button>
                                        </a>
                                        <button type="button" class="btn btn-danger">Borrar</button>
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
