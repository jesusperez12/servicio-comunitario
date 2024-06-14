$(document).ready(function() {
    // Load list permissions
    var table_list_permissions = null;
    Pace.track(function() {
        table_list_permissions = $("#table-list-permissions").DataTable({
            ajax: '/admin/user/permission/all',
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
                searchPlaceholder: "Buscar en lista de permisos...",
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
                    data: 'permission',
                    render: function(data, type, row) {
                        var data = row.permission_slug + " <sapn class='nP'>(" + row.permission + ")</span>";    
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
                        return '<a class="btn btn-xs btn-danger btn-delete-permission" data-permission-id="'+ row.id +'" href="#!"'
                        + 'data-toggle="tooltip" data-container="body" data-title="Eliminar"><span><i class="fa fa-remove"></i></span></a>'
                        + '&nbsp;&nbsp;'
                        + '<a class="btn btn-xs btn-warning btn-edit-permission" data-permission-id="'+ row.id +'" href="#!"'
                        + 'data-toggle="tooltip" data-container="body" data-title="Editar"><span><i class="fa fa-pencil"></i></span></a>';
                    }
                }
            ]
        })

        // REQUEST DELETE PERMISSION
        $("#table-list-permissions").find("tbody").on('click', '.btn-delete-permission',function(e) {
            e.preventDefault();
            // Rows
            var row = $(this).parents('tr');
            var pid = $(this).data("permission-id");
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
                        url: '/admin/user/permission/delete/' + pid,
                        type: 'GET',
                        dataType: 'JSON',
                        beforeSend: function() {
                            swal.disableButtons();
                        },
                        success: function(json) {
                            console.log(json);
                            if(json.response == "ok")
                            {
                                swal("Eliminado!", "El permiso se ha eliminado con éxito.", "success");
                                row.fadeOut();
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
        $("#table-list-permissions").find("tbody").on('click', '.btn-edit-permission',function(e) {
            e.preventDefault();
            var btn = this;
            var pid = $(this).data("permission-id"); 
            Pace.track(function() {
                // Ajax request
                $.ajax({
                    url: '/admin/user/permission/edit/' + pid,
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
                            $("#b-can-up-pe").on('click', function() {
                                $("#load_form_edit").html("").hide();
                                $("#load_form_add").show();
                            })
                        }
                        $(btn).attr("disabled", false);
                    },
                    error: function(error) {
                        $.each(error, function(a, b) {
                            console.log(a+' => '+b)
                        })
                    }
                })
                // /.AJAX
            })
            // /.PACE
        })

        global.noEllipsis($("#table-list-permissions"));
    })

    // Form add permission
    $("#form-add-permission").validate({
        submitHandler: function(form) {
            Pace.track(function() {
                var data = $(form).serialize();
                // Ajax request
                $.ajax({
                    url: '/admin/user/permission',
                    data: data,
                    type: 'POST',
                    dataType: 'json',
                    success: function(json) {
                        if(json.response == "ok")
                        {
                            $(form).trigger("reset");
                            table_list_permissions.ajax.reload();
                        }
                    },
                    error: function(error) {
                        $.each(error, function(a, b) {
                            console.log(a+' => '+b)
                        })
                    }
                })
                // /.Ajax
            })
            // /.Pace
        },
        rules: {
            permission: {
                required: true,
                excludeletters: true
            },
            permission_slug: {
                required: true,
                excludeletters: true
            },
            description: {
                required: true
            }
        }
    })

    // Form edit permission
    function initFormEditValidate()
    {
        $("#form-edit-permission").validate({
            submitHandler: function(form) {
                var pid = form.permission_id.value;
                Pace.track(function() {
                    var data = $(form).serialize();
                    // Ajax request
                    $.ajax({
                        url: '/admin/user/permission/' + pid,
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
                                table_list_permissions.ajax.reload();
                            }
                        },
                        error: function(error) {
                            $.each(error, function(a, b) {
                                console.log(a+' => '+b)
                            })
                        }
                    })
                    // /.Ajax
                })
                // /.Pace
            },
            rules: {
                permission: {
                    required: true,
                    excludeletters: true
                },
                permission_slug: {
                    required: true,
                    excludeletters: true
                },
                description: {
                    required: true
                }
            }
        })
    }

    // Create slug permission in add
    $("#form-add-permission").find("#permission").on('keyup', function(e) {
        var start = this.selectionStart, end = this.selectionEnd;
        this.value = e.currentTarget.value.replace(/\s+/g, ' ');
        var value = e.currentTarget.value.replace(/\s+|\_+/g, '_');
        this.setSelectionRange(start, end);
        setTimeout(function() {
            $("#form-add-permission").find("#permission_slug").val(value.toUpperCase());
        }, 100)
    })
    // Create slug permission in edit
    $("#form-edit-permission").find("#permission").on('keyup', function(e) {
        var start = this.selectionStart, end = this.selectionEnd;
        this.value = e.currentTarget.value.replace(/\s+/g, ' ');
        var value = e.currentTarget.value.replace(/\s+|\_+/g, '_');
        this.setSelectionRange(start, end);
        setTimeout(function() {
            $("#form-edit-permission").find("#permission_slug").val(value.toUpperCase());
        }, 100)
    })

    // Ellipsis text table rol permissions
    var trs = $("#table-list-permissions").find("tbody").children();
    $.each(trs, function(key, tr) {
        var txt_complete = $.trim($(tr.cells[1]).text());
        if(txt_complete.length > 50) {
            var txt_short = txt_complete.slice(0, 49)+"...<a href='javascript:;' data-toggle='popover' data-placement='left' data-trigger='focus' title='DESCRIPCIÓN' data-content='"+txt_complete+"'><span><i class='fa fa-info-circle'></i></span></a>";
            // Set value to cell
            $(tr.cells[1]).html(txt_short);
        }
    })

    // Activate popover
    $("[data-toggle=popover]").popover({
        html: true
    });
    // Activate link
    var url = $("#url-active").data("url-active");
    global.url_active(url);
})
//# sourceMappingURL=permissions.js.map
