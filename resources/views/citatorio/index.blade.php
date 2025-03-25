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

        <h1 class="mt-4">Citatorio Individual</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
            <li class="breadcrumb-item active">Citatorio</li>
        </ol>

        <div class="mb-4">
            <a href="{{route('citatorio.create')}}">
                <button type="button" class=" btn btn-primary"> Crear Nuevo Citatorio</button>
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
                            <th>Nombre del Alumno</th>
                            <th>Nombre del padre</th>
                            <th>Grado</th>
                            <th>Grupo</th>
                            <th>Hora de la cita</th>
                            <th>Fecha de la cita</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    @foreach ($citatorios as $citatorio)
                        <tr>
                            <td>{{$citatorio->expedienteDisciplinario->alumno->matricula}}</td>
                            <td>{{$citatorio->expedienteDisciplinario->alumno->nombre }}
                                {{ $citatorio->expedienteDisciplinario->alumno->apellido }}</td>
                            <td>{{$citatorio->nombre_padre}}</td>
                            <td>{{$citatorio->grado}}</td>
                            <td>{{$citatorio->grupo}}</td>
                            <td>{{$citatorio->hora_cita}}</td>
                            <td>{{$citatorio->fecha_cita}}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <a href="{{ route('citatorio.show', ['citatorio' => $citatorio->id, 'from_citatorio' => true]) }}">
                                        <button type="button" class="btn btn-success">Ver</button>
                                    </a>
                                    {{-- <button type="button" class="btn btn-success">Ver</button> --}}
                                    <a href="{{ route('citatorio.edit', ['citatorio' => $citatorio->id]) }}">
                                        <button type="button" class="btn btn-warning">Editar</button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    <tbody>

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
