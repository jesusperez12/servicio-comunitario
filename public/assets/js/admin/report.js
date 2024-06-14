var Report = (function () {
    var el = {
        form: 'form-new-report',
        fProyecto: 'proyecto',
        fFecha: 'fecha',
        fDuracion: 'duracion',
        fDetalle: 'detalle',
        btnArc: 'btn_arc',
        btnAbc: 'btn_abc',
        numericInput: 'numeric_input'
    }
    var tables = [];
    var editor = CKEDITOR.instances;
    var configEditor = '/assets/js/customs/ckeditor_add_project_config.js';

    var dom = {
        form: $("#" + el.form),
        fProyecto: $("#" + el.fProyecto),
        fFecha: $("#" + el.fFecha),
        fDuracion: $("#" + el.fDuracion),
        editor: CKEDITOR.instances,
        btnArc: $("#"+el.btnArc),
        btnAbc: $("#"+el.btnAbc),
        numericInput: $("."+el.numericInput)
    }

    var events = {
        sendContentUpload: function(evt) {
            var fileLoader = evt.data.fileLoader,
            formData = new FormData(),
            xhr = fileLoader.xhr;

            xhr.open( 'POST', fileLoader.uploadUrl, true );
            xhr.setRequestHeader( 'X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content') );
            xhr.withCredentials = true;
            formData.append( 'upload', fileLoader.file, fileLoader.fileName );
            fileLoader.xhr.send( formData );

            // Prevented the default behavior.
            evt.stop();
        },
        addRecurso: function (evt) {
            var elm = $($(".recurso-element")[0]).clone();
            var btn_remove = `<div class="row recurso-element-cloned">
                <div class="col-xs-12">
                <button type="button" class="close btn-remove-recurso" style="font-size:12px;"><i class="fa fa-remove"></i></button>
                </div>
                </div>`;
            $(btn_remove).prependTo(elm);
            elm.find("input").val("");
            var count = $(".recurso-element").find('.recursos').length;
            elm.find("input").attr("id", "recurso_" + (count + 1));
            elm.find('label.error').attr({
                "id": "recurso_" + (count + 1) + "-error",
                "for": "recurso_" + (count + 1)
            })

            $(elm).appendTo(".box-recurso-element");

            // Action remove
            $(".btn-remove-recurso").off('click').on('click', function (e) {
                $(this).parents("div.recurso-element").remove();
            })
            // Add validate
            var resources = $(".recursos");
            $.each(resources, function (x, input) {
                $(input).rules('add', {
                    required: true,
                    lettersOnly: true
                })
            })
        },
        addBeneficiario: function (evt) {
            var elm = $($(".beneficiario-element")[0]).clone();
            var btn_remove = `<div class="row beneficiario-element-cloned">
                <div class="col-xs-12">
                <button type="button" class="close btn-remove-beneficiario" style="font-size:12px;"><i class="fa fa-remove"></i></button>
                </div>
                </div>`;
            $(btn_remove).prependTo(elm);
            elm.find("input").val("");
            var count = $(".beneficiario-element").find('.beneficiarios').length;
            elm.find("input").attr("id", "beneficiario_" + (count + 1));
            elm.find('label.error').attr({
                "id": "beneficiario_" + (count + 1) + "-error",
                "for": "beneficiario_" + (count + 1)
            })

            $(elm).appendTo(".box-beneficiario-element");

            // Action remove
            $(".btn-remove-beneficiario").off('click').on('click', function (e) {
                $(this).parents("div.beneficiario-element").remove();
            })
            // Add validate
            var resources = $(".beneficiarios");
            $.each(resources, function (x, input) {
                $(input).rules('add', {
                    required: true,
                    lettersOnly: true
                })
                $(input).numeric_input({
                    decimal: '.',
                    numberOfDecimals: null
                });
            })
        }
    }

    var suscribeEvents = function () {
        editor.detalle.on( 'fileUploadRequest', events.sendContentUpload);
        dom.btnArc.on('click', events.addRecurso);
        dom.btnAbc.on('click', events.addBeneficiario);
    }

    var initFnForm = function () {
        dom.fProyecto.select2({
            placeholder: 'Seleccione...',
            // minimumResultsForSearch: 'Infinity'
        });
        dom.fFecha.datepicker({
            language: 'es',
            format: 'dd/mm/yyyy',
            autoclose: true
        });
        dom.fFechaComponent = dom.fFecha.data('datepicker');

        dom.fDuracion.ionRangeSlider({
            grid: true,
            from: 1,
            postfix: 'h',
            values: ["1", "2", "3", "4", "5", "6", "7", "8"]
        });

        dom.fDuracionComponent = dom.fDuracion.data('ionRangeSlider');

        dom.numericInput.numeric_input({
            decimal: '.',
            numberOfDecimals: null
        });

        $('div.alert').delay(5000).slideUp(300);
    }

    var assignProviderFun = function (group_id, provider_id, action) {
        var data = JSON.parse($("#form-assign-providers").find("#ls-groups-" + group_id)[0].dataset['lsGroups-' + group_id]);
        if(action == 'add') {
            data.push(provider_id);
        }else{
            var index = data.map(function (v) {
                return v;
            }).indexOf(provider_id);

            if (index > -1) {
                data.splice(index, 1);
            }
        }

        $("#form-assign-providers").find("#ls-groups-" + group_id)[0].dataset["lsGroups-" + group_id] = JSON.stringify(data);
    }

    var sumHrsComunitarias = function (row, hrs, action) {
        var cell = $(row[0].cells[2]);
        var hrs_activity = $("#form-assign-providers").find('#hrs_comunitarias').val();
        if(action == 'add'){
            cell.text((parseFloat(hrs_activity) + parseFloat(hrs)).toFixed(1));
        }else{
            cell.text(hrs);
        }
    }

    var validate = {
        callback: function (form) {
            if (dom.editor.detalle.getData() != "") {
                var periodo_id = dom.form.find('#proyecto').find(':selected').data('periodo-id');
                var pup_id = dom.form.find('#proyecto').find(':selected').data('pup-id');
                var data = dom.form.serialize() + "&" + $.param({ pup_id: pup_id, periodo_id: periodo_id, detalle: dom.editor.detalle.getData() });
                var rq = $.ajax({
                    url: "/admin/profesor/service/reporte/nuevo",
                    data: data,
                    type: "POST",
                    dataType: "JSON"
                })
                .done(function (rs) {
                    if (rs.response == "ok") {
                        dom.form.trigger("reset");
                        dom.editor.detalle.setData(null);
                        dom.fFecha.datepicker('update','');
                        dom.fDuracionComponent.reset();

                        $("#form-assign-providers").find('[name=pup_id]').val(rs.pup_id);
                        $("#form-assign-providers").find('#nombre-actividad').text(rs.actividad);
                        $("#form-assign-providers").find('#nombre-proyecto').text(rs.project.nombre_proyecto);
                        $("#form-assign-providers").find('#duracion-actividad').text(rs.duracion_actividad + ' hr(s)');
                        $("#form-assign-providers").find('#hrs_comunitarias').val(rs.duracion_actividad);
                        
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
                        var input = '';
                        $.each(rs.groups, function (x, g) {
                            var tab; 
                            if(x == 0) {
                                tab = `<li class="my-tab-group-li active"><a id="my-tab-group-${g.id}" class="my-tab-group" href="#tab_${g.id}" data-toggle="tab" aria-expanded="true">Grupo ${g.grupo}</a></li>`;
                            }else{
                                tab = `<li class="my-tab-group-li"><a id="my-tab-group-${g.id}" class="my-tab-group" href="#tab_${g.id}" data-toggle="tab" aria-expanded="true">Grupo ${g.grupo}</a></li>`;
                            }

                            // ADD TABS
                            $("#group-tabs").append(tab);

                            // ./LOAD LIST FOR PROVIDERS
                            var headTable;
                            if(x == 0) {
                                headTable = `<div class="tab-pane content-table active" id="tab_${g.id}">
                                            <table id="table-${g.id}" class="table table-bordered table-prestadores-bordered table-condensed" style="font-size: 12px;">
                                                <thead>
                                                    <th style="width:115px;padding-right:5px;">Nº de cédula</th>
                                                    <th style="width:142px;">Prestador de servicio</th>
                                                    <th style="width:143px;">Horas de servicio</th>
                                                    <th style="width:35px;"></th>
                                                </thead>
                                            </table>
                                            </div>`;
                            }else{
                                headTable = `<div class="tab-pane content-table" id="tab_${g.id}">
                                            <table id="table-${g.id}" class="table table-bordered table-prestadores-bordered table-condensed" style="font-size: 12px;">
                                                <thead>
                                                    <th style="width:115px;padding-right:5px;">Nº de cédula</th>
                                                    <th style="width:142px;">Prestador de servicio</th>
                                                    <th style="width:143px;">Horas de servicio</th>
                                                    <th style="width:35px;"></th>
                                                </thead>
                                            </table>
                                            </div>`;
                            }

                            $("#group-tabs-content").append(headTable);

                            // ./SET INPUT HIDDEN DATA LIST GROUPS
                            input += `<input type="hidden" class="ls-groups" id="ls-groups-${g.id}" data-ls-groups-${g.id}="[]">`;

                            // ./REQUEST LIST PROVIDERS
                            if(x == 0) {
                                Pace.track(function () {
                                    tables[x] = $("#table-" + g.id).DataTable({
                                        ajax: '/admin/profesor/service/myprojects/providers/group/' + g.id,
                                        drawCallback: function (settings) {
                                            var api_ = this.api();
                                            $.each(api_.rows().nodes(), function (x, tr) {
                                                // FUNCTION ASSIGN PRESTADOR
                                                $(tr).find('.assign_provider_check').on('click', function () {
                                                    var row = $(this).parents('tr');
                                                    var groupId = $(this).data('group-id');
                                                    var providerId = $(this).data('provider-id');
                                                    var hrsComunitarias = $(this).data('hrs-comunitarias');
                                                    if($(this).is(":checked")) {
                                                        assignProviderFun(groupId, providerId, 'add');
                                                        sumHrsComunitarias(row, hrsComunitarias, 'add');
                                                    }else{
                                                        assignProviderFun(groupId, providerId, 'remove');
                                                        sumHrsComunitarias(row, hrsComunitarias, 'remove');
                                                    }
                                                });
                                            })
                                        },
                                        ordering: false,
                                        paging: false,
                                        pagingType: "simple_numbers",
                                        pageLength: 10,
                                        lengthChange: false,
                                        searching: false,
                                        info: false,
                                        displayStart: 0,
                                        autoWidth: false,
                                        language: {
                                            loadingRecords: "Cargando...",
                                            emptyTable: "No se han registrado prestadores de servicio en este proyecto",
                                            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                                            infoEmpty: "Mostrando 0 a 0 de 0 registros",
                                            zeroRecords: "No hay prestadores de servicio registrados...",
                                            search: "",
                                            searchPlaceholder: "Buscar en lista de roles...",
                                            infoFiltered: " - filtrado para _MAX_ registros",
                                            paginate: {
                                                first: "Primero",
                                                last: "Último",
                                                next: "Siguiente",
                                                previous: "Anterior"
                                            }
                                        },
                                        columns: [
                                            { data: 'ci' },
                                            {
                                                data: null,
                                                render: function (data, type, row) {
                                                    return `${row.firstname} ${(row.middlename) ? row.middlename : ''}, ${row.primary_lastname} ${(row.second_lastname ? row.second_lastname : '')}`;
                                                }
                                            },
                                            {
                                                data: 'hrs_comunitarias'
                                            },
                                            {
                                                className: 'box-actions-center',
                                                data: null,
                                                render: function (data, type, row) {
                                                    return `<input data-hrs-comunitarias="${row.hrs_comunitarias}" data-provider-id="${row.id}" data-group-id="${g.id}" type="checkbox" name="assign_provider_check" class="assign_provider_check">`;
                                                }
                                            }
                                        ]
                                    });
                                })
                            }else{
                                $("#my-tab-group-" + g.id).one('click', function () {
                                    Pace.track(function () {
                                        tables[x] = $("#table-" + g.id).DataTable({
                                            ajax: '/admin/profesor/service/myprojects/providers/group/' + g.id,
                                            drawCallback: function (settings) {
                                                var api_ = this.api();
                                                $.each(api_.rows().nodes(), function (x, tr) {
                                                    // FUNCTION ASSIGN PRESTADOR
                                                    $(tr).find('.assign_provider_check').on('click', function () {
                                                        var row = $(this).parents('tr');
                                                        var groupId = $(this).data('group-id');
                                                        var providerId = $(this).data('provider-id');
                                                        var hrsComunitarias = $(this).data('hrs-comunitarias');
                                                        if ($(this).is(":checked")) {
                                                            assignProviderFun(groupId, providerId, 'add');
                                                            sumHrsComunitarias(row, hrsComunitarias, 'add');
                                                        } else {
                                                            assignProviderFun(groupId, providerId, 'remove');
                                                            sumHrsComunitarias(row, hrsComunitarias, 'remove');
                                                        }
                                                    });
                                                })
                                            },
                                            ordering: false,
                                            paging: false,
                                            pagingType: "simple_numbers",
                                            pageLength: 8,
                                            lengthChange: false,
                                            searching: false,
                                            info: false,
                                            displayStart: 0,
                                            autoWidth: false,
                                            language: {
                                                loadingRecords: "Cargando...",
                                                emptyTable: "No se han registrado prestadores de servicio en este proyecto",
                                                info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                                                infoEmpty: "Mostrando 0 a 0 de 0 registros",
                                                zeroRecords: "No hay prestadores de servicio registrados...",
                                                search: "",
                                                searchPlaceholder: "Buscar en lista de roles...",
                                                infoFiltered: " - filtrado para _MAX_ registros",
                                                paginate: {
                                                    first: "Primero",
                                                    last: "Último",
                                                    next: "Siguiente",
                                                    previous: "Anterior"
                                                }
                                            },
                                            columns: [
                                                { data: 'ci' },
                                                {
                                                    data: null,
                                                    render: function (data, type, row) {
                                                        return `${row.firstname} ${(row.middlename) ? row.middlename : ''}, ${row.primary_lastname} ${(row.second_lastname) ? row.second_lastname : ''}`;
                                                    }
                                                },
                                                {
                                                    data: 'hrs_comunitarias'
                                                },
                                                {
                                                    className: 'box-actions-center',
                                                    data: null,
                                                    render: function (data, type, row) {
                                                        return `<input data-hrs-comunitarias="${row.hrs_comunitarias}" data-provider-id="${row.id}" data-group-id="${g.id}" type="checkbox" name="assign_provider_check" class="assign_provider_check">`;
                                                    }
                                                }
                                            ]
                                        });
                                    })
                                })
                            }
                        })

                        // ./SET INPUT HIDDEN DATA LIST GROUPS
                        $("#data-list-group").html(input);

                        // ./SHOW MODAL
                        $("#assignProvidersToActivity").modal({
                            show: true,
                            backdrop: 'static',
                            keyboard: false
                        })

                        $("#assignProvidersToActivity").on('hide.bs.modal', function(){
                            $("#group-tabs, #group-tabs-content, #data-list-group").html("");
                        })

                        // ./SAVE ASSIGN PROVIDERS TO ACTIVITY
                        $("#form-assign-providers").validate({
                            submitHandler: function(form) {
                                $("#assignProvidersToActivity").find("#btn-save-assing-provider").attr('disabled', true);
                                var lsGroups = $(form).find(".ls-groups");
                                var pup_id = $(form).find("[name=pup_id]").val();
                                var providersList = [];
                                $.each(lsGroups, function(k, entry){
                                    var group = $(entry).attr('id').split('-');
                                    var providers = JSON.parse($(entry)[0].dataset['lsGroups-' + group[2]]);
                                    providersList.push({pup_id: pup_id, group_id: group[2], providers: providers});
                                })
                                
                                var providersListReq = $.ajax({
                                    url: "/admin/profesor/service/reporte/assign/providers",
                                    data: {
                                        pup_id: pup_id,
                                        dataProvidersList: providersList
                                    },
                                    type: "POST",
                                    dataType: "JSON"
                                })
                                .done(function (rs) {
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

                                        setTimeout(function(){
                                            $("#assignProvidersToActivity").find("#btn-save-assing-provider").attr('disabled', false);
                                            window.location = rs.url
                                        }, 1500);
                                    }
                                }) 
                                .fail(function (jqXHR, textStatus) {
                                    console.log(jqXHR);
                                    console.log(textStatus);
                                    $("#assignProvidersToActivity").find("#btn-save-assing-provider").attr('disabled', false);
                                })
                            }
                        })
                    }
                })
                .fail(function (jqXHR, textStatus) {
                    var errors = [];
                    if (jqXHR.responseJSON) {
                        $.each(jqXHR.responseJSON, function (x, error) {
                            $.each(error, function (x, o) {
                                errors.push(o);
                            })
                        })

                        if (errors.length > 0) {
                            var html, title;
                            if(errors.length > 1) {
                                title = 'Han ocurrido los siguientes errores';
                                html = '<ul>';
                                $.each(errors, function (x, e) {
                                    html += '<li style="list-style:square;text-align:left;margin-bottom:8px;color:red;">'
                                        + e;
                                    + '</li>';
                                })
                                html += '</ul>';
                            }else{
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
            }else{
                noty({
                    text: "El detalle de la actividad es obligatorio.",
                    type: 'error',
                    theme: "relax",
                    timeout: 2000, // [integer|boolean] delay for closing event in milliseconds. Set false for sticky notifications
                    progressBar: true, // [boolean] - displays a progress bar
                    template: '<div class="noty_message"><span class="fa fa-check"></span> <span class="noty_text"></span><div class="noty_close"></div></div>',
                    animation: {
                        open: 'animated bounceInDown', // Animate.css class names
                        close: 'animated bounceOutUp', // Animate.css class names
                        easing: 'swing', // unavailable - no need
                        speed: 500 // unavailable - no need
                    }
                })
            }
        },
        rules: {
            proyecto: {
                required: true
            },
            fecha: {
                required: true,
                validDate: true
            },
            direccion: {
                required: true,
                maxlength: 150
            },
            actividad: {
                required: true,
                maxlength: 255
            },
            duracion: {
                required: true,
                number: true
            },
            impacto: {
                required: true,
                maxlength: 255
            },
            'recursos[]': {
                required: true
            },
            'tipo_recurso[]': {
                required: true
            },
            'beneficiarios[]': {
                required: true
            },
            'tipo_beneficiario[]': {
                required: true
            },
        }
    }

    var initEditor = function () {
        CKEDITOR.replace(el.fDetalle, { customConfig: configEditor });
    }

    var initializer= function () {
        initFnForm();
        initEditor();
        suscribeEvents();
        Utils.initValidateForm(dom.form[0], validate.callback, validate.rules);
    }

    return {
        initializer: initializer
    }

})()

$(document).ready(function() {
    Report.initializer();
})
//# sourceMappingURL=report.js.map
