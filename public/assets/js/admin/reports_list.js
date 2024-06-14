$(document).ready(function() {
    
    var table_list_reports = null;
    var table_p_red = null;
    Pace.track(function() {
        table_list_reports = $("#table-my-list-reports").DataTable({
            ajax: '/admin/profesor/api/service/reports',
            dom: `<'row'<'col-sm-6 reports-list-items'f><'col-sm-6'<'#btn_actions_ls_activities.pull-right'>>>
                  <'row'<'col-sm-12'tr>>
                  <'row'<'col-sm-5'i><'col-sm-7'p>>`,
            initComplete: function(settings) {
                $("#btn_actions_ls_activities").html('<a href="../service/reporte/nuevo" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i> &nbsp;Reportar actividad</a>');
            },
            drawCallback: function(settings) {
                var api = this.api();
                $.each(api.rows().nodes(), function(x, tr){
                    $(tr).find('[data-toggle=tooltip]').tooltip();
                    // FUNCTION DETALLES DE LA ACTIVIDAD
                    $(tr).find('.btn-view-report').off('click').on('click', function(e) {
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
                        row.child( show_view_report(row.data()) ).show();
                        tr_n.next().find(".view_html").slideDown(200);
                        tr_n.next().find('td').first().css({ 'border-top': '2px solid #4879BE', 'border-bottom': '2px solid #4879BE', 'background-color':'lightgoldenrodyellow' });
                    });
                    // FUNCTION DELETE ACTIVIDAD
                    $(tr).find('.btn-delete-report').off('click').on('click', function(e) {
                        e.preventDefault();
                        var id = $(this).data('id');

                        swal({
                            title: "Estas seguro?",
                            text: "¿ Realmente deseas eliminar esta actividad ?.<br><br><p class='sugerencia_error'>Recuerda, si la actividad tiene 24h o más de creada, no puede ser eliminada.<p><br><br>",
                            type: "warning",
                            html: true,
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Si, eliminar!",
                            closeOnConfirm: false
                        },
                        function () {
                            Pace.track(function () {
                                // Ajax request
                                $.ajax({
                                    url: '/admin/profesor/service/reporte/delete/' + id,
                                    type: 'GET',
                                    dataType: 'JSON',
                                    beforeSend: function () {
                                        swal.disableButtons();
                                    },
                                    success: function (json) {
                                        if (json.response == "ok") {
                                            swal("Eliminado!", "La actividad se ha eliminado con éxito.", "success");
                                            api.ajax.reload();
                                        }
                                    },
                                    error: function (jqXHR) {
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
                    });
                })
            },
            ordering : false,
            pagingType: "simple_numbers",
            pageLength: 10,
            lengthChange: false,
            searching: true,
            info: true,
            displayStart: 0,
            autoWidth: false,
            language: {
                loadingRecords: "Cargando...",
                emptyTable:     "No hay registro de actividades",
                info:           "Mostrando _START_ a _END_ de _TOTAL_ registros",
                infoEmpty:      "Mostrando 0 a 0 de 0 registros",
                zeroRecords:    "No se encontraron actividades...",
                search: "",
                searchPlaceholder: "Buscar en lista de actividades...",
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
                    data: 'fecha'
                },
                {
                    className: 'xS',
                    data: 'actividad'
                },
                {
                    data: 'hrs',
                    render: function(data, type, row) {
                        if(parseFloat(row.hrs) > 1.0) {
                            return row.hrs + ' Hrs.'
                        }else{
                            return row.hrs + ' Hr.'
                        }
                    }
                },
                {
                    data: 'periodo.corte'
                },
                {
                    className: 'p-actions text-center',
                    data: null,
                    render: function(data, type, row) {
                        var actions = `<a href='#!' class='btn btn-default btn-xs btn-action btn-view-report' data-id='${row.id}' data-toggle='tooltip' data-placement='top' data-title='Vista previa'><i class='fa fa-eye'></i></a>
                                       <a href='../service/reporte/edit/${row.id}/proyecto/${row.proyecto.id}/periodo/${row.periodo.id}' class='btn btn-warning btn-xs btn-action btn-edit-report' data-id='${row.id}' data-toggle='tooltip' data-placement='top' data-title='Editar actividad'><i class='fa fa-pencil'></i></a>
                                       <a href='#!' class='btn btn-danger btn-xs btn-action btn-delete-report' data-id='${row.id}' data-toggle='tooltip' data-placement='top' data-title='Remover actividad'><i class='fa fa-trash'></i></a>`;
                        return actions;
                    }
                },
            ]
        })
    })

    function show_view_report(data) {
        if(Object.keys(data).length > 0) {
            var box = `<div class="view_html" style="display: none;">
                    <dl style="margin-bottom:5px;">
                        <dt>Proyecto comunitario:</dt>
                        <dd>${data.proyecto.nombre_proyecto}</dd>
                        <dt>Nombre de la actividad:</dt>
                        <dd>${data.actividad}</dd>
                        <dt>Dirección:</dt>
                        <dd>${data.direccion}</dd>
                        <dt>Impacto o alcance:</dt>
                        <dd>${data.impacto_gen}</dd>
                    </dl>
                    </div>`;
            return box;
        }else{
            return;
        }
    }

    // Activate link
    var url = $("#url-active").data("url-active");
    global.url_active(url);
})
//# sourceMappingURL=reports_list.js.map
