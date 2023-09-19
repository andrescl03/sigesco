<?php
class Inicio_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

        public function listarProcesosDefault(){
        $sql=$this->db
          ->select("pro.pro_id")      
          ->from("procesos pro")
          ->where(array("pro.pro_estado"=>1, "pro.pro_default"=>1))
          ->get();
         // echo $this->db->last_query(); exit(); 
         return $sql->row_array();  
      }


      public function listarPeriodosDefault(){
        $sql=$this->db
          ->select("per.per_id")      
          ->from("periodos per")
          ->where(array("per.per_estado"=>1, "per.per_default"=>1))
          ->get();
         // echo $this->db->last_query(); exit(); 
         return $sql->row_array();  
      }






}

?>