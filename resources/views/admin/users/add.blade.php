@extends('layouts.dashboard_administrador')

@section('title_pages')
<div class="pull-left header-pages-custom">
    <h1>
        Nuevo usuario
    </h1>
</div>
@endsection

@section('content')
<div id="url-active" style="display:none;" data-url-active="{{ $link_active }}"></div>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-solid">
            <!--<div class="box-header with-border">
                <h4>Crear usuario</h4>
            </div>-->
            <div class="box-body">
                @if (count($errors) > 0)
                    <!-- Form Error List -->
                    <div class="alert alert-danger">
                        <strong>Whoops! Algo ha salido mal!</strong>
                        <br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form id="form-add-user" name="form-add-user" action="{{ url('admin/user/add') }}" method="POST" autocomplete="off">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="ci">Número de identidad</label>
                                <div class="input-group">
                                    <span class="input-group-addon">V-</span>
                                    <input id="ci" name="ci" type="text" class="form-control numeric-input" placeholder="CÉDULA DE IDENTIDAD">
                                </div>
                                <label id="ci-error" class="error" style="display: none;" for="ci"></label>
                            </div>
                            <div class="form-group">
                                <label for="firstname">Primer nombre</label>
                                <input id="firstname" name="firstname" type="text" class="form-control" placeholder="Primer nombre">
                            </div>
                            <div class="form-group">
                                <label for="middlename">Segundo nombre</label>
                                <input id="middlename" name="middlename" type="text" class="form-control" placeholder="Segundo nombre">
                            </div>
                            <div class="form-group">
                                <label for="primary_lastname">Primer apellido</label>
                                <input id="primary_lastname" name="primary_lastname" type="text" class="form-control" placeholder="Primer apellido">
                            </div>
                            <div class="form-group">
                                <label for="second_lastname">Segundo apellido</label>
                                <input id="second_lastname" name="second_lastname" type="text" class="form-control" placeholder="Segundo apellido">
                            </div>
                            <div class="form-group">
                                <label for="date_birth">Fecha de nacimiento</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input id="date_birth" name="date_birth" type="text" class="form-control date-default" placeholder="FECHA DE NACIMIENTO">
                                </div>
                                <label id="date_birth-error" class="error" style="display: none;" for="date_birth"></label>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="address">Dirección</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                    <input id="address" name="address" type="text" class="form-control" placeholder="Dirección">
                                </div>
                                <label id="address-error" class="error" style="display: none;" for="address"></label>
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
                            <div class="form-group">
                                <label for="locality">Parroquia</label>
                                <select id="locality" name="locality" class="form-control address-select" style="width:100%;">
                                </select>
                                <label id="locality-error" class="error" style="display: none;" for="locality"></label>
                            </div>
                            <div class="form-group">
                                <label for="email">Correo electrónico</label>
                                <input id="email" name="email" type="email" class="form-control lowercase-style" placeholder="CORREO ELECTRÓNICO">
                                <label id="email-error" class="error" style="display: none;" for="email"></label>
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
                                        <span class="input-group-addon"><i class="fa fa-location-arrow"></i></span>
                                        <select name="codes[]" type="text" class="form-control code">
                                        @if($area_codes)
                                            @foreach($area_codes AS $code)
                                            <option value="{{ $code->id }}">{{ $code->code }}</option>
                                            @endforeach
                                        @endif
                                        </select>
                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        <input id="phones" name="phones[]" type="text" class="form-control phone numeric-input" maxlength="7" placeholder="Número de teléfono">
                                    </div>
                                    <label id="phones-error" class="error" style="display: none;" for="phones"></label>
                                </div>
                                <div class="optional-plus-phones"></div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="speciality">Especialidad</label>
                                <select id="speciality" name="speciality" class="form-control speciality-select">
                                @if(isset($especialidades))
                                    @foreach($especialidades as $especialidad)
                                    <option value="{{ $especialidad->cod }}">{{ $especialidad->nombre }}</option>
                                    @endforeach
                                @endif
                                </select>
                                <label id="speciality-error" class="error" style="display: none;" for="speciality"></label>
                            </div>
                            @if(auth()->user()->hasRole() == "administrador")
                            <div class="form-group">
                                <label for="role_id">Rol del usuario</label>
                                <select id="role_id" name="role_id" class="form-control">
                                @if(isset($roles))
                                    @foreach($roles AS $role)
                                    <option value="{{ $role->id }}">{{ $role->role }}</option>
                                    @endforeach
                                @endif
                                </select>
                                <label id="role_id-error" class="error" style="display: none;" for="role_id"></label>
                            </div>
                            <div class="form-group">
                                <label for="sede_id">Institutos</label>
                                <select id="sede_id" name="sede_id" class="form-control">
                                @if(isset($sedes))
                                    @foreach($sedes AS $sede)
                                    <option value="{{ $sede->id }}">{{ $sede->NombInstituto }}</option>
                                    @endforeach
                                @endif
                                </select>
                                <label id="sede_id-error" class="error" style="display: none;" for="sede_id"></label>
                            </div>
                            @endif
                            <div class="form-group">
                                <label for="password">Asignar contraseña</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input id="password" name="password" type="password" class="form-control" placeholder="Contraseña">
                                    <input id="show-password" type="text" class="form-control" value="" placeholder="Contraseña" readonly>
                                    <span id="toggle-password" class="input-group-addon" data-toggle="tooltip" data-container="body" data-title="Mostrar u Ocultar"><i class="fa fa-eye"></i></span>
                                    <span id="generate-password" class="input-group-addon" data-toggle="tooltip" data-container="body" data-title="Generar contraseña"><i class="fa fa-keyboard-o"></i></span>
                                </div>
                                <label id="password-error" class="error" style="display: none;" for="password"></label>
                            </div>
                            <div class="form-group">
                                <label>Status del usuario</label>
                                <div class="radio">
                                    <label for="active">
                                        <input id="active" class="square_radio" name="status" type="radio" value="0" checked>
                                        Activo
                                    </label>
                                </div>
                                <div class="radio">
                                    <label for="pending">
                                        <input id="pending" class="square_radio" name="status" type="radio" value="1">
                                        Pendiente
                                    </label>
                                </div>
                                <label id="status-error" class="error" style="display: none;" for="status"></label>
                            </div>
                            <div class="form-group">
                                <label>Género</label>
                                <div class="radio">
                                    <label for="woman">
                                        <input id="woman" class="square_radio" name="gender" type="radio" value="0" checked>
                                        Femenino
                                    </label>
                                </div>
                                <div class="radio">
                                    <label for="man">
                                        <input id="man" class="square_radio" name="gender" type="radio" value="1">
                                        Masculino
                                    </label>
                                </div>
                                <label id="gender-error" class="error" style="display: none;" for="gender"></label>
                            </div>
                        </div>
                    </div>
                </form>
            </div><!-- /.box-body -->
            <div class="box-footer">
                <div class="pull-right">
                    <button type="submit" form="form-add-user" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Guardar</button>
                </div>
            </div><!-- box-footer -->
        </div><!-- /.box -->
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ URL::asset('assets/js/admin/add_user.js') }}"></script>
@endsection