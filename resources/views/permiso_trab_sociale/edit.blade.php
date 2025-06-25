@extends('template')

@section('Editar Permiso Ausencia')

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@endpush


@section('content')

    <div class="container-fluid px-4">

        <h1 class="mt-4 text-center">Editar permiso de ausencia</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{route('permiso_trab_sociale.index')}}">Permiso Ausencia</a></li>
            <li class="breadcrumb-item active">Editar Permiso</li>
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
        <!--Formulario para el reporte de un alumno-->
        <div class="container w-100 border border-3 border-secundary rounded p-4 mt-3">
            <form action="{{ route('permiso_trab_sociale.update', ['permiso_trab_sociale' => $permiso_trab_sociale]) }}" method="post">
                @method('PATCH')
                @csrf
                <div class="row g-3">
                    <!--Nombre de la escueal-->
                    <div class="col-md-12">
                        <p class="text-center">ESCUELA SECUNDARIA TÉCNICA NÚM. 66</p>
                        <p class="text-center">20DST00621</p>
                        <p class="text-center">= PERMISO DE AUSENCIA =</p>
                    </div>

                    <!--Fecha del reporte-->
                    <div class="col-md-6">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <label for="fecha_reporte" class="form-label">CUILAPAN DE GUERRERO, OAXACA, OAX. A:</label>
                            </div>
                            <div class="col">
                                <input type="date" name="fecha_reporte" id="fecha_reporte" class="form-control"
                                    value="{{ old('fecha_reporte', $permiso_trab_sociale->fecha_reporte) }}">
                            </div>
                            <div class="col-auto">
                                @error('fecha_reporte')
                                    <small class="text-danger">{{ '*' . $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mt-4">
                        <p>C.C. PERSONAL DOCENTE </p>
                        <P>DE ESTA INSTITUCION</P>
                        <P>P R E S E N T E</P>
                    </div>

                    <!--Matricula del alumno-->
                    <div class="col-md-12">
                        <label for="matricula" class="form-label">El Departamento de Trabajo Social se permite comunicar a
                            usted que el alumno(a):</label>
                        <input type="text" id="nombre_alumno" class="form-control"
                            value="{{ $permiso_trab_sociale->expedienteDisciplinario->alumno->matricula }} - {{ $permiso_trab_sociale->expedienteDisciplinario->alumno->nombre }} {{ $permiso_trab_sociale->expedienteDisciplinario->alumno->apellido }}"
                            readonly>
                    </div>

                    <!--Grado del alumno-->
                    <div class="col-md-6">
                        <label for="grado" class="form-label">del grado</label>
                        <select title="Seleccione un grado..." name="grado" id="grado"
                            class="form-control selectpicker show-tick">
                            @foreach([1, 2, 3] as $grado)
                                <option value="{{ $grado }}" {{ old('grado', $permiso_trab_sociale->grado) == $grado ? 'selected' : '' }}>{{ $grado }}</option>
                            @endforeach
                        </select>
                        @error('grado')
                            <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <!--Grupo alumno-->
                    <div class="col-md-6">
                        <label for="grupo" class="form-label">grupo</label>
                        <select title="Seleccione un grupo..." name="grupo" id="grupo"
                            class="form-control selectpicker show-tick">
                            @foreach(['A', 'B', 'C', 'D', 'E', 'F'] as $grupo)
                                <option value="{{ $grupo }}" {{ old('grupo', $permiso_trab_sociale->grupo) == $grupo ? 'selected' : '' }}>{{ $grupo }}</option>
                            @endforeach
                        </select>
                        @error('grupo')
                            <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    {{-- Motivo del pase --}}
                    <div class="col-md-12">
                        <label for="motivo" class="form-label">por el motivo</label>
                        <textarea name="motivo" id="motivo" class="form-control">{{ old('motivo', $permiso_trab_sociale->motivo) }}</textarea>
                        @error('motivo')
                            <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    {{-- numero de dias de suspencion --}}
                    <div class="col-md-6">
                        <label for="numero_dias" class="form-label">tendrá permiso el (los) día(s)</label>
                        <input type="number" name="numero_dias" id="numero_dias" class="form-control"
                            value="{{ old('numero_dias', $permiso_trab_sociale->numero_dias) }}">
                        @error('numero_dias')
                            <small class="text-danger">{{'*' . $message}}</small>
                        @enderror
                    </div>

                    {{-- fecha de incio de la suspencion --}}
                    <div class="col-md-6">
                        <label for="fecha_inicio" class="form-label">iniciando el:</label>
                        <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control"
                            value="{{ old('fecha_inicio', $permiso_trab_sociale->fecha_inicio) }}">
                        @error('fecha_inicio')
                            <small class="text-danger">{{'*' . $message}}</small>
                        @enderror
                    </div>

                    <!--Nombre de quien lo solicita-->
                    <div class="col-md-6">
                        <label for="nombre_padre" class="form-label">PADRE O TUTOR:</label>
                        <input placeholder="nombre_padre" type="text" name="nombre_padre" id="nombre_padre" class="form-control"
                            value="{{ old('nombre_padre', $permiso_trab_sociale->nombre_padre) }}">
                        @error('nombre_padre')
                            <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary"> Guardar</button>
                        <a href="{{ route('permiso_trab_sociale.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

    <script>
        $(document).ready(function () {
            // Escuchar cambios en el select
            $('#motivo').on('change', function () {
                // Verificar si la opción "Otro" está seleccionada
                if ($(this).val() && $(this).val().includes('Otro')) {
                    $('#otro-motivo').show(); // Mostrar el campo de texto
                } else {
                    $('#otro-motivo').hide(); // Ocultar el campo de texto
                    $('#motivos_otro').val(''); // Limpiar el valor del campo
                }
            });
        });
    </script>
@endpush
