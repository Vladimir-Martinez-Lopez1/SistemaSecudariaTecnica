@extends('template')

@section('title', 'Ver Justificante de retardo Trab Social')

@push('css')
    
@endpush

@section('content')
    <div class="container-fluid px-4">
        @if (!$from_justi_retardo_sociale) <!-- Mostrar solo si no viene del expediente -->
            <h1 class="mt-4">Justificante de Retardo Trabajo</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('justi_retardo_sociale.index') }}">Justificante de Retardo Trabajo
                        Social</a></li>
                <li class="breadcrumb-item active">Ver justificante</li>
            </ol>
        @endif
        <div class="print">
            <!-- Contenido original -->
            <div class="container mt-4 border p-4">
                <div class="container mt-4">
                    <!-- Título centrado -->
                    <div class="header-images">
                        <img src="{{ asset('/storage/logoEST.png') }}" class="header-img" alt="Escudo izquierdo">
                        <div class="text-center line-height-small">
                            <h3 class="fw-bold ">ESCUELA SECUNDARIA TECNICA N 66</h3>
                            <p>CLAVE: 20DST0062I</p>
                            <p>CUILAPAN DE GUERRERO, OAX</p>
                        </div>
                        <img src="{{ asset('/storage/logoIEEPO.png') }}" class="header-img" alt="Escudo derecho">
                    </div>

                    <!-- Línea continua -->
                    <hr class="my-4">

                    <!-- Texto con sangría -->

                    <div class="mt-4">
                        <p>
                            POR ESTE MEDIO SOLICITO DE SU APOYO PARA QUE EL ALUMNO (A): <strong>{{$nombre}}
                                {{$apellido }}</strong>
                            del <strong>{{ $justi_retardo_sociale->grado }}</strong> Grado, Grupo
                            <strong>{{ $justi_retardo_sociale->grupo}}</strong>, SE LE JUSTIFIQUE EL RETARDO, DEBIDO A QUE
                            ATENDIÓ UN LLAMADO QUE LE SOLICITÓ EL DEPARTAMENTO DE TRABAJO SOCIAL, EL DIA
                            <strong>{{$justi_retardo_sociale->fecha_permiso}}</strong> DEL PRESENTE AÑO.
                        </P>
                    </div>
                    <!-- Firma -->
                    </br>
                    <div class="row mt-4">
                        <div class="col text-center">
                            <P>___________________</P>
                            <P>ATTE</P>
                            <P>ENRIQUE J ESQUIVEL HERNÁNDEZ</P>
                            <P>TRABAJADOR SOCIAL</P>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid px-4 d-flex justify-content-center gap-3 no-print">
            <!-- Botón para regresar a la lista de citatorios -->
            @if ($from_justi_retardo_sociale)
                <a href="{{ route('expediente_disciplinario.show', $justi_retardo_sociale->expedienteDisciplinario->id) }}"
                    class="btn btn-primary mt-3">
                    Volver al expediente
                </a>
            @else
                <a href="{{ route('justi_retardo_sociale.index') }}" class="btn btn-primary mt-3">
                    Volver a la lista de Justificantes
                </a>
            @endif
            <!-- Botón para imprimir -->
            <button onclick="imprimir()" class="btn btn-success mt-3">
                Imprimir
            </button>
        </div>
@endsection

    @push('js')
        <script>
            function imprimir() {
                window.print();
            }
        </script>
    @endpush
