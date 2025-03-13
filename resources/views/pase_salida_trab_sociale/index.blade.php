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

        <h1 class="mt-4">Pase de salida Trabajo Social</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
            <li class="breadcrumb-item active">Pase de Salida</li>
        </ol>

        <div class="mb-4">
            <a href="{{route('pase_salida_trab_sociale.create')}}">
                <button type="button" class=" btn btn-primary"> Crear Nuevo Pase de Salida</button>
            </a>
        </div>

        < <!--Tabla de citatorios-->
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
                                <th>No. Lista</th>
                                <th>Motivo</th>
                                <th>Hora de salida | Hora de regreso</th>
                                <th>Nombre del profesor</th>
                                <th>Fecha</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($paseTra as $pase)
                                <tr>
                                    <td>{{$pase->expedienteDisciplinario->alumno->matricula}}</td>
                                    <td>{{$pase->expedienteDisciplinario->alumno->nombre }}
                                        {{ $pase->expedienteDisciplinario->alumno->apellido }}</td>
                                    <td>{{$pase->grado }} / {{ $pase->grupo }}</td>
                                    <td>{{$pase->numero_lista}}</td>
                                    <td>{{$pase->motivo}}</td>
                                    <td>{{$pase->hora_salida}} / {{$pase->hora_regreso}} </td>
                                    <td>{{$pase->solicito}}</td>
                                    <td>{{$pase->fecha_salida}}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                            <button type="button" class="btn btn-success">Ver</button>
                                            <button type="button" class="btn btn-warning">Editar</button>
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