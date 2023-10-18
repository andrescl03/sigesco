<?php
class Postulaciones_model extends CI_Model {

    public function __construct(){
        parent::__construct();
        $this->load->library('tools');
        $this->load->model('email_model');
    }

    public function store() 
    {
        $rsp = $this->tools->responseDefault();
        try {

            $apellido_materno = isset($_POST['apellido_materno']) ? $_POST['apellido_materno'] : NULL;
            $apellido_paterno = isset($_POST['apellido_paterno']) ? $_POST['apellido_paterno'] : NULL;
            $nombre           = isset($_POST['nombre'])           ? $_POST['nombre']           : NULL;
            $correo           = isset($_POST['correo'])           ? $_POST['correo']           : NULL;
            $direccion        = isset($_POST['direccion'])        ? $_POST['direccion']        : NULL;
            $distrito_id      = isset($_POST['distrito_id'])      ? $_POST['distrito_id']      : 0;
            $especialidad_id  = isset($_POST['especialidad_id'])  ? $_POST['especialidad_id']  : NULL;
            $estado_civil     = isset($_POST['estado_civil'])     ? $_POST['estado_civil']     : NULL;
            $fecha_nacimiento = isset($_POST['fecha_nacimiento']) ? $_POST['fecha_nacimiento'] : NULL;
            $genero           = isset($_POST['genero'])           ? $_POST['genero']           : NULL;
            $modalidad        = isset($_POST['modalidad'])        ? $_POST['modalidad']        : NULL;
            $nacionalidad     = isset($_POST['nacionalidad'])     ? $_POST['nacionalidad']     : NULL;
            $nombre_via       = isset($_POST['nombre_via'])       ? $_POST['nombre_via']       : NULL;
            $numero_celular   = isset($_POST['numero_celular'])   ? $_POST['numero_celular']   : NULL;
            $numero_documento = isset($_POST['numero_documento']) ? $_POST['numero_documento'] : NULL;
            $tipo_documento   = isset($_POST['tipo_documento'])   ? $_POST['tipo_documento']   : 0;
            $numero_telefono  = isset($_POST['numero_telefono'])  ? $_POST['numero_telefono']  : NULL;
            $via              = isset($_POST['via'])              ? $_POST['via']              : NULL;
            $zona             = isset($_POST['zona'])             ? $_POST['zona']             : NULL;
            $convocatoria_id  = isset($_POST['convocatoria_id'])  ? $_POST['convocatoria_id']  : 0;
            $tipo_archivos    = isset($_POST['tipo_archivos'])    ? $_POST['tipo_archivos']    : [];
            $especializaciones      = isset($_POST['especializaciones'])      ? json_decode($_POST['especializaciones'], true)      : [];
            $formaciones_academicas = isset($_POST['formaciones_academicas']) ? json_decode($_POST['formaciones_academicas'], true) : [];
            $experiencias_laborales = isset($_POST['experiencias_laborales']) ? json_decode($_POST['experiencias_laborales'], true) : [];

            $insert_especializaciones      = [];
            $insert_formaciones_academicas = [];
            $insert_experiencias_laborales = [];

            if (count($especializaciones) > 0) {
                foreach ($especializaciones as $key => $item) {
                    $insert_especializaciones[] = [
                        'tipo_especializacion' => $item['tipo_especializacion'],
                        'tema_especializacion' => $item['tema_especializacion'],
                        'nombre_entidad'       => $item['nombre_entidad'],
                        'fecha_inicio'         => $item['fecha_inicio'],
                        'fecha_termino'        => $item['fecha_termino'],
                        'numero_horas'         => $item['numero_horas']
                    ];
                }  
            }

            if (count($formaciones_academicas) > 0) {
                foreach ($formaciones_academicas as $key => $item) {
                    $insert_formaciones_academicas[] = [
                        'nivel_educativo'     => $item['nivel_educativo'],
                        'grado_academico'     => $item['grado_academico'],
                        'universidad'         => $item['universidad'],
                        'carrera_profesional' => $item['carrera_profesional'],
                        'registro_titulo'     => $item['registro_titulo'],
                        'rd_titulo'           => $item['rd_titulo'],
                        'obtencion_grado'     => $item['obtencion_grado']
                    ];
                }  
            }

            if (count($experiencias_laborales) > 0) {
                foreach ($experiencias_laborales as $key => $item) {
                    $insert_experiencias_laborales[] = [
                        'institucion_educativa' => $item['institucion_educativa'],
                        'sector'                => $item['sector'],
                        'puesto'                => $item['puesto'],
                        'numero_rd'             => $item['numero_rd'],
                        'numero_contrato'       => $item['numero_contrato']
                    ];
                }  
            }

            $insert_archivos = [];
            if (isset($_FILES['archivos'])) {
                $total  = count($_FILES['archivos']['name']);
                $files  = array();
                if ($total) {
                    $path = __DIR__."/../../public/uploads/";
                    if (!is_dir($path)) {
                        mkdir($path, 0777,true);
                    }
                    $fields = ["name", "type", "tmp_name", "error", "size"];
                    $uploads = $_FILES['archivos'];
                    $result = array();
                    for ($index=0; $index < $total; $index++) {
                        array_push($files, $this->tools->getFieldArray($uploads, $fields, $index));
                    }
                    foreach ($files as $key => $item) {

                        if ($item['error'] == UPLOAD_ERR_OK) {
                            $filename = uniqid(time())."-".$item['name'];
                            $fullpath = $path.$filename;
                            $filepath = "/uploads/".$filename;
                            $extension = strtolower(pathinfo($item['name'], PATHINFO_EXTENSION));
                            move_uploaded_file($item['tmp_name'], $fullpath);
                            $insert_archivos[] = [
                                'nombre'  => $item['name'], 
                                'url'     => $filepath, 
                                'formato' => $extension, 
                                'peso'    => $item['size'], 
                            ];
                        }
                    }
                }
            }

            $data['nombre']           = $nombre;
            $data['apellido_paterno'] = $apellido_paterno;
            $data['apellido_materno'] = $apellido_materno;
            $data['numero_documento'] = $numero_documento;
            $data['tipo_documento']   = $tipo_documento;
            $data['genero']           = $genero;
            $data['estado_civil']     = $estado_civil;
            $data['nacionalidad']     = $nacionalidad;
            $data['fecha_nacimiento'] = $fecha_nacimiento;
            $data['correo']           = $correo;
            $data['numero_celular']   = $numero_celular;
            $data['numero_telefono']  = $numero_telefono;
            $data['via']              = $via;
            $data['nombre_via']       = $nombre_via;            
            $data['zona']             = $zona;
            $data['direccion']        = $direccion;
            $data['fecha_registro']   = $this->tools->getDateHour();
            $data['distrito_id']      = $distrito_id;
            $data['especialidad_id']  = $especialidad_id;
            $data['convocatoria_id']  = $convocatoria_id;

            $this->db->insert('postulaciones', $data);
            $postulacion_id = $this->db->insert_id();

            $uid = strtolower(uniqid().$postulacion_id);
            $this->db->update('postulaciones', ['uid'=>$uid], array('id' => $postulacion_id));

            if (count($insert_especializaciones) > 0) {
                foreach ($insert_especializaciones as $key => $item) {
                    $insert_especializaciones[$key]['postulacion_id'] = $postulacion_id;
                }
                $this->db->insert_batch('postulacion_especializaciones', $insert_especializaciones);
            }

            if (count($insert_formaciones_academicas) > 0) {
                foreach ($insert_formaciones_academicas as $key => $item) {
                    $insert_formaciones_academicas[$key]['postulacion_id'] = $postulacion_id;
                }
                $this->db->insert_batch('postulacion_formaciones_academicas', $insert_formaciones_academicas);
            }

            if (count($insert_experiencias_laborales) > 0) {
                foreach ($insert_experiencias_laborales as $key => $item) {
                    $insert_experiencias_laborales[$key]['postulacion_id'] = $postulacion_id;
                }
                $this->db->insert_batch('postulacion_experiencias_laborales', $insert_experiencias_laborales);
            }

            if (count($insert_archivos) > 0) {
                foreach ($insert_archivos as $key => $item) {
                    $insert_archivos[$key]['tipo_id']        = $tipo_archivos[$key];
                    $insert_archivos[$key]['postulacion_id'] = $postulacion_id;
                }
                $this->db->insert_batch('postulacion_archivos', $insert_archivos);
            }

            if ($data['correo']) {
                $receivers = array();
                $subtitle = 'SE ACABA DE REGISTRAR MANERA EXITOSA';
                array_push($receivers, $data['correo']);
                $url = '/postulaciones/'. '1';
                $message ="a";
                $subject="prueba";
                $result = $this->email_model->mail(compact('receivers', 'message', 'subject'));
            }
            
            $sql = "SELECT
                        P.id,
                        P.uid,
                        P.fecha_registro
                    FROM postulaciones AS P
                    WHERE P.deleted_at IS NULL
                    AND P.id = ?";
            $postulante = $this->db->query($sql, compact('postulacion_id'))->row();
            
            $rsp['success'] = true;
            $rsp['data'] = compact('postulante');
            $rsp['message'] = 'Se registro correctamente';

        } catch (\Exception $e) {
            $rsp['message'] = $e->getMessage();
        }
        return $rsp;
    }

