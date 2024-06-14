var Login = (function () {

    var el = {
        formLogin: 'login-sc', // ID
        inputEmail: 'email', // ID
        inputPassword: 'password', // ID
    }

    var dom = {
        formLogin: $("#" + el.formLogin),
        inputEmail: $("#" + el.inputEmail),
        inputPassword: $("#" + el.inputPassword),
    }

    var validate = {
        callback: function (form) {
            $(".btn-send-form").attr("disabled", true);
            form.submit();
        },
        rules: {
            email: {
                required: true,
                isEmail: true
            },
            password: {
                required: true
            }
        },
        messages: {
            email: {
                required: "El correo es requerido."
            },
            password: {
                required: "La contraseña es requerida."
            }
        }
    }

    var initializer = function () {
        Utils.initValidateForm(dom.formLogin[0], validate.callback, validate.rules, validate.messages);
    }

    return {
        initializer: initializer
    }

})()

$(document).ready(function () {
    Login.initializer();
});

//# sourceMappingURL=login.js.map
