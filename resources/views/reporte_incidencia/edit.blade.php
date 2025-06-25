@extends('template')

@section('Editar Reporte de Incidencia')

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@endpush

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 text-center">Editar Reporte de Incidencia</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{route('reporte_incidencia.index')}}">Reportes de incidencias</a></li>
            <li class="breadcrumb-item active">Editar Reporte</li>
        </ol>

        <!--Formulario para el reporte de un alumno-->
        <div class="container w-100 border border-3 border-secundary rounded p-4 mt-3">
            <form action="{{route('reporte_incidencia.update', ['reporte_incidencium' => $reporte_incidencium])}}" method="post">
                @method('PATCH')
                @csrf
                <div class="row g-3">
                    <!--Nombre de la escueal-->
                    <div class="col-md-12">
                        <p class="text-center">ESCUELA SECUNDARIA TÉCNICA NÚM. 66</p>
                        <p class="text-center">20DST00621</p>
                        <p class="text-center">=  REPORTE DE INCIDENCIAS DE ALUMNOS  =</p>
                    </div>

                    <!--Fecha del reporte-->
                    <div class="col-md-6">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <label for="fecha_reporte" class="form-label">CUILAPAN DE GUERRERO, OAXACA, OAX. A:</label>
                            </div>
                            <div class="col">
                                <input type="date" name="fecha_reporte" id="fecha_reporte" class="form-control" value="{{ old('fecha_reporte', $reporte_incidencium->fecha_reporte) }}">
                            </div>
                            <div class="col-auto">
                                @error('fecha_reporte')
                                    <small class="text-danger">{{ '*' . $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mt-4">
                        <p>COORDINACIÓN DE SERVICIOS EDUCATIVOS COMPLEMENTARIOS </p>
                        <P>P R E S E N T E</P>
                    </div>

                    <!--Matricula del alumno-->
                    <div class="col-md-12">
                        <label for="matricula" class="form-label">COMUNICO A USTED QUE EL ALUMNO (A):</label>
                        <input type="text" id="nombre_alumno" class="form-control"
                        value="{{ $reporte_incidencium->expedienteDisciplinario->alumno->matricula }} - {{ $reporte_incidencium->expedienteDisciplinario->alumno->nombre }} {{ $reporte_incidencium->expedienteDisciplinario->alumno->apellido }}"
                        readonly>
                    </div>

                    <!--Grado del alumno-->
                    <div class="col-md-6">
                        <label for="grado" class="form-label">DEL GRADO</label>
                        <select title="Seleccione un grado..." name="grado" id="grado" class="form-control selectpicker show-tick">
                            @foreach([1, 2, 3] as $grado)
                                <option value="{{ $grado }}" {{ old('grado', $reporte_incidencium->grado) == $grado ? 'selected' : '' }}>{{ $grado }}</option>
                            @endforeach
                        </select>
                        @error('grado')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <!--Grupo alumno-->
                    <div class="col-md-6">
                        <label for="grupo" class="form-label">GRUPO</label>
                        <select title="Seleccione un grupo..."  name="grupo" id="grupo" class="form-control selectpicker show-tick">
                            @foreach(['A', 'B', 'C', 'D', 'E', 'F'] as $grupo)
                                <option value="{{ $grupo }}" {{ old('grupo', $reporte_incidencium->grupo) == $grupo ? 'selected' : '' }}>{{ $grupo }}</option>
                            @endforeach
                        </select>
                        @error('grupo')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    {{-- tipo de falta --}}
                    <div class="form-group">
                        <label for="motivo">INCURRIO EN LA(S) SIGUIENTE(S) FALTA(S):</label>
                        <select title="Seleccione la(s) falta(s)..." name="motivo[]" id="motivo" class="form-control selectpicker" multiple>
                            @php
                                $motivosSeleccionados = old('motivo', json_decode($reporte_incidencium->motivo, true) ?? []);
                            @endphp
                            <option value="No se presentó a clases" {{ in_array('No se presentó a clases', $motivosSeleccionados) ? 'selected' : '' }}>No se presentó a clases</option>
                            <option value="Falta de respeto al personal" {{ in_array('Falta de respeto al personal', $motivosSeleccionados) ? 'selected' : '' }}>Falta de respeto al personal</option>
                            <option value="Por indisciplina en el salón" {{ in_array('Por indisciplina en el salón', $motivosSeleccionados) ? 'selected' : '' }}>Por indisciplina en el salón</option>
                            <option value="No portar adecuadamente el uniforme" {{ in_array('No portar adecuadamente el uniforme', $motivosSeleccionados) ? 'selected' : '' }}>No portar adecuadamente el uniforme</option>
                            <option value="Agredir verbalmente a sus compañeros" {{ in_array('Agredir verbalmente a sus compañeros', $motivosSeleccionados) ? 'selected' : '' }}>Agredir verbalmente a sus compañeros</option>
                            <option value="Destruir el material de sus compañeros" {{ in_array('Destruir el material de sus compañeros', $motivosSeleccionados) ? 'selected' : '' }}>Destruir el material de sus compañeros</option>
                            <option value="Presentar trabajos de mala calidad" {{ in_array('Presentar trabajos de mala calidad', $motivosSeleccionados) ? 'selected' : '' }}>Presentar trabajos de mala calidad</option>
                            <option value="No cumple con sus tareas" {{ in_array('No cumple con sus tareas', $motivosSeleccionados) ? 'selected' : '' }}>No cumple con sus tareas</option>
                            <option value="Se retira de la escuela" {{ in_array('Se retira de la escuela', $motivosSeleccionados) ? 'selected' : '' }}>Se retira de la escuela</option>
                            <option value="Pintar en el inmueble" {{ in_array('Pintar en el inmueble', $motivosSeleccionados) ? 'selected' : '' }}>Pintar en el inmueble</option>
                            <option value="Portar, usar el celular" {{ in_array('Portar, usar el celular', $motivosSeleccionados) ? 'selected' : '' }}>Portar, usar el celular</option>
                            <option value="Traer revistas inadecuadas" {{ in_array('Traer revistas inadecuadas', $motivosSeleccionados) ? 'selected' : '' }}>Traer revistas inadecuadas</option>
                            <option value="Indisciplina en actos cívicos" {{ in_array('Indisciplina en actos cívicos', $motivosSeleccionados) ? 'selected' : '' }}>Indisciplina en actos cívicos</option>
                            <option value="Traer aliento alcohólico o fumar" {{ in_array('Traer aliento alcohólico o fumar', $motivosSeleccionados) ? 'selected' : '' }}>Traer aliento alcohólico o fumar</option>
                            <option value="No trae material de trabajo" {{ in_array('No trae material de trabajo', $motivosSeleccionados) ? 'selected' : '' }}>No trae material de trabajo</option>
                            <option value="Golpear a su compañero" {{ in_array('Golpear a su compañero', $motivosSeleccionados) ? 'selected' : '' }}>Golpear a su compañero</option>
                            <option value="Impuntualidad constante" {{ in_array('Impuntualidad constante', $motivosSeleccionados) ? 'selected' : '' }}>Impuntualidad constante</option>
                            <option value="No asistir al homenaje" {{ in_array('No asistir al homenaje', $motivosSeleccionados) ? 'selected' : '' }}>No asistir al homenaje</option>
                            <option value="Otro" {{ in_array('Otro', $motivosSeleccionados) ? 'selected' : '' }}>Otro</option>
                        </select>
                    </div>

                    <!-- Campo de texto para "Otro" -->
                    <div class="form-group" id="otro-motivo" style="{{ in_array('Otro', $motivosSeleccionados) ? '' : 'display: none;' }}">
                        <label for="motivo_otro">Especificar otra falta:</label>
                        <input type="text" name="motivo_otro" id="motivo_otro" class="form-control" style="width: 300px;" value="{{ old('motivo_otro', $reporte_incidencium->motivo_otro) }}">
                    </div>

                    <!--Modulo en que ocurrio-->
                    <div class="col-md-6">
                        <label for="modulo" class="form-label">EN EL MODULO DE:</label>
                        <input type="text" name="modulo" id="modulo" class="form-control" value="{{ old('modulo', $reporte_incidencium->modulo) }}">
                        @error('modulo')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <!--Hora de la incidencia-->
                    <div class="col-md-6">
                        <label for="hora_clase" class="form-label">A LA HORA</label>
                        <input type="time" name="hora_clase" id="hora_clase" class="form-control"
                               value="{{ old('hora_clase', date('H:i', strtotime($reporte_incidencium->hora_clase))) }}" required>
                        @error('hora_clase')
                            <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <!--Asignatura-->
                    <div class="col-md-6">
                        <label for="asignatura" class="form-label">EN LA ASIGNATURA:</label>
                        <input type="text" name="asignatura" id="asignatura" class="form-control" value="{{ old('asignatura', $reporte_incidencium->asignatura) }}">
                        @error('asignatura')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <!--Nombre de quien lo solicita-->
                    <div class="col-md-6">
                        <label for="nombre_profesor" class="form-label">REPORTÓ:</label>
                        <input placeholder="nombre_profesor" type="text" name="nombre_profesor" id="nombre_profesor" class="form-control" value="{{ old('nombre_profesor', $reporte_incidencium->nombre_profesor) }}">
                        @error('nombre_profesor')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    {{-- campo para observaciones --}}
                    <div class="col-md-6">
                        <label for="observaciones" class="form-label">OBSERVACIONES:</label>
                        <textarea name="observaciones" id="observaciones" class="form-control">{{ old('observaciones', $reporte_incidencium->observaciones) }}</textarea>
                        @error('observaciones')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <a href="{{ route('reporte_incidencia.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
    <script>
        $(document).ready(function() {
            // Escuchar cambios en el select
            $('#motivo').on('change', function() {
                // Verificar si la opción "Otro" está seleccionada
                if ($(this).val() && $(this).val().includes('Otro')) {
                    $('#otro-motivo').show(); // Mostrar el campo de texto
                } else {
                    $('#otro-motivo').hide(); // Ocultar el campo de texto
                    $('#motivo_otro').val(''); // Limpiar el valor del campo
                }
            });
        });
    </script>
@endpush
