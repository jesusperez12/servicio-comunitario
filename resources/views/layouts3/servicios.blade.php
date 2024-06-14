<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ __('S.C') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{URL::asset('assets/css/vendor.css')}}">
  <link rel="stylesheet" href="{{URL::asset('assets/css/admin-lte.css')}}">
  <link rel="stylesheet" href="{{URL::asset('assets/css/app.css')}}">

</head>
<body class="hold-transition login-page">
  @yield('content')
<!-- jQuery 2.2.3 -->
<script src="{{URL::asset('assets/js/vendor.js')}}"></script>
<script src="{{URL::asset('assets/js/common.js')}}"></script>
<script src="{{URL::asset('assets/js/admin-lte.js')}}"></script>
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
</body>
</html>
