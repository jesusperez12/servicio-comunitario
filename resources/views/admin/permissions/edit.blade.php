<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Actualizar Permiso</h3>
        <div class="box-tools pull-right">
        </div><!-- /.box-tools -->
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-xs-12">
                <form id="form-edit-permission" name="form-edit-permission" class="form" action="{{ url('/admin/user/permission', [$permission->id]) }}" method="POST" autocomplete="off">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <input type="hidden" name="permission_id" value="{{ $permission->id }}">
                    <div class="form-group{{ $errors->has('permission') ? ' has-error' : '' }}">
                        <label for="permission">Nombre del permiso <span><a href="javascript:;" data-toggle="popover" data-trigger="focus" data-placement="top" title="Información" data-content="<b>El campo puede contener sólo los siguientes valores:</b><br> Letras de A a la Z a excepción de la Ñ y el único símbolo especial permitido, el guión bajo (_)."><i class="fa fa-info-circle"></i></a></span></label>
                        <input type="text" class="form-control" id="permission" name="permission" value="{{ $permission->permission }}" placeholder="Nombre del permiso">
                        @if ($errors->has('permission')) 
                        <span class="help-block">
                            <strong>{{ $errors->first('permission') }}</strong>
                        </span>
                        @endif
                    </div>
                    <!--/.form-group-->
                    <div class="form-group{{ $errors->has('permission_slug') ? ' has-error' : '' }}">
                        <label for="permission_slug">Slug</label>
                        <input class="form-control" type="text" id="permission_slug" name="permission_slug" readonly value="{{ $permission->permission_slug }}" placeholder="Slug generado...">
                        @if ($errors->has('permission_slug')) 
                        <span class="help-block">
                            <strong>{{ $errors->first('permission_slug') }}</strong>
                        </span>
                        @endif
                    </div>
                    <!--/.form-group-->
                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="description">Descripción</label>
                        <textarea type="text" class="form-control" id="description" name="description" placeholder="Descripción del permiso">{{ $permission->description }}</textarea>
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
            <button id="b-can-up-pe" type="button" class="btn btn-sm btn-danger"><i class="fa fa-remove"></i> Cancelar</button>
            <button type="submit" form="form-edit-permission" class="btn btn-sm btn-primary"><i class="fa fa-floppy-o"></i> Guardar</button>
        </div>
    </div><!-- box-footer -->
</div><!-- /.box -->