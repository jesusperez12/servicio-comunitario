@extends('layouts.dashboard_administrador')

@section('title_pages')
<div class="pull-left header-pages-custom">
    <h1>
        Bienvenidos
    </h1>
</div>
@endsection

@section('content')

<div class="row">
    <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Actividad reciente</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                No hay nada registrado
            </div><!-- /.box-body -->
            <div class="box-footer">
                <a href="{{ url('/users') }}" class="pull-right">Ver listado completo</a>
            </div><!-- box-footer -->
        </div><!-- /.box -->
    </div>
</div>

@endsection
