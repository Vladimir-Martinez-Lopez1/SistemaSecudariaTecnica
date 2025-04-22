@extends('template')

@section('title', 'Ver Persmiso Trab Social')

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

        @media imprimir {

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
        @if (!$from_permiso_trab_sociale) <!-- Mostrar solo si no viene del expediente -->
            <h1 class="mt-4">Permiso de Ausencia por Trabajo Social</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('permiso_trab_sociale.index') }}">Permiso Trabajo Social</a></li>
                <li class="breadcrumb-item active">Ver permiso</li>
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
                    <div class="text-justify ms-4">
                        <div class="row mt-4">
                            <div class="col text-end">
                                <p>ASUNTO: PERSMISO POR TRABAJO SOCIAL</p>
                                <p>Cuilapam de Guerrero, Oax., a <strong>{{$permiso_trab_sociale->fecha_reporte}}</strong>
                                </p>
                            </div>
                        </div>
                        <p>C. C. PERSONAL DOCENTE</p>
                        <P>DE ESTA INSTITUCIÓN</P>
                        <P>
                            P R E S E N T E.
                        </P>

                        <p>
                            El Departamento de Trabajo Social se permite comunicar a
                            usted que el alumno (a): <strong>{{$nombre}} {{$apellido }}</strong>
                            del <strong>{{ $permiso_trab_sociale->grado }}</strong> Grado, Grupo
                            <strong>{{ $permiso_trab_sociale->grupo}}</strong>, por motivo:
                            <strong>{{ $permiso_trab_sociale->motivo }}</strong>, tendrá permiso
                            <strong>{{$permiso_trab_sociale->numero_dias}}</strong> día (s) comenzando el <strong>{{$permiso_trab_sociale->fecha_inicio}}</strong>
                            y terminando <strong>{{$permiso_trab_sociale->fecha_termino}}</strong>
                            del presente año.</P>
                        <p>
                            Agradeciendo de su atención y apoyo, sirvace de firmar de enterado
                        </p>
                    </div>

                    <div class="row mt-4">
                        <div class="col text-center">
                           <p>ESPAÑOL</p>
                           <p>_____________________________________</p>
                        </div>
                        <div class="col text-center">
                            <p>MATEMÁTICAS</p>
                            <p>_____________________________________</p>
                        </div>
                        <div class="col text-center">
                            <p>INGLES</p>
                            <p>_____________________________________</p>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col text-center">
                           <p>CIENCIAS</p>
                           <p>_____________________________________</p>
                        </div>
                        <div class="col text-center">
                            <p>SOCIALES</p>
                            <p>_____________________________________</p>
                        </div>
                        <div class="col text-center">
                            <p>SOCIALES</p>
                            <p>_____________________________________</p>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col text-center">
                           <p>ARTES</p>
                           <p>_____________________________________</p>
                        </div>
                        <div class="col text-center">
                            <p>E. FÍSICA</p>
                            <p>_____________________________________</p>
                        </div>
                        <div class="col text-center">
                            <p>TECNOLOGÍA</p>
                            <p>_____________________________________</p>
                        </div>
                    </div>


                    <!-- Firma -->
                    </br>
                    <div class="row mt-4">
                        <div class="col text-center">
                           <p>PADRE O TUTOR</p>
                           <P>C. <strong>{{ $permiso_trab_sociale->nombre_padre }}</strong></P>
                        </div>
                        <div class="col text-center">
                            <P>TRABAJO SOCIAL</P>
                            <P>ENRIQUE J ESQUIVEL HERNÁNDEZ</P>
                        </div>
                        <div class="col text-center">
                            <P>SUBDIRECCIÓN DE LA ESCULA DE LA ESCUELA</P>
                            <P>MTRO. ROLANDO PÉREZ CASTELLANOS</P>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid px-4 d-flex justify-content-center gap-3">
            <!-- Botón para regresar a la lista de citatorios -->
            @if ($from_permiso_trab_sociale)
                <a href="{{ route('expediente_disciplinario.show', $permiso_trab_sociale->expedienteDisciplinario->id) }}"
                    class="btn btn-primary mt-3">
                    Volver al expediente
                </a>
            @else
                <a href="{{ route('permiso_trab_sociale.index') }}" class="btn btn-primary mt-3">
                    Volver a la lista de permisos
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
