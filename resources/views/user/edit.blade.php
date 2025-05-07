@extends('template')

@section('Editar usuario')


@push('css')
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@endpush


@section('content')

    <div class="container-fluid px-4">

        <h1 class="mt-4 text-center">Editar usuario</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{route('users.index')}}">Usuarios</a></li>
            <li class="breadcrumb-item active">Editar usuario</li>
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
            <form action="{{route('users.update',['user'=> $user])}}" method="post">
                @method('PATCH')
                @csrf

                <div class="row g-3">
                    <!--Nombre de la escueal-->
                    <div class="col-md-12">
                        <p class="text-center">ESCUELA SECUNDARIA TÉCNICA NÚM. 66</p>
                        <p class="text-center">20DST00621</p>
                        <p class="text-center">= CREACIÓN DE ROLES =</p>
                    </div>

                    <!--Nombre-->
                    <div class="row mb-4 mt-4">
                        <label for="name" class="col-sm-2 col-form-label">Nombre:</label>
                        <div class="col-sm-4">
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}">
                        </div>
                        <div class="col-sm-4">
                            Escriba un solo nombre
                        </div>
                        <div class="col-sm-2">
                            @error('name')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!--Correo-->
                    <div class="row mb-4">
                        <label for="email" class="col-sm-2 col-form-label">Correo:</label>
                        <div class="col-sm-4">
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}">
                        </div>
                        <div class="col-sm-4">
                            Dirección de correo electronico
                        </div>
                        <div class="col-sm-2">
                            @error('email')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!--Contraseña-->
                    <div class="row mb-4">
                        <label for="password" class="col-sm-2 col-form-label">Contraseña:</label>
                        <div class="col-sm-4">
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            Escriba una contraseña segura. Debe incluir numeros
                        </div>
                        <div class="col-sm-2">
                            @error('password')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!--Confirmar Contraseña-->
                    <div class="row mb-4">
                        <label for="password_confirm" class="col-sm-2 col-form-label">Confirmar contraseña:</label>
                        <div class="col-sm-4">
                            <input type="password" name="password_confirm" id="password_confirm" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            Vuelva a escribir la contraseña
                        </div>
                        <div class="col-sm-2">
                            @error('password_confirm')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!--Añadir rol al usuario-->
                    <div class="row mb-4">
                        <label for="role" class="col-sm-2 col-form-label">Seleccionar Rol:</label>
                        <div class="col-sm-4">
                            <select name="role" id="role" class="form-select">
                                @foreach ($roles as $item)
                                    @if (in_array($item->name, $user->roles->pluck('name')->toArray()))
                                        <option selected value="{{ $item->name }}" @selected(old('role') == $item->name)>{{ $item->name }}</option>
                                    @else
                                        <option value="{{ $item->name }}" @selected(old('role') == $item->name)>{{ $item->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4">
                            Seleccione el rol del usuario
                        </div>
                        <div class="col-sm-2">
                            @error('role')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                    <div class="col-12 text-center mt-4">
                        <button type="submit" class="btn btn-primary"> Actualizar</button>

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
