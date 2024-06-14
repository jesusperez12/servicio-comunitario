@extends('layouts.dashboard_administrador')

@section('title_pages')
<div class="pull-left header-pages-custom">
    <h1>
        Nuevo proyecto
    </h1>
</div>
@endsection

@section('content')
<div style="display:none;" id="url-active" data-url-active="{{ $link_active }}"></div>
<div class="row">
    <div class="col-xs-12">
        <form class="form-horizontal" id="form-add-project" name="form-add-project" action="{{ url('admin/profesor/project/add') }}" method="POST" autocomplete="off">
            {{ csrf_field() }}
            <!-- FORM PROYECTO -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Crear proyecto</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="especialidad">Especialidad</label>
                                <div class="col-sm-7">
                                    <select id="especialidad" name="especialidad" type="text" class="form-control">
                                        @if(isset($especialidades))
                                        @foreach($especialidades as $especialidad)
                                        <option value="{{ $especialidad->cod }}">{{ $especialidad->nombre }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <label id="especialidad-error" class="error" style="display: none;" for="especialidad"></label>
                                </div>
                            </div>
                            <!--<div class="form-group">
                                <label class="col-sm-3 control-label" for="autor">Autor</label>
                                <div class="col-sm-7">
                                    <input id="autor" name="autor" type="text" class="form-control" placeholder="Autor del proyecto">
                                    <label id="autor-error" class="error" style="display: none;" for="autor"></label>
                                </div>
                            </div>-->
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="nombre_proyecto">Nombre del proyecto</label>
                                <div class="col-sm-7">
                                    <input id="nombre_proyecto" name="nombre_proyecto" type="text" class="form-control" placeholder="Título del proyecto">
                                    <label id="nombre_proyecto-error" class="error" style="display: none;" for="nombre_proyecto"></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="descripcion">Descripción del proyecto</label>
                                <div class="col-sm-7">
                                    <textarea class="form-control" name="descripcion" id="descripcion" rows="4" placeholder="Descripción del proyecto"></textarea>
                                    <label id="descripcion-error" class="error" style="display: none;" for="descripcion"></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="linea_accion">Línea de acción</label>
                                <div class="col-sm-7">
                                    <textarea class="form-control" name="linea_accion" id="linea_accion" rows="4" placeholder="Línea de acción del proyecto"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="fundamentacion">Fundamentación</label>
                                <div class="col-sm-7">
                                    <textarea class="form-control" name="fundamentacion" id="fundamentacion" rows="4" placeholder="Fundamentación del proyecto"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="proposito">Propósito</label>
                                <div class="col-sm-7">
                                    <textarea class="form-control" name="proposito" id="proposito" rows="4" placeholder="Propósito"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="competencia">Competencia</label>
                                <div class="col-sm-7">
                                    <textarea class="form-control" name="competencia" id="competencia" rows="4" placeholder="Competencia"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="metodologia">Metodología</label>
                                <div class="col-sm-7">
                                    <textarea class="form-control" name="metodologia" id="metodologia" rows="4" placeholder="Metodologia"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

            <!-- FORM REFERENCIAS -->
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Referencias</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="referencia">Referencia bibliográfica</label>
                                <div class="col-sm-7 box-referencia-element">
                                    <div class="referencia-element">
                                        <input id="referencia" name="referencias[]" type="text" class="form-control referencias" placeholder="Escriba una referencia">
                                        <label id="referencia-error" class="error" style="display:none;" for="referencia"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <button id="btn_arf" type="button" class="btn btn-xs btn-success pull-right"><i class="fa fa-plus"></i> Añadir referencia</button>
                </div><!-- /.box-footer -->
            </div><!-- /.box -->

            <!-- BUTTON SUBMIT FORM -->
            <button type="submit" class="btn btn-primary pull-right btn-send-form"><i class="fa fa-floppy-o"></i> Guardar</button>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ URL::asset('assets/js/ckeditor.js') }}"></script>
<script src="{{ URL::asset('assets/js/admin/projects.js') }}"></script>
@endsection