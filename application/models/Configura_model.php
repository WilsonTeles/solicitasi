<?php

class Configura_model extends CI_Model {
    
  function getConfigura()
  {

   $query = $this->db->query("select manutencao,semestreano,
                                 IF(dt_final_ajuste,DATE_FORMAT(dt_final_ajuste, '%d/%m/%Y'),'') as dt_final_ajuste
                                 from config",false);
                                 
      
   return $query->row_array();

  }

  function getData_Final_AjusteInvertida()
  {

      $query = $this->db->query("select 
                                 IF(dt_final_ajuste,DATE_FORMAT(dt_final_ajuste, '%Y/%m/%d'),'') as dt_final_ajuste
                                 from config",false);
   $resultado = $query->result(); 
      
   return $resultado[0]->dt_final_ajuste;

  }
  
    function getData_Final_Ajuste()
  {

      $query = $this->db->query("select 
                                 IF(dt_final_ajuste,DATE_FORMAT(dt_final_ajuste, '%d/%m/%Y'),'') as dt_final_ajuste
                                 from config",false);
   $resultado = $query->result(); 
      
   return $resultado[0]->dt_final_ajuste;

  }
  

  function getData_Manutencao()
  {

   $query = $this->db->get('config');
   $resultado = $query->result(); 
      
   return $resultado[0]->manutencao;

  }

  function getSemestreAno()
  {

   $query = $this->db->get('config');
   $resultado = $query->result(); 
      
   return $resultado[0]->semestreano;

  }


  

}
?>
