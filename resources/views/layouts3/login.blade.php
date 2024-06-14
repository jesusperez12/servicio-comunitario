<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ __('S.C') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <link rel="icon" type="image/png" href="{{ asset('img/logo-upel.png') }}">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{ asset('assetslogin/css/vendor.css')}}">
  <link rel="stylesheet" href="{{ asset('assetslogin/css/admin-lte.css')}}">
  <link rel="stylesheet" href="{{ asset('assetslogin/css/app.css')}}">
  <link rel="stylesheet" href="{{ asset('assetslogin/css/style.css')}}">

</head>

<header>

  <div class="row" style="background-color:#061b90 border-bottom:2px solid #061b90">

    <div class="col-sm-6" >

    <img src="{{ asset('img/logoupel.png') }}" alt="Admisión UPEL" height="60px" width="380px">

    </div> 

  </div>

</header>

<body class="hold-transition login-page" style="background-color:#ffffff">
  @yield('content')
<!-- jQuery 2.2.3 -->
<script src="{{ asset('assetsloginlogin/js/vendor.js')}}"></script>
<script src="{{ asset('assetslogin/js/common.js')}}"></script>
<script src="{{ asset('assetslogin/js/admin-lte.js')}}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
@yield('scripts')
 @include('sweetalert::alert')
</body>

<footer  style=" height:50px; background-color:#002147" >

  <p style="color:white;text-align: center"> Universidad Pedagógica Experimental Libertador. <strong href="#" style="text-decoration: underline;"> <a href="#"> Acerca de esta Aplicación WEB.</a> </strong></p>

</footer>

</html>
