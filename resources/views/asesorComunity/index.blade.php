@extends('layouts.main', ['activePage' => 'asesorcomunity', 'titlePage' => 'Asesor y Comunidad'])

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
            <h4 class="card-title">Asesor y Comunidad</h4>
            <p class="card-category">Lista de asesores y comunidades</p>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12 text-right">
          
                <a href="{{ route('asesorcomunity.create') }}" class="btn btn-sm btn-facebook">Añadir asesor</a>
             
              </div>
            </div>
             @if($asesorcomunita->count())
            <div class="table-responsive">
              <table class="table ">
                <thead >
                  <th> Identificacón </th>
                  <th> Acesor </th>
                  <th> comunidad</th>
                  <th> Sector </th>
                  <th> Proyecto </th>
                  <th> Fecha de creación </th>
                  <th class="text-right"> Acciones </th>
                </thead>
                <tbody>
                  @forelse ($asesorcomunita as $post)
                  <tr>
                    <td>{{ $post->ci }}</td>
                    <td>{{ $post->firstname }} {{ $post->primary_lastname }}</td>
                    <td>{{ $post->nombre }}</td>
                    <td>{{ $post->sector }}</td>
                    <td>{{ $post->nombre_proyecto }}</td>
                    <td class="text-primary">{{ $post->created_at->toFormattedDateString() }}</td>
                    <td class="td-actions text-right">
                  <!--  @can('post_show')
                      <a href="{{ route('asesorcomunity.show', $post->id) }}" class="btn btn-info"> <i
                          class="material-icons">person</i> </a>
                    @endcan-->
                    @can('asesorcomunita_index')
                      <a  class="btn btn-info"  href="{{route('asesorcomunity.edit', $post->id)}}"> <i
                          class="material-icons">edit</i> </a>

                   
                    @endcan
                    @can('asesorcomunita_destroy')
                      <form action="{{ route('asesorcomunity.destroy', $post->id) }}" method="post"
                        onsubmit="return confirm('areYouSure')" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" rel="tooltip" class="btn btn-danger">
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
              {{-- {{ $users->links() }} --}}
            </div>
          </div>
          @else
  <tr>
                    <td colspan="2">Sin registros.</td>
                  </tr>
@endif
      
          <!--End footer-->
        </div>
      </div>
    </div>
  </div>
</div>
@endsection


@section('scripts')

 <script type ="text/javascript">

$(document).ready(function() {
    $('.select2').select2();
});


     $(function () { 
            $('#state').change(function(){
                var valor = $(this).val();
                console.log(valor);
            $("#province").empty();
            axios.get('{{ route("Municipios")}}',{
                params: {
                valor : valor
                
            }
        }).then(response =>{
                $('#province').append('<option>--Seleccione--</option>');
                response.data.forEach(provinces => {
                $('#province').append('<option value="'+provinces.id+'">'+provinces.province+'</option>');
                //console.log(response.data);
            });
        
            }); 
        });

        $('#province').change(function(){
            var valor = $(this).val();
            $("#locality").empty();
            axios.get('{{ route("Parroquias")}}',{
                params: {
                valor : valor
            }
        }).then(response =>{
                $('#locality').append('<option>--Seleccione--</option>');
                response.data.forEach(localities => {
                $('#locality').append('<option value="'+localities.id+'">'+localities.locality+'</option>');
            });     
        }); 
    }); 
});     





</script>
@endsection
