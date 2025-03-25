@extends('template')

@section('title', 'justificanteRetardoTrabSociale')


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

        <h1 class="mt-4">Justificante de retardo por Trabajo Social</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
            <li class="breadcrumb-item active">Justificante de Retardo</li>
        </ol>

        <div class="mb-4">
            <a href="{{route('justi_retardo_sociale.create')}}">
                <button type="button" class=" btn btn-primary"> Crear Nuevo Justificante</button>
            </a>
        </div>

        <!--Tabla de citatorios-->
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
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($justificados as $justificado)
                            <tr>
                                <td>{{$justificado->expedienteDisciplinario->alumno->matricula}}</td>
                                <td>{{$justificado->expedienteDisciplinario->alumno->nombre }}
                                    {{ $justificado->expedienteDisciplinario->alumno->apellido }}
                                </td>
                                <td>{{$justificado->grado }} / {{ $justificado->grupo }}</td>
                                <td>{{$justificado->fecha_permiso}}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <a href="{{ route('justi_retardo_sociale.show', ['justi_retardo_sociale' => $justificado->id, 'from_justi_retardo_sociale' => true]) }}">
                                            <button type="button" class="btn btn-success">Ver</button>
                                        </a>
                                        <a href="{{ route('justi_retardo_sociale.edit', ['justi_retardo_sociale' => $justificado->id]) }}">
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
