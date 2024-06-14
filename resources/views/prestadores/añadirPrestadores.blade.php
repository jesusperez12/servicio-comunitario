@extends('layouts.main', ['activePage' => 'Prestadores', 'titlePage' => 'Prestadores'])

@section('content')

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        
          <div class="card ">
            <!--Header-->
            <div class="card-header card-header-info">
              <h4 class="card-title">Estudiantes</h4>
              <p class="card-category">Ingresar datos de los Estudiantes </p>
            </div>
            <!--End header-->
            <!--Body-->
            <div class="card-body">
              <div class="row">

                  {{ Form::open(['route' => 'Prestadores.store']) }}
                      {{ csrf_field() }}
                    @include('prestadores.form.form')
                        
                    {{ Form::close() }}




      </div>
    </div>
  </div>
</div>



        @endsection

        @section('scripts')

<script type ="text/javascript">


  $(function () { 
            $('#proyect').change(function(){
                var valor = $(this).val();
               // console.log(valor);
            $("#especialidad").empty();
            axios.get('{{ route("especialidad")}}',{
                params: {
                valor : valor
                
            }
        }).then(response =>{
                $('#especialidad').append('<option>--Seleccione--</option>');
                response.data.forEach(provinces => {
                $('#especialidad').append('<option value="'+provinces.cod+'">'+provinces.nombre+'</option>');
             // console.log(response.data);
            });
        
            }); 
        });


                


  
});

  

  


$("#search").on('keypress', function() {
       var myText = $(this).val();
   
   
       $.ajax({
  url: '{{ route("getPrestador")}}',
  type: "post",
  dataType: "json",
  data: {_token: "{{ csrf_token() }}", text: myText },
  success: function (response) {
     $("#table-body").html(response);
  }
})
   
   }) 

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

// Solo para probar
$('#item-check button').on('click', function() {
   // Recorrer todos los campos
   // Todos tienen el mismo nombre, pero cada uno tiene índice
   $('[name="date[]"]').each(function(index) {
       console.log(index, $(this)[0]);
   });
});


$("#autocomplete-search").easyAutocomplete({
  url: function(search) {
      return "{{route('prestador.search')}}?search=" + search;
  },

  getValue: "ci",
  list: {
   onClickEvent: function() {
           var selectedPost = $("#autocomplete-search").getSelectedItemData();
           $("#firstname").val(selectedPost.firstname);
           $("#middlename").val(selectedPost.middlename);
           $("#primary_lastname").val(selectedPost.primary_lastname);
           $("#second_lastname").val(selectedPost.second_lastname);
          // source: selectedPost;
      // multiselect: true;
           
       }
      /* onChooseEvent: function() {
           var selectedPost = $("#autocomplete-search").getSelectedItemData();
           window.location = "{{route('Prestadores.create')}}" + "/" + selectedPost.id;
       }*/
   }

});

/*$(document).ready(function() {
    $("#tags").select2({
                    placeholder: 'Seleccionar...',
                    multiple: true,
                    ajax: {
                        type: 'GET',
                        url: "{{route('prestador.search')}}",
                        dataType: 'json',
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(posts) {
                                    return {
                                        text: posts.ci,
                                        id: posts.ci
                                    }
                                })
                            };
                        }
                    }
                });
            });*/

            var route = "{{route('prestador.search')}}";
  

  $('#users').select2({

    placeholder: 'Seleccionar Estudiantes',

    escapeMarkup: function(markup) { 
          return markup;
    },
    templateResult: function(data) {
       
      return data.html;
    },
    templateSelection: function(data) {
      

      if (data && !data.selected) 
      return data.text;
    },
    ajax: {
      url: route,
      dataType: 'json',
      delay: 250,
      processResults: function(data) {
        return {
          results: $.map(data, function(item) {
            return {
              html:"<span>"+item.primer_nombre+"<span> "+item.primer_apellido+" </span></span><br><span style='color:red'>"+item.cedula+"</span>",
              text: item.primer_nombre,
              id: item.cedula
            }
          })
        };
      },
      cache: true,

    }
  });
 


$(document).ready(function(){
 // $('#periodo').mask('0000-ii');
   $('#grupo').mask('00');
});

</script>

@endsection


