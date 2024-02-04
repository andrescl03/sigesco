<?php
class Evaluacion_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    public function listarGruposInscripcionxConvocatoria($idCon){
      $sigesco_tus_iduser = $this->session->userdata('sigesco_tus_iduser');
      $sigesco_dni = $this->session->userdata('sigesco_dni');
      $sql=$this->db
      ->select("con.con_id, gin.gin_id, mod.mod_abreviatura, niv.niv_descripcion, esp.esp_descripcion, pro.pro_descripcion, con.con_numero, con.con_anio")          
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
        $items = $sql->result_array();
      if (in_array($sigesco_tus_iduser, [1,2])) {
        $sql = "SELECT
                  POS.*,
                  EPE.epe_id AS epe_id
                FROM postulaciones AS POS
                LEFT JOIN evaluacion_pun_exp AS EPE ON POS.id = EPE.postulacion_id
                WHERE POS.deleted_at IS NULL 
                AND POS.convocatoria_id = $idCon
                GROUP BY POS.id";
      } else {
        $sql = "SELECT
                  POS.*,
                  EPE.epe_id AS epe_id
                FROM postulaciones AS POS
                INNER JOIN evaluacion_pun_exp AS EPE ON POS.id = EPE.postulacion_id
                WHERE POS.deleted_at IS NULL 
                AND POS.convocatoria_id = $idCon
                AND EPE.epe_especialistaAsignado = $sigesco_dni
                GROUP BY POS.id";
      }

