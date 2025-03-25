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

        <h1 class="mt-4">Suspenci&oacuten de Clases</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
            <li class="breadcrumb-item active">Suspenci&oacuten de Clases</li>
        </ol>

        <div class="mb-4">
            <a href="{{route('suspencion_clase.create')}}">
                <button type="button" class=" btn btn-primary"> Crear Nuevo Documento</button>
            </a>
        </div>

        <!--Tabla de citatorios-->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Tabla Suspenciones
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-striped">
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
                        @foreach ($suspenciones as $suspencion)
                            <tr>
                                <td>{{$suspencion->expedienteDisciplinario->alumno->matricula}}</td>
                                <td>{{$suspencion->expedienteDisciplinario->alumno->nombre }}
                                    {{ $suspencion->expedienteDisciplinario->alumno->apellido }}
                                </td>
                                <td>{{$suspencion->grado }} / {{ $suspencion->grupo }}</td>
                                <td>{{$suspencion->nombre_padre}}</td>
                                <td>{{$suspencion->motivo}}</td>
                                <td>{{$suspencion->numero_dias}}</td>
                                <td>{{$suspencion->fecha_inicio}}</td>
                                <td>{{$suspencion->fecha_termino}}</td>
                                <td>{{$suspencion->nombre_profesor}}</td>
                                <td>{{$suspencion->fecha_suspencion}}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <a href="{{ route('suspencion_clase.show', ['suspencion_clase' => $suspencion->id, 'from_suspencion_clase' => true]) }}">
                                            <button type="button" class="btn btn-success">Ver</button>
                                        </a>
                                        <a href="{{ route('suspencion_clase.edit', ['suspencion_clase' => $suspencion->id]) }}">
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