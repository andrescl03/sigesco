<?php
class Plazas_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    public function index() {
      $response = $this->tools->responseDefault();
      try {
  
        $sql = "SELECT 
                  e.*
                FROM periodos e
                WHERE e.per_estado = 1";
        $periodos = $this->db->query($sql)->result_object();

        $sql = "SELECT 
                e.*
              FROM procesos e
              WHERE e.pro_estado = 1";
        $procesos = $this->db->query($sql)->result_object();

        $sql = "SELECT 
                e1.*,
                e2.*
              FROM localie e1
              INNER JOIN modularie e2 ON e1.loc_id = e2.localie_loc_id
              GROUP BY e1.loc_codigo
              ORDER BY e2.mod_nombre ASC";
        $colegios = $this->db->query($sql)->result_object();

        $sql = "SELECT 
                e2.*
                FROM modularie e2
                ORDER BY e2.mod_nombre ASC";
        $niveles = $this->db->query($sql)->result_object();
  
        $response['success'] = true;
        $response['data']  = compact('periodos', 'procesos', 'colegios', 'niveles');
        $response['status']  = 200;
        $response['message'] = 'Se proceso correctamente';
  
      } catch (\Exception $e) {
          $response['message'] = $e->getMessage();
      }
      return $response; 
    }

  public function f_details_plazas()
  {
    $sql = "SELECT 
      plz.*,
      moda.mod_abreviatura,
      nive.niv_descripcion
    FROM plazas plz
    LEFT JOIN adjudicaciones adj ON adj.plaza_id = plz.plz_id
    INNER JOIN modalidades moda ON plz.mod_id = moda.mod_id
    INNER JOIN niveles nive ON nive.niv_id =  plz.nivel_id
    WHERE plz.deleted_at IS NULL 
    AND (adj.id IS NULL OR adj.estado = 0)
    GROUP BY plz.plz_id
    ORDER BY plz.plz_id DESC";
    $plazas = $this->db->query($sql)->result_object();


    return $plazas;
  }

  
    public function pagination() {
      $res = $this->tools->responseDefault();
      try {

          $draw   = $this->input->post("draw", true);
          $length = $this->input->post("length", true);
          $start  = $this->input->post("start", true);
          $search = $this->input->post("search", true);

          $filterText = '';
          if ($search) {
              $value = $search['value'];
              if (strlen($value) > 0) {
                  $filterText = " AND (
                                       plz.plz_id LIKE('%{$value}%') 
                                    OR plz.ie LIKE('%{$value}%') 
                                    OR plz.codigo_plaza LIKE('%{$value}%')
                                    OR plz.especialidad LIKE('%{$value}%')
                                    OR plz.jornada LIKE('%{$value}%')
                                    OR plz.nivel LIKE('%{$value}%')
                                    OR plz.tipo_vacante LIKE('%{$value}%')
                                  ) ";
              }
          }

          $sql = "SELECT 
                    plz.*
                  FROM plazas plz
                  WHERE plz.deleted_at IS NULL 
                  $filterText
                  ORDER BY plz.plz_id DESC";


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

  public function store() {

    $response = $this->tools->responseDefault();
    try {

      $periodo_id = $this->input->post("periodo_id", true);
      // $estado  = $this->input->post("estado", true);
      $tipo_proceso = $this->input->post("tipo_proceso", true);
      $tipo_convocatoria  = $this->input->post("tipo_convocatoria", true);
      $colegio_id = $this->input->post("colegio_id", true);
      $nivel  = $this->input->post("nivel", true);
      $especialidad = $this->input->post("especialidad", true);
      $jornada  = $this->input->post("jornada", true);
      $tipo_vacante = $this->input->post("tipo_vacante", true);
      $motivo_vacante  = $this->input->post("motivo_vacante", true);
      $codigo_plaza  = $this->input->post("codigo_plaza", true);
      $mod_id  = $this->input->post("mod_id", true);

      $sql = "SELECT * FROM modularie WHERE mod_id = ?";
      $school = $this->db->query($sql, ['mod_id'=>$mod_id])->row();

      $data = [
        'codigo_plaza' => $codigo_plaza,
        'colegio_id' => $colegio_id,
        'especialidad' => $especialidad,
        'tipo_convocatoria' => $tipo_convocatoria,
        'jornada' => $jornada,
        'tipo_vacante' => $tipo_vacante,
        'motivo_vacante' => $motivo_vacante,
        'periodo_id' => $periodo_id,
        'fecha_reg' => $this->tools->getDateHour(),
        'tipo_proceso' => $tipo_proceso,
        'estado' => 1, // $estado
        'mod_id' => $mod_id,
        'ie'=>@$school->mod_nombre,
        'nivel'=>@$school->mod_nivel
      ];
      
      $this->db->insert('plazas',$data);
      $id = $this->db->insert_id(); // para saber el id ingresado

      $response['success'] = true;
      $response['status']  = 200;
      $response['data']    = compact('id');
      $response['message'] = 'Se registro correctamente';
    } catch (\Exception $e) {
      $response['message'] = $e->getMessage();
    }
    return $response;
  }

  public function update($request) {

    $response = $this->tools->responseDefault();
    try {

      $id = isset($request['id']) ? $request['id'] : 0;

      $sql = "SELECT * FROM plazas WHERE plz_id = ? AND deleted_at IS NULL";
      $plaza = $this->db->query($sql, compact('id'))->row();
      if (!$plaza) {
        throw new Exception("No sé encuentra registrado en está plaza");
      }

      $periodo_id = $this->input->post("periodo_id", true);
      // $estado  = $this->input->post("estado", true);
      $tipo_proceso = $this->input->post("tipo_proceso", true);
      $tipo_convocatoria  = $this->input->post("tipo_convocatoria", true);
      $ie = $this->input->post("ie", true);
      $nivel  = $this->input->post("nivel", true);
      $especialidad = $this->input->post("especialidad", true);
      $jornada  = $this->input->post("jornada", true);
      $tipo_vacante = $this->input->post("tipo_vacante", true);
      $motivo_vacante  = $this->input->post("motivo_vacante", true);
      $codigo_plaza  = $this->input->post("codigo_plaza", true);
      $mod_id  = $this->input->post("mod_id", true);
      $colegio_id = $this->input->post("colegio_id", true);

      $sql = "SELECT * FROM modularie WHERE mod_id = ?";
      $school = $this->db->query($sql, ['mod_id'=>$mod_id])->row();

      $data = [
        'codigo_plaza' => $codigo_plaza,
        'codigoPlaza' => $codigo_plaza,
          //'colegio_id' => $colegio_id,
        //'ie' => $ie,
       // 'especialidad' => $especialidad,
        'tipo_convocatoria' => $tipo_convocatoria,
        'jornada' => $jornada,
       // 'tipo_vacante' => $tipo_vacante,
        'motivo_vacante' => $motivo_vacante,
        'periodo_id' => $periodo_id,
        'fecha_mod' => $this->tools->getDateHour(),
        'tipo_proceso' => $tipo_proceso,
        // 'estado' => $estado,
        /* 'mod_id' => $mod_id, */
        //'ie'=>@$school->mod_nombre,
       // 'nivel'=>@$school->mod_nivel
      ];
      
      $this->db->update('plazas', $data, ['plz_id' => $id]);

      $response['success'] = true;
      $response['status']  = 200;
      $response['data']    = compact('id');
      $response['message'] = 'Se actualizo correctamente';
    } catch (\Exception $e) {
      $response['message'] = $e->getMessage();
    }
    return $response;
  }

  public function remove($request)
  {
      $response = $this->tools->responseDefault();
      try {

          $id = isset($request['id']) ? $request['id'] : 0;

          $sql = "SELECT * FROM plazas WHERE plz_id = ? AND deleted_at IS NULL";
          $plaza = $this->db->query($sql, compact('id'))->row();
          if (!$plaza) {
            throw new Exception("No sé encuentra registrado en está plaza");
          }

          $this->db->update('plazas', ['deleted_at' => $this->tools->getDateHour()], array('plz_id' => $id));
       
          $response['success'] = true;
          $response['status']  = 200;
          $response['message'] = 'Se elimino correctamente';
      } catch (\Exception $e) {
          $response['message'] = $e->getMessage();
      }
      return $response;
  }

  public function edit($request)
  {
      $response = $this->tools->responseDefault();
      try {

          $id = isset($request['id']) ? $request['id'] : 0;

          $sql = "SELECT * FROM plazas WHERE plz_id = ? AND deleted_at IS NULL";
          $plaza = $this->db->query($sql, compact('id'))->row();
          if (!$plaza) {
            throw new Exception("No sé encuentra registrado está plaza");
          }
          $plaza_id = $plaza->plz_id;
          $sql = "SELECT 
                    adj.*,
                    pos.nombre,
                    pos.apellido_paterno,
                    pos.apellido_materno,
                    pos.numero_documento,
                    pos.correo,
                    pos.numero_celular
                  FROM adjudicaciones AS adj
                  INNER JOIN postulaciones AS pos ON adj.postulacion_id = pos.id
                  WHERE adj.plaza_id = {$plaza_id}
                  AND adj.deleted_at IS NULL";
          $plaza_adjudicaciones = $this->db->query($sql)->result_object();
       
          $response['success'] = true;
          $response['status']  = 200;
          $response['data']    = compact('plaza', 'plaza_adjudicaciones');
          $response['message'] = 'Se proceso correctamente';
      } catch (\Exception $e) {
          $response['message'] = $e->getMessage();
      }
      return $response;
  }

  public function liberar(                                    )
  {
      $response = $this->tools->responseDefault();
      try {

          $id = $this->input->post("id", true);
          $observacion = $this->input->post("observacion", true);

          $sql = "SELECT * FROM adjudicaciones WHERE id = ? AND deleted_at IS NULL";
          $adjudicacion = $this->db->query($sql, compact('id'))->row();
          if (!$adjudicacion) {
            throw new Exception("No sé encuentra registrado está adjudicación");
          }

          $plaza_id = $adjudicacion->plaza_id;
          $postulacion_id = $adjudicacion->postulacion_id;

          $this->db->update('adjudicaciones', ['observacion' => $observacion, 'estado' => 0, 'fecha_liberacion' => $this->tools->getDateHour()], array('id' => $id));
          $this->db->update('postulaciones', ['estado_adjudicacion' => 0, 'intentos_adjudicacion' => 0], array('id' => $postulacion_id));
          $this->db->update('plazas', ['estado' => 1], array('plz_id' => $plaza_id));
          
          $response['success'] = true;
          $response['status']  = 200;
          $response['message'] = 'Se libero correctamente correctamente';
      } catch (\Exception $e) {
          $response['message'] = $e->getMessage();
      }
      return $response;
  }

  public function status() {
    $response = $this->tools->responseDefault();
    try {

      $ids   = $this->input->post("ids", true);
      $estado = $this->input->post("estado", true);

      $ids =  json_decode($ids);

      if (count($ids) == 0) {
        throw new Exception("Es necesario los registros de los docentes");
      }

      foreach ($ids as $k => $id) {
        $this->db->update('postulaciones', ['estado' => $estado], ['id' => $id]);
      }

      $response['success'] = true;
      $response['status']  = 200;
      $response['message'] = 'Se proceso correctamente';

    } catch (\Exception $e) {
        $response['message'] = $e->getMessage();
    }
    return $response; 
  }

  public function upload() {
    $response = $this->tools->responseDefault();
    try {

        $PATH_FILE  = 'archivos/pun' . '/';

        if (!is_dir($PATH_FILE)) {
            mkdir($PATH_FILE, 0777, true);
        }

        $name = "plazas_" . date("YmdHis");
        $extension   = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));
        if (empty($_FILES)) {
          throw new Exception("No se envió ningun archivo.");
        }

        $config["upload_path"]       = $PATH_FILE;
        $config["allowed_types"]     = "xlsx";
        $config["file_name"]         = $name . "." . $extension;
        $config["overwrite"]         = true; //sobreescribir
        $config["max_size"]         = 0;
        $config["max_filename"]     = 0;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload("file")) {
            $error = $this->upload->display_errors();
            throw new Exception("Ocurrió un error al cargar archivo: $error");
        }

        $nombreArchivo  = $config["file_name"]; // $this->input->post("nombreArchivo", true);

        $file = $PATH_FILE . $nombreArchivo;

        $archivo =  $file;
        $this->load->library('PHPExcel');
        // Cargo la hoja de cálculo
        $objPHPExcel = PHPExcel_IOFactory::load($archivo);
        //Asigno la hoja de calculo activa
        $objPHPExcel->setActiveSheetIndex(0);
        //Obtengo el numero de filas del archivo							
        $numFilas = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
        $numColumnas = ord($objPHPExcel->setActiveSheetIndex(0)->getHighestColumn()) - 64;
        
        $inserts = [];
        $updates = [];

        // Leer los datos de Excel
        for ($fila = 2; $fila <= $numFilas; $fila++) {

          $id                 = trim($objPHPExcel->getActiveSheet()->getCell('A' . $fila)->getCalculatedValue());
          $codigo_plaza       = trim($objPHPExcel->getActiveSheet()->getCell('B' . $fila)->getCalculatedValue());
          $ie                 = trim($objPHPExcel->getActiveSheet()->getCell('C' . $fila)->getCalculatedValue());
          $especialidad       = trim($objPHPExcel->getActiveSheet()->getCell('D' . $fila)->getCalculatedValue());
          $cargo              = trim($objPHPExcel->getActiveSheet()->getCell('E' . $fila)->getCalculatedValue());
          $caracteristica     = trim($objPHPExcel->getActiveSheet()->getCell('F' . $fila)->getCalculatedValue());
          $tipo               = trim($objPHPExcel->getActiveSheet()->getCell('G' . $fila)->getCalculatedValue());
          $jornada            = trim($objPHPExcel->getActiveSheet()->getCell('H' . $fila)->getCalculatedValue());
          $tipo_vacante       = trim($objPHPExcel->getActiveSheet()->getCell('I' . $fila)->getCalculatedValue());
          $motivo_vacante     = trim($objPHPExcel->getActiveSheet()->getCell('J' . $fila)->getCalculatedValue());
          $tipo_proceso       = trim($objPHPExcel->getActiveSheet()->getCell('K' . $fila)->getCalculatedValue());
          $tipo_convocatoria  = trim($objPHPExcel->getActiveSheet()->getCell('L' . $fila)->getCalculatedValue());
          $periodo_id         = trim($objPHPExcel->getActiveSheet()->getCell('M' . $fila)->getCalculatedValue());
          $modalidad_id       = trim($objPHPExcel->getActiveSheet()->getCell('N' . $fila)->getCalculatedValue());

          $data = [
            'codigo_plaza'      => $codigo_plaza,
            'ie'                => $ie,
            'especialidad'      => $especialidad,
            'cargo'             => $cargo,
            'caracteristica'    => $caracteristica,
            'tipo'              => $tipo,
            'jornada'           => $jornada,
            'tipo_vacante'      => $tipo_vacante,
            'motivo_vacante'    => $motivo_vacante,
            'tipo_convocatoria' => $tipo_convocatoria,
            'periodo_id'        => $periodo_id,
            'mod_id'      => $modalidad_id
          ];

          if ($id > 0) {
            $updates[] = [
              'data' => $data,
              'where' => [
                'plz_id' => $id
              ]
            ];
          } else {
            $inserts[] = $data;
          }
        }

        if (count($inserts) > 0) {
          $this->db->insert_batch('plazas', $inserts);
          $affected_rows = ($this->db->affected_rows() > 0) ? 1 : 0;
        }

        if (count($updates) > 0) {
          foreach ($updates as $k => $o) {
            $this->db->update('plazas', $o['data'], $o['where']);  
          }
        }

        $response['success'] = true;
        $response['status']  = 200;
        $response['message'] = 'Se proceso correctamente';
  
    } catch (\Exception $e) {
        $response['message'] = $e->getMessage();
    }
    return $response;
  }

}