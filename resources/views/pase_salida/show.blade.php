@extends('template')

@section('title', 'Ver pase de salida')

@push('css')
    <style>
        .line-height-small {
            line-height: 0.5;
        }
    </style>
    <style>
        .line-height-small {
            line-height: 0.5;
        }

        .header-images {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .header-img {
            height: 80px;
            /* Ajusta esta altura según necesites */
            object-fit: contain;
        }
    </style>
    <style>
        @media print {
            body * {
                visibility: hidden;
                margin: 0 !important;
                padding: 0 !important;
            }

            .print,
            .print * {
                visibility: visible;
            }

            .print {
                position: absolute;
                left: 1cm;
                top: 0;
                width: calc(100% - 1cm);
                padding-right: 0.5cm;
                margin: 0 !important;
            }

            @page {
                size: letter;
                margin: 1.5cm 0.5cm 1.5cm 0;
                padding: 0;
            }

            .no-print {
                display: none !important;
            }

            .print-container {
                border: none !important;
                padding: 0 !important;
                margin: 0 !important;
                max-width: 100% !important;
            }

            .container {
                page-break-after: avoid;
                page-break-inside: avoid;
            }

            /* Asegurar que las imágenes se muestren al imprimir */
            .header-images {
                display: flex !important;
            }
        }

        .line-height-small p {
            line-height: 1.2;
            margin-bottom: 0.2rem;
        }

        .contenido-texto {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid px-4">
        @if (!$from_pase_salida) <!-- Mostrar solo si no viene del expediente -->
            <h1 class="mt-4">Pase de salida</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('pase_salida.index') }}">Pase de salida</a></li>
                <li class="breadcrumb-item active">Ver pase</li>
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
                    <!-- Texto centrado -->
                    <div class="text-end line-height-small">
                        <p>ASUNTO: PASE DE SALIDA</p>
                    </div>
                    <br>
                    <!-- Texto con sangría -->
                    <div class="text-center  ms-4">


                        <p>
                            NOMBRE DEL ALUMNO (A): <strong>{{$nombre}} {{$apellido }}</strong> No. DE LISTA
                            <strong>{{$pase_salida->numero_lista}}</strong>
                        </p>
                        <p>
                            GRADO: <strong>{{ $pase_salida->grado }}</strong> GRUPO:
                            <strong>{{ $pase_salida->grupo}}</strong> MOTIVO: <strong>{{ $pase_salida->motivo }}</strong>
                        </p>
                        <P>
                            HORA DE SALIDA: <strong>{{$pase_salida->hora_salida}}</strong> HORA DE REGRESO:
                            <strong>{{$pase_salida->hora_regreso}}</strong>
                        </P>
                        <p>
                            CUILAPAM DE GUERRERO, OAXACA, OAX. A <strong>{{$pase_salida->fecha_salida}}</strong>
                        </p>
                    </div>

                    <!-- Firma -->
                    <div class="text-center mt-4">
                        <p class="line-height-small">Atentamente</p>
                    </div>
                    <div class="row mt-4">
                        <div class="col text-center">
                            <p class="line-height-small">SOLICITO</p>
                            <br>
                            <p class="line-height-small"><strong>{{ $pase_salida->solicito }}</strong></p>
                        </div>
                        <div class="col text-center">
                            <p class="line-height-small">Vo.Bo.</p>
                            <br>
                            <p class="line-height-small">DIRECTOR DE LA ESCUELA</P>
                            <br>
                            <p class="line-height-small">MTRO. ULTIMINIO GALLO</P>
                            <br>
                            <p class="line-height-small">GONZÁLEZ</P>
                        </div>
                        <div class="col text-center">
                            <p class="line-height-small">AUTORIZÓ</p>
                            <br>
                            <p class="line-height-small">DEPTO. DE SERVS. EDUCS.</P>
                            <br>
                            <p class="line-height-small">COMPLS.</P>
                            <br>
                            <p class="line-height-small">MTRO. BERTOLDO AQUINO</P>
                            <br>
                            <p class="line-height-small">BOLAÑOS</P>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid px-4 d-flex justify-content-center gap-3 no-print">
            <!-- Botón para regresar a la lista de citatorios -->
            @if ($from_pase_salida)
                <a href="{{ route('expediente_disciplinario.show', $pase_salida->expedienteDisciplinario->id) }}"
                    class="btn btn-primary mt-3">
                    Volver al expediente
                </a>
            @else
                <a href="{{ route('pase_salida.index') }}" class="btn btn-primary mt-3">
                    Volver a la lista de pase de salida
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
