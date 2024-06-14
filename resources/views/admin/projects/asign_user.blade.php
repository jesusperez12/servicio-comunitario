 <div class="box box-default" style="margin-bottom:3px;">
    <div class="box-header with-border">
        <h3 class="box-title">Asignar profesor(es) a proyecto</h3>
        <div class="box-tools pull-right">
        </div><!-- /.box-tools -->
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-xs-4"></div>
            <div class="col-xs-4">
                <form id="form-asign-user-project" name="form-asign-user-project" class="form-inline" autocomplete="off">
                    {{ csrf_field() }}
                    <input type="hidden" name="project_id" value="{{ $project }}">
                    <div class="form-group" style="display:inline;">
                        <label for="corte">Periodo académico</label>
                        <select type="text" class="form-control" style="width:100%" id="corte" name="corte_id">
                        @foreach($cortes as $corte)
                            <option value="{{$corte->id}}">{{ $corte->corte }}</option>
                        @endforeach
                        </select>
                    </div>
                    <br>
                    <br>
                    <div class="form-group" style="display:inline;">
                        <label for="usuarios">Seleccione el(los) profesor(es)</label>
                        <select type="text" class="form-control" style="width:100%" id="usuarios" name="usuarios[]" multiple>
                        @if(isset($users))
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->firstname }} {{ $user->primary_lastname }}</option>
                            @endforeach
                        @endif
                        </select>
                        <div class="pull-right" style="margin-top:10px;">
                            <button type="submit" class="btn btn-sm btn-primary btn-send-form"><i class="fa fa-floppy-o"></i> Guardar</button>
                        </div>
                    </div>
                </form>
                <br><br>
                <br><br>
            </div>
            <div class="col-xs-4"></div>
        </div>
    </div><!-- /.box-body -->
</div><!-- /.box -->