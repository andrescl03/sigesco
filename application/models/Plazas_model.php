<?php
class Plazas_model extends CI_Model {

    public function __construct(){
        parent::__construct();
        $this->load->library('tools');
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
              WHERE e.pro_estado = 1
              AND e.pro_id = 1";
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
         * FROM modalidades where mod_estado = 1";
      $modalidades = $this->db->query($sql)->result_object();

      $sql = "SELECT 
              * FROM niveles where niv_estado = 1";
      $niveles = $this->db->query($sql)->result_object();


      /*$sql = "SELECT 
              e2.*
              FROM modularie e2
              ORDER BY e2.mod_nombre ASC";
      $niveles = $this->db->query($sql)->result_object();*/
        $response['success'] = true;
        $response['data']  = compact('periodos', 'procesos', 'colegios','modalidades','niveles');
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
      nive.niv_descripcion,
      adj.observacion as 'observacion_liberacion'
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

  public function f_details_plazas_liberadas()
  {
    $sql = "SELECT 
      plz.*,
      moda.mod_abreviatura,
      nive.niv_descripcion,
      adj.observacion as 'observacion_liberacion'
    FROM plazas plz
    LEFT JOIN adjudicaciones adj ON adj.plaza_id = plz.plz_id
    INNER JOIN modalidades moda ON plz.mod_id = moda.mod_id
    INNER JOIN niveles nive ON nive.niv_id =  plz.nivel_id
    WHERE plz.deleted_at IS NULL 
    AND ( adj.estado = 0 and plz.estado = 1)
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
 
          $filterText = '';

          $inputie = $this->input->post("columns[0][search][value]", true);
          $inputcodigoplaza = $this->input->post("columns[1][search][value]", true);
          $inputmotivovacante = $this->input->post("columns[2][search][value]", true);
          $inputespecialidad = $this->input->post("columns[3][search][value]", true);
          $inputtipocontrato = $this->input->post("columns[4][search][value]", true);
          $inputmodalidad = $this->input->post("columns[5][search][value]", true);
          $inputnivel = $this->input->post("columns[6][search][value]", true);

        if ($inputie) {
            $filterText .= " AND plz.ie LIKE('%{$inputie}%')";
        }

        if ($inputcodigoplaza) {
            $filterText .= " AND plz.codigo_plaza LIKE('%{$inputcodigoplaza}%')";
        }

        if ($inputmotivovacante) {
            $filterText .= " AND plz.motivo_vacante LIKE('%{$inputmotivovacante}%')";
        }

        if ($inputespecialidad) {
            $filterText .= " AND plz.especialidad LIKE('%{$inputespecialidad}%')";
        }

        if ($inputtipocontrato) {
            $filterText .= " AND tc.tipo_id LIKE('%{$inputtipocontrato}%')";
        }

        if ($inputmodalidad) {
          $filterText .= " AND plz.mod_id LIKE('%{$inputmodalidad}%')";
        }

        if ($inputnivel) {
          $filterText .= " AND plz.nivel_id LIKE('%{$inputnivel}%')";
        }


          $sql = "SELECT 
                    plz.* , tc.*, niv.*, moda.*
                  FROM plazas plz
                  INNER JOIN tipo_convocatoria tc ON plz.tipo_convocatoria = tc.tipo_id
                  INNER JOIN niveles niv ON plz.nivel_id = niv.niv_id
                  INNER JOIN modalidades moda  ON moda.mod_id = niv.modalidad_mod_id
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
      $tipo_proceso = $this->input->post("tipo_proceso", true);
      $tipo_convocatoria  = $this->input->post("tipo_convocatoria", true);
      $colegio_id = $this->input->post("colegio_id", true);
      $especialidad = $this->input->post("especialidad", true);
      $especialidad_general = $this->input->post("especialidad_general", true);
      $jornada  = $this->input->post("jornada", true);
      $tipo_vacante = $this->input->post("tipo_vacante", true);
      $motivo_vacante  = $this->input->post("motivo_vacante", true);
      $codigo_plaza  = $this->input->post("codigo_plaza", true);
      $mod_id  = $this->input->post("mod_id", true);
      $niv_id  = $this->input->post("niv_id", true);
      $cargo  = $this->input->post("cargo", true);
      $fecha_inicio  = $this->input->post("fecha_inicio", true);
      $fecha_fin  = $this->input->post("fecha_fin", true);

      if (is_numeric($codigo_plaza)) {
        $sql = "SELECT 
                *
              FROM plazas
              WHERE deleted_at IS NULL
              AND codigo_plaza = ?";
        $valid = $this->db->query($sql, ['codigo_plaza' => $codigo_plaza])->row();
        if ($valid) {
          throw new Exception("Ya existe una plaza con este código de plaza");
        }
      } else {
        $codigo_plaza = strtoupper(trim($codigo_plaza));
      }

      $sql = "SELECT 
                e1.*,
                e2.*
              FROM localie e1
              INNER JOIN modularie e2 ON e1.loc_id = e2.localie_loc_id
              WHERE e1.loc_id = {$colegio_id}
              GROUP BY e1.loc_codigo
              ORDER BY e2.mod_nombre ASC";
      $colegio = $this->db->query($sql)->row();

      $data = [
        'codigo_plaza' => $codigo_plaza,
        'colegio_id' => $colegio_id,
        'especialidad' => $especialidad,
        'especialidad_general' => $especialidad_general,
        'tipo_convocatoria' => $tipo_convocatoria,
        'jornada' => $jornada,
        'tipo_vacante' => $tipo_vacante,
        'motivo_vacante' => $motivo_vacante,
        'periodo_id' => $periodo_id,
        'fecha_reg' => $this->tools->getDateHour(),
        'tipo_proceso' => $tipo_proceso,
        'estado' => 1, // $estado
        'mod_id' => $mod_id,
        'nivel_id' => $niv_id,
        'ie'=>@$colegio->mod_nombre,
        'nivel'=>@$colegio->mod_nivel,
        'cargo'=>$cargo,
        'fecha_inicio'=>$fecha_inicio,
        'fecha_fin'=>$fecha_fin,
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
      $tipo_proceso = $this->input->post("tipo_proceso", true);
      $tipo_convocatoria  = $this->input->post("tipo_convocatoria", true);
      $ie = $this->input->post("ie", true);
      $especialidad = $this->input->post("especialidad", true);
      $especialidad_general = $this->input->post("especialidad_general", true);
      $jornada  = $this->input->post("jornada", true);
      $tipo_vacante = $this->input->post("tipo_vacante", true);
      $motivo_vacante  = $this->input->post("motivo_vacante", true);
      $codigo_plaza  = $this->input->post("codigo_plaza", true);
      $mod_id  = $this->input->post("mod_id", true);
      $niv_id  = $this->input->post("niv_id", true);
      $colegio_id = $this->input->post("colegio_id", true);
      $cargo  = $this->input->post("cargo", true);
      $fecha_inicio  = $this->input->post("fecha_inicio", true);
      $fecha_fin  = $this->input->post("fecha_fin", true);

      if (is_numeric($codigo_plaza)) {
        $sql = "SELECT 
              *
            FROM plazas
            WHERE deleted_at IS NULL
            AND plz_id != ?
            AND codigo_plaza = ?";
        $valid = $this->db->query($sql, ['plz_id' => $id, 'codigo_plaza' => $codigo_plaza])->row();
        if ($valid) {
          throw new Exception("Ya existe una plaza con este código de plaza");
        }
      } else {
        $codigo_plaza = strtoupper(trim($codigo_plaza));
      }

      $sql = "SELECT 
                e1.*,
                e2.*
              FROM localie e1
              INNER JOIN modularie e2 ON e1.loc_id = e2.localie_loc_id
              WHERE e1.loc_id = {$colegio_id}
              GROUP BY e1.loc_codigo
              ORDER BY e2.mod_nombre ASC";
      $colegio = $this->db->query($sql)->row();

      $data = [
        'codigo_plaza' => $codigo_plaza,
        'colegio_id' => $colegio_id,
        'ie'=>@$colegio->mod_nombre,
        'especialidad' => $especialidad,
        'especialidad_general' => $especialidad_general,
        'tipo_convocatoria' => $tipo_convocatoria,
        'jornada' => $jornada,
        'tipo_vacante' => $tipo_vacante,
        'motivo_vacante' => $motivo_vacante,
        'periodo_id' => $periodo_id,
        'fecha_mod' => $this->tools->getDateHour(),
        'tipo_proceso' => $tipo_proceso,
        'mod_id' => $mod_id,
        'nivel_id' => $niv_id,
        'nivel'=>@$colegio->mod_nivel,
        'cargo'=>$cargo,
        'fecha_inicio'=>$fecha_inicio,
        'fecha_fin'=>$fecha_fin
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

          $sql = "SELECT 
                    *
                  FROM modalidades";
          $modalidades = $this->db->query($sql)->result_object();

          $sql = "SELECT 
                    *
                  FROM niveles";
          $niveles = $this->db->query($sql)->result_object();
       
          $response['success'] = true;
          $response['status']  = 200;
          $response['data']    = compact('plaza', 'plaza_adjudicaciones', 'modalidades', 'niveles', 'colegios');
          $response['message'] = 'Se proceso correctamente';
      } catch (\Exception $e) {
          $response['message'] = $e->getMessage();
      }
      return $response;
  }

  public function create()
  {
      $response = $this->tools->responseDefault();
      try {

          $sql = "SELECT 
                    *
                  FROM modalidades";
          $modalidades = $this->db->query($sql)->result_object();

          $sql = "SELECT 
                    *
                  FROM niveles";
          $niveles = $this->db->query($sql)->result_object();
       
          $response['success'] = true;
          $response['status']  = 200;
          $response['data']    = compact('modalidades', 'niveles');
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

        $PATH_FILE  = 'archivos/pun/';

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
        
        $items = [];
        // Leer los datos de Excel
        for ($fila = 2; $fila <= $numFilas; $fila++) {
          try {
            $resp = [
              'success' => false,
              'message' => "Error",
              'data'    => []  
            ];
            $errors = [];
            $id                 = trim($objPHPExcel->getActiveSheet()->getCell('A' . $fila)->getCalculatedValue());
            $codigo_plaza       = trim($objPHPExcel->getActiveSheet()->getCell('B' . $fila)->getCalculatedValue());
          //  $codigo_modular     = trim($objPHPExcel->getActiveSheet()->getCell('C' . $fila)->getCalculatedValue());
            $ie                 = trim($objPHPExcel->getActiveSheet()->getCell('C' . $fila)->getCalculatedValue());
            $especialidad       = trim($objPHPExcel->getActiveSheet()->getCell('D' . $fila)->getCalculatedValue());
            $especialidad_general  = trim($objPHPExcel->getActiveSheet()->getCell('E' . $fila)->getCalculatedValue());
            $cargo              = trim($objPHPExcel->getActiveSheet()->getCell('F' . $fila)->getCalculatedValue());
            $caracteristica     = trim($objPHPExcel->getActiveSheet()->getCell('G' . $fila)->getCalculatedValue());
            $tipo               = trim($objPHPExcel->getActiveSheet()->getCell('H' . $fila)->getCalculatedValue());
            $jornada            = trim($objPHPExcel->getActiveSheet()->getCell('I' . $fila)->getCalculatedValue());
            $tipo_vacante       = trim($objPHPExcel->getActiveSheet()->getCell('J' . $fila)->getCalculatedValue());
            $motivo_vacante     = trim($objPHPExcel->getActiveSheet()->getCell('K' . $fila)->getCalculatedValue());
            $tipo_proceso       = trim($objPHPExcel->getActiveSheet()->getCell('L' . $fila)->getCalculatedValue());
            $tipo_convocatoria  = trim($objPHPExcel->getActiveSheet()->getCell('M' . $fila)->getCalculatedValue());
            $periodo_id         = trim($objPHPExcel->getActiveSheet()->getCell('N' . $fila)->getCalculatedValue());
            $modalidad_id       = trim($objPHPExcel->getActiveSheet()->getCell('O' . $fila)->getCalculatedValue());
            $nivel_id           = trim($objPHPExcel->getActiveSheet()->getCell('P' . $fila)->getCalculatedValue());

            $data = [
              'codigo_plaza'      => $codigo_plaza,
              'codigoPlaza'       => $codigo_plaza,
             // 'codigo_modular'    => $codigo_modular,
              'ie'                => $ie,
              'especialidad'      => $especialidad,
              'especialidad_general' => $especialidad_general,
              'cargo'             => $cargo,
              'caracteristica'    => $caracteristica,
              'tipo'              => $tipo,
              'jornada'           => $jornada,
              'tipo_vacante'      => $tipo_vacante,
              'motivo_vacante'    => $motivo_vacante,
              'tipo_convocatoria' => $tipo_convocatoria,
              'periodo_id'        => $periodo_id,
              'mod_id'            => $modalidad_id,
              'nivel_id'          => $nivel_id,
              'tipo_id'           => '1',
              'tipo_proceso'      => '1'
            ];

            if (empty($codigo_plaza)) {
              $errors[] = 'El codigo de plaza es un campo obligatiorio';
            }
           /* if (empty($codigo_modular)) {
              $errors[] = 'El codigo modular es un campo obligatiorio';
            }*/

            if (count($errors) > 0) {
              throw new Exception(implode(",", $errors));
            }

            if (is_numeric($codigo_plaza)) {
              $sql = "SELECT * FROM plazas WHERE codigo_plaza = ? AND deleted_at IS NULL";
              $plaza = $this->db->query($sql, compact('codigo_plaza'))->row();
              $id = $plaza ? $plaza->plz_id : false;
            }

            if ((is_numeric($id) && $id > 0)) {
              $this->db->update('plazas', $data, ['plz_id' => $id]);
              $message = "Se actualizo correctamente";
            } else {
              $data['estado'] = '1';
              $this->db->insert('plazas', $data);
              $id = $this->db->insert_id();
              $message = "Se registro correctamente";
            }

            $sql = "SELECT * FROM plazas WHERE plz_id = ? AND deleted_at IS NULL";
            $plaza = $this->db->query($sql, compact('id'))->row();
            
            $resp['data'] = $plaza;
            $resp['success'] = true;
            $resp['message'] = $message;

          } catch (\Exception $ee) {
            $resp['data'] = $data;
            $resp['message'] = $ee->getMessage();
          }
          $items[] = $resp;
        }
        $response['success'] = true;
        $response['data']    = compact('items');
        $response['status']  = 200;
        $response['message'] = 'Se proceso correctamente';
  
    } catch (\Exception $e) {
        $response['message'] = $e->getMessage();
    }
    return $response;
  }

}