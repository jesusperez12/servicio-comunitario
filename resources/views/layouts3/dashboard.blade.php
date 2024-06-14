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
    <body class="hold-transition skin-blue-light sidebar-mini fixed">
        <div class="wrapper">

            <!-- Main Header -->
            <header class="main-header">

                <!-- Logo -->
                <a href="{{ url('/') }}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><img src="{{ URL::asset('assets/images/logo_mini.png') }}" alt="UPEL Administración"></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><img src="{{ URL::asset('assets/images/logo_login_2.png') }}" alt="UPEL Administración"></span>
                </a>

                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                @yield('title_pages')

                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        @if(auth()->user()->gender == 0)
                        <img src="{{ URL::asset('assets/images/woman_user_profile.png') }}" class="user-image" alt="Imagen de usuario">
                        @else
                        <img src="{{ URL::asset('assets/images/man_user_profile.png') }}" class="user-image" alt="Imagen de usuario">
                        @endif
                        <span class="hidden-xs">{{ auth()->user()->shortname() }}</span>
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs"></span>
                        </a>
                        <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            @if(auth()->user()->gender == 0)
                            <img src="{{ URL::asset('assets/images/woman_user_profile.png') }}" class="img-circle" alt="Imagen de usuario">
                            @else
                            <img src="{{ URL::asset('assets/images/man_user_profile.png') }}" class="img-circle" alt="Imagen de usuario">
                            @endif

                            <p>
                            {{ auth()->user()->shortname() }}
                            <small></small>
                            </p>
                        </li>
                        
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                            <!--<a href="#" class="btn btn-default btn-flat">Profile</a>-->
                            </div>
                            <div class="pull-right">
                            <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Salir</a>
                            </div>
                        </li>
                        </ul>
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
    </body>
</html>