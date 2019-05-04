<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->Model('Classroom_model');

    }
    public function index($outraFuncao = null)
    {
        //$this->load->view('admin/classroom_create_edit.phtml');

        //$data['user_id'] = $this->session->userdata('user_id');
        //$data['user_firstname'] = $this->session->userdata('user_firstname');
        is_null($outraFuncao) ? $data['table'] = $this->Classroom_model->getTurmas() : $data['table'] = $this->session->userdata('table');
        $data['Título_da_pagina'] = '';

        $data['_view'] = 'where_isclass/admin/home.phtml';
        $this->load->view('layouts/main', $data);

    }
    public function searchHome()
    { //TODO AJEITAR PESQUISA COM RESULTADO VAZIO
        $name = $this->input->post('search');
        $data['table'] = $this->Classroom_model->getTurmasByName($name);
        $this->session->set_userdata(array('table' => $data['table']));
        $this->index('temdado');

    }

    public function teachers()
    {
        $data['table'] = $this->Classroom_model->getTeacherByName('');

        $data['Título_da_pagina'] = '';
        $data['_view'] = 'where_isclass/admin/teachers.phtml';
        $this->load->view('layouts/main', $data);
    }
    public function searchTeachers()
    {
        $name = $this->input->post('search');
        $data['table'] = $this->Classroom_model->getTeacherByName($name);
        
        $data['Título_da_pagina'] = '';
        $data['_view'] = 'where_isclass/admin/teachers.phtml';
        $this->load->view('layouts/main', $data);

    }
    public function modalTeacher()
    {
        foreach ($_POST as $key => $value) {
            $data[$key] = $this->input->post($key);
        }
        $name = $data['name'];
        $teacherImage = $_FILES['teacherImage'];
        $config = array(
            'upload_path' => './imagens/teacherimage',
            'allowed_types' => 'gif|jpg|png|jpeg',
            'file_name' => $name . $_FILES['teacherImage']['name'],
            'max_width' => '10000',
            'max_height' => '10000',
            'max_size' => '5000',
        );
        $this->upload->initialize($config);
        if ($this->upload->do_upload('teacherImage')) {
            $path = 'imagens/teacherimage/' . str_ireplace(' ', '_', $config['file_name']);
            $data['path'] = $path;
            $data['boolean'] = true;
        } else {
            echo $this->upload->display_errors();
            $data['boolean'] = false;
        };

        if ($data["action"] == 'edit') {
            $this->Classroom_model->updateTeacher($data);
        } else if ($data["action"] == 'delete') {
            $this->Classroom_model->deleteTeacher($data);
        } else if ($data["action"] == 'create') {
            $this->Classroom_model->createTeacher($data);
        }
        redirect('where_isclass/admin/teachers');
    }

    public function subjects()
    {
        $data['table'] = $this->Classroom_model->getSubjectByName('');

        $data['Título_da_pagina'] = '';
        $data['_view'] = 'where_isclass/admin/subjects.phtml';
        $this->load->view('layouts/main', $data);
    }
    public function searchTurma()
    {
        $name = $this->input->post('search');
        $data['table'] = $this->Classroom_model->getSubjectByName($name);

        $data['Título_da_pagina'] = '';
        $data['_view'] = 'where_isclass/admin/subjects.phtml';
        $this->load->view('layouts/main', $data);
    }
    public function modalSubject()
    {
        foreach ($_POST as $key => $value) {
            $data[$key] = $this->input->post($key);
        }
        if ($data["action"] == 'edit') {
            $this->Classroom_model->updateSubject($data);
        } else if ($data["action"] == 'delete') {
            $this->Classroom_model->deleteSubject($data);
        } else if ($data["action"] == 'create') {
            $this->Classroom_model->createSubject($data);
        }
        redirect('where_isclass/admin/subjects');
    }

    public function periods()
    {
        $data['table'] = $this->Classroom_model->getPeriodByName('');

        $data['Título_da_pagina'] = '';
        $data['_view'] = 'where_isclass/admin/periods.phtml';
        $this->load->view('layouts/main', $data);

    }
    public function searchPeriods()
    {
        $name = $this->input->post('search');
        $data['table'] = $this->Classroom_model->getPeriodByName($name);

        $data['Título_da_pagina'] = '';
        $data['_view'] = 'where_isclass/admin/periods.phtml';
        $this->load->view('layouts/main', $data);

    }
    public function modalPeriod()
    {
        foreach ($_POST as $key => $value) {
            $data[$key] = $this->input->post($key);
        }
        if ($data["action"] == 'edit') {
            $this->Classroom_model->updatePeriod($data);
        } else if ($data["action"] == 'delete') {
            $this->Classroom_model->deletePeriod($data);
        } else if ($data["action"] == 'create') {
            $this->Classroom_model->createPeriod($data);
        }
        redirect('where_isclass/admin/periods');
    }

    public function classroom($id, $action)
    {
        if (!strcmp($action, 'editar')) {
            $data['turma'] = $this->Classroom_model->getTurmaById($id);
        }
        $data['action'] = $action;

        $data['teacherDropdown'] = $this->Classroom_model->getTeacherAsDropdown();
        $data['subjectDropdown'] = $this->Classroom_model->getSubjectAsDropdown();
        $data['periodDropdown'] = $this->Classroom_model->getPeriodAsDropdown();

        $data['Título_da_pagina'] = '';

        $data['_view'] = 'where_isclass/admin/classroom_create_edit.phtml';
        $this->load->view('layouts/main', $data);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url());
    }

    public function editTurma()
    {
        foreach ($_POST as $key => $value) {
            $data[$key] = $this->input->post($key);
        }
        $y = 0;
        for ($i = 1; $i <= 6; $i++) {
            if (isset($data['weekDayOptions' . $i])) {
                $data['week_day'][$y] = $i;
                $y++;
            }
        }
        $this->Classroom_model->updateClassroom($data);
        $this->sendEmail($data['id']);
        redirect('admin/admin');
    }
    public function createTurma()
    {
        foreach ($_POST as $key => $value) {
            $data[$key] = $this->input->post($key);
        }
        $x = 0;
        $y = 0;
        for ($i = 1; $i <= 6; $i++) {
            if (isset($data['weekDayOptions' . $i])) {
                $data['week_day'][$x] = $i;
                $x++;
            }
            if ($data['schedule-select'] == 2 && isset($data['2weekDayOptions' . $i])) {
                $data['2week_day'][$y] = $i;
                $y++;
            }
        }
        var_dump($data);
        // $this->Classroom_model->createClassroom($data);
        // redirect('admin/admin');
    }
    public function deleteTurma($id)
    {
        $this->Classroom_model->deleteClassroom($id);
        redirect('admin/admin');
    }
    public function sendEmail($cid)
    {
        $classroomName = $this->Classroom_model->getClassroomName($cid);
        $result = $this->Classroom_model->getEmailByClassroom($cid);
        foreach ($result->result() as $row) {
            $mail_message = 'Dear ' . $row->name . ',' . "\r\n";
            $mail_message .= 'A Turma <b>' . $classroomName->name . '</b> foi atualizada!';
            $mail_message .= '<br>Por favor, acesse o site <a>http://localhost/where-is-my-classroom</a> e confira!.';
            $mail_message .= '<br>Thanks & Regards';
            $mail_message .= '<br>Your company name';
            date_default_timezone_set('Etc/UTC');
            $this->load->library("phpmailer_library");
            $mail = $this->phpmailer_library->load();
            $mail->isSMTP();
            $mail->SMTPSecure = "tls";
            $mail->Debugoutput = 'html';
            $mail->Host = "smtp.live.com";
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->Username = "wjmarcolin@hotmail.com";
            $mail->Password = "Wilson010695";
            $mail->setFrom('wjmarcolin@hotmail.com', 'admin');
            $mail->IsHTML(true);
            $mail->addAddress($row->email);
            $mail->Subject = 'OTP from company';
            $mail->Body = $mail_message;
            $mail->AltBody = $mail_message;
            if (!$mail->send()) {
                $this->session->set_flashdata('msg', 'Failed to send password, please try again!');
            } else {
                $this->session->set_flashdata('msg', 'Password sent to your email!');
            }
        }
        return;
    }
}
