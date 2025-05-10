@extends('template')

@section('title','Crear expediente medico')

@push('css')

@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Crear Expedientes Medicos</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{route('expedientes_medicos.index')}}">Expedientes Medicos</a></li>
        <li class="breadcrumb-item active">Crear Expedientes Medicos</li>
    </ol>

    <!-- Formulario-->
    <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
        <form action="{{route('expedientes_medicos.store')}}" method="post">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="matricula" class="form-label">Matrícula</label>
                    @php
                        $ultimaMatricula = App\Models\Alumno::max('matricula');
                        $siguienteMatricula = $ultimaMatricula ? $ultimaMatricula + 1 : 1;
                        $valorMatricula = old('matricula', $siguienteMatricula);
                    @endphp

                    <input type="number" name="matricula" id="matricula" class="form-control" value="{{ $valorMatricula }}" min="1"
                        readonly style="background-color: #f8f9fa; cursor: not-allowed;">

                    @error('matricula')
                        <small class="text-danger">{{ '*' . $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="nombre" class="form-label">Nombre(s)</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="{{old('nombre')}}">
                    @error('nombre')
                       <small class="text-danger">{{'*'. $message}}</small>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="apellido" class="form-label">Apellido(s)</label>
                    <input type="text" name="apellido" id="apellido" class="form-control" value="{{old('apellido')}}">
                    @error('apellido')
                       <small class="text-danger">{{'*'. $message}}</small>
                    @enderror
                </div>

                <div class="col-12 text-center" >
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>

            </div>
        </form>
    </div>

</div>
@endsection

@push('js')

@endpush
