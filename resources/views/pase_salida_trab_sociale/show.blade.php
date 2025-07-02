@extends('template')

@section('title', 'Ver pase de salida del trabajo social')

@push('css')


@endpush

@section('content')
    <div class="container-fluid px-4">
        @if (!$from_pase_salida_trab_sociale) <!-- Mostrar solo si no viene del expediente -->
            <h1 class="mt-4">Pase de salida por Trabajo Social</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('pase_salida.index') }}">Pase de salida</a></li>
                <li class="breadcrumb-item active">Ver pase</li>
            </ol>
        @endif
        <div class="print">
            <!-- Detalles del informe de salud -->
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

                    <div class="text-end line-height-small">
                        <p>ASUNTO: PASE DE SALIDA</p>
                    </div>
                    <br>
                    <!-- Texto con sangría -->
                    <div class="text-center  ms-4">

                        <p>
                            NOMBRE DEL ALUMNO (A): <strong>{{$nombre}} {{$apellido }}</strong>
                        </p>
                        <p>
                            GRADO: <strong>{{ $pase_salida_trab_sociale->grado }}</strong> GRUPO:
                            <strong>{{ $pase_salida_trab_sociale->grupo}}</strong> MOTIVO:
                            <strong>{{ $pase_salida_trab_sociale->motivo }}</strong>
                        </p>
                        <P>
                            HORA DE SALIDA: <strong>{{$pase_salida_trab_sociale->hora_salida}}</strong> HORA DE REGRESO:
                            <strong>{{$pase_salida_trab_sociale->hora_regreso}}</strong>
                        </P>
                        <p>
                            CUILAPAM DE GUERRERO, OAXACA, OAX. A
                            <strong>{{$pase_salida_trab_sociale->fecha_salida}}</strong>
                        </p>
                    </div>

                    <!-- Firma -->
                    </br>
                    <div class="row mt-4">
                        <div class="col text-center">
                            <p class="line-height-small">SOLICITO</p>
                            <p class="line-height-small"><strong>{{ $pase_salida_trab_sociale->solicito }}</strong></p>
                        </div>
                        <div class="col text-center">
                            <p class="line-height-small">AUTORIZÓ</p>
                            <p class="line-height-small">TRABAJO SOCIAL</P>
                            <p class="line-height-small">ENRIQUE J ESQUIVEL HERNÁNDEZ</P>
                        </div>
                        <div class="col text-center">
                            <p class="line-height-small">Vo.Bo.</p>
                            <p class="line-height-small">LA SUBDIRECCIÓN DE LA ESCUELA</P>
                            <p class="line-height-small">MTRO. ROLANDO PÉREZ CASTELLANOS</P>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid px-4 d-flex justify-content-center gap-3 no-print">
            <!-- Botón para regresar a la lista de citatorios -->
            @if ($from_pase_salida_trab_sociale)
                <a href="{{ route('expediente_disciplinario.show', $pase_salida_trab_sociale->expedienteDisciplinario->id) }}"
                    class="btn btn-primary mt-3">
                    Volver al expediente
                </a>
            @else
                <a href="{{ route('pase_salida_trab_sociale.index') }}" class="btn btn-primary mt-3">
                    Volver a la lista de pases de salida
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
