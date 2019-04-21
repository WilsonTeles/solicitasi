<?php
 
class Administrador_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get administradore by id
     */
    function get_administradore($id)
    {
        return $this->db->get_where('administradores',array('id'=>$id))->row_array();
    }

    /*
     * function to delete administradore
     */
    function delete_administradore($id)
    {
        return $this->db->delete('administradores',array('id'=>$id));
    }
    
    function get_admin($login, $senha) {
       
        $this->db->where('login', $login); 
        $this->db->where('senha', $senha);

        $query = $this->db->get('administradores'); 

        return $query->result(); 
   
    }
    
    function get_dadosadmin($id) {
        
        $id = $this->db->escape($id);

        $this->db->where('id', $id); 
        $query = $this->db->get('administradores'); 

         return $query->row_array();
   
    }
 
 
}
