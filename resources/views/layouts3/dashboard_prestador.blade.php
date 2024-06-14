<!DOCTYPE html> 
<html>
    <head>  
    <title>{{ __('S.C') }}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset=UTF-8> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"> 
        <link rel="stylesheet" href="{{URL::asset('assets/css/vendor.css')}}">
        <link rel="stylesheet" href="{{URL::asset('assets/css/admin-lte.css')}}">
        <link rel="stylesheet" href="{{URL::asset('assets/css/app.css')}}">
    </head> 
    <body class="hold-transition skin-blue-light fixed sidebar-collapse">
        <div class="wrapper">

            <!-- Main Header -->
            <header class="main-header">

                <!-- Logo -->
                <a href="{{ url('/prestador') }}" class="logo custom-logo-prestador">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><img src="{{ URL::asset('assets/images/logo_mini.png') }}" alt="UPEL Administración"></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><img src="{{ URL::asset('assets/images/logo_prestador_login.png') }}" alt="UPEL Administración"></span>
                </a>

                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <!--<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>-->

                @yield('title_pages')


                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                    <!-- User Account Menu -->
                    <li class="user-footer">
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();" class="btn btn-block btn-danger btn-sm">
                      <b>Cerrar Sección</b>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                     </form>
                             </li>
                    </ul>
                </div>
                </nav>
            </header>

            @yield('menu_sidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                @yield('dashboard')
            </div>
            <!-- /.content-wrapper -->

            <!-- Main Footer -->
            <footer class="main-footer">
                <!-- To the right -->
                <div class="pull-right hidden-xs">
                <strong>Desarrollador:</strong> Carlos Meneses
                </div>
                <!-- Default to the left -->
                <strong>Copyright &copy; 2016 <a href="http://www.ipm.upel.edu.ve" target="_blank">UPEL - IPM</a>.</strong> Todos los derechos reservados.
            </footer>
        </div>

        <!-- REQUIRED JS SCRIPTS -->
        <script src="{{URL::asset('assets/js/vendor.js')}}"></script>
        <script src="{{URL::asset('assets/js/admin-lte.js')}}"></script>
        <script src="{{URL::asset('assets/js/common.js')}}"></script>
        <!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmfQ4_LLe86sgFrH51k8wY4zMtxMuxBzU&libraries=places"></script> -->

        @yield('scripts')
        @include('sweetalert::alert')
    </body>
</html>