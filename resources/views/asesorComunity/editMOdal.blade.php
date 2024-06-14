
            <div class="card card-danger">
              <div class="card-header">
                <center><h3 class="card-title">Modificar Asesor</h3></center>
              </div>
              <div class="card-body">
            
                <div class="row">
                <div class="col-4">

<div class="form-group label-floating has-success">
  <label for="ci">Identificación</label>
  <input type="text" id="ci" class="form-control numeric-input" name="ci" value="{{ $asesor->ci }}" placeholder="Cédula" maxlength="8">
  @if ($errors->has('ci'))
    <span class="error text-danger" for="input-ci">{{ $errors->first('ci') }}</span>
    @endif
  </div>
</div>



                  <div class="col-4">
                   <div class="form-group label-floating has-success">
                   <label for="firstname">Primer nombre</label>
                   <input type="text" id="firstname" class="form-control" name="firstname" value="{{ $asesor->firstname }}" placeholder="Primer nombre...">
                        
                    </div>
                    @if ($errors->has('firstname'))
                                    <span class="error text-danger" for="input-firstname">{{ $errors->first('firstname') }}</span>
                                  @endif
                  </div>



                  <div class="col-4">
                  <div class="form-group label-floating has-success">
                   <label for="middlename">segudo nombre</label>
                   <input type="text" id="middlename" class="form-control" name="middlename" value="{{ $asesor->middlename }}" placeholder="Segundo nombre...">
                     
                    </div>
                  </div>


                  <div class="col-4">
                  <div class="form-group label-floating has-success">
                  <label for="primary_lastname">Primer apellido</label>
                  <input type="text" id="primary_lastname" class="form-control"  value="{{ $asesor->primary_lastname }}" name="primary_lastname" placeholder="Primer apellido...">
                  @if ($errors->has('primary_lastname'))
                                    <span class="error text-danger" for="input-primary_lastname">{{ $errors->first('primary_lastname') }}</span>
                                  @endif
                    </div>
                  </div>


                  <div class="col-4">
                  <div class="form-group label-floating has-success">
                  <label for="second_lastname">Segundo apellido</label>
                   <input type="text" id="second_lastname" class="form-control"  value="{{ $asesor->second_lastname }}" name="second_lastname" placeholder="Segundo apellido...">
                     
                    </div>
                  </div>

          

                </div>  <!-- /.row -->
                <div class="card-header">
                <center><h3 class="card-title">Modificar Comunidad</h3></center>
              </div>
            
                <div class="row">


                  <div class="col-3">
                  <div class="form-group label-floating has-success">
                  <label for="comunidad">Comunidad</label>
                  <input type="text" id="comunidad" class="form-control" name="comunidad" value="{{ $comunityy->nombre }}" placeholder="Nombre de la comunidad">
                  </div>
                  @if ($errors->has('comunidad'))
                                    <span class="error text-danger" for="input-comunidad">{{ $errors->first('comunidad') }}</span>
                                  @endif
                </div>


                  <div class="col-4">
                  <div class="form-group label-floating has-success">
                  <label for="direccion">Dirección</label>
                  <textarea id="direccion" class="form-control"   name="direccion" placeholder="Dirección...">{{$comunityy->direccion}}</textarea>
                  </div>
                  @if ($errors->has('direccion'))
                                    <span class="error text-danger" for="input-direccion">{{ $errors->first('direccion') }}</span>
                                  @endif
                  </div>

                  <div class="col-5">
                  <div class="form-group label-floating has-success">
                  <label for="sector">Sector</label>
                  <input type="text" id="sector" class="form-control" value="{{ $comunityy->sector }}"  name="sector" placeholder="Sector...">
                  </div>    
                  @if ($errors->has('sector'))
                                    <span class="error text-danger" for="input-sector">{{ $errors->first('sector') }}</span>
                                  @endif
                  </div>


                  <div class="col-3">
                  <div class="form-group label-floating has-success">
                  <label for="state">Estado</label>

                  <select id="state" name="state" class="form-control" >
                                      <option value="" selected disabled>Select</option>
                                      @foreach($states as $stados)
                                      
                                      <option value="{{$stados->id}}"{{ $stados->id == $comunityy->state ? ' selected' : '' }}> {{ $stados->state }}</option>
                                      @endforeach
                                 </select>


              
                  </div>
                  @if ($errors->has('state'))
                                    <span class="error text-danger" for="input-state">{{ $errors->first('state') }}</span>
                                  @endif
            </div>


                  <div class="col-4">
                  <label for="province">Municipio</label>
                

              

                  {{ Form::select('province', $municipio, null, ['class'=>'form-control','id'=>'province']) }}

                          
                            @if ($errors->has('province'))
                                    <span class="error text-danger" for="input-province">{{ $errors->first('province') }}</span>
                                  @endif
                  </div>
                  <div class="col-5">
                  <label for="locality">Parroquia</label>
                  
                            {{ Form::select('locality', $parroquia, null, ['class'=>'form-control','id'=>'locality']) }}


                            @if ($errors->has('locality'))
                                    <span class="error text-danger" for="input-locality">{{ $errors->first('locality') }}</span>
                                  @endif
                  </div>

                  <div class="col-5">
                  <div class="form-group label-floating has-success">
                  <label for="lugar_prestadores">Lugar dónde acamparán prestadores del servicio</label>
                  <input type="text" id="lugar_prestadores" class="form-control" value="{{ $comunityy->lugar_prestadores }}"  name="lugar_prestadores" placeholder="Lugar...">
                  </div>
                  @if ($errors->has('lugar_prestadores'))
                                    <span class="error text-danger" for="input-lugar_prestadores">{{ $errors->first('lugar_prestadores') }}</span>
                                  @endif
                                 </div>

                  <div class="col-5">
                  <div class="form-group label-floating has-success">
                  <label for="direccion_lugar">Dirección de referencia</label>
                  <textarea  id="direccion_lugar" class="form-control"  name="direccion_lugar" placeholder="Dirección de referencia...">{{$comunityy->direccion_lugar}} </textarea>
                  </div>
                  @if ($errors->has('direccion_lugar'))
                                    <span class="error text-danger" for="input-direccion_lugar">{{ $errors->first('direccion_lugar') }}</span>
                                  @endif
                  </div>
                </div>
              
            
            </div>
              <!-- /.card-body -->
            </div>
                 
             <div style="text-align: center">
        
              <button type="submit"  class="btn btn-primary">Guardar Cambios</button>
            </div>



<!---fin ventana Update --->
@section('scripts')

 <script type ="text/javascript">

$(document).ready(function() {
    $('.select2').select2();
});


     $(function () { 
            $('#state').change(function(){
                var valor = $(this).val();
                console.log(valor);
            $("#province").empty();
            axios.get('{{ route("Municipios")}}',{
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
            axios.get('{{ route("Parroquias")}}',{
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