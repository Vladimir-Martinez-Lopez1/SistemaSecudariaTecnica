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
        @if ($from_suspencion_clase) <!-- Mostrar solo si no viene del expediente -->
            <h1 class="mt-4">Suspención de clases</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('pase_salida.index') }}">Suspención de clases</a></li>
                <li class="breadcrumb-item active">Ver documento de suspencion</li>
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
                                <p>MESA: SERVS. EDUCS. COMPLS.</p>
                                <p>ASUNTO: SUSPENCIÓN DE CLASES</p>
                                <p>Cuilapam de Guerrero, Oax., a <strong>{{$suspencion_clase->fecha_suspencion}}</strong>
                                </p>
                            </div>
                        </div>
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
                            correspondiente a <strong>{{$suspencion_clase->numero_dias}}</strong> día(s) hábil(es) de <strong> SUSPENSIÓN DE CLASES </strong> siendo los siguientes:
                        </P>
                        <p>
                            Fecha de inicio <strong>{{$suspencion_clase->fecha_inicio}}</strong> Fecha de termino <strong>{{$suspencion_clase->fecha_termino}}</strong>
                        </p>
                        <p>
                            Por lo que se le comunica, para su conocimiento e intervención en el mejoramiento conductual
                            de su hijo (a).
                        </p>
                    </div>

                    <!-- Firma -->
                    </br>
                    <div class="row mt-4">
                        <div class="col text-center">
                           <p>A T E N T A M E N T E</p>
                           <p>COORDINACIÓN DE SERVS. EDUCS. COMPLS.</p>
                           <P>MTRO. BERTOLDO AQUINO BOLAÑOS</P>
                        </div>
                        <div class="col text-center">
                            <p>Vo.Bo.</p>
                            <P>DIRECCIÓN DE LA ESCUELA</P>
                            <P>MTRO. ULTIMINIO GALLO GONZÁLEZ</P>
                            
                        </div>
                        <div class="col text-center">
                            <p>EL ASESOR DEL GRUPO</p>
                            <p>PROFR (A) <strong>{{ $suspencion_clase->nombre_profesor }}</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid px-4 d-flex justify-content-center gap-3">
            <!-- Botón para regresar a la lista de citatorios -->
            <a href="{{ route('suspencion_clase.index') }}" class="btn btn-primary mt-3">
                Volver a la lista de pase de salida
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