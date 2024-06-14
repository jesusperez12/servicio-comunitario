@extends('layouts.main', ['activePage' => 'Certificados', 'titlePage' => 'Certificados'])

@section('content')

<div class="content">
  <div class="container-fluid">
    <div class="row">
    <div class="card-header card-header-info">

<h4 class="card-title">Sistema de Servicio Comunitario | {{ $sedeprincipal  }}   


</h4> 
</div>
      <div class="col-md-12">
        
          <div class="card ">
            <!--Header-->
            <div class="card-header card-header-info">
              <h4 class="card-title">Certificados</h4>
              <p class="card-category">Registrar</p>
            </div>
            <!--End header-->
            <!--Body-->
            <div class="card-body">
              <div class="row">

                                   @include('certificados.form.form')
                        
             




      </div>
    </div>
  </div>
</div>



        @endsection

        @section('scripts')

<script type ="text/javascript">

$('.numeric_input').on('input', function () { 
    this.value = this.value.replace(/[^0-9]/g,'');
});



    $(document).ready(function() {
      
$('.mi_checkbox').change(function() {
    //Verifico el estado del checkbox, si esta seleccionado sera igual a 1 de lo contrario sera igual a 0
    var Aprobado = $(this).prop('checked') == true ? 1 : 0; 
    var id = $(this).data('id'); 
        console.log(Aprobado);
    $.ajax({
        type: "GET",
        dataType: "json",
        //url: '/StatusNoticia',
        url: '{{ route('validarcertificado') }}',
        data: {'Aprobado': Aprobado, 'id': id},
        success: function(data){
            $('#resp' + id).html(data.var); 
            console.log(data.var)
         
        }
    });
})
      
});

$(document).ready(function () {
    $('#example').DataTable({ 


       scrollY: '50vh',
        scrollCollapse: true,

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

       } );
});


/*$(document).ready(function () {
    $('#example').DataTable({
        scrollY: '50vh',
        scrollCollapse: true,
        paging: false,
    });
});*/
  




function marcar(source) 
  {
    checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
    for(i=0;i<checkboxes.length;i++) //recoremos todos los controles
    {
      if(checkboxes[i].type == "checkbox") //solo si es un checkbox entramos
      {
        checkboxes[i].checked=source.checked; //si es un checkbox le damos el valor del checkbox que lo llamó (Marcar/Desmarcar Todos)
      }
    }

  
   
  }
  $("#chec").on("click", function() {  
    $(".oferta").prop("checked", this.checked);  
});
 





</script>

@endsection

<style>
 
.dataTables_filter {
   float: right !important;
}

 .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
                      .toggle.ios .toggle-handle { border-radius: 20px; }
</style>