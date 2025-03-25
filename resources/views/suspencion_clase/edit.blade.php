@extends('template')

@section('Editar Documento de suspencion')

@push('css')
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@endpush

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 text-center">Editar Suspencion de clases</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('citatorio.index') }}">Suspención de clases</a></li>
            <li class="breadcrumb-item active">Editar Documento</li>
        </ol>

        <!-- Formulario para el citatorio de un alumno -->
        <div class="container w-100 border border-3 border-secundary rounded p-4 mt-3">
            <form action="{{ route('suspencion_clase.update', ['suspencion_clase' => $suspencion_clase]) }}" method="post">
                @method('PATCH')
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
                                <label for="fecha_suspencion" class="form-label">CUILAPAN DE GUERRERO, OAXACA, OAX. A:</label>
                            </div>
                            <div class="col">
                                <input type="date" name="fecha_suspencion" id="fecha_suspencion" class="form-control"
                                    value="{{ old('fecha_suspencion', $suspencion_clase->fecha_suspencion) }}">
                            </div>
                            <div class="col-auto">
                                @error('fecha_suspencion')
                                    <small class="text-danger">{{ '*' . $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        C.
                        <input type="text" name="nombre_padre" id="nombre_padre" placeholder="Nombre del Padre"
                            class="form-control" value="{{ old('nombre_padre', $suspencion_clase->nombre_padre) }}">
                        <label for="nombre_padre" class="form-label">NOMBRE DEL (A) PADRE, MADRE O TUTOR (A): </label>
                        @error('nombre_padre')
                            <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <!--Matricula del alumno-->
                    <div class="col-md-12">
                        <label for="matricula" class="form-label">La Coordinación de Servicios Educativos Complementarios, en coordinación con la Dirección de la Escuela Secundaria Técnica No. 66 con clave 20DST00621, por medio del presente comunica a usted que el alumno (a):</label>
                        <input type="text" id="nombre_alumno" class="form-control"
                            value="{{ $suspencion_clase->expedienteDisciplinario->alumno->matricula }} - {{ $suspencion_clase->expedienteDisciplinario->alumno->nombre }} {{ $suspencion_clase->expedienteDisciplinario->alumno->apellido }}"
                            readonly>
                    </div>

                    <!--Grado del alumno-->
                    <div class="col-md-6">
                        <label for="grado" class="form-label">GRADO</label>
                        <select title="Seleccione un grado..." name="grado" id="grado" class="form-control selectpicker show-tick">
                            @foreach([1, 2, 3] as $grado)
                                <option value="{{ $grado }}" {{ old('grado', $suspencion_clase->grado) == $grado ? 'selected' : '' }}>
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
                        <label for="grupo" class="form-label">GRUPO</label>
                        <select name="grupo" id="grupo" class="form-control">
                            <option value="">Seleccione...</option>
                            @foreach(['A', 'B', 'C', 'D', 'E', 'F'] as $grupo)
                                <option value="{{ $grupo }}" {{ old('grupo', $suspencion_clase->grupo) == $grupo ? 'selected' : '' }}>
                                    {{ $grupo }}
                                </option>
                            @endforeach
                        </select>
                        @error('grupo')
                            <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    {{-- Motivo de la suspencion --}}
                    <div class="col-md-12">
                        <label for="motivo" class="form-label">Violó el Reglamento Interno fundamentado en el acuerdo 97, donde se establece la organización y funcionamiento de la escuela, al que se sujetará el alumnado, por el motivo:</label>
                        <textarea name="motivo" id="motivo" class="form-control">{{ old('motivo', $suspencion_clase->motivo) }}</textarea>
                        @error('motivo')
                            <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    {{-- CAPITULO, ARTICULO, FRACCION E INCISO --}}
                    <div class="col-md-6">
                        <label for="capitulo" class="form-label">Que lo establece el Capítulo: </label>
                        <input type="text" name="capitulo" id="capitulo" class="form-control"
                            value="{{ old('capitulo', $suspencion_clase->capitulo) }}" required>
                        @error('capitulo')
                            <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="articulo" class="form-label">Artículo: </label>
                        <input type="text" name="articulo" id="articulo" class="form-control"
                            value="{{ old('articulo', $suspencion_clase->articulo) }}" required>
                        @error('articulo')
                            <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="fraccion" class="form-label">Fracción: </label>
                        <input type="text" name="fraccion" id="fraccion" class="form-control"
                            value="{{ old('fraccion', $suspencion_clase->fraccion) }}" required>
                        @error('fraccion')
                            <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="inciso" class="form-label">Inciso: </label>
                        <input type="text" name="inciso" id="inciso" class="form-control"
                            value="{{ old('inciso', $suspencion_clase->inciso) }}" required>
                        @error('inciso')
                            <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    {{-- numero de dias de suspencion --}}
                    <div class="col-md-6">
                        <label for="numero_dias" class="form-label">Se hace acreedor a una sanción disciplinaria correspondiente a</label>
                        <input type="number" name="numero_dias" id="numero_dias" class="form-control"
                            value="{{ old('numero_dias', $suspencion_clase->numero_dias) }}">
                        @error('numero_dias')
                            <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    {{-- fecha de incio de la suspencion --}}
                    <div class="col-md-6">
                        <label for="fecha_inicio" class="form-label">iniciando el:</label>
                        <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control"
                            value="{{ old('fecha_inicio', $suspencion_clase->fecha_inicio) }}">
                        @error('fecha_inicio')
                            <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <p>
                            Por lo que se le comunica, para su conocimiento e intervención en el mejoramiento conductual de su hijo (a).
                        </p>
                    </div>

                    <div class="col-md-6">
                        EL ASESOR DEL GRUPO:
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <label for="nombre_profesor" class="form-label">PROFR (A) A:</label>
                            </div>
                            <div class="col">
                                <input type="text" name="nombre_profesor" id="nombre_profesor" class="form-control"
                                    value="{{ old('nombre_profesor', $suspencion_clase->nombre_profesor) }}">
                            </div>
                            <div class="col-auto">
                                @error('nombre_profesor')
                                    <small class="text-danger">{{ '*' . $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <a href="{{ route('suspencion_clase.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
@endpush