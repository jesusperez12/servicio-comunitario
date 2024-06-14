@extends('layouts.main', ['activePage' => 'asesorcomunity', 'titlePage' => 'Asesor y Comunidad'])
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        {!!Form::model($asesor,['route'=>['asesorcomunity.update',$asesor->id],'method'=>'PUT'])!!}
           
          @csrf
       
          <div class="card">
            <!--Header-->
           <div class="card-header card-header-info">
              <h4 class="card-title">Editar</h4>
              <p class="card-category">Asesor comunidad</p>
            </div>
          @include('asesorComunity.editMOdal') 
          </div>
          <!--End footer-->
     {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>
@endsection