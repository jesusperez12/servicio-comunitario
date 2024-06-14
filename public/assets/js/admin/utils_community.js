$(document).ready(function() {

    // Plus phones
    $("#plus-phone").on('click', function(e) {
        e.preventDefault();
        var el = $("#element-phone").clone();
        var btn_remove = '<div class="row element-phone-cloned">'
        + '<div class="col-xs-12">'
        + '<button type="button" class="close btn-remove-phone"><i class="fa fa-remove"></i></button>'
        + '</div>'
        + '</div>';
        $(btn_remove).prependTo(el);
        el.find("input").val("");
        el.find("input").removeClass("error");
        el.find("input").removeAttr("aria-required");
        el.find("input").removeAttr("aria-invalid");
        el.removeAttr("id");
        el.find(".element-phone").find("#phones-error").remove();
        var count = $(".element-phone").find('.phone').length;
        el.find("input").attr("id", "phones_" + (count + 1));
        el.find('label.error').attr({
            "id": "phones_" + (count + 1) + "-error",
            "for": "phones_" + (count + 1)
        })
        $(el).appendTo(".optional-plus-phones");

        // Action remove
        $(".btn-remove-phone").off('click').on('click', function(e) {
            $(this).parents("div.element-phone").remove();
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

    // INPUT NUMERIC
    $('.numeric-input').numeric_input({
        decimal: '.',
        numberOfDecimals: null
    });

    // Activate link
    var url = $("#url-active").data("url-active");
    global.url_active(url);
})
//# sourceMappingURL=utils_community.js.map