    public function find() {
      $response = $this->tools->responseDefault();
      try {
        
        $documento       = isset($_POST['documento'])       ? $_POST['documento']       : 0;
        $convocatoria_id = isset($_POST['convocatoria_id']) ? $_POST['convocatoria_id'] : 0;

        $sql = "SELECT 
                    C.*
                FROM convocatorias AS C
                WHERE C.con_estado = 1
                AND C.con_id = ?";
        $convocatoria = $this->db->query($sql, compact('convocatoria_id'))->row();
        if (!$convocatoria) {
            throw new Exception("No se encontro la convocatoria");
        }

        $convocatoria->con_type_postulacion = 2; // PUN
        if ($convocatoria->con_id == 7) {
          $convocatoria->con_type_postulacion = 1;
        }

        $postulante = NULL;
        if ($convocatoria->con_type_postulacion == 2) { // PUN
            $sql = "SELECT 
                        CPE.*,
                        ESP.esp_id AS especialidad_id,
                        ESP.esp_descripcion AS especialidad_descripcion,
                        NIV.niv_id AS nivel_id,
                        NIV.niv_descripcion AS nivel_descripcion,
                        MDD.mod_id AS modalidad_id,
                        MDD.mod_nombre AS modalidad_descripcion
                    FROM cuadro_pun_exp AS CPE 
                    INNER JOIN grupo_inscripcion AS GIN ON CPE.grupo_inscripcion_gin_id = GIN.gin_id
                    INNER JOIN especialidades AS ESP ON ESP.esp_id = GIN.especialidades_esp_id
                    INNER JOIN niveles AS NIV ON NIV.niv_id = ESP.niveles_niv_id
                    INNER JOIN modalidades AS MDD ON MDD.mod_id = NIV.modalidad_mod_id
                    WHERE CPE.cpe_estado = 1 
                    AND CPE.cpe_documento = ?";
            $postulante = $this->db->query($sql, compact('documento'))->row();

            if (!$postulante) {
                throw new Exception("No se encontro el postulante");
            }
        }

        $sql = "SELECT 
                  P.*
                FROM postulaciones AS P 
                WHERE P.deleted_at IS NULL 
                AND P.numero_documento = ?
                AND P.convocatoria_id = ?";
        $postulacion = $this->db->query($sql, compact('documento', 'convocatoria_id'))->row();

        if ($postulacion) {
            throw new Exception("Ya se encuentra registrado en está convocatoria");
        }

        $response['success'] = true;
        $response['data']  = compact('postulante');
        $response['status']  = 200;
        $response['message'] = 'showPostulant';

      } catch (\Exception $e) {
          $response['message'] = $e->getMessage();
      }
      return $response; 
    }

