@extends('layouts.main', ['activePage' => 'proyect', 'titlePage' => 'Proyecto'])




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
            <p class="card-category">Lista de Proyectos</p>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12 text-right">
                @can('proyecto_create')
                <a href="{{ route('proyect.create') }}" class="btn btn-sm btn-facebook">Añadir proyecto</a>
                @endcan
           
               
              </div>
            </div>
              @if($posts->count())
            <div class="table-responsive">
              <table class="table ">
                <thead >
                  <th> N° </th>
                  <th> Nombre del Proyecto </th>
              <!--    <th> Especialidad </th>-->
                  <th> Fecha de creación </th>
                  <th class="text-right"> Acciones </th>
                </thead>
                <tbody>
                  @forelse ($posts as $post)
                  <tr>
                   <td>{{ ++$i }}</td>
                  <td>{{ $post->nombre_proyecto }}</td>
                     <!-- <td>{{ $post->nombre }}</td>-->
                    <td class="text-primary">{{ $post->created_at->toFormattedDateString() }}</td>
                    <td class="td-actions text-right">
                    @can('proyecto_show')
                      <a  class="btn btn-success" href="{{route('proyect.show', $post->id)}}"> <i
                          class="	fa fa-eye"></i> </a>
                       
                    @endcan


                        @can('proyecto_edit')
                      <a  class="btn btn-info"  href="{{route('proyect.edit', $post->id)}}"> <i
                          class="material-icons">edit</i> </a>
                    @endcan
                    @can('proyecto_delete')
                      <form action="{{ route('proyect.destroy', $post->id) }}" method="post"
                        onsubmit="return confirm('¿Segudo deseas continuar?')" style="display: inline-block;">
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
             
            </div>
          
          <!--Footer-->
          <div class="card-footer mr-auto">
            {{ $posts->links() }}
          </div>
          <!--End footer-->
       
@else
  <tr>
                    <td colspan="2">Sin registros.</td>
                  </tr>
@endif

 </div>

          </div>
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
  

  


</script>
@endsection

@endif