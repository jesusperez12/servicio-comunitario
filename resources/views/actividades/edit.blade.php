@extends('layouts.main', ['activePage' => 'Actividades', 'titlePage' => 'Actividades'])

@section('content')

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        
          <div class="card ">
            <!--Header-->
            <div class="card-header card-header-info">
              <h4 class="card-title">Actividades</h4>
              <p class="card-category">Registrar</p>
            </div>
            <!--End header-->
            <!--Body-->
            <div class="card-body">
              <div class="row">

                    {!!Form::model($user,['route'=>['Actividades.update',$user->id],'method'=>'PUT'])!!}
                      {{ csrf_field() }}
                    @include('actividades.form.form')
                        
                    {{ Form::close() }}




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
    $('.select2').select2();
});

 $(function () { 
            $('#grupo_id').change(function(){
                var valor = $(this).val();
               // console.log(valor);
            $("#prestadores").empty();
            axios.get('{{ route("get-prestadores")}}',{
                params: {
                valor : valor
                
            }
        }).then(response =>{
                $('#prestadores').append('');
                response.data.forEach(provinces => {
                $('#prestadores').append('<option value="'+provinces.id+'">'+provinces.firstname+'</option>');
                //console.log(response.data);
            });
        
            }); 
        });

  
});     



</script>

@endsection
