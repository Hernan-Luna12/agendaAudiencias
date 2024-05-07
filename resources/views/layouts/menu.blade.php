<div class="main-menu menu-fixed menu-dark bg-personal-green menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto">
            	<a class="navbar-brand">
            		<span class="brand-logo"></span>
                    {{-- <h2 class="brand-text text-white p-0">{{ config('app.name') }}</h2> --}}
                    <h2 class="brand-text text-white ps-0">Documentos</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle">
            	<a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse">
	            	<i class="d-block d-xl-none text-danger toggle-icon font-medium-4" data-feather="x"></i>
	            	<i class="d-none d-xl-block collapse-toggle-icon font-medium-4 text-danger" data-feather="sidebar"></i>
	            </a>
	        </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main bg-personal-green" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item {!! classActiveSegment(1, 'dashboard') !!}">
            	<a class="d-flex align-items-center" href="{{ route('dashboard') }}">
	            	<i data-feather="home"></i>
	            	<span class="menu-title text-truncate align-bottom">{{ __('Dashboard') }}</span>
	            </a>
            </li>
            <li class="navigation-header mt-1">
            	<span>MENU</span>
            	<i data-feather="more-horizontal"></i>
            </li>
            @can('Administracion')
                <li class=" nav-item {!! classActiveSegment(1, ['usuarios', 'perfiles', 'categoriaspermisos', 'permisos']) !!}">
                    <a class="d-flex align-items-center" href="#">
                        <i data-feather="settings"></i>
                        <span class="menu-title text-truncate">Administración</span>
                    </a>
                    <ul class="menu-content bg-transparent">
                        {{-- @can('Catalogos')
                            <li class=" nav-item {!! classActiveSegment(1, 'catalogos') !!}">
                                <a class="d-flex align-items-center" href="{{ route('catalogos') }}">
                                    <i data-feather="list"></i>
                                    <span class="menu-item text-truncate">Catálogos</span>
                                </a>
                            </li>
                        @endcan --}}
                        @can('Usuarios')
                            <li class=" nav-item {!! classActiveSegment(1, 'usuarios') !!}">
                                <a class="d-flex align-items-center" href="{{ route('usuarios.index') }}">
                                    <i data-feather="users"></i>
                                    <span class="menu-item text-truncate">Usuarios</span>
                                </a>
                            </li>
                        @endcan
                        @can('Perfiles')
                            <li class=" nav-item {!! classActiveSegment(1, 'perfiles') !!}">
                                <a class="d-flex align-items-center" href="{{ route('perfiles.index') }}">
                                    <i data-feather="shield"></i>
                                    <span class="menu-item text-truncate">Perfiles</span>
                                </a>
                            </li>
                        @endcan
                        @can('Permisos')
                            <li class=" nav-item {!! classActiveSegment(1, 'permisos') !!}">
                                <a class="d-flex align-items-center" href="{{ route('permisos.index') }}">
                                    <i data-feather="sliders"></i>
                                    <span class="menu-item text-truncate">Permisos</span>
                                </a>
                            </li>
                        @endcan
                        @can('Categorias')
                            <li class=" nav-item {!! classActiveSegment(1, 'categoriaspermiso') !!}">
                                <a class="d-flex align-items-center" href="{{ route('categoriaspermiso.index') }}">
                                    <i data-feather="grid"></i>
                                    <span class="menu-item text-truncate">Categorías Permisos</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
        </ul>
    </div>
</div>
