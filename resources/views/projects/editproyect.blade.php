@extends('layouts.main', ['activePage' => 'proyect', 'titlePage' => 'Editar Post'])
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        {!!Form::model($proyect,['route'=>['proyect.update',$proyect->id],'method'=>'PUT'])!!}
           
          @csrf
       
          <div class="card">
            <!--Header-->
            <div class="card-header card-header-info">
              <h4 class="card-title">Editar</h4>
              <p class="card-category">Editar datos del proyecto</p>
            </div>
          @include('projects.ModalEditar') 
          </div>
          <!--End footer-->
     {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>
@endsection

