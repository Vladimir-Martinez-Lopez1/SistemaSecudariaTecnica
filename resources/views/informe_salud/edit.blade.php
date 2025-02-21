@extends('template')

@section('title', 'Editar Informe Médico')

@push('css')
    
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Editar Informe Médico</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('informe_salud.index') }}">Informes de salud</a></li>
        <li class="breadcrumb-item active">Editar informe de salud</li>          
    </ol>

    <!-- Formulario -->
    <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
        <form action="{{ route('informe_salud.update', $informe_salud->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="row g-3">

                <!-- Matrícula (solo lectura) -->
                <div class="col-md-6">
                    <label for="matricula" class="form-label">Matrícula</label>
                    <input type="text" name="matricula" id="matricula" class="form-control" value="{{ $informe_salud->expedienteMedico->alumno->matricula }}" readonly>
                </div>

                <!-- Grado -->
                <div class="col-md-6">
                    <label for="grado" class="form-label">Grado</label>
                    <select name="grado" id="grado" class="form-control">
                        <option value="">Seleccione...</option>
                        @foreach(['1', '2', '3', '4', '5', '6'] as $grado)
                            <option value="{{ $grado }}" {{ old('grado', $informe_salud->grado) == $grado ? 'selected' : '' }}>
                                {{ $grado }}
                            </option>
                        @endforeach
                    </select>
                    @error('grado')
                        <small class="text-danger">{{ '*' . $message }}</small>
                    @enderror
                </div>

                <!-- Grupo -->
                <div class="col-md-6">
                    <label for="grupo" class="form-label">Grupo</label>
                    <select name="grupo" id="grupo" class="form-control">
                        <option value="">Seleccione...</option>
                        @foreach(['A', 'B', 'C', 'D'] as $grupo)
                            <option value="{{ $grupo }}" {{ old('grupo', $informe_salud->grupo) == $grupo ? 'selected' : '' }}>
                                {{ $grupo }}
                            </option>
                        @endforeach
                    </select>
                    @error('grupo')
                        <small class="text-danger">{{ '*' . $message }}</small>
                    @enderror
                </div>

                <!-- Fecha -->
                <div class="col-md-6">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha', $informe_salud->fecha) }}">
                    @error('fecha')
                        <small class="text-danger">{{ '*' . $message }}</small>
                    @enderror
                </div>

                <!-- Diagnóstico -->
                <div class="col-md-6">
                    <label for="diagnostico" class="form-label">Diagnóstico</label>
                    <input type="text" name="diagnostico" id="diagnostico" class="form-control" value="{{ old('diagnostico', $informe_salud->diagnostico) }}">
                    @error('diagnostico')
                        <small class="text-danger">{{ '*' . $message }}</small>
                    @enderror
                </div>

                <!-- Motivo -->
                <div class="col-md-6">
                    <label for="motivo" class="form-label">Motivo</label>
                    <input type="text" name="motivo" id="motivo" class="form-control" value="{{ old('motivo', $informe_salud->motivo) }}">
                    @error('motivo')
                        <small class="text-danger">{{ '*' . $message }}</small>
                    @enderror
                </div>

                <!-- Fecha Inicio -->
                <div class="col-md-6">
                    <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
                    <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" value="{{ old('fecha_inicio', $informe_salud->fecha_inicio) }}">
                    @error('fecha_inicio')
                        <small class="text-danger">{{ '*' . $message }}</small>
                    @enderror
                </div>

                <!-- Fecha Final -->
                <div class="col-md-6">
                    <label for="fecha_final" class="form-label">Fecha Final</label>
                    <input type="date" name="fecha_final" id="fecha_final" class="form-control" value="{{ old('fecha_final', $informe_salud->fecha_final) }}">
                    @error('fecha_final')
                        <small class="text-danger">{{ '*' . $message }}</small>
                    @enderror
                </div>

                <!-- Recomendaciones -->
                <div class="col-md-6">
                    <label for="recomendaciones" class="form-label">Recomendaciones</label>
                    <textarea name="recomendaciones" id="recomendaciones" class="form-control">{{ old('recomendaciones', $informe_salud->recomendaciones) }}</textarea>
                    @error('recomendaciones')
                        <small class="text-danger">{{ '*' . $message }}</small>
                    @enderror
                </div>

            
                <!-- Nombre del Médico -->
                <div class="col-md-6">
                    <label for="nombre_medico" class="form-label">Nombre del Médico</label>
                    <select name="nombre_medico" id="nombre_medico" class="form-control">
                        <option value="">Seleccione...</option>
                        @foreach(['DoctorA', 'DoctorB'] as $medico)
                            <option value="{{ $medico }}" {{ old('nombre_medico', $informe_salud->nombre_medico) == $medico ? 'selected' : '' }}>
                                {{ $medico }}
                            </option>
                        @endforeach
                    </select>
                    @error('nombre_medico')
                        <small class="text-danger">{{ '*' . $message }}</small>
                    @enderror
                </div>
                

                <!-- Botón de Guardar -->
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