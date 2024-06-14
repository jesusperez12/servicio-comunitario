@extends('layouts.dashboard_administrador')

@section('title_pages')
<div class="pull-left header-pages-custom">
    <h1>
        Usuarios del sistema
    </h1>
</div>
@endsection

@section('content')
<div id="url-active" data-url-active="{{ $link_active }}"></div>
<div class="row">
    <div class="col-xs-10">
        <div class="box box-info">
            <div class="box-body">
               <table id="table-list-users" class="tc table table-bordered table-hover table-condensed">
                <thead>
                    <tr>
                        <th>Listado de usuarios</th>
                        <th></th>
                    </tr>
                </thead>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="editUser" role="dialog" aria-labelledby="editUserLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="editUserLabel">Editar Usuario</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-xs-12">
                <form id="form-edit-user" name="form-edit-user" autocomplete="off">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <input type="hidden" name="user_id" id="user_id" value="">
                    <div class="row">
                        <div class="col-xs-4">
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
                        <div class="col-xs-4">
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
                                <div class="element-phone" id="element-phone">
                                    <div class="input-group">
                                        <input type="hidden" name="phones_id[]">
                                        <select id="codes" name="codes[]" type="text" class="form-control code">
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
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="speciality">Especialidad</label>
                                <select id="speciality" name="speciality" class="form-control speciality-select" style="width:100%;">
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
                                <select id="role_id" name="role_id" class="form-control simple-select" style="width:100%;">
                                @if(isset($roles))
                                    @foreach($roles AS $role)
                                    <option value="{{ $role->id }}">{{ $role->role }}</option>
                                    @endforeach
                                @endif
                                </select>
                                <label id="role_id-error" class="error" style="display: none;" for="role_id"></label>
                            </div>
                            
                           <div class="form-group">
                                <label for="sede_id">Sede</label>
                                <select id="sede_id" name="sede_id" class="form-control" style="width:100%;">
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
                                        <input id="active" class="square_radio" name="status" type="radio" value="0">
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
                                        <input id="woman" class="square_radio" name="gender" type="radio" value="0">
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
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" form="form-edit-user" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Guardar cambios</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script src="{{ URL::asset('assets/js/admin/users_list.js') }}"></script>
<script src="{{ URL::asset('assets/js/admin/edit_user.js') }}"></script>
@endsection