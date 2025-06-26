@extends('template')

@section('title', 'Ver citatorio general')

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

        /* Ocultar el contenido duplicado en la vista normal */
        .contenido-duplicado {
            display: none;
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
            object-fit: contain;
        }

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

            /* Mostrar el contenido duplicado al imprimir */
            .contenido-duplicado {
                display: block !important;
                margin-top: 1cm;
            }

            /* Asegurar que las imágenes se muestren al imprimir */
            .header-images {
                display: flex !important;
            }

            /* Mantener alineación y espaciado */
            .text-center {
                text-align: center !important;
            }

            .fw-bold {
                font-weight: bold !important;
            }

            .line-height-small {
                line-height: 0.5 !important;
            }

            .ms-4 {
                margin-left: 1.5rem !important;
            }

            .mt-4 {
                margin-top: 1.5rem !important;
            }

            .my-4 {
                margin-top: 1.5rem !important;
                margin-bottom: 1.5rem !important;
            }

            .border {
                border: 1px solid #000 !important;
            }

            .p-4 {
                padding: 1.5rem !important;
            }

            /* Asegurar que los elementos mantengan su formato */
            h3,
            p {
                font-size: 1rem !important;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid px-4">
        @if ($fromCitatorioGeneral) <!-- Mostrar solo si no viene del expediente -->
            <h1 class="mt-4">Citatorio general</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('citatorio_general.index') }}">Citatorio general</a></li>
                <li class="breadcrumb-item active">Ver citatorio</li>
            </ol>
        @endif
        <div class="print">
            <!-- Contenido original -->
            <div class="contenido-original">
                <!-- Vista del justificante -->
                <div class="container border p-4">
                    <!-- Título centrado -->
                    <div class="header-images">
                        <img src="{{ asset('/storage/logoEST.png') }}" class="header-img" alt="Escudo izquierdo">
                        <div class="text-center line-height-small">
                            <h3 class="fw-bold ">ESCUELA SECUNDARIA TECNICA N 66</h3>
                            <br>
                            <p>CLAVE: 20DST0062I</p>
                            <br>
                            <p>CUILAPAN DE GUERRERO, OAX</p>
                        </div>
                        <img src="{{ asset('/storage/logoIEEPO.png') }}" class="header-img" alt="Escudo derecho">
                    </div>

                    <!-- Línea continua -->
                    <hr class="my-4">

                    <!-- Texto con sangría -->
                    <div class="ms-4">
                        <div class="row mt-4">
                            <div class="col text-end">
                                <p>ASUNTO: CITATORIO</p>
                                <p>Cuilapam de Guerrero, Oax., a <strong>{{$citatorio->fecha_creacion}}</strong></p>
                            </div>
                            <p>C.________________________________________________ </p>
                            <p>Padre de familiar o tutor</p>
                        </div>

                        <p>
                            Por este medio de la presente el (la) titular de la asignatura de
                            <strong>{{ $citatorio->asignatura }}</strong>,de la manera más atenta, Citan a usted con el
                            objetivo
                            de
                            tratar asuntos relacionados con el aprovechamiento académico y conductual de su hijo
                            (a):_____________________________________del
                            <strong>{{ $citatorio->grado }}</strong>, grupo <strong>{{ $citatorio->grupo}}</strong>.
                        </p>

                        <p>
                            Agradecemos su puntual asistencia a las <strong>{{$citatorio->hora_cita}}</strong> hrs., del día
                            <strong>{{$citatorio->fecha_cita }}</strong>.
                        </p>
                    </div>

                    <!-- Firma -->
                    <div class="text-center mt-4">
                        <p>Atentamente</p>
                    </div>
                    <div class="row mt-4">
                        <div class="col text-center">
                            <p>PROFR (A). <strong>{{ $citatorio->nombre_profesor }}</strong></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contenido duplicado (solo visible al imprimir) -->
            <div class="contenido-duplicado">
                <!-- Vista del justificante -->
                <div class="container border p-4">
                    <!-- Título centrado -->
                    <div class="header-images">
                        <img src="{{ asset('/storage/logoEST.png') }}" class="header-img" alt="Escudo izquierdo">
                        <div class="text-center line-height-small">
                            <h3 class="fw-bold ">ESCUELA SECUNDARIA TECNICA N 66</h3>
                            <br>
                            <p>CLAVE: 20DST0062I</p>
                            <br>
                            <p>CUILAPAN DE GUERRERO, OAX</p>
                        </div>
                        <img src="{{ asset('/storage/logoIEEPO.png') }}" class="header-img" alt="Escudo derecho">
                    </div>

                    <!-- Línea continua -->
                    <hr class="my-4">

                    <!-- Texto con sangría -->
                    <div class="ms-4">
                        <div class="row mt-4">
                            <div class="col text-end">
                                <p>ASUNTO: CITATORIO</p>
                                <p>Cuilapam de Guerrero, Oax., a <strong>{{$citatorio->fecha_creacion}}</strong></p>
                            </div>
                            <p>C.________________________________________________ </p>
                            <p>Padre de familiar o tutor</p>
                        </div>

                        <p>
                            Por este medio de la presente el (la) titular de la asignatura de
                            <strong>{{ $citatorio->asignatura }}</strong>,de la manera más atenta, Citan a usted con el
                            objetivo
                            de
                            tratar asuntos relacionados con el aprovechamiento académico y conductual de su hijo
                            (a):_____________________________________del
                            <strong>{{ $citatorio->grado }}</strong>, grupo <strong>{{ $citatorio->grupo}}</strong>.
                        </p>

                        <p>
                            Agradecemos su puntual asistencia a las <strong>{{$citatorio->hora_cita}}</strong> hrs., del día
                            <strong>{{$citatorio->fecha_cita }}</strong>.
                        </p>
                    </div>

                    <!-- Firma -->
                    <div class="text-center mt-4">
                        <p>Atentamente</p>
                    </div>
                    <div class="row mt-4">
                        <div class="col text-center">
                            <p>PROFR (A). <strong>{{ $citatorio->nombre_profesor }}</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid px-4 d-flex justify-content-center gap-3 no-print">
            <!-- Botón para regresar a la lista de citatorios -->
            <a href="{{ route('citatorio_general.index') }}" class="btn btn-primary mt-3">
                Volver a la lista de citatorios
            </a>
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
