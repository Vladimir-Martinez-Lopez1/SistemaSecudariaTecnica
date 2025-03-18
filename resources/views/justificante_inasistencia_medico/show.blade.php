@extends('template')

@section('title', 'Ver justificante medico')

@push('css')
    <style>
        .line-height-small {
            line-height: 0.5;
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

        <!-- Vista del justificante -->
        <div class="container mt-4 border p-4">
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
                    <div class="col text-start">
                        <p>SERVICIOS COMPLEMENTARIOS (TRABAJO SOCIAL)</p>
                    </div>
                    <div class="col text-end">
                        <p>ASUNTO: JUSTIFICANTE DE INASISTENCIA</p>
                    </div>
                    <p>PRESENTE.</p>
                </div>

                <p>
                    Por este medio de la presente el servicio médico de la institución, le solicita de la manera más atenta
                    y respetuosa que JUSTIFIQUE la inasistencia del alumno (a)
                    <strong>{{ $justificante->expedienteMedico->alumno->nombre }}
                        {{ $justificante->expedienteMedico->alumno->apellido }}</strong> del grado
                    <strong>{{ $justificante->grado }}</strong> y grupo <strong>{{ $justificante->grupo }}</strong>,
                    correspondiente al (os) módulos: <strong>{{ $justificante->modulos }}</strong> del día:
                    <strong>{{ $justificante->fecha }}</strong>, ya que será retirado de la institución por problemas de
                    salud.
                </p>
                <p>
                    Por la atención a la presente, les reiteramos nuestro agradecimiento.
                </p>
            </div>

            <div class="text-center mt-4">
                <p>Atentamente</p>
            </div>

            <!-- Firma DRA y ENFERMERA -->
            <div class="row mt-4">
                <div class="col text-center">
                    <p>DRA: <strong>{{ $justificante->nombre_medico }}</strong></p>
                </div>

                <div class="col text-center">
                    <p>ENFERMERA: <strong>{{ $justificante->nombre_medico }}</strong></p>
                </div>
            </div>
        </div>

        <!-- Botón para regresar -->
        @if ($fromExpedienteMedico)
            <div class="text-center mt-4">
                <a href="{{ route('expedientes_medicos.show', $justificante->expedienteMedico->id) }}"
                    class="btn btn-primary">Volver al expediente</a>
            </div>
        @else
            <div class="text-center mt-4">
                <a href="{{ route('justificante_inasistencia_medico.index') }}" class="btn btn-primary">Volver a la lista</a>
            </div>
        @endif

    </div>
@endsection

@push('js')
@endpush