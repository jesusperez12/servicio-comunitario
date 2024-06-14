<div class="sidebar" data-color="azure" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a class="simple-text logo-normal">
    {{ __('Servicio') }}
  <br>
      {{ __('Comunitario') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
    
     
      @can('Periodo_index')
      <li class="nav-item{{ $activePage == 'Periodo' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('Periodo.index') }}">
          <i class="material-icons">groups</i>
            <p>Periodo</p>
        </a>
      </li>
@endcan



      @can('user_index')
      <li class="nav-item{{ $activePage == 'users' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('users.index') }}">
          <i class="material-icons">groups</i>
            <p>Usuarios</p>
        </a>
      </li>
      @endcan
      @can('permission_index')
      <li class="nav-item{{ $activePage == 'permissions' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('permissions.index') }}">
          <i class="material-icons">bubble_chart</i>
          <p>{{ __('Permisos') }}</p>
        </a>
      </li>
      @endcan
      @can('role_index')
      <li class="nav-item{{ $activePage == 'roles' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('roles.index') }}">
          <i class="material-icons">location_ons</i>
            <p>{{ __('Roles') }}</p>
        </a>
      </li>
      @endcan

      @can('proyecto_index')
      <li class="nav-item{{ $activePage == 'proyect' ? ' active' : '' }}">
        <a class="nav-link"  href="{{ route('proyect.index') }}">
          <i class="material-icons">bookmark_added</i>
          <p>{{ __('Proyectos') }}</p>
        </a>
      </li>
      @endcan

      @can('Asignarproyect_index')
      <li class="nav-item{{ $activePage == 'asignarproyect' ? ' active' : '' }}">
        <a class="nav-link"  href="{{ route('asignarproyect') }}">
          <i class="material-icons">content_paste</i>
          <p>{{ __('Asignar Proyectos') }}</p>
        </a>
      </li>
      @endcan

       @can('asesorcomunita_index')

      <li class="nav-itginem{{ $activePage == 'asesorcomunity' ? ' active' : '' }}">
        <a class="nav-link"  href="{{ route('asesorcomunity.index') }}">
          <i class="material-icons">store</i>
          <p>{{ __('Asesor y comunidad') }}</p>
        </a>
      </li>
        @endcan

        @can('prestadores_index')
      <li class="nav-item{{ $activePage == 'Prestadores' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('Prestadores.index') }}">
          <i class="material-icons">supervisor_account</i>
          <p>{{ __('Prestadores') }}</p>
        </a>
      </li>
      @endcan

       @can('actividades_index')
      <li class="nav-item{{ $activePage == 'Actividades' ? ' active' : '' }}">
        <a class="nav-link"  href="{{ route('Actividades.index') }}">
          <i class="material-icons">pending_actions</i>
          <p>{{ __(' Registrar Actividades') }}</p>
        </a>
      </li>
 @endcan
  @can('autoridades_index')
       <li class="nav-item{{ $activePage == 'Autoridades' ? ' active' : '' }}">
        <a class="nav-link"  href="{{ route('Autoridades.index') }}">
          <i class="material-icons">assignment_ind</i>
          <p>{{ __(' Autoridades de certificados') }}</p>
        </a>
      </li>
 @endcan
 @can('certificados_index')
       <li class="nav-item{{ $activePage == 'Certificados' ? ' active' : '' }}">
        <a class="nav-link"  href="{{ route('Certificados.create') }}">
           <i class="material-icons">done_outline</i>
          <p>{{ __('Validar certificado') }}</p>
        </a>
      </li>
       @endcan
    </ul>
  </div>
</div>
