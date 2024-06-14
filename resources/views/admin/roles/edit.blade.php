 <div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Actualizar Rol</h3>
        <div class="box-tools pull-right">
        </div><!-- /.box-tools -->
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-xs-12">
                <form id="form-edit-role" name="form-edit-role" class="form" action="{{ url('/admin/user/role', [$role->id]) }}" method="POST" autocomplete="off">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <input type="hidden" name="role_id" value="{{ $role->id }}">
                    <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                        <label for="role">Nombre del rol</label>
                        <input type="text" class="form-control" id="role" name="role" value="{{ $role->role }}" placeholder="Nombre del rol">
                        @if ($errors->has('role')) 
                        <span class="help-block">
                            <strong>{{ $errors->first('role') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="description">Descripción</label>
                        <textarea type="text" class="form-control" id="description" name="description" placeholder="Descripción del rol">{{ $role->description }}</textarea>
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
            <button id="b-can-up-ro" type="button" class="btn btn-sm btn-danger"><i class="fa fa-remove"></i> Cancelar</button>
            <button type="submit" form="form-edit-role" class="btn btn-sm btn-primary"><i class="fa fa-floppy-o"></i> Guardar</button>
        </div>
    </div><!-- box-footer -->
</div><!-- /.box -->