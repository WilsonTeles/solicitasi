<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function index() {
        $data['Título_da_pagina'] = '';

        $data['_view'] = 'welcome_message';
        $this->load->view('layouts/main', $data);
    }

}
