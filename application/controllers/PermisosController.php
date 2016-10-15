<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once "BaseController.php";

class PermisosController extends BaseController {

    public function __construct() {
        parent:: __construct();
    }

    public function index() {
        $view = "permisos/index";
        $data["title"] = "Administración de Permisos";

        $data["modulos_padres"] = $this->BaseModel->getPermisos();
        $data["scripts"] = $this->cargar_js(["permisos.js"]);
        parent::init($view, $data);
    }

    public function jsonData() {
        $json_data = $this->tableDraw()->grillaSqlData();
        echo json_encode($json_data);
    }

    public function guardar() {
        $this->db->where("perfil_id",$this->input->post("perfil_id"));
        $this->db->delete("seguridad.permisos");
        $result = $this->BaseModel->insertar("seguridad.permisos",$this->desfragmentarData($_POST),true);
        echo json_encode($result);
    }

    public function get() {
        $permisos = $this->db->get_where("seguridad.permisos",array("perfil_id"=>$this->input->post("perfil_id")))->result();
        echo json_encode($permisos);
    }

    public function getPermisos() {
         $modulos = $this->BaseModel->getPermisos(true);
         echo json_encode($modulos);
    }

}
