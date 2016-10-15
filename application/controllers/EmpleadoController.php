<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once "BaseController.php";

class EmpleadoController extends BaseController {

	public function __construct() {
		parent:: __construct();
	}

	public function index() {
		$view = "empleado/index";
		#$data["empleados"]=$this->db->get_where();
		//$data["perfiles"]=$this->BaseModel->traer_perfiles();
		$data["url"] = base_url()."modulos";
		$data["scripts"] = $this->cargar_js(["empleado.js"]);
		parent::init($view,$data);
	}



	public function guarda_empleado()
	{

		if ($_POST['empleado_id']=='') {

               $result=$this->BaseModel->guardaremple();
		}else{
               $result=$this->BaseModel->modificar_emple();

          }
          $tabla = $this->tabla();
		echo  $result."|".$tabla;

	}

	public function traer_empleado()
	{
		$res=$this->BaseModel->traer_emplea();
		echo json_encode($res);

	}
	public function eliminar_empleado()
	{
		$result=$this->BaseModel->eliminare();
		$perfiles = $this->BaseModel->traer_emple();

		$tabla = $this->tabla();
		echo  $result."|".$tabla;
	}



}
