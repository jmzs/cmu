function Base() {
    self = this;
    this.base_url = window.location;
    this.combo_url = root+"PrincipalController/combo_box";
}

Base.prototype.grilla = function (_id, _url) {
    datatable = $(_id).DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: _url,
            type: "post",
            error: function () {
                alert("Error en la grilla de lighthammer");
            }
        }
    });
};

Base.prototype.message = function ($status) {
    if ($status == "i" || $status == "m" || $status == "e") {
        $type = "success";
        switch ($status) {
            case "i":
                $msg = "Se insertó Correctamente";
                break;
            case "m":
                $msg = "Se modificó Correctamente";
                break;
            case "e":
                $msg = "Se eliminó Correctamente";
                break;
        }
        $icon = 'fa fa-check';
    } else {
        $type = "danger";
        $icon = 'fa fa-warning';
        $msg = "Error al eliminar";
    }
    $.growl({
        title: 'Mensaje',
        icon: $icon,
        message: $msg,
    }, {
        template: {title_divider: '<br/><br/>'},
        type: $type,
        delay: 1700,
    });
};

Base.prototype.limpiar_form = function () {
    $(".oculto").val("");
    $('.combobox option[value=""]').prop('selected',true);
    $("#form")
            .bootstrapValidator('disableSubmitButtons', false)  // Enable the submit buttons
            .bootstrapValidator('resetForm', true);             // Reset the form
};

Base.prototype.restart = function () {
    datatable.draw();
    datatable.ajax.reload();
    datatable.ajax.reload();
    datatable.ajax.reload();
    datatable.ajax.reload();
    datatable.ajax.reload();
};

Base.prototype.eliminar = function (id) {
    $.post(this.base_url + '/eliminar', {id: id}, function (data, textStatus, xhr) {
        self.message(data);
    }, "json");
};

Base.prototype.combobox = function (_id, table, indexs) {
    $.post(this.combo_url, { table: table, indexs: indexs,c_id:_id }, function (data, textStatus, xhr) {
        $("#"+_id).html(data);
    });
};


Base.prototype.close_modal = function () {
    $("#mod-form").modal("hide");
};

Base.prototype.nuevo = function () {
    $("#mod-form").modal("show");
};

Base.prototype.modificar = function (id) {
    $.post(this.base_url + '/get', { id: id }, function (json, textStatus, xhr) {
        $.each(json, function (key, value) {
            if ($("input[name=" + key + "]")[0]) {
                $("input[name=" + key + "]").val(value);
            }
            if ($("select[name=" + key + "]")[0]) {
                $("select[name=" + key + "] option[value='" + value + "']").prop("selected",true);
            }
        });
    }, 'json');
    self.nuevo();
};

Base.prototype.guardar = function (_id) {
    $.ajax({
        url: this.base_url + "/guardar",
        type: 'POST',
        dataType: 'json',
        data: $(_id).serialize()
    })
    .done(function (json) {
        self.message(json);
        self.limpiar_form();
    })
    .fail(function () {
        console.log("error");
    })
    .always(function () {
        console.log("complete");
    });
};

Base.prototype.in_object = function (valor, object) {
    for (var i = 0; i < object.length; i++) {
        if(valor == object[i].modulo_id) {
            return {result:true,id:object[i].modulo_id};
        }
    }
    return {result:false,id:null};
}

Base.prototype.active_url = function () {
    $url = this.base_url.pathname;
    $parts = $url.split("/");
    $controller = $parts[$parts.length-1];
    $("a[href="+$controller+"]").parent("li").addClass("active").parent("ul").parent("li").addClass("nav-active current");
}

$.fn.select_restart = function() {
	$.each(this, function(index, val) {
		 $(this).find("option").removeAttr("selected");
	});
};

$.fn.restart_checkboxes = function() {
   $(this).each(function(index, el) {
        $(this).find(".icheckbox_flat-red").prop("checked",false);
        $(this).find(".icheckbox_flat-red").removeClass("checked");
    });
};



$object = new Base();

$(document).on('click', '.nuevo', function (event) {
    event.preventDefault();
    $object.limpiar_form();
    $object.nuevo();
});

$(document).on('click', '.eliminar', function (event) {
    event.preventDefault();
    $id = $(this).attr("id");
    if (confirm("Seguro desea eliminar?")) {
        $object.eliminar($id);
        $object.restart();
    }
});

$(document).on('click', '.modificar', function (event) {
    event.preventDefault();
    $id = $(this).attr("id");
    $object.modificar($id);

});

$(function() {
    $object.active_url();
    //$parts = $url.split("/");
    //console.log($parts);
})