<?php
class Convocatorias_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    public function listarConvocatoriasTodas($idPer, $idPro){
      $sql=$this->db
        ->select("*")
        ->from("modalidades mod")
        ->join("niveles niv", "mod.mod_id = niv.modalidad_mod_id", "inner")
        ->join("especialidades esp", "niv.niv_id = esp.niveles_niv_id", "inner")
        ->join("grupo_inscripcion gin", "esp.esp_id = gin.especialidades_esp_id", "inner")
        ->join("convocatorias_detalle cde", "gin.gin_id = cde.grupo_inscripcion_gin_id", "inner")
        ->join("convocatorias con", "con.con_id = cde.convocatorias_con_id", "inner")
        ->where(array("cde.cde_estado"=>1, "gin.periodos_per_id"=>$idPer, "gin.procesos_pro_id"=>$idPro))
        ->order_by("con.con_id desc, mod.mod_id asc, niv.niv_id asc, esp.esp_id asc") 
        ->get();
        // echo $this->db->last_query(); exit(); 
      return $sql->result_array();
    }

    public function listarGruposInscripcionxIds($grupoArr){
      $sql=$this->db
        ->select("*")      
        ->from("modalidades mod")
        ->join("niveles niv", "mod.mod_id = niv.modalidad_mod_id", "inner")
        ->join("especialidades esp", "niv.niv_id = esp.niveles_niv_id", "inner")
        ->join("grupo_inscripcion gin", "esp.esp_id = gin.especialidades_esp_id", "inner")       
        ->where(array("gin.gin_estado"=>1))
        ->where_in("gin.gin_id", $grupoArr)
        ->order_by("mod.mod_id asc, niv.niv_id asc, esp.esp_id asc") 
        ->get();
       // echo $this->db->last_query(); exit(); 
       return $sql->result_array();  
    }

    public function buscarUltimoNumero($anio){
      $sql=$this->db
        ->select("Max(con.con_numero) as ultimoNumero")
        ->from("convocatorias con")        
        ->where(array("con.con_anio"=>$anio))
        ->limit(1)  
        ->get();
       // echo $this->db->last_query(); exit(); 
       return $sql->row_array();  
    }

    public function insertarConvocatoria($data=array()){
      $this->db->insert('convocatorias',$data);
      return $this->db->insert_id(); // para saber el id ingresado
    }

    public function insertBatchDetalleConvocatoria($data) {
      $this->db->insert_batch('convocatorias_detalle',$data);      
      return ($this->db->affected_rows() > 0) ? 1 : 0; 
    }

    public function listarConvocatoriasActivas($idPer, $idPro){
      $sql=$this->db
        ->select("*")
        ->from("modalidades mod")
        ->join("niveles niv", "mod.mod_id = niv.modalidad_mod_id", "inner")
        ->join("especialidades esp", "niv.niv_id = esp.niveles_niv_id", "inner")
        ->join("grupo_inscripcion gin", "esp.esp_id = gin.especialidades_esp_id", "inner")
        ->join("convocatorias_detalle cde", "gin.gin_id = cde.grupo_inscripcion_gin_id", "inner")
        ->join("convocatorias con", "con.con_id = cde.convocatorias_con_id", "inner")
        ->where(array("cde.cde_estado"=>1, "con.con_estado"=>1, "gin.periodos_per_id"=>$idPer, "gin.procesos_pro_id"=>$idPro))
        ->order_by("con.con_id desc, mod.mod_id asc, niv.niv_id asc, esp.esp_id asc") 
        ->get();
        // echo $this->db->last_query(); exit(); 
      return $sql->result_array();
    }
 
    public function listarGruposInscripcionxConvocatoria($idCon){
      $sql=$this->db
        ->select("*")      
        ->from("modalidades mod")
        ->join("niveles niv", "mod.mod_id = niv.modalidad_mod_id", "inner")
        ->join("especialidades esp", "niv.niv_id = esp.niveles_niv_id", "inner")
        ->join("grupo_inscripcion gin", "esp.esp_id = gin.especialidades_esp_id", "inner")
        ->join("procesos pro", "pro.pro_id = gin.procesos_pro_id", "inner")
        ->join("convocatorias_detalle cde", "gin.gin_id = cde.grupo_inscripcion_gin_id", "inner")
        ->join("convocatorias con", "con.con_id = cde.convocatorias_con_id", "inner")
        ->where(array("cde.cde_estado"=>1, "cde.convocatorias_con_id"=>$idCon))
        ->order_by("mod.mod_id asc, niv.niv_id asc, esp.esp_id asc") 
        ->get();
       // echo $this->db->last_query(); exit(); 
       return $sql->result_array();  
    }

    public function listarGrupoInscripcionxConvocatoriaYEspecialidad($idCon, $idGin){
      $sql=$this->db
        ->select("*")      
        ->from("modalidades mod")
        ->join("niveles niv", "mod.mod_id = niv.modalidad_mod_id", "inner")
        ->join("especialidades esp", "niv.niv_id = esp.niveles_niv_id", "inner")
        ->join("grupo_inscripcion gin", "esp.esp_id = gin.especialidades_esp_id", "inner")
        ->join("procesos pro", "pro.pro_id = gin.procesos_pro_id", "inner")
        ->join("convocatorias_detalle cde", "gin.gin_id = cde.grupo_inscripcion_gin_id", "inner")
        ->join("convocatorias con", "con.con_id = cde.convocatorias_con_id", "inner")
        ->where(array("cde.cde_estado"=>1, "cde.convocatorias_con_id"=>$idCon, "cde.grupo_inscripcion_gin_id" =>$idGin))
        ->order_by("mod.mod_id asc, niv.niv_id asc, esp.esp_id asc")  
        ->get();
       // echo $this->db->last_query(); exit(); 
       return $sql->row_array();  
    }
   
    public function listarCuadroPunxIdGrupoSinEvaluacion($idGin){
      $sql=$this->db
        ->select("*")      
        ->from("cuadro_pun_exp cpe")      
        ->where(array("cpe.cpe_estado"=>1, "cpe_sepresento"=>2, "cpe_tipoCuadro"=>1, "cpe.grupo_inscripcion_gin_id"=>$idGin))       
        ->get();
       // echo $this->db->last_query(); exit(); 
       return $sql->result_array();  
    }

    public function listarCuadroPunxIdGrupoTodos($idGin){
      $sql=$this->db
        ->select("*")      
        ->from("cuadro_pun_exp cpe")      
        ->where(array("cpe.cpe_estado"=>1, "cpe_tipoCuadro"=>1, "cpe.grupo_inscripcion_gin_id"=>$idGin))       
        ->get();
       // echo $this->db->last_query(); exit(); 
       return $sql->result_array();  
    }

    public function listarAsignacionxCuadroPun($idCpu){
      $sql=$this->db
        ->select("*")      
        ->from("asignacion_expediente_pun aep")
        ->join("expedientes exp", "exp.exp_id = aep.expedientes_exp_id") 
        ->where(array("aep.aep_estado"=>1, "aep.cuadro_pun_exp_cpe_id"=>$idCpu))       
        ->get();
       // echo $this->db->last_query(); exit(); 
       return $sql->result_array();  
    }

    public function listarArchivosDetalle($idExp){
      $sql=$this->db
        ->select("*")      
        ->from("archivos_detalle adt")       
        ->where(array("adt.adt_estado"=>1, "adt.expedientes_exp_id"=>$idExp))
        ->order_by("adt.adt_tipoArchivo DESC")         
        ->get();
       // echo $this->db->last_query(); exit(); 
       return $sql->result_array();  
    }

    public function buscarAsignacionExpediente($anio, $numero){
        $sql=$this->db
        ->select("*")
        ->from("expedientes exp")
        ->join("asignacion_expediente_pun aep", "exp.exp_id = aep.expedientes_exp_id")        
        ->where(array("aep.aep_estado"=>1, "exp.exp_numero"=>$numero, "exp.exp_anio"=>$anio))       
        ->get();
      // echo $this->db->last_query(); exit(); 
      return $sql->row_array();  
    }

    public function buscarDocentesPun($idGin){
      $sql=$this->db
        ->select("cpe.cpe_id, cpe.cpe_documento")
        ->from("cuadro_pun_exp cpe")        
        ->where(array("cpe.cpe_estado"=>1, "cpe.cpe_sepresento"=>2, "cpe_tipoCuadro"=>1, "cpe.grupo_inscripcion_gin_id"=>$idGin))       
        ->get();
       // echo $this->db->last_query(); exit(); 
       return $sql->result_array();  
    }

    public function insertExpediente($data=array()){
        $this->db->insert('expedientes',$data);
        return $this->db->insert_id(); // para saber el id ingresado
    } 
 
    public function insertArchivosDetalleBatch($data) {
      $this->db->insert_batch('archivos_detalle',$data);      
        return $this->db->affected_rows();
    }

    public function insertAsigancionExpedientePun($data=array()){
      $this->db->insert('asignacion_expediente_pun',$data);
        return $this->db->insert_id(); // para saber el id ingresado
    } 

    public function updateBatchCuadroPun($ar_update){
      $this->db->update_batch('cuadro_pun_exp', $ar_update, 'cpe_id', 1000);
      return $this->db->affected_rows();  
    }

    public function updateBatchAsignacionExpedientePunxIdPun($ar_update){ // actualiza solo los q tengan estado 1
      $this->db->where('aep_estado', 1);
      $this->db->update_batch('asignacion_expediente_pun', $ar_update, 'cuadro_pun_exp_cpe_id', 1000);
      return $this->db->affected_rows();  
    }




    public function listarCuadroExpxIdGrupoSinEvaluacion($idGin){
      $sql=$this->db
        ->select("*")      
        ->from("cuadro_pun_exp cpe")      
        ->where(array("cpe.cpe_estado"=>1, "cpe_sepresento"=>2, "cpe_tipoCuadro"=>2, "cpe.grupo_inscripcion_gin_id"=>$idGin))       
        ->get();
       // echo $this->db->last_query(); exit(); 
       return $sql->result_array();  
    }

    public function listarCuadroExpxIdGrupoTodos($idGin){
      $sql=$this->db
        ->select("*")      
        ->from("cuadro_pun_exp cpe")      
        ->where(array("cpe.cpe_estado"=>1, "cpe_tipoCuadro"=>2, "cpe.grupo_inscripcion_gin_id"=>$idGin))       
        ->get();
       // echo $this->db->last_query(); exit(); 
       return $sql->result_array();  
    }
    
    //TEMPORAl
    public function obtenerDatosDocentePUN($dni){
      $sql=$this->db
        ->select("*")      
        ->from("cuadro_pun_exp cpe")      
        ->where(array("cpe.cpe_estado"=>1, "cpe_documento" => $dni))       
        ->get();
       // echo $this->db->last_query(); exit(); 

       
       return $sql->result_array();  
    }
    
    public function buscarDocentesExp($idGin){
      $sql=$this->db
        ->select("cpe.cpe_id, cpe.cpe_documento")
        ->from("cuadro_pun_exp cpe")        
        ->where(array("cpe.cpe_estado"=>1, "cpe.cpe_sepresento"=>2, "cpe_tipoCuadro"=>2, "cpe.grupo_inscripcion_gin_id"=>$idGin))       
        ->get();
       // echo $this->db->last_query(); exit(); 
       return $sql->result_array();  
    }

    public function insertCuadroPunExp($data=array()){
      $this->db->insert('cuadro_pun_exp',$data);
        return $this->db->insert_id(); // para saber el id ingresado
    } 
    

}