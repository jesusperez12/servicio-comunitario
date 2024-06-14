@extends('layouts.dashboard_administrador')

@section('title_pages')
<div class="pull-left header-pages-custom">
    <h1>
        Permisos
    </h1>
</div>
@endsection

@section('content')
<div style="display:none" id="url-active" data-url-active="{{ $link_active }}"></div>
<div class="row">
    <div class="col-xs-4"> <!-- box-add-permission -->
        <div id="load_form_edit"> <!-- LOAD VIEW -->
        </div>
        <div id="load_form_add"> <!-- LOAD FORM ADD -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Nuevo Permiso</h3>
                    <div class="box-tools pull-right">
                    </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <form id="form-add-permission" name="form-add-permission" class="form" action="{{ url('/admin/user/permission') }}" method="POST" autocomplete="off">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('permission') ? ' has-error' : '' }}">
                                    <label for="permission">Nombre del permiso <span><a href="javascript:;" data-toggle="popover" data-trigger="focus" data-placement="top" title="Información" data-content="<b>El campo puede contener sólo los siguientes valores:</b><br> Letras de A a la Z a excepción de la Ñ y el único símbolo especial permitido, el guión bajo (_)."><i class="fa fa-info-circle"></i></a></span></label>
                                    <input type="text" class="form-control" id="permission" name="permission" value="{{ old('permission') }}" placeholder="Nombre del permiso">
                                    @if ($errors->has('permission')) 
                                    <span class="help-block">
                                        <strong>{{ $errors->first('permission') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <!--/.form-group-->
                                <div class="form-group{{ $errors->has('permission') ? ' has-error' : '' }}">
                                    <label for="permission_slug">Slug</label>
                                    <input class="form-control" type="text" id="permission_slug" name="permission_slug" readonly value="{{ old('permission_slug') }}" placeholder="Slug generado...">
                                    @if ($errors->has('permission_slug')) 
                                    <span class="help-block">
                                        <strong>{{ $errors->first('permission_slug') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <!--/.form-group-->
                                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                    <label for="description">Descripción</label>
                                    <textarea type="text" class="form-control" id="description" name="description" value="{{ old('description') }}" placeholder="Descripción del permiso"></textarea>
                                    @if ($errors->has('description')) 
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <!--/.form-group-->
                            </form>
                        </div>
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <div class="pull-right">
                        <button type="submit" form="form-add-permission" class="btn btn-sm btn-primary"><i class="fa fa-floppy-o"></i> Guardar</button>
                    </div>
                </div><!-- box-footer -->
            </div><!-- /.box -->
        </div>
    </div>

    <div class="col-xs-8">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Listado de Permisos</h3>
                <div class="box-tools pull-right">
                </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
                <table id="table-list-permissions" class="tc table table-bordered table-hover table-condensed">
                <thead>
                    <tr>
                        <th>Permiso</th>
                        <th>Descripción</th>
                        <th class="text-center" style="width:58px;"></th>
                    </tr>
                </thead>
                </table>
            </div>
        <!-- /.box-body -->
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ URL::asset('assets/js/admin/permissions.js') }}"></script>
@endsection