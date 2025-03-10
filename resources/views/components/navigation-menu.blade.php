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
           
            <div class="sb-sidenav-menu-heading">Modulos</div>

            <a class="nav-link" href="{{route('expedientes_medicos.index')}}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-suitcase-medical"></i></div>
                Expedientes Medicos
                <!-- Agregar Expediente-->
            </a>
            <a class="nav-link" href="{{route('control_de_citas.index')}}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-notes-medical"></i></div>
                Citas Medicas
                <!-- Agregar cita medica-->
            </a>
            <a class="nav-link" href="{{route('justificante_inasistencia_medico.index')}}">
                <div class="sb-nav-link-icon"><i class="fa-regular fa-calendar-days"></i></div>
                Justificantes de Inasistencias Medica
                <!-- Justificante de inasistencia medica-->
            </a>
            <a class="nav-link" href="{{route('informe_salud.index')}}">
                <div class="sb-nav-link-icon"><i class="fa-regular fa-registered"></i></div>
                Informes de salud
                <!-- Informe de salud-->
            </a>
            <a class="nav-link" href="">
                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                Tables
            </a> 
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Bienvenido:</div>
        Start Bootstrap
    </div>
</nav>