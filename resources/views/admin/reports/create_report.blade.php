@extends('layouts.dashboard_administrador')

@section('title_pages')
<div class="pull-left header-pages-custom">
    <h1>
        Nuevo reporte de actividad
    </h1>
</div>
@endsection

@section('content')

<div class="row">
    <div class="col-xs-12">
        @if(Session::has('message')) 
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {!! session('message') !!}
        </div>
        @endif
        <div class="box box-info">
            <div class="box-header with-border">
                <h4 class="box-title">Nuevo reporte</h4>
            </div>
            <div class="box-body">
                @include('common.errors')
                <form class="form-horizontal" id="form-new-report" name="form-new-report" action="{{ url('/admin/service/reporte/nuevo') }}" method="POST" autocomplete="off">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-xs-2 col-sm-1 col-lg-1">
                        </div>
                        <div class="col-xs-8 col-sm-9 col-lg-8">
                            <div class="form-group">
                                <label for="proyecto" class="col-sm-3 control-label">Proyecto</label>
                                <div class="col-sm-7 col-md-9">
                                    <select id="proyecto" name="proyecto" type="text" value="{{old('proyecto')}}" class="form-control" style="width:100%;">
                                    @foreach($proyectos as $proyecto)
                                        <option data-pup-id="{{ $proyecto->pivot->id }}" data-periodo-id="{{ $proyecto->pivot->periodo_id }}" value="{{ $proyecto->id }}">{{ $proyecto->nombre_proyecto }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="fecha" class="col-sm-3 control-label">Fecha</label>
                                <div class="col-sm-7 col-md-9">
                                    <input id="fecha" name="fecha" type="text" value="{{old('fecha')}}" class="form-control" placeholder="Ejemplo: 22/01/2014">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="direccion" class="col-sm-3 control-label">Dirección</label>
                                <div class="col-sm-7 col-md-9">
                                    <input id="direccion" name="direccion" type="text" value="{{old('direccion')}}" class="form-control"  placeholder="Dirección del lugar donde se realizó la actividad">
                                </div>
                            </div>
                            <div class="form-group class-checker">
                                <label for="actividad" class="col-sm-3 control-label">Actividad</label>
                                <div class="col-sm-7 col-md-9">
                                    <input id="actividad" name="actividad" type="text" class="form-control" value="{{old('actividad')}}"  placeholder="Nombre de la actividad">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="detalle" class="col-sm-3 control-label">Detalle</label>
                                <div class="col-sm-7 col-md-9">
                                    <textarea id="detalle" name="detalle" type="text" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="duracion" class="col-sm-3 control-label">Duración (Hrs)</label>
                                <div class="col-sm-7 col-md-9">
                                    <input id="duracion" name="duracion" type="text" value="{{old('duracion')}}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="form-group class-checker">
                                <label for="impacto" class="col-sm-3 control-label">Impacto generado</label>
                                <div class="col-sm-7 col-md-9">
                                    <textarea id="impacto" name="impacto" type="impacto" class="form-control" placeholder="Impacto que generó la actividad"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="recursos">Recursos</label>
                                <div class="col-sm-7 col-md-9 box-recurso-element">
                                    <div class="recurso-element">
                                        <div class="input-group">
                                            <input id="recurso" name="recursos[]" type="text" class="form-control recursos" placeholder="Escriba una recurso">
                                            <span class="input-group-addon">#</span>
                                            <select id="tipo_recurso" name="tipo_recurso[]" type="text" class="form-control">
                                                <option value="0">Humano</option>
                                                <option value="1">Pedagógico</option>
                                                <option value="2">Financiero</option>
                                            </select>
                                        </div>
                                        <label id="recurso-error" class="error" style="display:none;" for="recurso"></label>
                                    </div>
                                </div>
                            </div>
                            <button id="btn_arc" type="button" class="btn btn-xs btn-success pull-right"><i class="fa fa-plus"></i> Recurso</button>
                            <br>
                            <br>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="beneficiarios">Beneficirios</label>
                                <div class="col-sm-7 col-md-9 box-beneficiario-element">
                                    <div class="beneficiario-element">
                                        <div class="input-group">
                                            <input id="beneficiario" name="beneficiarios[]" type="text" class="form-control beneficiarios numeric_input" placeholder="Escriba una beneficiario">
                                            <span class="input-group-addon">#</span>
                                            <select id="tipo_beneficiario" name="tipo_beneficiario[]" type="text" class="form-control">
                                                <option value="0">Mujer(es)</option>
                                                <option value="1">Hombre(s)</option>
                                                <option value="2">niña(s) o niño(s)</option>
                                            </select>
                                        </div>
                                        <label id="beneficiario-error" class="error" style="display:none;" for="beneficiario"></label>
                                    </div>
                                </div>
                            </div>
                            <button id="btn_abc" type="button" class="btn btn-xs btn-success pull-right"><i class="fa fa-plus"></i> Beneficiario</button>
                            <br>
                            <br>
                            <hr>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary btn-send-form">Guardar</button>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <br>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-lg-1">
                        </div>
                    </div>
                </form>
            </div><!-- /.box-body -->
           
        </div><!-- /.box -->
    </div>
</div>

<!-- Modal asignar actividad a prestadores de servicio-->
<div class="modal fade" id="assignProvidersToActivity" role="dialog" aria-labelledby="assignProvidersToActivityLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
        <h4 class="modal-title" id="assignProvidersToActivityLabel">Asignar prestador(es) de servicio a la actividad</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-xs-12">
                <form id="form-assign-providers" name="form-assign-providers" autocomplete="off">
                    {{ csrf_field() }}
                    <input type="hidden" name="pup_id" id="pup_id" value="">
                    <input type="hidden" name="hrs_comunitarias" id="hrs_comunitarias" value="">
                    <div id="data-list-group"></div>
                    <div class="row msg-no-providers">
                        <div class="col-xs-12">
                            <dl class="dl-horizontal">
                                <dt>Proyecto:</dt>
                                <dd id="nombre-proyecto"></dd>
                                <dt>Nombre de la actividad:</dt>
                                <dd id="nombre-actividad"></dd>
                                <dt>Duración:</dt>
                                <dd id="duracion-actividad"></dd>
                            </dl>
                        </div>
                    </div>
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs" id="group-tabs">
                        
                        </ul>
                        <div class="tab-content" id="group-tabs-content"> <!-- /.tab-content -->

                        </div>
                        <!-- /.tab-content -->
                    </div>
                </form>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" form="form-assign-providers" class="btn btn-primary" id="btn-save-assing-provider"><i class="fa fa-floppy-o"></i> Guardar</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script src="{{ URL::asset('assets/js/ckeditor.js') }}"></script>
<script src="{{ URL::asset('assets/js/admin/report.js') }}"></script>
@endsection