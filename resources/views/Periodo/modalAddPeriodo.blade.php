<!--
    MODAL ADD CLIENT - VEHICLE
-->
<div class="modal fade" id="modal-add-periodo" tabindex="-1" role="dialog" aria-labelledby="modal-add-periodo_Label" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal-add-periodo_Label"><b><i class="fa fa-clock-o"></i> NUEVO PERIODO</b></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <form id="form-add-periodo" name="form-add-periodo" autocomplete="off">
                            <div class="form-group">
                                <label for="corte">Corte</label>
                                <input type="text" class="form-control" id="corte" name="corte" placeholder="Corte. Ejemplo: 2017-1">
                            </div>
                            <div class="form-group">
                                <label for="inicio">Inicio</label>
                                <input type="text" class="form-control" id="inicio" name="inicio" placeholder="Fecha de inicio">
                            </div>
                            <div class="form-group">
                                <label for="fin">Fin</label>
                                <input type="text" class="form-control" id="fin" name="fin" placeholder="Fecha de fin">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" form="form-add-periodo" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!--
    END MODAL CLIENT - VEHICLE
-->