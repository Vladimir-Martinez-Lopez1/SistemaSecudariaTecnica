@extends('template')

@section('Crear suspencion')


@push('css')
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@endpush



@section('content')

    <div class="container-fluid px-4">

        <h1 class="mt-4 text-center">Crear Documento de Suspención de Clases</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{route('suspencion_clase.index')}}">suspencion de clases</a></li>
            <li class="breadcrumb-item active">Crear Documento </li>
        </ol>
        <!--Formulario para el Documento de suspencion-->
        <div class="container w-100 border border-3 border-secundary rounded p-4 mt-3">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="container w-100 border border-3 border-secundary rounded p-4 mt-3">
                <form action="{{route('reporte_incidencia.store')}}" method="post">
                    @csrf
                    <div class="row g-3">
                        <!--Nombre de la escueal-->
                        <div class="col-md-12">
                            <p class="text-center">ESCUELA SECUNDARIA TÉCNICA NÚM. 66</p>
                            <p class="text-center">20DST00621</p>
                            <p class="text-center">ASUNTO: SUSPENCIÓN DE CLASES</p>
                        </div>

                        <!--Fecha del documento-->

                        <div class="col-md-6">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <label for="fecha_reporte" class="form-label">CUILAPAN DE GUERRERO, OAXACA, OAX.
                                        A:</label>
                                </div>
                                <div class="col">
                                    <input type="date" name="fecha_reporte" id="fecha_reporte" class="form-control"
                                        value="{{ old('fecha_reporte') }}">
                                </div>
                                <div class="col-auto">
                                    @error('fecha_reporte')
                                        <small class="text-danger">{{ '*' . $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        
                        <!--Matricula del alumno-->
                        <div class="col-md-9">

                            <label for="matricula" class="form-label">COMUNICO A USTED QUE EL ALUMNO (A):</label>
                            {{-- <input type="number" name="matricula" id="matricula" class="form-control"
                                value="{{ old('matricula') }}"> --}}
                            <select title="Seleccione un alumno..." data-live-search="true" name="matricula" id="matricula"
                                class="form-control selectpicker show-tick">
                                @foreach ($matricula as $item)
                                    <option value="{{ $item->matricula }}">{{ $item->matricula }} - {{ $item->nombre }}
                                        {{ $item->apellido }}</option>
                                @endforeach
                                <P>P R E S E N T E</P>
                            </select>
                            @error('matricula')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                        </div>


                        <!--Grado del alumno-->
                        <div class="col-md-6">
                            <label for="grado" class="form-label">DEL GRADO</label>
                            <select title="Seleccione un grado..." name="grado" id="grado"
                                class="form-control selectpicker show-tick">
                                @foreach([1, 2, 3] as $grado)
                                    <option value="{{ $grado }}" {{ old('grado') == $grado ? 'selected' : '' }}>{{ $grado }}
                                    </option>
                                @endforeach
                            </select>
                            @error('grado')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                        <!--Grupo alumno-->
                        <div class="col-md-6">
                            <label for="grupo" class="form-label">GRUPO</label>
                            <select title="Seleccione un grupo..." name="grupo" id="grupo"
                                class="form-control selectpicker show-tick">
                                @foreach(['A', 'B', 'C', 'D', 'E', 'F'] as $grupo)
                                    <option value="{{ $grupo }}" {{ old('grupo') == $grupo ? 'selected' : '' }}>{{ $grupo }}
                                    </option>
                                @endforeach
                            </select>
                            @error('grupo')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                        </div>

                        {{-- tipo de falta --}}
                        <div class="form-group">
                            <label for="motivo">INCURRIO EN LA(S) SIGUIENTE(S) FALTA(S):</label>
                            <select title="Seleccione la(s) falta(s)..." name="motivo[]" id="motivo"
                                class="form-control selectpicker" multiple>
                                <option value="No se presentó a clases">No se presentó a clases</option>
                                <option value="Falta de respeto al personal">Falta de respeto al personal</option>
                                <option value="Por indisciplina en el salón">Por indisciplina en el salón</option>
                                <option value="No portar adecuadamente el uniforme">No portar adecuadamente el uniforme
                                </option>
                                <option value="Agredir verbalmente a sus compañeros">Agredir verbalmente a sus compañeros
                                </option>
                                <option value="Destruir el material de sus compañeros">Destruir el material de sus
                                    compañeros</option>
                                <option value="Presentar trabajos de mala calidad">Presentar trabajos de mala calidad
                                </option>
                                <option value="No cumple con sus tareas">No cumple con sus tareas</option>
                                <option value="Se retira de la escuela">Se retira de la escuela</option>
                                <option value="Pintar en el inmueble">Pintar en el inmueble</option>
                                <option value="Portar, usar el celular">Portar, usar el celular</option>
                                <option value="Traer revistas inadecuadas">Traer revistas inadecuadas</option>
                                <option value="Indisciplina en actos cívicos">Indisciplina en actos cívicos</option>
                                <option value="Traer aliento alcohólico o fumar">Traer aliento alcohólico o fumar</option>
                                <option value="No trae material de trabajo">No trae material de trabajo</option>
                                <option value="Golpear a su compañero">Golpear a su compañero</option>
                                <option value="Impuntualidad constante">Impuntualidad constante</option>
                                <option value="No asistir al homenaje">No asistir al homenaje</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>

                        <!-- Campo de texto para "Otro" -->
                        <div class="form-group" id="otro-motivo" style="display: none;">
                            <label for="motivo_otro">Especificar otra falta:</label>
                            <input type="text" name="motivo_otro" id="motivo_otro" class="form-control"
                                style="width: 300px;">
                        </div>

                        <!--Modulo en que ocurrio-->
                        <div class="col-md-6">
                            <label for="modulo" class="form-label">EN EL MODULO DE:</label>
                            <input type="text" name="modulo" id="modulo" class="form-control" value="{{ old('modulo') }}">
                            @error('modulo')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                        </div>

                        <!--Hora de la incidencia-->
                        <div class="col-md-6">
                            <label for="hora_clase" class="form-label">A LA HORA</label>
                            <input type="time" name="hora_clase" id="hora_clase" class="form-control"
                                value="{{ old('hora_clase') }}" required>
                            @error('hora_clase')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                        </div>


                        <!--Asignatura-->
                        <div class="col-md-6">
                            <label for="asignatura" class="form-label">EN LA ASIGNATURA:</label>
                            <input type="text" name="asignatura" id="modulo" class="form-control"
                                value="{{ old('modulo') }}">
                            @error('asignatura')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                        </div>



                        <!--Nombre de quien lo solicita-->
                        <div class="col-md-6">
                            <label for="nombre_profesor" class="form-label">REPORTÓ:</label>
                            <input placeholder="nombre_profesor" type="text" name="nombre_profesor" id="nombre_profesor"
                                class="form-control" value="{{ old('nombre_profesor') }}">
                            @error('nombre_profesor')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                        </div>

                        {{-- campo para observaciones --}}
                        <div class="col-md-6">
                            <label for="observaciones" class="form-label">OBSERVACIONES:</label>
                            <textarea name="observaciones" id="observaciones" class="form-control"
                                value=value="{{ old('nombre_profesor') }}"></textarea>
                            @error('observaciones')
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
    </div>

@endsection

@push('js')


    {{--
    <script>
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