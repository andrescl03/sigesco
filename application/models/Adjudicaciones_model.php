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
      $res = $this->tools->responseDefault();
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

          $res['success'] = true;
          $res['data'] = $adjudicaciones;
          $res['recordsTotal'] = $recordsTotal;
          $res['recordsFiltered'] = $recordsFiltered;
          $res['message'] = 'successfully';
      } catch (\Exception $e) {
          $res['message'] = $e->getMessage();
      }
      return $res;
  }

  public function resource() {
    $response = $this->tools->responseDefault();
    try {

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
              WHERE P.deleted_at IS NULL";
      $postulaciones = $this->db->query($sql)->result_object();

      $sql = "SELECT * FROM plazas";
      $plazas = $this->db->query($sql)->result_object();

      $response['success'] = true;
      $response['data']  = compact('postulaciones', 'plazas');
      $response['status']  = 200;
      $response['message'] = 'detail';
    } catch (\Exception $e) {
      $response['message'] = $e->getMessage();
    }
    return $response;
  }

  public function store()
  {
    $response = $this->tools->responseDefault();
    try {

      $plaza_id = $this->input->post("plaza_id", true);
      $postulacion_id  = $this->input->post("postulacion_id", true);
      $fecha_inicio  = $this->input->post("fecha_inicio", true);
      $fecha_final  = $this->input->post("fecha_final", true);

      $this->db->insert('adjudicaciones', [
        'postulacion_id' => $postulacion_id,
        'plaza_id' => $plaza_id,
        'fecha_inicio' => $fecha_inicio,
        'fecha_final' => $fecha_final,
        'fecha_registro' => $this->tools->getDateHour()
      ]);
      $id =  $this->db->insert_id(); // para saber el id ingresado
      
      $response['success'] = true;
      $response['status']  = 200;
      $response['message'] = 'Se guardo correctamente';
    } catch (\Exception $e) {
      $response['message'] = $e->getMessage();
    }
    return $response;
  }
}