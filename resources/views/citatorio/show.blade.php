@extends('template')

@section('title', 'Ver citatorio')

@push('css')
{{-- <style>
    @media print {
        body * {
            visibility: hidden;
        }

        .print, .print * {
            visibility: visible;
        }

        .print {
            position: absolute;
            left: 2rem;
            top: 0;
            width: 100%;
            /*padding: 1cm 2cm 1cm 2.5cm; /* margen uniforme */
        }

        @page {
            size: letter;
            /*margin: 2.5cm 2.5cm 2.5cm 2.5cm; /* margen superior, derecho, inferior, izquierdo */
        }

        .no-print {
            display: none !important;
        }
    }

    .line-height-small p {
        line-height: 1.2;
        margin-bottom: 0.2rem;
    }

    /* Ajustar el cuerpo del texto en pantalla también */
    .contenido-texto {
        padding-left: 1.5rem;
        padding-right: 1.5rem;
    }
</style> --}}
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
        height: 80px; /* Ajusta esta altura según necesites */
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
    @if (!$fromCitatorio)
        <h1 class="mt-4">Citatorio</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('citatorio.index') }}">Citatorio general</a></li>
            <li class="breadcrumb-item active">Ver citatorio</li>
        </ol>
    @endif

    <div class="print">
        <div class="container border p-4">
            <div class="header-images">
                <img src="{{ asset('/storage/logoEST.png') }}" class="header-img" alt="Escudo izquierdo">
                <div class="text-center line-height-small">
                    <h3 class="fw-bold ">ESCUELA SECUNDARIA TECNICA N 66</h3>
                    <p>CLAVE: 20DST0062I</p>
                    <p>CUILAPAN DE GUERRERO, OAX</p>
                </div>
                <img src="{{ asset('/storage/logoIEEPO.png') }}" class="header-img" alt="Escudo derecho">
            </div>

            <hr class="my-4">

            <div class="contenido-texto">
                <div class="row mt-4">
                    <div class="col text-end">
                        <p>ASUNTO: CITATORIO</p>
                        <p>Cuilapam de Guerrero, Oax., a <strong>{{ $citatorio->fecha_creacion }}</strong></p>
                    </div>
                    <p>C._<strong>{{ $citatorio->nombre_padre }}</strong>_</p>
                    <p>Padre de familiar o tutor</p>
                </div>

                <p>
                    Por medio del presente, la titular de la Coordinación de Servicios Educativos Complementarios, en
                    coordinación con la Dirección de la Escuela, de la manera más atenta, le citan con el objetivo de tratar
                    asuntos relacionados con el aprovechamiento académico y conductual de su hijo(a):
                    <strong>{{ $citatorio->asignatura }}</strong>, de la manera más atenta, Citan a usted con el
                    objetivo de tratar asuntos relacionados con el aprovechamiento académico y conductual de su hijo
                    (a): <strong>{{ $nombre }} {{ $apellido }}</strong> del
                    <strong>{{ $citatorio->grado }}</strong> grado, grupo <strong>{{ $citatorio->grupo }}</strong>.
                </p>

                <p>
                    Agradecemos su puntual asistencia a las <strong>{{ $citatorio->hora_cita }}</strong> hrs., del día
                    <strong>{{ $citatorio->fecha_cita }}</strong>.
                </p>
            </div>

            <div class="text-center mt-4">
                <p>Atentamente</p>
            </div>

            <div class="row mt-4">
                <div class="col text-center">
                    <p>PROFRA. <strong>{{ $citatorio->nombre_profesor }}</strong></p>
                    <p>OORD. DE SERVS. EDUCS. COMPLS.</p>
                </div>
                <div class="col text-center">
                    <p>PROFE. ULTIMINIO G. GONZALEZ</p>
                    <p>DIRECTOR DE LA ESCUELA</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Botones (no se imprimen) -->
    <div class="container-fluid px-4 d-flex justify-content-center gap-3 no-print">
        @if ($fromCitatorio)
            <a href="{{ route('expediente_disciplinario.show', $citatorio->expedienteDisciplinario->id) }}"
                class="btn btn-primary mt-3">
                Volver al expediente
            </a>
        @else
            <a href="{{ route('citatorio.index') }}" class="btn btn-primary mt-3">
                Volver a la lista de citatorios
            </a>
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
