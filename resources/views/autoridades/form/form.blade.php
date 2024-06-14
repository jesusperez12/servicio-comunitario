<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-3"></div>
    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
        <div class="box box-default" id="validate-form">
            <div class="box-header with-border text-center">
                <h4><b>Autoridades de Certificados</b></h4>
            </div>
            <div class="box-body">
             
                    <div class="row">
                        <div class="form-group">
                                <label for="sede_id">Institutos</label>
                                @if(isset($sedes))
                                {{ Form::select('sede_id', $sedes, null, ['class'=>'form-control', 'placeholder' => '.:Seleccione:.', 'id'=>'sede_id']) }}
                                    
                                @endif
                                 @if ($errors->has('sede_id'))
                                    <span class="error text-danger" for="input-sede_id">{{ $errors->first('sede_id') }}</span>
                                  @endif
                            </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="cargo_id">Cargo</label>
                                <div class="input-group">
                                     {{ Form::select('cargo_id', $cargo, null, [ 'class'=>'form-control','id'=>'cargo_id', 'placeholder' => 'Seleccione:'] ) }}
                                  
                                </div>
                                 @if ($errors->has('cargo_id'))
                                      <span class="error text-danger" for="input-cargo_id">{{ $errors->first('cargo_id') }}
                </span>
                                    @endif
                            </div>
                            <div class="form-group">
                                <label for="autoridad">Nombre y Apellido</label>
                                 {!!Form::text('autoridad', null, ['class' => 'form-control', 'id'=>'autoridad', 'placeholder'=>'Nombre'])!!} 
                                     @if ($errors->has('autoridad'))
                                      <span class="error text-danger" for="input-autoridad">{{ $errors->first('autoridad') }}
                </span>
                                    @endif
                            </div>
                        </div>
                    </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
                <div style="text-align: center">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Guardar</button>
                </div>
            </div><!-- box-footer -->
        </div><!-- /.box -->
        <div class="spinner" id="preload-validate-result"></div>
        

    </div>
    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-3"></div>