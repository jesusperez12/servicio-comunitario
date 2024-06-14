var Periodos = (function(){

    var el = {
        tableListPeriodos: '#table-list-periodos',
        btnPeriodoAction: '#btn-action-periodo',
        btnEditPeriodo: '.btn-edit-periodo',
        btnDeletePeriodo: '.btn-delete-periodo',
    };

    var dom = {
        tableListPeriodos: $(el.tableListPeriodos),
        listTablePeriodos: null
    };

    var events = {
        newPeriodo: function (evt) {
            FormNewPeriodo.dom.modalAddPeriodo.trigger('showModal');
        },
        editPeriodo: function (evt) {
            evt.preventDefault();
            var id = this.dataset.periodoId;
            Pace.track(function () {
                $.ajax({
                    url: `/admin/coordinador/periodo/edit/${id}`,
                    type: 'GET',
                    dataType: 'JSON',
                })
                .done(function(rs) {
                    if (rs.response == 'ok') {
                        FormEditPeriodo.dom.formEditPeriodo.trigger('editPeriodo', rs.data);
                    }
                })
                .fail(function(jqXHR) {
                    var errors = [];
                    if (jqXHR.responseJSON) {
                        $.each(jqXHR.responseJSON, function (x, error) {
                            $.each(error, function (x, o) {
                                errors.push(o);
                            })
                        })

                        if (errors.length > 0) {
                            var html, title;
                            if (errors.length > 1) {
                                title = 'Han ocurrido los siguientes errores';
                                html = '<ul>';
                                $.each(errors, function (x, e) {
                                    html += '<li style="list-style:square;text-align:left;margin-bottom:8px;color:red;">'
                                        + e;
                                    + '</li>';
                                })
                                html += '</ul>';
                            } else {
                                title = '¡Acción denegada!';
                                html = errors[0];
                            }

                            swal({
                                title: title,
                                text: html,
                                html: true
                            })
                        }
                    }
                })
            })
        },
        deletePeriodo: function (evt) {
            evt.preventDefault();
            var periodo_id = this.dataset.periodoId;
            swal({
                title: "Estas seguro?",
                text: "Esta acción no se podrá deshacer.<br><br>",
                html: true,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Si, eliminar!",
                closeOnConfirm: false
            },
            function () {
                Pace.track(function () {
                    // Ajax request
                    $.ajax({
                        url: '/admin/coordinador/periodo/delete/' + periodo_id,
                        type: 'GET',
                        dataType: 'JSON',
                        beforeSend: function () {
                            swal.disableButtons();
                        }
                    })
                    .done(function (rs) {
                        if (rs.response == "ok") {
                            swal("Eliminado!", "Se ha eliminado con éxito.", "success");
                            refresh();
                        }
                    })
                    .fail(function (jqXHR) {
                        var errors = [];
                        if (jqXHR.responseJSON) {
                            $.each(jqXHR.responseJSON, function (x, error) {
                                $.each(error, function (x, o) {
                                    errors.push(o);
                                })
                            })

                            if (errors.length > 0) {
                                var html, title;
                                if (errors.length > 1) {
                                    title = 'Han ocurrido los siguientes errores';
                                    html = '<ul>';
                                    $.each(errors, function (x, e) {
                                        html += '<li style="list-style:square;text-align:left;margin-bottom:8px;color:red;">'
                                            + e;
                                        + '</li>';
                                    })
                                    html += '</ul>';
                                } else {
                                    title = '¡Acción denegada!';
                                    html = errors[0];
                                }

                                swal({
                                    title: title,
                                    text: html,
                                    html: true
                                })
                            }
                        }
                    })
                })
                // /.PACE
            })
            // /.FUNCTION
        }
    };

    var subscribeEvents = function () {}
    
    var initTableListPeriodos = function () {
        dom.listTablePeriodos = dom.tableListPeriodos.DataTable({
            dom: `<'row'<'col-xs-6'<'#btn-action-periodo'>><'col-xs-6 t-periodo-filter'f>>
                  <'row'<'col-xs-12'tr>>
                  <'row'<'col-xs-5'i><'col-xs-7'p>>`,
            ajax: '/admin/coordinador/periodos/all',
            deferRender: true,
            drawCallback: function (settings) {
                var api = this.api();
                $.each(api.rows().nodes(), function (x, tr) {
                    $(tr).find('[data-toggle=tooltip]').tooltip();
                    $(tr).find('[data-toggle=popover]').popover({ html: true });
                    $(tr).attr('data-periodo-data', JSON.stringify(api.row(tr).data()));
                    // FUNCTION EDIT PERIODO
                    $(tr).find(el.btnEditPeriodo).off('click').on('click', events.editPeriodo);
                    // FUNCTION DELETE PERIODO
                    $(tr).find(el.btnDeletePeriodo).off('click').on('click', events.deletePeriodo);
                })
            },
            initComplete: function (settings, json) {
                // FILTRO
                $(".t-periodo-filter").find('[type=search]').removeClass("input-sm")
                .css({
                    "width": "100%",
                    "margin-left": 0
                })
                .parents("label").css({
                    "width": "100%"
                });
                $(el.btnPeriodoAction).html(`<button class="btn btn-primary" id="btn-new-periodo"><i class="fa fa-clock-o"></i> Nuevo periodo</button>`);
                $(FormNewPeriodo.el.btnNewPeriodo).on('click', events.newPeriodo);
            },
            ordering: false,
            paging: true,
            pagingType: "simple_numbers",
            pageLength: 10,
            lengthChange: false,
            searching: true,
            info: true,
            displayStart: 0,
            autoWidth: false,
            language: {
                processing: "Buscando",
                loadingRecords: "Cargando...",
                emptyTable: "No hay registros",
                info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                infoEmpty: "Mostrando 0 a 0 de 0 registros",
                zeroRecords: "No hay registros",
                search: "",
                searchPlaceholder: "Buscar...",
                infoFiltered: " - filtrado para _MAX_ registros",
                paginate: {
                    first: "Primero",
                    last: "Último",
                    next: "Siguiente",
                    previous: "Anterior"
                }
            },
            columns: [
                {
                    className: "strong top",
                    data: "corte",
                },
                {
                    className: "strong red top xS",
                    data: null,
                    render: function (data, type, row) {
                        return row.inicio;
                    }
                },
                {
                    className: "top xS",
                    data: null,
                    render: function (data, type, row) {
                        return row.fin;
                    }
                },
                {
                    className: 'text-center',
                    data: null,
                    render: function (data, type, row) {
                        if (parseInt(row.active) == 0) {
                            return `<span class="fa fa-circle" style="color: #CCC; " data-toggle="tooltip" data-placement="top" data-container="body" data-original-title="Inactivo"></span>`;
                        } else {
                            return `<span class="fa fa-circle" style="color: #F99640; " data-toggle="tooltip" data-placement="top" data-container="body" data-original-title="Activo"></span>`;
                        }
                    }
                },
                {
                    data: null,
                    className: 'text-center',
                    searchable: false,
                    render: function (data, type, row) {
                        return `
                            <a href="#" class="btn btn-warning btn-xs btn-action btn-edit-periodo" data-periodo-id="${row.id}" data-periodo-status="${row.active}" data-toggle="tooltip" data-container="body" data-placement="top" data-title="Editar"><i class="fa fa-pencil fa-fw"></i></a>
                            <a href="#" class="btn btn-danger btn-xs btn-action btn-delete-periodo" data-periodo-id="${row.id}" data-toggle="tooltip" data-container="body" data-placement="top" data-title="Eliminar"><i class="fa fa-trash fa-fw"></i></a>
                        `;
                    }
                },
            ]
        })
    }

    var refresh = function (evt) {
        dom.listTablePeriodos.ajax.reload();
    }

    var initFormFun = function () {}

    var initializer = function () {
        initTableListPeriodos();
    }

    return {
        initializer: initializer,
        refresh: refresh
    }
})()
$(document).ready(function () {
    Periodos.initializer();
});
var FormNewPeriodo = (function(){

    var el = {
        modalAddPeriodo: '#modal-add-periodo',
        btnNewPeriodo: '#btn-new-periodo',
        formAddPeriodo: '#form-add-periodo',
        inputCorte: '#corte',
        inputInicio: '#inicio',
        inputFin: '#fin',
    };

    var dom = {
        modalAddPeriodo: $(el.modalAddPeriodo),
        formAddPeriodo: $(el.formAddPeriodo),
        inputCorte: $(el.inputCorte),
        inputInicio: $(el.inputInicio),
        inputFin: $(el.inputFin),
    };

    var validators = {
        formAddPeriodo: function () {
            return dom.formAddPeriodo.validate();
        }
    };

    var events = {
        showModal: function (evt) {
            dom.modalAddPeriodo.modal({
                show: true,
                backdrop: 'static',
                keyboard: false
            })
        },
        hideModal: function (evt) {
            dom.formAddPeriodo.trigger('reset');
            Periodos.refresh();
        }
    };

    var subscribeEvents = function () {
        dom.modalAddPeriodo.on('showModal', events.showModal);
        dom.modalAddPeriodo.on('hide.bs.modal', events.hideModal);
    }

    var validate = {
        callback: function (form) {
            Pace.track(function () {
                var data = $(form).serialize();
                $.ajax({
                    url: '/admin/coordinador/periodo',
                    data: data,
                    type: 'POST',
                    dataType: 'JSON',
                })
                .done(function(rs) {
                    if (rs.response == 'ok') {
                        noty({
                            text: "Se ha guardado correctamente...",
                            type: 'success',
                            theme: "relax",
                            timeout: 1500, // [integer|boolean] delay for closing event in milliseconds. Set false for sticky notifications
                            progressBar: true, // [boolean] - displays a progress bar
                            template: '<div class="noty_message"><span class="fa fa-check"></span> <span class="noty_text"></span><div class="noty_close"></div></div>',
                            animation: {
                                open: 'animated bounceInDown', // Animate.css class names
                                close: 'animated bounceOutUp', // Animate.css class names
                                easing: 'swing', // unavailable - no need
                                speed: 500 // unavailable - no need
                            }
                        })
                        // CLOSE
                        dom.modalAddPeriodo.modal('hide');
                    }
                })
                .fail(function(jqXHR) {
                    var errors = [];
                    if (jqXHR.responseJSON) {
                        $.each(jqXHR.responseJSON, function (x, error) {
                            $.each(error, function (x, o) {
                                errors.push(o);
                            })
                        })

                        if (errors.length > 0) {
                            var html, title;
                            if (errors.length > 1) {
                                title = 'Han ocurrido los siguientes errores';
                                html = '<ul>';
                                $.each(errors, function (x, e) {
                                    html += '<li style="list-style:square;text-align:left;margin-bottom:8px;color:red;">'
                                        + e;
                                    + '</li>';
                                })
                                html += '</ul>';
                            } else {
                                title = '¡Acción denegada!';
                                html = errors[0];
                            }

                            swal({
                                title: title,
                                text: html,
                                html: true
                            })
                        }
                    }
                })
            })
        },
        rules: {
            corte: {
                required: true
            },
            inicio: {
                required: true,
                validDate: true
            },
            fin: {
                required: true,
                validDate: true
            }
        }
    }

    var initFormFun = function () {
        dom.inputCorte.inputmask('9999-9');
        dom.inputInicio.datepicker({
            language: 'es',
            format: 'dd/mm/yyyy',
            autoclose: true
        });
        dom.inputInicio.on('hide.bs.modal', function (e) {
            e.stopPropagation();
        })
        dom.inputFin.datepicker({
            language: 'es',
            format: 'dd/mm/yyyy',
            autoclose: true
        });
        dom.inputFin.on('hide.bs.modal', function (e) {
            e.stopPropagation();
        })
    }

    var initializer = function () {
        subscribeEvents();
        initFormFun();
        Utils.initValidateForm(dom.formAddPeriodo[0], validate.callback, validate.rules);
    }

    return {
        initializer: initializer,
        el: el,
        dom: dom,
        events: events
    }
})()
$(document).ready(function () {
    FormNewPeriodo.initializer();
});
var FormEditPeriodo = (function(){

    var el = {
        modalEditPeriodo: '#modal-edit-periodo',
        formEditPeriodo: '#form-edit-periodo',
        inputPeriodoId: '#periodo_id',
        inputCorte: '#edit-corte',
        inputInicio: '#edit-inicio',
        inputFin: '#edit-fin',
    };

    var dom = {
        modalEditPeriodo: $(el.modalEditPeriodo),
        formEditPeriodo: $(el.formEditPeriodo),
        inputPeriodoId: $(el.inputPeriodoId),
        inputCorte: $(el.inputCorte),
        inputInicio: $(el.inputInicio),
        inputFin: $(el.inputFin),
    };

    var validators = {
        formEditPeriodo: function () {
            return dom.formEditPeriodo.validate();
        }
    };

    var events = {
        showModal: function (evt) {
            dom.modalEditPeriodo.modal({
                show: true,
                backdrop: 'static',
                keyboard: false
            })
        },
        hideModal: function (evt) {
            dom.formEditPeriodo.trigger('reset');
        },
        editPeriodo: function (evt, data) {
            if (Object.keys(data).length > 0) {
                dom.inputPeriodoId.val(data.id);
                dom.inputCorte.val(data.corte);
                dom.inputInicio.datepicker('update',data.inicio).change();
                dom.inputFin.datepicker('update',data.fin).change();

                // SHOW
                dom.modalEditPeriodo.trigger('showModal');
            }
        }
    };

    var subscribeEvents = function () {
        dom.modalEditPeriodo.on('showModal', events.showModal);
        dom.modalEditPeriodo.on('hide.bs.modal', events.hideModal);
        dom.formEditPeriodo.on('editPeriodo', events.editPeriodo);
    }

    var validate = {
        callback: function (form) {
            Pace.track(function () {
                var data = $(form).serialize();
                $.ajax({
                    url: `/admin/coordinador/periodo/edit/${form.periodo_id.value}`,
                    data: data,
                    type: 'POST',
                    dataType: 'JSON',
                })
                .done(function(rs) {
                    if (rs.response == 'ok') {
                        noty({
                            text: "Se ha actualizado correctamente...",
                            type: 'success',
                            theme: "relax",
                            timeout: 1500, // [integer|boolean] delay for closing event in milliseconds. Set false for sticky notifications
                            progressBar: true, // [boolean] - displays a progress bar
                            template: '<div class="noty_message"><span class="fa fa-check"></span> <span class="noty_text"></span><div class="noty_close"></div></div>',
                            animation: {
                                open: 'animated bounceInDown', // Animate.css class names
                                close: 'animated bounceOutUp', // Animate.css class names
                                easing: 'swing', // unavailable - no need
                                speed: 500 // unavailable - no need
                            }
                        })
                        // CLOSE
                        dom.modalEditPeriodo.modal('hide');
                        // REFRESH
                        Periodos.refresh();
                    }
                })
                .fail(function(jqXHR) {
                    var errors = [];
                    if (jqXHR.responseJSON) {
                        $.each(jqXHR.responseJSON, function (x, error) {
                            $.each(error, function (x, o) {
                                errors.push(o);
                            })
                        })

                        if (errors.length > 0) {
                            var html, title;
                            if (errors.length > 1) {
                                title = 'Han ocurrido los siguientes errores';
                                html = '<ul>';
                                $.each(errors, function (x, e) {
                                    html += '<li style="list-style:square;text-align:left;margin-bottom:8px;color:red;">'
                                        + e;
                                    + '</li>';
                                })
                                html += '</ul>';
                            } else {
                                title = '¡Acción denegada!';
                                html = errors[0];
                            }

                            swal({
                                title: title,
                                text: html,
                                html: true
                            })
                        }
                    }
                })
            })
        },
        rules: {
            corte: {
                required: true
            },
            inicio: {
                required: true,
                validDate: true
            },
            fin: {
                required: true,
                validDate: true
            }
        }
    }

    var initFormFun = function () {
        dom.inputCorte.mask('9999-9');
        dom.inputInicio.datepicker({
            language: 'es',
            format: 'dd/mm/yyyy',
            autoclose: true
        });
        dom.inputInicio.on('hide.bs.modal', function (e) {
            e.stopPropagation();
        })
        dom.inputFin.datepicker({
            language: 'es',
            format: 'dd/mm/yyyy',
            autoclose: true
        });
        dom.inputFin.on('hide.bs.modal', function (e) {
            e.stopPropagation();
        })
    }

    var initializer = function () {
        subscribeEvents();
        initFormFun();
        Utils.initValidateForm(dom.formEditPeriodo[0], validate.callback, validate.rules);
    }

    return {
        initializer: initializer,
        el: el,
        dom: dom,
        events: events
    }
})()
$(document).ready(function () {
    FormEditPeriodo.initializer();
});
//# sourceMappingURL=periodos.js.map
