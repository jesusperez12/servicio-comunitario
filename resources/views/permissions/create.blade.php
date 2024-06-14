@extends('layouts.main', ['activePage' => 'permissions', 'titlePage' => 'Nuevo permiso'])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <form action="{{ route('permissions.store') }}" method="post" class="form-horizontal">
          @csrf
          <div class="card">
            <div class="card-header card-header-info">
              <h4 class="card-title">Permiso</h4>
              <p class="card-category">Ingresar datos</p>
            </div>
            <div class="card-body"id="itemDate" >
              <div class="row" >
                <label for="name" class="col-sm-2 col-form-label">Nombre del permiso</label>
                <div class="col-sm-7" >
                  <div class="form-group" >
                    <input type="text" class="form-control" name="name[]" autofocus>


                  </div>
                </div>

        </div>

              </div>

  
                  <div class="box-footer" id="item-add">
                    <div class="col-sm-5" >
                    <button id="btn_arf" type="button" class="btn btn-xs btn-success pull-right" onclick="add();"><i class="fa fa-plus"></i> </button>
                </div><!-- /.box-footer -->
        </div>

            <!--Footer-->
            <div class="card-footer ml-auto mr-auto">
              <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
            <!--End footer-->
          </div>


        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')

 <script type ="text/javascript">

function add(){
    // Clonar contenedor, eliminar ID
    let nuevo = $('#itemDate').clone();
    nuevo.attr('id', '');
    // Agregar clase para poder obtener el padre al eliminar
    nuevo.addClass('itemDate');
    nuevo.find('input').each(function() {
        // Solo establecer el valor
        this.value = '';
        // Dejar el nombre con corchetes, para que sea un arreglo
    });
    // Agregar botón para eliminar
    $(nuevo).append(' <button class="item-delete">X</button>');
    // Insertar nuevo contenedor antes del botón "Agregar"
    $(nuevo).insertBefore('#item-add');
}
// Función para eliminar
function removeThisFile(ele) {
    // $(this) es el elemento que disparó el evento
    // ele no es el elemento, sino el evento
    // Obtener padre por clase, usando closest()
    $(this).closest('.itemDate').remove();
}
// Escuchar clic en botón Agregar
$('#item-add .button').on('click', add);

// Escuchar clic en botones para borrar
$(document.body).on('click', '.item-delete', removeThisFile);




</script>
@endsection
