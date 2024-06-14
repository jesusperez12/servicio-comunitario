<div class="card-body">
              <div class="p-4 bg-light" >



  <div class="row">
   
   
            <div class="col-3">
          <label for="grupo" style="font-size:12px;">Grupo o sección</label>
             {!!Form::text('grupo_id', null, ['class' => 'form-control numeric-input', 'id'=>'grupo', 'placeholder'=>'Grupo o sección'])!!} 
                               

                                       @if ($errors->has('grupo'))
					                  <span class="error text-danger" for="input-grupo">{{ $errors->first('grupo') }}
                </span>
					                @endif
                                  
          </div>





            <div class="col-3">
                                    <label for="proyecto_id" style="font-size:12px;">Proyectos</label>
                                    

                                         <select id="proyect" name="state" class="form-control" >
                                      <option value="" selected >Seleccione</option>
                                      @foreach($proyecto as $proyect)
                                      
                                      <option value="{{$proyect->id}}"{{ $proyect->id == $comunityy->proyecto_id ? ' selected' : '' }}> {{ $proyect->nombre_proyecto }}</option>
                                      @endforeach
                                 </select>

                               
                                            @if ($errors->has('proyecto_id'))
                                       <span class="error text-danger" for="input-proyecto_id">{{ $errors->first('proyecto_id') }}</span>
                </span>
                                      @endif
                                </div>


          <div class="col-3">
            <label for="especialidad" style="font-size:12px;">Especialidad</label>
              {{ Form::select('especialidad_cod', $especialidades, null, [ 'class'=>'form-control','id'=>'especialidad', 'placeholder' => 'Seleccione:'] ) }}


                                        @if ($errors->has('especialidad'))
                  <span class="error text-danger" for="input-especialidad">{{ $errors->first('especialidad') }}
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
          
     