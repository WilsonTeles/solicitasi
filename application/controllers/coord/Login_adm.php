<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login_adm extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {

        $this->load->helper('captcha');

        $vals = array(
            'img_path' => './captcha/',
            'img_url' => base_url() . 'captcha/'
        );

        $cap = create_captcha($vals);


        $data = array(
            'captcha_time' => $cap['time'],
            'ip_address' => $this->input->ip_address(),
            'word' => $cap['word'],
            'img_width' => '300',
            'img_height' => 100,
            'expiration' => 3600
        );


        $this->session->set_userdata($data);
        $data['cap_img'] = $cap['image'];

        $data['Título_da_pagina'] = 'Login Adm';
        $data['_view'] = 'coord/login_coord';
        $this->load->view('layouts/main', $data);
    }

    public function validar_dados() {

        $this->form_validation->set_rules('senha', 'senha', 'trim|required');
        $this->form_validation->set_rules('captcha', 'Security Code', 'trim|required|callback_check_captcha');
        $this->form_validation->set_rules('login', 'Login', 'trim|required|callback_check_login');

        if ($this->form_validation->run() == FALSE) {

            $this->index();
        } else {

            $data = array(
                'login' => $this->input->post('login'),
                'senha' => $this->input->post('senha'),
            );

            $data = $this->security->xss_clean($data);
            if (!$this->security->xss_clean($data)) {
                $this->index(); // erro
            }

            $login = $data['login'];
            $senha = $data['senha'];

            $this->load->model('Administrador_model');
            $query = $this->Administrador_model->get_admin($login, $senha);

            $this->load->model('Configura_model');
            $dados_configura = $this->Configura_model->getConfigura();

            $data = array(
                'idadm' => $query[0]->id,
                'nome_admin' => $query[0]->nome,
                'email_admin' => $query[0]->email,
                'status' => 'admin',
                'semestreano' => $dados_configura['semestreano'],
                'manutencao' => $dados_configura['manutencao'],
                'dt_final_ajuste' => $dados_configura['dt_final_ajuste'],
            );

            $this->session->set_userdata($data);

            redirect('coord/Administrador/index');
        }
    }

    public function check_login() {

        $login = $this->input->post('login');
        $senha = $this->input->post('senha');

        $login = $this->security->xss_clean($login);
        $senha = $this->security->xss_clean($senha);

        $this->load->model('Administrador_model');
        $query = $this->Administrador_model->get_admin($login, $senha);

        if (sizeof($query) == 0) {
            $this->form_validation->set_message('check_login', 'Login ou Senha não Confere');
            return false;
        } else {
            return true;
        }
    }

    public  function check_captcha() {
        $expiration = time() - 7200; // Two hour limit
        $cap = strtoupper($this->input->post('captcha'));

        $cap = $this->security->xss_clean($cap);

        if (strtoupper($this->session->userdata('word')) == $cap
                AND $this->session->userdata('ip_address') == $this->input->ip_address()
                AND $this->session->userdata('captcha_time') > $expiration) {
            return true;
        } else {
            $this->form_validation->set_message('check_captcha', 'C&oacute;digo de Seguran&ccedil;a n&atilde;o Confere');
            return false;
        }
    }

}

/* End of file welcome.php */
    /* Location: ./application/controllers/welcome.php */