<?php
class Classroom_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function criarConta($data)
    {
        $this->db->insert('user', $data);
        return $this->db->insert_id();
    }
    public function joinQuery($param)
    {
        $this->db->select('
        classroom.id as cid,
        professores.nome as tname,
        disciplinas.nome as sname,
        campus.name as campus,
        addresses.building as building,
        addresses.address as address,
        period.name as period,
        GROUP_CONCAT(distinct week_day.name order by week_day.id ASC SEPARATOR "," ) as wdays,
        GROUP_CONCAT(distinct classroom_week_day.room order by week_day.id ASC SEPARATOR ",") as rooms,
        GROUP_CONCAT(distinct classroom_week_day.start_time order by week_day.id ASC SEPARATOR ",") as start_times,
        GROUP_CONCAT(distinct classroom_week_day.end_time order by week_day.id ASC SEPARATOR ",") as end_times,
        classroom_week_day.start_time,
        classroom_week_day.end_time,
        addresses.iframe as maps_info
        ', false);
        $this->db->from('classroom');
        //$this->db->join('student_classroom', 'student_classroom.classroom_id = classroom.id');
        $this->db->join('disciplinas', 'disciplinas.id = classroom.subject_id');
        $this->db->join('professores', 'professores.id = classroom.teacher_id');
        $this->db->join('period', 'period.id = classroom.period_id');
        $this->db->join('classroom_week_day', 'classroom_week_day.classroom_id = classroom.id');
        $this->db->join('week_day', 'week_day.id = classroom_week_day.week_day_id');
        $this->db->join('addresses', 'addresses.id = classroom.address_id', 'left');
        $this->db->join('campus', 'campus.id = addresses.campus_id', 'left');
        //$this->db->group_by(array("professores.id", "disciplinas.id", "classroom_week_day.start_time"));
        $this->db->group_by(array("classroom.id"));
        if (!$param) {
            $query = $this->db->get();
            return $query;
        } else if ((int) $param) {
            $this->db->where('student_classroom.user_id', $param);
        } else {
            $this->db->like('disciplinas.nome', $param, 'both');
            $this->db->or_like('professores.nome', $param, 'both');
            //$this->db->like('teacher.name', $param, 'both');
            //print_r($turmas);
        }
        return $this->db->get();

    }

    private function getTurmasDetails()
    {
        return $this->db->select('
        classroom.id as cid,
        professores.nome as tname,
        disciplinas.nome as sname,
        campus.name as campus,
        addresses.building as building,
        addresses.address as address,
        period.name as period,
        GROUP_CONCAT(distinct week_day.name order by week_day.id ASC SEPARATOR "," ) as wdays,
        GROUP_CONCAT(distinct classroom_week_day.room order by week_day.id ASC SEPARATOR ",") as rooms,
        GROUP_CONCAT(distinct classroom_week_day.start_time order by week_day.id ASC SEPARATOR ",") as start_times,
        GROUP_CONCAT(distinct classroom_week_day.end_time order by week_day.id ASC SEPARATOR ",") as end_times,
        classroom_week_day.start_time,
        classroom_week_day.end_time,
        addresses.iframe as maps_info
        ', false);
    }

    public function getDetalhesTurmasUsuario($userId, $queryString)
    {

        $this->db = $this->getTurmasDetails();
        $this->db->from('classroom');
        $this->db->join('disciplinas', 'disciplinas.id = classroom.subject_id');
        $this->db->join('professores', 'professores.id = classroom.teacher_id');
        $this->db->join('period', 'period.id = classroom.period_id');
        $this->db->join('classroom_week_day', 'classroom_week_day.classroom_id = classroom.id');
        $this->db->join('week_day', 'week_day.id = classroom_week_day.week_day_id');
        $this->db->join('student_classroom', 'student_classroom.classroom_id = classroom.id');
        $this->db->join('addresses', 'addresses.id = classroom.address_id', 'left');
        $this->db->join('campus', 'campus.id = addresses.campus_id', 'left');
        $this->db->where('student_classroom.user_id', $userId);

        if ($queryString) {
            $this->db->like('disciplinas.nome', $queryString, 'both');
            $this->db->or_like('professores.nome', $queryString, 'both');
        }

        $this->db->group_by(array("professores.id", "disciplinas.id"));

        return $this->db->get();
    }

    public function getTableArray($collection)
    {
        $i = 0;
        foreach ($collection->result() as $row) {
            $tableArray[$i] = array(
                'id' => $row->cid,
                'turma' => $row->sname,
                'professor' => $row->tname,
                'horario_ini' => $row->start_time,
                'horario_fim' => $row->end_time,
                'horarios_ini' => $row->start_times,
                'horarios_fim' => $row->end_times,
                'dia' => $row->wdays,
                'campus' => $row->campus,
                'predio' => $row->building,
                'sala' => $row->rooms,
                'endereco' => $row->address,
                'periodo' => $row->period,
                'maps' => $row->maps_info,
            );
            $i++;
        }
        return $tableArray;
    }

    public function getTurmas()
    {
        $collection = $this->joinQuery(0);
        $className[] = '';
        if (!empty($collection->result())) {
            $className = $this->getTableArray($collection);
        }
        //var_dump($className);
        return $className;
    }

    public function getTurmasByUserId($id, $queryString)
    {
        $collection = $this->getDetalhesTurmasUsuario($id, $queryString);
        $className = null;
        if (!empty($collection->result())) {
            $className = $this->getTableArray($collection);
        }
        return $className;
    }

    public function getTurmasByName($name)
    {
        $collection = $this->joinQuery($name);

        $i = 0;
        //var_dump($name->result());
        $className[] = '';
        if (!empty($collection->result())) {
            $className = $this->getTableArray($collection);
        }
        // print_r($className);
        // echo '<br>';
        return $className;
    }
    public function getTurmaById($id)
    {
        $this->db = $this->getTurmasDetails();
        $this->db->from('classroom');
        $this->db->join('disciplinas', 'disciplinas.id = classroom.subject_id');
        $this->db->join('professores', 'professores.id = classroom.teacher_id');
        $this->db->join('period', 'period.id = classroom.period_id');
        $this->db->join('classroom_week_day', 'classroom_week_day.classroom_id = classroom.id');
        $this->db->join('addresses', 'addresses.id = classroom.address_id', 'left');
        $this->db->join('campus', 'campus.id = addresses.campus_id', 'left');
        $this->db->join('week_day', 'week_day.id = classroom_week_day.week_day_id');
        $this->db->where('classroom.id', $id);
        $collection = $this->db->get();
        //echo $this->db->last_query();
        $className[] = '';
        if (!empty($collection->result())) {
            $className = $this->getTableArray($collection);
        }
        return $className;
    }

    public function getOptionsAsDropdown($options, $optionName)
    {
        $dropdown = '<option value="">Selecione ' . $optionName . '</option>';
        if (count($options) > 0) {
            foreach ($options as $option) {
                $dropdown .= '<option value="' . $option->id . '">' . $option->name . '</option>';
            }
        }
        return $dropdown;
    }

    public function getTeacherAsDropdown()
    {
        $this->db->select('id, nome as name');
        $this->db->order_by('nome', 'asc');
        $options = $this->db->get('professores')->result();
        return $this->getOptionsAsDropdown($options, 'o Professor');
    }
    public function getSubjectAsDropdown()
    {
        $this->db->select('id, nome as name');
        $this->db->order_by('nome', 'asc');
        $options = $this->db->get('disciplinas')->result();
        return $this->getOptionsAsDropdown($options, 'a Matéria');
    }
    public function getPeriodAsDropdown()
    {
        $this->db->select('id, name');
        $options = $this->db->get('period')->result();
        return $this->getOptionsAsDropdown($options, 'o Período');
    }
    public function getAddressesAsDropdown()
    {
        $this->db->select('id, building as name');
        $options = $this->db->get('addresses')->result();
        return $this->getOptionsAsDropdown($options, 'o Prédio');
    }
    public function getCampusAsDropdown()
    {
        $this->db->select('id, name');
        $options = $this->db->get('campus')->result();
        return $this->getOptionsAsDropdown($options, 'o Campus');
    }

    //CRUD TURMA
    public function updateClassroom($data)
    {
        $values = array(
            'teacher_id' => $data["teacher_id"],
            'subject_id' => $data["subject_id"],
            'period_id' => $data["period_id"],
            'address_id' => $data["building"],
        );
        $this->db->where('id', $data["id"]);
        $this->db->update('classroom', $values);

        $this->db->delete('classroom_week_day', array('classroom_id' => $data["id"]));
        $count = count($data['1week_day']);
        for ($i = 0; $i < $count; $i++) {
            $time = array(
                'classroom_id' => $data["id"],
                'week_day_id' => $data['1week_day'][$i],
                'start_time' => $data['start_time'],
                'end_time' => $data['end_time'],
                'room' => $data['room']
            );
            $this->db->insert('classroom_week_day', $time);
        }
        if ($data['schedule-select'] == 2) {
            $count = count($data['2week_day']);
            for ($i = 0; $i < $count; $i++) {
                $time = array(
                    'classroom_id' => $data["id"],
                    'week_day_id' => $data['2week_day'][$i],
                    'start_time' => $data['2start_time'],
                    'end_time' => $data['2end_time'],
                    'room' => $data['2room']
                );
                $this->db->insert('classroom_week_day', $time);
            }
        }

    }
    public function createClassRoom($data)
    {
        $values = array(
            'teacher_id' => $data['teacher_id'],
            'subject_id' => $data['subject_id'],
            'period_id' => $data['period_id'],
            'address_id' => $data['building'],
        );
        $this->db->insert('classroom', $values);
        $last_id = $this->db->insert_id();
        $count = count($data['1week_day']);
        for ($i = 0; $i < $count; $i++) {
            $time = array(
                'classroom_id' => $last_id,
                'week_day_id' => $data['1week_day'][$i],
                'start_time' => $data['start_time'],
                'end_time' => $data['end_time'],
                'room' => $data['room']
            );
            $this->db->insert('classroom_week_day', $time);
        }
        if ($data['schedule-select'] == 2){
            $count = count($data['2week_day']);
            for ($i = 0; $i < $count; $i++) {
                $time = array(
                    'classroom_id' => $last_id,
                    'week_day_id' => $data['2week_day'][$i],
                    'start_time' => $data['2start_time'],
                    'end_time' => $data['2end_time'],
                    'room' => $data['2room']
                );
                $this->db->insert('classroom_week_day', $time);
            }
        }
    }
    public function deleteClassroom($id)
    {
        $this->db->delete('classroom_week_day', array('classroom_id' => $id));
        $this->db->delete('student_classroom', array('classroom_id' => $id));
        $this->db->delete('classroom', array('id' => $id));
    }

    //CRUD SUBJECT
    public function getSubjectByName($data)
    {
        $this->db->select('*, disciplinas.nome as name, cod_disc as code');
        $this->db->from('disciplinas');
        $this->db->order_by('disciplinas.nome', 'asc');
        return $this->db->get()->result();
    }
    public function updateSubject($data)
    {
        $values = array(
            'nome' => $data["name"],
            'cod_disc' => $data["code"],
        );
        $this->db->where('id', $data["id"]);
        $this->db->update('disciplinas', $values);
    }
    public function deleteSubject($data)
    {
        $this->db->delete('disciplinas', array('id' => $data["id"]));
    }
    public function createSubject($data)
    {
        $values = array(
            'nome' => $data["name"],
            'cod_disc' => $data["code"],
        );
        $this->db->insert('disciplinas', $values);
    }
    public function getClassroomName($id)
    {
        $this->db->select('nome as name');
        $this->db->from('disciplinas');
        $this->db->join('classroom', 'classroom.subject_id = disciplinas.id');
        $this->db->where('classroom.id', $id);
        return $this->db->get()->row();
    }

    //CRUD TEACHER
    public function getTeacherByName($data)
    {
        $this->db->select('*, nome as name');
        $this->db->from('professores');
        $this->db->like('nome', $data, 'both');
        $this->db->order_by('nome', 'asc');
        return $this->db->get()->result();
    }
    public function updateTeacher($data)
    {
        $values["nome"] = $data["name"];
        $values["email"] = $data["email"];
        if ($data["boolean"] == true) {
            $values["img_url"] = $data["path"];
        }
        $this->db->where('id', $data["id"]);
        $this->db->update('professores', $values);
    }
    public function deleteTeacher($data)
    {
        $this->db->delete('professores', array('id' => $data["id"]));
    }
    public function createTeacher($data)
    {
        $values['nome'] = $data["name"];
        $values["email"] = $data["email"];
        if ($data["boolean"] == true) {
            $values["img_url"] = $data["path"];
        }
        $this->db->insert('professores', $values);
    }

    //CRUD PERIOD
    public function getPeriodByName($data)
    {
        $this->db->select('*');
        $this->db->from('period');
        $this->db->like('name', $data, 'both');
        return $this->db->get()->result();
    }
    public function updatePeriod($data)
    {
        $values = array(
            'name' => $data["name"],
        );
        $this->db->where('id', $data["id"]);
        $this->db->update('period', $values);
    }
    public function deletePeriod($data)
    {
        $this->db->delete('period', array('id' => $data["id"]));
    }
    public function createPeriod($data)
    {
        $values = array(
            'name' => $data["name"],
        );
        $this->db->insert('period', $values);
    }

    public function insertStudentclassroom($userId, $classroomId)
    {
        $data = array(
            'user_id' => $userId,
            'classroom_id' => $classroomId,
        );
        $this->db->insert('student_classroom', $data);

    }
    public function removeStudentclassroom($userId, $classroomId)
    {
        $data = array(
            'user_id' => $userId,
            'classroom_id' => $classroomId,
        );
        $this->db->delete('student_classroom', $data);

    }
    public function getEmailByClassroom($cid)
    {
        $this->db->select('alunos.email as email, alunos.nome as name', false);
        $this->db->from('student_classroom');
        $this->db->join('alunos', 'alunos.id = student_classroom.user_id');
        $this->db->where('student_classroom.classroom_id', $cid);
        return $this->db->get();
    }

    //CRUD addresses

    public function getAddresses($like = null, $where = null)
    {
        $this->db->select('a.id as id, campus_id, c.name as campus, building, iframe, address');
        $this->db->from('addresses a');
        $this->db->join('campus c', 'a.campus_id = c.id');
        if (!is_null($like) && is_null($where)) {
            $this->db->like('c.name', $like, 'both');
            $this->db->or_like('a.building', $like, 'both');
        }
        if (is_null($like) && !is_null($where)) {
            $this->db->where('a.campus_id', $where);
        }
        return $this->db->get();
    }

    public function searchAddresses($query)
    {
        return $this->getAddresses($query, null);
    }

    public function getAddressesByCampusId($id)
    {
        return $this->getAddresses(null, $id);
    }

    public function getCampus()
    {
        return $this->db->get('campus');
    }

    public function updateAddresses($data)
    {
        $values = array(
            'campus_id' => $data["campus"],
            'building' => $data["building"],
            'iframe' => $data["iframe"],
            'address' => $data["address"],
        );
        $this->db->where('id', $data["id"]);
        $this->db->update('addresses', $values);
    }

    public function deleteAddresses($data)
    {
        $this->db->delete('addresses', array('id' => $data["id"]));
    }

    public function createAddresses($data)
    {
        $values = array(
            'campus_id' => $data["campus"],
            'building' => $data["building"],
            'iframe' => $data["iframe"],
            'address' => $data["address"],
        );
        $this->db->insert('addresses', $values);
    }

}
