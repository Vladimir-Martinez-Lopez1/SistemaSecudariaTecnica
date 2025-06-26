@extends('template')

@section('title', 'Ver justificante medico')

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
        @if (!$fromExpedienteMedico) <!-- Mostrar solo si no viene del expediente -->
            <h1 class="mt-4">Justificante Médico de Inasistencia</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('justificante_inasistencia_medico.index') }}">Justificantes de
                        inasistencia médica</a></li>
                <li class="breadcrumb-item active">Ver justificante de Inasistencia</li>
            </ol>
        @endif

        <div class="print">
            <!-- Detalles del informe de salud -->
            <div class="container mt-4 border p-4">
                <div class="container mt-4">
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
                        <p>ASUNTO: JUSTIFICANTE DE INASISTENCIA MEDICA</p>
                    </div>
                    <!-- Texto con sangría -->
                    <div class="mt-4">
                        <div class="row mt-4">
                            <div class="col text-start">
                                <p>SERVICIOS COMPLEMENTARIOS (TRABAJO SOCIAL)</p>
                            </div>
                            <p>P R E S E N T E.</p>
                        </div>

                        <p>
                            Por este medio de la presente el servicio médico de la institución, le solicita de la manera más
                            atenta
                            y respetuosa que JUSTIFIQUE la inasistencia del alumno (a)
                            <strong>{{ $justificante->expedienteMedico->alumno->nombre }}
                                {{ $justificante->expedienteMedico->alumno->apellido }}</strong> del grado
                            <strong>{{ $justificante->grado }}</strong> y grupo <strong>{{ $justificante->grupo }}</strong>,
                            correspondiente al (os) módulos: <strong>{{ $justificante->modulos }}</strong> del día:
                            <strong>{{ $justificante->fecha }}</strong>, ya que será retirado de la institución por
                            problemas de
                            salud.
                        </p>
                        <p>
                            Por la atención a la presente, les reiteramos nuestro agradecimiento.
                        </p>
                    </div>

                    <div class="text-center mt-4">
                        <p class="line-height-small">Atentamente</p>
                    </div>

                    <!-- Firma DRA y ENFERMERA -->
                    <div class="row mt-4">
                        <div class="col text-center">
                            <p class="line-height-small">DRA: <strong>{{ $justificante->nombre_medico }}</strong></p>
                        </div>

                        <div class="col text-center">
                            <p class="line-height-small">ENFERMERA: <strong>{{ $justificante->nombre_medico }}</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid px-4 d-flex justify-content-center gap-3 no-print">
            <!-- Botón para regresar -->
            @if ($fromExpedienteMedico)
                <a href="{{ route('expedientes_medicos.show', $justificante->expedienteMedico->id) }}"
                    class="btn btn-primary mt-3">Volver al expediente</a>
            @else
                <a href="{{ route('justificante_inasistencia_medico.index') }}" class="btn btn-primary mt-3">Volver a la
                    lista</a>
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
