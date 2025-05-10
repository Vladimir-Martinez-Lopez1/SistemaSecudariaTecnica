@extends('template')

@section('Crear Citatorio General')

@push('css')
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@endpush


@section('content')

    <div class="container-fluid px-4">

        <h1 class="mt-4 text-center">Crear Citatorio General</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{route('citatorio_general.index')}}">Citatorio</a></li> 
            <li class="breadcrumb-item active">Crear Citatorio </li>
        </ol>
        <!--Formulario para el citatorio de un alumno-->
        <div class="container w-100 border border-3 border-secundary rounded p-4 mt-3">
            <form action="{{route('citatorio_general.store')}}" method="post">
                @csrf
                <div class="row g-3">
                    <!--Nombre de la escueal-->
                    <div class="col-md-12">
                        <p class="text-center">ESCUELA SECUNDARIA TÉCNICA NÚM. 66</p>
                        <p class="text-center">20DST00621</p>
                        <p class="text-center">= CITATORIO GENERAL =</p>
                    </div>

                    <!--Fecha del reporte-->

                    <div class="col-md-6">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <label for="fecha_creacion" class="form-label">CUILAPAN DE GUERRERO, OAXACA, OAX. A:</label>
                            </div>
                            <div class="col">
                                <input type="date" name="fecha_creacion" id="fecha_creacion" class="form-control"
                                    value="{{ old('fecha_creacion') }}">
                            </div>
                            <div class="col-auto">
                                @error('fecha_creacion')
                                    <small class="text-danger">{{ '*' . $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                     <!--Asignatura-->
                     <div class="col-md-12">
                        <label for="asignatura" class="form-label">Por medio del presente el (la)titular de la asignatura de:</label>
                        <input type="text" name="asignatura" id="modulo" class="form-control" value="{{ old('modulo') }}">
                        @error('asignatura')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <!--Grado del alumno-->
                    <div class="col-md-6">
                        <label for="grado" class="form-label">Grado</label>
                        <select title="Seleccione un grado..." name="grado" id="grado" class="form-control selectpicker show-tick">
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
                        <select title="Seleccione un grupo..."  name="grupo" id="grupo" class="form-control selectpicker show-tick">
                            @foreach(['A', 'B', 'C', 'D', 'E', 'F'] as $grupo)
                                <option value="{{ $grupo }}" {{ old('grupo') == $grupo ? 'selected' : '' }}>{{ $grupo }}</option>
                            @endforeach
                        </select>
                        @error('grupo')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <p class="form-control">
                        Le solicitamos su puntual asistencia a las: 
                    </p>
                    <!--Hora para citar al padre de familia-->
                    <div class="col-md-6">
                        <label for="hora_cita" class="form-label">Agradecemos su puntual asistencia a las: </label>
                        <input type="time" name="hora_cita" id="hora_cita" class="form-control" value="{{ old('hora_cita') }}" required> hrs.,
                        @error('hora_cita')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <p class="form-control">
                        del día 
                    </p>
                    <!--Fecha para citar al padre de familia-->
                    <div class="col-md-6">
                        <label for="fecha_cita" class="form-label">del dia: </label>
                        <input type="date" name="fecha_cita" id="fecha_cita" class="form-control" value="{{ old('fecha_cita') }}">
                        @error('fecha_cita')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>


                    <!--Nombre de quien lo solicita-->
                    <div class="col-md-6">
                        <label for="nombre_profesor" class="form-label">PROFR (A):</label>
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