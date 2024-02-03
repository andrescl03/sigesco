<?php
class Postulaciones_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('tools');
        $this->load->model('email_model');
        $this->load->model("convocatorias_web_model");
        $this->load->library('mesaparteservice');
    }

    public function store()
    {
        $response = $this->tools->responseDefault();
        try {

            $this->load->library('form_validation');
            $this->form_validation->set_rules('nombre', 'nombre', 'trim|required|min_length[3]|max_length[100]');
            $this->form_validation->set_rules('apellido_paterno', 'apellido_paterno', 'trim|required|min_length[3]|max_length[100]');
            $this->form_validation->set_rules('apellido_materno', 'apellido_materno', 'trim|required|min_length[3]|max_length[100]');
            $this->form_validation->set_rules('direccion', 'direccion', 'trim|required|min_length[3]|max_length[100]');
            $this->form_validation->set_rules('correo', 'correo', 'trim|required|valid_email');
            $this->form_validation->set_rules('confirma_correo', 'confirma_correo', 'trim|required|valid_email');
            $this->form_validation->set_rules('distrito_id', 'distrito_id', 'trim|required');
            $this->form_validation->set_rules('estado_civil', 'estado_civil', 'trim|required');
            $this->form_validation->set_rules('fecha_nacimiento', 'fecha_nacimiento', 'trim|required');
            $this->form_validation->set_rules('genero', 'genero', 'trim|required');
            $this->form_validation->set_rules('nacionalidad', 'nacionalidad', 'trim|required');
            $this->form_validation->set_rules('nombre_via', 'nombre_via', 'trim|required');
            $this->form_validation->set_rules('numero_celular', 'numero_celular', 'trim|required');
            $this->form_validation->set_rules('numero_documento', 'numero_documento', 'trim|required');
            $this->form_validation->set_rules('tipo_documento', 'tipo_documento', 'trim|required');
            $this->form_validation->set_rules('numero_telefono', 'numero_telefono', 'trim|required');
            $this->form_validation->set_rules('via_id', 'via_id', 'trim|required');
            $this->form_validation->set_rules('zona_id', 'zona_id', 'trim|required');
            $this->form_validation->set_rules('convocatoria_id', 'convocatoria_id', 'trim|required');
            $this->form_validation->set_rules('inscripcion_id', 'inscripcion_id', 'trim|required');
            $this->form_validation->set_rules('cuss', 'cuss', 'trim');
            $this->form_validation->set_rules('afiliacion', 'afiliacion', 'trim');

            if ($this->form_validation->run() == FALSE) {
                $response['errors'] = $this->form_validation->error_array();
                log_message_ci("Ingresa a registrar expediente " . json_encode($this->form_validation->error_array()));

                throw new Exception("No cumple con los datos requeridos          => " . json_encode($response['errors']));
            }

            $apellido_materno = $this->input->post("apellido_materno", true);
            $apellido_paterno = $this->input->post("apellido_paterno", true);
            $nombre           = $this->input->post("nombre", true);
            $correo           = $this->input->post("correo", true);
            $confirma_correo  = $this->input->post("confirma_correo", true);
            $direccion        = $this->input->post("direccion", true);
            $distrito_id      = $this->input->post("distrito_id", true);
            $provincia_id     = $this->input->post("provincia_id", true);
            $departamento_id  = $this->input->post("departamento_id", true);
            $estado_civil     = $this->input->post("estado_civil", true);
            $fecha_nacimiento = $this->input->post("fecha_nacimiento", true);
            $genero           = $this->input->post("genero", true);
            $afiliacion       = $this->input->post("afiliacion", true);
            $cuss             = $this->input->post("cuss", true);
            $modalidad        = $this->input->post("modalidad", true);
            $nacionalidad     = $this->input->post("nacionalidad", true);
            $nombre_via       = $this->input->post("nombre_via", true);
            $numero_celular   = $this->input->post("numero_celular", true);
            $numero_documento = $this->input->post("numero_documento", true);
            $tipo_documento   = $this->input->post("tipo_documento", true);
            $numero_telefono  = $this->input->post("numero_telefono", true);
            $via              = $this->input->post("via", true);
            $zona             = $this->input->post("zona", true);
            $nombre_zona      = $this->input->post("nombre_zona", true);
            $via_id           = $this->input->post("via_id", true);
            $zona_id          = $this->input->post("zona_id", true);
            $convocatoria_id  = $this->input->post("convocatoria_id", true);
            $inscripcion_id   = $this->input->post("inscripcion_id", true);

            $tipo_archivos          = isset($_POST['tipo_archivos'])          ? $_POST['tipo_archivos']                             : [];
            $especializaciones      = isset($_POST['especializaciones'])      ? json_decode($_POST['especializaciones'], true)      : [];
            $formaciones_academicas = isset($_POST['formaciones_academicas']) ? json_decode($_POST['formaciones_academicas'], true) : [];
            $experiencias_laborales = isset($_POST['experiencias_laborales']) ? json_decode($_POST['experiencias_laborales'], true) : [];

            $insert_especializaciones      = [];
            $insert_formaciones_academicas = [];
            $insert_experiencias_laborales = [];

            if ($correo != $confirma_correo) {
                throw new Exception("El campo confirmar correo debe ser igual al correo de origen");
            }

            if (!isset($_FILES['archivos'])) {
                throw new Exception('Debe de adjuntar al menos un documento');
            }
            $total  = count($_FILES['archivos']['name']);
            if ($total == 0) {
                throw new Exception('Debe de adjuntar al menos un documento');
            }
            if (count($tipo_archivos) == 0) {
                throw new Exception('Debe de adjuntar al menos un documento');
            }

            $result = $this->convocatorias_web_model->show(compact('convocatoria_id', 'inscripcion_id'));
            if (!$result['success']) {
                throw new Exception($result['message']);
            }
            $convocatoria = $result['data']['convocatoria'];

            $result = $this->find(['documento' => $numero_documento, 'convocatoria_id' => $convocatoria_id, 'inscripcion_id' => $inscripcion_id]);
            if (!$result['success']) {
                throw new Exception($result['message']);
            }

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
                        'tipoestudio_educativo'     => $item['tipoestudio_educativo'], // String
                        'estadoestudio_educativo'   => $item['estadoestudio_educativo'], // String
                        'grado_academico'     => $item['grado_academico'],
                        'subnivel'                  => $item['subnivel'], // String
                        'mencion_academico'         => $item['mencion_academico'], // String
                        'mencion_grado_academico'   => $item['mencion_grado_academico'], // String
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
                        'fechainicio_rd'        => $item['fechainicio_rd'], // Date
                        'fechatermino_rd'       => $item['fechatermino_rd'], // Date
                        'cantidad_mesesrd'      => $item['cantidad_mesesrd'], // Int
                        'numero_contrato'       => $item['numero_contrato']
                    ];
                }
            }

            $sql = "SELECT * FROM tipo_archivos WHERE deleted_at IS NULL ORDER BY orden ASC";
            $my_tipo_archivos = $this->db->query($sql)->result_object();

            $keys_uploads_tipo_archivos = [];
            foreach ($tipo_archivos as $k2 => $o2) {
                $keys_uploads_tipo_archivos[$o2] = $o2;
            }

            $keys_tipos_archivos = [];
            foreach ($my_tipo_archivos as $k => $o) {
                if ($o->requerido == 1) {
                    $meet = false;
                    if (isset($keys_uploads_tipo_archivos[$o->id])) {
                        $meet = true;
                    }
                    if (!$meet) {
                        throw new Exception('El documento ' . $o->nombre . ' es obligatorio');
                    }
                }
                $keys_tipos_archivos[$o->id] = $o;
            }

            //$zipData = null;
            $zipPath = null;
            $insert_archivos = [];
            if (isset($_FILES['archivos'])) {
                $total  = count($_FILES['archivos']['name']);
                $files  = array();
                if ($total) {
                    $path = __DIR__ . "/../../public/uploads/";
                    if (!is_dir($path)) {
                        mkdir($path, 0777, true);
                    }
                    $fields = ["name", "type", "tmp_name", "error", "size"];
                    $uploads = $_FILES['archivos'];
                    $result = array();
                    for ($index = 0; $index < $total; $index++) {
                        array_push($files, $this->tools->getFieldArray($uploads, $fields, $index));
                    }
                    foreach ($files as $key => $item) {

                        if ($item['error'] == UPLOAD_ERR_OK) {
                            $filename = uniqid(time()) . "-" . $item['name'];
                            $fullpath = $path . $filename;
                            $filepath = "/uploads/" . $filename;
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

                if (count($insert_archivos) > 0) {
                    // Create a temporary directory to store the uploaded files
                    $tempDir = __DIR__ . "/../../public/uploads/";
                    if (!is_dir($tempDir)) {
                        mkdir($tempDir, 0777, true);
                    }
                    // Create a unique ZIP file name
                    $zipFilename = uniqid(time()) . "-uploaded-files.zip";
                    $zipPath = $tempDir . $zipFilename;
                }
                // Create a ZipArchive object
                $zip = new ZipArchive();
                if ($zip->open($zipPath, ZipArchive::CREATE) !== true) {
                    throw new Exception('Failed to create ZIP file');
                }
    
                // Add each uploaded file to the ZIP archive
                foreach ($insert_archivos as $file) {
                    $filePath = __DIR__ . "/../../public" . $file['url']; // Assuming the files are in the "uploads" directory
                    $zip->addFile($filePath, $file['nombre']);
                }
    
                $zip->close();
                $zipData = file_get_contents($zipPath);
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
            $data['via_id']           = $via_id;
            $data['via']              = $via;
            $data['nombre_via']       = $nombre_via;
            $data['zona_id']          = $zona_id;
            $data['zona']             = $zona;
            $data['nombre_zona']      = $nombre_zona;
            $data['direccion']        = $direccion;
            $data['afiliacion']       = $afiliacion;
            $data['cuss']             = $cuss;            
            $data['fecha_registro']   = $this->tools->getDateHour();
            $data['departamento']     = $departamento_id;
            $data['provincia']        = $provincia_id;
            $data['distrito']         = $distrito_id;
            $data['convocatoria_id']  = $convocatoria_id;
            $data['inscripcion_id']   = $inscripcion_id;

            $this->db->insert('postulaciones', $data);
            $postulacion_id = $this->db->insert_id();

            
            $uid = strtolower(uniqid() . $postulacion_id);
            $this->db->update('postulaciones', ['uid' => $uid], array('id' => $postulacion_id));
            
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
            $requisitos = [];
            if (count($insert_archivos) > 0) {
                foreach ($insert_archivos as $key => $item) {
                    $insert_archivos[$key]['tipo_id']        = $tipo_archivos[$key];
                    $insert_archivos[$key]['postulacion_id'] = $postulacion_id;
                    $requisitos[] = $keys_tipos_archivos[$insert_archivos[$key]['tipo_id']]->nombre;
                }
                $this->db->insert_batch('postulacion_archivos', $insert_archivos);
            }
            $sql = "SELECT
                        P.*
                    FROM postulaciones AS P
                    WHERE P.deleted_at IS NULL
                    AND P.id = ?";
            $postulante = $this->db->query($sql, compact('postulacion_id'))->row();

            $sql = "SELECT
                        P.*
                    FROM postulacion_archivos AS P
                    WHERE P.deleted_at IS NULL
                    AND P.postulacion_id = ?";

            $archivos = $this->db->query($sql, compact('postulacion_id'))->result_object();

            /*if ($data['correo']) {
                $receivers = array();
                $subtitle = 'SE ACABA DE REGISTRAR MANERA EXITOSA';
                array_push($receivers, $data['correo']);
                $message = $this->messageMail($uid, $postulante);
                $subject = "prueba";
                $result = $this->email_model->mail(compact('receivers', 'message', 'subject'));
            }*/

            /** CREACION DEL REGISTRO EN MESA DE PARTE */
            if ($convocatoria->con_tipo == 1) { // PUN
                $ResumenPedido         = "PROCESO DE CONTRATACION DOCENTE 2024-EVALUACION POR RESULTADOS (PN) " . $this->tools->getDateHour("Y");
                $ResumenPedidoID       = 731;
                $trcID                 = 347;
            } else {
                $ResumenPedido         = "COMITE DE CONTRATO DOCENTE (EVALUACION EXPEDIENTE) " . $this->tools->getDateHour("Y");
                $ResumenPedidoID       = 731;
                $trcID                 = 347;
            }
            
            $data = [   
                "TipoEnvio"             => "api",
                "TipoDocumentoID"       => $tipo_documento == 1 ? "2101" : "2202",
                "TipoDocumento"         => $tipo_documento == 1 ? "DNI" : "C.E",
                "NumeroDocumento"       => $numero_documento,
                "Apellidos"             => strtoupper($apellido_paterno . " " . $apellido_materno),
                "Nombres"               => strtoupper($nombre),
                "TipoViaID"             => $via_id,
                "TipoVia"               => strtoupper($via),
                "NombreVia"             => strtoupper($nombre_via),
                "TipoZonaID"            => $zona_id,
                "TipoZona"              => strtoupper($zona),
                "NombreZona"            => strtoupper($zona),
                "Referencia"            => strtoupper($direccion),
                "Departamento"          => strtoupper($departamento_id),
                "Provincia"             => strtoupper($provincia_id),
                "Distrito"              => strtoupper($distrito_id),
                "Telefono"              => $numero_telefono,
                "CorreoElectronico"     => $correo,
            
                "ResumenPedido"         => $ResumenPedido,
                "ResumenPedidoID"       => $ResumenPedidoID,
                "trcID"                 => $trcID,
                "ADetallePedido"        => "CONTRATO DOCENTE " . $this->tools->getDateHour("Y") . " - " . strtoupper($apellido_paterno . " " . $apellido_materno),
                "TipoUsuarioID"         => 3,
                "TipoUsuario"           => "DOCENTE",
                "AFundamentacionPedido" => strtoupper("convocatorias para el proceso de contratación docente - " . $this->tools->getDateHour("Y")),
                "fechaInicio"           => "",
                "fechaFin"              => "",
                "requisitos"            => strtoupper(implode(",", $requisitos)),
                "Archivo"               => new CURLFile($zipPath)           
            ];
            log_message_ci("Ingresa a registrar expediente 2 " . json_encode($data));

            $result = $this->mesaparteservice->request('POST', 'mpv/tramites/registrar', $data,  $this->mesaparteservice->token(), true);
            if ($result['status'] == 200) {
                $this->db->update('postulaciones', ['uid' => $result['response']['CodigoTramite']], array('id' => $postulacion_id));
            }

            log_message_ci("Ingresa a registrar expediente 3 " . json_encode($result));

            $response['success'] = true;
            $response['data'] = compact('postulante', 'archivos');
            $response['message'] = 'Se registro correctamente';
        } catch (\Exception $e) {
            log_message_ci("Error al registrar expediente " . json_encode($e->getMessage()));

            $response['message'] = $e->getMessage();
        }
        return $response;
    }

    public function find($request)
    {
        $response = $this->tools->responseDefault();
        try {

            $documento       = isset($request['documento'])       ? $request['documento']       : 0;
            $convocatoria_id = isset($request['convocatoria_id']) ? $request['convocatoria_id'] : 0;
            $inscripcion_id  = isset($request['inscripcion_id'])  ? $request['inscripcion_id']  : 0;

            if (!$documento) {
                throw new Exception("El campo documento es requerido");
            }

            $result = $this->convocatorias_web_model->show(compact('convocatoria_id', 'inscripcion_id'));
            if (!$result['success']) {
                throw new Exception($result['message']);
            }

            $convocatoria = $result['data']['convocatoria'];
            $postulante = NULL;

            if ($convocatoria->con_tipo == 1) { // PUN
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
                    AND CPE.cpe_tipoCuadro = 1 
                    AND CPE.cpe_documento = ?
                    AND grupo_inscripcion_gin_id = ?";
                $postulante = $this->db->query($sql, compact('documento', 'inscripcion_id'))->row();

                if (!$postulante) {
                    throw new Exception("No se encontró el postulante en los registro de la PUN o no pertence a la modalidad/nivel/especialidad a la que postula");
                }
            }

            $sql = "SELECT 
                  P.*
                FROM postulaciones AS P 
                WHERE P.deleted_at IS NULL 
                AND P.numero_documento = ?
                AND P.convocatoria_id = ?
                AND P.inscripcion_id = ?";
            $postulacion = $this->db->query($sql, compact('documento', 'convocatoria_id', 'inscripcion_id'))->row();

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

    public function edit($args)
    {
        $response = $this->tools->responseDefault();
        try {

            $id = isset($args['id']) ? $args['id'] : 0;

            $sql = "SELECT * FROM postulaciones WHERE deleted_at IS NULL AND id = ?";
            $postulante = $this->db->query($sql, compact('id'))->row();

            if (!$postulante) {
                show_404();
            }

            $convocatoria_id = $postulante->convocatoria_id;
            $postulacion_id = $postulante->id;
            $inscripcion_id =  $postulante->inscripcion_id;

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

            $convocatoria = $this->db->query($sql, compact('convocatoria_id', 'inscripcion_id'))->row();
            if (!$convocatoria) {
                show_404();
            }

            $response['success'] = true;
            $response['data']  = compact('convocatoria','postulante');
            $response['status']  = 200;
            $response['message'] = 'edit';
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
        }
        return $response;
    }

    public function detail($args)
    {
        $response = $this->tools->responseDefault();
        try {

            $id = isset($args['id']) ? $args['id'] : 0;

            $sql = "SELECT * FROM postulaciones WHERE deleted_at IS NULL AND id = ?";
            $postulante = $this->db->query($sql, compact('id'))->row();

            if (!$postulante) {
                show_404();
            }

            $convocatoria_id = $postulante->convocatoria_id;
            $postulacion_id = $postulante->id;
            $inscripcion_id =  $postulante->inscripcion_id;

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

            $convocatoria = $this->db->query($sql, compact('convocatoria_id', 'inscripcion_id'))->row();
            if (!$convocatoria) {
                show_404();
            }

            $sql = "SELECT * FROM postulacion_especializaciones WHERE deleted_at IS NULL AND postulacion_id = ?";
            $postulacion_especializaciones = $this->db->query($sql, compact('postulacion_id'))->result_object();

            $sql = "SELECT * FROM postulacion_formaciones_academicas WHERE deleted_at IS NULL AND postulacion_id = ?";
            $postulacion_formaciones_academicas = $this->db->query($sql, compact('postulacion_id'))->result_object();

            $sql = "SELECT * FROM postulacion_experiencias_laborales WHERE deleted_at IS NULL AND postulacion_id = ?";
            $postulacion_experiencias_laborales = $this->db->query($sql, compact('postulacion_id'))->result_object();

            $sql = "SELECT PA.*, TA.nombre AS tipo_nombre FROM postulacion_archivos PA INNER JOIN tipo_archivos TA ON PA.tipo_id = TA.id WHERE PA.deleted_at IS NULL AND PA.postulacion_id = ?";
            $postulacion_archivos = $this->db->query($sql, compact('postulacion_id'))->result_object();

            $sql = "SELECT * FROM tipo_archivos WHERE deleted_at IS NULL ORDER BY orden ASC";
            $tipo_archivos = $this->db->query($sql)->result_object();

            $response['success'] = true;
            $response['data']  = compact('convocatoria', 'uid', 'postulante', 'postulacion_archivos', 'postulacion_experiencias_laborales', 'postulacion_formaciones_academicas', 'postulacion_especializaciones', 'tipo_archivos');
            $response['status']  = 200;
            $response['message'] = 'edit';
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
        }
        return $response;
    }

    public function show($args)
    {
        $response = $this->tools->responseDefault();
        try {

            $id = isset($args['id']) ? $args['id'] : 0;

            $sql = "SELECT * FROM postulaciones WHERE deleted_at IS NULL AND id = ?";
            $postulante = $this->db->query($sql, compact('id'))->row();

            if (!$postulante) {
                show_404();
            }

            $convocatoria_id = $postulante->convocatoria_id;
            $postulacion_id = $postulante->id;

            $sql = "SELECT * FROM convocatorias WHERE con_id = ?";
            $convocatoria = $this->db->query($sql, compact('convocatoria_id'))->row();
            if (!$convocatoria) {
                show_404();
            }

            $sql = "SELECT * FROM postulacion_especializaciones WHERE deleted_at IS NULL AND postulacion_id = ?";
            $postulacion_especializaciones = $this->db->query($sql, compact('postulacion_id'))->result_object();

            $sql = "SELECT * FROM postulacion_formaciones_academicas WHERE deleted_at IS NULL AND postulacion_id = ?";
            $postulacion_formaciones_academicas = $this->db->query($sql, compact('postulacion_id'))->result_object();

            $sql = "SELECT * FROM postulacion_experiencias_laborales WHERE deleted_at IS NULL AND postulacion_id = ?";
            $postulacion_experiencias_laborales = $this->db->query($sql, compact('postulacion_id'))->result_object();

            $sql = "SELECT * FROM postulacion_archivos WHERE deleted_at IS NULL AND postulacion_id = ?";
            $postulacion_archivos = $this->db->query($sql, compact('postulacion_id'))->result_object();

            /*$now_unix = strtotime($this->tools->getDateHour());
            $con_fechainicio_unix = strtotime($convocatoria->con_fechainicio);
            $con_fechafin_unix = strtotime($convocatoria->con_fechafin);
            
            if (!($now_unix >= $con_fechainicio_unix  
                && $now_unix <= $con_fechafin_unix)) {
                show_404();
            }*/

            // $convocatoria->con_type_postulacion = $convocatoria->con_tipo;

            $response['success'] = true;
            $response['data']  = compact('convocatoria', 'uid', 'postulante', 'postulacion_archivos', 'postulacion_experiencias_laborales', 'postulacion_formaciones_academicas', 'postulacion_especializaciones');
            $response['status']  = 200;
            $response['message'] = 'show';
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
        }
        return $response;
    }

    public function update($args)
    {
        $response = $this->tools->responseDefault();
        try {
            $postulacion_id = $args['id'];
            $this->load->library('form_validation');
            $this->form_validation->set_rules('nombre', 'nombre', 'trim|required|min_length[3]|max_length[100]');
            $this->form_validation->set_rules('apellido_paterno', 'apellido_paterno', 'trim|required|min_length[3]|max_length[100]');
            $this->form_validation->set_rules('apellido_materno', 'apellido_materno', 'trim|required|min_length[3]|max_length[100]');
            $this->form_validation->set_rules('direccion', 'direccion', 'trim|required|min_length[3]|max_length[100]');
            $this->form_validation->set_rules('correo', 'correo', 'trim|required|valid_email');
            $this->form_validation->set_rules('confirma_correo', 'confirma_correo', 'trim|required|valid_email');
            $this->form_validation->set_rules('distrito_id', 'distrito_id', 'trim|required');
            $this->form_validation->set_rules('estado_civil', 'estado_civil', 'trim|required');
            $this->form_validation->set_rules('fecha_nacimiento', 'fecha_nacimiento', 'trim|required');
            $this->form_validation->set_rules('genero', 'genero', 'trim|required');
            $this->form_validation->set_rules('nacionalidad', 'nacionalidad', 'trim|required');
            $this->form_validation->set_rules('nombre_via', 'nombre_via', 'trim|required');
            $this->form_validation->set_rules('numero_celular', 'numero_celular', 'trim|required');
            // $this->form_validation->set_rules('numero_documento', 'numero_documento', 'trim|required');
            // $this->form_validation->set_rules('tipo_documento', 'tipo_documento', 'trim|required');
            $this->form_validation->set_rules('numero_telefono', 'numero_telefono', 'trim|required');
            $this->form_validation->set_rules('via_id', 'via_id', 'trim|required');
            $this->form_validation->set_rules('zona_id', 'zona_id', 'trim|required');
            // $this->form_validation->set_rules('convocatoria_id', 'convocatoria_id', 'trim|required');
            // $this->form_validation->set_rules('inscripcion_id', 'inscripcion_id', 'trim|required');
            $this->form_validation->set_rules('cuss', 'cuss', 'trim');
            $this->form_validation->set_rules('afiliacion', 'afiliacion', 'trim');

            if ($this->form_validation->run() == FALSE) {
                $response['errors'] = $this->form_validation->error_array();
                log_message_ci("Ingresa a registrar expediente " . json_encode($this->form_validation->error_array()));

                throw new Exception("No cumple con los datos requeridos          => " . json_encode($response['errors']));
            }

            $apellido_materno = $this->input->post("apellido_materno", true);
            $apellido_paterno = $this->input->post("apellido_paterno", true);
            $nombre           = $this->input->post("nombre", true);
            $correo           = $this->input->post("correo", true);
            $confirma_correo  = $this->input->post("confirma_correo", true);
            $direccion        = $this->input->post("direccion", true);
            $distrito_id      = $this->input->post("distrito_id", true);
            $provincia_id     = $this->input->post("provincia_id", true);
            $departamento_id  = $this->input->post("departamento_id", true);
            $estado_civil     = $this->input->post("estado_civil", true);
            $fecha_nacimiento = $this->input->post("fecha_nacimiento", true);
            $genero           = $this->input->post("genero", true);
            $afiliacion       = $this->input->post("afiliacion", true);
            $cuss             = $this->input->post("cuss", true);
            $modalidad        = $this->input->post("modalidad", true);
            $nacionalidad     = $this->input->post("nacionalidad", true);
            $nombre_via       = $this->input->post("nombre_via", true);
            $numero_celular   = $this->input->post("numero_celular", true);
            $numero_documento = $this->input->post("numero_documento", true);
            $tipo_documento   = $this->input->post("tipo_documento", true);
            $numero_telefono  = $this->input->post("numero_telefono", true);
            $via              = $this->input->post("via", true);
            $zona             = $this->input->post("zona", true);
            $nombre_zona      = $this->input->post("nombre_zona", true);
            $via_id           = $this->input->post("via_id", true);
            $zona_id          = $this->input->post("zona_id", true);
            // $convocatoria_id  = $this->input->post("convocatoria_id", true);
            // $inscripcion_id   = $this->input->post("inscripcion_id", true);

            $tipo_archivos          = isset($_POST['tipo_archivos'])          ? $_POST['tipo_archivos']                             : [];
            $especializaciones      = isset($_POST['especializaciones'])      ? json_decode($_POST['especializaciones'], true)      : [];
            $formaciones_academicas = isset($_POST['formaciones_academicas']) ? json_decode($_POST['formaciones_academicas'], true) : [];
            $experiencias_laborales = isset($_POST['experiencias_laborales']) ? json_decode($_POST['experiencias_laborales'], true) : [];

            $insert_especializaciones      = [];
            $insert_formaciones_academicas = [];
            $insert_experiencias_laborales = [];

            if ($correo != $confirma_correo) {
                throw new Exception("El campo confirmar correo debe ser igual al correo de origen");
            }

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
                        'tipoestudio_educativo'     => $item['tipoestudio_educativo'], // String
                        'estadoestudio_educativo'   => $item['estadoestudio_educativo'], // String
                        'grado_academico'     => $item['grado_academico'],
                        'subnivel'                  => $item['subnivel'], // String
                        'mencion_academico'         => $item['mencion_academico'], // String
                        'mencion_grado_academico'   => $item['mencion_grado_academico'], // String
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
                        'fechainicio_rd'        => $item['fechainicio_rd'], // Date
                        'fechatermino_rd'       => $item['fechatermino_rd'], // Date
                        'cantidad_mesesrd'      => $item['cantidad_mesesrd'], // Int
                        'numero_contrato'       => $item['numero_contrato']
                    ];
                }
            }

            $sql = "SELECT * FROM tipo_archivos WHERE deleted_at IS NULL ORDER BY orden ASC";
            $my_tipo_archivos = $this->db->query($sql)->result_object();

            $keys_uploads_tipo_archivos = [];
            foreach ($tipo_archivos as $k2 => $o2) {
                $keys_uploads_tipo_archivos[$o2] = $o2;
            }

            $keys_tipos_archivos = [];
            foreach ($my_tipo_archivos as $k => $o) {
                $keys_tipos_archivos[$o->id] = $o;
            }

            $insert_archivos = [];
            if (isset($_FILES['archivos'])) {
                $total  = count($_FILES['archivos']['name']);
                $files  = array();
                if ($total) {
                    $path = __DIR__ . "/../../public/uploads/";
                    if (!is_dir($path)) {
                        mkdir($path, 0777, true);
                    }
                    $fields = ["name", "type", "tmp_name", "error", "size"];
                    $uploads = $_FILES['archivos'];
                    $result = array();
                    for ($index = 0; $index < $total; $index++) {
                        array_push($files, $this->tools->getFieldArray($uploads, $fields, $index));
                    }
                    foreach ($files as $key => $item) {

                        if ($item['error'] == UPLOAD_ERR_OK) {
                            $filename = uniqid(time()) . "-" . $item['name'];
                            $fullpath = $path . $filename;
                            $filepath = "/uploads/" . $filename;
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
            $data['genero']           = $genero;
            $data['estado_civil']     = $estado_civil;
            $data['nacionalidad']     = $nacionalidad;
            $data['fecha_nacimiento'] = $fecha_nacimiento;
            $data['correo']           = $correo;
            $data['numero_celular']   = $numero_celular;
            $data['numero_telefono']  = $numero_telefono;
            $data['via_id']           = $via_id;
            $data['via']              = $via;
            $data['nombre_via']       = $nombre_via;
            $data['zona_id']          = $zona_id;
            $data['zona']             = $zona;
            $data['nombre_zona']      = $nombre_zona;
            $data['direccion']        = $direccion;
            $data['afiliacion']       = $afiliacion;
            $data['cuss']             = $cuss;
            $data['departamento']     = $departamento_id;
            $data['provincia']        = $provincia_id;
            $data['distrito']         = $distrito_id;

            $this->db->update('postulaciones', $data, ['id' => $postulacion_id]);

            $this->db->delete('postulacion_especializaciones', array('postulacion_id' => $postulacion_id)); 
            if (count($insert_especializaciones) > 0) {
                foreach ($insert_especializaciones as $key => $item) {
                    $insert_especializaciones[$key]['postulacion_id'] = $postulacion_id;
                }
                $this->db->insert_batch('postulacion_especializaciones', $insert_especializaciones);
            }

            $this->db->delete('postulacion_formaciones_academicas', array('postulacion_id' => $postulacion_id)); 
            if (count($insert_formaciones_academicas) > 0) {
                foreach ($insert_formaciones_academicas as $key => $item) {
                    $insert_formaciones_academicas[$key]['postulacion_id'] = $postulacion_id;
                }
                $this->db->insert_batch('postulacion_formaciones_academicas', $insert_formaciones_academicas);
            }

            $this->db->delete('postulacion_experiencias_laborales', array('postulacion_id' => $postulacion_id)); 
            if (count($insert_experiencias_laborales) > 0) {
                foreach ($insert_experiencias_laborales as $key => $item) {
                    $insert_experiencias_laborales[$key]['postulacion_id'] = $postulacion_id;
                }
                $this->db->insert_batch('postulacion_experiencias_laborales', $insert_experiencias_laborales);
            }
            $requisitos = [];
            if (count($insert_archivos) > 0) {
                foreach ($insert_archivos as $key => $item) {
                    $insert_archivos[$key]['tipo_id']        = $tipo_archivos[$key];
                    $insert_archivos[$key]['postulacion_id'] = $postulacion_id;
                    $requisitos[] = $keys_tipos_archivos[$insert_archivos[$key]['tipo_id']]->nombre;
                }
                $this->db->insert_batch('postulacion_archivos', $insert_archivos);
            }

            $response['success'] = true;
            $response['message'] = 'Se actualizo correctamente';
        } catch (\Exception $e) {
            log_message_ci("Error al registrar expediente " . json_encode($e->getMessage()));

            $response['message'] = $e->getMessage();
        }
        return $response;
    }

    public function update_old($args)
    {
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

            $sql = "SELECT * FROM convocatorias WHERE con_id = ?";
            $convocatoria = $this->db->query($sql, compact('convocatoria_id'))->row();
            if (!$convocatoria) {
                throw new Exception("No se encontro la convocatoria");
            }

            $any = isset($_POST['any']) ? $_POST['any'] : '';
            switch ($any) {
                case 'archivos_adjuntos_guardar':
                    if (isset($_FILES['archivo'])) {
                        $path = __DIR__ . "/../../public/uploads/";
                        if (!is_dir($path)) {
                            mkdir($path, 0777, true);
                        }
                        $file = $_FILES['archivo'];
                        if ($file['error'] == UPLOAD_ERR_OK) {
                            $filename = uniqid(time()) . "-" . $file['name'];
                            $fullpath = $path . $filename;
                            $filepath = "/uploads/" . $filename;
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
                case 'experiencia_laboral_guardar':
                    $data = [
                        'institucion_educativa' => $_POST['institucion_educativa'],
                        'sector'                => $_POST['sector'],
                        'puesto'                => $_POST['puesto'],
                        'numero_rd'             => $_POST['numero_rd'],
                        'numero_contrato'       => $_POST['numero_contrato'],
                        'postulacion_id'        => $postulacion_id
                    ];
                    $this->db->insert('postulacion_experiencias_laborales', $data);
                    break;
                case 'formacion_academica_guardar':
                    $data = [
                        'nivel_educativo'     => $_POST['nivel_educativo'],
                        'grado_academico'     => $_POST['grado_academico'],
                        'universidad'         => $_POST['universidad'],
                        'carrera_profesional' => $_POST['carrera_profesional'],
                        'registro_titulo'     => $_POST['registro_titulo'],
                        'rd_titulo'           => $_POST['rd_titulo'],
                        'obtencion_grado'     => $_POST['obtencion_grado'],
                        'postulacion_id'      => $postulacion_id
                    ];
                    $this->db->insert('postulacion_formaciones_academicas', $data);
                    break;
                case 'especializacion_guardar':
                    $data = [
                        'tipo_especializacion' => $_POST['tipo_especializacion'],
                        'tema_especializacion' => $_POST['tema_especializacion'],
                        'nombre_entidad'       => $_POST['nombre_entidad'],
                        'fecha_inicio'         => $_POST['fecha_inicio'],
                        'fecha_termino'        => $_POST['fecha_termino'],
                        'numero_horas'         => $_POST['numero_horas'],
                        'postulacion_id'       => $postulacion_id
                    ];
                    $this->db->insert('postulacion_especializaciones', $data);
                    break;
                case 'datos_postulante':

                    break;
                case 'datos_ubicacion':

                    break;
                case 'archivos_adjuntos_eliminar':
                    $this->db->update('postulacion_archivos', ['deleted_at' => $this->tools->getDateHour()], array('id' => $_POST['id']));
                    break;
                case 'experiencia_laboral_eliminar':
                    $this->db->update('postulacion_experiencias_laborales', ['deleted_at' => $this->tools->getDateHour()], array('id' => $_POST['id']));
                    break;
                case 'formacion_academica_eliminar':
                    $this->db->update('postulacion_formaciones_academicas', ['deleted_at' => $this->tools->getDateHour()], array('id' => $_POST['id']));
                    break;
                case 'especializacion_eliminar':
                    $this->db->update('postulacion_especializaciones', ['deleted_at' => $this->tools->getDateHour()], array('id' => $_POST['id']));
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

    public function messageMail($uid, $postulante)
    {
        return '
        <!DOCTYPE html PUBLIC "-//W3C//DTDXHTML1.0Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
            <head>
                <!--[if gte mso 9]><xml><o:OfficeDocumentSettings><o:AllowPNG/><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml><![endif]-->
                <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
                <meta
                content="width=device-width" name="viewport"/>
                <!--[if !mso]><!-->
                <meta
                content="IE=edge" http-equiv="X-UA-Compatible"/>
                <!--<![endif]-->
                <title></title>
                <!--[if !mso]><!-->
                <!--<![endif]-->
                <style type="text/css">
                    body {
                        margin: 0;
                        padding: 0;
                    }

                    table,
                    td,
                    tr {
                        vertical-align: top;
                        border-collapse: collapse;
                    }

                    * {
                        line-height: inherit;
                    }

                    a[x-apple-data-detectors=true] {
                        color: inherit !important;
                        text-decoration: none !important;
                    }
                </style>
                <style id="media-query" type="text/css">
                    @media(max-width: 620px) {

                        .block-grid,
                        .col {
                            min-width: 320px !important;
                            max-width: 100% !important;
                            display: block !important;
                        }

                        .block-grid {
                            width: 100% !important;
                        }

                        .col {
                            width: 100% !important;
                        }

                        .col > div {
                            margin: 0 auto;
                        }

                        img.fullwidth,
                        img.fullwidthOnMobile {
                            max-width: 100% !important;
                        }

                        .no-stack .col {
                            min-width: 0 !important;
                            display: table-cell !important;
                        }

                        .no-stack.two-up .col {
                            width: 50% !important;
                        }

                        .no-stack .col.num4 {
                            width: 33% !important;
                        }

                        .no-stack .col.num8 {
                            width: 66% !important;
                        }

                        .no-stack .col.num4 {
                            width: 33% !important;
                        }

                        .no-stack .col.num3 {
                            width: 25% !important;
                        }

                        .no-stack .col.num6 {
                            width: 50% !important;
                        }

                        .no-stack .col.num9 {
                            width: 75% !important;
                        }

                        .video-block {
                            max-width: none !important;
                        }

                        .mobile_hide {
                            min-height: 0;
                            max-height: 0;
                            max-width: 0;
                            display: none;
                            overflow: hidden;
                            font-size: 0;
                        }

                        .desktop_hide {
                            display: block !important;
                            max-height: none !important;
                        }
                    }
                </style>
            </head>
            <body
                class="clean-body" style="margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: #ece8e5;font-weight:500; font-family: Times, serif">
                <table bgcolor="#ece8e5" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="table-layout: fixed; vertical-align: top; min-width: 320px; Margin: 0 auto; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ece8e5; width: 100%;" valign="top" width="100%">
                    <tbody>
                        <tr style="vertical-align: top;" valign="top">
                            <td style="word-break: break-word; vertical-align: top;" valign="top">
                                <div style="
                                    background-image: url(' . base_url() . "assets/image/cover.png" . ');
                                    background-repeat: no-repeat !important;
                                    background-size: cover !important;
                                    background-attachment: fixed !important;
                                    padding: 20px 0px;">
                                    <div class="block-grid" style="margin: 0 auto; min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #ffffff;margin-top: 30px;margin-bottom: 30px;">
                                        <div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;border: 1px solid gray;">
                                                <div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;"> 
                                                    <div style="width:100% !important;">
                                                        <!--[if (!mso)&(!IE)]><!-->
                                                        <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding: 0px;">
                                                            <!--<![endif]-->
                                                            <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 0px; font-family: Georgia, serif"><![endif]-->
                                                            <div style="display:flow-root;padding:15px 10px; text-align: center;">
                                                                <img src="https://www.ugel05.gob.pe/sites/default/files/inline-images/WhatsApp%20Image%202022-12-23%20at%208.52.58%20AM_1.jpeg" style="height:60px;" />
                                                            </div>
                                                            <div style="background-color:#de1f29;color:#fff;padding:30px 0px;"> 
                                                                <p style="font-size: 22px;  word-break: break-word; text-align: center; mso-line-height-alt: 50px; margin: 0;">
                                                                    <strong>REGISTRO EXITOSO</strong>
                                                                </p>
                                                            </div>
                                
                                                            <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Georgia, serif"><![endif]-->
                                                            <div style="display:flow-root;padding:50px 40px;">
                                                                
                                                            
                                                            <div style="color:#000000; margin-bottom:30px;">
                                                                    <div style="font-size: 18px;color: #000000;">
                                                                        <p style="word-break: break-word; text-align: center; mso-line-height-alt: 17px; margin: 0;">
                                                                            <span>CONVOCATORIA DE DOCENTES</span>
                                                                        </p>

                                                                        <p style="word-break: break-word; text-align: center; mso-line-height-alt: 17px; margin: 0;">
                                                                        <span>Esta URL es válida durante el transcurso de la convocatoria</span>
                                                                    </p>
                                                                    </div>
                                                                </div>
                                                                <div style="color:#000000; margin-bottom:25px;">
                                                                    <div style="font-size: 17px;color: #000000; text-align: left;">

                                                                        <p style="word-break: break-word; margin:0px; margin-bottom: 15px;">
                                                                            <span>Código: <br>' . $uid . '</span>
                                                                        </p>
                                                                        <p style="word-break: break-word; margin:0px; margin-bottom: 15px;">
                                                                            <span>Postulante: <br>' . $postulante->nombre . ' ' . $postulante->apellido_paterno . ' ' . $postulante->apellido_materno . '</span>
                                                                        </p>
                                                                        <p style="word-break: break-word; margin:0px; margin-bottom: 15px;">
                                                                            <span>Número de Documento: <br>' . $postulante->numero_documento . '</span>
                                                                        </p>
                                                                        <p style="word-break: break-word; margin:0px; margin-bottom: 15px;">
                                                                            <span>Fecha de Registro: <br>' . $postulante->fecha_registro . '</span>
                                                                        </p>
                                                                        <!--p style=" word-break: break-word; margin:0px; margin-bottom: 15px;">
                                                                            <span>Url: <br>' . base_url() . 'web/postulaciones/' . $uid . '</span>
                                                                        </p-->
                                                                    </div>
                                                                </div>
                                                                <!--div style="color:#000000; margin-bottom:25px;margin-top:15px;">
                                                                    <div style="font-size: 16px;color: #000000;text-align:center">
                                                                        <a href="' . base_url() . 'web/postulaciones/' . $uid . '" type="button" style="color: #ffffff;
                                                                            background-color: #de1f29;
                                                                            border-color: #de1f29;
                                                                            border: 1px solid transparent;
                                                                            padding: 0.375rem 0.75rem;
                                                                            font-size: 1rem;
                                                                            line-height: 1.5;
                                                                            display: inline-block;
                                                                            font-weight: 400;
                                                                            border-radius: 0.25rem;
                                                                            text-decoration: none;">MI POSTULACIÓN</a>
                                                                    </div>
                                                                </div-->

                                                            </div>
                                                            <!--[if mso]></td></tr></table><![endif]-->
                                                            <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Georgia, serif"><![endif]-->
                                                            <!--[if mso]></td></tr></table><![endif]-->
                                                            <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Georgia, serif"><![endif]-->
                                                            <div style="font-size: 14px;color:#fff;padding:20px 10px; background-color:#707070;">
                                                                <p style="text-align: center; line-height: 1.2; word-break: break-word; mso-line-height-alt: NaNpx; margin: 0;">© 2023 Todos los derechos reservados</p>
                                                                <p style="text-align: center; line-height: 1.2; word-break: break-word; mso-line-height-alt: NaNpx; margin: 0;">Convocatoria de Docente</p>
                                                                <p style="text-align: center; line-height: 1.2; word-break: break-word; mso-line-height-alt: NaNpx; margin: 0;">UGELES EN ACCIÓN</p>
                                                            </div>
                                                            <!--[if mso]></td></tr></table><![endif]-->
                                                            <!--[if (!mso)&(!IE)]><!-->
                                                        </div>
                                                    </div>
                                                    <!--<![endif]-->
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </body>
        </html>';
    }

    public function ficha($id) {

        $response = $this->tools->responseDefault();
        try {

            $this->load->library('form_validation');
            $this->form_validation->set_rules('ficha_id', 'ficha_id', 'trim|required');
            $this->form_validation->set_rules('plantilla', 'plantilla', 'trim|required');
            $this->form_validation->set_rules('puntaje', 'puntaje', 'trim|required');
            
            if ($this->form_validation->run() == FALSE) {
                $response['errors'] = $this->form_validation->error_array();
                throw new Exception("No cumple con los datos requeridos          => " . json_encode($response['errors']));
            }

            $ficha_id  = $this->input->post("ficha_id", true);
            $plantilla = $this->input->post("plantilla", true);
            $puntaje   = $this->input->post("puntaje", true);
            $promedio  = $this->input->post("promedio", true);
            $estado    = $this->input->post("estado", true);
            $evaluacion_estado    = $this->input->post("evaluacion_estado", true);

            $sql = "SELECT 
                        P.*
                    FROM postulaciones AS P 
                    WHERE P.deleted_at IS NULL 
                    AND P.id = ?";
            $postulante = $this->db->query($sql, compact('id'))->row();

            if (!$postulante) {
                throw new Exception("No se encontro el postulante");
            }

            $sql = "SELECT 
                        P.*
                    FROM postulacion_evaluaciones AS P 
                    WHERE P.deleted_at IS NULL 
                    AND P.postulacion_id = ?
                    AND P.ficha_id = ?";
            $ficha = $this->db->query($sql, array('postulacion_id'=>$id, 'ficha_id'=>$ficha_id))->row();

            // if ($ficha) {
            //     throw new Exception("Ya existe una ficha registrada");
            // }

            $sql = "SELECT 
                        PE.*
                    FROM postulacion_evaluaciones AS PE
                    WHERE PE.deleted_at IS NULL 
                    AND PE.postulacion_id  = ?";
            $fichas = $this->db->query($sql, compact('id'))->result_object();

            $contador = count($fichas);
            $orden = $contador ? ($contador + 1) : 1;


            if ($ficha) {
                $update = [
                    'plantilla'      => $plantilla,
                    'puntaje'        => $puntaje,
                    'estado'         => $evaluacion_estado,
                ];
                $this->db->update('postulacion_evaluaciones', $update, array('postulacion_id'=>$id, 'ficha_id'=>$ficha_id));
            } else {
                $insert = [
                    'plantilla'      => $plantilla,
                    'puntaje'        => $puntaje,
                    'ficha_id'       => $ficha_id,
                    'postulacion_id' => $id,
                    'fecha_registro' => $this->tools->getDateHour(),
                    'estado'         => $evaluacion_estado,
                    'orden'          => $orden,
                    'promedio'       => $promedio
                ];
                $this->db->insert('postulacion_evaluaciones', $insert);
            }

            // cambiando de estado al postulante
            $result = $this->fichas($id);
            if ($result['success']) {
                $all = $result['data']['fichas'];
                $postulant = $result['data']['postulante'];
                $total = count($all);
                $count = 0;
                foreach ($all as $key => $item) {
                    if (in_array($item->evaluacion_estado, [1,3])) {
                        $count ++;
                    }
                }
                if ($total == $count) {
                    $this->db->update('postulaciones', ['estado' => $estado], array('id' => $id));
                }
            }

            $response['success'] = true;
            $response['status']  = 200;
            $response['message'] = 'Se guardo correctamente';
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
        }
        return $response;
    }

    public function fichas($id) {
        $response = $this->tools->responseDefault();
        try {
          
            $sql = "SELECT 
                        P.*
                    FROM postulaciones AS P 
                    WHERE P.deleted_at IS NULL 
                    AND P.id = ?";
            $postulante = $this->db->query($sql, compact('id'))->row();

            if (!$postulante) {
                throw new Exception("No se encontro el postulante");
            }

            $inscripcion_id = $postulante->inscripcion_id;
            $convocatoria_id = $postulante->convocatoria_id;

            $sql = "SELECT 
                        P.*
                    FROM convocatorias AS P 
                    WHERE P.con_id = ?";
            $convocatoria = $this->db->query($sql, compact('convocatoria_id'))->row();

            if (!$convocatoria) {
                throw new Exception("No se encontro la convocatoria");
            }

            $tipo_id = $convocatoria->con_tipo;

            $sql = "SELECT 
                        P.*
                    FROM grupo_inscripcion AS P 
                    WHERE P.gin_id = ?";
            $inscripcion = $this->db->query($sql, compact('inscripcion_id'))->row();

            if (!$inscripcion) {
                throw new Exception("No se encontro la inscripcion");
            }

            $periodo_id = $inscripcion->periodos_per_id;
            $especialidad_id = $inscripcion->especialidades_esp_id;

            $sql = "SELECT 
                        P.*,
                        PE.plantilla AS evaluacion_plantilla,
                        PE.estado AS evaluacion_estado,
                        PE.puntaje AS evaluacion_puntaje
                    FROM periodo_fichas AS P 
                    INNER JOIN periodo_ficha_especialidades AS PFE ON PFE.periodo_ficha_id = P.id
                    LEFT JOIN postulacion_evaluaciones AS PE ON P.id = PE.ficha_id AND PE.postulacion_id = {$id} AND PE.deleted_at IS NULL
                    WHERE P.deleted_at IS NULL
                    AND P.tipo_id = ? AND P.periodo_id  = ? AND PFE.especialidad_id = ?
                    ORDER BY P.orden ASC";
            $fichas = $this->db->query($sql, compact('tipo_id', 'periodo_id', 'especialidad_id'))->result_object();
    
            foreach ($fichas as $k => $o) {
                if ($o->evaluacion_plantilla) {
                    $fichas[$k]->plantilla = json_decode($o->evaluacion_plantilla);
                } else {
                    if ($o->plantilla) {
                        $fichas[$k]->plantilla = json_decode($o->plantilla);
                    }    
                }
            }
  
            $sql = "SELECT * FROM periodos WHERE per_id = ?";
            $periodo = $this->db->query($sql, compact('periodo_id'))->row();

            $sql = "SELECT * FROM especialidad_prelaciones WHERE especialidad_id = ? AND deleted_at IS NULL";
            $especialidad_prelaciones = $this->db->query($sql, compact('especialidad_id'))->result_object();
            
            $response['success'] = true;
            $response['data']  = compact('fichas', 'periodo', 'postulante', 'especialidad_prelaciones', 'especialidad_id');
            $response['status']  = 200;
            $response['message'] = 'fichas';
  
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
        }
        return $response;  
    }

    public function buscarDocentesXConvocatoria($convocatoria_id)
    {
        $sql = $this->db
            ->select("p.uid, p.id, p.numero_expediente")
            ->from("postulaciones p")
            ->join("convocatorias c", "p.convocatoria_id =  c.con_id", "inner")
            ->where(array("c.con_numero" => $convocatoria_id, "p.numero_expediente" => null))
            ->get();
        //echo $this->db->last_query(); exit(); 
        return $sql->result_object();
    }


    public function updateExpedienteXPostulante($postulacion_id, $numero_expediente)
    {
        $this->db->update('postulaciones', ['numero_expediente' => $numero_expediente], array('id' => $postulacion_id));
    }
}
