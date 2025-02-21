@extends('template')

@section('title','Expedientes Medicos')
    
@push('css')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!--alerta -->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush

@section('content')

@if (session('success'))
    <script>
        const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 1500,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
        });
        Toast.fire({
        icon: "success",
        title: "Operacion exitosa"
        });
    </script>
@endif

    <div class="container-fluid px-4">
        <h1 class="mt-4">Expedientes Medicos</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
            <li class="breadcrumb-item active">Expedientes Medicos</li>          
        </ol>

        
        <a href="{{route('expedientes_medicos.create')}}"> 
            <button type="button" class=" btn btn-primary"> Crear Expediente Medico </button>
        </a>
        <div class="mb-4"></div>
        <!--Tabla expedientes -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Expedientes Medicos
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Matricula</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach ($expedientes as $expediente)
                            <tr>
                                <td>
                                    {{ $expediente->alumno->matricula }}
                                </td>
                                <td>
                                    {{ $expediente->alumno->nombre }}
                                </td>
                                <td>
                                    {{ $expediente->alumno->apellido }}
                                </td>
                                <td>
                                    
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                        
                                        <a href="{{ route('expedientes_medicos.edit', ['expedientes_medico' => $expediente->id]) }}">
                                            <button type="button" class="btn btn-outline-dark">Editar información</button>
                                        </a>
       
                                        <!--Falta desarrollar la vista de los expedientes -->
                                        <button type="button" class="btn btn-outline-dark">Ver expediente</button>
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
