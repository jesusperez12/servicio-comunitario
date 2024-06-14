 <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Nuevo reporte</h3>
              </div>
              <div class="card-body">
                <div class="row">



          <div class="col-3">
            <label for="proyecto" >Proyecto</label>
               <select id="proyecto" name="proyecto" type="text"  class="form-control" style="width:100%;">
                <option disabled selected>Seleccione:</option>
                                    @foreach($proyectos as $proyecto)
                                        <option value="{{ $proyecto->id }}">{{ $proyecto->nombre_proyecto }}</option>
                                    @endforeach
                      </select>
                                        @if ($errors->has('proyecto'))
                  <span class="error text-danger" for="input-proyecto">{{ $errors->first('proyecto') }}
                </span>
                @endif
          </div>
                  
                  <div class="col-4">
                       <label for="Fecha" >Fecha</label>
                    <input id="fecha" name="fecha" type="date"  class="form-control" placeholder="Ejemplo: 22/01/2014">
                      @if ($errors->has('fecha'))
                  <span class="error text-danger" for="input-fecha">{{ $errors->first('fecha') }}
                </span>
                @endif
                  </div>

                  <div class="col-5">
                  
                     <label for="direccion" >Dirección</label>
                    <input id="direccion" name="direccion" type="text"  class="form-control"  placeholder="Dirección del lugar donde se realizó la actividad">
                     @if ($errors->has('direccion'))
                  <span class="error text-danger" for="input-direccion">{{ $errors->first('direccion') }}
                </span>
                @endif

                  </div>

                </div>
              </div>

                 <div class="card-body">
                <div class="row">
                  <div class="col-3">
                    <label for="actividad" >Actividad</label>
                      <input id="actividad" name="actividad" type="text" class="form-control"   placeholder="Nombre de la actividad">
                    @if ($errors->has('actividad'))
                  <span class="error text-danger" for="input-actividad">{{ $errors->first('actividad') }}
                </span>
                @endif

                  </div>
                  <div class="col-4">
                     <label for="detalle" >Detalle</label>
                    <textarea id="detalle" name="detalle" type="text"   class="form-control"></textarea>
                      @if ($errors->has('detalle'))
                  <span class="error text-danger" for="input-detalle">{{ $errors->first('detalle') }}
                </span>
                @endif
                  </div>
                  
                  <div class="col-5">
                      <label for="duracion" >Duración (Hrs)</label>
                       <select class="form-control" name="duracion"  type="text">
                         <option disabled selected>Seleccione:</option>
                        <option value="1.0">1:00h</option>
                        <option value="2.0">2:00h</option>
                        <option value="3.0">3:00h</option>
                        <option value="4.0">4:00h</option>
                        <option value="5.0">5:00h</option>
                        <option value="6.0">6:00h</option>
                        <option value="7.0">7:00h</option>
                        <option value="8.0">8:00h</option>
                      </select>
                        @if ($errors->has('duracion'))
                  <span class="error text-danger" for="input-duracion">{{ $errors->first('duracion') }}
                </span>
                @endif
                
                </div>
              </div>


                 <div class="card-body">
                <div class="row">
                  <div class="col-3">
                    <label for="impacto" >Impacto generado</label>
                     <textarea id="impacto" name="impacto" type="impacto"  class="form-control" placeholder="Impacto que generó la actividad"></textarea>
                      @if ($errors->has('impacto'))
                  <span class="error text-danger" for="input-impacto">{{ $errors->first('impacto') }}
                </span>
                @endif
                  </div>
                  <div class="col-4">
                     <label  for="recursos">Recursos</label>
                                    <div class="recurso-element">
                                        <div class="input-group">
                                            <input id="recurso" name="recursos[]"  type="text" class="form-control recursos" placeholder="Escriba recurso">
                                                  @if ($errors->has('recursos'))
                  <span class="error text-danger" for="input-recursos">{{ $errors->first('recursos') }}
                </span>
                @endif
                                            <span class="input-group-addon">#</span>
                                            <select id="tipo_recurso" name="tipo_recurso[]" type="text" class="form-control">
                                                <option value="0">Humano</option>
                                                <option value="1">Pedagógico</option>
                                                <option value="2">Financiero</option>
                                            </select>
                                        </div>
                                          @if ($errors->has('tipo_recurso'))
                  <span class="error text-danger" for="input-tipo_recurso">{{ $errors->first('tipo_recurso') }}
                </span>
                @endif
                                    </div>
                               
                  </div>
                  <div class="col-5">
                     <label for="beneficiarios">Beneficiarios</label>
                      <div class="beneficiario-element">
                                        <div class="input-group">
                                            <input id="beneficiario" name="beneficiarios[]" type="text" class="form-control beneficiarios numeric_input" placeholder="Cantidad de beneficiario">
                                                 @if ($errors->has('beneficiario'))
                  <span class="error text-danger" for="input-beneficiario">{{ $errors->first('beneficiario') }}
                </span>
                @endif
                                            <span class="input-group-addon">#</span>
                                            <select id="tipo_beneficiario" name="tipo_beneficiario[]" type="text" class="form-control">
                                                <option value="0">Mujer(es)</option>
                                                <option value="1">Hombre(s)</option>
                                                <option value="2">Niña(s) o Niño(s)</option>
                                                <option value="2">Comunidad en general</option>
                                            </select>
                                        </div>
                                        @if ($errors->has('beneficiario'))
                  <span class="error text-danger" for="input-beneficiario">{{ $errors->first('beneficiario') }}
                </span>
                @endif
                                    </div>
                  </div>
                </div>
              </div>


              <div class="card-body">
                <div class="row">


                  
                  <div class="col-3">
                         <label for="grupo" >Grupo o sección</label>
            
                                     <select  id="grupo_id" name="grupo_id" class="form-control" data-live-search="true" placeholder="Seleccione:" style="width:100%;">
              <option disabled selected>Seleccione:</option>
                                       @foreach($seccion as $secciones) 
                                        <option value="{{ $secciones->grupo_id }}">{{ $secciones->grupo_id }}</option>
                                    @endforeach
                                    </select>
                                        @if ($errors->has('grupo_id'))
                  <span class="error text-danger" for="input-grupo_id">{{ $errors->first('grupo_id') }}
                </span>
                @endif


              </div>



          <div class="col-4">
            <label for="prestadores" >Prestadores de servicios</label>

            <select class="form-control select2" multiple="multiple" placeholder="Seleccione:" name="prestadores[]" id='prestadores'>
          </select>
             @if ($errors->has('prestadores'))
                 <span class="error text-danger" for="input-prestadores">{{ $errors->first('prestadores') }}
                </span>
                @endif
                                      
          </div>

                </div>



              </div>




                 <div style="text-align: center">
              <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
            &nbsp;&nbsp;<a href="{{ route('Actividades.index') }}" class="btn btn-sm btn-danger active">Regresar</a>
</div>



              <!-- /.card-body -->
            </div>
