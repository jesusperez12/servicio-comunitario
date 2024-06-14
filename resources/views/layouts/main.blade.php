<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ __('S.C') }}</title>
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('img/logo-upel.png') }}">
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <!--<link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}"> -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

 <!--CSS Files -->
  <link href="{{ asset('css/material-dashboard.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
 <!--<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  -->
 <link rel="stylesheet" href="{{asset('distSelectBostrad/css/bootstrap-select.min.css')}}">
<!-- CSS file -->
<link rel="stylesheet" href="{{asset('css/easy-autocomplete.min.css')}}">
 <!--<link rel="stylesheet" href="{{asset('css/select2.min.css')}}">---->
<link rel="stylesheet" href="" />
<link rel="stylesheet" href="{{ asset('tokeninput/styles/token-input.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
<!--<link rel="stylesheet" href="{{ asset('css/bootstrap5.min.cs') }}" />-->
 <link href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css" /> 
       <!---css para las Notificaciones  ---->
    <link rel="stylesheet" href="{{ asset('css/Lobibox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap4-toggle.min.css') }}">
    <link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-datepicker3.css')}}">
   <!--- <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet"> -->
   <!--- <link rel="stylesheet" href="{{ asset('js/jquery-ui/jquery-ui.min.css') }}"> ---->
   @livewireStyles
</head>

<body class="{{ $class ?? '' }}">


  @auth()
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
  </form>
  @include('layouts.page_templates.auth')
  @endauth

  @guest()
    @include('layouts.page_templates.guest')
    
  @endguest




  <!--   Core JS Files   -->
  <script src="{{ asset('js/jquery.min.js') }}"></script>
 <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script> -->

  <script src="{{ asset('js/core/popper.min.js') }}"></script>
  <script src="{{ asset('js/core/bootstrap-material-design.min.js') }}"></script>
  {{-- <script src="{{ asset('js/plugins/perfect-scrollbar.jquery.min.js') }}"></script> --}}
  <script src="{{ asset('js/select2.min.js') }}"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
-->
   <!--<script src="{{asset('js/select2.min.js')}}"></script>-->
      <script src="{{asset('js/axios.min.js')}}"></script>
<!--<script src="{{ asset('js/bootstrap.min.js') }}"></script> -->

<!-- Libreria js para las Notificaciones -->
<script src="{{ asset('js/Lobibox.js') }}"></script>
<script src="{{ asset('js/notification-active.js') }}"></script>
<!-- <script src="{{ asset('js/jquery-ui/jquery-ui.min.js') }}"></script> -->
<script src="{{ asset('distSelectBostrad/js/bootstrap-select.min.js') }}"></script>  
<script src="{{asset('js/jquery.easy-autocomplete.min.js')}}"></script>
<script src="{{ asset('tokeninput/src/jquery.tokeninput.js') }}"></script>

<script src="{{ asset('js/dataTables.min.js') }}"></script>
<!--<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script> -->

<script src="{{ asset('js/dataTables.bootstrap5.min.js') }}"></script>
<!-- <script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>-->

<script src="{{ asset('js/bootstrap4-toggle.min.js') }}"></script>
<!--
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
@stack('js')
    @yield('scripts')
    @include('sweetalert::alert')
    @livewireScripts
</body>
</html>