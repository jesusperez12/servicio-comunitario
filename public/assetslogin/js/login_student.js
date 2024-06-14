var LoginPrestador = (function () {
    
    var el = {
        formPrestadorLogin: 'login-sc-prestador', // ID
        inputCi: 'ci', // ID
    }

    var dom = {
        formPrestadorLogin: $("#" + el.formPrestadorLogin),
        inputCi: $("#" + el.inputCi),
    }

    var validate = {
        callback: function (form) {
            $(".btn-send-form").attr("disabled", true);
            form.submit();
        },
        rules: {
            ci: {
                required: true,
                number: true,
                maxlength: 8,
                minlength: 8
            },
            password: {
                required: true,
                number: true,
                maxlength: 8,
                minlength: 8
            },
        },
        messages: {
            ci: {
                required: "La cédula es requerida."
            },
            password: {
                required: "La contraseña es requerida."
            }
        }
    }

    var initFuncForm = function () {
        dom.inputCi.numeric_input({
            decimal: '.',
            numberOfDecimals: null
        });
    }

    var initializer = function () {
        initFuncForm();
        Utils.initValidateForm(dom.formPrestadorLogin[0], validate.callback, validate.rules, validate.messages);
    }

    return {
        initializer: initializer
    }

})()

$(document).ready(function() { 
    LoginPrestador.initializer();    
});

//# sourceMappingURL=login_student.js.map
