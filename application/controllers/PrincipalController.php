<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "BaseController.php";

class PrincipalController extends BaseController {

	public function __construct() {
		parent::__construct();
		$this->load->model('BaseModel');
	}

	public function index() {
		$view = "principal/index";
		parent::init($view);
	}

	public function combo_box() {
		echo $this->combobox($this->input->post("table"),$this->input->post("indexs"),$this->input->post("c_id"));
	}
}
