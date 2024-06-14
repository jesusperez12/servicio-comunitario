@extends('layouts.main', ['activePage' => 'Autoridades', 'titlePage' => 'Autoridades'])

@section('content')

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        
          <div class="card ">
            <!--Header-->
            <div class="card-header card-header-info">
              <h4 class="card-title">Autoridades</h4>
              <p class="card-category">Actualizar autoridades</p>
            </div>
            <!--End header-->
            <!--Body-->
            <div class="card-body">
              <div class="row">

                   {!!Form::model($user,['route'=>['Autoridades.update',$user->id],'method'=>'PUT'])!!}
                      {{ csrf_field() }}
                    @include('autoridades.form.form')
                        
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

</script>

@endsection
