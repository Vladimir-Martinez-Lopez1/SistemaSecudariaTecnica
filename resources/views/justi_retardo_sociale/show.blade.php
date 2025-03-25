@extends('template')

@section('title', 'Ver Justificante de retardo Trab Social')

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
        @if ($from_justi_retardo_sociale) <!-- Mostrar solo si no viene del expediente -->
            <h1 class="mt-4">Suspención de clases</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('justi_retardo_sociale.index') }}">Justificante de Retardo Trabajo
                        Social</a></li>
                <li class="breadcrumb-item active">Ver justificante</li>
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
                        <p>COORDINACION DE SERVICIOS EDUCATIVOS COMPLEMENTARIOS</p>
                    </div>

                    <!-- Línea continua -->
                    <hr class="my-4">

                    <!-- Texto con sangría -->
                    <div class="text-justify ms-4">

                        <p>
                            POR ESTE MEDIO SOLICITO DE SU APOYO PARA QUE EL ALUMNO (A): <strong>{{$nombre}}
                                {{$apellido }}</strong>
                            del <strong>{{ $justi_retardo_sociale->grado }}</strong> Grado, Grupo
                            <strong>{{ $justi_retardo_sociale->grupo}}</strong>, SE LE JUSTIFIQUE EL RETARDO, DEBIDO A QUE
                            ATENDIÓ UN LLAMADO QUE LE SOLICITÓ EL DEPARTAMENTO DE TRABAJO SOCIAL, EL DIA
                            <strong>{{$justi_retardo_sociale->fecha_permiso}}</strong> DEL PRESENTE AÑO.
                        </P>
                    </div>
                    <!-- Firma -->
                    </br>
                    <div class="row mt-4">
                        <div class="col text-center">
                            <P>___________________</P>
                            <P>ATTE</P>
                            <P>ENRIQUE J ESQUIVEL HERNÁNDEZ</P>
                            <P>TRABAJADOR SOCIAL</P>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid px-4 d-flex justify-content-center gap-3">
            <!-- Botón para regresar a la lista de citatorios -->
            <a href="{{ route('justi_retardo_sociale.index') }}" class="btn btn-primary mt-3">
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