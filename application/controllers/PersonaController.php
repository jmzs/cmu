<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "BaseController.php";

class PersonaController extends BaseController {


	public function __construct() {
        parent:: __construct();
    }

    public function index() {
        $view = "persona/index";
        $data["button"] = '<a href="'.base_url().'personaController/nuevo" class="btn btn-primary">Nuevo </a>';
        $data["title"] = "Administración de Personas";
        $data["tabla"] = $this->tableDraw()->dibujarTabla();
        $data["scripts"] = $this->cargar_js(["persona.js"]);
        parent::init($view, $data);
    }

    public function nuevo() {
        //$data["tabla"] = $this->tableDraw()->dibujarTabla();
        $data["persona_id"] = "";
        $data["persona_sexo"] = "";
        $data["persona_escuela"] = "";
        $data["persona_anioingreso"] = "";
        $data["persona_codigo"] = "";
        $data["persona_tiposervicio"] = "";
        $data["servicios"] = array();
        $data["scripts"] = $this->cargar_js(["persona.js"]);
        $view = "persona/new";
        parent::init($view,$data);
    }

    public function update($id) {
         $personas = $this->db->query("select * from persona where estado=1 and persona_id=".$id)
                ->row();
        $data["persona_id"] = $personas->persona_id;
        $data["persona_sexo"] = $personas->persona_sexo;
        $data["persona_escuela"] = $personas->persona_escuela;
        $data["persona_anioingreso"] = $personas->persona_anioingreso;
        $data["persona_codigo"] = $personas->persona_codigo;
        $data["persona_tiposervicio"] = $personas->persona_tiposervicio;

       $servicios = $this->db->query("select * from persona as p
inner join detalle_servicio as ds on(p.persona_id=ds.persona_id)
inner join servicio as s on(s.servicio_id=ds.servicio_id) where s.estado=1 and p.estado=1 and p.persona_id=".$id)
                ->result();
        foreach ($servicios as $key => $value) {
            $serv[] = $value->servicio_id;
        }
        $data["servicios"] = $serv;
        $data["scripts"] = $this->cargar_js(["persona.js"]);
        $view = "persona/new";
        parent::init($view,$data);
    }

    public function getCodigos() {
        $r = $this->db->get_where("persona",array("estado"=>"1"))->result();
        $arr = array();
        foreach($r as $value) {
            $arr[] = $value->persona_codigo;
        }
        echo json_encode($arr);
    }

     public function getEschols() {

        $arr = array("Administracion","Agronomia","Arquitectura","Contabilidad","Derecho","Ecologia","Economia","Educacion","Enfermeria","Idiomas","Agroindustrial","Sistemas","Civil","Medicina Humana","Obstetricia","Turismi","Veterinaria");

        echo json_encode($arr);
    }

    public function tableDraw() {
      $grilla_persona = new Grilla();
      $grilla_persona->setId("grid_persona");
	  #$grilla_persona->setKey("persona_id");
      $grilla_persona->addColumn("p.persona_id", "persona_id", "Id");
      $grilla_persona->addColumn("p.persona_codigo", "persona_codigo", "Código");
      $grilla_persona->addColumn("p.persona_sexo", "persona_sexo", "Sexo");
      $grilla_persona->addColumn("p.persona_escuela", "persona_escuela", "Escuela");
      $grilla_persona->addColumn("ds.tiempo", "tiempo", "Fecha");
      $grilla_persona->setSelect("p.persona_id as persona_id, p.persona_codigo as persona_codigo,p.persona_sexo as persona_sexo,p.persona_escuela as persona_escuela,ds.tiempo as tiempo");
      $grilla_persona->setFrom("persona as p
        inner join detalle_servicio as ds on(p.persona_id=ds.persona_id)
        inner join servicio as s on(s.servicio_id=ds.servicio_id)");
      $grilla_persona->setWhere("p.estado=1 and s.estado=1 group by p.persona_id , p.persona_codigo,p.persona_sexo,p.persona_escuela,ds.tiempo");
      return $grilla_persona;
    }

    public function jsonData() {
        $json_data = $this->tableDraw()->grillaSqlData();
        echo json_encode($json_data);
    }

    public function guardar() {
        if ($this->input->post("persona_id") == '') {
            $data = array(
                "persona_codigo" => $this->input->post("persona_codigo"),
                "persona_sexo" => $this->input->post("persona_sexo"),
                "persona_escuela" => $this->input->post("persona_escuela"),
                "persona_anioingreso" => $this->input->post("persona_anioingreso"),
                "persona_tiposervicio" => $this->input->post("persona_tiposervicio"),
                );
            $r = $this->db->insert("persona",$data);
            $persona_id = $this->db->insert_id();

            for($i=0 ; $i < count($this->input->post("servicio")) ; $i++)  {
                $datos = array(
                    "persona_id" => $persona_id,
                    "servicio_id" => $this->input->post("servicio")[$i],
                    "tiempo" => date("d-m-Y H:i:s")
                    );
                $r1 = $this->db->insert("detalle_servicio",$datos);
            }

            if($r && $r1) {
                $result = "i";
            } else {
                $result = "ei";
            }
        }else{
             $data = array(
                "persona_codigo" => $this->input->post("persona_codigo"),
                "persona_sexo" => $this->input->post("persona_sexo"),
                "persona_escuela" => $this->input->post("persona_escuela"),
                "persona_anioingreso" => $this->input->post("persona_anioingreso"),
                "persona_tiposervicio" => $this->input->post("persona_tiposervicio"),
                );
            $this->db->where("persona_id",$this->input->post("persona_id"));
            $r = $this->db->update("persona",$data);

            $this->db->where("persona_id",$this->input->post("persona_id"));
            $this->db->delete("detalle_servicio");

            for($i=0 ; $i < count($this->input->post("servicio")) ; $i++)  {
                $datos = array(
                    "persona_id" => $this->input->post("persona_id"),
                    "servicio_id" => $this->input->post("servicio")[$i],
                    "tiempo" => date("d-m-Y H:i:s")
                    );
                $r1 = $this->db->insert("detalle_servicio",$datos);
            }

            if($r && $r1) {
                $result = "m";
            } else {
                $result = "em";
            }

        }
        echo json_encode($result);
    }

    public function eliminar() {
      	$result = $this->BaseModel->eliminar(["persona","persona_id"]);
        echo json_encode($result);
    }

    public function get() {
        $personas = $this->db->query("select * from persona where estado=1 and persona_id=".$this->input->post("id"))
                ->row();
        echo json_encode($personas);
    }


    public function getCod() {
        $personas = $this->db->query("select * from persona where estado=1 and persona_codigo='".$this->input->post("codigo")."'")
                ->row();
        echo json_encode($personas);
    }

}
