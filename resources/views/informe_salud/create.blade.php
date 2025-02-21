@extends('template')

@section('title','Crear expediente medico')
    
@push('css')
    
@endpush

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Informes de salud</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{route('informe_salud.index')}}">Informes de salud</a></li>
            <li class="breadcrumb-item active">Crear informe de salud</li> 
        </ol>

        <!-- Formulario -->
        <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
            <form action="{{ route('informe_salud.store') }}" method="post">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="matricula" class="form-label">Matricula</label>
                        <input type="number" name="matricula" id="matricula" class="form-control" value="{{old('matricula')}}">
                        @error('matricula')
                           <small class="text-danger">{{'*'. $message}}</small> 
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="grado" class="form-label">Grado</label>
                        <select name="grado" id="grado" class="form-control">
                            <option value="">Seleccione...</option>
                            @foreach([1,2,3,4,5,6] as $grado)
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
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha') }}">
                        @error('fecha')
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

                    <div class="col-md-6">
                        <label for="motivo" class="form-label">Motivo</label>
                        <input type="text" name="motivo" id="motivo" class="form-control" value="{{ old('motivo') }}">
                        @error('motivo')
                        <small class="text-danger">{{ '*'.$message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                        <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" value="{{ old('fecha_inicio') }}">
                        @error('fecha_inicio')
                        <small class="text-danger">{{ '*'.$message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="fecha_final" class="form-label">Fecha Final</label>
                        <input type="date" name="fecha_final" id="fecha_final" class="form-control" value="{{ old('fecha_final') }}">
                        @error('fecha_final')
                        <small class="text-danger">{{ '*'.$message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="recomendaciones" class="form-label">Recomendaciones</label>
                        <textarea name="recomendaciones" id="recomendaciones" class="form-control">{{ old('recomendaciones') }}</textarea>
                        @error('recomendaciones')
                        <small class="text-danger">{{ '*'.$message }}</small>
                        @enderror
                    </div>

                    
                    <div class="col-md-6">
                        <label for="nombre_medico" class="form-label">Nombre del Médico</label>
                        <select name="nombre_medico" id="grupo" class="form-control">
                            <option value="">Seleccione...</option>
                            @foreach(['DoctorA', 'DoctorB',] as $grupo)
                                <option value="{{ $grupo }}" {{ old('grupo') == $grupo ? 'selected' : '' }}>{{ $grupo }}</option>
                            @endforeach
                        </select>
                        @error('grupo')
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