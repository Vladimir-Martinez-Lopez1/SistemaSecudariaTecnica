@extends('template')

@section('title','Editar justificante de inasistencia medica')
    
@push('css')
    
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Editar justificante de inasistencia medica</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{route('justificante_inasistencia_medico.index')}}">Justificantes de inasistencia medica</a></li>          
            <li class="breadcrumb-item active">Editar justificante Medico</li>
        </ol>

        <!-- Formulario -->
        <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
            <form action="{{ route('justificante_inasistencia_medico.update', $justificante) }}" method="post">
                @method('PATCH')
                @csrf
                <div class="row g-3">

                    <div class="col-md-6">
                        <label for="matricula" class="form-label">Matrícula del Alumno</label>
                        <input type="number" name="matricula" id="matricula" class="form-control" 
                            value="{{ old('matricula', $justificante->expedienteMedico->alumno->matricula) }}" readonly>
                        @error('matricula')
                            <small class="text-danger">{{ '*'.$message }}</small>
                        @enderror
                    </div>

                    <input type="hidden" name="expediente_medico_id" id="expediente_medico_id" value="{{ old('expediente_medico_id', $justificante->expediente_medico_id) }}">

                    <div class="col-md-6">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha', $justificante->fecha) }}">
                        @error('fecha')
                            <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="modulos" class="form-label">Módulos</label>
                        <input type="text" name="modulos" id="modulos" class="form-control" value="{{ old('modulos', $justificante->modulos) }}">
                        @error('modulos')
                            <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="nombre_medico" class="form-label">Nombre del Médico</label>
                        <select name="nombre_medico" id="nombre_medico" class="form-control">
                            <option value="">Seleccione...</option>
                            @foreach(['DoctorA', 'DoctorB'] as $doctor)
                                <option value="{{ $doctor }}" {{ old('nombre_medico', $justificante->nombre_medico) == $doctor ? 'selected' : '' }}>{{ $doctor }}</option>
                            @endforeach
                        </select>
                        @error('nombre_medico')
                        <small class="text-danger">{{ '*'.$message }}</small>
                        @enderror
                    </div>

                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <a href="{{ route('justificante_inasistencia_medico.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </div> 
            </form>
        </div>


</div>

@endsection

@push('js')
    
@endpush


