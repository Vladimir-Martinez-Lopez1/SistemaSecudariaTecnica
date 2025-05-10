@extends('template')

@section('title', 'Expedientes Disciplinario')

@push('css')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!--alerta -->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush

@section('content')
    @if (session('success'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: "Operacion exitosa"
            });
        </script>
    @endif

    <div class="container">
        <h1 class="mt-4 text-center">Perfil de Usuario</h1>
        <div class="container card mt-4">
            <div class="mt-4">
                @if ($errors->any())
                    @foreach ($errors->all() as $item)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{$item}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endforeach
                @endif
            </div>
            <form class="card-body" action="{{ route('profile.update', ['profile' => $user]) }}" method="post">
                @method('PATCH')
                @csrf
                <!-- Nombre -->
                <div class="row mb-4">
                    <div class="col-sm-4">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-square-check"></i></span>
                            <input disabled type="text" class="form-control" value="Nombres">
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="name" id="name" class="form-control" value="{{old('name', $user->name)}}">
                    </div>
                </div>

                <!-- Email -->
                <div class="row mb-4">
                    <div class="col-sm-4">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-square-check"></i></span>
                            <input disabled type="text" class="form-control" value="Correo">
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <input type="email" name="email" id="email" class="form-control"
                            value="{{old('email', $user->email)}}">
                    </div>
                </div>

                <!-- Contraseña -->
                <div class="row mb-4">
                    <div class="col-sm-4">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-square-check"></i></span>
                            <input disabled type="text" class="form-control" value="Contraseña">
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                </div>

                <div class="col text-center">
                    <input class="btn btn-success" type="submit" value="Guardar cambios">
                </div>
            </form>
        </div>
    </div>

@endsection

@push('js')
    <script src="{{asset('js/datatables-simple-demo.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
@endpush
