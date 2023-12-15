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
                    *
                  FROM adjudicaciones AS AD
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

      $sql = "SELECT * FROM postulaciones WHERE deleted_at IS NULL";
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


  public function detailConvocatoriaGrupoInscripcion($idConvocatoria)
  {
    $response = $this->tools->responseDefault();
    try {

      $sql = $this->db
        ->select("*")
        ->from("modalidades mod")
        ->join("niveles niv", "mod.mod_id = niv.modalidad_mod_id", "inner")
        ->join("especialidades esp", "niv.niv_id = esp.niveles_niv_id", "inner")
        ->join("grupo_inscripcion gin", "esp.esp_id = gin.especialidades_esp_id", "inner")
        ->join("convocatorias_detalle cde", "gin.gin_id = cde.grupo_inscripcion_gin_id", "inner")
        ->join("convocatorias con", "con.con_id = cde.convocatorias_con_id", "inner")
        ->where(array("cde.cde_estado" => 1, "con_id" => $idConvocatoria))
        ->order_by("con.con_id desc, mod.mod_id asc, niv.niv_id asc, esp.esp_id asc")
        ->get();
      // echo $this->db->last_query(); exit(); 
      $convocatoriaGrupoInscripcion =  $sql->result_array();

      $response['success'] = true;
      $response['data']  = $convocatoriaGrupoInscripcion;
      $response['status']  = 200;
      $response['message'] = 'detail';
    } catch (\Exception $e) {
      $response['message'] = $e->getMessage();
    }
    return $response;
  }
}