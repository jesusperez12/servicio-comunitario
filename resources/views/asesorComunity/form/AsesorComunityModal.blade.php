
     

      

            <div class="card card-danger">
              <div class="card-header">
                <center><h3 class="card-title">Asesor</h3></center>
              </div>
              <div class="card-body">
            
                <div class="row">
                <div class="col-4">

<div class="form-group label-floating has-success">
  <label for="ci">Identificación</label>
  <input type="text" id="ci" class="form-control numeric-input" name="ci" placeholder="Cédula" maxlength="8">
  @if ($errors->has('ci'))
    <span class="error text-danger" for="input-ci">{{ $errors->first('ci') }}</span>
    @endif
  </div>
</div>



                  <div class="col-4">
                   <div class="form-group label-floating has-success">
                   <label for="firstname">Primer nombre</label>
                   <input type="text" id="firstname" class="form-control" name="firstname" placeholder="Primer nombre...">
                        
                    </div>
                    @if ($errors->has('firstname'))
                                    <span class="error text-danger" for="input-firstname">{{ $errors->first('firstname') }}</span>
                                  @endif
                  </div>



                  <div class="col-4">
                  <div class="form-group label-floating has-success">
                   <label for="middlename">segudo nombre</label>
                   <input type="text" id="middlename" class="form-control" name="middlename" placeholder="Segundo nombre...">
                     
                    </div>
                  </div>


                  <div class="col-4">
                  <div class="form-group label-floating has-success">
                  <label for="primary_lastname">Primer apellido</label>
                  <input type="text" id="primary_lastname" class="form-control" name="primary_lastname" placeholder="Primer apellido...">
                  @if ($errors->has('primary_lastname'))
                                    <span class="error text-danger" for="input-primary_lastname">{{ $errors->first('primary_lastname') }}</span>
                                  @endif
                    </div>
                  </div>


                  <div class="col-4">
                  <div class="form-group label-floating has-success">
                  <label for="second_lastname">Segundo apellido</label>
                   <input type="text" id="second_lastname" class="form-control" name="second_lastname" placeholder="Segundo apellido...">
                     
                    </div>
                  </div>

                  <div class="col-5">
                  <div class="form-group label-floating has-success">
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

                </div>  <!-- /.row -->
                <div class="card-header">
                <center><h3 class="card-title">Comunidad</h3></center>
              </div>
            
                <div class="row">


                  <div class="col-3">
                  <div class="form-group label-floating has-success">
                  <label for="comunidad">Comunidad</label>
                  <input type="text" id="comunidad" class="form-control" name="comunidad" placeholder="Nombre de la comunidad">
                  </div>
                  @if ($errors->has('comunidad'))
                                    <span class="error text-danger" for="input-comunidad">{{ $errors->first('comunidad') }}</span>
                                  @endif
                </div>


                  <div class="col-4">
                  <div class="form-group label-floating has-success">
                  <label for="direccion">Dirección</label>
                  <textarea id="direccion" class="form-control"  name="direccion" placeholder="Dirección..."></textarea>
                  </div>
                  @if ($errors->has('direccion'))
                                    <span class="error text-danger" for="input-direccion">{{ $errors->first('direccion') }}</span>
                                  @endif
                  </div>

                  <div class="col-5">
                  <div class="form-group label-floating has-success">
                  <label for="sector">Sector</label>
                  <input type="text" id="sector" class="form-control"  name="sector" placeholder="Sector...">
                  </div>    
                  @if ($errors->has('sector'))
                                    <span class="error text-danger" for="input-sector">{{ $errors->first('sector') }}</span>
                                  @endif
                  </div>


                  <div class="col-3">
                  <div class="form-group label-floating has-success">
                  <label for="state">Estado</label>
                  <select id="state" name="state" class="form-control address-select" style="width:100%;">
                            @if($states)
                                @foreach($states AS $state)
                                <option data-id="{{ $state->id }}" value="{{ $state->id }}">{{ $state->state }}</option>
                                @endforeach
                            @endif
                            </select>
                  </div>
                  @if ($errors->has('state'))
                                    <span class="error text-danger" for="input-state">{{ $errors->first('state') }}</span>
                                  @endif
            </div>


                  <div class="col-4">
                  <label for="province">Municipio</label>
                  <select id="province" name="province" class="form-control address-select" style="width:100%;">
                            </select>
                            @if ($errors->has('province'))
                                    <span class="error text-danger" for="input-province">{{ $errors->first('province') }}</span>
                                  @endif
                  </div>
                  <div class="col-5">
                  <label for="locality">Parroquia</label>
                  <select id="locality" name="locality" class="form-control address-select" style="width:100%;">
                            </select>
                            @if ($errors->has('locality'))
                                    <span class="error text-danger" for="input-locality">{{ $errors->first('locality') }}</span>
                                  @endif
                  </div>

                  <div class="col-5">
                  <div class="form-group label-floating has-success">
                  <label for="lugar_prestadores">Lugar dónde acamparán prestadores del servicio</label>
                  <input type="text" id="lugar_prestadores" class="form-control"  name="lugar_prestadores" placeholder="Lugar...">
                  </div>
                  @if ($errors->has('lugar_prestadores'))
                                    <span class="error text-danger" for="input-lugar_prestadores">{{ $errors->first('lugar_prestadores') }}</span>
                                  @endif
                                 </div>

                  <div class="col-5">
                  <div class="form-group label-floating has-success">
                  <label for="direccion_lugar">Dirección de referencia</label>
                  <textarea  id="direccion_lugar" class="form-control"  name="direccion_lugar" placeholder="Dirección de referencia..."> </textarea>
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
