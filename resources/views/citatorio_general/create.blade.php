@extends('template')

@section('Crear Citatorio')

@push('css')
    
@endpush


@section('content')

<div class="container-fluid px-4">

    <h1 class="mt-4 text-center">Crear Citatorio general</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{route('citatorio_general.index')}}">Citatorio</a></li> 
        <li class="breadcrumb-item active">Crear Citatorio </li>
    </ol>
    <!--Formulario para el citatorio de un alumno-->
    <div class="container w-100 border border-3 border-secundary rounded p-4 mt-3">
        <form action="" method="post">
            <div class="row g-3">
                <!--Nombre del padre del alumno-->
                <div class="col-md-6">
                    C.<label for="nombre_padre" class="form-label" placeholder="Nombre del Padre"> </label>
                    <input type="text" name="nombre_padre" id="nombre_padre" class="form-control">
                    @error('nombre_padre')
                    <small class="text-danger">{{ '*'.$message }}</small>
                    @enderror
                </div>
                <!--Matricula del alumno-->
                <p>
                    Por medio del presente, la titular de la Coordinación de Servicios Educativos Complementarios, en coordinación con la Dirección de la Escuela, de la manera más atenta, le citan con el objetivo de tratar asuntos relacionados con el aprovechamiento académico y conductual de su hijo(a):
                </p>    
                <div class="col-md-6">
                    <label for="matricula" class="form-label">Matrícula del Alumno</label>
                    <input type="number" name="matricula" id="matricula" class="form-control" value="{{ old('matricula') }}">
                    @error('matricula')
                    <small class="text-danger">{{ '*'.$message }}</small>
                    @enderror
                </div>
                <!--Grado del alumno-->
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
                <!--Grupo alumno-->
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

                <p>
                    Le solicitamos su puntual asistencia a las: 
                </p>
                <!--Hora para citar al padre de familia-->
                <div class="col-md-6">
                    <label for="hora_cita" class="form-label">Hora</label>
                    <select name="hora_cita" id="hora_cita" class="form-control">
                        <option value="">Seleccione...</option>
                        @foreach([8,9,10,11,12,13,14,15,16] as $hora_cita)
                            <option value="{{ $hora_cita }}" {{ old('hora_cita') == $hora_cita ? 'selected' : '' }}>{{ $hora_cita }}</option>
                        @endforeach
                    </select>
                    @error('hora_cita')
                    <small class="text-danger">{{ '*'.$message }}</small>
                    @enderror
                </div>
                <p>
                    del día 
                </p>
                <!--Fecha para citar al padre de familia-->
                <div class="col-md-6">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha') }}">
                    @error('fecha')
                    <small class="text-danger">{{ '*'.$message }}</small>
                    @enderror
                </div>
                <p>
                    Agradecemos de antemano su atención y quedamos a su disposición para cualquier duda o aclaración.
                </p>
    
            </div>
        </form>

    </div>
</div>

@endsection

@push('js')
    
@endpush