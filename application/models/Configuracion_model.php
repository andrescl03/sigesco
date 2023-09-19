<?php
class Configuracion_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    public function listarPeriodosTodos(){
      $sql=$this->db
        ->select("*")      
        ->from("periodos per")
        ->get();
       // echo $this->db->last_query(); exit(); 
       return $sql->result_array();  
    }

    public function listarProcesosTodos(){
        $sql=$this->db
          ->select("*")      
          ->from("procesos pro")
          ->get();
         // echo $this->db->last_query(); exit(); 
         return $sql->result_array();  
    }

    public function listarProcesosActivos(){
      $sql=$this->db
        ->select("*")      
        ->from("procesos pro")
        ->where(array("pro.pro_estado"=>1))
        ->get();
       // echo $this->db->last_query(); exit(); 
       return $sql->result_array();  
    }

    public function listarGruposInscripcion($idPer, $idPro){
      $sql=$this->db
        ->select("*")      
        ->from("modalidades mod")
        ->join("niveles niv", "mod.mod_id = niv.modalidad_mod_id", "inner")
        ->join("especialidades esp", "niv.niv_id = esp.niveles_niv_id", "inner")
        ->join("grupo_inscripcion gin", "esp.esp_id = gin.especialidades_esp_id", "inner")
        ->where(array("gin.gin_estado"=>1, "gin.periodos_per_id"=>$idPer, "gin.procesos_pro_id"=>$idPro))
        ->order_by("mod.mod_id asc, niv.niv_id asc, esp.esp_id asc") 
        ->get();
       // echo $this->db->last_query(); exit(); 
       return $sql->result_array();  
    }

    public function listarPeriodosActivos(){
      $sql=$this->db
        ->select("*")      
        ->from("periodos per")
        ->where(array("per.per_estado"=>1))
        ->get();
       // echo $this->db->last_query(); exit(); 
       return $sql->result_array();  
    }

    public function listarPruebaPun($idPer, $idPro){
      $sql=$this->db
        ->select("*")      
        ->from("modalidades mod")
        ->join("niveles niv", "mod.mod_id = niv.modalidad_mod_id", "inner")
        ->join("especialidades esp", "niv.niv_id = esp.niveles_niv_id", "inner")
        ->join("grupo_inscripcion gin", "esp.esp_id = gin.especialidades_esp_id", "inner")
        ->join("cuadro_pun_exp cpe", "gin.gin_id = cpe.grupo_inscripcion_gin_id", "inner")
        ->where(array("gin.gin_estado"=>1, "cpe.cpe_estado"=>1, "gin.periodos_per_id"=>$idPer, "gin.procesos_pro_id"=>$idPro))
        ->order_by("mod.mod_id asc, niv.niv_id asc, esp.esp_id asc, cpe.cpe_orden asc") 
        ->get();
       // echo $this->db->last_query(); exit(); 
       return $sql->result_array();  
    }

    public function buscarDocumentoExiste($documentos, $anio){
      $sql=$this->db
        ->select("cpe.cpe_documento")
        ->from("cuadro_pun_exp cpe")
        ->where(array("cpe.cpe_estado"=>1, "cpe.cpe_anio"=>$anio)) 
        ->where_in("cpe.cpe_documento", $documentos)
        ->get();
       // echo $this->db->last_query(); exit(); 
       return $sql->result_array();  
    }

    public function insertBatchCuadroPun($data) {
      $this->db->insert_batch('cuadro_pun_exp',$data);      
      return ($this->db->affected_rows() > 0) ? 1 : 0; 
    }
    

    

    


    

    




}