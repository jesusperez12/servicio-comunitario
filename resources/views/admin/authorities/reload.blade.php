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