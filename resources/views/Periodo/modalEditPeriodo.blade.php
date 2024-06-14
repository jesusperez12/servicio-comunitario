
            
              <div class="card-body">
                <div class="row">
                 
                <div class="form-group">
                @if(isset($sedes))
                                <label for="sede_id">Institutos</label>
                               
                                {{ Form::select('sede_id', $sedes, null, ['class'=>'form-control', 'placeholder' => '.:Seleccione:.', 'id'=>'sede_id']) }}
                                    
                                @endif
                                 @if ($errors->has('sede_id'))
                                    <span class="error text-danger" for="input-sede_id">{{ $errors->first('sede_id') }}</span>
                                  @endif
                            </div>



                  <div class="col-6">
                   {!!Form::label('corte','Cohorte')!!}   
           <div class="form-group{{ $errors->has('corte') ? ' has-error' : '' }}"> 
          
           

                  <select id="periodo" name="corte" class="form-control" >
                                      <option value="corte" selected disabled>Select</option>
                                      @foreach($lapso as $periodo)
                                      
                                      <option value="{{$periodo->codigo}}"{{ $periodo->codigo == $comunityy->corte ? ' selected' : '' }}> {{ $periodo->codigo }}</option>
                                      @endforeach
                                 </select>


           @if ($errors->has('corte'))
              <span class="help-block">
              <strong>{{ $errors->first('corte') }}</strong>
               </span>
          @endif
                  </div>
                   </div>



                     <div class="col-6">  
                            <label for="date">Fecha de inicio</label>
                  
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                  <input type="date" class="form-control date-default" id="datepicker" name="inicio"value="{{ $periodos->inicio }}">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>
                                <label id="date_birth-error" class="error" style="display: none;" for="date_birth"></label>
                            </div>
                            
                               <div class="col-6">  
                            <label for="date">Fecha de cierre</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                 <input type="date" class="form-control date-default" name="fin"value="{{ $periodos->fin }}">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>
                                <label id="date_birth-error" class="error" style="display: none;" for="date_birth"></label>
                            </div>
     <div class="col-6">  
                      {!!Form::label(' Estatus')!!}
   <div class="form-group{{ $errors->has('estatus') ? ' has-error' : '' }}">
    {{ Form::select('estatus', array('Activo' => 'Activo', 'Inactivo' => 'Inactivo'), null, ['class'=>'form-control','placeholder' => '.:Seleccione:.']) }}
        @if ($errors->has('estatus'))
                <span class="help-block">
                <strong>{{ $errors->first('estatus') }}</strong>
                </span>
               @endif 
                  </div>
                   </div> 


                </div>
              </div>
     
         <div style="text-align: center">
    {!!Form::submit('Guardar', ['class' => 'btn btn-primary'])!!} 
    &nbsp;&nbsp;<a href="{{ route('Periodo.index') }}" class="btn btn-danger active">Regresar</a>
</div>

