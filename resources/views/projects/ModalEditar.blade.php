

          <!-- <div class="card-body">
              <div class="row">
               <label class="col-sm-3 control-label" for="especialidad">Especialidad</label>
                 <div class="col-sm-7">
                                 
                                        @if(isset($especialidades))
                     {{ Form::select('especialidad_cod', $especialidades, null, ['class'=>'form-control speciality-select', 'placeholder' => 'Seleccione:', 'id'=>'speciality']) }}
                              
                                       
                                        @endif
                                    <label id="especialidad-error" class="error" style="display: none;" for="especialidad"></label>
                                </div>
              </div>
            </div>-->


          

             <div class="card-body">
              <div class="row">
               <label class="col-sm-3 control-label" for="nombre_proyecto">Nombre del proyecto</label>
                 <div class="col-sm-7">
                                 
                                        <input id="nombre_proyecto" name="nombre_proyecto"  value="{{ $proyect->nombre_proyecto }}" type="text" class="form-control" placeholder="Título del proyecto">
                                  <label id="nombre_proyecto-error" class="error" style="display: none;" for="nombre_proyecto"></label>
                                </div>
              </div>
            </div>



            <div class="card-body">
              <div class="row">
               <label class="col-sm-3 control-label" for="descripcion">Descripción del proyecto</label>
                <div class="col-sm-7">
                 <div class="input-field col s12">
          <input class="materialize-textarea form-control" name="descripcion" id="descripcion" value="{{ $proyect->descripcion }}" type="text"  rows="4" placeholder="Descripción"></input>
          
        </div>

                </div>
              </div>
            </div>


             <div class="card-body">
              <div class="row">
               <label class="col-sm-3 control-label" for="linea_accion">Línea de acción</label>
                <div class="col-sm-7">
                 <div class="input-field col s12">
          <input class="materialize-textarea form-control" name="linea_accion" id="linea_accion" value="{{ $proyect->linea_accion }}" type="text" rows="4" placeholder="Línea de acción del proyecto"></input>
          
        </div>

                </div>
              </div>
            </div>



              <div class="card-body">
              <div class="row">
              <label class="col-sm-3 control-label" for="fundamentacion">Fundamentación</label>
                <div class="col-sm-7">
                 <div class="input-field col s12">
          <input class="materialize-textarea form-control"name="fundamentacion" id="fundamentacion" value="{{ $proyect->fundamentacion }}" type="text" rows="4" placeholder="Fundamentación del proyecto"></input>
          
        </div>

                </div>
              </div>
            </div>

              <div class="card-body">
              <div class="row">
                <label class="col-sm-3 control-label" for="proposito">Propósito</label>
                <div class="col-sm-7">
                 <div class="input-field col s12">
          <input  class="materialize-textarea form-control" name="proposito" id="proposito" value="{{ $proyect->proposito }}" type="text" rows="4" placeholder="Propósito"></input>
          
        </div>

                </div>
              </div>
            </div>

              <div class="card-body">
              <div class="row">
               <label class="col-sm-3 control-label" for="competencia">Competencia</label>
                <div class="col-sm-7">
                 <div class="input-field col s12">
          <input  class="materialize-textarea form-control" name="competencia" id="competencia" value="{{ $proyect->competencia }}" type="text" rows="4" placeholder="Competencia"></input>
          
        </div>

                </div>
              </div>
            </div>

            <div class="card-body">
              <div class="row">
                <label class="col-sm-3 control-label" for="metodologia">Metodología</label>
                <div class="col-sm-7">
                 <div class="input-field col s12">
          <input class="materialize-textarea form-control" name="metodologia" id="metodologia" value="{{ $proyect->metodologia }}" type="text" rows="4" placeholder="Metodologia"></input>
          
        </div>

                </div>
              </div>
            </div>


            <div class="card-body">
              <div class="row">
                <label class="col-sm-3 control-label" for="metodologia">Relación con el Plan de Desarrollo de la Nación</label>
                <div class="col-sm-7">

                 <div class="input-field col s12">
          <input id="referencia" name="referencia" type="text" class="form-control referencias" value="{{ $refe->referencia }}" placeholder="Escriba una referencia"></input>
          
        </div>

                </div>
              </div>
            </div>
               <div style="text-align: center">
              <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </div>
             
            </div>
         
   
<!---fin ventana Update --->