    public function edit($args) {
        $response = $this->tools->responseDefault();
        try {
  
            $uid = isset($args['uid']) ? $args['uid'] : 0;
    
            $sql = "SELECT * FROM postulaciones WHERE deleted_at IS NULL AND uid = ?";
            $postulante = $this->db->query($sql, compact('uid'))->row();
    
            if (!$postulante) {
                show_404();
            }

            $convocatoria_id = $postulante->convocatoria_id;
            $postulacion_id = $postulante->id;

            $sql = "SELECT * FROM convocatorias WHERE con_estado = 1 AND con_id = ?";
            $convocatoria = $this->db->query($sql, compact('convocatoria_id'))->row();
            if (!$convocatoria) {
                show_404();
            }

            $sql = "SELECT * FROM postulacion_especializaciones WHERE postulacion_id = ?";
            $postulacion_especializaciones = $this->db->query($sql, compact('postulacion_id'))->result_object();
            
            $sql = "SELECT * FROM postulacion_formaciones_academicas WHERE postulacion_id = ?";
            $postulacion_formaciones_academicas = $this->db->query($sql, compact('postulacion_id'))->result_object();
    
            $sql = "SELECT * FROM postulacion_experiencias_laborales WHERE postulacion_id = ?";
            $postulacion_experiencias_laborales = $this->db->query($sql, compact('postulacion_id'))->result_object();

            $sql = "SELECT * FROM postulacion_archivos WHERE postulacion_id = ?";
            $postulacion_archivos = $this->db->query($sql, compact('postulacion_id'))->result_object();

            /*$now_unix = strtotime($this->tools->getDateHour());
            $con_fechainicio_unix = strtotime($convocatoria->con_fechainicio);
            $con_fechafin_unix = strtotime($convocatoria->con_fechafin);
            
            if (!($now_unix >= $con_fechainicio_unix  
                && $now_unix <= $con_fechafin_unix)) {
                show_404();
            }*/
    
            $convocatoria->con_type_postulacion = 2; // PUN
            if ($convocatoria->con_id == 7) {
                $convocatoria->con_type_postulacion = 1;
            }
    
            $response['success'] = true;
            $response['data']  = compact('convocatoria', 'uid', 'postulante', 'postulacion_archivos', 'postulacion_experiencias_laborales', 'postulacion_formaciones_academicas', 'postulacion_especializaciones');
            $response['status']  = 200;
            $response['message'] = 'show';
  
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
        }
        return $response;
      }

