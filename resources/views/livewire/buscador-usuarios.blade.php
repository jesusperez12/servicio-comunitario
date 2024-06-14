<div>
    <div class="row">


        <div class="modal-body">
           <form action="{{ route('getPrestador') }}"  method="GET" class="form-horizontal">
    
    @csrf 
              <div class="card-body">
                <div class="row">
 
                    {{ csrf_field() }}
                 


                    <div class="col-3">
                  <label for="grupo" style="font-size:12px;">Grupo o sección</label>
                    
                                            <input type="text" id="grupo" name="grupo" class="form-control numeric-input" placeholder="Grupo o sección">
                  </div>

                  <div class="col-3">
                    <label for="especialidad" style="font-size:12px;">Especialidad</label>
                    <select type="text" id="especialidad" name="especialidad" class="form-control numeric-input" placeholder="Especialidad" style="width:100%;">
                                            @foreach($especialidades as $especialidad) 
                                                <option value="{{ $especialidad->cod }}">{{ $especialidad->nombre }}</option>
                                            @endforeach
                                            </select>
                  </div>



                      <div class="card-body">
                <div class="row" id="itemDate">

                <div class="col-3">
                     <div class="form-group">
                <label for="buscar">
                    <strong>Buscar</strong>
                    @if($picked)
                        <span class="badge badge-success">Picked</span>
                    @else
                        <span class="badge badge-danger">Picked</span>
                    @endif
                </label>
                <input wire:model="buscar" 
                    wire:keydown.enter="asignarPrimero()" type="text" id="ci" name="ci"  class="input-sm form-control numeric-input ci" maxlength="8" minlength="7"placeholder="Cédula..." id="buscar">
                @error("buscar")                    
                    <small class="form-text text-danger">{{$message}}</small>                                    
                @else
                    @if(count($usuarios)>0)
                        @if(!$picked)
                        <div class="shadow rounded px-3 pt-3 pb-0">
                            @foreach($usuarios as $usuario)
                                <div style="cursor: pointer;">
                                    <a wire:click="asignarUsuario('{{ $usuario->firstname }}')">
                                        {{ $usuario->firstname }}
                                    </a>
                                </div>
                                <hr>
                            @endforeach
                        </div>
                        @endif
                    @else
                        <small class="form-text text-muted">Comienza a teclear para que aparezcan los resultados</small>
                    @endif
                @enderror
            </div>
                     
                  </div>
                  <div class="col-3">
                     <input id="firstname" name="firstname[]" type="text"  class="input-sm form-control firstname" placeholder="Primer nombre">
                  </div>


                  <div class="col-3">
                    <input id="middlename" name="middlename[]" type="text" class="input-sm form-control" placeholder="Segundo nombre">
                  </div>

                  <div class="col-3">
                    <input id="primary_lastname" name="primary_lastname[]" type="text" class="input-sm form-control primary_lastname" placeholder="Primer apellido">
                                                        
                  </div>

                  <div class="col-3">
                    <input id="second_lastname" name="second_lastname[]" type="text" class="input-sm form-control" placeholder="Segundo apellido">
                                                        
                  </div>
                </div>
              </div>                 

       </form>

     
                   

      </div>
        <div class="row">
                     <div class="col-12 text-right" id="item-add">
              
               <p class="text-right" style="padding-top: 1.5rem">
                <button type="button" class="btn btn-success" onclick="add();">
                    <i class="mi-add"></i>
                    Agregar
                </button>
            </p>
              
              </div>
                     </div>

      <div class="modal-footer">
        <button type="submit" form="form-add-list-providers" class="btn btn-primary" id="btn-save-new-provider"><i class="fa fa-floppy-o"></i> Guardar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>








    </div>    
</div>



<!--<input id="ci" name="ci" type="text" class="input-sm form-control numeric-input ci" maxlength="8" minlength="7"placeholder="Cédula...">   <div class="col-md-8">
           
        </div>
        <div class="col-md-4">
            <p><strong>Resultados</strong></p>
            <p>
            @foreach($usuarios as $usuario)
                <span class="badge badge-secondary">{{ $usuario->firstname }}</span>
            @endforeach
            </p>
        </div>-->





      