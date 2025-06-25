@extends('template')

@section('Editar Rol')

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@endpush

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 text-center">Editar rol</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{route('roles.index')}}">Roles</a></li>
            <li class="breadcrumb-item active">Editar rol</li>
        </ol>

        <!--Formulario para el reporte de un alumno-->
        <div class="container w-100 border border-3 border-secundary rounded p-4 mt-3">
            <form action="{{route('roles.update', ['role' => $role])}}" method="post">
                @method('PATCH')
                @csrf
                <div class="row g-3">
                    <!--Nombre de la escueal-->
                    <div class="col-md-12">
                        <p class="text-center">ESCUELA SECUNDARIA TÉCNICA NÚM. 66</p>
                        <p class="text-center">20DST00621</p>
                        <p class="text-center">= CREACIÓN DE ROLES =</p>
                    </div>

                    <!--Nombre del rol-->
                    <div class="row mb-4 mt-4">
                        <label for="name" class="col-sm-2 col-form-label">Nombre del rol</label>
                        <div class="col-sm-4">
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $role->name) }}">
                        </div>
                        <div class="col-sm-6">
                            @error('name')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!--Permisos-->
                    <div class="col-12 mb-4 mt-4">
                        <label for="" class="form-label">Permisos para el rol:</label>
                        @foreach ($permisos as $item)
                        @if ( in_array($item->id, $role->permissions->pluck('id')->toArray() ) )
                        <div class="form-check mb-2">
                            <input checked type="checkbox" name="permission[]" id="{{ $item->id }}" class="form-check-input" value="{{ $item->name }}">
                            <label for="{{ $item->id }}" class="form-check-label">{{$item->name}}</label>
                        </div>
                        @else
                        <div class="form-check mb-2">
                            <input type="checkbox" name="permission[]" id="{{ $item->id }}" class="form-check-input" value="{{ $item->name }}">
                            <label for="{{ $item->id }}" class="form-check-label">{{$item->name}}</label>
                        </div>
                        @endif
                        @endforeach
                        @error('permission')
                        <small class="text-danger">{{'*'. $message }}</small>
                        @enderror
                    </div>


                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancelar</a>
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
