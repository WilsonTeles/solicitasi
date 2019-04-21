<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Aluno extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (($this->session->userdata('status') != "aluno") ) {
            $this->session->sess_destroy();
            redirect('aluno/Login');
        }
        $this->output->delete_cache();
        if (DEBUGAR) {
            $this->output->enable_profiler(TRUE);
        };

        $this->load->model('Aluno_model');
    }

    public function index() {

        $this->load->model('Aluno_model');
        $data = $this->Aluno_model->get_aluno($this->session->userdata('id'));

        $data['Título_da_pagina'] = '';

        $data['_view'] = 'aluno/principal';
        $this->load->view('layouts/main', $data);
    }

    

}
