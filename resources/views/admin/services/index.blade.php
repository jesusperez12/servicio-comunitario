@extends('layouts.dashboard_administrador')

@section('title_pages')
<div class="pull-left header-pages-custom">
    <h1>
        Proyectos en ejecución
    </h1>
</div>
@endsection

@section('content')
<div id="url-active" style="display:none;" data-url-active="{{ $link_active }}"></div>
<!--<div class="row">
    <div class="col-xs-6">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-group"></i></span>
            <div class="info-box-content">
            <span class="info-box-text">Total de Comunidades Atendidas</span>
            <span class="info-box-number">41,410</span>
            </div>
        </div>
    </div>
    <div class="col-xs-6">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-group"></i></span>
            <div class="info-box-content">
            <span class="info-box-text">Total de Beneficiados</span>
            <span class="info-box-number">41,410</span>
            </div>
        </div>
    </div>
</div>-->
<div class="row">
    <div class="col-xs-9">
        <div class="box box-info">
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div id="ls-periodos-user" style="display:none;" data-ls-periodos-user="{{ $periodos }}"></div>
                        <table id="table-my-list-projects" class="tc table table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th>Título del proyecto</th>
                                <th></th>
                            </tr>
                        </thead>
                        </table>
                    </div>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>

<!-- Modal Cargar lista de prestadores de servicio-->
<div class="modal fade" id="addListProviders" role="dialog" aria-labelledby="addListProvidersLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="addListProvidersLabel">Cargar lista de prestadores de servicio</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-xs-12">
                <form id="form-add-list-providers" name="form-add-list-providers" autocomplete="off">
                    {{ csrf_field() }}
                    <input type="hidden" name="pup_id" id="pup_id" value="">
                    <div class="row msg-no-providers">
                        <div class="col-xs-12">
                            <dl>
                                <dt>Proyecto:</dt>
                                <dd id="nombre-proyecto"></dd>
                            </dl>
                            <!--<div class="alert alert-info text-center">
                                <strong>Título del proyecto: </strong><span id="nombre-proyecto"></span>
                            </div>-->
                        </div>
                    </div>
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs" id="group-tabs">
                            <li class="active" id="btn-tab-zero"><a href="#tab_0" data-toggle="tab" aria-expanded="true">Nuevos prestadores</a></li>
                        </ul>
                        <div class="tab-content" id="group-tabs-content"> <!-- /.tab-content -->

                            <div class="tab-pane active" id="tab_0"> <!-- /.tab-pane -->
                                <div class="row" style="margin-top:18px;">
                                    <div class="col-xs-5">
                                        <h4 style="margin-top:25px;font-size:16px;">Registrar prestador(es) de servicio</h4>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="form-group">
                                            <label for="grupo" style="font-size:12px;">Grupo o sección</label>
                                            <input type="text" id="grupo" name="grupo" class="form-control numeric-input" placeholder="Grupo o sección">
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="form-group">
                                            <label for="especialidad" style="font-size:12px;">Especialidad</label>
                                            <select type="text" id="especialidad" name="especialidad" class="form-control numeric-input" placeholder="Especialidad" style="width:100%;">
                                            @foreach($especialidades as $especialidad) 
                                                <option value="{{ $especialidad->cod }}">{{ $especialidad->nombre }}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <table id="list-new-providers" class="table table-condensed" style="font-size: 12px;">
                                            <thead>
                                                <th style="width:128px;padding-right:5px;">Nº de cédula</th>
                                                <th style="width:135px;padding-right:5px;">Primer nombre</th>
                                                <th style="width:135px;padding-right:5px;">Segundo nombre</th>
                                                <th style="width:135px;padding-right:5px;">Primer apellido</th>
                                                <th style="width:135px;padding-right:5px;">Segundo apellido</th>
                                                <th style="width:27px;"></th>
                                            </thead>
                                            <tbody>
                                                <tr class="info row-origin">
                                                    <td>
                                                        <div class="form-group" style="margin-bottom:0px;">
                                                            <input id="ci" name="ci[]" type="text" class="input-sm form-control numeric-input ci" maxlength="8" minlength="7"placeholder="Cédula...">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group" style="margin-bottom:0px;">
                                                            <input id="firstname" name="firstname[]" type="text" class="input-sm form-control firstname" placeholder="Primer nombre">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group" style="margin-bottom:0px;">
                                                            <input id="middlename" name="middlename[]" type="text" class="input-sm form-control" placeholder="Segundo nombre">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group" style="margin-bottom:0px;">
                                                            <input id="primary_lastname" name="primary_lastname[]" type="text" class="input-sm form-control primary_lastname" placeholder="Primer apellido">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group" style="margin-bottom:0px;">
                                                            <input id="second_lastname" name="second_lastname[]" type="text" class="input-sm form-control" placeholder="Segundo apellido">
                                                        </div>
                                                    </td>
                                                    <td style="vertical-align:top;padding-top:8px;text-align:center;" class="btn-actions">
                                                        
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <button id="btn-add-new-providers" class="btn btn-xs btn-success pull-right"><i class="fa fa-plus"></i> Añadir</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                </form>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" form="form-add-list-providers" class="btn btn-primary" id="btn-save-new-provider"><i class="fa fa-floppy-o"></i> Guardar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal edit prestador -->
<div class="modal fade" id="editListProviders" role="dialog" aria-labelledby="editListProvidersLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="editListProvidersLabel">Actualizar prestador</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-xs-12">
                <form id="form-edit-list-providers" name="form-edit-list-providers" autocomplete="off">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <input type="hidden" name="provider_id" value="">
                    <div class="form-group">
                        <label for="ci">Nº de identidad</label>
                        <input type="text" name="ci" class="form-control numeric-input" placeholder="Cédula de identidad">
                    </div>
                    <div class="form-group">
                        <label for="firstname">Primer nombre</label>
                        <input type="text" name="firstname" class="form-control" placeholder="Primer nombre">
                    </div>
                    <div class="form-group">
                        <label for="middlename">Segundo nombre</label>
                        <input type="text" name="middlename" class="form-control" placeholder="Segundo nombre">
                    </div>
                    <div class="form-group">
                        <label for="primary_lastname">Primer apellido</label>
                        <input type="text" name="primary_lastname" class="form-control" placeholder="Primer apellido">
                    </div>
                    <div class="form-group">
                        <label for="second_lastname">Segundo apellido</label>
                        <input type="text" name="second_lastname" class="form-control" placeholder="Segundo apellido">
                    </div>
                </form>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" form="form-edit-list-providers" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Guardar</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script src="{{ URL::asset('assets/js/admin/my_projects_list.js') }}"></script>
@endsection