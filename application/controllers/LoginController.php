<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class LoginController extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
	}

	public function index() {
		$this->load->view("login");
	}

	public function loguearse() {
		$result = $this->db->get_where("seguridad.empleado",array(
			"empleado_user" => $this->input->post("user"),
			"empleado_pass" => $this->input->post("pass")
			))->row();

		if($result != null) {
			$this->session->set_userdata("empleado",$result->empleado_nombres." ".$result->empleado_apellidos);
			$this->session->set_userdata("perfil_id",$result->perfil_id);
			$data["response"] = "ok";
		} else {
			$data["response"] = "nothing";
		}

		echo json_encode($data);
	}
}
