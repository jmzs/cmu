<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "BaseController.php";

class PerfilController extends BaseController {


	public function __construct() {
        parent:: __construct();
    }

    public function index() {
        $view = "perfil/index";
        $data["button"] = '<button class="btn btn-primary nuevo">Nuevo Perfil</button>';
        $data["title"] = "Administración de Perfiles";
        $data["tabla"] = $this->tableDraw()->dibujarTabla();
        $data["scripts"] = $this->cargar_js(["perfil.js"]);
        parent::init($view, $data);
    }

    public function tableDraw() {
      $grilla_perfil = new Grilla();
      $grilla_perfil->setId("grid_perfil");
	  #$grilla_perfil->setKey("perfil_id");
	  $grilla_perfil->setColumn("perfil_id", "Id");
      $grilla_perfil->setColumn("perfil_descripcion", "Descripcion");
	  $grilla_perfil->setTable("seguridad.perfil");
      return $grilla_perfil;
    }

    public function jsonData() {
        $json_data = $this->tableDraw()->grillaData();
        echo json_encode($json_data);
    }

    public function guardar() {
        if ($this->input->post("perfil_id") == '') {
            $result = $this->BaseModel->insertar("seguridad.perfil", $this->desfragmentarData($_POST));
        }else{
        	$result = $this->BaseModel->modificar("seguridad.perfil", $this->desfragmentarData($_POST));
        }
        echo json_encode($result);
    }

    public function eliminar() {
      	$result = $this->BaseModel->eliminar(["seguridad.perfil","perfil_id"]);
        echo json_encode($result);
    }

    public function get() {
        $perfils = $this->db->query("select * from seguridad.perfil where estado=1 and perfil_id=".$this->input->post("id"))
                ->row();
        echo json_encode($perfils);
    }



}