      public function update($args) {
        $response = $this->tools->responseDefault();
        try {
  
            $uid = isset($args['uid']) ? $args['uid'] : 0;
    
            $sql = "SELECT * FROM postulaciones WHERE deleted_at IS NULL AND uid = ?";
            $postulacion = $this->db->query($sql, compact('uid'))->row();
    
            if (!$postulacion) {
                throw new Exception("No se encontro el registro");
            }

            $convocatoria_id = $postulacion->convocatoria_id;
            $postulacion_id = $postulacion->id;

            $sql = "SELECT * FROM convocatorias WHERE con_estado = 1 AND con_id = ?";
            $convocatoria = $this->db->query($sql, compact('convocatoria_id'))->row();
            if (!$convocatoria) {
                throw new Exception("No se encontro la convocatoria");
            }

            $any = isset($_POST['any']) ? $_POST['any'] : '';
            switch ($any) {
                case 'archivos_adjuntos_guardar':
                    if (isset($_FILES['archivo'])) {
                        $path = __DIR__."/../../public/uploads/";
                        if (!is_dir($path)) {
                            mkdir($path, 0777,true);
                        }
                        $file = $_FILES['archivo'];
                        if ($file['error'] == UPLOAD_ERR_OK) {
                            $filename = uniqid(time())."-".$file['name'];
                            $fullpath = $path.$filename;
                            $filepath = "/uploads/".$filename;
                            $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                            move_uploaded_file($file['tmp_name'], $fullpath);
                            $data = [
                                'nombre'  => $file['name'], 
                                'url'     => $filepath, 
                                'formato' => $extension, 
                                'peso'    => $file['size'],
                                'tipo_id' => $_POST['tipo'],
                                'postulacion_id' => $postulacion_id 
                            ];
                            $this->db->insert('postulacion_archivos', $data);
                        }
                    }
                break;
                default:
                    # code...
                    break;
            }
    
            $response['success'] = true;
            $response['status']  = 200;
            $response['message'] = 'Se guardo correctamente';
  
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
        }
        return $response;
      }
}