@extends('layouts3.login')

@section('content')
 

<div class="login-box">
  <div class="login-box-body">

<FONT SIZE=5><center><strong> SERVICIO COMUNITARIO </strong></center></font>
  <br>

    <form class="form" method="POST" action="{{ route('login') }}">
                @csrf

                <div class="bmd-form-group{{ $errors->has('username') ? ' has-danger' : '' }}">
        <input type="text" name="username" class="form-control" placeholder="{{ __(' Correo') }}"
                                    value="{{ old('username', null) }}" required autocomplete="username" autofocus>
        <span class="fa fa-envelope form-control-feedback"></span>
          @if ($errors->has('username'))
                            <div id="username-error" class="error text-danger pl-3" for="username" style="display: block;">
                                <strong>{{ $errors->first('username') }}</strong>
                            </div>
                            @endif
      </div>

     <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
       <input id="password" type="password" class="form-control" name="password" required placeholder="Contraseña">
       <span class="fa fa-key form-control-feedback"></span>
        @if ($errors->has('password'))
             <span class="help-block">
               <strong>{{ $errors->first('password') }}</strong>
             </span>
           @endif
      </div>
      
      <div class="col-xs-6">
<button type="submit" class="btn btn-block Active info button btn-success ">Iniciar</button>
        </div>
        <div class="col-xs-6">
        <a href="{{url('Estudiantes/login')}}" class="btn btn-block  btn-info ">Prestadores</a>
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



