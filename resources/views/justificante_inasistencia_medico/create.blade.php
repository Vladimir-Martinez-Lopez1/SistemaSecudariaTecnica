@extends('template')

@section('title','Crear justificante medico')

@push('css')
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Crear justificante de inasistencia medica</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{route('justificante_inasistencia_medico.index')}}">Justificantes de inasistencia medica</a></li>
            <li class="breadcrumb-item active">Crear justificante Medico</li>
        </ol>

    <!-- Formulario -->
    <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
        <form action="{{ route('justificante_inasistencia_medico.store') }}" method="post">
            @csrf

            <div class="row g-3">

                <div class="col-md-6">
                        <label for="matricula" class="form-label">Nombre del Alumno</label>
                        {{-- <input type="number" name="matricula" id="matricula" class="form-control"
                            value="{{ old('matricula') }}"> --}}
                        <select title="Seleccione un alumno..." data-live-search="true" name="matricula" id="matricula"
                            class="form-control selectpicker show-tick">
                            @foreach ($matricula as $item)
                                <option value="{{ $item->matricula }}"{{old('matricula')==$item->matricula ? 'selected': ''}}>{{ $item->matricula }} - {{ $item->nombre }}
                                    {{ $item->apellido }}</option>
                            @endforeach
                        </select>
                        @error('matricula')
                            <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                <input type="hidden" name="expediente_medico_id" id="expediente_medico_id" value="{{ old('expediente_medico_id') }}">

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
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha') }}">
                    @error('fecha')
                        <small class="text-danger">{{ '*' . $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="modulos" class="form-label">Módulos</label>
                    <input type="text" name="modulos" id="modulos" class="form-control" value="{{ old('modulos') }}">
                    @error('modulos')
                        <small class="text-danger">{{ '*' . $message }}</small>
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
     <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

@endpush
