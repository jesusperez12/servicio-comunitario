$(document).ready(function() {
    // Load list permissions
    var table_list_roles_permissions = null;
    Pace.track(function() {
        table_list_roles_permissions = $("#table-list-roles-permissions").DataTable({
            ajax: '/admin/user/role/all',
            ordering : false,
            pagingType: "simple_numbers",
            pageLength: 8,
            lengthChange: false,
            searching: false,
            info: false,
            displayStart: 0,
            autoWidth: false,
            language: {
                loadingRecords: "Cargando...",
                emptyTable:     "No hay datos disponibles en la tabla",
                info:           "Mostrando _START_ a _END_ de _TOTAL_ registros",
                infoEmpty:      "Mostrando 0 a 0 de 0 registros",
                zeroRecords:    "No hay permisos registrados...",
                search: "",
                searchPlaceholder: "Buscar en lista de roles...",
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
                    data: 'role',
                    render: function(data, type, row) {
                        var data = row.role;    
                        return '<div class="xS noellipsis">'
                        + data
                        + '</div>';
                    }
                },
                {
                    className: 'xY',
                    data: 'description',
                    render: function(data, type, row) {
                        return '<div class="xS noellipsis">'
                        + row.description
                        + '</div>';
                    }
                },
                {
                    className:"text-center",
                    data: null,
                    render: function(data, type, row) {
                        return '<a class="btn btn-xs btn-success btn-add-permissions" data-role-id="'+ row.id +'" data-role="'+ row.role +'" href="#!"'
                        + 'data-toggle="tooltip" data-container="body" data-title="Asignar o editar permisos"><span><i class="fa fa-key"></i></span></a>'
                        + '&nbsp;&nbsp;'
                        + '<a class="btn btn-xs btn-danger btn-delete-role" data-role-id="'+ row.id +'" href="#!"'
                        + 'data-toggle="tooltip" data-container="body" data-title="Eliminar"><span><i class="fa fa-remove"></i></span></a>'
                        + '&nbsp;&nbsp;'
                        + '<a class="btn btn-xs btn-warning btn-edit-role" data-role-id="'+ row.id +'" href="#!"'
                        + 'data-toggle="tooltip" data-container="body" data-title="Editar"><span><i class="fa fa-pencil"></i></span></a>';
                    }
                }
            ]
        })

        // REQUEST ASSIGN PERMISSION
        $("#table-list-roles-permissions").find("tbody").on('click', '.btn-add-permissions',function(e) {
            e.preventDefault();
            var rid = $(this).data("role-id");
            var rname = $(this).data("role");
            Pace.track(function() {
                // Ajax request
                $.ajax({
                    url: '/admin/user/role/' + rid + '/permissions',
                    type: 'GET',
                    dataType: 'json',
                    success: function(json) {
                        if(json.response == 'ok')
                        {
                            $("#f-add-pr").find("#role_id").val(rid);
                            $("#f-add-pr").find("#role-assign").val(rname);

                            var selections = [];
                            $.each(json.permissions, function(key, permission) {
                                selections.push(permission.id);
                            })
                            if(selections.length > 0)
                            {
                                $("#list-permissions").val(selections).trigger('change');
                            }
                            // Show modal
                            $("#mf-add-pr").modal({
                                show: true,
                                backdrop: 'static',
                                keyboard: false
                            });
                        }
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
        })
        

        // REQUEST DELETE PERMISSION
        $("#table-list-roles-permissions").find("tbody").on('click', '.btn-delete-role',function(e) {
            e.preventDefault();
            // Rows
            var row = $(this).parents('tr');
            var row_next = row.next();
            var pid = $(this).data("role-id");
            swal({
                title: "Estas seguro?",
                text: "Esta acción no se podrá deshacer.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Si, eliminar!",
                closeOnConfirm: false
            },
            function(){
                Pace.track(function() {
                    // Ajax request
                    $.ajax({
                        url: '/admin/user/role/delete/' + pid,
                        type: 'GET',
                        dataType: 'JSON',
                        beforeSend: function() {
                            swal.disableButtons();
                        },
                        success: function(json) {
                            if(json.response == "ok")
                            {
                                swal("Eliminado!", "El rol se ha eliminado con éxito.", "success");
                                row.fadeOut();
                                // row_next.fadeOut();
                            }
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
                // /.PACE
            })
            // /.FUNCTION
        })
        // /.SWAL

        // REQUEST EDIT PERMISSION
        $("#table-list-roles-permissions").find("tbody").on('click', '.btn-edit-role',function(e) {
            e.preventDefault();
            var btn = this;
            var rid = $(this).data("role-id"); 
            Pace.track(function() {
                // Ajax request
                $.ajax({
                    url: '/admin/user/role/edit/' + rid,
                    type: 'GET',
                    dataType: 'html',
                    beforeSend: function() {
                        $(btn).attr("disabled", true);
                    },
                    success: function(json) {
                        if(json)
                        {
                            $("#load_form_edit").html(json).show();
                            $("#load_form_add").hide();

                            // INIT FORM EDIT VALIDATE
                            initFormEditValidate();

                            // BTN CANCEL UPDATE
                            $("#b-can-up-ro").on('click', function() {
                                $("#load_form_edit").html("").hide();
                                $("#load_form_add").show();
                            })
                        }
                        $(btn).attr("disabled", false);
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
                // /.AJAX
            })
            // /.PACE
        })

        global.noEllipsis($("#table-list-roles-permissions"));
    })

    // FORM ASSIGN PERMISSION
    $("#f-add-pr").validate({
        submitHandler: function(form) {
            var data = $(form).serialize();
            $.ajax({
                url: '/admin/user/role/assign/permission',
                data: data,
                type: 'POST',
                dataType: 'json',
                success: function(json) {
                    if(json.response == 'ok') {
                        $("#mf-add-pr").modal('hide');
                    }else{
                        console.log(json.response);
                    }
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
        }
    })

    // Validate form add role
    $("#form-add-role").validate({
        submitHandler: function(form) {
            Pace.track(function() {
                var data = $(form).serialize();
                // Ajax request
                $.ajax({
                    url: '/admin/user/role',
                    data: data,
                    type: 'POST',
                    dataType: 'json',
                    success: function(json) {
                        if(json.response == "ok")
                        {
                            $(form).trigger("reset");
                            table_list_roles_permissions.ajax.reload();
                        }
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
                // /.Ajax
            })
            // /.Pace
        },
        rules: {
            role: {
                required: true,
                excludeletters: true
            },
            description: {
                required: true
            }
        }
    })

    // Validate form edit role
    function initFormEditValidate()
    {
        $("#form-edit-role").validate({
            submitHandler: function(form) {
                var pid = form.role_id.value;
                Pace.track(function() {
                    var data = $(form).serialize();
                    // Ajax request
                    $.ajax({
                        url: '/admin/user/role/' + pid,
                        data: data,
                        type: 'POST',
                        dataType: 'json',
                        success: function(json) {
                            if(json.response == "ok")
                            {
                                // Reset form edit
                                $(form).trigger("reset");
                                $("#load_form_edit").html("").hide();
                                $("#load_form_add").show();
                                // Refresh list permissions
                                table_list_roles_permissions.ajax.reload();
                            }
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
                    // /.Ajax
                })
                // /.Pace
            },
            rules: {
                role: {
                    required: true,
                    excludeletters: true
                },
                description: {
                    required: true
                }
            }
        })
    }


    // Ellipsis text table rol permissions
    var trs = $("#table-list-roles-permissions").find("tbody").children();
    $.each(trs, function(key, tr) {
        var txt_complete = $.trim($(tr.cells[1]).text());
        if(txt_complete.length > 50) {
            var txt_short = txt_complete.slice(0, 49)+"...<a href='javascript:;' data-toggle='popover' data-placement='left' data-trigger='focus' title='DESCRIPCIÓN' data-content='"+txt_complete+"'><span><i class='fa fa-info-circle'></i></span></a>";
            // Set value to cell
            $(tr.cells[1]).html(txt_short);
        }
    })
    // Hide modal
    $("#mf-add-pr").on('hide.bs.modal', function() {
        $("#list-permissions").val('').trigger('change');
    })
    // Logic to select list permissions
    $("#list-permissions").select2({
        placeholder: "Seleccione los permisos"
    });

    // Activate tooltip
    $("[data-toggle=tooltip]").tooltip();
    // Activate popover
    $("[data-toggle=popover]").popover();
    // Activate link
    var url = $("#url-active").data("url-active");
    global.url_active(url);
})
//# sourceMappingURL=roles.js.map
