@extends('template')

@section('title', 'Ver Persmiso Trab Social')

@push('css')


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

                    <!-- Texto centrado -->
                    <div class="text-end line-height-small">
                        <p>ASUNTO: PERSMISO POR TRABAJO SOCIAL</p>
                        <p>Cuilapam de Guerrero, Oax., a <strong>{{$permiso_trab_sociale->fecha_reporte}}</strong>
                        </p>
                    </div>
                    <!-- Texto con sangría -->
                    <div class="mt-4 line-height-small">
                        <p>C. C. PERSONAL DOCENTE</p>
                        <P>DE ESTA INSTITUCIÓN</P>
                        <P>
                            P R E S E N T E.
                        </P>
                    </div>
                    <div class="mt-4">
                        <p>
                            El Departamento de Trabajo Social se permite comunicar a
                            usted que el alumno (a): <strong>{{$nombre}} {{$apellido }}</strong>
                            del <strong>{{ $permiso_trab_sociale->grado }}</strong> Grado, Grupo
                            <strong>{{ $permiso_trab_sociale->grupo}}</strong>, por motivo:
                            <strong>{{ $permiso_trab_sociale->motivo }}</strong>, tendrá permiso
                            <strong>{{$permiso_trab_sociale->numero_dias}}</strong> día (s) comenzando el
                            <strong>{{$permiso_trab_sociale->fecha_inicio}}</strong>
                            y terminando <strong>{{$permiso_trab_sociale->fecha_termino}}</strong>
                            del presente año.
                        </P>
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
                            <p class="line-height-small">PADRE O TUTOR</p>
                            <P class="line-height-small">C. <strong>{{ $permiso_trab_sociale->nombre_padre }}</strong></P>
                        </div>
                        <div class="col text-center">
                            <P class="line-height-small">TRABAJO SOCIAL</P>
                            <P class="line-height-small">ENRIQUE J ESQUIVEL HERNÁNDEZ</P>
                        </div>
                        <div class="col text-center">
                            <P class="line-height-small">SUBDIRECCIÓN DE LA ESCUELA</P>
                            <P class="line-height-small">MTRO. ROLANDO PÉREZ CASTELLANOS</P>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid px-4 d-flex justify-content-center gap-3 no-print">
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
                window.print();
            }
        </script>

    @endpush
