<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight" style="color: white">PANEL DE CONTROL</span>
    </a>

    <div class="sidebar">

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="true">

                <!-- ROLES Y PERMISO -->
                @can('sidebar.roles.y.permisos')
                    <li class="nav-item">

                        <a href="#" class="nav-link nav-">
                            <i class="far fa-edit"></i>
                            <p>
                                Roles y Permisos
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.roles.index') }}" target="frameprincipal" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Rol y Permisos</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.permisos.index') }}" target="frameprincipal" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Usuario</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link nav-">
                            <i class="bi bi-card-checklist mr-1" style="font-size: 1.3rem;"></i>
                            <p>
                                Uso de APIs
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.geolocalizacion.index') }}" target="frameprincipal" class="nav-link">
                                    <i class="bi bi-geo-alt mr-2"></i>
                                    <p>Geolocalizacion</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.webworker.index') }}" target="frameprincipal" class="nav-link">
                                    <i class="bi bi-pc mr-2"></i>
                                    <p>Web Workers</p>
                                </a>
                            </li>
                        </ul>

                        
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.canva.index') }}" target="frameprincipal" class="nav-link">
                                    <i class="bi bi-geo-alt mr-2"></i>
                                    <p>Canvas</p>
                                </a>
                            </li>
                        </ul>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.video.index') }}" target="frameprincipal" class="nav-link">
                                    <i class="bi bi-person-video mr-2"></i>
                                    <p>Video</p>
                                </a>
                            </li>
                        </ul>

                    </li>
                @endcan




            </ul>
        </nav>


    </div>
</aside>
