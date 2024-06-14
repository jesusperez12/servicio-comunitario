var ValidateCertificate = (function(){

    var el = {
        formValidateCertificate: '#form-validate-certificate',
        preloadValidateResult: '#preload-validate-result',
        validateResult: '#validate-result',
        validateForm: '#validate-form',
        inputCertificateCode: '#certificate_code',
        btnBackValidateForm: '#btn-back-validate-form',
        previewNumRegister: '#preview-num-register',
        previewNamePrestador: '#preview-name-prestador',
        previewGroup: '#preview-group',
        previewPeriodo: '#preview-periodo',
        previewNameProject: '#preview-name-project',
        previewDates: '#preview-dates',
    };

    var dom = {
        formValidateCertificate: $(el.formValidateCertificate),
        preloadValidateResult: $(el.preloadValidateResult),
        validateResult: $(el.validateResult),
        validateForm: $(el.validateForm),
        inputCertificateCode: $(el.inputCertificateCode),
        btnBackValidateForm: $(el.btnBackValidateForm),
        previewNumRegister: $(el.previewNumRegister),
        previewNamePrestador: $(el.previewNamePrestador),
        previewGroup: $(el.previewGroup),
        previewPeriodo: $(el.previewPeriodo),
        previewNameProject: $(el.previewNameProject),
        previewDates: $(el.previewDates),
    };

    var validators = {
        formValidateCertificate: function () {
            return dom.formValidateCertificate.validate();
        }
    };

    var events = {
        clearFormValidateCertificate: function (evt) {
            dom.formValidateCertificate.trigger('reset');
            validators.formValidateCertificate().resetForm();
        },
        validating: function (evt) {
            if (dom.validateForm.is(':visible')) {
                dom.validateForm.hide();
            }
            if (dom.preloadValidateResult.is(":hidden")) {
                dom.preloadValidateResult.show();
            }
            if (dom.validateResult.is(":visible")) {
                dom.validateResult.hide();
            }
        },
        loaded: function (evt) {
            if (dom.preloadValidateResult.is(":visible")) {
                dom.preloadValidateResult.hide();
            }
            if (dom.validateResult.is(":hidden")) {
                dom.validateResult.fadeIn();
            }
        },
        restoreForm: function (evt) {
            if (dom.validateResult.is(":visible")) {
                dom.validateResult.fadeOut(500, function () {
                    if (dom.validateForm.is(':hidden')) {
                        dom.validateForm.fadeIn();
                    }
                });
                dom.validateForm.trigger('clearFormValidateCertificate');
                dom.validateResult.trigger('loadData', false);
            }
        },
        loadData: function (evt, data) {
            if (data) {
                dom.previewNumRegister.html(`<b>${data.code}</b> <i class="fa fa-check-circle text-green"></i>`);
                dom.previewNamePrestador.html(`${data.firstname} ${data.primary_lastname}`);
                dom.previewGroup.html(`Grupo Nº ${data.grupo.grupo}`);
                dom.previewPeriodo.html(`${data.periodo.corte}`);
                dom.previewNameProject.html(`<span style="font-style:italic;">${data.proyecto.nombre_proyecto.toUpperCase()}</span>`);
                dom.previewDates.html(`<b>${moment(data.proyecto.bundle_pivot.created_at).format("DD/MM/YYYY")}</b> al <b>${moment(data.proyecto.bundle_pivot.finalized_at).format("DD/MM/YYYY")}</b>`);
            } else {
                dom.previewNumRegister.html(`-`);
                dom.previewNamePrestador.html(`-`);
                dom.previewGroup.html(`-`);
                dom.previewPeriodo.html(`-`);
                dom.previewNameProject.html(`-`);
                dom.previewDates.html(`-`);
            }
            $(document).trigger('loaded');
        }
    };

    var subscribeEvents = function () {
        dom.formValidateCertificate.on('clearFormValidateCertificate', events.clearFormValidateCertificate);
        dom.validateResult.on('loadData', events.loadData);
        dom.btnBackValidateForm.on('click', events.restoreForm);
        $(document).on('validating', events.validating);
        $(document).on('loaded', events.loaded);
    }

    var validate = {
        callback: function (form) {
            Pace.track(function () {
                $(document).trigger('validating');
                var data = $(form).serialize();
                $.ajax({
                    url: '/admin/certificate/validate',
                    data: data,
                    type: 'POST',
                    dataType: 'JSON',
                })
                .done(function(rs) {
                    if (rs.response == 'ok') {
                        dom.validateResult.trigger('loadData', rs.data);
                        dom.formValidateCertificate.trigger('clearFormValidateCertificate');
                    }
                })
                .fail(function(jqXHR) {
                    Utils.displayErrors(jqXHR);
                    dom.validateResult.trigger('loadData', false);
                })
            });
        },
        rules: {
            ci: {
                required: true,
                number: true,
                maxlength: 8,
                minlength: 7
            },
            certificate_code: {
                required: true
            }
        }
    }

    var initFormFun = function () {
        // Activate link
        var url = $("#url-active").data("url-active");
        global.url_active(url);

        dom.inputCertificateCode.inputmask('SC120-999{1,20}-9');
    }

    var initializer = function () {
        subscribeEvents();
        initFormFun();
        Utils.initValidateForm(dom.formValidateCertificate.get(0), validate.callback, validate.rules);
    }

    return {
        initializer: initializer
    }
})()
$(document).ready(function () {
    ValidateCertificate.initializer();
});
//# sourceMappingURL=validateCertificate.js.map
