<div class="card-body">
              <div class="p-4 bg-light" >



  <div class="row">
   
   
            <div class="col-3">
          <label for="grupo" style="font-size:12px;">Grupo o sección</label>
            
                                    <input type="text" id="grupo" name="grupo" value="{{ old('grupo') }}" class="form-control numeric-input" placeholder="Ej, 22, 2 ,3...">

                                       @if ($errors->has('grupo'))
					                  <span class="error text-danger" for="input-grupo">{{ $errors->first('grupo') }}
                </span>
					                @endif
                                  
          </div>




            <div class="col-3">
                                    <label for="proyecto_id" style="font-size:12px;">Proyectos</label>
                                    <select id="proyect" name="proyecto_id" class="selectpicker" data-live-search="true">
                                        <option disabled selected>Seleccione:</option>
                                        @if(isset($proyecto))
                                        @foreach($proyecto as $pruyect)
                                        <option value="{{ $pruyect->id }}">{{ $pruyect->nombre_proyecto }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                            @if ($errors->has('proyecto_id'))
                                       <span class="error text-danger" for="input-proyecto_id">{{ $errors->first('proyecto_id') }}</span>
                </span>
                                      @endif
                                </div>
             

   <div class="col-3">
            <label for="especialidad" style="font-size:12px;">Especialidad</label>
           {{ Form::select('especialidad', array(), null, [ 'class'=>'form-control','id'=>'especialidad', 'placeholder' => 'Seleccione:'] ) }} 
                                       
                                        @if ($errors->has('especialidad'))
                  <span class="error text-danger" for="input-especialidad">{{ $errors->first('especialidad') }}
                </span>
                @endif
          </div>

             <div class="col-md-3">
        <label for="ci" style="font-size:12px;">Estudiantes de servicios</label>
  <select multiple placeholder="Estudiantes" name="ci[]" id='users' class="form-control ">
          </select>
             @if ($errors->has('ci'))
                 <span class="error text-danger" for="input-ci">{{ $errors->first('ci') }}
                </span>
                @endif

    </div>
    

   
  </div>
  
  </div>

   <div style="text-align: center">
              <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
            &nbsp;&nbsp;<a href="{{ route('Prestadores.index') }}" class="btn btn-sm btn-danger active">Regresar</a>
</div>


                
              </div>
          
     