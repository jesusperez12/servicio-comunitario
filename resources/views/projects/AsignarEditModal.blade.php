<!--ventana para Update--->
<div class="modal fade" id="editAsignar{{ $userproyect->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #00bcd4 !important;">
        <h6 class="modal-title" style="color: #fff; text-align: center;">
           Actualización de los proyectos asignados
        </h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


     
      <form method="POST" action="{{ route('asignarproyect.update', $userproyect->id) }}">
      @method('PUT')
      @csrf

            <div class="" id="cont_modal">

       
               <div class="card-body">
                        <div class="row">
                           <label class="col-sm-3 control-label" for="corte">Período Académico</label>
                          <div class="col-sm-7">
                                 <select class="selectpicker form-control"   id="corte" name="corte_id" >
                             
                       @foreach($cortes as $corte)
                            <option value="{{$corte->id}}">{{ $corte->corte }}</option>
                        @endforeach
                        </select>
                                                             </div>
                   </div>
            </div>

        



             <div class="card-body">
                        <div class="row">
                           <label class="col-sm-3 control-label" for="Proyecto">Seleccione el(los) proyectos</label>
                          <div class="col-sm-7">


                                 <select class="selectpicker form-control"  id="Proyecto" name="Proyecto[]" multiple >
                             
                        @if(isset($Proyecto))
                            @foreach($Proyecto as $proyect)
                            <option value="{{ $proyect->id }} ">{{ $proyect->nombre_proyecto }} </option>
                            @endforeach
                        @endif
                        </select>
                                                             </div>
                   </div>
            </div>



                    

               <div class="card-body">
                        <div class="row">
                           <label class="col-sm-3 control-label" for="usuarios">Seleccione el(los) profesor(es)</label>
                          <div class="col-sm-7">
                                 
                       
                          <select class="selectpicker form-control"  id="usuarios" name="usuarios" multiple title="Seleccione:"data-max-options="1">
                        @if(isset($users))
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->firstname }} {{ $user->primary_lastname }}</option>
                            @endforeach
                        @endif
                        </select>
                                    <label id="autor-error" class="error" style="display: none;" for="autor"></label>
                          </div>
                   </div>
            </div>


            <div class="card-body">
                        <div class="row">
                                <label class="col-sm-3 control-label">Fecha de cierre</label>
                                 <div class="col-sm-7">
                                <input type="datetime-local" name="finalized_at" class="form-control">
                              </div>
                          
                       </div>
            </div>

   <div style="text-align: center">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
      

           </div>
       </form>

    </div>
  </div>
</div>
<!---fin ventana Update --->

