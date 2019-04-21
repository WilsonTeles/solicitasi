<?php


class Professores_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_professores($id) {
        return $this->db->get_where('professores', array('id' => $id))->row_array();
    }


    function get_all_professores_count() {
        $this->db->from('professores');
        return $this->db->count_all_results();
    }

    function get_all_professores($params = array()) {
        $this->db->order_by('nome', 'asc');
        if (isset($params) && !empty($params)) {
            $this->db->limit($params['limit'], $params['offset']);
        }
        return $this->db->get('professores')->result_array();
    }



}
