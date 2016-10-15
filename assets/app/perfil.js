$(function () {
    $perfil = new Base();
    $perfil.grilla('#grid_perfil', $perfil.base_url + "/jsonData");
    $('#form').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            perfil_descripcion: {
                validators: {
                    notEmpty: {
                        message: 'Campo requerido'
                    }
                }
            }
        },
        submitHandler: function (validator, form, submitButton) {
            $perfil.guardar("#form");
            $perfil.limpiar_form();
            $perfil.close_modal();
            $perfil.restart();
        }
    });



})
