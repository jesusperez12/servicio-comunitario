@extends('layouts.dashboard_administrador')
@section('title_pages')
<div class="pull-left header-pages-custom">
    <h1>
        Autoridades de certificación
    </h1>
</div>
@endsection
@section('content')
<div id="url-active" style="display:none;" data-url-active="{{ $link_active }}"></div>
<div class="row">
    <!--<div class="col-xs-12">
        <div class="alert alert-warning">
            <strong>Atención</strong> Esto está sujeto a cambios para el registro de las autoridades por cada sede.
        </div>
    </div>-->
</div>
<div class="row">
    @foreach($cargos as $cargo)
   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="cargo-authorities" id="cargo_authority_{{ $cargo->id }}">
            <div class="box box-widget widget-user">
                <div class="widget-user-header bg-aqua-active">
                    <h3 class="widget-user-username">{{ (count($cargo->autoridad) > 0) ? $cargo->autoridad[0]->autoridad : 'No registrado' }}</h3>
                    <h5 class="widget-user-desc">{{ $cargo->cargo }}</h5>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle" src="{{ url('assets/images/default-user-image.png') }}" alt="User Avatar">
                </div>
                <div class="box-footer">
                    <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <div class="description-block">
                        <button type="button" class="btn btn-sm btn-default btn-register-authority" 
                            data-autoridad-id="{{ (count($cargo->autoridad) > 0) ? $cargo->autoridad[0]->id : ''}}" 
                            data-cargo-id="{{ $cargo->id }}"
                            data-autoridad-nombre="{{ (count($cargo->autoridad) > 0) ? $cargo->autoridad[0]->autoridad : ''}}">Actualizar Información</button>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="modal fade" id="registerAuthoriy" role="dialog" aria-labelledby="registerAuthoriyLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="registerAuthoriyLabel">Registro de autoridad</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-xs-12">
                <form id="form-register-authority" name="form-register-authority" autocomplete="off">
                    {{ csrf_field() }}
                    <input type="hidden" name="autoridad_id" id="autoridad_id" value="">
                    <input type="hidden" name="cargo_id" id="cargo_id" value="">
                    <div class="form-group">
                        <label for="nombre_autoridad">Nombre de authoridad</label>
                        <input type="text" id="nombre_autoridad" class="form-control" name="nombre_autoridad" placeholder="Nombre de la autoridad">
                    </div>
                </form>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" form="form-register-authority" class="btn btn-primary" id="btn-save-register-authority"><i class="fa fa-floppy-o"></i> Guardar</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script src="{{ URL::asset('assets/js/admin/registerAuthority.js') }}"></script>
<script src="{{ URL::asset('assets/js/admin/formRegisterAuthority.js') }}"></script>
@endsection