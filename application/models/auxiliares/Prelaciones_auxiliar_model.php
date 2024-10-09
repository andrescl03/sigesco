<?php
class Prelaciones_auxiliar_model extends CI_Model {

    public function __construct(){
        parent::__construct();
        $this->load->library('tools');
    }

    public function index() {
      $response = $this->tools->responseDefault();
      try {
  
        $response['success'] = true;
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
                                       e1.id LIKE('%{$value}%') 
                                    OR e1.prelacion LIKE('%{$value}%') 
                                    OR e1.especialidad_id LIKE('%{$value}%')
                                    OR e2.esp_descripcion LIKE('%{$value}%')
                                    OR niv.niv_descripcion LIKE('%{$value}%')
                                    OR moda.mod_abreviatura LIKE('%{$value}%')
                                  ) ";
              }
          }

          $sql = "SELECT 
                    e1.*,
                    e2.esp_descripcion AS especialidad_nombre,
                    niv.niv_descripcion AS nivel_nombre,
                    moda.mod_abreviatura AS modalidad_nombre
                  FROM auxiliar_especialidad_prelaciones e1
                  LEFT JOIN especialidades e2 ON e2.esp_id = e1.especialidad_id
                  INNER JOIN niveles niv ON e2.niveles_niv_id = niv.niv_id
                  INNER JOIN modalidades moda ON niv.modalidad_mod_id = moda.mod_id
                  WHERE e1.deleted_at IS NULL 
                  $filterText
                  ORDER BY e1.id DESC";


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

      $prelacion = $this->input->post("prelacion", true);
      $especialidad_id  = $this->input->post("especialidad_id", true);

      $data = [
        'especialidad_id' => $especialidad_id,
        'prelacion' => $prelacion,
      ];
      
      $this->db->insert('auxiliar_especialidad_prelaciones',$data);
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

      $sql = "SELECT * FROM auxiliar_especialidad_prelaciones WHERE id = ? AND deleted_at IS NULL";
      $especialidad_prelacion = $this->db->query($sql, compact('id'))->row();
      if (!$especialidad_prelacion) {
        throw new Exception("No sé encuentra registrado en está especialidad_prelacion");
      }

      $prelacion = $this->input->post("prelacion", true);
      $especialidad_id  = $this->input->post("especialidad_id", true);

      $data = [
        'especialidad_id' => $especialidad_id,
        'prelacion' => $prelacion,
      ];
      
      $this->db->update('auxiliar_especialidad_prelaciones', $data, ['id' => $id]);

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

          $sql = "SELECT * FROM auxiliar_especialidad_prelaciones WHERE id = ? AND deleted_at IS NULL";
          $especialidad_prelacion = $this->db->query($sql, compact('id'))->row();
          if (!$especialidad_prelacion) {
            throw new Exception("No sé encuentra registrado en está especialidad_prelacion");
          }

          $this->db->update('auxiliar_especialidad_prelaciones', ['deleted_at' => $this->tools->getDateHour()], array('id' => $id));
       
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

          $sqlModalidades = "SELECT * FROM modalidades WHERE mod_estado = 1";
          $modalidades = $this->db->query($sqlModalidades)->result_object();
          
          $sqlNiveles = "SELECT * FROM niveles WHERE niv_estado = 1";
          $niveles = $this->db->query($sqlNiveles)->result_object();

          $sql = "SELECT * FROM especialidades WHERE esp_estado = 1";
          $especialidades = $this->db->query($sql)->result_object();

          $sql = "SELECT * FROM auxiliar_especialidad_prelaciones esppre
          INNER JOIN especialidades esp ON esppre.especialidad_id = esp.esp_id
          INNER JOIN niveles niv ON esp.niveles_niv_id = niv.niv_id
          INNER JOIN modalidades moda ON niv.modalidad_mod_id  = moda.mod_id 
          WHERE esppre.deleted_at IS NULL AND esppre.id = ?";
          $especialidad_prelacion = $this->db->query($sql, compact('id'))->row();

          $response['success'] = true;
          $response['status']  = 200;
          $response['data']    = compact('especialidad_prelacion', 'modalidades', 'niveles', 'especialidades');
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

          $sqlModalidades = "SELECT * FROM modalidades WHERE mod_estado = 1";
          $modalidades = $this->db->query($sqlModalidades)->result_object();
          
          $sqlNiveles = "SELECT * FROM niveles WHERE niv_estado = 1";
          $niveles = $this->db->query($sqlNiveles)->result_object();
          
          $sqlEspecialidades = "SELECT * FROM especialidades WHERE esp_estado = 1";
          $especialidades = $this->db->query($sqlEspecialidades)->result_object();
          
          $response['success'] = true;
          $response['data']    = compact('modalidades','niveles','especialidades');
          $response['status']  = 200;
          $response['message'] = 'Se proceso correctamente';
      } catch (\Exception $e) {
          $response['message'] = $e->getMessage();
      }
      return $response;
  }

}