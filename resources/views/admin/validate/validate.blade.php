@extends('layouts.dashboard_administrador')

@section('title_pages')
<div class="pull-left header-pages-custom">
    <h1>
        Validación de certificados
    </h1>
</div>
@endsection

@section('content')
<div id="url-active" style="display:none;" data-url-active="{{ $link_active }}"></div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-3"></div>
    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
        <div class="box box-default" id="validate-form">
            <div class="box-header with-border text-center">
                <h4><b>Validar Certificado</b></h4>
            </div>
            <div class="box-body">
                <form id="form-validate-certificate" name="form-validate-certificate" autocomplete="off">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="ci">Nº de identidad</label>
                                <div class="input-group">
                                    <span class="input-group-addon">V-</span>
                                    <input id="ci" name="ci" type="text" class="form-control numeric-input uppercase-style" placeholder="Nº de identidad" maxlength="8">
                                </div>
                                <label id="ci-error" class="error" style="display: none;" for="ci"></label>
                            </div>
                            <div class="form-group">
                                <label for="certificate_code">Nº de registro</label>
                                <input id="certificate_code" name="certificate_code" type="text" class="form-control uppercase-style" placeholder="Nº de registro">
                            </div>
                        </div>
                    </div>
                </form>
            </div><!-- /.box-body -->
            <div class="box-footer">
                <div class="pull-right">
                    <button type="submit" form="form-validate-certificate" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Validar</button>
                </div>
            </div><!-- box-footer -->
        </div><!-- /.box -->
        <div class="spinner" id="preload-validate-result"></div>
        <div class="box box-solid" id="validate-result">
            <div class="box-header with-border">
                <h4><b>Resultado</b></h4>
            </div>
            <div class="box-body">
                <dl class="dl-horizontal">
                    <dt>Nº de registro:</dt>
                    <dd><span id="preview-num-register"></span></dd>
                    <dt>Prestador de Servicio:</dt>
                    <dd><span id="preview-name-prestador"></span></dd>
                    <dt>Grupo de Servicio:</dt>
                    <dd><span id="preview-group"></span></dd>
                    <dt>Periodo de Servicio:</dt>
                    <dd><span id="preview-periodo"></span></dd>
                    <dt>Nombre del proyecto:</dt>
                    <dd><span id="preview-name-project"></span></dd>
                    <dt>Fechas de Inicio y Fin:</dt>
                    <dd><span id="preview-dates"></span></dd>
                </dl>
            </div>
            <div class="box-footer">
                <div class="pull-right">
                    <button type="button" class="btn bg-navy" id="btn-back-validate-form"><i class="fa fa-undo"></i> Volver</button>
                </div>
            </div><!-- box-footer -->
        </div><!-- /.box -->
    </div>
    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-3"></div>
</div>
@endsection

@section('scripts')
<script src="{{ URL::asset('assets/js/admin/validateCertificate.js') }}"></script>
@endsection