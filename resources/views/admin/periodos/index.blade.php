@extends('layouts.dashboard_administrador')

@section('title_pages')
<div class="pull-left header-pages-custom">
    <h1>
        Periodos académicos
    </h1>
</div>
@endsection

@section('content')
<div style="display:none" id="url-active" data-url-active="{{ $link_active }}"></div>
<div class="row">
    <div class="col-xs-8">
        <div class="box box-solid">
            <div class="box-body">
                <table id="table-list-periodos" class="tc table table-bordered table-condensed">
                <thead>
                    <tr>
                        <th>Periodo</th>
                        <th>Fecha de inicio</th>
                        <th>Fecha de cierre</th>
                        <th style="width:50px;">Status</th>
                        <th style="width:90px;"></th>
                    </tr>
                </thead>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>

@include('admin.periodos.modalAddPeriodo')
@include('admin.periodos.modalEditPeriodo')

@endsection

@section('scripts')
<script src="{{ URL::asset('assets/js/admin/periodos.js') }}"></script>
@endsection