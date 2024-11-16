<?php
class Configuracion_auxiliar_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('tools');
  }

  public function listarPeriodosTodos()
  {
    $sql = $this->db
      ->select("*")
      ->from("periodos per")
      ->where("per_estado", 1)
      ->get();
    // echo $this->db->last_query(); exit(); 
    return $sql->result_array();
  }

  public function listarProcesosTodos()
  {
    $sql = $this->db
      ->select("*")
      ->from("procesos pro")
      //TEMPORALMENTE VALIDO PARA CONTRATO AUXILIAR, ID CONTRATO AUXILIAR = 2
      ->where(array("pro.pro_id" => 2))
      ->get();
    // echo $this->db->last_query(); exit(); 
    return $sql->result_array();
  }

  public function listarProcesosActivos()
  {
    $sql = $this->db
      ->select("*")
      ->from("procesos pro")
      ->where(array("pro.pro_estado" => 1, "pro.pro_id"=>2))
      ->get();
    // echo $this->db->last_query(); exit(); 
    return $sql->result_array();
  }

  public function listarTipoConvocatoria()
  {
    $sql = $this->db
      ->select("*")
      ->from("auxiliar_tipo_convocatoria")
      ->where("deleted_at IS null")
      ->get();
    // echo $this->db->last_query(); exit(); 
    return $sql->result_array();
  }

  public function listarModalidades()
  {

    $sql = "SELECT * FROM modalidades WHERE mod_estado = 1";
    return $this->db->query($sql)->result_object();
  }

  public function listarNiveles()
  {
    $sql = "SELECT * FROM niveles WHERE niv_estado = 1";
    return $this->db->query($sql)->result_object();
  }




  public function listarPruebaPun($idPer, $idPro)
  {
    $sql = $this->db
      ->select("*")
      ->from("modalidades mod")
      ->join("niveles niv", "mod.mod_id = niv.modalidad_mod_id", "inner")
      ->join("especialidades esp", "niv.niv_id = esp.niveles_niv_id", "inner")
      ->join("grupo_inscripcion gin", "esp.esp_id = gin.especialidades_esp_id", "inner")
      ->join("cuadro_pun_exp cpe", "gin.gin_id = cpe.grupo_inscripcion_gin_id", "inner")
      ->where(array("gin.gin_estado" => 1, "cpe.cpe_estado" => 1, "gin.periodos_per_id" => $idPer, "gin.procesos_pro_id" => $idPro))
      ->order_by("mod.mod_id asc, niv.niv_id asc, esp.esp_id asc, cpe.cpe_orden asc")
      ->get();
    // echo $this->db->last_query(); exit(); 
    return $sql->result_array();
  }


  public function detallePeriodo($id)
  {
    $response = $this->tools->responseDefault();
    try {

      $sql = "SELECT * FROM auxiliar_tipo_convocatoria WHERE deleted_at IS NULL";
      $tipo_convocatorias = $this->db->query($sql)->result_object();

      $sql = "SELECT * FROM auxiliar_periodo_fichas WHERE deleted_at IS NULL AND periodo_id  = ? ORDER BY orden ASC";
      $fichas = $this->db->query($sql, compact('id'))->result_object();

      foreach ($fichas as $k => $o) {
        if ($o->plantilla) {
          $fichas[$k]->plantilla = json_decode($o->plantilla);
        }
        $fichas[$k]->periodo_ficha_especialidades = [];
      }

      $keys_especialidades = [];
      $sql = "SELECT * FROM auxiliar_periodo_ficha_especialidades WHERE deleted_at IS NULL";
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
      $response['data']    = compact('fichas', 'periodo', 'especialidades', 'tipo_convocatorias');
      $response['status']  = 200;
      $response['message'] = 'detail';
    } catch (\Exception $e) {
      $response['message'] = $e->getMessage();
    }
    return $response;
  }

  
  public function editarPeriodo($id)
  {
    $response = $this->tools->responseDefault();
    try {

      $sql = "SELECT * FROM periodos WHERE per_id = ? AND per_estado = 1";
      $periodo = $this->db->query($sql, compact('id'))->row();
      if (!$periodo) {
        show_404();
      }

      $response['id'] = $id;
      $response['success'] = true;
      $response['data']    = compact('fichas', 'periodo', 'especialidades', 'tipo_convocatorias');
      $response['status']  = 200;
      $response['message'] = 'detail';
    } catch (\Exception $e) {
      $response['message'] = $e->getMessage();
    }
    return $response;
  }


  public function listarGruposInscripcion($idPer, $idPro)
  {
    $sql = $this->db
      ->select("*")
      ->from("modalidades mod")
      ->join("niveles niv", "mod.mod_id = niv.modalidad_mod_id", "inner")
      ->join("especialidades esp", "niv.niv_id = esp.niveles_niv_id", "inner")
      ->join("grupo_inscripcion gin", "esp.esp_id = gin.especialidades_esp_id", "inner")
      ->where(array("gin.gin_estado" => 1, "gin.periodos_per_id" => $idPer, "gin.procesos_pro_id" => $idPro))
      ->order_by("gin.gin_correlative asc, mod.mod_id asc, niv.niv_id asc, esp.esp_id asc")
      ->get();
    // echo $this->db->last_query(); exit(); 
    return $sql->result_array();
  }


  public function listarGruposInscripcionDataTable($idPer, $idPro)
  {
    try {

      $draw = $this->input->post("draw", true);
      $length = $this->input->post("length", true);
      $start = $this->input->post("start", true);
      $search = $this->input->post("search", true);
      $filterText = '';
      if ($search) {

        $value = $search['value'];

        if (strlen($value) > 0) {
          $filterText = " ";
        }
      }

      $sql = "SELECT * FROM `modalidades` `mod` 
      INNER JOIN `niveles` `niv` ON `mod`.`mod_id` = `niv`.`modalidad_mod_id`
      INNER JOIN `especialidades` `esp` ON `niv`.`niv_id` = `esp`.`niveles_niv_id`
      INNER JOIN `grupo_inscripcion` `gin` ON `esp`.`esp_id` = `gin`.`especialidades_esp_id`
      WHERE `gin`.`gin_estado` = 1
      AND `gin`.`periodos_per_id` = '1'
      AND `gin`.`procesos_pro_id` = '2'
      ORDER BY `mod`.`mod_id` ASC, `niv`.`niv_id` ASC, `esp`.`esp_id` ASC " ;
      

      $items = $this->db->query($sql)->result_object();

      $recordsTotal = count($items);

      $sql .= " LIMIT {$start}, {$length}";

      $items = $this->db->query($sql)->result_object();

      $recordsFiltered = ($recordsTotal / $length) * $length;

      $response['success'] = true;
      $response['data'] = $items;
      $response['recordsTotal'] = $recordsTotal;
      $response['recordsFiltered'] = $recordsFiltered;
      $response['message'] = 'successfully';

    }
      catch (\Exception $e) {
        $response['message'] = $e->getMessage();
      }

    return $response;
  }

  public function listarPeriodosActivos()
  {
    $sql = $this->db
      ->select("*")
      ->from("periodos per")
      ->where(array("per.per_estado" => 1))
      ->get();
    // echo $this->db->last_query(); exit(); 
    return $sql->result_array();
  }

  public function buscarDocumentoExiste($documentos, $anio)
  {
    $sql = $this->db
      ->select("cpe.cpe_documento")
      ->from("cuadro_pun_exp cpe")
      ->where(array("cpe.cpe_estado" => 1, "cpe.cpe_anio" => $anio))
      ->where_in("cpe.cpe_documento", $documentos)
      ->get();
    // echo $this->db->last_query(); exit(); 
    return $sql->result_array();
  }

  public function insertBatchCuadroPun($data)
  {
    $this->db->insert_batch('cuadro_pun_exp', $data);
    return ($this->db->affected_rows() > 0) ? 1 : 0;
  }


  public function guardarPeriodo($id)
  {
    $response = $this->tools->responseDefault();
    try {

      $any = $this->input->post("any", true);

      switch ($any) {
        case 'edicion':
          $name  = $this->input->post("name", true);
          $anio  = $this->input->post("anio", true);
          $this->db->update('periodos', ['per_nombre' => $name, 'per_anio' => $anio], array('per_id' => $id));
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
          $this->db->update('auxiliar_periodo_fichas', ['plantilla' => $plantilla], array('id' => $anexo_id));
          break;
        case 'nuevaficha':
          $nombre  = $this->input->post("nombre", true);
          $tipo_id  = $this->input->post("tipo_id", true);
          $promedio  = $this->input->post("promedio", true);
          $descripcion  = $this->input->post("descripcion", true);
          $orden  = $this->input->post("orden", true);
          $ids  = $this->input->post("ids", true);

          $total_ids = count(@$ids);
          if ($total_ids == 0) {
            throw new Exception("Deber seleccionar al menos una especialidad");
          }

          $sql = "SELECT
                    e1.*,
                    e2.*,
                    e3.esp_descripcion AS especialidad_nombre,
                    e4.niv_descripcion AS nivel_nombre,
                    e5.mod_nombre AS modalidad_nombre
                  FROM auxiliar_periodo_fichas e1
                  LEFT JOIN auxiliar_periodo_ficha_especialidades e2 ON e1.id = e2.periodo_ficha_id
                  LEFT JOIN especialidades e3 ON e3.esp_id = e2.especialidad_id
                  LEFT JOIN niveles e4 ON e4.niv_id = e3.niveles_niv_id
                  LEFT JOIN modalidades e5 ON e5.mod_id = e4.modalidad_mod_id
                  WHERE e1.deleted_at IS NULL
                  AND e1.periodo_id = {$id}
                  AND e1.tipo_id = {$tipo_id}";
          $periodo_ficha_especialidades = $this->db->query($sql)->result_object();
          foreach ($ids as $k2 => $o2) {
            $brand = 0;
            $especialidad_nombre = "";
            foreach ($periodo_ficha_especialidades as $k3 => $o3) {
              if ($o2 == $o3->especialidad_id) {
                $especialidad_nombre = $o3->modalidad_nombre . " " . $o3->nivel_nombre . " " . $o3->especialidad_nombre;
                $brand++;
              }
            }
            if ($brand >= 2) {
              throw new Exception("La especialidad {$especialidad_nombre} ya se encuentra registrado en dos fichas del mismo tipo de evaluación");
            }
          }

          $data = [
            'nombre' => $nombre,
            'tipo_id' => $tipo_id,
            'promedio' => $promedio,
            'descripcion' => $descripcion,
            'orden' => $orden,
            'periodo_id' => $id
          ];
          $this->db->insert('auxiliar_periodo_fichas', $data);
          $ficha_id = $this->db->insert_id(); // para saber el id ingresado
          $this->db->delete('auxiliar_periodo_ficha_especialidades', array('periodo_ficha_id' => $ficha_id));
          if ($total_ids) {
            $inserts = [];
            foreach ($ids as $key => $value) {
              $inserts[] = [
                'periodo_ficha_id' => $ficha_id,
                'especialidad_id' => $value
              ];
            }
            if (count($inserts)) {
              $this->db->insert_batch('auxiliar_periodo_ficha_especialidades', $inserts);
            }
          }
          break;
        case 'actualizaficha':
          $ficha_id  = $this->input->post("id", true);
          $nombre  = $this->input->post("nombre", true);
          $tipo_id  = $this->input->post("tipo_id", true);
          $promedio  = $this->input->post("promedio", true);
          $descripcion  = $this->input->post("descripcion", true);
          $orden  = $this->input->post("orden", true);
          $ids  = $this->input->post("ids", true);

          $total_ids = count(@$ids);
          if ($total_ids == 0) {
            throw new Exception("Deber seleccionar al menos una especialidad");
          }

          $sql = "SELECT
                    e1.*,
                    e2.*,
                    e3.esp_descripcion AS especialidad_nombre,
                    e4.niv_descripcion AS nivel_nombre,
                    e5.mod_nombre AS modalidad_nombre
                  FROM auxiliar_periodo_fichas e1
                  LEFT JOIN auxiliar_periodo_ficha_especialidades e2 ON e1.id = e2.periodo_ficha_id
                  LEFT JOIN especialidades e3 ON e3.esp_id = e2.especialidad_id
                  LEFT JOIN niveles e4 ON e4.niv_id = e3.niveles_niv_id
                  LEFT JOIN modalidades e5 ON e5.mod_id = e4.modalidad_mod_id
                  WHERE e1.deleted_at IS NULL
                  AND e1.periodo_id = {$id}
                  AND e1.tipo_id = {$tipo_id}
                  AND e2.periodo_ficha_id != {$ficha_id}";
          $periodo_ficha_especialidades = $this->db->query($sql)->result_object();
          foreach ($ids as $k2 => $o2) {
            $brand = 0;
            $especialidad_nombre = "";
            foreach ($periodo_ficha_especialidades as $k3 => $o3) {
              if ($o2 == $o3->especialidad_id) {
                $especialidad_nombre = $o3->modalidad_nombre . " " . $o3->nivel_nombre . " " . $o3->especialidad_nombre;
                $brand++;
              }
            }
            if ($brand >= 2) {
              throw new Exception("La especialidad {$especialidad_nombre} ya se encuentra registrado en dos fichas del mismo tipo de evaluación");
            }
          }

          $data = [
            'nombre' => $nombre,
            'tipo_id' => $tipo_id,
            'promedio' => $promedio,
            'descripcion' => $descripcion,
            'orden' => $orden
          ];
          $this->db->update('auxiliar_periodo_fichas', $data, array('id' => $ficha_id));
          $this->db->delete('auxiliar_periodo_ficha_especialidades', array('periodo_ficha_id' => $ficha_id));
          if (count(@$ids)) {
            $inserts = [];
            foreach ($ids as $key => $value) {
              $inserts[] = [
                'periodo_ficha_id' => $ficha_id,
                'especialidad_id' => $value
              ];
            }
            if (count($inserts)) {
              $this->db->insert_batch('auxiliar_periodo_ficha_especialidades', $inserts);
            }
          }
          break;
        case 'eliminaficha':
          $ficha_id  = $this->input->post("id", true);
          $this->db->update('auxiliar_periodo_fichas', ['deleted_at' => $this->tools->getDateHour()], array('id' => $ficha_id));
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

  public function registraPeriodo()
  {
    $response = $this->tools->responseDefault();
    try {

      $name = $this->input->post("name", true);
      $anio  = $this->input->post("anio", true);

      // Obtener el último registro de la tabla periodos
      $lastPeriod = $this->db->select('per_id')
      ->from('periodos')
      ->order_by('per_id', 'DESC')
      ->limit(1)
      ->get()
      ->row();
    
      $lastId = $lastPeriod ? $lastPeriod->per_id : 0;
      $newId = $lastId + 1;

      $this->db->insert('periodos', [
        'per_id' => $newId,
        'per_anio' => $anio,
        'per_nombre' => $name,
        'per_estado' => 1
      ]);
      
      $id =  $this->db->insert_id(); // para saber el id ingresado
      
      $response['success'] = true;
      $response['status']  = 200;
      $response['data']    = ['id'=> $newId];
      $response['message'] = 'Se registro correctamente';
    } catch (\Exception $e) {
      $response['message'] = $e->getMessage();
    }
    return $response;
  }

  public function eliminarPeriodo($id)
  {
    $response = $this->tools->responseDefault();
    try {

      if (!($id > 0)) {
        throw new Exception("El valor del id debe ser numerico");
      }
      $this->db->update('periodos', ['per_estado' => 0], array('per_id' => $id));

      $response['success'] = true;
      $response['status']  = 200;
      $response['data']    = compact('id');
      $response['message'] = 'Se elimino correctamente';
    } catch (\Exception $e) {
      $response['message'] = $e->getMessage();
    }
    return $response;
  }

  public function listarColegios()
  {
    $sql = $this->db
      ->select("*")
      ->from("localie lie")
      ->join("modularie mie", "lie.loc_id = mie.localie_loc_id", "inner")
      ->get();
    // echo $this->db->last_query(); exit(); 
    return $sql->result_array();
  }
  public function listarColegiosActivos()
  {
    $sql = $this->db
      ->select("*")
      ->from("localie lie")
      ->join("modularie mie", "lie.loc_id = mie.localie_loc_id", "inner")
      ->group_by(array("lie.loc_codigo"))
      ->order_by('mie.mod_nombre asc')
      ->get();
    // echo $this->db->last_query(); exit(); 
    return $sql->result_array();
  }


  public function listarPlazas()
  {
    $sql = $this->db
      ->select("*")
      ->from("auxiliar_plazas")
      ->get();
    // echo $this->db->last_query(); exit(); 
    return $sql->result_array();
  }

  public function insertarEspecialidad($data=array()){
    $this->db->insert('especialidades',$data);
    return $this->db->insert_id(); // para saber el id ingresado
  }

  public function insertGrupoInscripcion($data=array()){
    $this->db->insert('grupo_inscripcion',$data);
    return $this->db->insert_id(); // para saber el id ingresado
  }

  public function eliminarGrupoInscripcion($data=array()){


    $this->db->update('grupo_inscripcion', ['gin_estado' => 0], $data);

    return true; // para saber el id ingresado
  }

  public function validarGrupoInscripcion($data = array())
  {
    $sql = $this->db
    ->select("*")
    ->from("auxiliar_postulaciones")
    ->where($data)
    ->get();

    return $sql->num_rows();
  }

  public function ultimoGrupoInscripcion() {
    return $this->db
      ->select("*")
      ->from("grupo_inscripcion")
      ->where(['gin_estado' => 1, 'procesos_pro_id' => 2])
      ->order_by('gin_id', 'DESC')
      ->limit(1)
      ->get()
      ->row();
    // echo $this->db->last_query(); exit(); 
  }
}
