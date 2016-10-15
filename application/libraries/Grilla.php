<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Grilla 1.0 fase Beta
 * Author: The Lighthammer
 */
class Grilla {

    protected $ci;
    private $column;
    private $table;
    private $id;
    private $join;
    private $select;
    private $from;
    private $where;
    private $order_by;
    private $dir;

    public function __construct() {
        $this->ci = & get_instance();
        //$this->dir = "asc";
    }

    public function setDir($dir) {
        $this->ci->db->insert("log.order",array("order_nombre"=>$dir));
        $this->dir = $this->ci->db->insert_id();
    }

    public function getDir() {
        $dir = $this->ci->db->select_max("order_id")->get("log.order")->row();
        if(count($dir)>0) {
            $order = $this->ci->db->get_where("log.order",array("order_id"=>$dir->order_id))->row();
            if(count($order)>0) {
                return $order->order_nombre;
            } else {
                return "asc";
            }
        } else {
            return "asc";
        }
    }

    public function setJoin($table, $join) {
        $array = array("table" => $table, "join" => $join);
        $object = (object) $array;
        $this->join[] = $object;
    }

    public function getJoin() {
        return $this->join();
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function addColumn($column_consult,$column_result,$description) {
    	 $array = array("column_consult" => $column_consult, "column_result" => $column_result,"description" => $description);
        $object = (object) $array;
        $this->column[] = $object;
    }

    public function setColumn($column, $description) {
        $array = array("column" => $column, "description" => $description);
        $object = (object) $array;
        $this->column[] = $object;
    }

    public function getColumns() {
        return $this->column;
    }

    public function setTable($table) {
        $this->table = $table;
    }

    public function getTable() {
        return $this->table;
    }

    public function setSelect($select) {
        $this->select = $select;
    }

    public function getSelect() {
        return $this->select;
    }

    public function setFrom($from) {
        $this->from = $from;
    }

    public function getFrom() {
        return $this->from;
    }

    public function setWhere($where) {
        $this->where = $where;
    }

    public function getWhere() {
        return $this->where;
    }

    public function setOrderBy($order_by) {
        $this->order_by = $order_by;
    }

    public function getOrderBy() {
        return $this->order_by;
    }

    public function grillaData() {
        $this->setColumn(null, "Accion");
        $columns = $this->getColumns();
        $table = $this->getTable();

        $like_total = "";
        $total_registros = $this->ci->db->get_where($table, array("estado" => "1"))->num_rows();
        $total_filtered = $total_registros;
        $select = "select ";
        $where = "from " . $table . " where estado=1 ";
        $i = 0;
        $cont =  count($columns);
        foreach ($columns as $llave => $columna) {
            if($cont > 0 && reset($columns)->column != $columna->column) {
                $array_columns[] = $columna->column;
            }
            $cont --;
        }
        foreach ($columns as $value) {

            if ($i > count($columns) - 3) {
                $select .= $value->column . " ";
            } else {
                $select .= $value->column . ", ";
            }
            $i++;
        }
        $i = 0;
        if ( !empty($_REQUEST['search']['value'])  || $_REQUEST['order'][0]['dir'] != $this->getDir() ) {
            $this->setDir($_REQUEST['order'][0]['dir']);
            foreach ($columns as $value) {
                if ($i == 0 || $value->column == null) {
                    $i++;
                    continue;
                }
                if ($i > count($columns) - 3) {
                    $like_total .= " CAST( COALESCE(" . $value->column . ",'') as text) ";
                } elseif ($i > 0) {

                    $like_total .= " CAST( COALESCE(" . $value->column . ",'') as text) || ' ' || ";
                }
                if ($i == 1) {

                    $where .= "and ( CAST( COALESCE(" . $value->column . ",'') as text) ilike '%" . $_REQUEST['search']['value'] . "%' ";
                } else {

                    $where .= "or CAST( COALESCE(" . $value->column . ",'') as text) ilike '%" . $_REQUEST['search']['value'] . "%' ";
                }
                $i++;
            }
            $where .= "or CONCAT(" . $like_total . ") ilike '%" . $_REQUEST['search']['value'] . "%' )";
            if(isset($array_columns[$_REQUEST['order'][0]['column']])) {
                $order_by = " order by " . $array_columns[$_REQUEST['order'][0]['column']] . " ".$_REQUEST['order'][0]['dir']." limit " . $_REQUEST['length'] . "  offset " . $_REQUEST['start'] . "  ";
            } else {
                $order_by = " order by " . $array_columns[0] . " ".$_REQUEST['order'][0]['dir']." limit " . $_REQUEST['length'] . "  offset " . $_REQUEST['start'] . "  ";
            }
        } else {

            $order_by = " order by " . $columns[0]->column . " desc limit " . $_REQUEST['length'] . "  offset " . $_REQUEST['start'] . "  ";

        }

        $consulta = $select . $where . $order_by;
        #print_r($consulta); exit;
        $registros = $this->ci->db->query($consulta)->result();
        $j = 0;
        if (count($registros) > 0) {

            foreach ($registros as $key => $value) {
                $i = 0;
                foreach ($columns as $column) {
                    if ($column->column == null) {
                        continue;
                    }
                    $column_name = (string) $column->column;
                    if ($i > 0) {
                        $data[$j][] = '<center>' . $value->$column_name . '</center>';
                    } else {
                        $id = $value->$column_name;
                    }
                    $i++;
                }
                $data[$j][] = '<center><button id=' . $id . ' class="btn btn-success modificar">Modificar</button>&nbsp;&nbsp;<button id=' . $id . ' class="btn btn-danger eliminar">Eliminar</button></center></center>';
                $j++;
            }
        } else {
            $data = array();
        }

        $json_data = array(
            "draw" => intval($_REQUEST['draw']),
            "recordsTotal" => intval($total_registros),
            "recordsFiltered" => intval($total_filtered),
            "data" => $data
        );

        return $json_data;
    }

    public function grillaSqlData() {

        $this->addColumn(null, null, "Accion");
      	$columns = $this->getColumns();
        $select = "select " . $this->getSelect();
        $from = " from " . $this->getFrom();
        $where = " where " . $this->getWhere();
        $like_total = "";
        $i = 0;
        $query = $select.$from.$where;
        $total_registros = $this->ci->db->query($query)->num_rows();
        $total_filtered = $total_registros;
        $cont =  count($columns);
        foreach ($columns as $llave => $columna) {
            if($cont > 0 && reset($columns)->column_consult != $columna->column_consult) {
                $array_columns[] = $columna->column_consult;
            }
            $cont --;
        }
       if ( !empty($_REQUEST['search']['value'])  || $_REQUEST['order'][0]['dir'] != $this->getDir() ) {
            $this->setDir($_REQUEST['order'][0]['dir']);

            foreach ($columns as $value) {
                if ($i == 0 || $value->column_consult == null) {
                    $i++;
                    continue;
                }
                if ($i > count($columns) - 3) {
                    $like_total .= " CAST( COALESCE(" . $value->column_consult . ",'') as text) ";
                } elseif ($i > 0) {

                    $like_total .= " CAST( COALESCE(" . $value->column_consult . ",'') as text) || ' ' || ";
                }
                if ($i == 1) {

                    $where .= " and ( CAST( COALESCE(" . $value->column_consult . ",'') as text) ilike '%" . $_REQUEST['search']['value'] . "%' ";
                } else {

                    $where .= "or CAST( COALESCE(" . $value->column_consult . ",'') as text) ilike '%" . $_REQUEST['search']['value'] . "%' ";
                }
                $i++;
            }
            $where .= "or CONCAT(" . $like_total . ") ilike '%" . $_REQUEST['search']['value'] . "%' )";
            if(isset($array_columns[$_REQUEST['order'][0]['column']])) {
                $order_by = " order by " . $array_columns[$_REQUEST['order'][0]['column']] . " ".$_REQUEST['order'][0]['dir']." limit " . $_REQUEST['length'] . "  offset " . $_REQUEST['start'] . "  ";
            } else {
                $order_by = " order by " . $columns[0]->column_consult  . " ".$_REQUEST['order'][0]['dir']." limit " . $_REQUEST['length'] . "  offset " . $_REQUEST['start'] . "  ";
            }
        } else {
            $order_by = " order by " . $columns[0]->column_consult . " desc limit " . $_REQUEST['length'] . "  offset " . $_REQUEST['start'] . "  ";
        }


        $consulta = $select . $from . $where . $order_by;
        #print_r($consulta); exit;

        $registros = $this->ci->db->query($consulta)->result();

        $j = 0;
        if (count($registros) > 0) {
            foreach ($registros as $key => $value) {
                $i = 0;
                foreach ($columns as $column) {
                    if ($column->column_result == null) {
                        continue;
                    }
                    $column_name = (string) $column->column_result;
                    if ($i > 0) {

                        $data[$j][] = '<center>' . $value->$column_name . '</center>';
                    } else {
                        $id = $value->$column_name;
                    }
                    $i++;
                }
                $data[$j][] = '<center><a href="'.base_url().'personaController/update/'.$id.'" id=' . $id . ' class="btn btn-success">Modificar</a>&nbsp;&nbsp;';
                //<button id=' . $id . ' class="btn btn-danger eliminar">Eliminar</button></center></center>
                $j++;
            }
        } else {
            $data = array();
        }

        $json_data = array(
            "draw" => intval($_REQUEST['draw']),
            "recordsTotal" => intval($total_registros),
            "recordsFiltered" => intval($total_filtered),
            "data" => $data
        );

        return $json_data;
    }



    public function dibujarTabla() {
        $columnas = $this->getColumns();
        $html = '<div class="table-responsive">';
        $html .= '<table id="' . $this->getId() . '" cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered display" >';
        $html .= '<thead><tr>';
        $i = 0;
        foreach ($columnas as $descripcion) {
            if ($i > 0) {
                $html .= '<th><center>' . $descripcion->description . '</center></th>';
            }
            $i++;
        }
        $html .= '<th><center>Acción</center></th>';
        $html .= '</tr></thead>';
        $html .= '</table>';
        $html .= '</div>';
        return $html;
    }

}

?>
