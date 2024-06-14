@extends('layouts.main', ['activePage' => 'asignarproyect', 'titlePage' => 'Proyectos Asignados'])




@section('content')



<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-info">
            <h4 class="card-title">Actualización de los proyectos asignados</h4>
            
          </div>


     <!-- general form elements disabled -->
            <div class="card card-warning">
                 <!-- <div class="card-header">
                <h3 class="card-title">General Elements</h3>
              </div>
           /.card-header -->
              <div class="card-body">

              <table class="table table-bordered table-striped">
                      <tbody>
                        <tr>
                        {!!Form::model($asignar,['route'=>['asignarproyect.update',$asignar->id],'method'=>'PUT'])!!}
           
           @csrf
                        <tr>
                          <th>Período Académico</th>
                          <td><span class="badge badge-primary">{{ Form::select('periodo_id', $cortes, null, ['class'=>'form-control']) }}
              
              @if ($errors->has('corte'))
                    <span class="help-block">
                    <strong>{{ $errors->first('corte') }}</strong>
                    </span>
                   @endif </span></td>
                        </tr>
                        <tr>
                            <th>{!!Form::label('Seleccione el(los) proyectos')!!}</th>
                          <td> {{ Form::select('proyecto_id', $Proyecto, null, ['class'=>'form-control speciality-select', 'placeholder' => 'Seleccione:', 'id'=>'Proyecto']) }} </td>
                        </tr>
                          <th> {!!Form::label('Seleccione el(los) profesor(es)')!!}:</th>
                          <td>    {{ Form::select('user_id', $users, null, ['class'=>'form-control speciality-select', 'placeholder' => 'Seleccione:', 'id'=>'usuarios']) }}</td>
                        </tr>
                        <tr>
                          <th>  {!!Form::label('Fecha de cierre')!!}:</th>
                          <td> <input type="datetime-local" name="finalized_at" class="form-control"></td>
                        </tr>
                    
                    

                  
                  <!-- input states -->
                  <th> <div style="text-align: right">
                  <a href="{{ route('asignarproyect') }}" class="btn btn-success"> Volver </a></th>
             
                  <td>  <button type="submit" class="btn btn-info" >Guardar</button>
            </div></div>
            </tbody>
                   
</table>
                      </div>
                    </div>
                  </div>

                   {!!Form::close()!!}  
              </div>
              <!-- /.card-body -->
            </div>

     
      



<!---fin ventana Update --->





@endsection







