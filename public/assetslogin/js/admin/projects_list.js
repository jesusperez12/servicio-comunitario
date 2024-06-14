$(document).ready(function() {
    var table_list_projects = null;
    Pace.track(function() {
        table_list_projects = $("#table-list-projects").DataTable({
            ajax: '/admin/coordinador/project/all',
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
                    // FUNCTION ASIGNAR USUARIO A PROYECTO
                    $(tr).find('.btn-asign-user-proyecto').off('click').on('click', function(e) {
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
                        if ( row.child.isShown() ) {
                            row.child.hide("slow");
                        }
                        Pace.track(function() {
                            $.ajax({
                                url: "/admin/coordinador/project/assign/user/to/" + id,
                                type: "GET",
                                dataType: "html",
                                success: function(data) {
                                    Pace.track(function() {
                                        $.ajax({
                                            url: "/admin/coordinador/project/assign/users/project/" + id,
                                            type: 'GET',
                                            dataType: 'json',
                                            success: function(json) {
                                                var users = [];
                                                $.each(json.users, function(x, user) {
                                                    users.push(parseInt(user.id));
                                                })
                                                row.child( show_form_asign_proyecto(data) ).show();
                                                tr_n.next().find(".view_html").slideDown(200);
                                                
                                                var options = tr_n.next().find('#usuarios').find('option');
                                                $.each(options, function (y, input) {
                                                    $.each(json.users, function (z, user) {
                                                        if(parseInt($(input).val()) == parseInt(user.id)) {
                                                            $(input).attr('disabled', true);
                                                            $(input).attr('data-pup-id', user.pivot.id);
                                                        } else {
                                                            $(input).attr('disabled', false);
                                                            $(input).removeAttr('data-pup-id');
                                                        }
                                                    })
                                                    if (json.users.length == 0) {
                                                        $(input).attr('disabled', false);
                                                        $(input).removeAttr('data-pup-id');
                                                    }
                                                });

                                                // SELECT PERIODOS
                                                tr_n.next().find('#corte').select2({
                                                    placeholder: 'Seleccione...',
                                                });
                                                tr_n.next().find('#corte').val(json.periodo.id).trigger('change');
                                                // ON CHANGE EVENT
                                                tr_n.next().find('#corte').on('change', function (evt) {
                                                    var id = this.value;
                                                    var proyecto_id = tr_n.next().find('[name="project_id"]').val();
                                                    Pace.track(function () {
                                                        var rq = $.get(`/admin/coordinador/project/assign/users/project/${proyecto_id}/periodo/${id}`,
                                                            function (data, textStatus, jqXHR) {
                                                                var users = [];
                                                                $.each(data.users, function (x, user) {
                                                                    users.push(parseInt(user.id));
                                                                })
                                                                var options = tr_n.next().find('#usuarios').find('option');
                                                                $.each(options, function (y, input) {
                                                                    $.each(data.users, function (z, user) {
                                                                        if (parseInt($(input).val()) == parseInt(user.id)) {
                                                                            $(input).attr('disabled', true);
                                                                            $(input).attr('data-pup-id', user.pivot.id);
                                                                        } else {
                                                                            $(input).attr('disabled', false);
                                                                            $(input).removeAttr('data-pup-id');
                                                                        }
                                                                    })
                                                                    if (data.users.length == 0) {
                                                                        $(input).attr('disabled', false);
                                                                        $(input).removeAttr('data-pup-id');
                                                                    }
                                                                });
                                                                // LOAD USERS
                                                                tr_n.next().find('#usuarios').select2('destroy');
                                                                tr_n.next().find('#usuarios').select2({
                                                                    placeholder: 'Seleccione...',
                                                                });
                                                                tr_n.next().find('#usuarios').val(users).trigger('change');

                                                                if (data.users.length == 0) {
                                                                    tr_n.next().find('#usuarios').select2('destroy');
                                                                    tr_n.next().find('#usuarios').select2({
                                                                        placeholder: 'Seleccione...',
                                                                    });
                                                                }
                                                            },
                                                            "JSON"
                                                        );
                                                    })
                                                });

                                                // SELECT USUARIOS
                                                tr_n.next().find('#usuarios').select2({
                                                    placeholder: 'Seleccione...',
                                                });
                                                tr_n.next().find('#usuarios').val(users).trigger('change');

                                                // DELETING USER FROM PROJECT
                                                tr_n.next().find('#usuarios').on('select2:unselecting', function(evt) {
                                                    var select = this;
                                                    var proyecto_id = tr_n.next().find('[name="project_id"]').val();
                                                    var periodo_id = tr_n.next().find('#corte').val();
                                                    var pup_id = (evt.params.args.data.element.attributes.length > 1) ? $(evt.params.args.data.element).data('pup-id') : undefined;
                                                    var user_id = (typeof evt.params != 'undefined') ? $(evt.params.args.data.element).val() : undefined;

                                                    if (typeof pup_id !== 'undefined' && typeof pup_id !== 'string') {
                                                        
                                                        evt.preventDefault();

                                                        swal({
                                                            title: "Estas seguro?",
                                                            text: "¿ Realmente desea eliminarlo ?.<br><br>",
                                                            type: "warning",
                                                            html:true,
                                                            showCancelButton: true,
                                                            confirmButtonColor: "#DD6B55",
                                                            confirmButtonText: "Si, eliminarlo!",
                                                            closeOnConfirm: false
                                                        },
                                                        function () {
                                                            Pace.track(function () {
                                                                // Ajax request
                                                                $.ajax({
                                                                    url: `/admin/coordinador/project/unassign/user/${user_id}/to/project/${proyecto_id}/pivot/${pup_id}/periodo/${periodo_id}`,
                                                                    type: 'GET',
                                                                    dataType: 'JSON',
                                                                    beforeSend: function () {
                                                                        swal.disableButtons();
                                                                    },
                                                                    success: function (json) {
                                                                        if (json.response == "ok") {
                                                                            swal("Eliminado!", "Se ha eliminado correctamente.", "success");
                                                                            evt.params.args.data.selected = false;
                                                                            evt.params.args.data.disabled = false;
                                                                            $(evt.params.args.data.element).attr('disabled', false);
                                                                            $(evt.params.args.data.element).removeAttr('data-pup-id');
                                                                            api.ajax.reload();
                                                                        }
                                                                    },
                                                                    error: function (jqXHR, textStatus) {
                                                                        var errors = [];
                                                                        if (jqXHR.responseJSON) {
                                                                            $.each(jqXHR.responseJSON, function (x, error) {
                                                                                $.each(error, function (x, o) {
                                                                                    errors.push(o);
                                                                                })
                                                                            })

                                                                            if (errors.length > 0) {

                                                                                swal({
                                                                                    title: '¡Acción denegada!',
                                                                                    text: errors[0],
                                                                                    html: true
                                                                                })

                                                                            }
                                                                        }
                                                                    }
                                                                })
                                                            })
                                                            // /.PACE
                                                        },
                                                        function(){
                                                            tr_n.next().find('#usuarios').val(users).trigger('change');
                                                        })
                                                        // /.FUNCTION
                                                        return true;
                                                    }
                                                });

                                                tr_n.next().find(".view_html").find("#form-asign-user-project").validate({
                                                    submitHandler: function(form) {
                                                        var mydata = $(form).serialize();
                                                        Pace.track(function() {
                                                            $.ajax({
                                                                url: "/admin/coordinador/project/assign/user/to/project",
                                                                data: mydata,
                                                                type: 'POST',
                                                                dataType: 'JSON',
                                                                success: function(json) {
                                                                    api.ajax.reload();
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
                                                                },
                                                                error: function(jqXHR) {
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
                                                                }
                                                            })
                                                        })
                                                    }
                                                });
                                            }
                                        })
                                    })
                                }
                            })
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
                        + "<a href='#!' class='btn btn-default btn-xs btn-action btn-asign-user-proyecto' data-id='"+ row.id +"' data-toggle='tooltip' data-placement='top' data-title='Asignar profesor'><i class='fa fa-user'></i></a>"
                        + "<a href='#!' class='btn btn-default btn-xs btn-action' data-toggle='tooltip' data-placement='top' data-title='Ver reportes de actividades'><i class='fa fa-list-alt'></i></a>"
                        + "<a href='#!' class='btn btn-danger btn-xs btn-action' data-toggle='tooltip' data-placement='top' data-title='Enviar a la papelera'><i class='fa fa-trash'></i></a>";
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
})
//# sourceMappingURL=projects_list.js.map
