<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *         http://example.com/index.php/welcome
     *    - or -
     *         http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    public function __construct()
    {
        parent::__construct();
        $this->load->Model('Classroom_model');
        //$this->load->Model('Login_model');
    }
    public function index($table = null)
    {
        $data['table'] = $this->Classroom_model->getTurmas();
        if ($this->session->userdata('status') == 'aluno') {
            $data['user_id'] = $this->session->userdata('id');
            $userTable = $this->Classroom_model->getTurmasByUserId($data['user_id'], null);
            if (!is_null($table)) {
                $data['table'] = $table['table'];
            }
            $data['table'] = $this->compareTurmas($data['table'], $userTable);
        }

        $data['Título_da_pagina'] = '';
        $data['_view'] = 'where_isclass/home.phtml';
        $this->load->view('layouts/main', $data);
    }
    public function login($data = null)
    {
        $this->load->view('login.phtml', $data);
    }
    public function forgotPassword()
    {
        $this->load->view('forgot_password.phtml');
    }
    public function resetPassword()
    {
        $email = $this->input->post('email');
        $findemail = $this->Login_model->forgotPassword($email);
        if ($findemail) {
            $this->Login_model->sendpassword($findemail);
        } else {
            $this->session->set_flashdata('msg', ' Email not found!');
            redirect(base_url() . 'home/forgotPassword', 'refresh');
        }
    }
    public function changePassword($data = null)
    {
        if (isset($data)) {
            $this->load->view('change_password.phtml', $data);
        } else {
            foreach ($_POST as $key => $value) {
                $data[$key] = $this->input->post($key);
            }
            $this->Login_model->changePassword($data);
            redirect('user/user');
        }
    }
    public function criarConta($data = null)
    {
        $this->load->view('criar_conta.phtml', $data);
    }

    public function salvarConta()
    {
        $this->load->library('form_validation');
        $validLogin = false;
        $this->form_validation->set_rules('first_name', 'Nome', 'required');
        $this->form_validation->set_rules('last_name', 'Sobrenome', 'required');
        $this->form_validation->set_rules('enrollment_code', 'Matricula', 'required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Senha', 'required');

        if (!$this->form_validation->run()) {
            $this->index();
            //redirect('./');
            //$this->load->view('home.phtml');
        } else {
            foreach ($_POST as $key => $value) {
                $data[$key] = $this->input->post($key);
            }
            $data['is_admin'] = 0;
            $email = $this->db->get_where('user', array('email' => $data['email']))->row();
            $mat = $this->db->get_where('user', array('enrollment_code' => $data['enrollment_code']))->row();
            if (isset($email) || isset($mat)) {
                $data['error'] = 'Email ou matrícula já cadastrado(s).';
                $this->criarConta($data);
            } else {
                $last_id = $this->Classroom_model->criarConta($data);
                $session = array('user_id' => $last_id, 'user_firstname' => $data['first_name'], 'is_admin' => $data['is_admin'], 'logged' => true);
                $this->session->set_userdata($session);
                redirect('user/user');
            }
        }
    }

    public function loginValidate()
    {
        $this->load->library('form_validation');
        $validLogin = false;
        $this->form_validation->set_rules('login', 'Login', 'trim|required|valid_email');
        $this->form_validation->set_rules('senha', 'Senha', 'required');

        if (!$this->form_validation->run()) {
            $this->index();
            //redirect('./');
            //$this->load->view('home.phtml');
        } else {
            $login = $this->input->post('login');
            $senha = $this->input->post('senha');
            $query = $this->db->get_where('user', array('email' => $login, 'password' => $senha));
            $row = $query->row();
            if (isset($row)) {
                $data = array('user_id' => $row->id, 'user_firstname' => $row->first_name, 'is_admin' => $row->is_admin, 'logged' => true);
                $this->session->set_userdata($data);
                if ($row->change_password) {
                    $this->changePassword($data);
                } else if ($row->is_admin == 1) {
                    redirect('admin/admin');
                } else {
                    redirect('user/user');
                }
            } else {
                $data['error'] = 'Login ou Senha Inválidos';
                $this->login($data);
            }
        }
    }
    private function montaTabela()
    {
        $this->load->library('table');
        $this->table->set_heading('Turma', 'Campus', 'Predio', 'Sala');
        $turmas = $this->Classroom_model->getTurmas();
        foreach ($turmas as $turma) {
            $table_row = null;
            $table_row[] = $turma["Turma"];
            $table_row[] = $turma["Campus"];
            $table_row[] = $turma["Predio"];
            $table_row[] = $turma["Sala"];
            $this->table->add_row($table_row);
        }
        return $this->table->generate();
    }
    public function searchTurma()
    {

        $name = $this->input->post('search');
        $data['table'] = $this->Classroom_model->getTurmasByName($name);
        //$this->session->set_userdata(array('table' => $data['table']));
        $this->index($data);
        //$this->load->view('home.phtml', $data);
    }

    public function compareTurmas($table, $userTable = null)
    {
        //var_dump($userTable);
        if (!empty($table) && !empty($userTable)) {
            for ($i = 0; $i < count($table); $i++) {
                for ($y = 0; $y < count($userTable); $y++) {
                    if ($table[$i]['id'] == $userTable[$y]['id']) {
                        $table[$i]['checked'] = 'checked';
                        break;
                    } else {
                        $table[$i]['checked'] = 'check';
                    }

                }
            }
        }
        if (is_null($userTable)) {
            for ($i = 0; $i < count($table); $i++) {
                $table[$i]['checked'] = '';
            }
        }
        //var_dump($table);
        return $table;
    }
}
