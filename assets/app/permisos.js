$(function() {
	$permisos = new Base();
    $permisos.combobox("perfil_id","seguridad.perfil",[0,1]);

    $(document).on("change","select[name=perfil_id]",function(e) {
    	e.preventDefault();
    	$perfil_id = $(this).val();
    	if($perfil_id != "") {
	    	$.post($permisos.base_url+'/get', {perfil_id: $perfil_id}, function(data, textStatus, xhr) {
	    		$(".checkboxes").each(function(index, el) {
	    			$result = $permisos.in_object($(this).find("input[name='modulo_id[]']").val(),data);
	    			if($result.result) {
	    				$("input[value='"+$result.id+"']").prop("checked",true);
	    				$(this).find(".icheckbox_flat-red").addClass("checked",true);
	    			} else {
	    				$("input[value='"+$(this).find("input[name='modulo_id[]']").val()+"']").prop("checked",false);
	    				$(this).find(".icheckbox_flat-red").removeClass("checked");
	    			}

	    		});
	    		//console.log(data);
	    	},'json');
    	} else {
    		$(".checkboxes").restart_checkboxes();
    	}
    })




    $(document).on('click', '.save', function(event) {
    	event.preventDefault();
    	if($("select[name=perfil_id]").val() == "") {
    		$("select[name=perfil_id]").focus(); return false;
    	}
    	$permisos.guardar("#form");
    	reload_permisos();
    	$(".checkboxes").restart_checkboxes();

    });

    //reload_permisos();

    $perfil = new Base();
    //alert($perfil.base_url);
    $('#form_perfil').bootstrapValidator({
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

			$perfil.base_url = root+"perfilController/guardar";
            $perfil.guardar("#form_perfil");
            $perfil.close_modal();
            $perfil.restart();
			$permisos.combobox("perfil_id","seguridad.perfil",[0,1]);
        }
    });
})

function reload_permisos() {
	window.location = $permisos.base_url;
	// $.post($permisos.base_url+'/getPermisos', {}, function(modulos, textStatus, xhr) {
	// 	$html = '<li class="nav-header">Soft Tutoria</li>';
	// 	for (var i = 0; i < modulos.length; i++) {
	// 		$html += '<li class="menu-list "><a href="#"><i class="'+modulos[i].modulo_icono+'"></i> <span>'+modulos[i].modulo_nombre+'</span> <i class="ion ion-ios7-arrow-down pull-right"></i></a>';
	// 		$html += '<ul class="sub-menu-list">';

	// 		for (var j = 0; j < modulos[i].hijos.length; j++) {
	// 			$html += '<li><a href="'+modulos[i].hijos[j].modulo_url+'">'+modulos[i].hijos[j].modulo_nombre+'</a></li>';
	// 		}

	// 		$html += '</ul>';
	// 		$html += '</li>';


	// 	};
	// 	$(".menu_modulos").html($html);
	// },'json');
}
