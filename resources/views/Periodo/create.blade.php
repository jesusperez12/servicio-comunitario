@extends('layouts.main', ['activePage' => 'Periodo', 'titlePage' => 'Periodo'])




@section('content')





<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-info">
            <h4 class="card-title">Períodos</h4>
            <p class="card-category">Lista de Períodos</p>
          </div>
          <div class="card-body">
          
             
            <div class="table-responsive">


 <div class="container">
  <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 col-md-offset-2">
    
  <div class="card card-primary ">

  <div class="card-body">
  {{ Form::open(['route' => 'Periodo.store']) }}
                      {{ csrf_field() }}
                    @include('Periodo.formulario.form')
                        
                    {{ Form::close() }}
   

      </div>
  </div>
</div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
  


var selector = document.getElementById("periodo");
//var corte = document.getElementById("corte");

var im = new Inputmask("9999-A{1,3}");
//var Co = new Inputmask("9999");
//var idami = new Inputmask("9999");
im.mask(selector);
//Co.mask(corte);



/*$(document).ready(function () {
        $("#corte").keyup(function () {
            var value = $(this).val();
            $("#periodo").val(value);
        });


        
});*/


</script>

@endsection




<style>
.container {
display: flex;
flex-direction: column;
align-items: center;
justify-content: center;
}

</style>

