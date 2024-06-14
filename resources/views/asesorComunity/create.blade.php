@extends('layouts.main', ['activePage' => 'asesorcomunity', 'titlePage' => 'Asesor y Comunidad'])

@section('content')

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        
          <div class="card ">
            <!--Header-->
            <div class="card-header card-header-info">
              <h4 class="card-title">Asesor y Comunidad</h4>
              <p class="card-category">Registrar</p>
            </div>
            <!--End header-->
            <!--Body-->
            <div class="card-body">
              <div class="row">

                  {{ Form::open(['route' => 'asesorcomunity.store']) }}
                      {{ csrf_field() }}
                    @include('asesorComunity.form.AsesorComunityModal')
                        
                    {{ Form::close() }}




      </div>
    </div>
  </div>
</div>



        @endsection

        @section('scripts')

<script type ="text/javascript">

$('.numeric-input').on('input', function () { 
    this.value = this.value.replace(/[^0-9]/g,'');
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
