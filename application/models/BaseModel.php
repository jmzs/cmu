<?php

class BaseModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * [insertar description]
     * @param  [string]  $tabla  [nombre de la tabla a insertar]
     * @param  [array]  $data   [los datos con campos de la tabla y su valor respectivo ]
     * @param  boolean $status [si la tabla tiene un pk es false, si no es un detalle es true ]
     * @return [type]          [description]
     */
    public function insertar($tabla, $data, $status = false) {
        #$i = 0;
        if(!$status) {
            foreach ($data as $key => $value) {
                $parts = explode("_",$value->campo);
                if($parts[1] == "id") {
                    continue;
                }
                $datos[$value->campo] = $value->value;
            }
            $estado = $this->db->insert($tabla, $datos);
        } else {
            foreach ($data as $key => $value) {
                if(is_array($value->value)) {
                    for ($i=0; $i < count($value->value); $i++) {
                        $datos[$value->campo] = $value->value[$i];
                        $estado = $this->db->insert($tabla, $datos);
                    }
                } else {
                    $datos[$value->campo] = $value->value;
                }
            }
        }
        if ($estado) {
            return "i";
        } else {
            return "ei";
        }
    }

    public function modificar($tabla, $data) {
        foreach ($data as $key => $value) {
            if($value->campo == reset($data)->campo) {
                $id = $value->campo;
            } else {
                $datos[$value->campo] = $value->value;
            }
        }
        $this->db->where($id, $this->input->post($id));
        $estado = $this->db->update($tabla, $datos);
        if ($estado) {
            return "m";
        } else {
            return "em";
        }
    }

    public function eliminar($array) {
        $data = array(
            "estado" => 0
        );
        $this->db->where($array[1], $this->input->post("id"));
        $estado = $this->db->update($array[0], $data);
        if ($estado) {
            return "e";
        } else {
            return "ee";
        }
    }

    public function getPermisos($status = false) {
        if(!$status) {
            $modulos = $this->db->get_where("seguridad.modulo",array("estado"=>"1", "modulo_padre"=>"1", "modulo_id>"=>1))->result_array();
            foreach ($modulos as $key => $value) {
                $modulos[$key]["hijos"] =        $this->db->get_where("seguridad.modulo",array("modulo_padre"=>$value["modulo_id"], "estado"=>"1"))->result_array();
            }
        } else {
            $modulos = array();
            $modulos_padres = $this->db->get_where("seguridad.modulo",array("estado"=>"1", "modulo_padre"=>"1", "modulo_id>"=>1))->result_array();
            $i = 0;
            foreach ($modulos_padres as $key => $value) {
                $r = $this->db->query("select * from seguridad.modulo as m inner join seguridad.permisos as p on(m.modulo_id=p.modulo_id) where m.estado = 1 and p.perfil_id = ".$_SESSION['perfil_id']." and m.modulo_padre = ".$value["modulo_id"])->result_array();
                if(count($r)>0) {
                    $modulos[$i] = $value;
                    $modulos[$i]["hijos"] = $r;
                    $i++;
                }
            }
        }
        return $modulos;

    }

}

?>
