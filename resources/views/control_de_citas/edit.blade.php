@extends('template')

@section('title','Editar Cita Médica')

@push('css')
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Editar Cita Médica</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('control_de_citas.index') }}">Citas Médicas</a></li>  
        <li class="breadcrumb-item active">Editar Cita</li>          
    </ol>

    <!-- Formulario -->
    <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
        <form action="{{ route('control_de_citas.update', $control_de_cita) }}" method="post">
            @method('PATCH')
            @csrf
            <div class="row g-3">

                <div class="col-md-6">
                    <label for="matricula" class="form-label">Matrícula del Alumno</label>
                    <input type="number" name="matricula" id="matricula" class="form-control" value="{{ old('matricula', $control_de_cita->expedienteMedico->alumno->matricula) }}" readonly>
                    @error('matricula')
                    <small class="text-danger">{{ '*'.$message }}</small>
                    @enderror
                </div>
                

                <div class="col-md-6">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha', $control_de_cita->fecha) }}">
                    @error('fecha')
                    <small class="text-danger">{{ '*'.$message }}</small>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="grado" class="form-label">Grado</label>
                    <input type="text" name="grado" id="grado" class="form-control" value="{{ old('grado', $control_de_cita->grado) }}">
                    @error('grado')
                    <small class="text-danger">{{ '*'.$message }}</small>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="grupo" class="form-label">Grupo</label>
                    <input type="text" name="grupo" id="grupo" class="form-control" value="{{ old('grupo', $control_de_cita->grupo) }}">
                    @error('grupo')
                    <small class="text-danger">{{ '*'.$message }}</small>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="sexo" class="form-label">Sexo</label>
                    <select name="sexo" id="sexo" class="form-control">
                        <option value="Masculino" {{ old('sexo', $control_de_cita->sexo) == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                        <option value="Femenino" {{ old('sexo', $control_de_cita->sexo) == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                    </select>
                    @error('sexo')
                    <small class="text-danger">{{ '*'.$message }}</small>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="diagnostico" class="form-label">Diagnóstico</label>
                    <input type="text" name="diagnostico" id="diagnostico" class="form-control" value="{{ old('diagnostico', $control_de_cita->diagnostico) }}">
                    @error('diagnostico')
                    <small class="text-danger">{{ '*'.$message }}</small>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="observaciones" class="form-label">Observaciones</label>
                    <textarea name="observaciones" id="observaciones" class="form-control">{{ old('observaciones', $control_de_cita->observaciones) }}</textarea>
                    @error('observaciones')
                    <small class="text-danger">{{ '*'.$message }}</small>
                    @enderror
                </div>

                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <button type="reset" class="btn btn-secondary">Cancelar</button>
                </div>

            </div>
        </form>
    </div>

</div>
@endsection

@push('js')

@endpush



