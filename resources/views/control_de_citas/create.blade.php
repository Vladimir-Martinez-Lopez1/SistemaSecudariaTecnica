@extends('template')

@section('title','Crear expediente medico')

@push('css')

@endpush

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Control de citas</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{route('control_de_citas.index')}}">Citas Medicas</a></li>
            <li class="breadcrumb-item active">Crear citas medica</li>
        </ol>

        <div class="mb-4">
            <a href="{{route('control_de_citas.create')}}">
                <button type="button" class=" btn btn-primary"> Agendar cita medica </button>
            </a>
        </div>

        <!-- Formulario -->
        <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
            <form action="{{ route('control_de_citas.store') }}" method="post">
                @csrf
                <div class="row g-3">

                    <div class="col-md-6">
                        <label for="matricula" class="form-label">Matrícula del Alumno</label>
                        <input type="number" name="matricula" id="matricula" class="form-control" value="{{ old('matricula') }}">
                        @error('matricula')
                        <small class="text-danger">{{ '*'.$message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha') }}">
                        @error('fecha')
                        <small class="text-danger">{{ '*'.$message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="grado" class="form-label">Grado</label>
                        <select name="grado" id="grado" class="form-control">
                            <option value="">Seleccione...</option>
                            @foreach([1,2,3] as $grado)
                                <option value="{{ $grado }}" {{ old('grado') == $grado ? 'selected' : '' }}>{{ $grado }}</option>
                            @endforeach
                        </select>
                        @error('grado')
                        <small class="text-danger">{{ '*'.$message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="grupo" class="form-label">Grupo</label>
                        <select name="grupo" id="grupo" class="form-control">
                            <option value="">Seleccione...</option>
                            @foreach(['A', 'B', 'C', 'D', 'E', 'F'] as $grupo)
                                <option value="{{ $grupo }}" {{ old('grupo') == $grupo ? 'selected' : '' }}>{{ $grupo }}</option>
                            @endforeach
                        </select>
                        @error('grupo')
                        <small class="text-danger">{{ '*'.$message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="sexo" class="form-label">Sexo</label>
                        <select name="sexo" id="sexo" class="form-control">
                            <option value="">Seleccione...</option>
                            <option value="Masculino" {{ old('sexo') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                            <option value="Femenino" {{ old('sexo') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                        </select>
                        @error('sexo')
                        <small class="text-danger">{{ '*'.$message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="diagnostico" class="form-label">Diagnóstico</label>
                        <input type="text" name="diagnostico" id="diagnostico" class="form-control" value="{{ old('diagnostico') }}">
                        @error('diagnostico')
                        <small class="text-danger">{{ '*'.$message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="observaciones" class="form-label">Observaciones</label>
                        <textarea name="observaciones" id="observaciones" class="form-control">{{ old('observaciones') }}</textarea>
                        @error('observaciones')
                        <small class="text-danger">{{ '*'.$message }}</small>
                        @enderror
                    </div>

                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>

                </div>
            </form>
        </div>

    </div>
@endsection

@push('js')

@endpush
