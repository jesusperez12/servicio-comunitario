@extends('layouts.main', ['activePage' => 'users', 'titlePage' => 'Detalles del usuario'])
@section('content')
<div class="content">
  <div class="container-fluid">
  <div class="centered">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-info">
            <div class="card-title" >Usuarios</div>
            <p class="card-category">Vista detallada del usuario {{ $user->name }}</p>
          </div>
          <!--body-->
          <div class="card-body">
            @if (session('success'))
            <div class="alert alert-success" role="success">
              {{ session('success') }}
            </div>
            @endif
            <div class="row">
             <!-- <div class="col-md-4">
                <div class="card card-user">
                  <div class="card-body">
                    <p class="card-text">
                      <div class="author">
                        <a href="#">
                          <img src="{{ asset('/img/default-avatar.png') }}" alt="image" class="avatar">
                          <h5 class="title mt-3">{{ $user->firstname }}</h5>
                        </a>
                        <p class="description">
                        {{ $user->firstname }} <br>
                        {{ $user->email }} <br>
                        {{ $user->created_at }}
                        </p>
                      </div>
                    </p>
                    <div class="card-description">
                       Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam officia corporis molestiae aliquid provident placeat.
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="button-container">
                      <button class="btn btn-sm btn-primary">Editar</button>
                    </div>
                  </div>
                </div>
              </div>end card user-->

              <div class="col-md-5">
                <div class="card card-user">
                  <div class="card-body">
                    <p class="card-text">
                      <div class="author">
                        
                        <a href="#" class="d-flex">
                          <img src="{{ asset('/img/default-avatar.png') }}" alt="image" class="avatar">
                          <h5 class="title mx-3"><FONT COLOR="black">{{ $user->firstname }} </FONT></h5>
                        </a>

                        <div class="card-description">
                       <b>Identificación:</b><FONT COLOR="black">{{ $user->ci }}  </FONT> <br>
                    </div>
                        <p class="description">
                       
                         
                          <b>Nombres:</b> <FONT COLOR="black">{{ $user->firstname }}  {{ $user->middlename }}</FONT> <br>

                          <b>Apellidos:</b> <FONT COLOR="black">{{ $user->primary_lastname }}  {{ $user->second_lastname }} </FONT><br>


                          <b>Fecha de Nacimiento:</b><FONT COLOR="purple">{{ $user->date_birth }} </FONT>  <br>
                         
                                                  </p>
                      </div>
                    </p>
                    <div class="card-description">
                      <b>Roles:</b>

                          <span class="badge rounded-pill bg-dark text-white">{{ $user->name }}</span>
                          &nbsp;&nbsp;
                          <b>Fecha de registro:</b>
                           <td><FONT COLOR="purple">{{  $user->created_at  }} </FONT></td>
                    </div>
                  </div>
                
                </div>
              </div><!--end card user 2-->

              <!--Start third-->
              <div class="col-md-6">
                <div class="card card-user">
                  <div class="card-body">
                    <table class="table table-bordered table-striped">
                      <tbody>
                        <tr>
                        
                        <tr>
                          <th>Instituto</th>
                          <td><span class="badge badge-primary">{{$user->NombInstituto }}</span></td>
                        </tr>
                    
                        <tr>
                          <th>Género</th>
                          @if($user->gender == 1)
                          <td>Masculino</td>
                          @else
                          <td>Femenino</td>
                          @endif
                        </tr>
                          <th>Dirección</th>
                          <td>{{ $user->address }}</td>
                        </tr>
                        <tr>
                          <th>Teléfono</th>
                          <td>{{$iphone->code}} {{$iphone->number}}</td>
                        </tr>
                     
                      </tbody>
                    </table>
                  </div>
                  <div style="text-align: center">
                    <div class="button-container">
                      <a href="{{ route('users.index') }}" class="btn btn-sm btn-success mr-3"> Volver </a>
                     
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
@endsection
