@extends('layouts.main', ['activePage' => 'proyect', 'titlePage' => 'Editar posts'])
@section('content')

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header card-header-info">
                    <h4 class="card-title">Proyecto</h4>
                    <p class="card-category">Asignar Proyectos</p>
                  </div>
                


<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          
<div class="card-body">
            @if (session('success'))
            <div class="alert alert-success" role="success">
              {{ session('success') }}
            </div>
            @endif
            
            <div class="col-md-6">
                <div class="card card-user">
                  <div class="card-body">
                    <table class="table table-bordered table-striped">
                      <tbody>
                        <tr>
                        
                        <tr>
                          <th>Proyecto</th>
                          <td><span class="badge badge-primary">{{ $posts->nombre_proyecto }}</span></td>
                        </tr>
                        <tr>
                            <th>Línea de acción:</th>
                          <td>{{ $posts->linea_accion }}</td>
                        </tr>
                          <th>Fundamentación:</th>
                          <td>{{ $posts->fundamentacion }}</td>
                        </tr>
                        <tr>
                          <th>Propósito:</th>
                          <td>{{ $posts->proposito }}</td>
                        </tr>
                     <tr>
                          <th>Competencia:</th>
                          <td>{{ $posts->competencia }}</td>
                        </tr>
                     <tr>
                          <th>Metodología:</th>
                          <td>{{ $posts->metodologia }}</td>
                        </tr>
                     <tr>
                          <th>Relación con el Plan de Desarrollo de la Nación:</th>
                          <td>{{ $posts->referencia }}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div style="text-align: center">
                    <div class="button-container">
                      <a href="{{ route('proyect.index') }}" class="btn btn-sm btn-success mr-3"> Volver </a>
                     
                    </div>
                  </div>
                </div>
              </div>
              <!--end third-->

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
    </div>
@endsection


                 
           










