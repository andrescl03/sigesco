<?php
class Configuracion_model extends CI_Model {

    public function __construct(){
        parent::__construct();
        $this->load->library('tools');
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
    
    public function detallePeriodo($id) {
      $response = $this->tools->responseDefault();
      try {
        
        $sql = "SELECT * FROM periodo_fichas WHERE deleted_at IS NULL AND periodo_id  = ?";
        $fichas = $this->db->query($sql, compact('id'))->result_object();

        foreach ($fichas as $k => $o) {
          if ($o->plantilla) {
            $fichas[$k]->plantilla = json_decode($o->plantilla);
          }
          $fichas[$k]->periodo_ficha_especialidades = [];
        }

        $keys_especialidades = [];
        $sql = "SELECT * FROM periodo_ficha_especialidades WHERE deleted_at IS NULL";
        $periodo_ficha_especialidades = $this->db->query($sql)->result_object();
        foreach ($periodo_ficha_especialidades as $k => $o) {
          $keys_especialidades[$o->periodo_ficha_id][] = $o;
        }

        foreach ($fichas as $k => $o) {
          if (isset($keys_especialidades[$o->id])) {
            $fichas[$k]->periodo_ficha_especialidades = $keys_especialidades[$o->id];
          }
        }

        $sql = "SELECT * FROM periodos WHERE per_id = ?";
        $periodo = $this->db->query($sql, compact('id'))->row();

        $sql = "SELECT
                  ESP.esp_id,
                  ESP.esp_descripcion,
                  NIV.niv_descripcion,
                  MDA.mod_nombre
                FROM especialidades AS ESP
                INNER JOIN niveles AS NIV ON NIV.niv_id = ESP.niveles_niv_id
                INNER JOIN modalidades AS MDA ON MDA.mod_id = NIV.modalidad_mod_id";
        $especialidades = $this->db->query($sql)->result_object();
        
        $response['success'] = true;
        $response['data']  = compact('fichas', 'periodo', 'especialidades');
        $response['status']  = 200;
        $response['message'] = 'detail';

      } catch (\Exception $e) {
          $response['message'] = $e->getMessage();
      }
      return $response;  
    }

    public function guardarPeriodo($id) {
      $response = $this->tools->responseDefault();
      try {

        $any = $this->input->post("any", true);

        switch ($any) {
          case 'edicion':
            $name  = $this->input->post("name", true);
            $anio  = $this->input->post("anio", true);
            $this->db->update('periodos', ['per_nombre' => $name, 'per_anio'=>$anio], array('per_id' => $id));
          break;
          case 'actualizadetalleficha':
            $anexo_id  = $this->input->post("anexo_id", true);
            $sections  = $this->input->post("sections", true);

            $sections = $sections ? json_decode($sections, true) : [];
            $plantilla = ['sections' => []];
            if ($sections) {
              $plantilla['sections'] = $sections;
            }
            $plantilla = json_encode($plantilla);
            $this->db->update('periodo_fichas', ['plantilla' => $plantilla], array('id' => $anexo_id));
          break;
          case 'nuevaficha':
            $nombre  = $this->input->post("name", true);
            $tipo_id  = $this->input->post("tipo_id", true);
            $this->db->insert('periodo_fichas', [
              'nombre' => $nombre,
              'tipo_id' => $tipo_id,
              'periodo_id' => $id
            ]); 
            $periodo_ficha_id = $this->db->insert_id(); // para saber el id ingresado
          break;
          case 'actualizaficha':
            $ficha_id  = $this->input->post("id", true);
            $nombre  = $this->input->post("nombre", true);
            $tipo_id  = $this->input->post("tipo_id", true);
            $promedio  = $this->input->post("promedio", true);
            $descripcion  = $this->input->post("descripcion", true);
            $orden  = $this->input->post("orden", true);
            $ids  = $this->input->post("ids", true);

            $data = [
              'nombre' => $nombre,
              'tipo_id' => $tipo_id,
              'promedio' => $promedio,
              'descripcion' => $descripcion,
              'orden' => $orden
            ];
            $this->db->update('periodo_fichas', $data, array('id' => $ficha_id));
            $this->db->delete('periodo_ficha_especialidades', array('periodo_ficha_id' => $ficha_id));
            if (count(@$ids)) {
              $inserts = [];
              foreach ($ids as $key => $value) {
                $inserts[] = [
                  'periodo_ficha_id' => $ficha_id,
                  'especialidad_id' => $value
                ];
              }
              if (count($inserts)) {
                $this->db->insert_batch('periodo_ficha_especialidades', $inserts);
              }
            }
          break;
          case 'eliminaficha':
            $ficha_id  = $this->input->post("id", true);
            $this->db->update('periodo_fichas', ['deleted_at'=>$this->tools->getDateHour()], array('id' => $ficha_id));
          break;
        }

        $response['success'] = true;
        $response['status']  = 200;
        $response['message'] = 'Se guardo correctamente';

      } catch (\Exception $e) {
          $response['message'] = $e->getMessage();
      }
      return $response; 
    }

    

    


    

    




}