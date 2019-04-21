<?php

class Aluno_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /*
     * Get aluno by id
     */

    function get_aluno($id) {
        return $this->db->get_where('alunos', array('id' => $id))->row_array();
    }

    function get_um_aluno($id) {
        return $this->db->get_where('alunos', array('id' => $id))->result_array();
    }


    function valida_AlunoSenha($matricula, $senha) {

        $this->db->where('matricula', $matricula);
        $this->db->where('senha', $senha);

        $query = $this->db->get('alunos')->result();

        if (count($query) === 1) {
            return true;
        } else {
            return false;
        }
    }

    function valida_MatriculaEmail($matricula, $email) {

        $this->db->where('matricula', $matricula);
        $this->db->where('email', $email);

        $query = $this->db->get('alunos')->result();

        if (count($query) === 1) {
            return true;
        } else {
            return false;
        }
    }

    function getNomeAlunoMatricula($matricula) {
        $this->db->select('nome');
        $this->db->limit(1);
        $this->db->from('alunos');
        $this->db->where('matricula', $matricula);
        $query = $this->db->get();

        $resultado = $query->result();

        return $resultado[0]->nome;
    }

    function getemailAlunoMatricula($matricula) {
        $this->db->select('email');
        $this->db->limit(1);
        $this->db->from('alunos');
        $this->db->where('matricula', $matricula);
        $query = $this->db->get();

        $resultado = $query->result();

        return $resultado[0]->email;
    }

}
