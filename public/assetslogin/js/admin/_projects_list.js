$(document).ready(function() {
    var table_list_projects = null;
    Pace.track(function() {
        table_list_projects = $("#table-list-projects").DataTable({
            ajax: '/admin/profesor/project/all',
            dom: '<"row"<"col-sm-6 project-list-items"f>>tp',
            drawCallback: function(settings) {
                var api = this.api();
                $.each(api.rows().nodes(), function(x, tr){
                    $(tr).find('[data-toggle=tooltip]').tooltip();
                    // FUNCTION LOAD PROYECTO
                    $(tr).find('.btn-load-proyecto').off('click').on('click', function(e) {
                        e.preventDefault();
                        var id = $(this).data('id');
                        var tr_n = $(tr).closest('tr');
                        var row = api.row( tr_n );
                        if($(this).hasClass('active')) {
                            row.child.hide("slow");
                            $(this).removeClass('active');
                            return;
                        }
                        $(this).parent().find('a').removeClass('active');
                        $(this).addClass('active');
                        if(row.child.isShown()){
                            row.child.hide("slow");
                        }
                        row.child( show_view_proyecto(row.data()) ).show();
                        tr_n.next().find(".view_html").slideDown(200);
                    });
                    // FUNCTION EDIT PROYECTO
                    $(tr).find('.btn-edit-proyecto').off('click').on('click', function(e) {
                        e.preventDefault();
                        var id = $(this).data('id');
                        Pace.track(function () {
                            $.ajax({
                                url: '/admin/profesor/project/edit/' + id,
                                type: 'GET',
                                dataType: 'JSON',
                            })
                            .done(function(rs) {
                                if (rs.response == 'ok') {
                                    FormEditProject.dom.selectEspecialidad.trigger('initSelectEspecialidades', {especialidades: rs.data.especialidades});
                                    FormEditProject.dom.formEditProject.trigger('loadForm', rs.data);
                                }
                            })
                            .fail(function(jqXHR) {
                                Utils.displayErrors(jqXHR);
                            })
                        })
                    });
                    // FUNCTION DELETE PROYECTO
                    $(tr).find('.btn-delete-proyecto').off('click').on('click', function(e) {
                        e.preventDefault();
                        var id = $(this).data('id');
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
                                    url: '/admin/profesor/project/delete/' + id,
                                    type: 'GET',
                                    dataType: 'JSON',
                                    beforeSend: function () {
                                        swal.disableButtons();
                                    },
                                    success: function (rs) {
                                        if (rs.response == "ok") {
                                            swal("Eliminado!", "El proyecto se ha eliminado con éxito.", "success");
                                            // REFRESH TABLE
                                            table_list_projects.ajax.reload();
                                        }
                                    },
                                    error: function (jqXHR) {
                                        Utils.displayErrors(jqXHR);
                                    }
                                })
                            })
                            // /.PACE
                        })
                    });
                })
            },
            initComplete: function (settings, json) {
                // FILTRO
                $(".project-list-items").find('[type=search]').removeClass("input-sm")
                    .css({
                        "width": "100%",
                        "margin-left": 0
                    })
                    .parents("label").css({
                        "width": "100%"
                    });
            },
            searchDelay: 350,
            ordering : false,
            pagingType: "simple_numbers",
            pageLength: 8,
            lengthChange: false,
            searching: true,
            info: false,
            displayStart: 0,
            autoWidth: false,
            language: {
                loadingRecords: "Cargando...",
                emptyTable:     "No hay proyectos registrados por usted",
                info:           "Mostrando _START_ a _END_ de _TOTAL_ registros",
                infoEmpty:      "Mostrando 0 a 0 de 0 registros",
                zeroRecords:    "No se encontraron proyectos...",
                search: "",
                searchPlaceholder: "Buscar en lista de proyectos...",
                infoFiltered: " - filtrado para _MAX_ registros",
                paginate: {
                    first:      "Primero",
                    last:       "Último",
                    next:       "Siguiente",
                    previous:   "Anterior"
                }
            },
            columns: [
                {
                    className: 'project',
                    data: 'nombre_proyecto',
                    render: function(data, type, row) {
                        
                        var project = "<div class='p-title'>"+ row.nombre_proyecto +"</div>"
                        + "<div class='p-autor'>"
                        + "<strong>Autor: </strong>" + row.user.firstname + " " + row.user.primary_lastname
                        project += "</div>";
                        return project;
                    }
                },
                {
                    className: 'p-actions',
                    data: 'especialidad',
                    render: function(data, type, row) {
                        var actions = "<a href='#!' class='btn btn-default btn-xs btn-action btn-load-proyecto' data-id='"+ row.id +"' data-toggle='tooltip' data-placement='top' data-title='Ver detalles del proyecto'><i class='fa fa-eye'></i></a>"
                            + "<a href='#!' class='btn btn-warning btn-xs btn-action btn-edit-proyecto' data-id='" + row.id +"' data-toggle='tooltip' data-placement='top' data-title='Editar proyecto'><i class='fa fa-pencil'></i></a>"
                            + "<a href='#!' class='btn btn-danger btn-xs btn-action btn-delete-proyecto' data-id='" + row.id +"' data-toggle='tooltip' data-placement='top' data-title='Eliminar'><i class='fa fa-trash'></i></a>";
                        return actions;
                    }
                },
            ]
        })
    })

    function show_view_proyecto(data) {
        if(Object.keys(data).length > 0) {
            var box = '<div class="view_html" style="display: none;">'
                box += '<table class="table table-condensed table-bordered" style="margin-bottom:-1px;">'+
                        '<tr class="view_info warning">'+
                            '<td colspan="2" style="font-weight:bold;text-align:center;">DETALLES DEL PROYECTO</td>'+
                        '</tr>'+
                        '<tr class="view_info">'+
                            '<td style="width:110px;font-weight:bold;text-align:right;">Descripción</td>'+
                            '<td>'+ data.descripcion +'</td>'+
                        '</tr>'+
                        '<tr class="view_info">'+
                            '<td style="font-weight:bold;text-align:right;">Línea de acción</td>'+
                            '<td>'+ data.linea_accion +'</td>'+
                        '</tr>'+
                        '<tr class="view_info">'+
                            '<td style="font-weight:bold;text-align:right;">Fundamentación</td>'+
                            '<td>'+ data.fundamentacion +'</td>'+
                        '</tr>'+
                        '<tr class="view_info">'+
                            '<td style="font-weight:bold;text-align:right;">Propósito</td>'+
                            '<td>'+ data.proposito +'</td>'+
                        '</tr>'+
                        '<tr class="view_info">'+
                            '<td style="font-weight:bold;text-align:right;">Competencia</td>'+
                            '<td>'+ data.competencia +'</td>'+
                        '</tr>'+
                        '<tr class="view_info">'+
                            '<td style="font-weight:bold;text-align:right;">Metodología</td>'+
                            '<td>'+ data.metodologia +'</td>'+
                        '</tr>'+
                        '<tr class="view_info">'+
                            '<td style="font-weight:bold;text-align:right;">Referencias</td>'+
                            '<td>'+
                            '<ul>'; 
                            $.each(data.referencias, function(i, referencia) {
                                box += '<li>'+referencia.referencia+'</li>';
                            }); 
                            box += '</ul>'+
                            '</td>'+
                        '</tr>'+
                        '</table>'+
                    '</div>';
            return box;
        }else{
            return;
        }
    }

    function show_form_asign_proyecto(data) {
        if(data) {
            var box = '<div class="view_html" style="display: none;">'
            + data
            + '</div>';
            return box;
        }else{
            return;
        }
    }

    // Activate link
    var url = $("#url-active").data("url-active");
    global.url_active(url);

    // // ./CKEDITOR
    CKEDITOR.replace('descripcion', {
        customConfig: '/assets/js/customs/ckeditor_add_project_config.js'
    });

    CKEDITOR.instances.descripcion.on('fileUploadRequest', function (evt) {
        var fileLoader = evt.data.fileLoader,
            formData = new FormData(),
            xhr = fileLoader.xhr;

        xhr.open('POST', fileLoader.uploadUrl, true);
        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
        xhr.withCredentials = true;
        formData.append('upload', fileLoader.file, fileLoader.fileName);
        fileLoader.xhr.send(formData);

        // Prevented the default behavior.
        evt.stop();
    });

    // CKEDITOR LINEA ACCIÓN
    CKEDITOR.replace('linea_accion', {
        customConfig: '/assets/js/customs/ckeditor_add_project_config.js'
    });

    CKEDITOR.instances.linea_accion.on('fileUploadRequest', function (evt) {
        var fileLoader = evt.data.fileLoader,
            formData = new FormData(),
            xhr = fileLoader.xhr;

        xhr.open('POST', fileLoader.uploadUrl, true);
        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
        xhr.withCredentials = true;
        formData.append('upload', fileLoader.file, fileLoader.fileName);
        fileLoader.xhr.send(formData);

        // Prevented the default behavior.
        evt.stop();
    });

    // CKEDITOR FUNDAMENTACIÓN
    CKEDITOR.replace('fundamentacion', {
        customConfig: '/assets/js/customs/ckeditor_add_project_config.js'
    });

    CKEDITOR.instances.fundamentacion.on('fileUploadRequest', function (evt) {
        var fileLoader = evt.data.fileLoader,
            formData = new FormData(),
            xhr = fileLoader.xhr;

        xhr.open('POST', fileLoader.uploadUrl, true);
        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
        xhr.withCredentials = true;
        formData.append('upload', fileLoader.file, fileLoader.fileName);
        fileLoader.xhr.send(formData);

        // Prevented the default behavior.
        evt.stop();
    });

    // CKEDITOR PROPÓSITO
    CKEDITOR.replace('proposito', {
        customConfig: '/assets/js/customs/ckeditor_add_project_config.js'
    });

    CKEDITOR.instances.proposito.on('fileUploadRequest', function (evt) {
        var fileLoader = evt.data.fileLoader,
            formData = new FormData(),
            xhr = fileLoader.xhr;

        xhr.open('POST', fileLoader.uploadUrl, true);
        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
        xhr.withCredentials = true;
        formData.append('upload', fileLoader.file, fileLoader.fileName);
        fileLoader.xhr.send(formData);

        // Prevented the default behavior.
        evt.stop();
    });

    // CKEDITOR COMPETENCIA
    CKEDITOR.replace('competencia', {
        customConfig: '/assets/js/customs/ckeditor_add_project_config.js'
    });

    CKEDITOR.instances.competencia.on('fileUploadRequest', function (evt) {
        var fileLoader = evt.data.fileLoader,
            formData = new FormData(),
            xhr = fileLoader.xhr;

        xhr.open('POST', fileLoader.uploadUrl, true);
        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
        xhr.withCredentials = true;
        formData.append('upload', fileLoader.file, fileLoader.fileName);
        fileLoader.xhr.send(formData);

        // Prevented the default behavior.
        evt.stop();
    });

    // CKEDITOR METODOLOGÍA
    CKEDITOR.replace('metodologia', {
        customConfig: '/assets/js/customs/ckeditor_add_project_config.js'
    });

    CKEDITOR.instances.metodologia.on('fileUploadRequest', function (evt) {
        var fileLoader = evt.data.fileLoader,
            formData = new FormData(),
            xhr = fileLoader.xhr;

        xhr.open('POST', fileLoader.uploadUrl, true);
        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
        xhr.withCredentials = true;
        formData.append('upload', fileLoader.file, fileLoader.fileName);
        fileLoader.xhr.send(formData);

        // Prevented the default behavior.
        evt.stop();
    });
})
var FormEditProject = (function(){

    var el = {
        tableListProjects: '#table-list-projects',
        modalEditProject: '#edit-project-modal',
        formEditProject: '#form-edit-project',
        formListReferences: '#form-list-references',
        selectEspecialidad: '#especialidad',
        tbodyReferenceContainer: "#references-container",
        inputAutor: '#autor',
        inputNombreProyecto: '#nombre_proyecto',
        btnAddReference: '.btn-add-reference',
        btnDeleteReference: '.btn-delete-reference',
    };

    var dom = {
        find: jQuery,
        modalEditProject: $(el.modalEditProject),
        formEditProject: $(el.formEditProject),
        formListReferences: $(el.formListReferences),
        tbodyReferenceContainer: $(el.tbodyReferenceContainer),
        selectEspecialidad: $(el.selectEspecialidad),
        inputAutor: $(el.inputAutor),
        inputNombreProyecto: $(el.inputNombreProyecto),
        editor: CKEDITOR.instances,
    };

    var validators = {};

    var events = {
        showModal: function (evt) {
            $(this).modal({
                show: true,
                backdrop: 'static',
                keyboard: false
            })
        },
        resetModal: function (evt) {
            dom.tbodyReferenceContainer.html("");
        },
        loadForm: function (evt, data) {
            if (data) {
                dom.formEditProject.get(0).pid.value = data.id;
                dom.selectEspecialidad.val(data.especialidad_cod).trigger('change');
                dom.inputNombreProyecto.val(data.nombre_proyecto);
                dom.editor.descripcion.setData(data.descripcion)
                dom.editor.descripcion.updateElement();
                dom.editor.linea_accion.setData(data.linea_accion);
                dom.editor.linea_accion.updateElement();
                dom.editor.fundamentacion.setData(data.fundamentacion);
                dom.editor.fundamentacion.updateElement();
                dom.editor.proposito.setData(data.proposito);
                dom.editor.proposito.updateElement();
                dom.editor.competencia.setData(data.competencia);
                dom.editor.competencia.updateElement();
                dom.editor.metodologia.setData(data.metodologia);
                dom.editor.metodologia.updateElement();

                $.each(data.referencias, function (x, ref) {
                    dom.tbodyReferenceContainer.trigger('createReference', ref);
                });
                // INIT EVENT
                dom.find(el.btnAddReference).on('click', events.btnAddReferenceEvent);
                dom.find(el.btnDeleteReference).on('click', events.btnDeleteReferenceEvent);
                // SHOW MODAL
                FormEditProject.dom.modalEditProject.trigger('showModal');
            }
        },
        createReference: function (evt, data) {
            var rows = $(this).children('tr').length;
            var struct = `<tr class="reference" data-reference-id="${data.id}">
                        <td>
                            <input type="text" class="form-control" name="references[]" id="reference_${(rows + 1)}" value="${data.referencia}" placeholder="Referencia...">
                            <input type="text" name="reference_id[]" value="${data.id}" style="display:none">
                            <label id="reference_${(rows + 1)}-error" class="error" for="reference_${(rows + 1)}" style="display:none;"></label>
                        </td>
                        <td class="buttons" style="width:52px;">
                            <button type="button" class="btn btn-box-tool btn-delete-reference"><i class="fa fa-remove"></i></button>
                            <button type="button" class="btn btn-box-tool btn-add-reference"><i class="fa fa-plus"></i></button>
                        </td>
                    </tr>`;
            $(struct).appendTo(this);
        },
        btnAddReferenceEvent: function (evt) {
            var row = $(this).parents('tr');
            var rows = dom.tbodyReferenceContainer.children('tr').length;
            var reference = $(this).parents('tr').clone(true);
            reference.get(0).dataset.referenceId = "";
            reference.find('input').first().val("").attr('id', 'reference_' + (rows + 1)).removeClass('error');
            reference.find('[name="reference_id[]"]').val("");
            reference.find('label.error').remove();
            reference.insertAfter(row);
        },
        btnDeleteReferenceEvent: function (evt) {
            var row = $(this).parents('tr');
            var reference_id = row.get(0).dataset.referenceId;
            if (dom.tbodyReferenceContainer.children('tr').length == 1) {
                row.find('input').val("");
                return;
            }

            if (reference_id !== "") {
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
                                url: '/admin/profesor/project/reference/delete/' + reference_id,
                                type: 'GET',
                                dataType: 'JSON',
                                beforeSend: function () {
                                    swal.disableButtons();
                                },
                                success: function (rs) {
                                    if (rs.response == "ok") {
                                        swal("Eliminado!", "Los datos se han eliminado con éxito.", "success");
                                        row.remove();
                                        // REFRESH TABLE
                                        dom.find(el.tableListProjects).DataTable().ajax.reload();
                                    }
                                },
                                error: function (jqXHR) {
                                    Utils.displayErrors(jqXHR);
                                }
                            })
                        })
                        // /.PACE
                    })
            } else {
                row.remove();
            }
        },
        initSelectEspecialidades: function (evt, data) {
            dom.selectEspecialidad.select2({
                data: data.especialidades
            })
        }
    };

    var subscribeEvents = function () {
        dom.modalEditProject.on('showModal', events.showModal);
        dom.modalEditProject.on('hide.bs.modal', events.resetModal);
        dom.formEditProject.on('loadForm', events.loadForm);
        dom.tbodyReferenceContainer.on('createReference', events.createReference);
        dom.selectEspecialidad.on('initSelectEspecialidades', events.initSelectEspecialidades);
    }

    var validate = {
        callback: function (form) {
            var data = dom.formEditProject.serialize();
            var objData = {
                descripcion_up: dom.editor.descripcion.getData(),
                linea_accion_up: dom.editor.linea_accion.getData(),
                fundamentacion_up: dom.editor.fundamentacion.getData(),
                proposito_up: dom.editor.proposito.getData(),
                competencia_up: dom.editor.competencia.getData(),
                metodologia_up: dom.editor.metodologia.getData(),
            }
            data += "&" + $.param(objData);
            var project_id = dom.formEditProject.get(0).pid.value;
            
            Pace.track(function () {
                $.ajax({
                    url: '/admin/profesor/project/edit/' + project_id,
                    data: data,
                    type: 'POST',
                    dataType: 'JSON',
                })
                .done(function(rs) {
                    if (rs.response == 'ok') {
                        Utils.initNoty('Se ha actualizado correctamente.', 'success');
                        // HIDEN MODAL
                        dom.modalEditProject.modal('hide');
                        // REFRESH TABLE
                        dom.find(el.tableListProjects).DataTable().ajax.reload();
                    }
                })
                .fail(function(jqXHR) {
                    Utils.displayErrors(jqXHR);
                })
            });
        },
        rules: {
            nombre_proyecto: {
                required: true,
            },
            descripcion: {
                required: true,
            },
            linea_accion: {
                required: true,
            },
            fundamentacion: {
                required: true,
            },
            proposito: {
                required: true,
            },
            competencia: {
                required: true,
            },
            metodologia: {
                required: true,
            },
            'recursos[]': {
                required: true
            },
            'references[]': {
                required: true
            },
        }
    }

    var initFormFun = function () {}

    var initializer = function () {
        subscribeEvents();
        Utils.initValidateForm(dom.formEditProject.get(0), validate.callback, validate.rules);
    }

    return {
        initializer: initializer,
        el: el,
        dom: dom,
        events: events
    }
})()
$(document).ready(function () {
    FormEditProject.initializer();
});
//# sourceMappingURL=_projects_list.js.map
