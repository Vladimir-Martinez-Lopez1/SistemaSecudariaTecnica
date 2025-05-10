@extends('template')

@section('Crear Citatorio')

@push('css')
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@endpush

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 text-center">Editar Citatorio Individual</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('citatorio.index') }}">Citatorio</a></li>
            <li class="breadcrumb-item active">Editar Citatorio</li>
        </ol>

        <!-- Formulario para el citatorio de un alumno -->
        <div class="container w-100 border border-3 border-secundary rounded p-4 mt-3">
            <form action="{{ route('citatorio.update',['citatorio'=>$citatorio] ) }}" method="post">
                @method('PATCH')
                @csrf
                <div class="row g-3">
                    <!-- Nombre del padre -->
                    <div class="col-md-6">
                        C.<label for="nombre_padre" class="form-label">Nombre del padre</label>
                        <input placeholder="Nombre del Padre" type="text" name="nombre_padre" id="nombre_padre"
                            class="form-control" value="{{ old('nombre_padre', $citatorio->nombre_padre) }}">
                        @error('nombre_padre')
                            <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <!-- Nombre del Alumno -->
                    <div class="col-md-6">
                        <label for="nombre_alumno" class="form-label">Nombre del Alumno</label>
                        <input type="text" id="nombre_alumno" class="form-control"
                            value="{{ $citatorio->expedienteDisciplinario->alumno->matricula }} - {{ $citatorio->expedienteDisciplinario->alumno->nombre }} {{ $citatorio->expedienteDisciplinario->alumno->apellido }}"
                            readonly>
                    </div>

                    <!-- Expediente disciplinario (oculto) -->
                    <input type="hidden" name="expediente_disciplinario_id" id="expediente_disciplinario_id"
                        value="{{ old('expediente_disciplinario_id', $citatorio->expediente_disciplinario_id) }}">

                    <!-- Grado -->
                    <div class="col-md-6">
                        <label for="grado" class="form-label">Grado</label>
                        <select title="Seleccione un grado..." name="grado" id="grado"
                            class="form-control selectpicker show-tick">
                            @foreach([1, 2, 3] as $grado)
                                <option value="{{ $grado }}" {{ old('grado', $citatorio->grado) == $grado ? 'selected' : '' }}>
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
                            @foreach(['A', 'B', 'C', 'D', 'E', 'F'] as $grupo)
                                <option value="{{ $grupo }}" {{ old('grupo', $citatorio->grupo) == $grupo ? 'selected' : '' }}>
                                    {{ $grupo }}
                                </option>
                            @endforeach
                        </select>
                        @error('grupo')
                            <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <!-- Hora de la cita -->
                    <div class="d-flex align-items-center">
                        <p class="form-control mb-0 me-3">Le solicitamos su puntual asistencia a las:</p>
                        <div class="col-md-6">
                            <input type="time" name="hora_cita" id="hora_cita" class="form-control"
                                value="{{ old('hora_cita', $citatorio->hora_cita) }}" required>
                            @error('hora_cita')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Fecha de la cita -->
                    <div class="col-md-6">
                        <label for="fecha_cita" class="form-label">Fecha de la cita</label>
                        <input type="date" name="fecha_cita" id="fecha_cita" class="form-control"
                            value="{{ old('fecha_cita', $citatorio->fecha_cita) }}">
                        @error('fecha_cita')
                            <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <!-- Nombre del profesor -->
                    <div class="col-md-6">
                        <label for="nombre_profesor" class="form-label">PROFRA:</label>
                        <input placeholder="Nombre del Profesor" type="text" name="nombre_profesor" id="nombre_profesor"
                            class="form-control" value="{{ old('nombre_profesor', $citatorio->nombre_profesor) }}">
                        @error('nombre_profesor')
                            <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <!-- Botones -->
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <a href="{{ route('citatorio.index') }}" class="btn btn-secondary">Cancelar</a>
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
    </script>  --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
@endpush