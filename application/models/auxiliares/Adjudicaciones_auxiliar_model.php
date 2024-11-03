<?php
class Adjudicaciones_auxiliar_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('tools');
  }

  public function index() {
    return [];
  }

  public function form() {
    $response = $this->tools->responseDefault();
    try {

      $sql = "SELECT 
            * FROM auxiliar_tipo_convocatoria where deleted_at IS NULL";
      $tipos = $this->db->query($sql)->result_object();

      $response['success'] = true;
      $response['data']  = compact('tipos');
      $response['status']  = 200;
      $response['message'] = 'Se proceso correctamente';

    } catch (\Exception $e) {
        $response['message'] = $e->getMessage();
    }
    return $response; 
  }

  public function uploadActaFirmada()
  {
    $actaFirmada = isset($_FILES['archivos']) ? $_FILES['archivos'] : [];

    if (!isset($_FILES['archivos']) || empty($_FILES['archivos']['name'][0])) {
      throw new Exception('Debe adjuntar al menos un documento');
    }
    $id =  $this->input->post("id", true);

    $actaFirmada = $_FILES['archivos'];
    $total = count($actaFirmada['name']);
    $files = [];
    $insert_archivos = [];


    if ($total > 0) {
      $path = __DIR__ . "/../../public/uploads/auxiliares/";
      if (!is_dir($path)) {
        mkdir($path, 0777, true);
      }

      $fields = ["name", "type", "tmp_name", "error", "size"];
      $uploads = $_FILES['archivos'];

      for ($index = 0; $index < $total; $index++) {
        $file = [];
        foreach ($fields as $field) {
          $file[$field] = $uploads[$field][$index];
        }
        $files[] = $file;
      }

      foreach ($files as $file) {
        if ($file['error'] == UPLOAD_ERR_OK) {
          $filename = uniqid(time()) . "-" . basename($file['name']);
          $fullpath = $path . $filename;
          $filepath = "/uploads/auxiliares/" . $filename;
          $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

          if (move_uploaded_file($file['tmp_name'], $fullpath)) {
            $insert_archivos = [
              'nombre' => $file['name'],
              'url' => $filepath,
              'formato' => $extension,
              'peso' => $file['size'],
              'postulacion_id' => $id,
              'tipo_id' => 11
            ];

            $this->db->insert('auxiliar_postulacion_archivos', $insert_archivos);


          }
        }
      }
      if (count($insert_archivos) > 0) {

        return [
          'status' => 'success',
          'message' =>  'Se cargó correctamente el documento'

        ];
      }
    } else {
      throw new Exception('No se encontraron archivos para subir');
    }

  }

  public function f_details_adjudicados($POST)
  {
    
    $value = $this->input->post("value", true);

    $filterText = '';
    if ($value) {
      if (strlen($value) > 0) {
        $filterText
        = " AND ( PLA.ie LIKE('%{$value}%') 
                            OR POS.numero_documento LIKE('%{$value}%')
                            OR POS.nombre LIKE('%{$value}%')
                            OR POS.apellido_paterno LIKE('%{$value}%')
                            OR POS.apellido_materno LIKE('%{$value}%')
                            OR CONCAT(POS.nombre, ' ', POS.apellido_paterno, ' ', POS.apellido_materno) LIKE('%{$value}%')
                            OR PLA.codigo_plaza LIKE('%{$value}%')
                            OR MODA.mod_abreviatura LIKE('%{$value}%')
                            OR NIVE.niv_descripcion LIKE('%{$value}%')
                            OR PLA.especialidad LIKE('%{$value}%') )";
      }
    }

    $sql = "SELECT 
    AD.*,
    POS.numero_documento,
    POS.nombre,
    POS.apellido_paterno,
    POS.apellido_materno,
    POS.correo,
    POS.numero_celular,
    POS.numero_expediente,
    PLA.codigo_plaza,
    PLA.ie,
    MODA.mod_abreviatura,
    NIVE.niv_descripcion,
    PLA.especialidad,
    PLA.tipo_convocatoria
        FROM auxiliar_adjudicaciones AS AD
          INNER JOIN auxiliar_postulaciones AS POS ON POS.id = AD.postulacion_id
          INNER JOIN auxiliar_plazas AS PLA ON PLA.plz_id = AD.plaza_id
          INNER JOIN modalidades AS MODA ON PLA.mod_id = MODA.mod_id
          INNER JOIN niveles AS NIVE ON NIVE.niv_id = PLA.nivel_id
          WHERE AD.deleted_at IS NULL $filterText
                  ORDER BY fecha_registro desc";

    $adjudicaciones = $this->db->query($sql)->result_object();
    return $adjudicaciones;
  }

  public function pagination($request) {
      $response = $this->tools->responseDefault();
      try {

          $draw   = $request['draw'];
          $length = $request['length'];
          $start  = $request['start'];
          $search = $request['search'];

          $filterText = '';
          if ($search) {
              $value = $search['value'];
              if (strlen($value) > 0) {
                  $filterText
                              = " AND ( PLA.ie LIKE('%{$value}%') 
                                  OR POS.numero_documento LIKE('%{$value}%')
                                  OR POS.nombre LIKE('%{$value}%')
                                  OR POS.apellido_paterno LIKE('%{$value}%')
                                  OR POS.apellido_materno LIKE('%{$value}%')
                                  OR CONCAT(POS.nombre, ' ', POS.apellido_paterno, ' ', POS.apellido_materno) LIKE('%{$value}%')
                                  OR PLA.codigo_plaza LIKE('%{$value}%')
                                  OR MODA.mod_abreviatura LIKE('%{$value}%')
                                  OR NIVE.niv_descripcion LIKE('%{$value}%')
                                  OR PLA.especialidad LIKE('%{$value}%') )";
                                   
              }
          }

        $sql = "SELECT 
          AD.*,
          POS.numero_documento,
          POS.id as 'postulante_id',
          POS.nombre,
          POS.apellido_paterno,
          POS.apellido_materno,
          PLA.codigo_plaza,
          PLA.ie,
          MODA.mod_abreviatura,
          NIVE.niv_descripcion,
          PLA.especialidad
        FROM auxiliar_adjudicaciones AS AD
        INNER JOIN auxiliar_postulaciones AS POS ON POS.id = AD.postulacion_id
        INNER JOIN auxiliar_plazas AS PLA ON PLA.plz_id = AD.plaza_id
        INNER JOIN modalidades AS MODA ON PLA.mod_id = MODA.mod_id
        INNER JOIN niveles AS NIVE ON NIVE.niv_id = PLA.nivel_id
        WHERE AD.deleted_at IS NULL AND AD.estado = 1
                  $filterText
                  ORDER BY fecha_registro desc";
          $adjudicaciones = $this->db->query($sql)->result_object();
          $recordsTotal = count($adjudicaciones);

          $sql .= " LIMIT {$start}, {$length}";

          $adjudicaciones = $this->db->query($sql)->result_object();

          $recordsFiltered = ($recordsTotal / $length) * $length;

          $response['success'] = true;
          $response['data'] = $adjudicaciones;
          $response['recordsTotal'] = $recordsTotal;
          $response['recordsFiltered'] = $recordsFiltered;
          $response['message'] = 'successfully';
      } catch (\Exception $e) {
          $response['message'] = $e->getMessage();
      }
      return $response;
  }

  public function datedefault()
  {

    $responseponse = $this->tools->responseDefault();

    try {

      $responseponse['data'] = $this->tools->getDateHour("Y-m-d H:i");
      $responseponse['success'] = true;
      $responseponse['message'] = 'se obtuvo correctamente la información';

      $responseponse['status']  = 200;
    } catch (\Exception $e) {
      $responseponse['message'] = $e->getMessage();
    }
    return $responseponse;
  }

  public function resource() {
    $responseponse = $this->tools->responseDefault();
    try {

      $adjudicacion_id = $this->input->post("adjudicacion_id", true);
      $adjudicacion    = [];
      if ($adjudicacion_id > 0) {
        $sql = "SELECT * FROM auxiliar_adjudicaciones WHERE id = ? AND deleted_at IS NULL";
        $adjudicacion = $this->db->query($sql, compact('adjudicacion_id'))->row();
        $sql = "SELECT * FROM auxiliar_plazas WHERE plz_id = ?";
        $adjudicacion->plaza = $this->db->query($sql, ['plaza_id' => $adjudicacion->plaza_id])->row();
        $sql = "SELECT
                    P.*,
                    M.mod_id AS modalidad_id,
                    M.mod_nombre AS modalidad_nombre,
                    N.niv_id AS nivel_id,
                    N.niv_descripcion AS nivel_nombre,
                    E.esp_id AS especialidad_id,
                    E.esp_descripcion AS especialidad_nombre,
                    GI.gin_id AS inscripcion_id,
                    C.con_tipo as con_tipo,
                    PE.puntaje
                FROM auxiliar_postulaciones P
                LEFT JOIN auxiliar_postulacion_evaluaciones PE ON PE.postulacion_id = P.id AND PE.promedio = 1
                INNER JOIN auxiliar_convocatorias C ON C.con_id = P.convocatoria_id
                INNER JOIN auxiliar_convocatorias_detalle CD ON CD.convocatorias_con_id = C.con_id
                INNER JOIN grupo_inscripcion GI ON GI.gin_id = CD.grupo_inscripcion_gin_id AND GI.gin_id = P.inscripcion_id
                INNER JOIN especialidades E ON E.esp_id = GI.especialidades_esp_id
                INNER JOIN niveles N ON N.niv_id = E.niveles_niv_id
                INNER JOIN modalidades M ON M.mod_id = N.modalidad_mod_id     
                WHERE P.deleted_at IS NULL
                AND P.id = ?";
        $adjudicacion->postulacion = $this->db->query($sql, ['id' => $adjudicacion->postulacion_id])->row();
        $sql = "SELECT
                  US.*
                FROM usuarios US
                JOIN auxiliar_adjudicacion_firmas AF ON US.usu_id = AF.usuario_id
                WHERE AF.adjudicacion_id = ?;";
        $adjudicacion->firmas = $this->db->query($sql, ['id' => $adjudicacion->id])->result_object();
      }
      
      $postulaciones = []; // $this->getPostulaciones();      

      $sql = "SELECT PL.* , moda.*, nive.*
              FROM auxiliar_plazas AS PL
              LEFT JOIN auxiliar_adjudicaciones AD ON AD.plaza_id = PL.plz_id
              INNER JOIN modalidades moda ON moda.mod_id = PL.mod_id
              INNER JOIN niveles as nive ON nive.niv_id = PL.nivel_id
              WHERE AD.id IS NULL OR AD.deleted_at IS NOT NULL";
      $plazas = []; // $this->db->query($sql)->result_object();

      $sql = "SELECT 
                u.usu_id, u.usu_dni,
                u.usu_nombre,
                u.usu_apellidos 
              FROM modulos as m 
              INNER JOIN permisos as p ON p.modulos_mdl_id=m.mdl_id 
              INNER JOIN tipo_usuarios as tu ON tu.tus_id=p.tipo_usuarios_tus_id 
              INNER JOIN usuarios as u ON u.tipo_usuarios_tus_id=tu.tus_id
              WHERE u.usu_estado = 1 AND m.mdl_estado = 1 
              AND p.per_estado = 1 AND tu.tus_estado = 1 
              AND m.mdl_ruta = 'admin/auxiliares/evaluaciones' 
              ORDER BY u.usu_nombre asc, u.usu_apellidos";
      $usuarios = $this->db->query($sql)->result_object();

      $sigesco_id = $this->session->userdata("sigesco_id");   

      $sql = "SELECT 
                e1.* 
              FROM usuarios e1 
              INNER JOIN auxiliar_adjudicaciones_usuario_firmas e2 ON e1.usu_id = e2.usuario_id 
              WHERE e2.parent_id = $sigesco_id";
      $usuario_firmas = $this->db->query($sql)->result_object();

      $responseponse['success'] = true;
      $responseponse['data']  = compact('postulaciones', 'plazas', 'usuarios', 'adjudicacion', 'usuario_firmas');
      $responseponse['status']  = 200;
      $responseponse['message'] = 'detail';
    } catch (\Exception $e) {
      $responseponse['message'] = $e->getMessage();
    }
    return $responseponse;
  }

  public function store()
  {
    $responseponse = $this->tools->responseDefault();
    try {
      
      $firmas  = $this->input->post("firmas", true);
      $firmas = json_decode($firmas);

      $plaza_id = $this->input->post("plaza_id", true);
      $postulacion_id  = $this->input->post("postulacion_id", true);
      $fecha_inicio  = $this->input->post("fecha_inicio", true);
      $fecha_final  = $this->input->post("fecha_final", true);
      $fecha_registro  = $this->input->post("fecha_registro", true);
      $tipo_convocatoria  = $this->input->post("tipo_convocatoria", true);

      $this->db->insert('auxiliar_adjudicaciones', [
        'postulacion_id' => $postulacion_id,
        'plaza_id' => $plaza_id,
        'fecha_inicio' => $fecha_inicio,
        'fecha_final' => $fecha_final,
        'fecha_registro' => $fecha_registro,
        'estado'  => 1
      ]);

      $id =  $this->db->insert_id(); // para saber el id ingresado
      
      if (count($firmas) > 0) {
        $inserts = array();
        foreach ($firmas as $key => $item) {
            $inserts[] = [
                'adjudicacion_id' => $id,
                'usuario_id' => $item->usu_id
            ];
        }
        $this->db->insert_batch('auxiliar_adjudicacion_firmas', $inserts);
      }

      $this->db->update('auxiliar_plazas', ['estado'=>0 , 'tipo_convocatoria' => $tipo_convocatoria], array('plz_id' => $plaza_id));
      
      $responseponse['success'] = true;
      $responseponse['status']  = 200;
      $responseponse['message'] = 'Se guardo correctamente';
    } catch (\Exception $e) {
      $responseponse['message'] = $e->getMessage();
    }
    return $responseponse;
  }

  public function update($request)
  {
    $responseponse = $this->tools->responseDefault();
    try {
      $id = $request['id'];
      $firmas  = $this->input->post("firmas", true);
      $fecha_inicio  = $this->input->post("fecha_inicio", true);
      $fecha_final  = $this->input->post("fecha_final", true);
      $fecha_registro  = $this->input->post("fecha_registro", true);

      $firmas = json_decode($firmas);
      $data = [
        'fecha_inicio' => $fecha_inicio,
        'fecha_final' => $fecha_final,
        'fecha_registro' => $fecha_registro
      ];
      
      $this->db->update('auxiliar_adjudicaciones', $data, array('id' => $id));

      $this->db->delete('auxiliar_adjudicacion_firmas', array('adjudicacion_id' => $id)); 
      if (count($firmas) > 0) {
        $inserts = array();
        foreach ($firmas as $key => $item) {
            $inserts[] = [
                'adjudicacion_id' => $id,
                'usuario_id' => $item->usu_id
            ];
        }
        $this->db->insert_batch('auxiliar_adjudicacion_firmas', $inserts);
      }

      $responseponse['success'] = true;
      $responseponse['status']  = 200;
      $responseponse['message'] = 'Se guardo correctamente';
    } catch (\Exception $e) {
      $responseponse['message'] = $e->getMessage();
    }
    return $responseponse;
  }

  public function remove($request)
  {
      $responseponse = $this->tools->responseDefault();
      try {

          $id = isset($request['id']) ? $request['id'] : 0;

          $sql = "SELECT * FROM auxiliar_adjudicaciones WHERE id = ? AND deleted_at IS NULL";
          $adjudicacion = $this->db->query($sql, compact('id'))->row();
          if (!$adjudicacion) {
            throw new Exception("No sé encuentra registrado en está adjudicación");
          }

          $this->db->update('auxiliar_adjudicaciones', ['deleted_at' => $this->tools->getDateHour()], array('id' => $id));
       
          $responseponse['success'] = true;
          $responseponse['status']  = 200;
          $responseponse['message'] = 'Se elimino correctamente';
      } catch (\Exception $e) {
          $responseponse['message'] = $e->getMessage();
      }
      return $responseponse;
  }

  public function edit($request)
  {
      $responseponse = $this->tools->responseDefault();
      try {

          $id = isset($request['id']) ? $request['id'] : 0;
          $sql = "SELECT * FROM auxiliar_adjudicaciones WHERE id = ? AND deleted_at IS NULL";
          $adjudicacion = $this->db->query($sql, compact('id'))->row();
          if (!$adjudicacion) {
            show_404();
          }
       
          $responseponse['success'] = true;
          $responseponse['data']    = compact('adjudicacion', 'id');
          $responseponse['status']  = 200;
          $responseponse['message'] = 'Editar adjudicación';
      } catch (\Exception $e) {
          $responseponse['message'] = $e->getMessage();
      }
      return $responseponse;
  }

  public function getPostulaciones() {
    $sql = "SELECT
                  P.*,
                  M.mod_id AS modalidad_id,
                  M.mod_nombre AS modalidad_nombre,
                  N.niv_id AS nivel_id,
                  N.niv_descripcion AS nivel_nombre,
                  E.esp_id AS especialidad_id,
                  E.esp_descripcion AS especialidad_nombre,
                  GI.gin_id AS inscripcion_id,
                  C.con_tipo as con_tipo,
                  PE.puntaje
              FROM auxiliar_postulaciones P
              LEFT JOIN auxiliar_postulacion_evaluaciones PE ON PE.postulacion_id = P.id AND PE.promedio = 1
              INNER JOIN auxiliar_convocatorias C ON C.con_id = P.convocatoria_id
              INNER JOIN auxiliar_convocatorias_detalle CD ON CD.convocatorias_con_id = C.con_id
              INNER JOIN grupo_inscripcion GI ON GI.gin_id = CD.grupo_inscripcion_gin_id AND GI.gin_id = P.inscripcion_id
              INNER JOIN especialidades E ON E.esp_id = GI.especialidades_esp_id
              INNER JOIN niveles N ON N.niv_id = E.niveles_niv_id
              INNER JOIN modalidades M ON M.mod_id = N.modalidad_mod_id
              LEFT JOIN auxiliar_adjudicaciones AD ON AD.postulacion_id = P.id AND AD.deleted_at IS NULL               
              WHERE P.deleted_at IS NULL
              AND P.estado = 'finalizado'
              AND P.estado_adjudicacion IN (0,2, 3) 
              AND intentos_adjudicacion <  2
              AND AD.estado = 1";
    return $this->db->query($sql)->result_object();
  }

  public function updateStatus($id) {
    $responseponse = $this->tools->responseDefault();
    try {

        $status  = $this->input->post("status", true);

        $sql = "SELECT * FROM auxiliar_postulaciones WHERE id = ? AND deleted_at IS NULL";
        $postulacion = $this->db->query($sql, compact('id'))->row();
        if (!$postulacion) {
            throw new Exception("No sé encuentra registrado en está adjudicación");
        }

        $intentos_postulante = (!$postulacion->intentos_adjudicacion) ? 1 : (intval($postulacion->intentos_adjudicacion) + 1);

      if ($intentos_postulante <= 2) {

        $this->db->update('auxiliar_postulaciones', ['estado_adjudicacion' => $status, 'intentos_adjudicacion' => $intentos_postulante], array('id' => $id));
      }
      
        $this->db->update('auxiliar_postulaciones', ['estado_adjudicacion' => $status], array('id' => $id));
        $postulaciones = $this->getPostulaciones(); 
    
        $responseponse['success'] = true;
        $responseponse['status']  = 200;
        $responseponse['data']    = compact('postulaciones');
        $responseponse['message'] = 'Se proceso correctamente';
    } catch (\Exception $e) {
        $responseponse['message'] = $e->getMessage();
    }
    return $responseponse;
  }

  public function f_detail($adjudicacion_id) {
    $adjudicacion    = [];
    if ($adjudicacion_id > 0) {
      $sql = "SELECT * FROM auxiliar_adjudicaciones WHERE id = ? AND deleted_at IS NULL";
      $adjudicacion = $this->db->query($sql, compact('adjudicacion_id'))->row();
      if (!is_null($adjudicacion) && is_object($adjudicacion)) {

          $sql = "SELECT * FROM auxiliar_plazas WHERE plz_id = ?";
          $adjudicacion->plaza = $this->db->query($sql, ['plaza_id' => $adjudicacion->plaza_id])->row();
          $sql = "SELECT
                      P.*,
                      M.mod_id AS modalidad_id,
                      M.mod_nombre AS modalidad_nombre,
                      N.niv_id AS nivel_id,
                      N.niv_descripcion AS nivel_nombre,
                      E.esp_id AS especialidad_id,
                      E.esp_descripcion AS especialidad_nombre,
                      GI.gin_id AS inscripcion_id,
                      C.con_tipo AS con_tipo,
                      -- CPE.cpe_s5 AS puntaje,
                      CASE C.con_tipo
                        WHEN 1 THEN CPE.cpe_s5
                        WHEN 2 THEN PE.puntaje
                      END AS puntaje,
                      P.distrito AS distrito_nombre,
                      P.provincia AS provincia_nombre,
                      P.departamento AS departamento_nombre
                  FROM auxiliar_postulaciones P
                  LEFT JOIN auxiliar_postulacion_evaluaciones PE ON PE.postulacion_id = P.id AND PE.promedio = 1
                  INNER JOIN auxiliar_convocatorias C ON C.con_id = P.convocatoria_id
                  INNER JOIN auxiliar_convocatorias_detalle CD ON CD.convocatorias_con_id = C.con_id
                  INNER JOIN grupo_inscripcion GI ON GI.gin_id = CD.grupo_inscripcion_gin_id AND GI.gin_id = P.inscripcion_id
                  INNER JOIN especialidades E ON E.esp_id = GI.especialidades_esp_id
                  INNER JOIN niveles N ON N.niv_id = E.niveles_niv_id
                  INNER JOIN modalidades M ON M.mod_id = N.modalidad_mod_id
                  LEFT JOIN auxiliar_cuadro_pun_exp CPE ON P.numero_documento = CPE.cpe_documento AND CPE.grupo_inscripcion_gin_id = P.inscripcion_id AND CPE.cpe_tipoCuadro = 1
                  WHERE P.deleted_at IS NULL AND P.id = ?";
          $adjudicacion->postulacion = $this->db->query($sql, ['id' => $adjudicacion->postulacion_id])->row();
        
          $sql = "SELECT
                  C.*,
                  M.mod_id AS modalidad_id,
                  M.mod_nombre AS modalidad_nombre,
                  N.niv_id AS nivel_id,
                  N.niv_descripcion AS nivel_nombre,
                  E.esp_id AS especialidad_id,
                  E.esp_descripcion AS especialidad_nombre,
                  GI.gin_id AS inscripcion_id,
                  C.con_tipo as con_tipo
              FROM auxiliar_convocatorias C
              INNER JOIN auxiliar_convocatorias_detalle CD ON CD.convocatorias_con_id = C.con_id
              INNER JOIN grupo_inscripcion GI ON GI.gin_id = CD.grupo_inscripcion_gin_id
              INNER JOIN especialidades E ON E.esp_id = GI.especialidades_esp_id
              INNER JOIN niveles N ON N.niv_id = E.niveles_niv_id
              INNER JOIN modalidades M ON M.mod_id = N.modalidad_mod_id
              WHERE C.con_id = ?
              AND GI.gin_id = ?";

          $adjudicacion->convocatoria = $this->db->query($sql, [
            'convocatoria_id' => $adjudicacion->postulacion->convocatoria_id,
            'inscripcion_id' => $adjudicacion->postulacion->inscripcion_id
          ])->row();

          $sql = "SELECT
                    US.*
                  FROM usuarios US
                  JOIN auxiliar_adjudicacion_firmas AF ON US.usu_id = AF.usuario_id
                  WHERE AF.adjudicacion_id = ?;";
          $adjudicacion->firmas = $this->db->query($sql, ['id' => $adjudicacion->id])->result_object();
      }
    }
    return compact('adjudicacion');
  }

  public function usuarioFirmas() {

    $responseponse = $this->tools->responseDefault();
    try {

      $ids = $this->input->post("ids", true);
      $ids = json_decode($ids);

      $sigesco_id = $this->session->userdata("sigesco_id");   
      
      $this->db->delete('auxiliar_adjudicaciones_usuario_firmas', array('parent_id' => $sigesco_id));
      if (count($ids) > 0) {
        $inserts = array();
        foreach ($ids as $key => $value) {
          $inserts[] = [
            'usuario_id' => $value,
            'parent_id' => $sigesco_id
          ];
        }
        $this->db->insert_batch('auxiliar_adjudicaciones_usuario_firmas', $inserts);
      }

      $sigesco_id = $this->session->userdata("sigesco_id");   

      $sql = "SELECT 
                e1.* 
              FROM usuarios e1 
              INNER JOIN auxiliar_adjudicaciones_usuario_firmas e2 ON e1.usu_id = e2.usuario_id 
              WHERE e2.parent_id = $sigesco_id";
      $usuario_firmas = $this->db->query($sql)->result_object();

      $responseponse['success'] = true;
      $responseponse['status']  = 200;
      $responseponse['data']    = compact('usuario_firmas');
      $responseponse['message'] = 'Se guardo correctamente';
    } catch (\Exception $e) {
      $responseponse['message'] = $e->getMessage();
    }
    return $responseponse;
  }

  public function plazas() {
    $response = $this->tools->responseDefault();
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
                                    plz_id LIKE('%{$value}%')
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
                  plz.* , tc.*
                FROM auxiliar_plazas plz
                LEFT JOIN auxiliar_adjudicaciones adj ON adj.plaza_id = plz.plz_id
                INNER JOIN auxiliar_tipo_convocatoria tc ON plz.tipo_convocatoria = tc.tipo_id
                WHERE plz.deleted_at IS NULL 
                AND (adj.id IS NULL OR adj.estado = 0)
                $filterText
                GROUP BY plz.plz_id
                ORDER BY plz.plz_id DESC";

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
    } catch (\Exception $e) {
        $response['message'] = $e->getMessage();
    }
    return $response;
  }

  public function postulantes() {
    $response = $this->tools->responseDefault();
    try {

        $draw   = $this->input->post("draw", true);
        $length = $this->input->post("length", true);
        $start  = $this->input->post("start", true);
        $search = $this->input->post("search", true);
        $esp_id = $this->input->post("esp_id", true);
        $tipo_postulacion_id = $this->input->post("tipo_postulacion_id", true);

        $filterText = '';

       $sqlEspecialidad = $esp_id ? " AND esp_id = $esp_id " : '';
       $sqlTipoPostulacion = $tipo_postulacion_id ? " AND con_tipo = $tipo_postulacion_id " : '';

      if ($search) {
            $value = $search['value'];
            if (strlen($value) > 0) {
                $filterText = " AND (
                                     P.id LIKE('%{$value}%')
                                  OR P.numero_documento LIKE('%{$value}%')
                                  OR P.nombre LIKE('%{$value}%')
                                  OR P.apellido_paterno LIKE('%{$value}%') 
                                  OR P.apellido_materno LIKE('%{$value}%')
                                  OR P.numero_expediente LIKE('%{$value}%')
                                  OR M.mod_nombre LIKE('%{$value}%')
                                  OR N.niv_descripcion LIKE('%{$value}%')
                                  OR E.esp_descripcion LIKE('%{$value}%')
                                ) ";
            }
        }

        $sql = "SELECT
                    P.*,
                    M.mod_id AS modalidad_id,
                    M.mod_nombre AS modalidad_nombre,
                    N.niv_id AS nivel_id,
                    N.niv_descripcion AS nivel_nombre,
                    E.esp_id AS especialidad_id,
                    E.esp_descripcion AS especialidad_nombre,
                    GI.gin_id AS inscripcion_id,
                    C.con_tipo as con_tipo,
                    PE.puntaje,
                    EP.prelacion
                FROM auxiliar_postulaciones P
                LEFT JOIN auxiliar_postulacion_evaluaciones PE ON PE.postulacion_id = P.id AND PE.promedio = 1
                INNER JOIN auxiliar_convocatorias C ON C.con_id = P.convocatoria_id
                INNER JOIN auxiliar_convocatorias_detalle CD ON CD.convocatorias_con_id = C.con_id
                INNER JOIN grupo_inscripcion GI ON GI.gin_id = CD.grupo_inscripcion_gin_id AND GI.gin_id = P.inscripcion_id
                INNER JOIN especialidades E ON E.esp_id = GI.especialidades_esp_id
                INNER JOIN niveles N ON N.niv_id = E.niveles_niv_id
                INNER JOIN modalidades M ON M.mod_id = N.modalidad_mod_id
                LEFT JOIN auxiliar_adjudicaciones AD ON AD.postulacion_id = P.id AND AD.deleted_at IS NULL
                LEFT JOIN auxiliar_especialidad_prelaciones EP ON EP.id = PE.prelacion_id             
                WHERE P.deleted_at IS NULL
                AND P.estado = 'finalizado'
                AND P.estado_adjudicacion IN (0,2, 3) 
                AND intentos_adjudicacion <  2
                AND (AD.id IS NULL OR AD.estado = 0)
                $sqlEspecialidad
                $sqlTipoPostulacion
                $filterText
                ORDER BY EP.prelacion ASC, PE.puntaje DESC";

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
    } catch (\Exception $e) {
        $response['message'] = $e->getMessage();
    }
    return $response;
  }

}