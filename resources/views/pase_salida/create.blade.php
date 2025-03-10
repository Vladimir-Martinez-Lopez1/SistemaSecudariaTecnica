@extends('template')

@section('Crear Citatorio')

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@endpush


@section('content')

    <div class="container-fluid px-4">

        <h1 class="mt-4 text-center">Crear pase de salida</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{route('pase_salida.index')}}">Pase de salida</a></li> 
            <li class="breadcrumb-item active">Crear Pase de salida </li>
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
            <form action="{{route('pase_salida.store')}}" method="post">
                @csrf

                <div class="row g-3">
                    <!--Nombre del padre del alumno-->
                    <div class="col-md-12">
                        <p class="text-center">ESCUELA SECUNDARIA TÉCNICA NÚM. 66</p>
                        <p class="text-center">20DST00621</p>
                        <p class="text-center">=  PASE DE SALIDA  =</p>
                    </div>
                    <!--Matricula del alumno-->
                    <div class="col-md-9">
                        <label for="matricula" class="form-label">Nombre del Alumno:</label>
                        {{-- <input type="number" name="matricula" id="matricula" class="form-control" value="{{ old('matricula') }}"> --}}
                        <select title="Seleccione un alumno..." data-live-search="true" name="matricula" id="matricula" class="form-control selectpicker show-tick">
                            @foreach ($matricula as $item)
                                <option value="{{ $item->matricula }}">{{ $item->matricula }} - {{ $item->nombre }} {{ $item->apellido }}</option>
                            @endforeach
                        </select>
                        @error('matricula')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <!--Numero de lista del alumno-->
                    <div class="col-md-3">
                        <label for="numero_lista" class="form-label">No. de lista:</label>
                        <input type="number" name="numero_lista" id="numero_lista" class="form-control" value="{{ old('numero_lista', 1) }}" min="1" required>
                        @error('numero_lista')
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

                    <!--Motivo de la salida-->
                    <div class="col-md-12">
                        <label for="observaciones" class="form-label">Motivo</label>
                        <textarea name="motivo" id="motivo" class="form-control">{{ old('motivo') }}</textarea>
                        @error('motivo')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <!--Hora de slaida y regreso de la salida-->
                    <div class="col-md-6">
                        <label for="hora_salida" class="form-label">Hora de salida</label>
                        <input type="time" name="hora_salida" id="hora_salida" class="form-control" value="{{ old('hora_salida') }}" required>
                        @error('hora_salida')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="hora_regreso" class="form-label">Hora de regreso</label>
                        <input type="time" name="hora_regreso" id="hora_regreso" class="form-control" value="{{ old('hora_regreso') }}" required>
                        @error('hora_regreso')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>
                     <!--Fecha de la salida-->

                    <div class="col-md-6">

                        <label for="fecha_salida" class="form-label">CUILAPAN DE GUERRERO, OAXACA, OAX. A:</label>
                        <input type="date" name="fecha_salida" id="fecha_salida" class="form-control" value="{{ old('fecha_salida') }}">
                        @error('fecha_salida')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <!--Nombre de quien lo solicita-->
                    <div class="col-md-6">
                        <label for="solicito" class="form-label">Solicito</label>
                        <input placeholder="solicito" type="text" name="solicito" id="solicito" class="form-control" value="{{ old('solicito') }}">
                        @error('solicito')
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