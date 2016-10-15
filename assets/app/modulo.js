$(function () {
    $modulo = new Base();
    $modulo.combobox("modulo_padre","seguridad.modulo",[0,1]);
    $modulo.grilla('#grid_modulos', $modulo.base_url + "/jsonData");
    $('#form').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            modulo_nombre: {
                validators: {
                    notEmpty: {
                        message: 'Campo requerido'
                    }
                }
            },
            modulo_icono: {
                validators: {
                    notEmpty: {
                        message: 'Campo requerido'
                    }
                }
            },
            modulo_url: {
                validators: {
                    notEmpty: {
                        message: 'Campo requerido'
                    },
                }
            },
            modulo_padre: {
                validators: {
                    notEmpty: {
                        message: 'Campo requerido'
                    }
                }
            }
        },
        submitHandler: function (validator, form, submitButton) {
            $modulo.guardar("#form");
            $modulo.limpiar_form();
            //document.getElementById("form").reset();
            $modulo.close_modal();
            $modulo.restart();
            $modulo.combobox("modulo_padre","seguridad.modulo",[0,1]);
        }
    });



})
