$(document).ready(function() {

    // USERS FORM VALIDATE
    $("#form-edit-user").validate({
        submitHandler: function(form) {
            var id = form.user_id.value;
            var data = $(form).serialize();
            $.ajax({
                url: '/admin/user/edit/' + id,
                data: data,
                type: 'POST',
                dataType: 'json',
                success: function(json) {
                    if(json.response == 'ok') {
                        $("#editUser").modal("hide");
                        table = $("#table-list-users").DataTable();
                        table.ajax.reload();

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
                    }
                },
                error: function(jqXHR) {
                    displayErrors(jqXHR);
                }
            })
        },
        rules: {
            ci: {
                required: true,
                number: true,
                maxlength: 8,
                minlength: 7
            },
            firstname: {
                required: true,
                lettersOnly: true
            },
            middlename: {
                required: false,
                lettersOnly: true
            },
            primary_lastname: {
                required: true,
                lettersOnly: true
            },
            second_lastname: {
                required: false,
                lettersOnly: true
            },
            address: {
                required: true,
                lettersOnly: true
            },
            locality: {
                required: true,
                lettersOnly: true
            },
            province: {
                required: true,
                lettersOnly: true
            },
            date_birth: {
                required: false,
                validDate: true
            },
            'phones[]': {
                required: true,
                maxlength: 7,
                minlength: 7
            },
            speciality: {
                required: false,
                lettersOnly: true
            },
            email: {
                required: true,
                isEmail: true
            },
            role_id: {
                required: true
            },
            status: {
                required: true
            },
            password: {
                required: false,
                minlength: 8
            }
        }
    })

    // Plus phones
    $("#plus-phone").on('click', function(e) {
        e.preventDefault();
        var el = $("#element-phone").clone();
        el.find('select').val(1);
        var btn_remove = '<div class="row element-phone-cloned">'
        + '<div class="col-xs-12">'
        + '<button data-phone-id="" type="button" class="close btn-remove-phone"><i class="fa fa-remove"></i></button>'
        + '</div>'
        + '</div>';
        $(btn_remove).prependTo(el);
        el.find("[name='phones_id[]']").val("");
        el.find("input[type='text']").val("");
        el.find("input[type='text']").removeClass("error");
        el.find("input[type='text']").removeAttr("aria-required");
        el.find("input[type='text']").removeAttr("aria-invalid");
        el.find(".element-phone").removeAttr("id");
        el.find(".element-phone").find("#phones-error").remove();
        var count = $(".element-phone").find('.phone').length;
        el.find("input[type='text']").attr("id", "phones_" + (count + 1));
        el.find('label.error').attr({
            "id": "phones_" + (count + 1) + "-error",
            "for": "phones_" + (count + 1)
        })

        $(el).appendTo(".optional-plus-phones");

        // Action remove
        $(".btn-remove-phone").off('click').on('click', function(e) {
            var element = this;
            var phone_id = $(this).data('phone-id');
            var user_id = $(this).parents('form').find("#user_id").val();
            if(phone_id != '') {
                swal({
                    title: "Estas seguro?",
                    text: "¿ Realmente deseas eliminar el teléfono del usuario ?.",
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
                            url: '/coordinador/user/phone/delete/' + phone_id,
                            type: 'GET',
                            dataType: 'JSON',
                            beforeSend: function() {
                                swal.disableButtons();
                            },
                            success: function(json) {
                                if(json.response == "ok")
                                {
                                    swal("Eliminado!", "El teléfono se ha eliminado con éxito.", "success");
                                    $(element).parents("div.element-phone").remove();
                                    table = $("#table-list-users").DataTable();
                                    table.ajax.reload();
                                }
                            },
                            error: function(jqXHR) {
                                displayErrors(jqXHR);
                            }
                        })
                    })
                    // /.PACE
                })
                // /.FUNCTION
            }else{
                $(this).parents("div.element-phone").remove();
            }
        })
        // Add validate
        var phones = $(".phone");
        $.each(phones, function(x, input) {
            $(input).rules('add', {
                required: true
            })
            $(input).numeric_input({
                decimal: '.',
                numberOfDecimals: null
            });
        })
    })

    // Toggle password
    $("#toggle-password").on('click', function(e) {
        var input_passwd = $("#password");
        var show_pass_input = $("#show-password");
        var value = input_passwd.val();
        if(value) {
            if(input_passwd.is(":visible")) {
                input_passwd.hide();
                show_pass_input.val(value);
                show_pass_input.show();
            }else{
                input_passwd.show();
                show_pass_input.val("");
                show_pass_input.hide();
            }
        }
    })

    // Method Generate password random
    function generatePassword(longitud)
    {
        var str = "abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ123467890";
        var password = "";
        for (i=0; i<longitud; i++) {
            password += str.charAt(Math.floor(Math.random()*str.length));
        }
        return password;
    }

    $("#generate-password").on("click", function() {
        var input_passwd = $("#password");
        var text_password = $("#show-password");
        // Generate passwd
        var generate_passwd = generatePassword(8);
        // Set passwd to input
        input_passwd.hide();
        input_passwd.val(generate_passwd);
        text_password.val(generate_passwd);
        text_password.show();
    })

    // Activate tooltips
    $("[data-toggle=tooltip]").tooltip();
    // Activate select2
    $(".simple-select").select2({
        placeholder: "Seleccione...",
    });
    $(".address-select").select2({
        placeholder: "Seleccione...",
    });
    $(".speciality-select").select2({
        placeholder: "Seleccione una especialidad",
    });
    

    $("#state").on('change', function (e, dataAddress) {
        var value = e.target.value;
        var state = e.target.options[e.target.options.selectedIndex].dataset.id;
        $("#province").children().remove();
        $("#province").select2("destroy");
        // SELECT PROVINCE FROM LOCALITY
        Pace.track(function () {
            var getProvinces = $.ajax({
                url: '/admin/api/get/provinces/' + state,
                type: 'GET',
                dataType: 'json'
            });
            getProvinces.done(function (json) {
                $("#province").select2({
                    data: json.data
                });
                $.each($("#province").children(), function (x, op) {
                    $(op).attr('data-id', json.data[x].dataId);
                })
                // trigger provinces
                $("#province").val(dataAddress.province).trigger('change', dataAddress.locality);
            })
            getProvinces.fail(function (jqXHR, textStatus) {
                displayErrors(jqXHR);
            });
        })
        // ./PACE
    })

    $("#province").on('change', function (e, locality) {
        var value = e.target.value;
        var province = e.target.options[e.target.options.selectedIndex].dataset.id;
        $("#locality").children().remove();
        $("#locality").select2("destroy");
        // SELECT PROVINCE FROM LOCALITY
        Pace.track(function () {
            var getProvinces = $.ajax({
                url: '/admin/api/get/localities/' + province,
                type: 'GET',
                dataType: 'json'
            });
            getProvinces.done(function (json) {
                $("#locality").select2({
                    data: json.data
                });
                $("#locality").val(locality).trigger('change');
            })
            getProvinces.fail(function (jqXHR, textStatus) {
                displayErrors(jqXHR);
            });
        })
        // ./PACE
    })

    // ICHECK RADIO
    $(".square_radio").iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%'
    })

    function displayErrors(jqXHR) {
        var errors = [];
        if (jqXHR.responseJSON) {
            $.each(jqXHR.responseJSON, function (x, error) {
                $.each(error, function (x, o) {
                    errors.push(o);
                })
            })

            if (errors.length > 0) {
                var html = '<ul>';
                $.each(errors, function (x, e) {
                    html += '<li style="list-style:square;text-align:left;margin-bottom:8px;color:red;">'
                        + e;
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
    }

    // Activate link
    var url = $("#url-active").data("url-active");
    global.url_active(url);
})
//# sourceMappingURL=edit_user.js.map
