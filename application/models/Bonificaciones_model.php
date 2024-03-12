<?php
class Bonificaciones_model extends CI_Model {

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
                                    OR e1.nombre LIKE('%{$value}%') 
                                    OR e1.puntaje LIKE('%{$value}%')
                                  ) ";
              }
          }

          $sql = "SELECT 
                    e1.*
                  FROM bonificaciones e1
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

      $nombre = $this->input->post("nombre", true);
      $puntaje  = $this->input->post("puntaje", true);

      $data = [
        'nombre' => $nombre,
        'puntaje' => $puntaje,
      ];
      
      $this->db->insert('bonificaciones',$data);
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

      $sql = "SELECT * FROM bonificaciones WHERE id = ? AND deleted_at IS NULL";
      $bonificacion = $this->db->query($sql, compact('id'))->row();
      if (!$bonificacion) {
        throw new Exception("No sé encuentra registrado en está bonificacion");
      }

      $nombre = $this->input->post("nombre", true);
      $puntaje  = $this->input->post("puntaje", true);

      $data = [
        'nombre' => $nombre,
        'puntaje' => $puntaje,
      ];
      
      $this->db->update('bonificaciones', $data, ['id' => $id]);

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

          $sql = "SELECT * FROM bonificaciones WHERE id = ? AND deleted_at IS NULL";
          $bonificacion = $this->db->query($sql, compact('id'))->row();
          if (!$bonificacion) {
            throw new Exception("No sé encuentra registrado en está bonificacion");
          }

          $this->db->update('bonificaciones', ['deleted_at' => $this->tools->getDateHour()], array('id' => $id));
       
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

          $sql = "SELECT * FROM bonificaciones WHERE deleted_at IS NULL AND id = ?";
          $bonificacion = $this->db->query($sql, compact('id'))->row();

          $response['success'] = true;
          $response['status']  = 200;
          $response['data']    = compact('bonificacion');
          $response['message'] = 'Se proceso correctamente';
      } catch (\Exception $e) {
          $response['message'] = $e->getMessage();
      }
      return $response;
  }

  public function create(                                    )
  {
      $response = $this->tools->responseDefault();
      try {
          
          $response['success'] = true;
          $response['data']    = compact('especialidades');
          $response['status']  = 200;
          $response['message'] = 'Se proceso correctamente';
      } catch (\Exception $e) {
          $response['message'] = $e->getMessage();
      }
      return $response;
  }

}