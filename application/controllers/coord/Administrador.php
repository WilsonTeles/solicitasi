<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Administrador extends CI_Controller {

    function __construct() {

        parent::__construct();

        if ($this->session->userdata('status') != "admin") {
            $this->session->sess_destroy();
            redirect('coord/Login_adm');
        }
        if (DEBUGAR) {
            $this->output->enable_profiler(TRUE);
        };

    }

    public function index() {


        $data['Título_da_pagina'] = '';

        $data['_view'] = 'coord/principal';
        $this->load->view('layouts/main', $data);
    }

   

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */