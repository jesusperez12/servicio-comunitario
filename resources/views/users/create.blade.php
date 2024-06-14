@extends('layouts.main', ['activePage' => 'users', 'titlePage' => 'Nuevo usuario'])
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
       
          <div class="card">
            <div class="card-header card-header-info">
              <h4 class="card-title">Usuario</h4>
              <p class="card-category">Ingresar datos</p>
            </div>
            <div class="card-body">
              {{-- @if ($errors->any())
                  <div class="alert alert-danger">
                    <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
              @endif --}}
               <form action="{{ route('users.store') }}" method="post" class="form-horizontal">
          @csrf
             
            <div class="card card-danger">
             
              <div class="card-body">
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="ci">Número de identidad</label>
                                <div class="input-group">
                                    <span class="input-group-addon">V-</span>
                                    <input id="ci" name="ci" type="text" class="form-control numeric-input" placeholder="CÉDULA DE IDENTIDAD">
                                </div>
                                 @if ($errors->has('ci'))
                                    <span class="error text-danger" for="input-ci">{{ $errors->first('ci') }}</span>
                                  @endif
                            </div>
                            <div class="form-group">
                                <label for="firstname">Primer nombre</label>
                                <input id="firstname" name="firstname" type="text" class="form-control" >
                                  @if ($errors->has('firstname'))
                                    <span class="error text-danger" for="input-firstname">{{ $errors->first('firstname') }}</span>
                                  @endif
                            </div>
                            <div class="form-group">
                                <label for="middlename">Segundo nombre</label>
                                <input id="middlename" name="middlename" type="text" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="primary_lastname">Primer apellido</label>
                                <input id="primary_lastname" name="primary_lastname" type="text" class="form-control" >
                                   @if ($errors->has('primary_lastname'))
                                    <span class="error text-danger" for="input-primary_lastname">{{ $errors->first('primary_lastname') }}</span>
                                  @endif
                            </div>
                            <div class="form-group">
                                <label for="second_lastname">Segundo apellido</label>
                                <input id="second_lastname" name="second_lastname" type="text" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="date_birth">Fecha de nacimiento</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="input-group input-group-static my-3"></i></span>
                                    <input id="date_birth" name="date_birth" type="date" class="form-control date-default">
                                </div>
                                 @if ($errors->has('date_birth'))
                                    <span class="error text-danger" for="input-date_birth">{{ $errors->first('date_birth') }}</span>
                                  @endif
                            </div>
                        </div>

                       

                   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="address">Dirección</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                    <input id="address" name="address" type="text" class="form-control" placeholder="Dirección">
                                </div>
                                  @if ($errors->has('address'))
                                    <span class="error text-danger" for="input-address">{{ $errors->first('address') }}</span>
                                  @endif
                            </div>
                            <div class="form-group">
                                <label for="state">Estado</label>
                                <select id="state" name="state" class="form-control address-select" style="width:100%;" >
                                @if($states)
                                    @foreach($states AS $state)
                                    <option data-id="{{ $state->id }}" value="{{ $state->id  }}">{{ $state->state }}</option>
                                    @endforeach
                                @endif
                                </select >
                                 @if ($errors->has('state'))
                                    <span class="error text-danger" for="input-state">{{ $errors->first('state') }}</span>
                                  @endif
                            </div>
                            <div class="form-group">
                                <label for="province">Municipio</label>
                                <select id="province" name="province" class="form-control address-select" style="width:100%;">
                                </select>
                                @if ($errors->has('province'))
                                    <span class="error text-danger" for="input-province">{{ $errors->first('province') }}</span>
                                  @endif
                            </div>
                            <div class="form-group">
                                <label for="locality">Parroquia</label>
                                <select id="locality" name="locality" class="form-control address-select" style="width:100%;">
                                </select>
                                 @if ($errors->has('locality'))
                                    <span class="error text-danger" for="input-locality">{{ $errors->first('locality') }}</span>
                                  @endif
                            </div>
                            <div class="form-group">
                                <label for="email">Correo electrónico</label>
                                <input id="email" name="email" type="email" class="form-control lowercase-style" placeholder="CORREO ELECTRÓNICO">
                               @if ($errors->has('email'))
                                    <span class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                                  @endif
                            </div>
                            <div class="form-group">
                                <label for="phones">
                                    Teléfono(s) 
                                    &nbsp;
                                    <span>
                                    <a href="#!" id="plus-phone" 
                                    data-toggle="tooltip" data-container="body" data-title="Añadir teléfono" data-placement="top">
                                        <i class="fa fa-plus-circle"></i>
                                    </a>
                                    </span>
                                </label>
                                <div id="element-phone" class="element-phone">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-location-arrow"></i></span>
                                        <select name="codes[]" type="text" class="form-control code">
                                        @if($area_codes)
                                            @foreach($area_codes AS $code)
                                            <option value="{{ $code->id }}">{{ $code->code }}</option>
                                            @endforeach
                                        @endif
                                        </select>
                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        <input id="phones" name="phones[]" type="text" class="form-control phone numeric-input" maxlength="7" placeholder="Número de teléfono">
                                    </div>
                                      @if ($errors->has('phones'))
                                    <span class="error text-danger" for="input-phones">{{ $errors->first('phones') }}</span>
                                  @endif
                                </div>
                                <div class="optional-plus-phones"></div>
                            </div>
                        </div>
                   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                       <div class="form-group">
                                <label for="sede_id">Institutos</label>
                                @if(isset($sedes))
                                {{ Form::select('sede_id', $sedes, null, ['class'=>'form-control', 'placeholder' => '.:Seleccione:.', 'id'=>'sede_id']) }}
                                    
                                @endif
                                 @if ($errors->has('sede_id'))
                                    <span class="error text-danger" for="input-sede_id">{{ $errors->first('sede_id') }}</span>
                                  @endif
                            </div>

                            <!-- <div class="form-group">
                                <label for="speciality">Especialidad</label>
                              
                                @if(isset($especialidades))
                                {{ Form::select('speciality', $especialidades, null, ['class'=>'form-control speciality-select', 'placeholder' => '.:Seleccione:.', 'id'=>'speciality']) }}
                              
                                @endif
                                  @if ($errors->has('speciality'))
                                    <span class="error text-danger" for="input-speciality">{{ $errors->first('speciality') }}</span>
                                  @endif
                            </div>-->
                      
                            <div class="form-group">
                                <label for="role_id">Rol del usuario</label>
                                @if(isset($roles))
                                {{ Form::select('role_id', $roles, null, ['class'=>'form-control', 'placeholder' => '.:Seleccione:.', 'id'=>'role_id']) }}
                                    
                                @endif
                               
                                  @if ($errors->has('role_id'))
                                    <span class="error text-danger" for="input-role_id">{{ $errors->first('role_id') }}</span>
                                  @endif
                            </div>
                         
                           
                            <div class="form-group">
                                <label for="password">Asignar contraseña</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input id="password" name="password" type="password" class="form-control" placeholder="Contraseña">
                                    <input id="show-password" type="text" class="form-control" value="" placeholder="Contraseña" readonly>
                                    <span id="toggle-password" class="input-group-addon" data-toggle="tooltip" data-container="body" data-title="Mostrar u Ocultar"><i class="fa fa-eye"></i></span>
                                    <span id="generate-password" class="input-group-addon" data-toggle="tooltip" data-container="body" data-title="Generar contraseña"><i class="fa fa-keyboard-o"></i></span>
                                </div>
                                 @if ($errors->has('password'))
                                    <span class="error text-danger" for="input-password">{{ $errors->first('password') }}</span>
                                  @endif
                            </div>
                            <div class="form-group">
                                <label>Status del usuario</label>
                                <div class="radio">
                                    <label for="active">
                                        <input id="active" class="square_radio" name="status" type="radio" value="0" checked>
                                        Activo
                                    </label>
                                </div>
                                <div class="radio">
                                    <label for="pending">
                                        <input id="pending" class="square_radio" name="status" type="radio" value="1">
                                        Pendiente
                                    </label>
                                </div>
                               @if ($errors->has('status'))
                                    <span class="error text-danger" for="input-status">{{ $errors->first('status') }}</span>
                                  @endif
                            </div>
                            <div class="form-group">
                                <label>Género</label>
                                <div class="radio">
                                    <label for="woman">
                                        <input id="woman" class="square_radio" name="gender" type="radio" value="0" checked>
                                        Femenino
                                    </label>
                                </div>
                                <div class="radio">
                                    <label for="man">
                                        <input id="man" class="square_radio" name="gender" type="radio" value="1">
                                        Masculino
                                    </label>
                                </div>
                                 @if ($errors->has('gender'))
                                    <span class="error text-danger" for="input-gender">{{ $errors->first('gender') }}</span>
                                  @endif
                            </div>
                        </div>
              </div>


                <div style="text-align: center">
              <button type="submit" class="btn btn-info">Guardar</button>
            </div>


              <!-- /.card-body -->
            </div>


              
            </div>
             </form>
            <!--Footer-->
          
            <!--End footer-->
          </div>
       
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')

 <script type ="text/javascript">

$(document).ready(function() {
    $('.select2').select2();
});


     $(function () { 
            $('#state').change(function(){
                var valor = $(this).val();
               // console.log(valor);
            $("#province").empty();
            axios.get('{{ route("get-Municipios")}}',{
                params: {
                valor : valor
                
            }
        }).then(response =>{
                $('#province').append('<option>--Seleccione--</option>');
                response.data.forEach(provinces => {
                $('#province').append('<option value="'+provinces.id+'">'+provinces.province+'</option>');
                //console.log(response.data);
            });
        
            }); 
        });

        $('#province').change(function(){
            var valor = $(this).val();
            $("#locality").empty();
            axios.get('{{ route("get-Parroquias")}}',{
                params: {
                valor : valor
            }
        }).then(response =>{
                $('#locality').append('<option>--Seleccione--</option>');
                response.data.forEach(localities => {
                $('#locality').append('<option value="'+localities.id+'">'+localities.locality+'</option>');
            });     
        }); 
    }); 
});     





</script>
@endsection

