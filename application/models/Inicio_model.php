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

    public function obtenerUsuarioPorID(){
      $sigesco_id = $this->session->userdata("sigesco_id");         
      $sql = $this->db
          ->select("usuarios.usu_nombre, usuarios.usu_apellidos, usuarios.usu_dni, tipo_usuarios.tus_usuariodescrip")
          ->from("usuarios")
          ->join("tipo_usuarios", "usuarios.tipo_usuarios_tus_id = tipo_usuarios.tus_id")
          ->where(array("usu_id" => $sigesco_id))
          ->get();
         
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