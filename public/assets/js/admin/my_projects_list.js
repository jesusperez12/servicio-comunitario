$(document).ready(function() {
    var table_list_projects = null;
    var tables = [];
    Pace.track(function() {
        table_list_projects = $("#table-my-list-projects").DataTable({
            ajax: '/admin/profesor/service/myprojects/all',
            dom: `<'row'<'col-sm-6 reports-list-items'f><'col-sm-6'<'#searchFilterPeriodo'>>>
                  <'row'<'col-sm-12'tr>>
                  <'row'<'col-sm-5'i><'col-sm-7'p>>`,
            initComplete: function(settings) {
                var api = this.api();
                var searchPeriodo = `<div class="form-group select-periodos">
                            <select name="periodo" class="form-control" id="periodo" style="width:100%;"></select>
                        </div>`;
                $("#searchFilterPeriodo").html(searchPeriodo);
                var data = $("#ls-periodos-user").data('ls-periodos-user');
                // PREPARE DATA
                var options = [{ id: 'all', text: 'Todos' }];
                $.each(data, function (k, v) {
                    options.push({id: v.id, text: v.corte});
                })
                $("#periodo").select2({
                    data: options
                })
                $("#periodo").on('change', function (e) {
                    var periodo = e.target.value;
                    var url = '/admin/profesor/service/myprojects/periodo/' + periodo;
                    api.ajax.url(url).load();
                });
            },
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
                    // FUNCTION LOAD LIST PROVIDERS
                    $(tr).find('.btn-load-list-providers').off('click').on('click', function(e) {
                        e.preventDefault();
                        var btnLoadListProviders = this;
                        var pup_id = $(this).data('pup-id');
                        var n_proyecto = $(this).data('nombre-proyecto');
                        var tr_n = $(tr).closest('tr');
                        var row = api.row( tr_n );
                        $(this).parent().find('a').removeClass('active');
                        if(row.child.isShown()){
                            row.child.hide("slow");
                        }

                        $("#form-add-list-providers").find('[name=pup_id]').val(pup_id);
                        $("#form-add-list-providers").find('#nombre-proyecto').text(n_proyecto);

                        $("#btn-add-new-providers").off().on('click', function(e) {
                            e.preventDefault();
                            var btn = '<button type="button" style="border-radius:50%;font-size:11px;" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></button>';
                            var element = $("#addListProviders").find('.row-origin').clone(true);
                            var n_tr = $("#list-new-providers").find('tbody tr').length;
                            element.removeClass('row-origin');
                            element.addClass('row-cloned');
                            element.find('input').val('').removeClass("error");
                            element.find('label.error').remove();
                            element.find('.btn-actions').html(btn);
                            element.find('.btn-actions').find('button').on('click', function(e) {
                                e.preventDefault();
                                $(this).parents('tr').remove();
                            })
                            var inputs = element.find('input');
                            $.each(inputs, function(x, input) {
                                var id = $(input).attr('id');
                                $(input).attr('id', id + "_" + (n_tr + 1));
                                if(id == 'ci') {   
                                    $(input).numeric_input({
                                        decimal: '.',
                                        numberOfDecimals: null
                                    });
                                }
                            })
                            $("#addListProviders").find('#list-new-providers tbody').append(element);
                        })

                        // SOLICITAR GRUPO O GRUPOS DE PRESTADORES
                        Pace.track(function() {
                            var rq = $.ajax({
                                url: "/admin/profesor/api/service/groups/pup/" + pup_id,
                                type: "GET",
                                dataType: "json"
                            })
                            rq.done(function(json) {
                                if(json.response == "ok") {
                                    var groups = [];
                                    $.each(json.groups, function(x, g) {
                                        var tab = `<li class="my-tab-group-li"><a id="my-tab-group-${g.id}" class="my-tab-group" href="#tab_${g.id}" data-toggle="tab" aria-expanded="true">Grupo ${g.grupo}</a></li>`;

                                        // ADD TABS
                                        $("#group-tabs").append(tab);
                                        // CREATE OBJ AUTOCOMPLETE
                                        var obj = {
                                            value: `${g.grupo}`,
                                            data: `${g.id}`
                                        }
                                        groups.push(obj);

                                        // ./LOAD LIST FOR PROVIDERS
                                        var headTable = `<div class="tab-pane content-table" id="tab_${g.id}">
                                        <table id="table-${g.id}" class="table table-bordered table-prestadores-bordered table-condensed" style="font-size: 12px;">
                                            <thead>
                                                <th style="width:115px;padding-right:5px;">Nº de cédula</th>
                                                <th style="width:142px;">Primer nombre</th>
                                                <th style="width:143px;">Segundo nombre</th>
                                                <th style="width:144px;">Primer apellido</th>
                                                <th>Segundo apellido</th>
                                                <th style="width:35px;"></th>
                                            </thead>
                                        </table>
                                        </div>`;

                                        $("#group-tabs-content").append(headTable);

                                        // ./REQUEST LIST PROVIDERS
                                        $("#my-tab-group-" + g.id).one('click', function(){
                                            Pace.track(function() {
                                                tables[x] = $("#table-" + g.id).DataTable({
                                                    ajax: '/admin/profesor/service/myprojects/providers/group/' + g.id,
                                                    drawCallback: function(settings) {
                                                        var api_ = this.api();
                                                        $.each(api_.rows().nodes(), function(x, tr){
                                                            // FUNCTION EDITAR PRESTADOR
                                                            $(tr).find('.btn-edit-provider').on('click', function() {
                                                                var providerId = $(this).data('id');
                                                                var rqEditProvider = $.ajax({
                                                                    url: '/admin/profesor/service/myprojects/provider/' + providerId,
                                                                    type: 'GET',
                                                                    dataType: 'json'
                                                                })
                                                                rqEditProvider.done(function(json) {
                                                                    var form = $("#form-edit-list-providers");
                                                                    form.find("[name=provider_id]").val(json.provider.id);
                                                                    form.find("[name=ci]").val(json.provider.ci);
                                                                    form.find("[name=firstname]").val(json.provider.firstname);
                                                                    form.find("[name=middlename]").val(json.provider.middlename);
                                                                    form.find("[name=primary_lastname]").val(json.provider.primary_lastname);
                                                                    form.find("[name=second_lastname]").val(json.provider.second_lastname);

                                                                    $("#editListProviders").modal({
                                                                        show: true,
                                                                        backdrop: 'static',
                                                                        keyboard: false
                                                                    });
                                                                    // VALIDATE FORM UPDATE PRESTADOR
                                                                    form.validate({
                                                                        submitHandler: function(form) {
                                                                            var data = $(form).serialize();
                                                                            rqUpdateProvider = $.ajax({
                                                                                url: '/admin/profesor/service/myprojects/provider/' + providerId,
                                                                                data: data,
                                                                                type: 'POST',
                                                                                dataType: 'json'
                                                                            })
                                                                            rqUpdateProvider.done(function(json) {
                                                                                console.log(json)
                                                                                if(json.response == 'ok') {
                                                                                    $("#editListProviders").modal('hide');
                                                                                    api_.ajax.reload();
                                                                                }
                                                                            })
                                                                            rqUpdateProvider.fail(function(jqXHR, textStatus) {
                                                                                Utils.displayErrors(jqXHR);
                                                                            })
                                                                        }
                                                                    })
                                                                })
                                                                rqEditProvider.fail(function(jqXHR, textStatus) {
                                                                    console.log(jqXHR);
                                                                    console.log(textStatus);
                                                                })
                                                            });

                                                            // FUNCTION REMOVER PROVIDER
                                                            $(tr).find('.btn-remove-provider').off('click').on('click', function(e) {
                                                                e.preventDefault();
                                                                var id = $(this).data('id');
                                                                swal({
                                                                    title: "Estas seguro?",
                                                                    text: "¿ Realmente desea eliminarlo ?<br><br>",
                                                                    type: "warning",
                                                                    showCancelButton: true,
                                                                    confirmButtonColor: "#DD6B55",
                                                                    confirmButtonText: "Si, eliminarlo!",
                                                                    closeOnConfirm: false
                                                                },
                                                                function(){
                                                                    Pace.track(function() {
                                                                        // Ajax request
                                                                        $.ajax({
                                                                            url: '/admin/profesor/service/myprojects/provider/delete/' + id,
                                                                            type: 'GET',
                                                                            dataType: 'JSON',
                                                                            beforeSend: function() {
                                                                                swal.disableButtons();
                                                                            },
                                                                            success: function(json) {
                                                                                if(json.response == "ok")
                                                                                {
                                                                                    swal("Eliminado!", "Se ha eliminado correctamente.", "success");
                                                                                    api_.ajax.reload();
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
                                                        })
                                                    },
                                                    ordering : false,
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
                                                        emptyTable:     "No se han registrado prestadores de servicio en este proyecto",
                                                        info:           "Mostrando _START_ a _END_ de _TOTAL_ registros",
                                                        infoEmpty:      "Mostrando 0 a 0 de 0 registros",
                                                        zeroRecords:    "No hay prestadores de servicio registrados...",
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
                                                        { data: 'ci' },
                                                        { data: 'firstname' },
                                                        { 
                                                            data: 'middlename',
                                                            render: function(data, type, row) {
                                                                if(row.middlename == null) {
                                                                    return '<span style="color:#DDD;">N/R</span>';
                                                                }else{
                                                                    return row.middlename;
                                                                }
                                                            } 
                                                        },
                                                        { data: 'primary_lastname' },
                                                        { 
                                                            data: 'second_lastname',
                                                            render: function(data, type, row) {
                                                                if(row.second_lastname == null) {
                                                                    return '<span style="color:#DDD;">N/R</span>';
                                                                }else{
                                                                    return row.second_lastname;
                                                                }
                                                            } 
                                                        },
                                                        {
                                                            className: 'box-actions',
                                                            data: null,
                                                            render: function(data, type, row) {
                                                                return '<button type="button" style="border-radius:50%;margin-right:3px;font-size:10px;" class="btn btn-warning btn-xs btn-edit-provider" data-id="'+ row.id +'" data-toggle="tooltip" data-container="body" data-title="Editar prestador de servicio"><i class="fa fa-pencil"></i></button>'
                                                                + '<button type="button" style="border-radius:50%;margin-right:3px;font-size:10px;" class="btn btn-danger btn-xs btn-remove-provider" data-id="'+ row.id +'" data-toggle="tooltip" data-container="body" data-title="Remover prestador de servicio"><i class="fa fa-remove"></i></button>';
                                                            }
                                                        }
                                                    ]
                                                });
                                            })
                                        })
                                    })
                                    
                                    // ./AUTOCOMPLETE
                                    $("#grupo").autocomplete({
                                        lookup: groups
                                    });

                                    // SHOW OR HIDE BTN SAVE PROVIDERS
                                    $("#addListProviders").find('.my-tab-group-li').on('click', function() {
                                        $("#btn-save-new-provider").hide();
                                    })
                                    $("#addListProviders").find('#btn-tab-zero').on('click', function() {
                                        $("#btn-save-new-provider").show();
                                    })
                                    
                                    // ./SHOW MODAL
                                    $("#addListProviders").modal({
                                        show: true,
                                        backdrop: 'static',
                                        keyboard: false
                                    })
                                    // EVENT HIDEN MODAL
                                    $("#addListProviders").on('hide.bs.modal', function(){
                                        $("#btn-save-new-provider").show();
                                    })
                                }
                            })
                            rq.fail(function(jqXHR, textStatus) {
                                Utils.displayErrors(jqXHR);
                            })
                        })
                    });
                    // FUNCTION REGISTRAR COMUNIDAD Y ASESOR
                    $(tr).find('.btn-register-community').off('click').on('click', function(e) {
                        e.preventDefault();
                        var id = $(this).data('id');
                        var pup_id = $(this).data('pup-id');
                        var tr_n = $(tr).closest('tr');
                        var row = api.row( tr_n );
                        if($(this).hasClass('active')) {
                            row.child.hide("slow");
                            $(this).removeClass('active');
                            $(tr).removeClass('active');
                            return;
                        }
                        $(this).parent().find('a').removeClass('active');
                        $(this).addClass('active');
                        $(tr).addClass('active');
                        if ( row.child.isShown() ) {
                            row.child.hide("slow");
                        }
                        Pace.track(function() {
                            $.ajax({
                                url: "/admin/profesor/service/myprojects/add/comunidad",
                                type: "GET",
                                dataType: "html",
                                success: function(data) {

                                    // LOAD DATA COMUNIDAD
                                    Pace.track(function() {
                                        $.ajax({
                                            url: "/admin/profesor/service/myprojects/comunidad/project/" + pup_id,
                                            type: 'GET',
                                            dataType: 'json',
                                            success: function(json) {
                                                
                                                row.child( show_form_add_community(data) ).show();
                                                tr_n.next().find(".view_html").slideDown(200);

                                                var formAsesor = tr_n.next().find(".view_html").find("#form-register-asesor")[0];
                                                var formComunity = tr_n.next().find(".view_html").find("#form-register-comunity")[0];
                                                
                                                $(formComunity.state).select2({
                                                    placeholder: 'Seleccione una estado...'
                                                });
                                                $(formComunity.province).select2({
                                                    placeholder: 'Seleccione una provincia...'
                                                });
                                                if (json.comunidad != null) {
                                                    $(formComunity.state).on('change', function (e, dataAddress) {
                                                        var value = e.target.value;
                                                        var state = e.target.options[e.target.options.selectedIndex].dataset.id
                                                        $(formComunity.province).children().remove();
                                                        $(formComunity.province).select2("destroy");
                                                        // SELECT PROVINCE FROM LOCALITY
                                                        Pace.track(function () {
                                                            var getProvinces = $.ajax({
                                                                url: '/admin/api/get/provinces/' + state,
                                                                type: 'GET',
                                                                dataType: 'json'
                                                            });
                                                            getProvinces.done(function (json) {
                                                                $(formComunity.province).select2({
                                                                    data: json.data
                                                                });
                                                                $.each($(formComunity.province).children(), function (x, op) {
                                                                    $(op).attr('data-id', json.data[x].dataId);
                                                                })
                                                                // trigger provinces
                                                                $(formComunity.province).val(dataAddress.province).trigger('change', dataAddress.locality);
                                                            })
                                                            getProvinces.fail(function (jqXHR, textStatus) {
                                                                displayErrors(jqXHR);
                                                            });
                                                        })
                                                        // ./PACE
                                                    })
                                                    $(formComunity.province).on('change', function (e, locality) {
                                                        var value = e.target.value;
                                                        var province = null;
                                                        $.each(e.target.children, function (x, option) {
                                                            if (option.value == value) {
                                                                province = $(option).data('id');
                                                            }
                                                        })
                                                        $(formComunity.locality).children().remove();
                                                        // SELECT PROVINCE FROM LOCALITY
                                                        Pace.track(function () {
                                                            var getProvinces = $.ajax({
                                                                url: '/admin/profesor/service/myprojects/comunidad/' + province,
                                                                type: 'GET',
                                                                dataType: 'json'
                                                            });
                                                            getProvinces.done(function (json) {
                                                                $(formComunity.locality).select2({
                                                                    data: json.data
                                                                });
                                                                $(formComunity.locality).val(locality).trigger('change');
                                                            })
                                                            getProvinces.fail(function (jqXHR, textStatus) {
                                                                displayErrors(jqXHR);
                                                            });
                                                        })
                                                        // ./PACE
                                                    })
                                                    // LOAD LOCALITY DEFAULT
                                                } else {
                                                    $(formComunity.state).on('change', function (e) {
                                                        var value = e.target.value;
                                                        var state = e.target.options[e.target.options.selectedIndex].dataset.id
                                                        $(formComunity.province).children().remove();
                                                        $(formComunity.province).select2("destroy");
                                                        // SELECT PROVINCE FROM LOCALITY
                                                        Pace.track(function () {
                                                            var getProvinces = $.ajax({
                                                                url: '/admin/api/get/provinces/' + state,
                                                                type: 'GET',
                                                                dataType: 'json'
                                                            });
                                                            getProvinces.done(function (json) {
                                                                $(formComunity.province).select2({
                                                                    data: json.data
                                                                });
                                                                $.each($(formComunity.province).children(), function (x, op) {
                                                                    $(op).attr('data-id', json.data[x].dataId);
                                                                })
                                                                // trigger provinces
                                                                $(formComunity.province).trigger('change');
                                                            })
                                                            getProvinces.fail(function (jqXHR, textStatus) {
                                                                displayErrors(jqXHR);
                                                            });
                                                        })
                                                        // ./PACE
                                                    })
                                                    $(formComunity.province).on('change', function(e) {
                                                        var value = e.target.value;
                                                        var province = null;
                                                        $.each(e.target.children, function(x, option) {
                                                            if(option.value == value) {
                                                                province = $(option).data('id');
                                                            }
                                                        })
                                                        $(formComunity.locality).children().remove();
                                                        // SELECT PROVINCE FROM LOCALITY
                                                        Pace.track(function() {
                                                            var getProvinces = $.ajax({
                                                                url: '/admin/profesor/service/myprojects/comunidad/' + province,
                                                                type: 'GET',
                                                                dataType: 'json'
                                                            });
                                                            getProvinces.done(function(json) {
                                                                $(formComunity.locality).select2({
                                                                    data: json.data
                                                                });
                                                            })
                                                            getProvinces.fail(function(jqXHR, textStatus) {
                                                                displayErrors(jqXHR);
                                                            });
                                                        })
                                                        // ./PACE
                                                    })
                                                    // LOAD LOCALITY DEFAULT
                                                    $(formComunity.state).trigger('change');
                                                }
                                                // VALIDATE FORMA ADD ASESOR
                                                $(formAsesor).validate({
                                                    ignore: [],
                                                    rules: {
                                                        ci: {
                                                            required: true,
                                                            number: true,
                                                            maxlength: 8,
                                                            minlength: 7
                                                        },
                                                        firstname: {
                                                            required: true,
                                                            maxlength: 50
                                                        },
                                                        middlename: {
                                                            required: false,
                                                            maxlength: 50
                                                        },
                                                        primary_lastname: {
                                                            required: true,
                                                            maxlength: 50
                                                        },
                                                        second_lastname: {
                                                            required: false,
                                                            maxlength: 50
                                                        },
                                                        'codes[]': {
                                                            required: true
                                                        },
                                                        'phones[]': {
                                                            required: true,
                                                            maxlength: 7,
                                                            minlength: 7
                                                        }
                                                    }
                                                });
                                                // VALIDATE FORM COMUNITY
                                                $(formComunity).validate({
                                                    ignore: [],
                                                    rules: {
                                                        comunidad: {
                                                            required: true,
                                                            maxlength: 255
                                                        },
                                                        direccion: {
                                                            required: true,
                                                            maxlength: 150
                                                        },
                                                        sector: {
                                                            required: false,
                                                            maxlength: 255
                                                        },
                                                        locality: {
                                                            required: true
                                                        },
                                                        province: {
                                                            required: true
                                                        },
                                                    }
                                                });

                                                $("#btn-save-asesor_comunity").on('click', function() {
                                                    var status = false;
                                                    
                                                    if($(formAsesor).valid()) {
                                                        if ($(formComunity).valid()) {
                                                            status = true
                                                        } else {
                                                            var tab = tr_n.next().find(".view_html").find("[data-toggle=tab]").parents("li").removeClass("active");
                                                            var tab = tr_n.next().find(".view_html").find("[href=\"#tab_2\"]").parents("li").addClass("active");
                                                            tr_n.next().find(".view_html").find(".tab-pane").removeClass("active");
                                                            tr_n.next().find(".view_html").find("#tab_2").addClass("active");

                                                            status = false;
                                                        }
                                                    }else{
                                                        var tab = tr_n.next().find(".view_html").find("[data-toggle=tab]").parents("li").removeClass("active");
                                                        var tab = tr_n.next().find(".view_html").find("[href=\"#tab_1\"]").parents("li").addClass("active");
                                                        tr_n.next().find(".view_html").find(".tab-pane").removeClass("active");
                                                        tr_n.next().find(".view_html").find("#tab_1").addClass("active");

                                                        status = false;
                                                    }
                                                    
                                                    if(status) {
                                                        var dataAsesor = $(formAsesor).serialize();
                                                        var dataComunity = $(formComunity).serialize();
                                                        var dataForms = dataAsesor + "&" + dataComunity;
                                                       // console.log(dataForms);
                                                        Pace.track(function () {
                                                            $.ajax({
                                                                url: "/admin/profesor/service/myprojects/comunidad",
                                                                data: dataForms,
                                                                type: 'POST',
                                                                dataType: 'JSON',
                                                                success: function (json) {
                                                                    api.ajax.reload();
                                                                    noty({
                                                                        text: "Se ha guardado correctamente",
                                                                        type: 'success',
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
                                                                },
                                                                error: function (jqXHR, textStatus) {
                                                                    displayErrors(jqXHR);
                                                                }
                                                            })
                                                        })
                                                    }
                                                });

                                                // SET DATA TO FORM
                                                $(formAsesor).find('[name=pup_id]').val(pup_id);
                                                if(json.comunidad != null) {
                                                    // SET DATOS DE COMUNIDAD
                                                    $(formAsesor).prepend('<input type="hidden" name="_method" value="PUT">');
                                                    $(formAsesor).find('[name=comunidad_id]').val(json.comunidad.id);
                                                    formComunity.comunidad.value = json.comunidad.nombre;
                                                    formComunity.direccion.value = json.comunidad.direccion;
                                                    formComunity.sector.value = json.comunidad.sector;
                                                    Pace.track(function() {
                                                        $(formComunity.state).val(json.comunidad.state).trigger('change', { locality: json.comunidad.localidad, province: json.comunidad.provincia });
                                                    })
                                                    formComunity.lugar_prestadores.value = json.comunidad.lugar_prestadores;
                                                    formComunity.direccion_lugar.value = json.comunidad.direccion_lugar;
                                                    // SET DATOS DE ASESOR COMUNITARIO
                                                    $(formAsesor).find('[name=asesor_id]').val(json.comunidad.asesor_id);
                                                    formAsesor.ci.value = json.comunidad.ci;
                                                    formAsesor.firstname.value = json.comunidad.firstname;
                                                    formAsesor.middlename.value = json.comunidad.middlename;
                                                    formAsesor.primary_lastname.value = json.comunidad.primary_lastname;
                                                    formAsesor.second_lastname.value = json.comunidad.second_lastname;
                                                    $.each(json.comunidad.phones, function(x, phone) {
                                                        if(x == 0) {
                                                            $(formAsesor).find('[name="codes[]"]').val(phone.code_id);
                                                            formAsesor.phones.value = phone.number;
                                                            $(formAsesor).find("[name='phones_id[]']").val(phone.id);
                                                        }else{
                                                            global.add_phones(phone);
                                                        }
                                                    })
                                                }else{
                                                    $(formComunity.locality).trigger('change');
                                                    tr_n.next().find(".view_html").find('#msg-alert').show();
                                                }
                                            }
                                        })
                                    })
                                }
                            })
                        })
                    });
                    // FUNCTION LOAD ACTIVITIES LIST
                    $(tr).find('.btn-load-activities').off('click').on('click', function (e) {
                        e.preventDefault();
                        var pup_id = $(this).data('pup-id');
                        var tr_n = $(tr).closest('tr');
                        var row = api.row(tr_n);
                        if ($(this).hasClass('active')) {
                            row.child.hide("slow");
                            $(this).removeClass('active');
                            return;
                        }
                        $(this).parent().find('a').removeClass('active');
                        $(this).addClass('active');
                        if (row.child.isShown()) {
                            row.child.hide("slow");
                        }

                        Pace.track(function () {
                            $.ajax({
                                url: "/admin/profesor/service/myprojects/view/activities",
                                type: "GET",
                                dataType: "html",
                                success: function (data) {
                                    // LOAD DATA ACTIVITIES LIST
                                    row.child(show_view_activities_list(data)).show();
                                    tr_n.next().find(".view_html").slideDown(200);
                                    // INIT DATATABLE
                                    tr_n.next().find(".view_html").find("#table-my-list-activities").DataTable({
                                        ajax: '/admin/profesor/api/service/reports/pup/' + pup_id,
                                        dom: `<'row'<'col-sm-6 reports-list-filter'f><'col-sm-6'>>
                                              <'row'<'col-sm-12'tr>>
                                              <'row'<'col-sm-5'i><'col-sm-7'p>>`,
                                        drawCallback: function (settings) {
                                            var api = this.api();
                                            $.each(api.rows().nodes(), function (x, tr) {
                                                $(tr).find('[data-toggle=tooltip]').tooltip();
                                                // FUNCTION DETALLES DE LA ACTIVIDAD
                                                $(tr).find('.btn-view-report').off('click').on('click', function (e) {
                                                    e.preventDefault();
                                                    var id = $(this).data('id');
                                                    var tr_n = $(tr).closest('tr');
                                                    var row = api.row(tr_n);
                                                    if ($(this).hasClass('active')) {
                                                        row.child.hide("slow");
                                                        $(this).removeClass('active');
                                                        return;
                                                    }
                                                    $(this).parent().find('a').removeClass('active');
                                                    $(this).addClass('active');
                                                    if (row.child.isShown()) {
                                                        row.child.hide("slow");
                                                    }
                                                    row.child(show_view_activity(row.data())).show();
                                                    tr_n.next().find(".view_html").slideDown(200);
                                                    tr_n.next().find('td').first().css({ 'border-top': '2px solid #4879BE', 'border-bottom': '2px solid #4879BE', 'background-color': 'lightgoldenrodyellow' });
                                                });
                                                // FUNCTION DELETE ACTIVIDAD
                                                $(tr).find('.btn-delete-report').off('click').on('click', function (e) {
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
                                        ordering: false,
                                        pagingType: "simple_numbers",
                                        pageLength: 5,
                                        lengthChange: false,
                                        searching: true,
                                        info: true,
                                        displayStart: 0,
                                        autoWidth: false,
                                        language: {
                                            loadingRecords: "Cargando...",
                                            emptyTable: "No hay registro de actividades en este proyecto",
                                            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                                            infoEmpty: "Mostrando 0 a 0 de 0 registros",
                                            zeroRecords: "No se encontraron actividades...",
                                            search: "",
                                            searchPlaceholder: "Buscar en lista de actividades...",
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
                                                data: 'fecha'
                                            },
                                            {
                                                className: 'xS',
                                                data: 'actividad'
                                            },
                                            {
                                                data: 'hrs',
                                                render: function (data, type, row) {
                                                    if (parseFloat(row.hrs) > 1.0) {
                                                        return row.hrs + ' Hrs.'
                                                    } else {
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
                                                render: function (data, type, row) {
                                                    var actions = `<a href='#!' class='btn btn-default btn-xs btn-action btn-view-report' data-id='${row.id}' data-toggle='tooltip' data-placement='top' data-title='Vista previa'><i class='fa fa-eye'></i></a>
                                                                   <a href='../service/reporte/edit/${row.id}/proyecto/${row.proyecto_id}/periodo/${row.periodo.id}' class='btn btn-warning btn-xs btn-action btn-edit-report' data-proyecto-id='${row.proyecto_id}' data-periodo-id='${row.periodo.id}' data-id='${row.id}' data-toggle='tooltip' data-placement='top' data-title='Editar actividad'><i class='fa fa-pencil'></i></a>
                                                                   <a href='#!' class='btn btn-danger btn-xs btn-action btn-delete-report' data-proyecto-id='${row.proyecto_id}' data-periodo-id='${row.periodo.id}' data-id='${row.id}' data-toggle='tooltip' data-placement='top' data-title='Remover actividad'><i class='fa fa-trash'></i></a>`;
                                                    return actions;
                                                }
                                            },
                                        ]
                                    })
                                }
                            })
                        })

                    });
                })
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
                emptyTable:     "No se le ha asignado ningun proyecto",
                info:           "Mostrando _START_ a _END_ de _TOTAL_ registros",
                infoEmpty:      "Mostrando 0 a 0 de 0 registros",
                zeroRecords:    "No se encontraron proyectos...",
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
                    className: 'project',
                    data: 'nombre_proyecto',
                    render: function(data, type, row) {
                        var comunidad = 'N/R';
                        if (row.comunidades.length) {
                            if(row.comunidades[0].nombre != null) {
                                comunidad = row.comunidades[0].nombre;
                            }
                        }
                        var project = "<div class='p-title'>"+ row.nombre_proyecto +"</div>"
                        + "<div class='p-autor'>"
                            + "<strong>Comunidad: </strong>" + comunidad + ", <strong>Horas ejecutadas: </strong>" + row.pivot.total_hours +", <strong>Corte: </strong>"+ row.periodos[0].corte;
                        project += "</div>";
                        return project;
                    }
                },
                {
                    className: 'p-actions',
                    data: null,
                    render: function(data, type, row) {
                        var actions = "<a href='#!' class='btn btn-default btn-xs btn-action btn-load-proyecto' data-id='"+ row.id +"' data-toggle='tooltip' data-placement='top' data-title='Ver detalles del proyecto'><i class='fa fa-eye'></i></a>"
                        + "<a href='#!' class='btn btn-default btn-xs btn-action btn-register-community' data-pup-id='"+ row.pivot.id +"' data-id='"+ row.id +"' data-toggle='tooltip' data-placement='top' data-title='Registrar Asesor y Comunidad'><i class='fa fa-map-marker'></i></a>"
                        + "<a href='#!' class='btn btn-primary btn-xs btn-action btn-load-list-providers' data-nombre-proyecto='"+ row.nombre_proyecto +"' data-pup-id='"+ row.pivot.id +"' data-id='"+ row.id +"' data-toggle='tooltip' data-placement='top' data-title='Cargar prestadores del servicio'><i class='fa fa-users'></i></a>"
                        + "<a href='#!' class='btn btn-success btn-xs btn-action btn-load-activities' data-pup-id='"+ row.pivot.id +"' data-toggle='tooltip' data-placement='top' data-title='Ver reportes de actividades'><i class='fa fa-list-alt'></i></a>"
                        return actions;
                    }
                },
            ]
        })
    })

    function show_view_proyecto(data) {
        if(Object.keys(data).length > 0) {
            var comunidad = '-';
            var direccion = '-';
            var lugar_prestadores = '-';
            if(data.comunidades.length) {
                comunidad = data.comunidades[0].nombre + ", " + data.comunidades[0].direccion + ", " + data.comunidades[0].sector + ", " + data.comunidades[0].localidad + ", " + data.comunidades[0].provincia;
                lugar_prestadores = data.comunidades[0].lugar_prestadores + ", " + data.comunidades[0].direccion_lugar;
            }
            var box = `<div class="view_html" style="display: none;">
                    <table class="table table-condensed table-bordered" style="margin-bottom:-1px;">
                        <tr class="view_info warning">
                            <td colspan="2" style="font-weight:bold;text-align:center;">DETALLES DEL PROYECTO</td>
                        </tr>
                        <tr class="view_info">
                            <td style="width:110px;font-weight:bold;text-align:right;">Descripción</td>
                            <td>${data.descripcion}</td>
                        </tr>
                        <tr class="view_info">
                            <td style="font-weight:bold;text-align:right;">Línea de acción</td>
                            <td>${data.linea_accion}</td>
                        </tr>
                        <tr class="view_info">
                            <td style="font-weight:bold;text-align:right;">Fundamentación</td>
                            <td>${data.fundamentacion}</td>
                        </tr>
                        <tr class="view_info">
                            <td style="font-weight:bold;text-align:right;">Propósito</td>
                            <td>${data.proposito}</td>
                        </tr>
                        <tr class="view_info">
                            <td style="font-weight:bold;text-align:right;">Competencia</td>
                            <td>${data.competencia}</td>
                        </tr>
                        <tr class="view_info">
                            <td style="font-weight:bold;text-align:right;">Metodología</td>
                            <td>${data.metodologia}</td>
                        </tr>
                        <tr class="view_info">
                            <td colspan="2">
                                <dl>
                                    <dt>Total horas de servicio:</dt>
                                    <dd>${data.pivot.total_hours} hr(s)</dd>
                                    <dt>Comunidad</dt>
                                    <dd>${comunidad}</dd>
                                    <dt>Lugar de acampamiento:</dt>
                                    <dd>${lugar_prestadores}</dd>
                                </dl>
                            </td>
                        </tr>
                        </table>
                    </div>`;
            return box;
        }else{
            return;
        }
    }

    function show_form_add_community(data) {
        if(data) {
            var box = '<div class="view_html" style="display: none;">'
            + data
            + '</div>';
            $.getScript({
                url: '/assets/js/admin/utils_community.js'
            });
            return box;
        }else{
            return;
        }

    }

    function show_view_activities_list(data) {
        if(data) {
            var box = '<div class="view_html" style="display: none;">'
            + data
            + '</div>';
            return box;
        }else{
            return;
        }

    }

    function show_view_activity(data) {
        if (Object.keys(data).length > 0) {
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
        } else {
            return;
        }
    }

    // FORM ADD PROVIDERS DYNAMIC ELEMENTS
    $("#form-add-list-providers").validate({
        submitHandler: function(form) {
            // ./RESTORE TABS ONE
            $("#form-add-list-providers").find('.tab-pane').removeClass('active');
            $("#form-add-list-providers").find('.my-tab-group-li').removeClass('active');
            $("#form-add-list-providers").find("#btn-tab-zero").addClass("active");
            $("#form-add-list-providers").find("#tab_0").addClass("active");
            var data = $(form).serialize();
            var request = $.ajax({
                url: '/admin/profesor/service/myprojects/providers/project',
                data: data,
                type: 'POST',
                dataType: 'json'
            })
            request.done(function(json) {
                if(json.response == 'ok') {
                    $("#addListProviders").modal('hide');
                    $("#addListProviders").find(".msg-no-providers").hide();
                    $("#addListProviders").find(".box-list-providers-registered").show();
                    $("#addListProviders").find('#list-new-providers tbody').find('.row-cloned').remove();
                    var form = $("#form-add-list-providers").validate()
                    form.resetForm();
                    $("#form-add-list-providers").trigger('reset');

                    noty({
                        text: "Se ha guardado correctamente...",
                        type: 'success',
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
            })
            request.fail(function( jqXHR, textStatus ) {
                Utils.displayErrors(jqXHR);
            })
        },
        rules: {
            grupo: {
                required: true,
                number: true
            },
            especialidad: {
                required: true
            },
            "ci[]": {
                required: true,
                number: true
            },
            "firstname[]": {
                required: true,
                maxlength: 50
            },
            "primary_lastname[]": {
                required: true,
                maxlength: 50
            }
        }
    }); 

    function autoCompleteStudent (evt) {
        if (this.value.length <= 8) {
            var tr = $(this).parents('tr');
            var cells = tr[0].cells;
            // GET PROVIDER
            $.ajax({
                url: '/admin/profesor/service/myprojects/providers/ci/' + this.value,
                type: 'GET',
                dataType: 'JSON',
            })
            .done(function (rs) {
                if (rs.response == 'ok') {
                    $(cells[1]).find('input').val(rs.student.primer_nombre);
                    $(cells[2]).find('input').val((rs.student.segundo_nombre) ? rs.student.segundo_nombre : '');
                    $(cells[3]).find('input').val(rs.student.primer_apellido);
                    $(cells[4]).find('input').val((rs.student.segundo_apellido) ? rs.student.segundo_apellido : '');
                }
            })
            .fail(function (jqXHR) {
                Utils.displayErrors(jqXHR);
            })
        }
    }

    function initCompleteStudent (evt) {
        $(this).trigger('autoCompleteStudent');
    }

    function displayErrors(jqXHR) {
        Utils.displayErrors(jqXHR);
    }

    $(".ci").on('keyup', initCompleteStudent);
    $(".ci").on('autoCompleteStudent', autoCompleteStudent);

    // INIT ESPECIALIDAD
    $("#addListProviders").find('#especialidad').select2();

    // CLOSE MODAL ADD PRESTADORES
    $("#addListProviders").on('hide.bs.modal', function() {
        // ./REMOVE TABS
        $(this).find(".my-tab-group-li").remove();
        $(this).find(".content-table").remove();
        // ./RESTORE TABS ONE
        $(this).find("#btn-tab-zero").addClass("active");
        $(this).find("#tab_0").addClass("active");

        $(this).find('#list-new-providers tbody').find('.row-cloned').remove();
        var form = $("#form-add-list-providers").validate()
        form.resetForm();
        $("#form-add-list-providers").trigger('reset');
    })

    // Activate link
    var url = $("#url-active").data("url-active");
    global.url_active(url);
})
//# sourceMappingURL=my_projects_list.js.map
