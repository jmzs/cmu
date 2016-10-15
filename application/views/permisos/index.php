<form id="form" class="form-horizontal">
    <div class="row">
        <div class="col-md-6 col-md-offset-2" id="perfil_id"></div>
        <div class="col-md-1">
            <button class="btn btn-primary nuevo">Nuevo</button>
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-success save" >Guardar</button>
        </div>
    </div>
    <div class="row">
        <?php
            $i = 1;
        	echo '<div class="col-md-3">';
        	foreach ($modulos_padres as $padre) {
        		echo '<h3>'.$padre["modulo_nombre"].'</h3>';
        		foreach ($padre["hijos"] as $hijo) {
                    echo '<div class="form-group checkboxes">';
        			echo '<input type="checkbox" name="modulo_id[]" value="'.$hijo["modulo_id"].'" class="flat-red"/>&nbsp;&nbsp;'.$hijo["modulo_nombre"]."<br>";
                    echo '</div>';
        		}
        		echo '</div>';
                if($i%4 == 0) {
                    echo '<div style="clear:both;"></div>';
                }
        		echo '<div class="col-md-3">';
                $i++;
        	}
        ?>

    </div>
</form>

<div class="modal fade" id="mod-form" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title nm">Registrar Nuevo Perfil</h4>
            </div>
            <div class="modal-body">
                <form id="form_perfil" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Descripcion</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="perfil_descripcion" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-7 col-md-2">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                    </div> -->
                </form>
            </div>

        </div>
    </div>
</div>
