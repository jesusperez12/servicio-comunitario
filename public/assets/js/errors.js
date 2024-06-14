var Errors = (function(){

    var el = {
        btnBack: "btn-back"
    }

    var dom = {
        btnBack: $("." + el.btnBack)
    }

    var events = {
        returnBack: function(e){
            e.preventDefault();
            window.location = '/';
        }
    }

    var suscribeEvents = function(){
        dom.btnBack.on('click', events.returnBack);
    }

    var initializer = function() {
        suscribeEvents();
    }

    return {
        initializer: initializer
    }

})()

$(document).ready(function(){
    Errors.initializer();
});
//# sourceMappingURL=errors.js.map
