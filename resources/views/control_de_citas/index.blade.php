@extends('template')

@section('title','Control de citas')
    
@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!--alerta -->
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Control de citas</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
        <li class="breadcrumb-item active">Citas medicas</li>          
    </ol>

    <div class="mb-4">
        <a href="{{route('control_de_citas.create')}}"> 
            <button type="button" class=" btn btn-primary"> Agendar cita medica </button>
        </a>
    </div>
    
    <!-- Tabla de citas medicas citas -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Citas medicas
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Alumno</th> 
                        <th>Grado/Grupo</th> 
                        <th>Sexo</th>
                        <th>Diagnostico</th>
                        <th>Observaciones</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($control_de_citas as $control_de_cita)
                        <tr>
                            <td>
                                {{ $control_de_cita->fecha }}

                            </td>
                            <td>
                                {{ $control_de_cita->expedienteMedico->alumno->nombre }} {{ $control_de_cita->expedienteMedico->alumno->apellido }}
                            </td>
                            <td>
                                {{ $control_de_cita->grado }} / {{ $control_de_cita->grupo }}
                            </td>
                            <td>
                                {{ $control_de_cita->sexo }}
                            </td>
                            <td>
                                {{ $control_de_cita->diagnostico }}
                            </td>
                            <td>
                                {{ $control_de_cita->observaciones }}
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                        
                                    <a href="{{ route('control_de_citas.edit', ['control_de_cita' => $control_de_cita->id]) }}">
                                        <button type="button" class="btn btn-outline-dark">Editar Cita</button>
                                    </a>
   
                                    <!--Falta desarrollar-->
                                    <button type="button" class="btn btn-outline-dark">....</button>
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