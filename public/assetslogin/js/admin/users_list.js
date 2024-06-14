$(document).ready(function() {
    var table_list_users = null;
    Pace.track(function() {
        table_list_users = $("#table-list-users").DataTable({
            ajax: '/admin/user/all',
            dom: `<'row'<'col-sm-6 users-list-items'f><'col-sm-4'<'#searchFilterUsers'>>>
                  <'row'<'col-sm-12'tr>>
                  <'row'<'col-sm-5'i><'col-sm-7'p>>`,
            drawCallback: function(settings) {
                var api = this.api();
                $.each(api.rows().nodes(), function(x, tr){
                    $(tr).find('[data-toggle=tooltip]').tooltip();
                    // FUNCTION LOAD USUARIO
                    $(tr).find('.btn-load-usuario').off('click').on('click', function(e) {
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
                        Pace.track(function() {
                            $.ajax({
                                url: "/admin/user/view/" + id,
                                type: "GET",
                                dataType: "JSON",
                                success: function(json) {
                                    if(json.data) {
                                        row.child( show_view_usuario(json.data) ).show();
                                        tr_n.next().find(".view_html").slideDown(200);
                                        tr_n.next().find('td').first().css({ 'border-top':'2px solid #4879BE','border-bottom':'2px solid #4879BE','background-color':'#B6D7FF' });
                                    }
                                }
                            })
                        })
                    });
                    // FUNCTION EDIT USUARIO
                    $(tr).find('.btn-edit-usuario').off('click').on('click', function(e) {
                        e.preventDefault();
                        var id = $(this).data('id');
                        var tr_n = $(tr).closest('tr');
                        var row = api.row( tr_n );
                        $(this).parent().find('a').removeClass('active');
                        if(row.child.isShown()){
                            row.child.hide("slow");
                        }
                        Pace.track(function() {
                            $.ajax({
                                url: "/admin/user/edit/" + id,
                                type: "GET",
                                dataType: "json",
                                success: function(json) {
                                    $("#editUser").modal({
                                        show: true,
                                        backdrop: 'static',
                                        keyboard: false
                                    })
                                    // Load user data
                                    var form = $("#editUser").find("form")[0];
                                    form.user_id.value = json.data.id;
                                    form.ci.value = json.data.ci;
                                    form.firstname.value = json.data.firstname;
                                    form.middlename.value = json.data.middlename;
                                    form.primary_lastname.value = json.data.primary_lastname;
                                    form.second_lastname.value = json.data.second_lastname;
                                    if(json.data.date_birth != null) {
                                        $(form.date_birth).datepicker('setDate',new Date(json.data.date_birth));
                                    }
                                    form.address.value = json.data.address;
                                    if(parseInt(json.data.status) == 0) {
                                        $(form.active).iCheck('check');
                                    }else{
                                        $(form.pending).iCheck('check');
                                    }
                                    if(parseInt(json.data.gender) == 0) {
                                        $(form.woman).iCheck('check');
                                    }else{
                                        $(form.man).iCheck('check');
                                    }
                                    
                                    $(form.role_id).val(json.data.role_id).trigger('change');
                                    // $(form.sede_id).val(json.data.sede_id).trigger('change');
                                    $(form.state).val(json.data.state).trigger("change", {locality: json.data.locality, province: json.data.province});
                                    $(form.speciality).val(json.data.especialidad_cod).trigger("change");
                                    form.email.value = json.data.email;
                                    // $(form).find("[name='codes[]']").children().removeAttr('selected');
                                    // $(form).find("[name='codes[]']").trigger('reset');
                                    $.each(json.data.phones, function(x, phone) {
                                        if(x == 0) {
                                            $(form).find("[name='codes[]']").val(phone.code_id);
                                            form.phones.value = phone.number;
                                            $(form).find("[name='phones_id[]']").val(phone.id);
                                        }else{
                                            global.add_phones(phone);
                                        }
                                    })
                                }
                            })
                        })
                    });
                    // FUNCTION SUSPENDER USUARIO
                    $(tr).find('.btn-suspend-usuario').off('click').on('click', function(e) {
                        e.preventDefault();
                        var id = $(this).data('id');
                        var tr_n = $(tr).closest('tr');
                        var row = api.row( tr_n );
                        $(this).parent().find('a').removeClass('active');
                        if(row.child.isShown()){
                            row.child.hide("slow");
                        }
                        swal({
                            title: "Estas seguro?",
                            text: "¿ Realmente desea suspender usuario ?.",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Si, suspender!",
                            closeOnConfirm: false
                        },
                        function(){
                            Pace.track(function() {
                                // Ajax request
                                $.ajax({
                                    url: '/admin/user/suspend/' + id,
                                    type: 'GET',
                                    dataType: 'JSON',
                                    beforeSend: function() {
                                        swal.disableButtons();
                                    },
                                    success: function(json) {
                                        if(json.response == "ok")
                                        {
                                            swal("Eliminado!", "El usuario ahora se encuentra suspendido.", "success");
                                            table = $("#table-list-users").DataTable();
                                            table.ajax.reload();
                                        }
                                    },
                                    error: function(jqXHR) {
                                        Utils.displayErrors(jqXHR);
                                    }
                                })
                            })
                            // /.PACE
                        })
                        // /.FUNCTION
                    });
                    // FUNCTION ACTIVAR USUARIO
                    $(tr).find('.btn-active-usuario').off('click').on('click', function(e) {
                        e.preventDefault();
                        var id = $(this).data('id');
                        var tr_n = $(tr).closest('tr');
                        var row = api.row( tr_n );
                        $(this).parent().find('a').removeClass('active');
                        if(row.child.isShown()){
                            row.child.hide("slow");
                        }
                        swal({
                            title: "Estas seguro?",
                            text: "¿ Realmente desea activar usuario ?.",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Si, activar!",
                            closeOnConfirm: false
                        },
                        function(){
                            Pace.track(function() {
                                // Ajax request
                                $.ajax({
                                    url: '/admin/user/active/' + id,
                                    type: 'GET',
                                    dataType: 'JSON',
                                    beforeSend: function() {
                                        swal.disableButtons();
                                    },
                                    success: function(json) {
                                        if(json.response == "ok")
                                        {
                                            swal("Activado!", "El usuario ahora se encuentra activo.", "success");
                                            table = $("#table-list-users").DataTable();
                                            table.ajax.reload();
                                        }
                                    },
                                    error: function(jqXHR) {
                                        Utils.displayErrors(jqXHR);
                                    }
                                })
                            })
                            // /.PACE
                        })
                        // /.FUNCTION
                    });
                    // FUNCTION ELIMINAR USUARIO
                    $(tr).find('.btn-delete-usuario').off('click').on('click', function(e) {
                        e.preventDefault();
                        var id = $(this).data('id');
                        var tr_n = $(tr).closest('tr');
                        var row = api.row( tr_n );
                        $(this).parent().find('a').removeClass('active');
                        if(row.child.isShown()){
                            row.child.hide("slow");
                        }
                        swal({
                            title: "Estas seguro?",
                            text: "¿ Realmente desea eliminar el usuario ?.",
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
                                    url: '/admin/user/delete/' + id,
                                    type: 'GET',
                                    dataType: 'JSON',
                                    beforeSend: function() {
                                        swal.disableButtons();
                                    },
                                    success: function(json) {
                                        if(json.response == "ok")
                                        {
                                            swal("Eliminado!", "El usuario se ha eliminado con éxito.", "success");
                                            table = $("#table-list-users").DataTable();
                                            table.ajax.reload();
                                        }
                                    },
                                    error: function(jqXHR) {
                                        Utils.displayErrors(jqXHR);
                                    }
                                })
                            })
                            // /.PACE
                        })
                        // /.FUNCTION
                    });
                    // FUNCTION ARCHIVAR USUARIO
                    $(tr).find('.btn-archive-usuario').off('click').on('click', function (e) {
                        e.preventDefault();
                        var id = $(this).data('id');
                        var tr_n = $(tr).closest('tr');
                        var row = api.row(tr_n);
                        $(this).parent().find('a').removeClass('active');
                        if (row.child.isShown()) {
                            row.child.hide("slow");
                        }
                        swal({
                            title: "Estas seguro?",
                            text: `El usuario pasará al historial de profesores.<br><br><p class="sugerencia_error">Además, no podrá ser editado, suspendido o eliminado y no tendrá acceso al sistema.</p><br><br>`,
                            html: true,
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Si, archivar!",
                            closeOnConfirm: false
                        },
                        function () {
                            Pace.track(function () {
                                // Ajax request
                                $.ajax({
                                    url: '/admin/user/archive/' + id,
                                    type: 'GET',
                                    dataType: 'JSON',
                                    beforeSend: function () {
                                        swal.disableButtons();
                                    },
                                    success: function (json) {
                                        if (json.response == "ok") {
                                            swal("Archivado!", "El usuario ahora se encuentra en el historial de profesores.", "success");
                                            table = $("#table-list-users").DataTable();
                                            table.ajax.reload();
                                        }
                                    },
                                    error: function (jqXHR) {
                                        Utils.displayErrors(jqXHR);
                                    }
                                })
                            })
                            // /.PACE
                        })
                        // /.FUNCTION
                    });
                    // FUNCTION RESTORE USUARIO
                    $(tr).find('.btn-restore-usuario').off('click').on('click', function (e) {
                        e.preventDefault();
                        var id = $(this).data('id');
                        var tr_n = $(tr).closest('tr');
                        var row = api.row(tr_n);
                        $(this).parent().find('a').removeClass('active');
                        if (row.child.isShown()) {
                            row.child.hide("slow");
                        }
                        swal({
                            title: "Estas seguro?",
                            text: `El usuario será restaurado y pasará al listado de profesores actuales.<br><br>`,
                            html: true,
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Si, restaurar!",
                            closeOnConfirm: false
                        },
                            function () {
                                Pace.track(function () {
                                    // Ajax request
                                    $.ajax({
                                        url: '/admin/user/restore/' + id,
                                        type: 'GET',
                                        dataType: 'JSON',
                                        beforeSend: function () {
                                            swal.disableButtons();
                                        },
                                        success: function (json) {
                                            if (json.response == "ok") {
                                                swal("Restaurado!", "El usuario ahora se encuentra en el listadi de profesores actuales.", "success");
                                                table = $("#table-list-users").DataTable();
                                                table.ajax.reload();
                                            }
                                        },
                                        error: function (jqXHR) {
                                            Utils.displayErrors(jqXHR);
                                        }
                                    })
                                })
                                // /.PACE
                            })
                        // /.FUNCTION
                    });
                })
            },
            initComplete: function (settings, json) {
                var api = this.api();
                // FILTRO
                $(".users-list-items").find('[type=search]').removeClass("input-sm")
                    .css({
                        "width": "100%",
                        "margin-left": 0
                    })
                    .parents("label").css({
                        "width": "100%"
                    });
                // SELECTS
                var toggleSearch = `
                            <select name="selectUser" class="form-control" id="selectUser" style="width:100%;">
                                <option value="all">Profesores actuales</option>
                                <option value="history">Historial de profesores</option>
                            </select>`;
                $("#searchFilterUsers").html(toggleSearch);
                $("#selectUser").select2();
                $("#selectUser").on('change', function (e) {
                    var type = e.target.value;
                    var url = `/admin/user/${type}`;
                    api.ajax.url(url).load();
                });
            },
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
                emptyTable:     "No hay usuarios registrados por usted",
                info:           "Mostrando _START_ a _END_ de _TOTAL_ registros",
                infoEmpty:      "Mostrando 0 a 0 de 0 registros",
                zeroRecords:    "No hay usuarios registrados...",
                search: "",
                searchPlaceholder: "Buscar...",
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
                    className: 'user-list text-right',
                    data: null,
                    render: function(data, type, row) {
                        var gender = 'man';
                        if(row.gender == 0) {
                            gender = 'woman';
                        }
                        var phones = 'N/R';
                        if(row.phones.length > 0) {
                            phones = '';
                            if(row.phones.length > 1){
                                $.each(row.phones, function(k, phone) {
                                    phones += '(' + phone.code.code + ') ' + phone.number + ', '
                                })                            
                            }else{
                                $.each(row.phones, function(k, phone) {
                                    phones += '(' + phone.code.code + ') ' + phone.number + '. '
                                })
                            }
                        }
                        var status = 'N/R';
                        if(parseInt(row.status) == 0) {
                            status = '<i class="fa fa-circle text-success" data-toggle="tooltip" data-placement="top" data-containter="body" data-title="Activo"></i>';
                        }else if(parseInt(row.status) == 1) {
                            status = '<i class="fa fa-circle text-warning" data-toggle="tooltip" data-placement="top" data-containter="body" data-title="Pendiente"></i>';
                        }else if(parseInt(row.status) == 2) {
                            status = '<i class="fa fa-circle text-danger" data-toggle="tooltip" data-placement="top" data-containter="body" data-title="Suspendido"></i>';
                        }
                        if (row.deleted_at != null) {
                            status = '<i class="fa fa-circle text-danger" data-toggle="tooltip" data-placement="top" data-containter="body" data-title="Inactivo"></i>';
                        }
                        return '<div class="media">'
                        + '<div class="media-left">'
                        + '<a href="#">'
                        // + '<img class="media-object" src="/assets/images/'+gender+'_user_icon.png" alt="'+row.firstname+'" style="width:54px;">'
                        + '<img class="media-object" src="/assets/images/default-user-image.png" alt="'+row.firstname+'" style="width:54px;">'
                        + '</a>'
                        + '</div>'
                        + '<div class="media-body style-body">'
                            + `<div class="media-heading p-user-name"><strong>${row.firstname.capitalize()} ${row.primary_lastname.capitalize()}</strong> <span class="icon-status">${status}</span>&nbsp;<small><span class="label label-info">(${row.role.role})</span>&nbsp;&nbsp;${(row.deleted_at != null) ? '<span class="label label-danger">Inactivo</span>' : '' }</small></div>`
                        + '<div class="p-data"><strong>CÉDULA: </strong><span>'+ row.ci +'</span>. <strong>DIR: </strong><span>'+ row.address +', '+ row.locality +', '+ row.province +'</span></div>'
                            + '<div class="p-data"><strong>EMAIL: </strong><span>' + row.email + '</span>. <strong>TELF(S): </strong><span>' + phones +'</span> </div>'
                        + '<div class="p-data"><strong>SEDE: </strong><span>'+ row.sede.nombsede +'</span></div>'
                        + '</div>'
                        + '</div>';
                    }
                },
                {
                    className: 'p-actions',
                    data: null,
                    render: function(data, type, row) {
                        var actions = "<a href='#!' class='btn btn-default btn-xs btn-action btn-load-usuario' data-id='"+ row.id +"' data-toggle='tooltip' data-placement='top' data-title='Ver detalles del usuario'><i class='fa fa-eye'></i></a>"
                            + `<a href='#!' class='btn btn-warning btn-xs btn-action btn-edit-usuario ${(row.deleted_at != null) ? 'disabled' : ''}' data-id='${(row.deleted_at != null) ? '' : row.id}' data-toggle='tooltip' data-placement='top' data-title='Editar usuario'><i class='fa fa-pencil'></i></a>`;
                        if(parseInt(row.status) == 0) {
                            actions += `<a href='#!' class='btn btn-danger btn-xs btn-action btn-suspend-usuario ${(row.deleted_at != null) ? 'disabled' : ''}' data-id='${(row.deleted_at != null) ? '' :  row.id}' data-toggle='tooltip' data-placement='top' data-title='Suspender usuario'><i class='fa fa-power-off'></i></a>`;
                        }else if(parseInt(row.status) != 0 && parseInt(row.status) != 1) {
                            actions += `<a href='#!' class='btn btn-success btn-xs btn-action btn-active-usuario ${(row.deleted_at != null) ? 'disabled' : ''}' data-id='${(row.deleted_at != null) ? '' : row.id}' data-toggle='tooltip' data-placement='top' data-title='Activar usuario'><i class='fa fa-power-off'></i></a>`;
                        }
                        actions += `
                        <a href='#!' class='btn btn-danger btn-xs btn-action btn-delete-usuario ${(row.deleted_at != null) ? 'disabled' : ''}' data-id='${(row.deleted_at != null) ? '' : row.id}' data-toggle='tooltip' data-placement='top' data-title='Enviar a la papelera'><i class='fa fa-trash'></i></a>
                        `;
                        if (row.deleted_at != null) {
                            actions += `<a href='#!' class='btn btn-default btn-xs btn-action btn-restore-usuario' data-id='${row.id}' data-toggle='tooltip' data-placement='top' data-title='Restaurar usuario'><i class='fa fa-undo'></i></a>`;
                        } else {
                            actions += `<a href='#!' class='btn btn-default btn-xs btn-action btn-archive-usuario' data-id='${row.id}' data-toggle='tooltip' data-placement='top' data-title='Archivar usuario'><i class='fa fa-archive'></i></a>`;
                        }
                        return actions;
                    }
                }
            ]
        })
    })

    function show_view_usuario(data) {
        
        if(Object.keys(data).length > 0) {
            var date_birth = (data.date_birth) ? moment(data.date_birth).format('DD/MM/YYYY') : 'N/R';
            var status = 'N/R';
            if(parseInt(data.status) == 0) {
                status = 'Activo';
            }else if(parseInt(data.status) == 1){
                status = 'Pendiente';
            }else if(parseInt(data.status) == 2){
                status = 'Suspendido';
            }
            var gender = '';
            if(parseInt(data.gender) == 0) {
                gender = 'Femenino';
            }else if(parseInt(data.gender) == 1){
                gender = 'Masculino';
            }
            var proyecto = 'N/R';
            if(data.proyecto) {
                if(data.proyecto_id != null) {
                    proyecto = data.proyecto.nombre_proyecto;
                }
            }
            var speciality = 'N/R';
            if(data.especialidad) {
                speciality = data.especialidad;
            }
            var proyectos = '<span style="color:red;">NO POSEE PROYECTOS REGISTRADOS.</span>';
            if (data.proyectos.length) {
                proyectos = '<ul>';
                $.each(data.proyectos, function (x, proyecto) {
                    proyectos += `<li>${proyecto.nombre_proyecto}</li>`;
                })
                proyectos += '</ul>';
            }

            var box = '<div class="view_html" style="display: none;">'
                box += '<table class="table table-condensed table-bordered" style="margin-bottom:-1px;">'+
                        '<tr class="view_info">'+
                            '<td colspan="4" style="font-weight:bold;text-align:center;">OTROS DATOS DEL USUARIO</td>'+
                        '</tr>'+
                        '<tr class="view_info">'+
                            '<td style="font-weight:bold;text-align:left;">Especialidad:</td>'+
                            '<td style="font-weight:bold;text-align:left;">Fecha de nacimiento:</td>'+
                            '<td style="font-weight:bold;text-align:left;">Género:</td>'+
                            '<td style="font-weight:bold;text-align:left;">Status:</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td>'+ speciality +'</td>'+
                            '<td>'+ date_birth +'</td>'+
                            '<td>'+ gender +'</td>'+
                            '<td>'+ status +'</td>'+
                        '</tr>'+
                        `
                        <tr class="view_info">
                            <td colspan="4" style="font-weight:bold;text-align:center;">PROYECTOS</td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                ${proyectos}
                            </td>
                        </tr>
                        `
                        '</table>'+
                    '</div>';
            return box;
        }else{
            return;
        }
    }

    // Hiden modal edit user
    $('#editUser').on('hide.bs.modal', function() {
        $(this).find('form').trigger('reset');
        // $(this).find('form').find("[name='codes[]']").children().removeAttr('selected');
        $(this).find('.optional-plus-phones').html("");
    })

    // Activate link
    var url = $("#url-active").data("url-active");
    global.url_active(url);
})
//# sourceMappingURL=users_list.js.map
