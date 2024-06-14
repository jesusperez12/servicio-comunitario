<!--
    MODAL ADD CLIENT - VEHICLE
-->
<div class="modal action-save-modal fade" id="edit-project-modal" tabindex="-1" role="dialog" aria-labelledby="edit-project-modal_Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="edit-project-modal_Label"><b><i class="fa fa-pencil"></i> EDITAR PROYECTO</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="form-edit-project" name="form-edit-project" action="{{ url('admin/profesor/project/edit') }}" method="POST" autocomplete="off">
                    <input type="hidden" name="pid" value="">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="especialidad">Especialidad</label>
                                <div class="col-sm-7">
                                    <select id="especialidad" name="especialidad" type="text" class="form-control" style="width:100%;">
                                    </select>
                                    <label id="especialidad-error" class="error" style="display: none;" for="especialidad"></label>
                                </div>
                            </div>
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
                    <!-- END FORM 1 -->
                    <div class="row">
                        <div class="col-xs-12">
                        <!-- FORM REFERENCIAS -->
                        <h3 style="font-size: 14px;font-weight: bold;padding-left: 9px;">REFERENCIAS BIBLIOGRÁFICAS</h3>
                       
                    </div>
                </form>
            </div>
            <div class="modal-footer" id="footer_modal_clients">
                <button type="submit" form="form-edit-project" class="btn btn-primary pull-right btn-send-form">Guardar cambios</button>    
            </div>
        </div>
    </div>
</div>
<!--
    END MODAL CLIENT - VEHICLE
-->