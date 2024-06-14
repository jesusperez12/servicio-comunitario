@extends('layouts.main', ['activePage' => 'Autoridades', 'titlePage' => 'Autoridades'])

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
            <h4 class="card-title">Autoridades</h4>
            <p class="card-category">Listado</p>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12 text-right">
               @can('autoridades_create')
                <a href="{{ route('Autoridades.create') }}" class="btn btn-sm btn-facebook">Añadir Autoridades</a>
             @endcan
              </div>

               <div class="card-body table-responsive " style="height: 600px;">




                <table id="example" class="table table-head-fixed text-nowrap">
                  <thead>
                              <tr>
                            <th> Instituto </th>
                            <th> Cargo</th>
                            <th> Nombres</th>
                            <th class="text-right" id="table-body"> Acciones </th>
                        </tr>
                  </thead>
                  <tbody>
                          @foreach ($autoidades as $key => $el)
    <tr>
         <td>{{$el->NombInstituto}}</td>
         <td>{{$el->cargo}}</td>
         <td>{{$el->autoridad}}</td>
         <td class="td-actions text-right">
           @can('autoridades_edit')
         	<a href="{{ route('Autoridades.edit', $el->id) }}" class="btn btn-warning"><i class="material-icons">edit</i></a>
          @endcan
           @can('autoridades_destroy')
         	  <form action="{{ route('Autoridades.destroy', $el->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Seguro?')">
                                @csrf
                                @method('DELETE')
                                    <button class="btn btn-danger" type="submit" rel="tooltip">
                                    <i class="material-icons">close</i>
                                    </button>
                                </form>
               @endcan                 
         </td>
    </tr>
    @endforeach
                    
                  </tbody>
                   
                 
                </table>
              </div>



            </div>
          
            </div>
          </div>
         

        </div>
      </div>
    </div>
  </div>

@endsection

@section('scripts')

 <script type ="text/javascript">

$(document).ready(function () {
    $('#example').DataTable({

        "language": {
          "search":  "Buscar",
          "searchPlaceholder": "Buscar...",
          "lengthMenu": "Mostrar _MENU_ registros por página",
          "info":       "Mostrando página _PAGE_ de _PAGE_",
           "emptyTable":     "No hay datos disponibles en la tabla",
           "infoEmpty":      "Mostrando 0 a 0 de 0 entradas",
          "paginate": {

                    "previous": "Anterior",
                    "next":     "Siguiente",
                    "first":    "Primero",
                    "last":     "Último"
          }
        }

    });
});



</script>
@endsection


