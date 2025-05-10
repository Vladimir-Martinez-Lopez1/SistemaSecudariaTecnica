@extends('template')

@section('Editar Citatorio General')

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@endpush


@section('content')

    <div class="container-fluid px-4">

        <h1 class="mt-4 text-center">Editar Citatorio General</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{route('citatorio_general.index')}}">Citatorio General</a></li>
            <li class="breadcrumb-item active">Editar Citatorio</li>
        </ol>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!--Formulario para el citatorio general-->
        <div class="container w-100 border border-3 border-secundary rounded p-4 mt-3">
            <form action="{{ route('citatorio_general.update', ['citatorio_general' => $citatorio_general]) }}" method="post">
                @method('PATCH')
                @csrf
                <div class="row g-3">
                    <!--Nombre de la escuela-->
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
                                    value="{{ old('fecha_creacion', $citatorio_general->fecha_creacion) }}">
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
                        <input type="text" name="asignatura" id="asignatura" class="form-control"
                            value="{{ old('asignatura', $citatorio_general->asignatura) }}">
                        @error('asignatura')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <!--Grado del alumno-->
                    <div class="col-md-6">
                        <label for="grado" class="form-label">Grado</label>
                        <select title="Seleccione un grado..." name="grado" id="grado" class="form-control selectpicker show-tick">
                            @foreach([1, 2, 3] as $grado)
                                <option value="{{ $grado }}" {{ old('grado', $citatorio_general->grado) == $grado ? 'selected' : '' }}>
                                    {{ $grado }}
                                </option>
                            @endforeach
                        </select>
                        @error('grado')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <!--Grupo alumno-->
                    <div class="col-md-6">
                        <label for="grupo" class="form-label">Grupo</label>
                        <select title="Seleccione un grupo..." name="grupo" id="grupo" class="form-control selectpicker show-tick">
                            @foreach(['A', 'B', 'C', 'D', 'E', 'F'] as $grupo)
                                <option value="{{ $grupo }}" {{ old('grupo', $citatorio_general->grupo) == $grupo ? 'selected' : '' }}>
                                    {{ $grupo }}
                                </option>
                            @endforeach
                        </select>
                        @error('grupo')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <!--Hora para citar al padre de familia-->
                    <div class="col-md-6">
                        <label for="hora_cita" class="form-label">Agradecemos su puntual asistencia a las:</label>
                        <input type="time" name="hora_cita" id="hora_cita" class="form-control"
                               value="{{ old('hora_cita', date('H:i', strtotime($citatorio_general->hora_cita))) }}" required>
                        @error('hora_cita')
                            <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <!--Fecha para citar al padre de familia-->
                    <div class="col-md-6">
                        <label for="fecha_cita" class="form-label">del dia: </label>
                        <input type="date" name="fecha_cita" id="fecha_cita" class="form-control"
                            value="{{ old('fecha_cita', $citatorio_general->fecha_cita) }}">
                        @error('fecha_cita')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <!--Nombre de quien lo solicita-->
                    <div class="col-md-6">
                        <label for="nombre_profesor" class="form-label">PROFR (A):</label>
                        <input placeholder="nombre_profesor" type="text" name="nombre_profesor" id="nombre_profesor"
                            class="form-control" value="{{ old('nombre_profesor', $citatorio_general->nombre_profesor) }}">
                        @error('nombre_profesor')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <a href="{{ route('citatorio_general.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('js')
 {{-- <script>
            $(document).ready(function () {
                $('form').on('submit', function (event) {
                    // Evitar que el formulario se envíe inmediatamente
                    event.preventDefault();

                    // Capturar los datos del formulario
                    const formData = $(this).serializeArray();

                    // Mostrar los datos en la consola
                    console.log("Datos del formulario:");
                    formData.forEach(function (item) {
                        console.log(item.name + ": " + item.value);
                    });

                    // Opcional: Enviar el formulario manualmente después de verificar los datos
                    // $(this).unbind('submit').submit();
                });
            });
        </script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
@endpush
