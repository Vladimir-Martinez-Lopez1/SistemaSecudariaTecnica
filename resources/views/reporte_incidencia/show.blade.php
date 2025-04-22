@extends('template')

@section('title', 'Ver reporte de incidencia')

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

        @media print {

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
        @if (!$from_reporte_incidencium) <!-- Mostrar solo si no viene del expediente -->
            <h1 class="mt-4">Reporte de incidencia</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('pase_salida.index') }}">Reporte de incidencia</a></li>
                <li class="breadcrumb-item active">Ver reporte</li>
            </ol>
        @endif
        <div class="imprimir">
            <!-- Contenido original -->
            <div class="contenido-original">
                <!-- Vista del justificante -->
                <div class="container mt-4 border p-4">
                    <!-- Título centrado -->
                    <div class="text-center line-height-small">
                        <h3 class="fw-bold">ESCUELA SECUNDARIA TECNICA N 66</h3>
                        <p>CLAVE: 20DST0062I</p>
                        <p>CUILAPAN DE GUERRERO, OAX</p>
                    </div>

                    <!-- Línea continua -->
                    <hr class="my-4">

                    <!-- Texto con sangría -->
                    <div class="ms-4">
                        <div class="row mt-4">
                            <div class="col text-end">
                                <p>ASUNTO: REPORTE DE INCIDENCIA</p>
                                <p>Cuilapam de Guerrero, Oax., a <strong>{{$reporte_incidencia->fecha_reporte}}</strong></p>
                            </div>

                        </div>
                        <p>
                            COORDINACIÓN DE SERVICIOS EDUCATIVOS COMPLEMENTARIOS
                        </p>
                        <P>
                            P R E S E N T E
                        </P>

                        <p>
                            Comunico a usted que el alumno (a): <strong>{{$nombre}} {{$apellido }}</strong>
                        </p>
                        <p>
                            del <strong>{{ $reporte_incidencia->grado }}</strong> grupo:
                            <strong>{{ $reporte_incidencia->grupo}}</strong> incurrió en la (s) siguiente (s) falta (s):
                            <strong>{{ $reporte_incidencia->motivo }}</strong>
                        </p>
                        <P>
                            EN EL MODULO DE: <strong>{{$reporte_incidencia->modulo}}</strong> A <strong>{{$reporte_incidencia->hora_clase}}</strong>
                        </P>
                        <P>
                            EN LA ASIGNATURA: <strong>{{$reporte_incidencia->asignatura}}</strong>
                        </P>
                        <P>
                            REPORTÓ: <strong>{{ $reporte_incidencia->nombre_profesor }}</strong></p>
                        </P>
                        <P>
                            OBSERVACIONES: <strong>{{$reporte_incidencia->observaciones}}</strong>
                        </P>
                    </div>

                    <!-- Firma -->
                    </br>
                    {{-- <div class="row mt-4">
                        <div class="col text-center">
                            <p>SOLICITO</p>
                            <p>
                        </div>
                        <div class="col text-center">
                            <p>AUTORIZÓ</p>
                            <P>TRABAJO SOCIAL</P>
                            <P>ENRIQUE J ESQUIVEL HERNÁNDEZ</P>
                        </div>
                        <div class="col text-center">
                            <p>Vo.Bo.</p>
                            <P>LA SUBDIRECCIÓN DE LA ESCULA DE LA ESCUELA</P>
                            <P>MTRO. ROLANDO PÉREZ CASTELLANOS</P>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="container-fluid px-4 d-flex justify-content-center gap-3">
            <!-- Botón para regresar a la lista de citatorios -->
            @if ($from_reporte_incidencium)
                <a href="{{ route('expediente_disciplinario.show', $reporte_incidencia->expedienteDisciplinario->id) }}"
                    class="btn btn-primary mt-3">
                    Volver al expediente
                </a>
            @else
                <a href="{{ route('reporte_incidencia.index') }}" class="btn btn-primary mt-3">
                    Volver a la lista de Reportes
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
                // Clona el contenido del div "imprimir"
                const contenido = document.querySelector('.imprimir').cloneNode(true);

                // Oculta elementos innecesarios al imprimir
                const botones = contenido.querySelectorAll('button, a');
                botones.forEach(boton => boton.style.display = 'none');

                // Abre una nueva ventana para imprimir
                const ventana = window.open('', '', 'height=500,width=800');
                ventana.document.write('<html><head><title>Citatorio General</title>');
                ventana.document.write('<link rel="stylesheet" href="{{ asset('css/app.css') }}">'); // Asegúrate de incluir los estilos
                ventana.document.write('</head><body>');
                ventana.document.write(contenido.innerHTML);
                ventana.document.write('</body></html>');
                ventana.document.close();

                // Imprime el contenido
                ventana.print();
            }
        </script>

    @endpush
