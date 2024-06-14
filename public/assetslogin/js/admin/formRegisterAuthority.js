var FormRegisterAuthority = (function(){

    var el = {
        formRegisterAuthority: "#form-register-authority", // ID
        modalRegisterAuthoriy: "#registerAuthoriy", // ID
    };

    var dom = {
        find: jQuery,
        formRegisterAuthority: $(el.formRegisterAuthority),
        modalRegisterAuthoriy: $(el.modalRegisterAuthoriy),
    };

    var events = {};

    var subscribeEvents = function () {}

   var validate = {
       callback: function (form) {
           var data = $(form).serialize();
           $rq = $.ajax({
               url: '/admin/authorities',
               data: data,
               type: 'POST',
               dataType: 'JSON',
           })
           .done(function (rs) {
                if (rs.response == 'ok') {
                    noty({
                        text: "Se ha guardado correctamente.",
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

                    dom.find("#cargo_authority_" + rs.authority.cargo_id).trigger('reloadBoxAuthority', rs.authority);

                    dom.modalRegisterAuthoriy.modal('hide');
                }
           })
           .fail(function (jqXHR) {
               var errors = [];
               if (jqXHR.responseJSON) {
                   $.each(jqXHR.responseJSON, function (x, error) {
                       $.each(error, function (x, o) {
                           errors.push(o);
                       })
                   })

                   if (errors.length > 0) {
                       var html = '<ul class="content-icons-errors">';
                       $.each(errors, function (x, error) {
                           html += '<li class="icons-errors">'
                               + error;
                           + '</li>';
                       })
                       html += '</ul>';

                       swal({
                           title: 'Han ocurrido los siguientes errores',
                           text: html,
                           html: true
                       })
                   }
               }
           })
       },
       rules: {
           nombre_autoridad: {
               required: true
           }
       }
   }

    var initializer = function () {
        Utils.initValidateForm(dom.formRegisterAuthority[0], validate.callback, validate.rules);
        // Activate link
        var url = $("#url-active").data("url-active");
        global.url_active(url);
    }

    return {
        initializer: initializer
    }
})()
$(document).ready(function () {
    FormRegisterAuthority.initializer();
});
//# sourceMappingURL=formRegisterAuthority.js.map
