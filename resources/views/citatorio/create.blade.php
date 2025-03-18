@extends('template')

@section('Crear Citatorio')

@push('css')
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@endpush


@section('content')

    <div class="container-fluid px-4">

        <h1 class="mt-4 text-center">Crear Citatorio Individual</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{route('citatorio.index')}}">Citatorio</a></li>
            <li class="breadcrumb-item active">Crear Citatorio </li>
        </ol>
        <!--Formulario para el citatorio de un alumno-->
        <div class="container w-100 border border-3 border-secundary rounded p-4 mt-3">
            <form action="{{route('citatorio.store')}}" method="post">
                @csrf
                <div class="row g-3">
                    <!--Nombre del padre del alumno-->
                    <div class="col-md-6">
                        C.<label for="nombre_padre" class="form-label"> </label>
                        <input placeholder="Nombre del Padre" type="text" name="nombre_padre" id="nombre_padre"
                            class="form-control" value="{{ old('nombre_padre') }}">
                        @error('nombre_padre')
                            <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>
                    <!--Matricula del alumno-->
                    <p class="form-control">
                        Por medio del presente, la titular de la Coordinación de Servicios Educativos Complementarios, en
                        coordinación con la Dirección de la Escuela, de la manera más atenta, le citan con el objetivo de
                        tratar asuntos relacionados con el aprovechamiento académico y conductual de su hijo(a):
                    </p>
                    <div class="col-md-6">
                        <label for="matricula" class="form-label">Nombre del Alumno</label>
                        {{-- <input type="number" name="matricula" id="matricula" class="form-control"
                            value="{{ old('matricula') }}"> --}}
                        <select title="Seleccione un alumno..." data-live-search="true" name="matricula" id="matricula"
                            class="form-control selectpicker show-tick">
                            @foreach ($matricula as $item)
                                <option value="{{ $item->matricula }}">{{ $item->matricula }} - {{ $item->nombre }}
                                    {{ $item->apellido }}</option>
                            @endforeach
                        </select>
                        @error('matricula')
                            <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>
                    <!--Grado del alumno-->
                    <div class="col-md-6">
                        <label for="grado" class="form-label">Grado</label>
                        <select title="Seleccione un grado..." name="grado" id="grado"
                            class="form-control selectpicker show-tick">
                            @foreach([1, 2, 3] as $grado)
                                <option value="{{ $grado }}" {{ old('grado') == $grado ? 'selected' : '' }}>{{ $grado }}</option>
                            @endforeach
                        </select>
                        @error('grado')
                            <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>
                    <!--Grupo alumno-->
                    <div class="col-md-6">
                        <label for="grupo" class="form-label">Grupo</label>
                        <select title="Seleccione un grupo..." name="grupo" id="grupo"
                            class="form-control selectpicker show-tick">
                            @foreach(['A', 'B', 'C', 'D', 'E', 'F'] as $grupo)
                                <option value="{{ $grupo }}" {{ old('grupo') == $grupo ? 'selected' : '' }}>{{ $grupo }}</option>
                            @endforeach
                        </select>
                        @error('grupo')
                            <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <div class="d-flex align-items-center">
                        <!-- Texto -->
                        <p class="form-control mb-0 me-3">
                            Le solicitamos su puntual asistencia a las:
                        </p>
                        <!-- Selector de hora -->
                        <div class="col-md-6">
                            {{-- --}}
                            <div class="col-md-6">
                                {{-- <label for="hora_cita" class="form-label">Agradecemos su puntual asistencia a las: </label> --}}
                                <input type="time" name="hora_cita" id="hora_cita" class="form-control" value="{{ old('hora_cita') }}" required>
                                @error('hora_cita')
                                <small class="text-danger">{{ '*' . $message }}</small>
                                @enderror
                            </div>
                            @error('hora_cita')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <p class="form-control mb-0 me-3">
                            del día
                        </p>
                        <!--Fecha para citar al padre de familia-->
                        <div class="col-md-6">
                            {{-- <label for="fecha_cita" class="form-label">Fecha</label> --}}
                            <input type="date" name="fecha_cita" id="fecha_cita" class="form-control"
                                value="{{ old('fecha_cita') }}">
                            @error('fecha_cita')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <p class="form-control">
                        Agradecemos de antemano su atención y quedamos a su disposición para cualquier duda o aclaración.
                    </p>
                    <!--Nombre de quien lo solicita-->
                    <div class="col-md-6">
                        <label for="nombre_profesor" class="form-label">PROFRA:</label>
                        <input placeholder="nombre_profesor" type="text" name="nombre_profesor" id="nombre_profesor" class="form-control" value="{{ old('nombre_profesor') }}">
                        @error('nombre_profesor')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary"> Guardar</button>

                    </div>

                </div>
            </form>

        </div>
    </div>

@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

@endpush