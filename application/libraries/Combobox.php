<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Combobox 1.0 fase Beta
 * Author: The Lighthammer
 */
class Combobox {
	public function combobox($table,$indexs) {
        $fields = $this->db->list_fields($table);
        $where = array("estado"=>"1");
        $regs = $this->db->get_where($table,$where)->result();
        $html = '<select name="'.$indexs[0].'" class="form-control">';
        foreach($regs as $key => $value) {
            $html .= '<option value="'.$value[$fields[$indexs[0]]].'">'.$value[$fields[$indexs[1]]].'</option>';
        }
        $html .= '</select>';
        return $html;
    }

}


 ?>