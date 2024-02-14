<?php
class Adjudicaciones_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('tools');
  }

  public function index() {
    return [];
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
                  /*$filterText = " AND AC.name LIKE('%{$value}%') 
                                  OR TC.name LIKE('%{$value}%')";*/
              }
          }

          $sql = "SELECT 
                    AD.*,
                    POS.nombre,
                    POS.apellido_paterno,
                    POS.apellido_materno,
                    PLA.codigoPlaza
                  FROM adjudicaciones AS AD
                  INNER JOIN postulaciones AS POS ON POS.id = AD.postulacion_id
                  INNER JOIN plazas AS PLA ON PLA.plz_id = AD.plaza_id
                  WHERE AD.deleted_at IS NULL
                  $filterText
                  ORDER BY AD.id DESC";
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
        $sql = "SELECT * FROM adjudicaciones WHERE id = ? AND deleted_at IS NULL";
        $adjudicacion = $this->db->query($sql, compact('adjudicacion_id'))->row();
        $sql = "SELECT * FROM plazas WHERE plz_id = ?";
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
                FROM postulaciones P
                LEFT JOIN postulacion_evaluaciones PE ON PE.postulacion_id = P.id AND PE.promedio = 1
                INNER JOIN convocatorias C ON C.con_id = P.convocatoria_id
                INNER JOIN convocatorias_detalle CD ON CD.convocatorias_con_id = C.con_id
                INNER JOIN grupo_inscripcion GI ON GI.gin_id = CD.grupo_inscripcion_gin_id AND GI.gin_id = P.inscripcion_id
                INNER JOIN especialidades E ON E.esp_id = GI.especialidades_esp_id
                INNER JOIN niveles N ON N.niv_id = E.niveles_niv_id
                INNER JOIN modalidades M ON M.mod_id = N.modalidad_mod_id     
                WHERE P.deletede?";
        $adjudicacion->postulacion = $this->db->query($sql, ['id' => $adjudicacion->postulacion_id])->row();
        $sql = "SELECT
                  US.*
                FROM usuarios US
                JOIN adjudicacion_firmas AF ON US.usu_id = AF.usuario_id
                WHERE AF.adjudicacion_id = ?;";
        $adjudicacion->firmas = $this->db->query($sql, ['id' => $adjudicacion->id])->result_object();
      }
      
      $postulaciones = []; // $this->getPostulaciones();      

      $sql = "SELECT PL.* , moda.*, nive.*
              FROM plazas AS PL
              LEFT JOIN adjudicaciones AD ON AD.plaza_id = PL.plz_id
              INNER JOIN modalidades moda ON moda.mod_id = PL.mod_id
              INNER JOIN niveles as nive ON nive.niv_id = PL.nivel_id
              AND AD.id IS NULL";
      $plazas = []; // $this->db->query($sql)->result_object();

      $sql = "SELECT * FROM usuarios";
      $usuarios = $this->db->query($sql)->result_object();

      $sigesco_id = $this->session->userdata("sigesco_id");   

      $sql = "SELECT 
                e1.* 
              FROM usuarios e1 
              INNER JOIN adjudicaciones_usuario_firmas e2 ON e1.usu_id = e2.usuario_id 
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

      $this->db->insert('adjudicaciones', [
        'postulacion_id' => $postulacion_id,
        'plaza_id' => $plaza_id,
        'fecha_inicio' => $fecha_inicio,
        'fecha_final' => $fecha_final,
        'fecha_registro' => $fecha_registro
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
        $this->db->insert_batch('adjudicacion_firmas', $inserts);
      }
      
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
      
      $this->db->update('adjudicaciones', $data, array('id' => $id));

      $this->db->delete('adjudicacion_firmas', array('adjudicacion_id' => $id)); 
      if (count($firmas) > 0) {
        $inserts = array();
        foreach ($firmas as $key => $item) {
            $inserts[] = [
                'adjudicacion_id' => $id,
                'usuario_id' => $item->usu_id
            ];
        }
        $this->db->insert_batch('adjudicacion_firmas', $inserts);
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

          $sql = "SELECT * FROM adjudicaciones WHERE id = ? AND deleted_at IS NULL";
          $adjudicacion = $this->db->query($sql, compact('id'))->row();
          if (!$adjudicacion) {
            throw new Exception("No sé encuentra registrado en está adjudicación");
          }

          $this->db->update('adjudicaciones', ['deleted_at' => $this->tools->getDateHour()], array('id' => $id));
       
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
          $sql = "SELECT * FROM adjudicaciones WHERE id = ? AND deleted_at IS NULL";
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
              FROM postulaciones P
              LEFT JOIN postulacion_evaluaciones PE ON PE.postulacion_id = P.id AND PE.promedio = 1
              INNER JOIN convocatorias C ON C.con_id = P.convocatoria_id
              INNER JOIN convocatorias_detalle CD ON CD.convocatorias_con_id = C.con_id
              INNER JOIN grupo_inscripcion GI ON GI.gin_id = CD.grupo_inscripcion_gin_id AND GI.gin_id = P.inscripcion_id
              INNER JOIN especialidades E ON E.esp_id = GI.especialidades_esp_id
              INNER JOIN niveles N ON N.niv_id = E.niveles_niv_id
              INNER JOIN modalidades M ON M.mod_id = N.modalidad_mod_id
              LEFT JOIN adjudicaciones AD ON AD.postulacion_id = P.id AND AD.deleted_at IS NULL               
              WHERE P.deleted_at IS NULL
              AND P.estado = 'finalizado'
              AND P.estado_adjudicacion IN (0,2, 3) 
              AND intentos_adjudicacion <  2
              AND AD.id IS NULL";
    return $this->db->query($sql)->result_object();
  }

  public function updateStatus($id) {
    $responseponse = $this->tools->responseDefault();
    try {

        $status  = $this->input->post("status", true);

        $sql = "SELECT * FROM postulaciones WHERE id = ? AND deleted_at IS NULL";
        $postulacion = $this->db->query($sql, compact('id'))->row();
        if (!$postulacion) {
            throw new Exception("No sé encuentra registrado en está adjudicación");
        }

        $intentos_postulante = (!$postulacion->intentos_adjudicacion) ? 1 : (intval($postulacion->intentos_adjudicacion) + 1);

      if ($intentos_postulante <= 2) {

        $this->db->update('postulaciones', ['estado_adjudicacion' => $status, 'intentos_adjudicacion' => $intentos_postulante], array('id' => $id));
      }
      
        $this->db->update('postulaciones', ['estado_adjudicacion' => $status], array('id' => $id));
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
      $sql = "SELECT * FROM adjudicaciones WHERE id = ? AND deleted_at IS NULL";
      $adjudicacion = $this->db->query($sql, compact('adjudicacion_id'))->row();
      if (!is_null($adjudicacion) && is_object($adjudicacion)) {

          $sql = "SELECT * FROM plazas WHERE plz_id = ?";
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
                      CPE.cpe_s5 AS puntaje,
                      P.distrito AS distrito_nombre,
                      P.provincia AS provincia_nombre,
                      P.departamento AS departamento_nombre
                  FROM postulaciones P
                  LEFT JOIN postulacion_evaluaciones PE ON PE.postulacion_id = P.id AND PE.promedio = 1
                  INNER JOIN convocatorias C ON C.con_id = P.convocatoria_id
                  INNER JOIN convocatorias_detalle CD ON CD.convocatorias_con_id = C.con_id
                  INNER JOIN grupo_inscripcion GI ON GI.gin_id = CD.grupo_inscripcion_gin_id AND GI.gin_id = P.inscripcion_id
                  INNER JOIN especialidades E ON E.esp_id = GI.especialidades_esp_id
                  INNER JOIN niveles N ON N.niv_id = E.niveles_niv_id
                  INNER JOIN modalidades M ON M.mod_id = N.modalidad_mod_id
                  INNER JOIN cuadro_pun_exp CPE ON P.numero_documento = CPE.cpe_documento
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
              FROM convocatorias C
              INNER JOIN convocatorias_detalle CD ON CD.convocatorias_con_id = C.con_id
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
                  JOIN adjudicacion_firmas AF ON US.usu_id = AF.usuario_id
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
      
      $this->db->delete('adjudicaciones_usuario_firmas', array('parent_id' => $sigesco_id));
      if (count($ids) > 0) {
        $inserts = array();
        foreach ($ids as $key => $value) {
          $inserts[] = [
            'usuario_id' => $value,
            'parent_id' => $sigesco_id
          ];
        }
        $this->db->insert_batch('adjudicaciones_usuario_firmas', $inserts);
      }

      $sigesco_id = $this->session->userdata("sigesco_id");   

      $sql = "SELECT 
                e1.* 
              FROM usuarios e1 
              INNER JOIN adjudicaciones_usuario_firmas e2 ON e1.usu_id = e2.usuario_id 
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
                                    plz.ie LIKE('%{$value}%') 
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
                LEFT JOIN adjudicaciones adj ON adj.plaza_id = plz.plz_id
                WHERE plz.deleted_at IS NULL 
                AND adj.id IS NULL
                $filterText
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

        $filterText = '';
        if ($search) {
            $value = $search['value'];
            if (strlen($value) > 0) {
                $filterText = " AND (
                                    P.numero_documento LIKE('%{$value}%')
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
                    PE.puntaje
                FROM postulaciones P
                LEFT JOIN postulacion_evaluaciones PE ON PE.postulacion_id = P.id AND PE.promedio = 1
                INNER JOIN convocatorias C ON C.con_id = P.convocatoria_id
                INNER JOIN convocatorias_detalle CD ON CD.convocatorias_con_id = C.con_id
                INNER JOIN grupo_inscripcion GI ON GI.gin_id = CD.grupo_inscripcion_gin_id AND GI.gin_id = P.inscripcion_id
                INNER JOIN especialidades E ON E.esp_id = GI.especialidades_esp_id
                INNER JOIN niveles N ON N.niv_id = E.niveles_niv_id
                INNER JOIN modalidades M ON M.mod_id = N.modalidad_mod_id
                LEFT JOIN adjudicaciones AD ON AD.postulacion_id = P.id AND AD.deleted_at IS NULL               
                WHERE P.deleted_at IS NULL
                AND P.estado = 'finalizado'
                AND P.estado_adjudicacion IN (0,2, 3) 
                AND intentos_adjudicacion <  2
                AND AD.id IS NULL
                $filterText
                ORDER BY P.id DESC";


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