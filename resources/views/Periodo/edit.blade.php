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
 

       {!! Form::model($periodos, ['route' => ['Periodo.update', $periodos->id],
                    'method' => 'PUT']) !!}
                      {{ csrf_field() }}
                    @include('Periodo.modalEditPeriodo')
                        
            {{ Form::close() }}
   

      </div>
  </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

@endsection





<style>
.container {
display: flex;
flex-direction: column;
align-items: center;
justify-content: center;
}

</style>