        $postulaciones = $this->db->query($sql)->result_array();
        $keys_postulaciones = [];
        $keys_postulaciones_total = [];
        $keys_postulaciones_total_asignados = [];
        foreach ($postulaciones as $k => $o) {
          $keys_postulaciones[$o['inscripcion_id']][$o['estado']][] = $o;
          $keys_postulaciones_total[$o['inscripcion_id']][] = $o;
          if ($o['epe_id'] > 0) {
            $keys_postulaciones_total_asignados[$o['inscripcion_id']][] = $o;
          }
        }
        foreach ($items as $k => $o) {
          $items[$k]['cantidad_preliminar'] = 0;
          $items[$k]['cantidad_sin_evaluar'] = 0;
          $items[$k]['cantidad_final'] = 0;
          $items[$k]['total_postulaciones'] = 0;
          $items[$k]['total_asignados'] = 0;
          if (isset($keys_postulaciones[$o['gin_id']])) {
            if (isset($keys_postulaciones[$o['gin_id']]['enviado'])) {
              $items[$k]['cantidad_sin_evaluar'] = count($keys_postulaciones[$o['gin_id']]['enviado']);
            }
            if (isset($keys_postulaciones[$o['gin_id']]['revisado'])) {
              $items[$k]['cantidad_preliminar'] = count($keys_postulaciones[$o['gin_id']]['revisado']);
            }
            if (isset($keys_postulaciones[$o['gin_id']]['finalizado'])) {
              $items[$k]['cantidad_final'] = count($keys_postulaciones[$o['gin_id']]['finalizado']);
            }
          }
          if (isset($keys_postulaciones_total[$o['gin_id']])) {
            $items[$k]['total_postulaciones'] = count($keys_postulaciones_total[$o['gin_id']]);
          }
          if (isset($keys_postulaciones_total_asignados[$o['gin_id']])) {
            $items[$k]['total_asignados'] = count($keys_postulaciones_total_asignados[$o['gin_id']]);
          }
        }
        return $items;
    }

    
    public function listarGruposAsignadosXConvocatoria($idCon){
      $sql=$this->db
      ->select("con.con_id, gin.gin_id, mod.mod_abreviatura, niv.niv_descripcion, esp.esp_descripcion, pro.pro_descripcion, con.con_numero, con.con_anio")          
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
    

    public function listarCuadroPunxIdGrupoConEvaluacion($idGin, $usuario){ //1: se presento
      $sql=$this->db
        ->select("COUNT(cpe_id) as t_docentes, SUM(epe_estadoEvaluacion) as t_asigando, SUM(IF(epe_tipoevaluacion IS NULL, 1, IF(epe_tipoevaluacion = 1 AND epe_estadoEvaluacion = 1, 1, 0))) as t_preliminar, SUM(IF(epe_tipoevaluacion = 2 AND epe_estadoEvaluacion = 1, 1, 0)) as t_final, SUM(IF(epe_tipoevaluacion = 1 AND epe_especialistaAsignado = $usuario AND epe_estadoEvaluacion = 1, 1, 0)) as t_mis_preliminar, SUM(IF(epe_tipoevaluacion = 2 AND epe_especialistaAsignado = $usuario AND epe_estadoEvaluacion = 1, 1, 0)) as t_mis_final")      
        ->from("cuadro_pun_exp cpe")
        ->join("evaluacion_pun_exp epe", "cpe.cpe_id = epe.cuadro_pun_exp_cpe_id", "left")
        ->where(array("cpe.cpe_estado"=>1, "cpe_sepresento"=>1, "cpe_tipoCuadro"=>1, "cpe.grupo_inscripcion_gin_id"=>$idGin))
        ->group_start()
        ->where('epe.epe_estado', 1)
          ->or_where('epe.epe_estado', NULL)
        ->group_end()
        ->get();
        // echo $this->db->last_query(); exit(); 
        return $sql->row_array();  
    }

    public function listarCuadroExpxIdGrupoConEvaluacion($idGin, $usuario){ //1: se presento
      $sql=$this->db
        ->select("COUNT(cpe_id) as t_docentes, SUM(epe_estadoEvaluacion) as t_asigando, SUM(IF(epe_tipoevaluacion IS NULL, 1, IF(epe_tipoevaluacion = 1 AND epe_estadoEvaluacion = 1, 1, 0))) as t_preliminar, SUM(IF(epe_tipoevaluacion = 2 AND epe_estadoEvaluacion = 1, 1, 0)) as t_final, SUM(IF(epe_tipoevaluacion = 1 AND epe_especialistaAsignado = $usuario AND epe_estadoEvaluacion = 1, 1, 0)) as t_mis_preliminar, SUM(IF(epe_tipoevaluacion = 2 AND epe_especialistaAsignado = $usuario AND epe_estadoEvaluacion = 1, 1, 0)) as t_mis_final")      
        ->from("cuadro_pun_exp cpe")
        ->join("evaluacion_pun_exp epe", "cpe.cpe_id = epe.cuadro_pun_exp_cpe_id", "left")
        ->where(array("cpe.cpe_estado"=>1, "cpe_sepresento"=>1, "cpe_tipoCuadro"=>2, "cpe.grupo_inscripcion_gin_id"=>$idGin))
        ->group_start()
        ->where('epe.epe_estado', 1)
          ->or_where('epe.epe_estado', NULL)
        ->group_end()
        ->get();
        // echo $this->db->last_query(); exit(); 
        return $sql->row_array();  
    }

    public function listarGrupoInscripcionxConvocatoriaYEspecialidad($idCon, $idGin){
      $sql=$this->db
        ->select("con.con_id, gin.gin_id, mod.mod_abreviatura, niv.niv_descripcion, esp.esp_descripcion, pro.pro_descripcion, con.con_numero, con.con_anio, cde.convocatorias_con_id")      
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

    public function listarCuadroPunxIdGrupoEnviadoEvaluacionPreliminar($idGin, $evaluc){
      $sql=$this->db
        ->select("cpe.*,epe.epe_id, usu.usu_nombre, usu.usu_apellidos, usu.usu_dni")      
        ->from("cuadro_pun_exp cpe")
        ->join("evaluacion_pun_exp epe", "cpe.cpe_id = epe.cuadro_pun_exp_cpe_id ", "left")   
        ->join("usuarios usu", "usu.usu_dni = epe.epe_especialistaAsignado ", "left")    
        ->where(array("cpe.cpe_estado"=>1, "cpe.cpe_enviadoeval"=>1, "cpe_tipoCuadro"=>$evaluc, "cpe.grupo_inscripcion_gin_id"=>$idGin))
        ->group_start()
          ->where('epe.epe_tipoevaluacion', 1) // 1: PRELIMINAR 2: FINAL
          ->or_where('epe.epe_tipoevaluacion', NULL)
        ->group_end()
        ->group_start()
          ->where('epe.epe_estadoEvaluacion', 1) // 1: ABIERTO, 0: CERRADO
          ->or_where('epe.epe_estadoEvaluacion', NULL)
        ->group_end()

        ->get();
        // echo $this->db->last_query(); exit(); 
        return $sql->result_array();  
    }
    
    public function listarCuadroPunxIdGrupoEnviadoEvaluacionPreliminarV2($convId, $insId) {
      $sql = "SELECT 
                pos.*,
                cpp.cpe_orden,
                epe.epe_id, 
                usu.usu_nombre, 
                usu.usu_apellidos, 
                usu.usu_dni 
              FROM postulaciones pos
              INNER JOIN convocatorias_detalle cdt ON pos.convocatoria_id = cdt.convocatorias_con_id AND cdt.grupo_inscripcion_gin_id = pos.inscripcion_id
              LEFT JOIN cuadro_pun_exp cpp ON cpp.grupo_inscripcion_gin_id = cdt.grupo_inscripcion_gin_id  AND cpp.cpe_documento = pos.numero_documento
              LEFT JOIN evaluacion_pun_exp epe ON epe.postulacion_id = pos.id 
              LEFT JOIN usuarios usu ON usu.usu_dni = epe.epe_especialistaAsignado 
              WHERE pos.deleted_at IS NULL 
              AND pos.convocatoria_id = $convId
              AND pos.inscripcion_id = $insId";
      $postulaciones = $this->db->query($sql)->result_array();
      $postulaciones = $this->getPostulacionArchivos($postulaciones);

      return $postulaciones;
    }

    public function listarCuadroPunxIdGrupoEnviadoEvaluacionPreliminarxUsuario($idGin, $usuario, $evaluc){
      $sql=$this->db
        ->select("cpe.*,epe.epe_id, usu.usu_nombre, usu.usu_apellidos, usu.usu_dni")      
        ->from("cuadro_pun_exp cpe")
        ->join("evaluacion_pun_exp epe", "cpe.cpe_id = epe.cuadro_pun_exp_cpe_id ", "left")   
        ->join("usuarios usu", "usu.usu_dni = epe.epe_especialistaAsignado ", "left")    
        ->where(array("cpe.cpe_estado"=>1, "cpe.cpe_enviadoeval"=>1, "cpe_tipoCuadro"=>$evaluc, "cpe.grupo_inscripcion_gin_id"=>$idGin, "epe.epe_especialistaAsignado" => $usuario))
        ->group_start()
          ->where('epe.epe_tipoevaluacion', 1) // 1: PRELIMINAR 2: FINAL
          ->or_where('epe.epe_tipoevaluacion', NULL)
        ->group_end()
        ->group_start()
          ->where('epe.epe_estadoEvaluacion', 1) // 1: ABIERTO, 0: CERRADO
          ->or_where('epe.epe_estadoEvaluacion', NULL)
        ->group_end()
        ->get();
        // echo $this->db->last_query(); exit(); 
        return $sql->result_array();  
    }
    
    public function listarCuadroPunxIdGrupoEnviadoEvaluacionPreliminarxUsuarioV2($convId, $insId, $usuario){
      $sql = "SELECT 
            pos.*,
            cpp.cpe_orden,
            epe.epe_id, 
            usu.usu_nombre, 
            usu.usu_apellidos, 
            usu.usu_dni 
          FROM postulaciones pos
          INNER JOIN convocatorias_detalle cdt ON pos.convocatoria_id = cdt.convocatorias_con_id AND cdt.grupo_inscripcion_gin_id = pos.inscripcion_id
          INNER JOIN cuadro_pun_exp cpp ON cpp.grupo_inscripcion_gin_id = cdt.grupo_inscripcion_gin_id  AND cpp.cpe_documento = pos.numero_documento
          INNER JOIN evaluacion_pun_exp epe ON epe.postulacion_id = pos.id AND epe.epe_especialistaAsignado = $usuario
          INNER JOIN usuarios usu ON usu.usu_dni = epe.epe_especialistaAsignado 
          WHERE pos.deleted_at IS NULL 
          AND pos.convocatoria_id = $convId
          AND pos.inscripcion_id = $insId";
      $postulaciones = $this->db->query($sql)->result_array();
      $postulaciones = $this->getPostulacionArchivos($postulaciones);
      return $postulaciones; 
    }
    
    public function getPostulacionArchivos($postulaciones) {
      $postulaciones_ids = [];
      $postulacion_archivos_keys = [];
      
      foreach ($postulaciones as $k => $o) {
        $postulaciones_ids[] = $o['id'];
      }

      if (count($postulaciones_ids)) {
        $sql = "SELECT 
                par.*,
                tar.nombre AS tipo_nombre
              FROM postulacion_archivos par
              INNER JOIN tipo_archivos tar ON par.tipo_id = tar.id
              WHERE par.deleted_at IS NULL 
              AND par.postulacion_id IN (".implode(",", $postulaciones_ids).")";
        $postulacion_archivos = $this->db->query($sql)->result_array();
        foreach ($postulacion_archivos as $k => $o) {
          $postulacion_archivos_keys[$o['postulacion_id']][] = $o;
        }
      }

      foreach ($postulaciones as $k => $o) {
        $postulaciones[$k]['archivos'] = [];
        if (isset($postulacion_archivos_keys[$o['id']])) {
          $postulaciones[$k]['archivos'] = $postulacion_archivos_keys[$o['id']];
        }
      }
      return $postulaciones;
    }

    public function verEspecialistasAcceso(){
      $sql=$this->db
          ->select("u.usu_id, u.usu_dni, u.usu_nombre, u.usu_apellidos")
          ->from("modulos as m")
          ->join('permisos as p','p.modulos_mdl_id=m.mdl_id', 'inner')
          ->join('tipo_usuarios as tu','tu.tus_id=p.tipo_usuarios_tus_id', 'inner')
          ->join('usuarios as u','u.tipo_usuarios_tus_id=tu.tus_id', 'inner')
          ->where(array("u.usu_estado"=>1,"m.mdl_estado"=>1,"p.per_estado"=>1, "tu.tus_estado"=>1,"m.mdl_ruta"=>'evaluacion/convocatoria'))
          ->order_by('u.usu_nombre asc, u.usu_apellidos')
          ->get();         
      return $sql->result_array();
    } 
   
    public function VerGrupodeInscripcionxConvocatoria($idConv){
      $sql=$this->db
          ->select("cde.grupo_inscripcion_gin_id")
          ->from("convocatorias_detalle cde")           
          ->where(array("cde.cde_estado"=>1, "cde.convocatorias_con_id"=>$idConv))		
          ->get();         
      return $sql->result_array();
    } 

    public function contarEspecialistasAsignadosaPunxConvocatoriaPreliminar($ar_idGin){
      $sql=$this->db
        ->select("epe.epe_especialistaAsignado as dni_espec, count(epe_especialistaAsignado) AS total")      
        ->from("cuadro_pun_exp cpe")
        ->join("evaluacion_pun_exp epe", "cpe.cpe_id = epe.cuadro_pun_exp_cpe_id ")
        ->where(array("cpe.cpe_estado"=>1, "cpe.cpe_enviadoeval"=>1, "cpe_tipoCuadro"=>1, "epe.epe_estadoEvaluacion"=> 1))
        ->where_in("cpe.grupo_inscripcion_gin_id", $ar_idGin)
        ->group_by(array("epe_especialistaAsignado"))
        ->get();
        // echo $this->db->last_query(); exit(); 
        return $sql->result_array();  
    }

    public function contarEspecialistasAsignadosaPunxConvocatoriaPreliminarV2($ar_idGin, $idConv){
      $sql=$this->db
        ->select("epe.epe_especialistaAsignado as dni_espec, count(epe_especialistaAsignado) AS total")      
        ->from("postulaciones pos")
        ->join("evaluacion_pun_exp epe", "pos.id = epe.postulacion_id ")
        ->where(array("pos.deleted_at", "pos.convocatoria_id"=>$idConv))
        ->where_in("pos.inscripcion_id", $ar_idGin)
        ->group_by(array("epe_especialistaAsignado"))
        ->get();
        return $sql->result_array();  
    }

    public function updateBatchEvaluacionPun($data){
      $this->db->update_batch('evaluacion_pun_exp', $data, 'epe_id', 1000);
      return $this->db->affected_rows();  
    }

    public function insertarBatchEvaluacionPun($data) {
      $this->db->insert_batch('evaluacion_pun_exp',$data, 1000);      
      return $this->db->affected_rows();
    }
    
    public function verFichaEvaluacion(){
      $sql=$this->db
        ->select("*")      
        ->from("ficha fic")
        ->join("criterios_ficha cfi", "cfi.ficha_fic_id = fic.fic_id")
        ->where(array("fic.fic_id"=>1))      
        ->get();
        // echo $this->db->last_query(); exit(); 
        return $sql->result_array();  
    }

    public function pagination() {
      $res = $this->tools->responseDefault();
      try {

          $draw   = $this->input->post("draw", true);
          $length = $this->input->post("length", true);
          $start  = $this->input->post("start", true);
          $search = $this->input->post("search", true);

          $any = $this->input->post("any", true);
          $convocatoria_id = $this->input->post("convocatoria_id", true);
          $inscripcion_id  = $this->input->post("inscripcion_id", true);

          $filterText = '';
          if ($search) {
              $value = $search['value'];
              if (strlen($value) > 0) {
                  /*$filterText = " AND AC.name LIKE('%{$value}%') 
                                  OR TC.name LIKE('%{$value}%')";*/
              }
          }
          $sigesco_tus_iduser = $this->session->userdata('sigesco_tus_iduser');
          $sigesco_dni = $this->session->userdata('sigesco_dni');
          $estado = $any == 'final' ? 'finalizado' : 'revisado';
          $filterByUser = in_array($sigesco_tus_iduser, [1, 2]) ? '' : ' AND epe.epe_especialistaAsignado = ' . $sigesco_dni;
          $sql = "SELECT 
                    pos.*,
                    cpp.cpe_orden,
                    epe.epe_id, 
                    usu.usu_nombre, 
                    usu.usu_apellidos, 
                    usu.usu_dni 
                  FROM postulaciones pos
                  INNER JOIN convocatorias_detalle cdt ON pos.convocatoria_id = cdt.convocatorias_con_id
                  INNER JOIN cuadro_pun_exp cpp ON cpp.grupo_inscripcion_gin_id = cdt.grupo_inscripcion_gin_id
                  INNER JOIN evaluacion_pun_exp epe ON epe.postulacion_id = pos.id $filterByUser
                  INNER JOIN usuarios usu ON usu.usu_dni = epe.epe_especialistaAsignado 
                  WHERE pos.deleted_at IS NULL 
                  AND pos.convocatoria_id = $convocatoria_id
                  AND pos.inscripcion_id = $inscripcion_id
                  AND pos.estado = '$estado'
                  $filterText
                  GROUP BY pos.id
                  ORDER BY pos.id DESC";
          $items = $this->db->query($sql)->result_object();
          $recordsTotal = count($items);

          $sql .= " LIMIT {$start}, {$length}";

          $items = $this->db->query($sql)->result_object();

          $recordsFiltered = ($recordsTotal / $length) * $length;

          $res['success'] = true;
          $res['data'] = $items;
          $res['recordsTotal'] = $recordsTotal;
          $res['recordsFiltered'] = $recordsFiltered;
          $res['message'] = 'successfully';
      } catch (\Exception $e) {
          $res['message'] = $e->getMessage();
      }
      return $res;
  }

  public function attachedfiles($id) {
    $response = $this->tools->responseDefault();
    try {
      $sql = "SELECT 
                par.*,
                tar.nombre AS tipo_nombre
              FROM postulacion_archivos par
              INNER JOIN tipo_archivos tar ON tar.id = par.tipo_id
              WHERE par.deleted_at IS NULL 
              AND par.postulacion_id = ?";
      $archivos = $this->db->query($sql, ['postulacion_id' => $id])->result_object();
      $response['success'] = true;
      $response['data']  = compact('archivos');
      $response['status']  = 200;
      $response['message'] = 'Files of postulant';

    } catch (\Exception $e) {
        $response['message'] = $e->getMessage();
    }
    return $response; 
  }
  
  
  public function report($convocatoria_id, $inscripcion_id, $estado) {
    $res = $this->tools->responseDefault();
    try {

        // $estado = $any == 'final' ? 'finalizado' : 'revisado';
        $sql = "SELECT 
                  pos.*,
                  cpp.cpe_orden,
                  epe.epe_id, 
                  usu.usu_nombre, 
                  usu.usu_apellidos, 
                  usu.usu_dni,
                  esp.esp_id AS especialidad_id,
                  esp.esp_descripcion AS especialidad_descripcion,
                  niv.niv_id AS nivel_id,
                  niv.niv_descripcion AS nivel_descripcion,
                  mdd.mod_id AS modalidad_id,
                  mdd.mod_nombre AS modalidad_descripcion,
                  pfa.universidad AS formacion_academica_universidad,
                  pel.institucion_educativa AS experiencia_laboral_institucion_educativa,
                  pe.tema_especializacion AS especializacion_tema,
                  pev.puntaje AS puntaje 
                FROM postulaciones pos
                INNER JOIN convocatorias_detalle cdt ON pos.convocatoria_id = cdt.convocatorias_con_id
                INNER JOIN cuadro_pun_exp cpp ON cpp.grupo_inscripcion_gin_id = cdt.grupo_inscripcion_gin_id  AND cpp.cpe_documento = pos.numero_documento
                INNER JOIN evaluacion_pun_exp epe ON epe.postulacion_id = pos.id 
                INNER JOIN usuarios usu ON usu.usu_dni = epe.epe_especialistaAsignado
                INNER JOIN grupo_inscripcion AS gin ON cpp.grupo_inscripcion_gin_id = gin.gin_id
                INNER JOIN especialidades AS esp ON esp.esp_id = gin.especialidades_esp_id
                INNER JOIN niveles AS niv ON niv.niv_id = esp.niveles_niv_id
                INNER JOIN modalidades AS mdd ON mdd.mod_id = niv.modalidad_mod_id 
                LEFT JOIN postulacion_formaciones_academicas AS pfa ON pfa.postulacion_id = pos.id
                LEFT JOIN postulacion_experiencias_laborales AS pel ON pel.postulacion_id = pos.id
                LEFT JOIN postulacion_especializaciones AS pe ON pe.postulacion_id = pos.id
                LEFT JOIN postulacion_evaluaciones AS pev ON pev.postulacion_id = pos.id AND pev.promedio = 1
                WHERE pos.deleted_at IS NULL 
                AND pos.convocatoria_id = $convocatoria_id
                AND pos.inscripcion_id = $inscripcion_id
                AND pos.estado = '$estado'
                ORDER BY pos.id DESC";
        $items = $this->db->query($sql)->result_object();
        $recordsTotal = count($items);

        $res['success'] = true;
        $res['data'] = ['records' => $items, 'recordsTotal' => $recordsTotal];
        $res['message'] = 'successfully';
    } catch (\Exception $e) {
        $res['message'] = $e->getMessage();
    }
    return $res;
  }


}