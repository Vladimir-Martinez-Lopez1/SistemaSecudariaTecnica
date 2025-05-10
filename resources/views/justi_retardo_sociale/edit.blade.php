@extends('template')

@section('Editar JustificadoRetardoSociale')

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@endpush


@section('content')

    <div class="container-fluid px-4">

        <h1 class="mt-4 text-center">Editar Justificante de Retardo</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{route('justi_retardo_sociale.index')}}">Justificante de retardo</a></li>
            <li class="breadcrumb-item active">Editar Justificante</li>
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
        <!--Formulario para el citatorio de un alumno-->
        <div class="container w-100 border border-3 border-secundary rounded p-4 mt-3">
            <form action="{{ route('justi_retardo_sociale.update', ['justi_retardo_sociale' => $justi_retardo_sociale]) }}" method="post">
                @method('PATCH')
                @csrf

                <div class="row g-3">
                    <div class="col-md-12">
                        <p class="text-center">ESCUELA SECUNDARIA TÉCNICA NÚM. 66</p>
                        <p class="text-center">20DST00621</p>
                        <p class="text-center">COORDINACIÓN DE SERVICIOS EDUCATIVOS COMPLEMENTARIOS</p>
                        <p class="text-center"> TRABAJO SOCIAL </p>
                    </div>

                    <!--Matricula del alumno-->
                    <div class="col-md-12">
                        <label for="matricula" class="form-label">POR ESTE MEDIO SOLICITO DE SU APOYO PARA QUE EL ALUMNO:</label>
                        <input type="text" id="nombre_alumno" class="form-control"
                            value="{{ $justi_retardo_sociale->expedienteDisciplinario->alumno->matricula }} - {{ $justi_retardo_sociale->expedienteDisciplinario->alumno->nombre }} {{ $justi_retardo_sociale->expedienteDisciplinario->alumno->apellido }}"
                            readonly>
                    </div>

                    <!--Grado del alumno-->
                    <div class="col-md-6">
                        <label for="grado" class="form-label">DEL GRADO</label>
                        <select title="Seleccione un grado..." name="grado" id="grado" class="form-control selectpicker show-tick">
                            @foreach([1, 2, 3] as $grado)
                                <option value="{{ $grado }}" {{ old('grado', $justi_retardo_sociale->grado) == $grado ? 'selected' : '' }}>
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
                        <label for="grupo" class="form-label">GRUPO</label>
                        <select title="Seleccione un grupo..." name="grupo" id="grupo" class="form-control selectpicker show-tick">
                            @foreach(['A', 'B', 'C', 'D', 'E', 'F'] as $grupo)
                                <option value="{{ $grupo }}" {{ old('grupo', $justi_retardo_sociale->grupo) == $grupo ? 'selected' : '' }}>
                                    {{ $grupo }}
                                </option>
                            @endforeach
                        </select>
                        @error('grupo')
                            <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <!--Fecha del permiso-->
                    <div class="col-md-6">
                        <label for="fecha_permiso" class="form-label">SE LE JUSTIFIQUE EL RETARDO, DEBIDO A QUE ATENDIÓ UN LLAMADO QUE LE SOLICITÓ EL DEPARTAMENTO DE TRABAJO SOCIAL, EL DÍA:</label>
                        <input type="date" name="fecha_permiso" id="fecha_permiso" class="form-control"
                            value="{{ old('fecha_permiso', $justi_retardo_sociale->fecha_permiso) }}">
                        @error('fecha_permiso')
                            <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{ route('justi_retardo_sociale.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
@endpush
