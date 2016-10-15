$(function () {
    getCod();
    getEscuelas();
    $persona = new Base();
    $persona.grilla('#grid_persona', $persona.base_url + "/jsonData");


    $(document).on("click",".save_data",function() {
        if($("input[name=persona_codigo]").val() == "") {
            $("input[name=persona_codigo]").focus(); return false;
        }
        if($("input[name=persona_codigo]").val() == "") {
            $("input[name=persona_codigo]").focus(); return false;
        }
    })


    $("#todos").click(function() {
        $("input[name='servicio[]']").each(function(index, el) {
            if ($(this).is(':checked')) {
                $(this).prop("checked",false);
                $(this).parent(".icheckbox_flat-red").removeClass("checked",true);
            } else {
                $(this).prop("checked",true);
                $(this).parent(".icheckbox_flat-red").addClass("checked",true);
            }
        });
    });

    $("#codigo").change(function() {
        var current = $(this).typeahead("getActive");
        if (current) {
            $.post(root+'personaController/getCod', {codigo: current}, function(data, textStatus, xhr) {
                console.log(data);
                $("select[name=persona_sexo] option[value='"+data.persona_sexo+"']").prop("selected",true);
                $("select[name=persona_tiposervicio] option[value='"+data.persona_tiposervicio+"']").prop("selected",true);
                $("#escuela").val(data.persona_escuela);
                $("select[name=persona_anioingreso] option[value='"+data.persona_anioingreso+"']").prop("selected",true);
            },'json');
        } else {

        }
    });

    $(document).on("click",".save_data",function() {
        $.ajax({
            url: root + "personaController/guardar",
            type: 'POST',
            dataType: 'json',
            data: $("#form").serialize()
        })
        .done(function (json) {
            if(json == "ei") {
                $.growl({
                    title: 'Mensaje',
                    icon: "fa fa-warning",
                    message: "Error al grabar",
                }, {
                    template: {title_divider: '<br/><br/>'},
                    type: "danger",
                    delay: 1700,
                });
            }
             $(".oculto").val("");

             $("#form")
            .bootstrapValidator('disableSubmitButtons', false)
            .bootstrapValidator('resetForm', true);
            $("#todos").prop("checked",false);
            $("select[name=persona_sexo]").prop("selectedIndex",0);
            $("select[name=persona_tiposervicio]").prop("selectedIndex",0);
            $("select[name=persona_anioingreso]").prop("selectedIndex",0);
            $("#escuela").val("");
            $("#escuela").prop("disabled",false);
            $("select[name=persona_anioingreso]").prop("disabled",false);
            $("input[name='servicio[]']").each(function(index, el) {
                $(this).prop("checked",false);
                $(this).parent(".icheckbox_flat-red").removeClass("checked",true);

            });

        })
        .fail(function () {
            console.log("error");
        })
        .always(function () {
            console.log("complete");
        });
    })

    $("select[name=persona_tiposervicio]").change(function() {
        if($(this).val() == "P") {
            $("#escuela").prop("disabled",true);
            $("select[name=persona_anioingreso]").prop("disabled",true);
        } else {
             $("#escuela").prop("disabled",false);
            $("select[name=persona_anioingreso]").prop("disabled",false);
        }
    })


})


function getCod() {
     $.post(root+'personaController/getCodigos',{},function(data) {

            $("#codigo").typeahead({ source:data });
    },'json');
}

function getEscuelas() {
     $.post(root+'personaController/getEschols',{},function(data) {

            $("#escuela").typeahead({ source:data });
    },'json');
}


