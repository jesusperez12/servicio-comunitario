var RegisterAuthority = (function(){

    var el = {
        formRegisterAuthority: "#form-register-authority", // ID
        btnRegisterAuthory: ".btn-register-authority", // CLASS
        cargoAuthorities: ".cargo-authorities", // CLASS
        modalRegisterAuthoriy: "#registerAuthoriy", // ID
        tagNombreAuthority: ".widget-user-username", // CLASS
        tagCargoAuthority: ".widget-user-desc", // CLASS
    }

    var dom = {
        q: jQuery,
        btnRegisterAuthory: $(el.btnRegisterAuthory),
        modalRegisterAuthoriy: $(el.modalRegisterAuthoriy),
        formRegisterAuthority: $(el.formRegisterAuthority),
        cargoAuthorities: $(el.cargoAuthorities),
    }

    var validators = {
        validatorRegisterAuthority: function () {
            return dom.formRegisterAuthority.validate();
        }
    }

    var events = {
        reloadBoxAuthority: function (evt, data) {
            dom.q(this).find(el.tagNombreAuthority).html(data.autoridad);
            dom.q(this).find(el.btnRegisterAuthory).attr('data-autoridad-nombre', data.autoridad);
        },
        showModalFormRegister: function () {
            dom.formRegisterAuthority[0].cargo_id.value = this.dataset.cargoId;
            dom.formRegisterAuthority[0].autoridad_id.value = this.dataset.autoridadId;
            dom.formRegisterAuthority[0].nombre_autoridad.value = this.dataset.autoridadNombre;
            dom.modalRegisterAuthoriy.modal({
                show: true,
                backdrop: 'static',
                keyboard: false
            })
        },
        hideModalFormRegister: function () {
            dom.formRegisterAuthority.trigger('reset');
            validators.validatorRegisterAuthority().resetForm();
        }
    };

    var subscribeEvents = function () {
        dom.btnRegisterAuthory.on('click', events.showModalFormRegister);
        dom.modalRegisterAuthoriy.on('hide.bs.modal', events.hideModalFormRegister);
        dom.cargoAuthorities.on('reloadBoxAuthority', events.reloadBoxAuthority);
    }

    var initializer = function () {
        subscribeEvents();
    }

    return {
        initializer: initializer,
        dom: dom
    }
})()
$(document).ready(function () {
    RegisterAuthority.initializer();
});

//# sourceMappingURL=registerAuthority.js.map
