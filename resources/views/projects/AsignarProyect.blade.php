@extends('layouts.main', ['activePage' => 'asignarproyect', 'titlePage' => 'Proyectos Asignados'])




@section('content')
 
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
      <div class="card-header card-header-info">

<h4 class="card-title">Sistema de Servicio Comunitario | {{ $sedeprincipal  }}   


</h4> 
</div>
        <div class="card">
          <div class="card-header card-header-info">
            <h4 class="card-title">Proyecto</h4>
            <p class="card-category">Lista de Proyectos Asignados</p>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12 text-right">
                @can('Asignarproyect_create')
                   <a class="btn btn-success" class="btn btn-info"  data-toggle="modal" data-target="#editChildresn"> <i
                          class="material-icons"></i>Asignar</a>
                          @endcan
                           </div>


                  @if($PivotUserProject->count())
                 <div class="table-responsive">
                 
              <table class="table" style="border:0px solid black;border-collapse:collapse;">
                <thead >
                  <th> N° </th>
                  <th class="text-center"> Instituto </th>
                  <th> Nombre </th>
                  <th> Apellido </th>
                  <th> Proyecto </th>
                  <th> Especialidad </th>
                  <th> Periodo </th>
                  <th> Total de Horas </th>
                  <th> Fecha de finalización </th>
                  <th class="text-right"> Acciones </th>
                </thead>
                <tbody>
                  @forelse ($PivotUserProject as $userproyect)
                  <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $userproyect->NombInstituto }}</td>
                    <td>{{ $userproyect->firstname }}</td>
                    <td>{{ $userproyect->primary_lastname }}</td>
                    <td>{{ $userproyect->nombre_proyecto }}</td>
                    <td>{{ $userproyect->nombre }}</td>
                    <td>{{ $userproyect->corte }}</td>
                    <td>{{ $userproyect->total_hours }}</td>
                    <td class="text-primary">

                      {{ date('d M Y h:i:s A',  strtotime($userproyect->finalized_at))}}
                     </td>
                    <td class="td-actions text-right">
                  
                    

                    @can('Asignarproyect_edit')
                      <a class="btn btn-success" href="{{route('proyects.editAsignarProyect', $userproyect->id)}}">
                       <i class="material-icons">edit </i> </a>
                    @endcan

                   
                           @can('Asignarproyect_destroy')
                      <form action="{{ route('asignarproyect.destroy', $userproyect->id) }}" method="post"
                        onsubmit="return confirm('areYouSure')" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" rel="tooltip" class="btn btn-danger" >
                          <i class="material-icons">close</i>
                        </button>
                      </form>
                      @endcan
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="2">Sin registros.</td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
              {{-- {{ $userproyect->links() }} --}}
            </div>

                @include('projects.AsignarProyectModal')
                
              
           
@else
  <tr>
    <div style="text-align: center">
                    <td>Sin registros.</td>
                      @include('projects.AsignarProyectModal')
                  </div>
                  </tr>
@endif

  

 </div>
          
            </div>
          </div>
          <!--Footer-->
         
          <!--End footer-->
        </div>
      </div>
    </div>
  </div>

@endsection


@if (session('mensaje'))

@section('scripts')
<script type="text/javascript">
 /* Lobibox.notify('success', {
        width: 600,
        position: 'top left',
        title: 'Felicitaciones !!',
        msg: 'Pelicula Registrada.'
     });*/
  
$(function () {
    $('select').selectpicker();
});

</script>
@endsection

@endif