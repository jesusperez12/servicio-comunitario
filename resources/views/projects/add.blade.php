@extends('layouts.main', ['activePage' => 'proyect', 'titlePage' => 'Nuevo Proyecto'])
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <form class="form-horizontal" id="form-add-project" name="form-add-project" method="POST" action="{{ route('proyect.store') }}" class="form-horizontal" autocomplete="off">
        
          @csrf
          <div class="card ">
            <!--Header-->
            <div class="card-header card-header-info">
              <h4 class="card-title">Proyecto</h4>
              <p class="card-category">Ingresar datos del nuevo proyecto</p>
            </div>
            <!--End header-->
            <!--Body-->
              <!--  <div class="card-body">
              <div class="row">
               <label class="col-sm-3 control-label" for="especialidad">Especialidad</label>
                 <div class="col-sm-7">
                                 
                                        @if(isset($especialidades))
                     {{ Form::select('especialidad[]', $especialidades, null, ['class'=>'form-control select2','multiple' => 'multiple', 'id'=>'speciality']) }}

                              
                                       
                                        @endif
                                    <label id="especialidad-error" class="error" style="display: none;" for="especialidad"></label>
                                </div>
              </div>
            </div>


              <div class="card-body">
              <div class="row">
              <label class="col-sm-3 control-label" for="autor">Autor</label>
             <div class="col-sm-7">
                                  
                                    	  <option disabled selected>Seleccione:</option>
                                        @if(isset($users))
                                        @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->firstname }} {{ $user->middlename }} {{ $user->primary_lastname }} {{ $user->second_lastname }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <label id="autor-error" class="error" style="display: none;" for="autor"></label>
                                </div>
              </div>
            </div> 

           <div class="card-body">
             <div class="row">
              <label class="col-sm-3 control-label" for="Institutos">Institutos</label>
             <div class="col-sm-7">
                                
                                @if(isset($sedes))
                                {{ Form::select('sede_id', $sedes, null, ['class'=>'form-control', 'placeholder' => '.:Seleccione:.', 'id'=>'sede_id']) }}
                                    
                                @endif
                                 @if ($errors->has('sede_id'))
                                    <span class="error text-danger" for="input-sede_id">{{ $errors->first('sede_id') }}</span>
                                  @endif
                            </div>

                          </div>
                        </div>-->


             <div class="card-body">
              <div class="row">
               <label class="col-sm-3 control-label" for="nombre_proyecto">Nombre del proyecto</label>
                 <div class="col-sm-7">
                                 
                                        <input id="nombre_proyecto" name="nombre_proyecto" type="text" class="form-control" placeholder="Título del proyecto">
                                          @if ($errors->has('nombre_proyecto'))
                                  <label id="nombre_proyecto-error" class="error" style="display: none;" for="nombre_proyecto"></label>

                                       <span class="error text-danger" for="input-nombre_proyecto">{{ $errors->first('nombre_proyecto') }}</span>
                                  @endif

                                </div>

                               
                               

              </div>
            </div>



            <div class="card-body">
              <div class="row">
               <label class="col-sm-3 control-label" for="descripcion">Descripción del proyecto</label>
                <div class="col-sm-7">
                 
                 <div class="input-field col s12">
                   
          <textarea class="materialize-textarea form-control" name="descripcion" id="descripcion" rows="4" placeholder="Descripción"></textarea>
       
                                 
        </div>

          @error('descripcion')
  

   <span class="error text-danger" for="input-nombre_proyecto">{{ $errors->first('nombre_proyecto') }}</span>
  

  @enderror

                </div>
              </div>
            </div>


             <div class="card-body">
              <div class="row">
               <label class="col-sm-3 control-label" for="linea_accion">Línea de acción</label>
                <div class="col-sm-7">
                 <div class="input-field col s12">
                   @if ($errors->has('linea_accion'))
          <textarea class="materialize-textarea form-control" name="linea_accion" id="linea_accion" rows="4" placeholder="Línea de acción del proyecto"></textarea>
          
           <span class="error text-danger" for="input-descripcion">{{ $errors->first('linea_accion') }}</span>
                                  @endif
        </div>

                </div>
              </div>
            </div>



              <div class="card-body">
              <div class="row">
              <label class="col-sm-3 control-label" for="fundamentacion">Fundamentación</label>
                <div class="col-sm-7">
                 <div class="input-field col s12">
                  
          <textarea class="materialize-textarea form-control"name="fundamentacion" id="fundamentacion" rows="4" placeholder="Fundamentación del proyecto"></textarea>
          @error('descripcion')
  

   <span class="error text-danger" for="input-nombre_proyecto">{{ $errors->first('nombre_proyecto') }}</span>
  

  @enderror
        </div>

                </div>
              </div>
            </div>

              <div class="card-body">
              <div class="row">
                <label class="col-sm-3 control-label" for="proposito">Propósito</label>
                <div class="col-sm-7">
                 <div class="input-field col s12">
                 
          <textarea  class="materialize-textarea form-control" name="proposito" id="proposito" rows="4" placeholder="Propósito"></textarea>
           @error('descripcion')
  

   <span class="error text-danger" for="input-nombre_proyecto">{{ $errors->first('nombre_proyecto') }}</span>
  

  @enderror
        </div>

                </div>
              </div>
            </div>

              <div class="card-body">
              <div class="row">
               <label class="col-sm-3 control-label" for="competencia">Competencia</label>
                <div class="col-sm-7">
                 <div class="input-field col s12">
                  
          <textarea  class="materialize-textarea form-control" name="competencia" id="competencia" rows="4" placeholder="Competencia"></textarea>
          
            @error('descripcion')
  

   <span class="error text-danger" for="input-nombre_proyecto">{{ $errors->first('nombre_proyecto') }}</span>
  

  @enderror
        </div>

                </div>
              </div>
            </div>

            <div class="card-body">
              <div class="row">
                <label class="col-sm-3 control-label" for="metodologia">Metodología</label>
                <div class="col-sm-7">
                 <div class="input-field col s12">
                    
          <textarea class="materialize-textarea form-control" name="metodologia" id="metodologia" rows="4" placeholder="Metodologia"></textarea>
          @error('descripcion')
  

   <span class="error text-danger" for="input-nombre_proyecto">{{ $errors->first('nombre_proyecto') }}</span>
  

  @enderror
        </div>

                </div>
              </div>
            </div>

            <!--End body-->

            <!--Footer-->
        
            <!--End footer-->
 <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          @csrf

          <div class="card ">
         
            <!--End header-->
            <!--Body-->
            <div class="card-body">
            	   <div class="box-header with-border">
    <label class="col-sm-6 control-label" for="metodologia">Relación con el Plan de Desarrollo de la Nación</label> 
                </div>


               <div class="card-body">
              <div class="row">
                <label class="col-sm-3 control-label" for="referencia"></label>
                <div class="col-sm-7">
                 <div class="input-field col s12">
                  
                  <textarea id="referencia" name="referencias" type="text" class="form-control referencias" placeholder="Relación con el Plan de Desarrollo de la Nación"></textarea>
     @error('descripcion')
  

   <span class="error text-danger" for="input-nombre_proyecto">{{ $errors->first('nombre_proyecto') }}</span>
  

  @enderror
          
        </div>
                </div>
              </div>
            </div>

            </div>

            <!--End body-->
              
          </div>
      </div>
    </div>
  </div>

    <div class="card-footer ml-auto mr-auto">
              <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



@endsection

@section('scripts')
<script src="{{ URL::asset('assets/js/ckeditor.js') }}"></script>
<script src="{{ URL::asset('assets/js/admin/_projects.js') }}"></script>

<script type="text/javascript">
  
/*$("#autor").select2({
        placeholder: 'Seleccione...'
    });
$("#institutos").select2({
        placeholder: 'Seleccione...'
    });*/
$("#speciality").select2({
        placeholder: 'Seleccione...'
    });

</script>
@endsection


