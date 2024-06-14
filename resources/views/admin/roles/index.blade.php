@extends('layouts.dashboard_administrador')

@section('title_pages')
<div class="pull-left header-pages-custom">
    <h1>
        Roles
    </h1>
</div>
@endsection

@section('content')
<div id="url-active" style="display:none" data-url-active="{{ $link_active }}"></div>
<div class="row">
    <div class="col-xs-4"> <!-- box-add-permission -->
        <div id="load_form_edit"></div> <!-- LOAD FORM EDIT ROLE -->
        <div id="load_form_add">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Nuevo Rol</h3>
                    <div class="box-tools pull-right">
                    </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <form id="form-add-role" name="form-add-role" class="form" action="{{ url('/admin/user/role') }}" method="POST" autocomplete="off">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                                    <label for="role">Nombre del rol</label>
                                    <input type="text" class="form-control" id="role" name="role" value="{{ old('role') }}" placeholder="Nombre del rol">
                                    @if ($errors->has('role')) 
                                    <span class="help-block">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                    <label for="description">Descripción</label>
                                    <textarea type="text" class="form-control" id="description" name="description" placeholder="Descripción del rol">{{ old('description') }}</textarea>
                                    @if ($errors->has('description')) 
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <div class="pull-right">
                        <button type="submit" form="form-add-role" class="btn btn-sm btn-primary"><i class="fa fa-floppy"></i> Guardar</button>
                    </div>
                </div><!-- box-footer -->
            </div><!-- /.box -->
        </div>
    </div>

    <div class="col-xs-8">
        <div class="box box-info">
            <!-- /.box-header -->
            <div class="box-body">
                <table id="table-list-roles-permissions" class="tc table table-bordered table-hover table-condensed">
                <thead>
                    <tr>
                        <th>Rol de usuario</th>
                        <th>Descripción</th>
                        <th style="width:100px;"></th>
                    </tr>
                </thead>
                </table>
            </div>
        <!-- /.box-body -->
        </div>
    </div>
</div>

<!-- Init modals -->
<!-- Modal Add Permission to Role -->
<div class="modal fade" id="mf-add-pr">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">ASIGNAR PERMISO</h4>
            </div>
            <div class="modal-body">
                <form id="f-add-pr" name="f-add-pr">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <input type="hidden" id="role_id" name="role_id">
                    <div class="form-group">
                        <label for="role-assign">Asignando permisos a</label>
                        <input id="role-assign" name="role-assign" type="text" class="form-control" readonly>
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label for="list-permissions">Permisos asignados</label>
                        <select id="list-permissions" name="list-permissions[]" class="form-control slt-list-permissions" multiple="multiple" data-placeholder="Seleccione los permisos" style="width: 100%;">
                        @if(count($permissions) > 0)
                            @foreach($permissions AS $permission)
                            <option value="{{ $permission->id }}">{{ $permission->permission }}</option>
                            @endforeach    
                        @endif
                        </select>
                    </div>
                    <!-- /.form-group -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="f-add-pr" class="btn btn-sm btn-primary">Guardar</button>
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

@endsection

@section('scripts')
<script src="{{ URL::asset('assets/js/admin/roles.js') }}"></script>
@endsection