<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once "BaseController.php";

class ModuloController extends BaseController {

    public function __construct() {
        parent:: __construct();
    }

    public function index() {
        $view = "modulo/index";
        $data["button"] = '<button class="btn btn-primary nuevo">Nuevo Modulo</button>';
        $data["title"] = "Administración de Modulos";
        $data["tabla"] = $this->tableDraw()->dibujarTabla();
        $data["scripts"] = $this->cargar_js(["modulo.js"]);
        parent::init($view, $data);
    }

    public function tableDraw() {
      $grilla_modulo = new Grilla();
      $grilla_modulo->setId("grid_modulos");
      $grilla_modulo->addColumn("h.modulo_id", "idhijo", "Id");
      $grilla_modulo->addColumn("h.modulo_nombre", "hijo", "Modulo");
      $grilla_modulo->addColumn("h.modulo_icono", "modulo_icono", "Icono");
      $grilla_modulo->addColumn("h.modulo_url", "modulo_url", "Url");
      $grilla_modulo->addColumn("p.modulo_nombre", "padre", "Modulo Padre");
     // $grilla_modulo->addColumn(null, null, "Accion");
      $grilla_modulo->setSelect("h.modulo_id as idhijo,h.modulo_nombre as hijo,p.modulo_id as idpadre,p.modulo_nombre as padre,h.modulo_icono,h.modulo_url");
      $grilla_modulo->setFrom("seguridad.modulo as p
      inner join seguridad.modulo as h on(p.modulo_id=h.modulo_padre)");
      $grilla_modulo->setWhere("h.estado=1 and h.modulo_id >1");
      return $grilla_modulo;
    }

    public function jsonData() {
        $json_data = $this->tableDraw()->grillaSqlData();
        echo json_encode($json_data);
    }

    public function guardar() {
        if ($this->input->post("modulo_id") == '') {
            $result = $this->BaseModel->insertar("seguridad.modulo", $this->desfragmentarData($_POST));
        }else{
        	$result = $this->BaseModel->modificar("seguridad.modulo", $this->desfragmentarData($_POST));
        }
        echo json_encode($result);
    }

    public function eliminar() {
      	$result = $this->BaseModel->eliminar(["seguridad.modulo","modulo_id"]);
        echo json_encode($result);
    }

    public function get() {
        $modulos = $this->db->query("select * from seguridad.modulo where estado=1 and modulo_id=".$this->input->post("id"))
                ->row();
        echo json_encode($modulos);
    }

}
