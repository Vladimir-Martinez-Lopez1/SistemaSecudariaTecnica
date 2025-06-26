@extends('template')

@section('title', 'Ver suspencion de clase')

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
        @if (!$from_suspencion_clase) <!-- Mostrar solo si no viene del expediente -->
            <h1 class="mt-4">Suspención de clases</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('pase_salida.index') }}">Suspención de clases</a></li>
                <li class="breadcrumb-item active">Ver documento de suspencion</li>
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
                        <p>MESA: SERVS. EDUCS. COMPLS.</p>
                    </div>
                    <div class="text-end line-height-small">
                        <p>ASUNTO: SUSPENCIÓN DE CLASES</p>
                    </div>
                    <div class="text-end line-height-small">

                            <p class="text-end">Cuilapam de guerrero, Oax,
                            <strong>{{ \Carbon\Carbon::parse($suspencion_clase->fecha_suspencion)->day }}</strong> de
                            <strong>{{ \Carbon\Carbon::parse($suspencion_clase->fecha_suspencion)->month }}</strong> de
                            <strong>{{ \Carbon\Carbon::parse($suspencion_clase->fecha_suspencion)->year }}</strong></p>
                    </div>
                    <!-- Texto con sangría -->
                    <div class="mt-4">
                        <p>C. <strong>{{$suspencion_clase->nombre_padre}}</strong>_</p>
                        <p>NOMBRE DEL (A) PADRE, MADRE O TUTOR (A).</p>
                        <P>
                            P R E S E N T E
                        </P>

                        <p>
                            La Coordinación de Servicios Educativos
                            Complementarios, en coordinación con la Dirección de la Escuela Secundaria Técnica No. 66
                            con clave 20DST00621, por medio del presente comunica a usted que el alumno
                            (a): <strong>{{$nombre}} {{$apellido }}</strong>
                            del <strong>{{ $suspencion_clase->grado }}</strong> Grado, Grupo
                            <strong>{{ $suspencion_clase->grupo}}</strong>, Violó el Reglamento Interno fundamentado en el
                            acuerdo
                            97, donde se establece la organización y funcionamiento de la escuela, al que se sujetará el
                            alumnado, por el motivo:
                            <strong>{{ $suspencion_clase->motivo }}</strong>,
                            que lo establece el Capítulo
                            <strong>{{$suspencion_clase->capitulo}}</strong> Artículo:
                            <strong>{{$suspencion_clase->articulo}}</strong> Fracción
                            <strong>{{$suspencion_clase->fraccion}}</strong> Inciso
                            <strong>{{$suspencion_clase->inciso}}</strong>, Se hace acreedor a una sanción disciplinaria
                            correspondiente a <strong>{{$suspencion_clase->numero_dias}}</strong> día(s) hábil(es) de
                            <strong> SUSPENSIÓN DE CLASES </strong> siendo los siguientes:
                        </P>
                        <p>
                            Fecha de inicio <strong>{{$suspencion_clase->fecha_inicio}}</strong> Fecha de termino
                            <strong>{{$suspencion_clase->fecha_termino}}</strong>
                        </p>
                        <p>
                            Por lo que se le comunica, para su conocimiento e intervención en el mejoramiento conductual
                            de su hijo (a).
                        </p>
                    </div>

                    <!-- Firma -->
                    </br>
                    <div class="text-center mt-4">
                        <p class="line-height-small">A T E N T A M E N T E</p>
                    </div>
                    <br>
                    <div class="row mt-4">
                        <div class="col text-center">
                            <p class="line-height-small">COORDINACIÓN DE SERVS.</p>
                            <br>
                            <p class="line-height-small">EDUCS. COMPLS.</p>
                            <br>
                            <p class="line-height-small">MTRO. BERTOLDO</P>
                            <br>
                            <p class="line-height-small">AQUINO BOLAÑOS</P>
                        </div>
                        <div class="col text-center">
                            <br>
                            <p class="line-height-small">Vo.Bo.</p>
                            <br>
                            <p class="line-height-small">DIRECCIÓN DE</P>
                            <br>
                            <p class="line-height-small">LA ESCUELA</P>
                            <br>
                            <p class="line-height-small">MTRO. ULTIMINIO</P>
                            <br>
                            <p class="line-height-small">GALLO GONZÁLEZ</P>

                        </div>
                        <div class="col text-center">
                            <br>
                            <p class="line-height-small">EL ASESOR DEL GRUPO</p>
                            <br>
                            <p class="line-height-small">PROFR (A)</p>
                            <br>
                            <p class="line-height-small"><strong>{{ $suspencion_clase->nombre_profesor }}</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid px-4 d-flex justify-content-center gap-3 no-print">
            <!-- Botón para regresar a la lista de citatorios -->
            @if ($from_suspencion_clase)
                <a href="{{ route('expediente_disciplinario.show', $suspencion_clase->expedienteDisciplinario->id) }}"
                    class="btn btn-primary mt-3">
                    Volver al expediente
                </a>
            @else
                <a href="{{ route('suspencion_clase.index') }}" class="btn btn-primary mt-3">
                    Volver a la lista de Documentos
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
