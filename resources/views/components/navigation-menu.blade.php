<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Inicio</div>
            <a class="nav-link" href="index.html">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Panel
            </a>
            <!--
            <div class="sb-sidenav-menu-heading">Interface</div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Layouts
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="layout-static.html">Static Navigation</a>
                    <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                </nav>
            </div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                Pages
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                        Authentication
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="login.html">Login</a>
                            <a class="nav-link" href="register.html">Register</a>
                            <a class="nav-link" href="password.html">Forgot Password</a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                        Error
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="401.html">401 Page</a>
                            <a class="nav-link" href="404.html">404 Page</a>
                            <a class="nav-link" href="500.html">500 Page</a>
                        </nav>
                    </div>
                </nav>
            </div>
        -->


            @can('ver-expedienteMedico')
            <div class="sb-sidenav-menu-heading">Medicos</div>
            <a class="nav-link" href="{{route('expedientes_medicos.index')}}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-suitcase-medical"></i></div>
                Expedientes Medicos
                <!-- Agregar Expediente-->
            </a>
            @endcan

            @can('ver-controlDeCita')
            <a class="nav-link" href="{{route('control_de_citas.index')}}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-notes-medical"></i></div>
                Citas Medicas
                <!-- Agregar cita medica-->
            </a>
            @endcan

            @can('ver-justificanteMedico')
            <a class="nav-link" href="{{route('justificante_inasistencia_medico.index')}}">
                <div class="sb-nav-link-icon"><i class="fa-regular fa-calendar-days"></i></div>
                Justificantes de Inasistencias Medica
                <!-- Justificante de inasistencia medica-->
            </a>
            @endcan

            @can('ver-informeSalud')
            <a class="nav-link" href="{{route('informe_salud.index')}}">
                <div class="sb-nav-link-icon"><i class="fa-regular fa-registered"></i></div>
                Informes de salud
                <!-- Informe de salud-->
            </a>
            @endcan


            @if(auth()->user()->can('ver-expedienteDisciplinario') || auth()->user()->can('ver-paseSalidaTrabSociale'))
           
            <div class="sb-sidenav-menu-heading">Disciplinarios</div>

            <a class="nav-link" href="{{route('expediente_disciplinario.index')}}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-folder-plus"></i></div>
                Expedientes Disciplinarios
                <!-- Agregar Expediente-->
            </a>

            @endif


            @can('ver-citatorio')
            <a class="nav-link" href="{{route('citatorio.index')}}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-calendar-check"></i></div>
                Citatorio Individual
                <!-- Citarorio individual-->
            </a>
            @endcan


            @can('ver-citatorioGeneral')
            <a class="nav-link" href="{{route('citatorio_general.index')}}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-calendar-week"></i> </div>
                Citatorio General
                <!-- Citarorio individual-->
            </a>
            @endcan


            @can('ver-paseSalida')
            <a class="nav-link" href="{{route('pase_salida.index')}}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-person-walking-arrow-right"></i></div>
                Pase de Salida
                <!-- Pase de salida general-->
            </a>
            @endcan


            @can('ver-reporteIncidencia')
            <a class="nav-link" href="{{route('reporte_incidencia.index')}}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-flag"></i></div>
                Reporte de Incidencia
                <!-- Reporte de Incidencia-->
            </a>
            @endcan

            @can('ver-suspencionClase')
            <a class="nav-link" href="{{route('suspencion_clase.index')}}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-circle-exclamation"></i></div>
                Suspenci&oacuten de clases
                <!-- Suspencion de clases disciplinaria-->
            </a>
            @endcan

            @can('ver-paseSalidaTrabSociale')
            <div class="sb-sidenav-menu-heading">Trabajo Social</div>

            <a class="nav-link" href="{{route('pase_salida_trab_sociale.index')}}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-person-walking-dashed-line-arrow-right"></i></div>
                Pase de Salida Trabajo Social
                <!-- Pase de salida del trabajo social -->
            </a>
            @endcan


            @can('ver-permisoTrabSociale')
            <a class="nav-link" href="{{route('permiso_trab_sociale.index')}}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-file-invoice"></i></div>
                Permiso de Ausencia
                <!-- Permiso de Ausencia-->
            </a>


            @endcan

            @can('ver-justiRetardoSociale')
            <a class="nav-link" href="{{route('justi_retardo_sociale.index')}}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-check-to-slot"></i></div>
                Justificante de Retardo
                <!-- Justificante de retardo por trabajo social-->
            </a>
            @endcan


            @can('ver-user')
            <div class="sb-sidenav-menu-heading">Otros</div>

            <a class="nav-link" href="{{route('users.index')}}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                Usuarios
                <!-- Usuarios-->
            </a>
            @endcan


            @can('ver-role')
            <a class="nav-link" href="{{route('roles.index')}}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-person-circle-plus"></i></div>
                Roles
                <!-- Roles-->
            </a>
            @endcan

        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Bienvenido:</div>
        {{auth()->user()->name}}
    </div>
</nav>
