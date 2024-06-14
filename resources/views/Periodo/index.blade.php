@extends('layouts.main', ['activePage' => 'Periodo', 'titlePage' => 'Periodo'])




@section('content')

          

 <div class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-md-12">
          <div class="card-header card-header-info">

<h4 class="card-title">Sistema de servicio comunitario | {{ $sedeprincipal  }}   


</h4> 
</div>
            <div class="row">

          
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header card-header-info">
                    <h4 class="card-title">Período</h4>
                    <p class="card-category">Períodos registrados</p>
                  </div>
                 
                    <div class="row">
                      <div class="col-12 text-right">
                        @can('Periodo_create')
                        <a href="{{ route('Periodo.create') }}" class="btn btn-sm btn-facebook">Añadir Período</a>
                        @endcan
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                         <th>N°</th>
                         
                            <th>Período</th>
                            <th>Fecha de inicio</th>
                            <th>Fecha de Cierre</th>
                            <th>Institutos</th>
                          <th class="text-right">Acciones</th>
                        </thead>
                        <tbody>
                          @foreach ($consultas as $key => $user)
                            <tr>
                                 <td>{{ ++$i }}</td>
                               
                                <td>{{ $user->corte }}</td>
                                <td>{{ $user->inicio }}</td>
                                 <td>{{ $user->fin }}</td>   
                             <td>{{ $user->NombInstituto }}</td>
                             
                              <td class="td-actions text-right">
                          
                              @can('Periodo_edit')
                                <a  href="{{ route('Periodo.edit',$user->id) }}" width="480" class="btn btn-warning"><i class="material-icons">edit</i></a>
                                @endcan
                               @can('Periodo_destroye')
                                <form action="{{ route('Periodo.destroy', $user->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Seguro?')">
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
                
                  <div class="card-footer mr-auto">
                    {{ $consultas->links() }}
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



