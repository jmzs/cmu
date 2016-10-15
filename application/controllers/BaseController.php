<?php

defined('BASEPATH') OR exit('No direct script access allowed');

abstract class BaseController extends CI_Controller {

    private $css; // css a incluir a la plantilla
    private $js; // js a incluir a la plantilla

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model("BaseModel");
        $this->load->library("Grilla");
        $this->css = array();
        $this->js = array();
    }

    public function init($view, $array = array()) {
        $this->db->query('TRUNCATE TABLE log.order RESTART IDENTITY');
       if(isset($this->session->empleado)){
            $data["view"] = $view;
            if (count($array) > 0) {
                $data["param"] = $array;
            }
            $data["modulos"] = $this->BaseModel->getPermisos(true);
            $this->load->view("layout", $data);
        }else{
          redirect('loginController');
      }
    }

    public function cargar_css($css_array) {
        for ($i = 0; $i < count($css_array); $i++) {
            $this->css[] = '<link href="' . base_url('public/css/' . $css_array[$i]) . '" rel="stylesheet" />';
        }
        return $this->css;
    }

    public function cargar_js($js_array) {
        for ($i = 0; $i < count($js_array); $i++) {
            $this->js[] = '<script src="' . base_url('assets/app/' . $js_array[$i]) . '"></script>';
        }
        return $this->js;
    }

    public function desencriptar($array, $select_id, $id, $nombre) {
        $select = array("" => "Seleccione");
        if (count($array) > 0) {
            foreach ($array as $value) {
                $select[$value->$id] = $value->$nombre;
            }
        }
        return form_dropdown($select_id, $select, '', 'class="form-control"');
    }

    public function prepare($dato) {
        $dato = str_replace('../../public/images/tmp', $this->config->config['base_url'] . '/public/images/tmp', $dato);
        $dato = str_replace('../public/images/tmp', $this->config->config['base_url'] . '/public/images/tmp', $dato);
        return $dato;
    }

    public function desfragmentarData($data) {
        #print_r($data); exit;
        foreach ($data as $key => $value) {
            if(count($value)>2) {
                $array["campo"] = $key;
                for ($i=0; $i < count($value) ; $i++) {
                    $array["value"][] = $value[$i];
                }
                $data_complete[] = (object) $array;
            } else {
                $data_complete[] = (object) array("campo" => $key, "value" => $value);
            }
        }
        return $data_complete;
    }

    /**
     * [combobox para los select de los formularios]
     * @param  [string] $table [tabla del cual se va sacar la informacion]
     * @param  [array] $indexs [0 es el id y 1 es la descripcion ]
     * @param  [string] $c_id  [id del combo en el html]
     * @return [string] $html  [con el select completo]
     */
    public function combobox($table,$indexs,$c_id) {
    	$schema = explode(".", $table);
    	if(count($schema)>0) {
    		$tabla = $schema[1];
    	} else {
    		$tabla = $table;
    	}
        $fields = $this->db->list_fields($tabla);
        $where = array("estado"=>"1");
        $regs = $this->db->get_where($table,$where)->result();
        $html = '<select name="'.$c_id.'" class="form-control combobox"><option value="">Seleccione</option>';
        foreach($regs as $key => $value) {
            $valor = (string) $fields[$indexs[0]];
            $descripcion = (string) $fields[$indexs[1]];
            $html .= '<option value="'.$value->$valor.'">'.$value->$descripcion.'</option>';
        }
        $html .= '</select>';
        return $html;
    }

    public function getFields($table) {
        return $this->db->list_fields($table);
    }
}
