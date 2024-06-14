@extends('layouts.dashboard_administrador')

@section('title_pages')
<div class="pull-left header-pages-custom">
    <h1>
        Listado de proyectos
    </h1>
</div>
@endsection

@section('content')
<div id="url-active" style="display:none;" data-url-active="{{ $link_active }}"></div>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-info">
            <!--<div class="box-header with-border">
                <h3 class="box-title">Listado de proyectos</h3>
            </div><! /.box-header -->
            <div class="box-body">
                <table id="table-list-projects" class="tc table table-bordered table-condensed">
                <thead>
                    <tr>
                        <th>Título del proyecto</th>
                        <th></th>
                    </tr>
                </thead>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ URL::asset('assets/js/admin/projects_list.js') }}"></script>
@endsection