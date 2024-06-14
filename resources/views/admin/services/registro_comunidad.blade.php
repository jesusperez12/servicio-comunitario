 <div class="nav-tabs-custom" style="margin-bottom:0px;">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Asesor Comunitario</a></li>
        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Comunidad</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
       
            <form id="form-register-asesor" name="form-register-asesor"  autocomplete="off">
                {{ csrf_field() }}
                <input type="hidden" name="pup_id" value="">
                <input type="hidden" name="comunidad_id" value="">
                <input type="hidden" name="asesor_id" value="">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="ci">Nº de identidad</label>
                            <input type="text" id="ci" class="form-control numeric-input" name="ci" placeholder="Cédula de identidad" maxlength="8">
                            <label id="ci-error" class="error" for="ci" style="display:none;"></label>
                        </div>
                        <div class="form-group">
                            <label for="firstname">Primer nombre</label>
                            <input type="text" id="firstname" class="form-control" name="firstname" placeholder="Primer nombre...">
                        </div>
                        <div class="form-group">
                            <label for="middlename">Segundo nombre</label>
                            <input type="text" id="middlename" class="form-control" name="middlename" placeholder="Segundo nombre...">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="primary_lastname">Primer apellido</label>
                            <input type="text" id="primary_lastname" class="form-control" name="primary_lastname" placeholder="Primer apellido...">
                        </div>
                        <div class="form-group">
                            <label for="second_lastname">Segundo apellido</label>
                            <input type="text" id="second_lastname" class="form-control" name="second_lastname" placeholder="Segundo apellido...">
                        </div>
                        <div class="form-group">
                            <label for="phones">
                                Teléfono(s) 
                                &nbsp;
                                <span>
                                <a href="#!" id="plus-phone" 
                                data-toggle="tooltip" data-container="body" data-title="Añadir teléfono" data-placement="top">
                                    <i class="fa fa-plus-circle"></i>
                                </a>
                                </span>
                            </label>
                            <div id="element-phone" class="element-phone">
                                <div class="input-group">
                                    <input type="hidden" name="phones_id[]">
                                    <span class="input-group-addon"><i class="fa fa-location-arrow"></i></span>
                                    <select name="codes[]" type="text" class="form-control code">
                                    @if(isset($codes))
                                        @foreach($codes AS $code)
                                        <option value="{{ $code->id }}">{{ $code->code }}</option>
                                        @endforeach
                                    @endif
                                    </select>
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    <input id="phones" name="phones[]" type="text" class="form-control phone numeric-input" placeholder="Número de teléfono" maxlength="7">
                                </div>
                                <label id="phones-error" class="error" style="display: none;" for="phones"></label>
                            </div>
                            <div class="optional-plus-phones"></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_2">
            <form id="form-register-comunity" name="form-register-comunity">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="comunidad">Nombre de la comunidad</label>
                            <input type="text" id="comunidad" class="form-control" name="comunidad" placeholder="Nombre de la comunidad">
                        </div>
                        <div class="form-group" >
                            <label for="direccion">Dirección</label>
                            <input type="text" id="direccion" class="form-control"  name="direccion" placeholder="Dirección...">
                        </div>
                        <div class="form-group" >
                            <label for="sector">Sector</label>
                            <input type="text" id="sector" class="form-control"  name="sector" placeholder="Sector...">
                        </div>
                        <div class="form-group">
                            <label for="state">Estado</label>
                            <select id="state" name="state" class="form-control address-select" style="width:100%;">
                            @if($states)
                                @foreach($states AS $state)
                                <option data-id="{{ $state->id }}" value="{{ $state->state }}">{{ $state->state }}</option>
                                @endforeach
                            @endif
                            </select>
                            <label id="state-error" class="error" style="display: none;" for="state"></label>
                        </div>
                        <div class="form-group">
                            <label for="province">Municipio</label>
                            <select id="province" name="province" class="form-control address-select" style="width:100%;">
                            </select>
                            <label id="province-error" class="error" style="display: none;" for="province"></label>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="locality">Parroquia</label>
                            <select id="locality" name="locality" class="form-control address-select" style="width:100%;">
                            </select>
                            <label id="locality-error" class="error" style="display: none;" for="locality"></label>
                        </div>
                        <!--<br>
                        <h4>Area dónde acamparán prestadores del servicio</h4>-->
                        <div class="form-group" >
                            <label for="lugar_prestadores">Lugar dónde acamparán prestadores del servicio</label>
                            <input type="text" id="lugar_prestadores" class="form-control"  name="lugar_prestadores" placeholder="Lugar...">
                        </div>
                        <div class="form-group" >
                            <label for="direccion_lugar">Dirección de referencia</label>
                            <input type="text" id="direccion_lugar" class="form-control"  name="direccion_lugar" placeholder="Dirección de referencia...">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.tab-pane -->
        <div class="row">
            <div class="col-xs-12">
                <div class="pull-right" style="margin-top:28px;">
                    <button type="button" id="btn-save-asesor_comunity" class="btn btn-primary "><i class="fa fa-floppy-o"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.tab-content -->
</div>
 
 
 
 <div class="box box-default" style="margin-bottom:3px;">
    <div class="box-header with-border">
        <h3 class="box-title">Registro de Asesor Comunitario y Comunidad</h3>
        <div class="box-tools pull-right">
        </div>
    </div>
    <div class="box-body">
        <div id="msg-alert" class="alert alert-warning" style="display:none;">
            <strong>¡¡Importante!!</strong> Antes de registrar la comunidad, debe tener los datos del asesor comunitario de dicha comunidad para poder completar el registro.
        </div>
        
            
        </form>
    </div>
</div> 