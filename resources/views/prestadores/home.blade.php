@extends('layouts3.dashboard_administrador_public')

@section('content')

<div class="row">
    <div class="col-md-3">

        <!-- Profile Image -->
        <div class="box box-primary">
        <div class="box-body box-profile">
            <img class="profile-user-img img-responsive img-circle" src="{{ URL::asset('assets/images/default-user-image.png') }}" alt="Perfil de prestador">

            <h3 class="profile-username text-center">{{  ucfirst($prestador->firstname) }} {{ ucfirst($prestador->primary_lastname) }}</h3>

            <p class="text-muted text-center">Estudiante de servicio</p>

            <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
                <b>Horas comunitarias</b> <a class="pull-right">{{ $prestador->hrs_comunitarias }}</a>
            </li>
            <li class="list-group-item">
                <b>Número de actividades</b> <a class="pull-right">{{ $count_actividades }}</a>
            </li>
      

            <li class="list-group-item" id="carterasDatas">
                <b>Horas acumuladas (Proyecto)</b> <a class="pull-right">{{ $suma }}
                 </a>
            </li>
            </ul>
         @if($userCertificado->Aprobado == NULL || $userCertificado->Aprobado == 0)
             <a class="btn btn-primary btn-block" disabled="disabled"><b>Imprimir certificado</b></a>
            @else
             <a href="{{ route('Estudiante.certificate') }}" class="btn btn-primary btn-block"><b>Imprimir certificado</b></a>
            
              @endif
        </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->

        <!-- About Me Box -->
        <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Proyecto</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <strong><i class="fa fa-book margin-r-5"></i> Título del proyecto</strong>

            <p class="text-muted" style="padding-left:20px;">
            {{ $proyecto->nombre_proyecto }}
            </p>

            <p class="text-muted" style="padding-left:20px;">
            <b>Inicio:</b> {{ date_format(new DateTime($pup_relations->created_at), 'd/m/Y') }} - <b>Fin: </b> {{ ($pup_relations->finalized_at) ? date_format(new DateTime($pup_relations->finalized_at), 'd/m/Y') : "Pendiente" }}
            </p>

            <hr>

       

            
        </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#activity" data-toggle="tab">Resumen de actividades</a></li>
        </ul>
        <div class="tab-content">
            <div class="active tab-pane" id="activity">
            @if (count($actividades) > 0) 
            @foreach($actividades as $actividad)
            <!-- Post -->
            <div class="post">
                <div class="user-block">
                <img class="img-circle img-bordered-sm" src="{{ URL::asset('assets/images/icono-redaccion-proyectos.png') }}" alt="user image">
                    <span class="username">
                        <a href="#">{{ $actividad->actividad }}</a>
                    </span>
                <span class="description"><i class="fa fa-clock-o"></i> {{ $actividad->hrs }} h &nbsp; - &nbsp; <i class="fa fa-calendar"></i> {{ date_format(new DateTime($actividad->fecha), 'd/m/Y') }}</span>
                </div>
                <!-- /.user-block -->
                <div class="block-detalle">
                    {{$actividad->detalle, 140}}
                </div>
            </div>
            <!-- /.post -->
            @endforeach
            @else
            <div class="text-center text-red"><span>No hay actividades registradas</span></div>
            @endif
            </div>
        </div>
        <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

@endsection
@section('scripts')

 <script type ="text/javascript">


  </script>
@endsection


