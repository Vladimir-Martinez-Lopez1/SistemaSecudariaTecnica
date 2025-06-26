@extends('template')

@section('title', 'Ver informe de salud')

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
        @if (!$fromExpedienteMedico)
            <h1 class="mt-4">Ver informe de salud</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('informe_salud.index') }}">Informes de salud</a></li>
                <li class="breadcrumb-item active">Ver informe de salud</li>
            </ol>
        @endif

        <div class="print">
            <!-- Detalles del informe de salud -->
            <div class="container mt-4 border p-4">
                <div class="container mt-4">
                    <!-- Encabezado con imágenes -->
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
                        <p>ASUNTO: JUSTIFICANTE DE INASISTENCIA</p>
                    </div>

                    <!-- Fecha y destinatario -->
                    <div class="mt-4 line-height-small">
                        <p class="text-end">Cuilapam de guerrero, Oax,
                            <strong>{{ \Carbon\Carbon::parse($informe_salud->fecha)->day }}</strong> de
                            <strong>{{ \Carbon\Carbon::parse($informe_salud->fecha)->month }}</strong> de
                            <strong>{{ \Carbon\Carbon::parse($informe_salud->fecha)->year }}</strong></p>
                        <p>CC: PERSONAL DOCENTE</p>
                        <p>ESC. SEC. TEC. No 66</p>
                        <p>PRESENTE</p>
                    </div>

                    <!-- Cuerpo del justificante -->
                    <div class="mt-4">
                        <p>
                            Por medio del presente le comunico que el (la) alumno (a):
                            <strong>{{ $informe_salud->expedienteMedico->alumno->nombre }}
                                {{ $informe_salud->expedienteMedico->alumno->apellido }}</strong> del
                            <strong>{{ $informe_salud->grado }}</strong> grado, grupo
                            <strong>{{ $informe_salud->grupo }}</strong>, actualmente presenta como diagnóstico:
                            <strong>{{ $informe_salud->diagnostico }}</strong>.
                        </p>
                        <p>
                            Por el cual <strong>{{ $informe_salud->motivo }}</strong>, por lo cual solicitamos su
                            comprensión y apoyo a partir del <strong>{{ $informe_salud->fecha_inicio }}</strong> o hasta
                            nueva orden.
                        </p>
                        <p>
                            Recomendaciones: <strong>{{ $informe_salud->recomendaciones }}</strong>
                        </p>
                        <p>
                            Agradeciendo de antemano la atención prestada al presente y haciendo de su conocimiento,
                            aprovechamos para enviarle un cordial saludo.
                        </p>
                    </div>


                    <div class="row mt-4">
                        <div class="col text-center">
                            <p class="line-height-small">Atentamente</p>
                            <br>
                            <p class="line-height-small">Servicio médico</p>
                            <!--p>...........</p -->
                            <br>

                            <p>DRA. <strong>{{ $informe_salud->nombre_medico }}</strong></p>
                        </div>

                        <div class="col text-center">
                            <p class="line-height-small">Vo.Bo.</p>
                            <br>
                            <p class="line-height-small">DIRECTOR DE LA ESCUELA</p>
                            <!--p>...........</p -->
                            <br>

                            <p>MTRO. ULTIMIO GALLO GONZALEZ</p>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Botón para regresar -->

        </div>
        <div class="container-fluid px-4 d-flex justify-content-center gap-3 no-print">
            @if ($fromExpedienteMedico)
                <a href="{{ route('expedientes_medicos.show', $informe_salud->expedienteMedico->id) }}"
                    class="btn btn-primary mt-3">Volver al expediente</a>
            @else
                <a href="{{ route('informe_salud.index') }}" class="btn btn-primary mt-3">Volver a la lista</a>
            @endif
            <button onclick="imprimir()" class="btn btn-success mt-3">
                Imprimir
            </button>
        </div>

    </div>
@endsection

@push('js')
    <script>
        function imprimir() {
            window.print();
        }
    </script>
@endpush
