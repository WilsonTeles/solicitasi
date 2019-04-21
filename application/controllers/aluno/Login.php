<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (DEBUGAR) {
            $this->output->enable_profiler(TRUE);
        };
    }

    public function index() {

        $this->load->model('Configura_model');
        $manutencao = $this->Configura_model->getData_Manutencao();
        if ($manutencao == 'S') {
            echo 'Sistema em Manuten&ccedil;&atilde;o';
        } else {
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
                'img_width' => '500',
                'img_height' => 100,
                'expiration' => 3600
            );


            $this->session->set_userdata($data);
            $data['cap_img'] = $cap['image'];

            $data['Título_da_pagina'] = '';
            $data['_view'] = 'aluno/login';
            $this->load->view('layouts/main', $data);
        }
    }

    public function validar_dados() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') :

            $this->form_validation->set_rules('matricula', 'Matricula', 'trim|required|min_length[8]');
            $this->form_validation->set_rules('senha', 'Senha', 'trim|required');
            //$this->form_validation->set_rules('captcha', 'Security Code', 'trim|required|callback_check_captcha');
            $this->form_validation->set_rules('login', 'Login', 'trim|callback_check_login');

            if ($this->form_validation->run() == FALSE) {
                $this->index();
            } else {

                $matricula = $this->input->post('matricula', TRUE);
                $senha = $this->input->post('senha', TRUE);

                $this->load->model('Configura_model');
                $dados_configura = $this->Configura_model->getConfigura();
                $datafinalajuste = $this->Configura_model->getData_Final_Ajuste();

                $this->load->helper('date');

                date_default_timezone_set('America/Sao_Paulo');
                $datestring = "%Y-%m-%d";
                $time = time();
                $hoje = mdate($datestring, $time);

                $this->load->model('Aluno_model');
                $this->db->where('matricula', $matricula);
                $this->db->where('senha', $senha);

                $query = $this->db->get('alunos');


                if ($query->num_rows() == 1) { // VERIFICA LOGIN E SENHA   
                    foreach ($query->result() as $row) {

                        if ($row->status == 'A') {
                            $status = 'aluno';
                        } else {
                            $status = 'formado';
                        }
                        $id = $row->id;
                        $data = array(
                            'nome' => $row->nome,
                            'matricula' => $row->matricula,
                            'email' => $row->email,
                            'id' => $row->id,
                            'status' => $status,
                            'senha_alterada' => $row->alterada,
                            'podefazerajuste' => !($datafinalajuste <= $hoje)
                        );
                    }


                    $arquivo = 'imagens/alunos/' . $row->matricula . '.jpg';

                    if (file_exists($arquivo)) {
                        $data['foto'] = $arquivo;
                    } else {
                        $data['foto'] = 'imagens/semimagem.jpg';
                    }

                    $this->session->set_userdata($data);

                    // TESTAR SE PRECISA FAZER TROCA DE SENHA PARA FORMADOR

                    if ($data['senha_alterada'] == 'S') {

                        if ($row->status == 'A') {
                            redirect('aluno/Aluno/trocar_senha');
                        } else {
                            redirect('formado/Formado/trocar_senha');
                        }
                    } else {

                        if ($row->status == 'A') {
                            redirect('aluno/Aluno');
                        } else {
                            redirect('formado/Formado');
                        }
                    }
                } else {

                    $this->index();
                }
            }
        else :
            $this->index();
        endif;
    }

    // callback para validar o captcha
    public function check_captcha() {
        $expiration = time() - 7200; // Two hour limit
        $cap = mb_strtoupper($this->input->post('captcha'));

        if (mb_strtoupper($this->session->userdata('word')) == $cap
                AND $this->session->userdata('ip_address') == $this->input->ip_address()
                AND $this->session->userdata('captcha_time') > $expiration) {
            return true;
        } else {
            $this->form_validation->set_message('check_captcha', 'C&oacute;digo de Seguran&ccedil;a n&atilde;o Confere');
            return false;
        }
    }

    // callback para validar o login
    public function check_login() {

        $matricula = $this->input->post('matricula');
        $senha = $this->input->post('senha');

        $this->load->model('Aluno_model');
        if ($this->Aluno_model->valida_AlunoSenha($matricula, $senha)) {
            return true;
        } else {
            $this->form_validation->set_message('check_login', 'Matricula ou Senha não Confere');
            return false;
        }
    }

   
}
