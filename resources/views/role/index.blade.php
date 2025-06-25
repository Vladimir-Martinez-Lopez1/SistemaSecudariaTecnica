@extends('template')

@section('title', 'roles')


@push('css')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!--alerta -->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush

@section('content')
    @if (session('success'))
        <script>
            let message = "{{ session('success')}}";
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener = ('mouseenter', Swal.stopTimer);
                    toast.addEventListener = ('mouseleave', Swal.resumeTimer);
                }
            });
            Toast.fire({
                icon: "success",
                title: message
            });
        </script>
    @endif

    <div class="container-fluid px-4">

        <h1 class="mt-4">Roles</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
            <li class="breadcrumb-item active">Roles</li>
        </ol>

        <div class="mb-4">
            <a href="{{route('roles.create')}}">
                <button type="button" class=" btn btn-primary"> Añadir nuevo rol</button>
            </a>
        </div>

        {{-- Tabla reporte de Incidencia --}}
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Tabla roles
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($roles as $rol)
                            <tr>
                                <td>{{$rol->name}}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <form action="{{ route('roles.edit', ['role' => $rol]) }}" method="get">
                                            <button type="submit" class="btn btn-warning">Editar</button>
                                        </form>

                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal-{{ $rol->id }}">Eliminar</button>

                                        {{--
                                        <a
                                            href="{{ route('reporte_incidencia.show', ['reporte_incidencium' => $reporte->id, 'from_reporte_incidencium' => false]) }}">
                                            <button type="button" class="btn btn-success">Ver</button>
                                        </a>
                                        <a href="{{ route('roles.edit', ['reporte_incidencium' => $rol]) }}">
                                            <button type="button" class="btn btn-warning">Editar</button>
                                        </a> --}}
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="confirmModal-{{$rol->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de confirmacion</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Estas seguro de eliminar el rol {{$rol->name}}?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <form action="{{ route('roles.destroy',['role'=>$rol->id]) }}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Confirmar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection

@push('js')
    <script src="{{asset('js/datatables-simple-demo.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
@endpush
