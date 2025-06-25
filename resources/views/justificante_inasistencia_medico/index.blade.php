@extends('template')

@section('title','Justificante de inasistencia medica')
    
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
        <h1 class="mt-4">Justificante de inasistencia medica</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
            <li class="breadcrumb-item active">Justificantes de inasistencia medica</li>          
        </ol>
        
        <div class="mb-4">
            <a href="{{route('justificante_inasistencia_medico.create')}}"> 
                <button type="button" class=" btn btn-primary"> Añadir Justificante Medico </button>
            </a >
        </div>
        
        

        <div class="mb-4">
            <!-- Tabla de justificantes -->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Justificantes de Inasistencia Médica
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
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
                            @foreach ($justificantes as $justificante)
                                <tr>
                                    <td>{{ $justificante->expedienteMedico->alumno->matricula }}</td>
                                    <td>{{ $justificante->expedienteMedico->alumno->nombre }}</td>
                                    <td>{{ $justificante->expedienteMedico->alumno->apellido }}</td>
                                    <td>{{ $justificante->grado }} /{{ $justificante->grupo }} </td>
                                    <td>{{ $justificante->fecha }}</td>
                                    <td>{{ $justificante->modulos }}</td>
                                    <td>{{ $justificante->nombre_medico }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('justificante_inasistencia_medico.edit', $justificante->id) }}">
                                                <button type="button" class="btn btn-outline-dark">Editar</button>
                                            </a>

                                            <a href="{{ route('justificante_inasistencia_medico.show', $justificante->id) }}">
                                                <button type="button" class="btn btn-outline-info">Ver</button>
                                            </a>


                                            <!-- form action="{{ route('justificante_inasistencia_medico.destroy', $justificante->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('¿Seguro que deseas eliminar este justificante?')">Eliminar</button>
                                            </form -->
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
@endsection

@push('js')
<script src="{{asset('js/datatables-simple-demo.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
@endpush