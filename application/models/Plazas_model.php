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
  
        $response['success'] = true;
        $response['data']  = compact('periodos', 'procesos', 'colegios');
        $response['status']  = 200;
        $response['message'] = 'Se proceso correctamente';
  
      } catch (\Exception $e) {
          $response['message'] = $e->getMessage();
      }
      return $response; 
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
                                      pos.nombre LIKE('%{$value}%') 
                                    OR pos.apellido_paterno LIKE('%{$value}%')
                                    OR pos.apellido_materno LIKE('%{$value}%')
                                    OR pos.uid LIKE('%{$value}%')
                                    OR pos.numero_expediente LIKE('%{$value}%')
                                    OR pos.numero_documento LIKE('%{$value}%')
                                    OR cpp.cpe_orden LIKE('%{$value}%')
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

  public function store() {

    $response = $this->tools->responseDefault();
    try {

      $periodo_id = $this->input->post("periodo_id", true);
      $estado  = $this->input->post("estado", true);
      $tipo_proceso = $this->input->post("tipo_proceso", true);
      $tipo_convocatoria  = $this->input->post("tipo_convocatoria", true);
      $colegio_id = $this->input->post("colegio_id", true);
      $nivel  = $this->input->post("nivel", true);
      $especialidad = $this->input->post("especialidad", true);
      $jornada  = $this->input->post("jornada", true);
      $tipo_vacante = $this->input->post("tipo_vacante", true);
      $motivo_vacante  = $this->input->post("motivo_vacante", true);
      $codigo_plaza  = $this->input->post("codigo_plaza", true);

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
        'estado' => $estado,
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
      $estado  = $this->input->post("estado", true);
      $tipo_proceso = $this->input->post("tipo_proceso", true);
      $tipo_convocatoria  = $this->input->post("tipo_convocatoria", true);
      $ie = $this->input->post("ie", true);
      $nivel  = $this->input->post("nivel", true);
      $especialidad = $this->input->post("especialidad", true);
      $jornada  = $this->input->post("jornada", true);
      $tipo_vacante = $this->input->post("tipo_vacante", true);
      $motivo_vacante  = $this->input->post("motivo_vacante", true);
      $codigo_plaza  = $this->input->post("codigo_plaza", true);

      $data = [
        'codigo_plaza' => $codigo_plaza,
        'ie' => $ie,
        'especialidad' => $especialidad,
        'tipo_convocatoria' => $tipo_convocatoria,
        'jornada' => $jornada,
        'tipo_vacante' => $tipo_vacante,
        'motivo_vacante' => $motivo_vacante,
        'periodo_id' => $periodo_id,
        // 'fecha_reg' => $this->tools->getDateHour(),
        'tipo_proceso' => $tipo_proceso,
        'estado' => $estado,
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
       
          $response['success'] = true;
          $response['status']  = 200;
          $response['data']    = compact('plaza');
          $response['message'] = 'Se proceso correctamente';
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

}