@extends('layouts3.login')

@section('content')
 

<div class="login-box">
  <div class="login-box-body">

<FONT SIZE=5><center>Servicio Comunitario Prestadores</center></font>
  <br>

  <form class="form" method="POST" action="{{ route('Estudiantes.login.submit') }}">
                @csrf

                  <div class="bmd-form-group{{ $errors->has('ci') ? ' has-danger' : '' }}">
        <input type="text" name="ci" class="form-control" placeholder="{{ __('Cédula') }}"
                                    value="{{ old('ci', null) }}" required autocomplete="ci" autofocus>
        <span class="fa fa-envelope form-control-feedback"></span>
             @if ($errors->has('ci'))
                            <div id="ci-error" class="error text-danger pl-3" for="ci" style="display: block;">
                                <strong>{{ $errors->first('ci') }}</strong>
                            </div>
                            @endif
      </div>

     <div class="bmd-form-group{{ $errors->has('password') ? ' has-danger' : '' }} mt-3">
       <input type="password" name="password" id="password" class="form-control"
                                    placeholder="{{ __('Contraseña...') }}" required autocomplete="current-password">
       <span class="fa fa-key form-control-feedback"></span>
       @if ($errors->has('password'))
                            <div id="password-error" class="error text-danger pl-3" for="password"
                                style="display: block;">
                                <strong>{{ $errors->first('password') }}</strong>
                            </div>
                            @endif
      </div>
      

  
                 <div style="text-align: center">
          <button type="submit" class="btn btn-block Active info button btn-success ">Iniciar</button>
        </div>
            </form>

  </div>
  <!-- /.login-box-body -->
</div>

@endsection

@section('scripts')
<script src="{{ URL::asset('assets/js/login.js') }}"></script>
<script src="{{asset('js/sweetalert.min.js')}}"></script>
<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- iCheck -->
<script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
@endsection



