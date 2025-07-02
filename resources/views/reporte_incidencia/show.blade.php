@extends('template')

@section('title', 'Ver reporte de incidencia')

@push('css')
    

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
                        <p>ASUNTO: SUSPENCIÓN DE CLASES</p>
                    </div>
                    <div class="text-end line-height-small">

                            <p class="text-end">Cuilapam de guerrero, Oax,
                            <strong>{{ \Carbon\Carbon::parse($reporte_incidencia->fecha_suspencion)->day }}</strong> de
                            <strong>{{ \Carbon\Carbon::parse($reporte_incidencia->fecha_suspencion)->month }}</strong> de
                            <strong>{{ \Carbon\Carbon::parse($reporte_incidencia->fecha_suspencion)->year }}</strong></p>
                    </div>
                    <!-- Texto con sangría -->
                    <div class="mt-4">
                        <p>
                            COORDINACIÓN DE SERVICIOS EDUCATIVOS COMPLEMENTARIOS
                        </p>
                        <P>
                            P R E S E N T E
                        </P>

                        <p>
                            Comunico a usted que el alumno (a): <strong>{{$nombre}} {{$apellido }}</strong>
                            del <strong>{{ $reporte_incidencia->grado }}</strong> grupo:
                            <strong>{{ $reporte_incidencia->grupo}}</strong> incurrió en la (s) siguiente (s) falta (s):
                            <strong>{{ $reporte_incidencia->motivo }}</strong>
                            en el modulo de: <strong>{{$reporte_incidencia->modulo}}</strong> a la (s)
                            <strong>{{$reporte_incidencia->hora_clase}}</strong>
                            en la asignatura: <strong>{{$reporte_incidencia->asignatura}}</strong>,
                            reportó: <strong>{{ $reporte_incidencia->nombre_profesor }}</strong>.
                             Observaciones: <strong>{{$reporte_incidencia->observaciones}}</strong>
                        </P>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid px-4 d-flex justify-content-center gap-3 no-print">
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
                window.print();
            }
        </script>
    @endpush
