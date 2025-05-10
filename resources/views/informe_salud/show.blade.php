@extends('template')

@section('title', 'Ver informe de salud')

@push('css')
<style>
    .line-height-small {
        line-height: 0.5; 
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
    @if (!$fromExpedienteMedico)
        <h1 class="mt-4">Ver informe de salud</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('informe_salud.index') }}">Informes de salud</a></li>
            <li class="breadcrumb-item active">Ver informe de salud</li>
        </ol>
    @endif
    

    <!-- Detalles del informe de salud -->
    <div class="container mt-4 border p-4">
        <div class="container mt-4">
            <!-- Encabezado centrado -->
            <div class="text-center line-height-small">
                <h3 class="fw-bold ">ESCUELA SECUNDARIA TECNICA N 66</h3>
                <p>CLAVE: 20DST0062I</p>
                <p>CUILAPAN DE GUERRERO, OAX</p>
            </div>

            <!-- Línea continua -->
            <hr class="my-4">

            <!-- Texto centrado -->
            <div class="text-end line-height-small">
                <p>ASUNTO: JUSTIFICANTE DE INASISTENCIA</p>
            </div>

            <!-- Fecha y destinatario -->
            <div class="mt-4 line-height-small">
                <p class="text-end">Cuilapam de guerrero, Oax, <strong>{{ \Carbon\Carbon::parse($informe_salud->fecha)->day }}</strong> de <strong>{{ \Carbon\Carbon::parse($informe_salud->fecha)->month }}</strong> de <strong>{{ \Carbon\Carbon::parse($informe_salud->fecha)->year }}</strong></p>
                <p>CC: PERSONAL DOCENTE</p>
                <p>ESC. SEC. TEC. No 66</p>
                <p>PRESENTE</p>
            </div>

            <!-- Cuerpo del justificante -->
            <div class="mt-4">
                <p>
                    Por medio del presente le comunico que el (la) alumno (a): <strong>{{ $informe_salud->expedienteMedico->alumno->nombre }} {{ $informe_salud->expedienteMedico->alumno->apellido }}</strong> del <strong>{{ $informe_salud->grado }}</strong> grado, grupo <strong>{{ $informe_salud->grupo }}</strong>, actualmente presenta como diagnóstico: <strong>{{ $informe_salud->diagnostico }}</strong>.
                </p>
                <p>
                    Por el cual <strong>{{ $informe_salud->motivo }}</strong>, por lo cual solicitamos su comprensión y apoyo a partir del <strong>{{ $informe_salud->fecha_inicio }}</strong> o hasta nueva orden.
                </p>
                <p>
                    Recomendaciones: <strong>{{ $informe_salud->recomendaciones }}</strong>
                </p>
                <p>
                    Agradeciendo de antemano la atención prestada al presente y haciendo de su conocimiento, aprovechamos para enviarle un cordial saludo.
                </p>
            </div>

            
            <div class="row mt-4">
                <div class="col text-center">
                    <p class="line-height-small">Atentamente</p>
                    <p class="line-height-small">Servicio médico</p>
                    <!--p>...........</p -->
                    <br>
                    
                    <p>DRA. <strong>{{ $informe_salud->nombre_medico }}</strong></p>
                </div>

                <div class="col text-center">
                    <p class="line-height-small">Vo.Bo.</p>
                    <p class="line-height-small">DIRECTOR DE LA ESCUELA</p>
                    <!--p>...........</p -->
                    <br>
                    
                    <p>MTRO. ULTIMIO GALLO GONZALEZ</p>
                </div>
            </div>

        </div>   
    </div>

    <!-- Botón para regresar -->
    @if ($fromExpedienteMedico)
        <div class="text-center mt-4">
            <a href="{{ route('expedientes_medicos.show', $justificante->expedienteMedico->id) }}" class="btn btn-primary">Volver al expediente</a>
        </div>
    @else
        <div class="text-center mt-4">
            <a href="{{ route('informe_salud.index') }}" class="btn btn-primary">Volver a la lista</a>
        </div>
    @endif
</div>
@endsection

@push('js')
@endpush