@extends('layouts.dashboard_administrador')

@section('title_pages')
<div class="pull-left header-pages-custom">
    <h1>
        Reporte de actividades
    </h1>
</div>
@endsection

@section('content')
<div id="url-active" style="display:none;" data-url-active="{{ $link_active }}"></div>
<!--<div class="row">
    <div class="col-xs-4">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-clock-o"></i></span>
            <div class="info-box-content">
            <span class="info-box-text">Total de Horas</span>
            <span class="info-box-number">41,410</span>
            </div>
            
        </div>
    </div>
    <div class="col-xs-4">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-list-alt"></i></span>
            <div class="info-box-content">
            <span class="info-box-text">Total de Actividades</span>
            <span class="info-box-number">41,410</span>
            </div>
            
        </div>
    </div>
    <div class="col-xs-4">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-group"></i></span>
            <div class="info-box-content">
            <span class="info-box-text">Total de Beneficiados</span>
            <span class="info-box-number">41,410</span>
            </div>
            
        </div>
    </div>
</div>-->
<div class="row">
    <div class="col-xs-12">
        <div class="box box-info">
            <!--<div class="box-header with-border">
                <h3 class="box-title">Actividades</h3>
            </div> /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-12">
                        <table id="table-my-list-reports" class="tc table table-bordered table-condensed">
                            <thead>
                                <tr>
                                    <th style="width:85px;">Fecha</th>
                                    <th>Actividad</th>
                                    <th style="width:85px;">Duración</th>
                                    <th style="width:85px;">Periodo</th>
                                    <th style="width:120px;"></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ URL::asset('assets/js/admin/reports_list.js') }}"></script>
@endsection