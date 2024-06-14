$(document).ready(function() {
    // USERS FORM VALIDATE
    $("#form-add-project").validate({
        submitHandler: function(form) {
            $(".btn-send-form").attr("disabled", true);
            form.submit();
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
            'referencias[]': {
                required: true
            },
        }
    })

    // FUNCIONES AÑADIR RECURSOS, REFERENCIAS, ACTIVIDADES
    $("#btn_arc").on('click', function() {
        var el = $($(".recurso-element")[0]).clone();
        var btn_remove = '<div class="row recurso-element-cloned">'
        + '<div class="col-xs-12">'
        + '<button type="button" class="close btn-remove-recurso"><i class="fa fa-remove"></i></button>'
        + '</div>'
        + '</div>';
        $(btn_remove).prependTo(el);
        el.find("input").val("");
        var count = $(".recurso-element").find('.recurso').length;
        el.find("input").attr("id", "recurso_" + (count + 1));
        el.find('.error').attr({
            "id": "recurso_" + (count + 1) + "-error",
            "for": "recurso_" + (count + 1)
        })

        $(el).appendTo(".box-recurso-element");

        // Action remove
        $(".btn-remove-recurso").off('click').on('click', function(e) {
            $(this).parents("div.recurso-element").remove();
        })
        // Add validate
        var phones = $(".recurso");
        $.each(phones, function(x, input) {
            $(input).rules('add', {
                required: true,
                
            })
        })
    })
    
    $("#btn_aac").on('click', function() {
        var el = $($(".actividad-element")[0]).clone();
        var btn_remove = '<div class="row actividad-element-cloned">'
        + '<div class="col-xs-12">'
        + '<button type="button" class="close btn-remove-actividad"><i class="fa fa-remove"></i></button>'
        + '</div>'
        + '</div>';
        $(btn_remove).prependTo(el);
        el.find("input").val("");
        var count = $(".actividad-element").find('.actividad').length;
        el.find("input").attr("id", "actividad_" + (count + 1));
        el.find('.error').attr({
            "id": "actividad_" + (count + 1) + "-error",
            "for": "actividad_" + (count + 1)
        })

        $(el).appendTo(".box-actividad-element");

        // Action remove
        $(".btn-remove-actividad").off('click').on('click', function(e) {
            $(this).parents("div.actividad-element").remove();
        })
        // Add validate
        var phones = $(".actividad");
        $.each(phones, function(x, input) {
            $(input).rules('add', {
                required: true,
                
            })
        })
    })
    
    $("#btn_arf").on('click', function() {
        var el = $($(".referencia-element")[0]).clone();
        var btn_remove = '<div class="row referencia-element-cloned">'
        + '<div class="col-xs-12">'
        + '<button type="button" class="close btn-remove-referencia"><i class="fa fa-remove"></i></button>'
        + '</div>'
        + '</div>';
        $(btn_remove).prependTo(el);
        el.find("input").val("");
        var count = $(".referencia-element").find('.referencia').length;
        el.find("input").attr("id", "referencia_" + (count + 1));
        el.find('.error').attr({
            "id": "referencia_" + (count + 1) + "-error",
            "for": "referencia_" + (count + 1)
        })

        $(el).appendTo(".box-referencia-element");

        // Action remove
        $(".btn-remove-referencia").off('click').on('click', function(e) {
            $(this).parents("div.referencia-element").remove();
        })
        // Add validate
        var phones = $(".referencia");
        $.each(phones, function(x, input) {
            $(input).rules('add', {
                required: true,
                
            })
        })
    })

    $("#especialidad").select2({
        placeholder: 'Seleccione...',
        minimumResultsForSearch: 'Infinity'
    });

    // // ./CKEDITOR
    CKEDITOR.replace('descripcion', {
        customConfig: '/assets/js/customs/ckeditor_add_project_config.js'
    });

    CKEDITOR.instances.descripcion.on( 'fileUploadRequest', function( evt ) {
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


    // Activate link
    var url = $("#url-active").data("url-active");
    global.url_active(url);
})
//# sourceMappingURL=projects.js.map
