@extends('layouts.dashboard')

@section('menu_sidebar')
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
            @if(auth()->user()->gender == 0)
            <img src="{{ URL::asset('assets/images/woman_user_profile.png') }}" class="img-circle" alt="Imagen de usuario">
            @else
            <img src="{{ URL::asset('assets/images/man_user_profile.png') }}" class="img-circle" alt="Imagen de usuario">
            @endif
            </div>
            <div class="pull-left info">
            <p>{{ auth()->user()->firstname }} {{ auth()->user()->primary_lastname }}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Conectado</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" id="sidebar-menu">
            <!-- MENU DE PROYECTOS -->
            @can('coordinator_routes_projects')
            <li class="header">GESTIÓN DE PROYECTOS</li>
            <li><a href="{{ url('/admin/coordinador/servicio/periodos') }}"><i class="fa fa-clock-o"></i> <span>Periodos académicos</span></a></li>
            <li><a href="{{ url('/admin/coordinador/projects') }}"><i class="fa fa-list"></i> <span>Listado de proyectos</span></a></li>
            <li><a href="{{ url('/admin/coordinador/project/add') }}"><i class="fa fa-plus-circle"></i> <span>Nuevo proyecto</span></a></li>
            <!--<li><a href="{{ url('/admin/search/projects') }}"><i class="fa fa-search"></i> <span>Buscador de proyectos</span></a></li>-->
            @endcan
            @can('teacher_routes_projects')
            <li class="header">GESTIÓN DE PROYECTOS</li>
            <li><a href="{{ url('/admin/profesor/projects') }}"><i class="fa fa-list"></i> <span>Mis proyectos</span></a></li>
            <li><a href="{{ url('/admin/profesor/project/add') }}"><i class="fa fa-plus-circle"></i> <span>Nuevo proyecto</span></a></li>
            <!--<li><a href="{{ url('/admin/search/projects') }}"><i class="fa fa-search"></i> <span>Buscador de proyectos</span></a></li>-->
            @endcan
            <!-- MENU DE SERVICIO -->
          
           
            <li class="header">GESTIÓN DE SERVICIO COMUNITARIO</li>
            <li><a href="{{ url('/admin/profesor/service/projects') }}"><i class="fa fa-archive"></i> <span>Proyectos en ejecución</span></a></li>
            <li><a href="{{ url('/admin/profesor/service/reports') }}"><i class="fa fa-flag-checkered"></i> <span>Reportes de actividades</span></a></li>
            <li><a href="{{ url('/admin/service/providers') }}"><i class="fa fa-users"></i> <span>Prestadores del servicio</span></a></li>
           
          
            
            <!-- MENU DE USUARIOS -->
           
            <li class="header">GESTIÓN DE USUARIOS</li>
            <li><a href="{{ url('/admin/users') }}"><i class="fa fa-list"></i> <span>Listado de usuarios</span></a></li>
            <li><a href="{{ url('/admin/user/add') }}"><i class="fa fa-user-plus"></i> <span>Nuevo usuario</span></a></li>
          
            <li class="treeview">
                <a href="#:;"><i class="fa fa-users"></i> <span>Roles y permisos</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <!-- MENU DE ROLES Y PERMISOS -->
                    <li><a href="{{ route('rol.showPageRole') }}"><i class="fa fa-user"></i> <span>Roles</span></a>
                    <li><a href="{{ url('/admin/user/permissions') }}"><i class="fa fa-unlock-alt"></i> <span>Permisos</span></a>
                </ul>
            </li>
            <li><a href="{{ url('/admin/coordinador/servicio/periodos') }}"><i class="fa fa-clock-o"></i> <span>Periodos académicos</span></a></li>
         
          
            <li class="header">OTRAS OPCIONES</li>
            <li><a href="{{ url('/admin/authorities') }}"><i class="fa fa-certificate"></i> <span>Autoridades de certificación</span></a></li>
            <li><a href="{{ url('/admin/certificate/validate') }}"><i class="fa fa-check-square-o"></i> <span>Validación de certificados</span></a></li>
          
           
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
@endsection

@section('dashboard')

    <!-- Main content -->
    <section class="content">

    @yield('content')
        @yield('scripts')

    </section>
    <!-- /.content -->
@endsection