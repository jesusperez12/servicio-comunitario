// Modificando mensajes de validación
jQuery.extend(jQuery.validator.messages, {
    required: "Requerido.",
    number: "Por favor ingrese un número válido.",
    email: "Introduzca una dirección válida.",
    date: "Introduzca una fecha válida (dd/mm/aaaa).",
    maxlength: jQuery.validator.format("Por favor debe ingresar hasta {0} caracteres."),
    minlength: jQuery.validator.format("Por favor se requiere un valor de {0} caracteres."),
    rangelength: jQuery.validator.format("Por favor ingrese un valor entre {0} y {1} caracteres."),
    minStrict: jQuery.validator.format("La cantidad debe ser mayor a cero.")
});
$.validator.addMethod('minStrict', function (value, el, param) {
    return value > param;
});
// Rules Only Caps tex_fac
$.validator.addMethod("onlyCaps", function(value, element) {
    return this.optional(element) || /[A-Z]/.test(value);
}, "Sólo caracteres en mayúscula.");

$.validator.addMethod("noSpace", function(value, element) {
    return value.indexOf(" ") < 0 && value != "";
}, "No puede haber espacio.");

$.validator.addMethod("isEmail", function(value, element) {
    if (this.optional(element) || /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value)) {
        return true;
    }else{
        return false;
    }
}, "Debe ingresar un email válido.");
$.validator.addMethod("lettersOnly", function(value, element) {
    return this.optional(element) || /^[a-z0-9A-Z\/\-\,\.\u00E0-\u00FC\s]*$/i.test(value);
},"Por favor, sólo puede ingresar letras y números");

$.validator.addMethod("excludeletters", function(value, element) {
    return this.optional(element) || /^(\w+\s?)*$/i.test(value);
},"Caracteres no permitidos");

$.validator.addMethod("numberAndLetters", function(value, element) {
    return this.optional(element) || /^[a-z0-9\-]+$/i.test(value);
}, "El campo puede contener solo letras y números.");

$.validator.addMethod("validDate", function( value, element ) {
    return this.optional(element) || /^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/.test(value);
}, "La fecha debe coincidir con (dd/mm/aaaa).");

$.validator.addMethod("unique", function (value, element) {
    var parentForm = $(element).closest('form');
    var timeRepeated = 0;
    if (value != '') {
        $(parentForm.find(':text')).each(function () {
            if ($(this).val() === value) {
                timeRepeated++;
            }
        });
    }
    return timeRepeated === 1 || timeRepeated === 0;

}, "* Duplicate");
//# sourceMappingURL=common.js.map
