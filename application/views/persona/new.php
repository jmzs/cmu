<br>
<form id="form" class="form-horizontal">
<input type="hidden" name="persona_id" class="oculto" value="<?php echo $persona_id; ?>">
    <div class="form-group">
        <label class="col-md-3 control-label">Codigo</label>
        <div class="col-md-8">

            <input type="text" class="form-control" id="codigo" value="<?php echo $persona_codigo; ?>" name="persona_codigo" maxlength="8" />

        </div>

    </div>

   <!--  <div class="form-group">
         <label class="col-md-3 control-label">Nombre</label>
        <div class="col-md-8">
            <input type="text" class="form-control" name="persona_nombre" />
        </div>
    </div> -->
    <div class="form-group">
        <label class="col-md-3 control-label">Sexo</label>
        <div class="col-md-8">
            <select name="persona_sexo" class="form-control">
                <?php if($persona_sexo=="M"){  ?>
                 <option value="M" selected>M</option>
                <?php } else { ?>
                <option value="M" >M</option>
                <?php  } ?>
                <?php if($persona_sexo=="F"){  ?>
                 <option value="F" selected>F</option>
                <?php } else { ?>
                <option value="F" >F</option>
                <?php  } ?>

            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">Tipo Paciente</label>
        <div class="col-md-8">
            <select name="persona_tiposervicio" class="form-control">
             <?php if($persona_tiposervicio=="S"){  ?>
                 <option value="S" selected>S</option>
                <?php } else { ?>
                <option value="S" >S</option>
                <?php  } ?>
                <?php if($persona_tiposervicio=="P"){  ?>
                 <option value="P" selected>P</option>
                <?php } else { ?>
                <option value="P" >P</option>
                <?php  } ?>
            </select>
        </div>
    </div>
     <div class="form-group">
        <label class="col-md-3 control-label">Escuela</label>
        <div class="col-md-8">
            <input type="text" <?php echo ($persona_tiposervicio=="P") ? "disabled" : ""; ?> class="form-control" value="<?php echo $persona_escuela; ?>" id="escuela" name="persona_escuela" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">Anio de Ingreso</label>
        <div class="col-md-8">
            <select <?php echo ($persona_tiposervicio=="P") ? "disabled" : ""; ?> name="persona_anioingreso" class="form-control">
                <?php if($persona_anioingreso=="20141"){  ?>
                 <option value="20141" selected>2014-I</option>
                <?php } else { ?>
                <option value="20141" >2014-I</option>
                <?php  } ?>
                <?php if($persona_anioingreso=="20142"){  ?>
                 <option value="20142" selected>2014-II</option>
                <?php } else { ?>
                <option value="20142" >2014-II</option>
                <?php  } ?>
                <?php if($persona_anioingreso=="20151"){  ?>
                 <option value="20151" selected>2015-I</option>
                <?php } else { ?>
                <option value="20151" >2015-I</option>
                <?php  } ?>

                <?php if($persona_anioingreso=="20152"){  ?>
                 <option value="20152" selected>2015-II</option>
                <?php } else { ?>
                <option value="20152" >2015-II</option>
                <?php  } ?>


                 <?php if($persona_anioingreso=="20161"){  ?>
                 <option value="20161" selected>2016-I</option>
                <?php } else { ?>
                <option value="20161" >2016-I</option>
                <?php  } ?>

            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">Servicio</label>
        <div class="col-md-8">
        <?php if(count($servicios) == 4){  ?>
        <input type="checkbox" id="todos" name="all" checked >&nbsp;&nbsp; Todos<br>
        <?php } else { ?>
        <input type="checkbox" id="todos" name="all" >&nbsp;&nbsp; Todos<br>
        <?php } ?>
            <?php if(count($servicios)>0) { ?>
            <?php if(in_array(1,$servicios)) {?>
            <input type="checkbox" class="flat-red" name="servicio[]" checked value="1"> &nbsp;&nbsp;Medicina General<br>
            <?php } else { ?>
             <input type="checkbox" class="flat-red" name="servicio[]" value="1"> &nbsp;&nbsp;Medicina General<br>
            <?php } ?>

             <?php if(in_array(2,$servicios)) {?>
            <input type="checkbox" class="flat-red" name="servicio[]" checked value="2"> &nbsp;&nbsp;Obstetricia<br>
            <?php } else { ?>
             <input type="checkbox" class="flat-red" name="servicio[]"  value="2"> &nbsp;&nbsp;Obstetricia<br>
            <?php } ?>

            <?php if(in_array(3,$servicios)) {?>
            <input type="checkbox" class="flat-red" name="servicio[]" checked value="3"> &nbsp;&nbsp;Odontología<br>
            <?php } else { ?>
             <input type="checkbox" class="flat-red" name="servicio[]"  value="3"> &nbsp;&nbsp;Odontología<br>
            <?php } ?>


            <?php if(in_array(4,$servicios)) {?>
            <input type="checkbox" class="flat-red" name="servicio[]" checked value="4"> &nbsp;&nbsp;Psicología<br>
            <?php } else { ?>
             <input type="checkbox" class="flat-red" name="servicio[]"  value="4"> &nbsp;&nbsp;Psicología<br>
            <?php } ?>
            <?php } else { ?>
            <input type="checkbox" class="flat-red" name="servicio[]" value="1"> &nbsp;&nbsp;Medicina General<br>
             <input type="checkbox" class="flat-red" name="servicio[]"  value="2"> &nbsp;&nbsp;Obstetricia<br>
             <input type="checkbox" class="flat-red" name="servicio[]"  value="3"> &nbsp;&nbsp;Odontología<br>
             <input type="checkbox" class="flat-red" name="servicio[]"  value="4"> &nbsp;&nbsp;Psicología<br>
            <?php } ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-offset-6 col-md-3">
           <a href="<?php echo base_url()."personaController"; ?>" class="btn btn-danger">Mostrar Registros</a>
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-primary save_data">Guardar</button>
        </div>
    </div>
    <!-- <div class="form-group">
    </div> -->
</form>

