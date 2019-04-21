<?php

class Disciplina_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /*
     * Get disciplina by id
     */

    function get_disciplina($id) {
        return $this->db->get_where('disciplinas', array('id' => $id))->row_array();
    }

    /*
     * Get all disciplinas count
     */

    function get_all_disciplinas_count() {
        $this->db->from('disciplinas');
        return $this->db->count_all_results();
    }

    /*
     * Get all disciplinas
     */

    function get_all_disciplinas($params = array()) {
        $this->db->order_by('nome', 'asc');
        if (isset($params) && !empty($params)) {
            $this->db->limit($params['limit'], $params['offset']);
        }
        return $this->db->get('disciplinas')->result_array();
    }

    function addDisciplina($data) {
        if (!$this->getDisciplinaCodigo($data['cod_disc'])) {
            $this->db->insert('disciplinas', $data);
        }
    }

    function getDisciplinaCodigo($codigo) {
        $this->db->select('*');
        $this->db->from('disciplinas');
        $this->db->where('cod_disc', $codigo);
        $query = $this->db->get();

        return $query->row_array();
    }

}
