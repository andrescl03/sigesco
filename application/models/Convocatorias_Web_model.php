<?php
class Convocatorias_web_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('tools');
  }

  public function index($idPer, $idPro)
  {
    $sql = $this->db
      ->select("*")
      ->from("modalidades mod")
      ->join("niveles niv", "mod.mod_id = niv.modalidad_mod_id", "inner")
      ->join("especialidades esp", "niv.niv_id = esp.niveles_niv_id", "inner")
      ->join("grupo_inscripcion gin", "esp.esp_id = gin.especialidades_esp_id", "inner")
      ->join("convocatorias_detalle cde", "gin.gin_id = cde.grupo_inscripcion_gin_id", "inner")
      ->join("convocatorias con", "con.con_id = cde.convocatorias_con_id", "inner")
      ->join("tipo_convocatoria tcon", "tcon.tipo_id = con.con_tipo", "inner")
      // ->where(array("cde.cde_estado"=>1, "con.con_estado"=>1, "gin.periodos_per_id"=>$idPer, "gin.procesos_pro_id"=>$idPro))
      ->where(array("cde.cde_estado" => 1, "gin.periodos_per_id" => $idPer, "gin.procesos_pro_id" => $idPro , "con_anio" => date("Y")))
      ->order_by("con.con_id desc, mod.mod_id asc, niv.niv_id asc, esp.esp_id asc")
      ->get();
     //echo $this->db->last_query(); exit(); 
     return $sql->result_array();
  }

  public function show($request)
  {
    phpinfo(); exit;
    $response = $this->tools->responseDefault();
    try {
      $convocatoria_id = isset($request['convocatoria_id']) ? $request['convocatoria_id'] : 0;
      $inscripcion_id = isset($request['inscripcion_id']) ? $request['inscripcion_id'] : 0;

      if (!$convocatoria_id) {
        throw new Exception("No se encontro el parámetro convocatoria_id");
      }
      if (!$inscripcion_id) {
        throw new Exception("No se encontro el parámetro inscripcion_id");
      }

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
                WHERE C.con_estado = 1
                AND C.con_id = ?
                AND GI.gin_id = ?";

      $convocatoria = $this->db->query($sql, compact('convocatoria_id', 'inscripcion_id'))->row();
      if (!$convocatoria) {
        throw new Exception("No se encontro la convocatoria");
      }

      $now_unix = strtotime($this->tools->getDateHour());
      //$con_fechainicio_unix = strtotime($convocatoria->con_fechainicio) ;
      //$con_fechafin_unix = strtotime($convocatoria->con_fechafin);

      $con_fechainicio_unix = strtotime($convocatoria->con_fechainicio . ' ' . substr($convocatoria->con_horainicio, 0, 5));
      $con_fechafin_unix = strtotime($convocatoria->con_fechafin . ' ' . substr($convocatoria->con_horafin, 0, 5));


      if (!($now_unix >= $con_fechainicio_unix
        && $now_unix <= $con_fechafin_unix)) {
        throw new Exception("La convocatoria ya expiró");
      }

      // $convocatoria->con_type_postulacion = $convocatoria->con_tipo; // PUN
      

      $fechaActual = new DateTime();
      $fechaFin = new DateTime($convocatoria->con_fechafin);
      $interval = $fechaActual->diff($fechaFin);
      $convocatoria->con_diasrestantes = $interval->days;

      $response['success'] = true;
      $response['data']  = compact('convocatoria');
      $response['status']  = 200;
      $response['message'] = 'show';
    } catch (\Exception $e) {
      $response['message'] = $e->getMessage();
    }
    return $response;
  }

  public function detail()
  {
    $response = $this->tools->responseDefault();
    try {

      $sql = "SELECT * FROM ubigeo_peru_departments";
      $departamentos = $this->db->query($sql)->result_object();

      $sql = "SELECT * FROM especialidades WHERE esp_estado = 1";
      $especialidades = $this->db->query($sql)->result_object();

      $sql = "SELECT * FROM niveles WHERE niv_estado = 1";
      $niveles = $this->db->query($sql)->result_object();

      $sql = "SELECT * FROM modalidades WHERE mod_estado = 1";
      $modalidades = $this->db->query($sql)->result_object();

      $sql = "SELECT * FROM ubigeo_peru_provinces";
      $provincias = $this->db->query($sql)->result_object();

      $sql = "SELECT * FROM ubigeo_peru_districts";
      $distritos = $this->db->query($sql)->result_object();

      $response['success'] = true;
      $response['data']  = compact('modalidades', 'niveles', 'especialidades', 'departamentos', 'distritos', 'provincias');
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
