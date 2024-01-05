<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(E_ALL ^ E_NOTICE);

class Configuracion extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata("sigesco")) {
            if ($this->input->post()) {
                $mensaje["error"]   = "Su sesión ha finalizado. Volver a iniciar sesión.";
                $mensaje["link"]    = base_url() . "login/login";
                $mensaje["estado"]  = false;
                echo json_encode($mensaje);
                exit();
            } else {
                redirect(base_url() . "login/login", 'refresh');
            }
        }
        $this->layout->setLayout("template");
        $this->load->model("configuracion_model");
        date_default_timezone_set('America/Lima');
    }

    public function periodos()
    {   // TIENE SOLO 2 SEGMENTOS    
        if (!in_array($this->uri->slash_segment(1) . $this->uri->segment(2), $this->session->userdata("sigesco_rutas"))) {
            redirect(base_url() . "inicio/index", 'refresh');
        }
        if (!empty($this->uri->segment(3))) redirect(base_url() . "configuracion/periodos", 'refresh');

        $this->layout->js(array(base_url() . "public/js/myscript/configuracion/periodos.js?t=" . date("mdYHis")));
        $this->layout->view("periodos/periodos");
    }

    public function VListarPeriodos()
    {
        $datos = $this->configuracion_model->listarPeriodosTodos();
        $this->layout->setLayout("template_ajax");
        $this->layout->view('periodos/VListarPeriodos', compact('datos'));
    }

    public function editarPeriodo()
    {   // TIENE SOLO 2 SEGMENTOS    
        if (!in_array($this->uri->slash_segment(1) . $this->uri->segment(2), $this->session->userdata("sigesco_rutas"))) {
            redirect(base_url() . "inicio/index", 'refresh');
        }
        $this->layout->js(array(base_url() . "public/js/myscript/configuracion/periodo/editar.js?t=" . date("mdYHis")));
        // $this->layout->view("periodos/editar", ['id' => $this->uri->segment(3)]);
        $this->layout->view("periodos/editar", $this->configuracion_model->editarPeriodo($this->uri->segment(3)));        
    }

    public function detallePeriodo($id)
    {
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($this->configuracion_model->detallePeriodo($id)));
    }

    public function guardarPeriodo($id)
    {
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($this->configuracion_model->guardarPeriodo($id)));
    }

    public function eliminarPeriodo($id)
    {
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($this->configuracion_model->eliminarPeriodo($id)));
    }

    public function registraPeriodo()
    {
        if ($this->input->post()) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->configuracion_model->registraPeriodo()));
        } else {
            show_404();
        }
    }

    public function procesos()
    {   // TIENE SOLO 2 SEGMENTOS    
        if (!in_array($this->uri->slash_segment(1) . $this->uri->segment(2), $this->session->userdata("sigesco_rutas"))) {
            redirect(base_url() . "inicio/index", 'refresh');
        }
        if (!empty($this->uri->segment(3))) redirect(base_url() . "configuracion/procesos", 'refresh');

        $this->layout->js(array(base_url() . "public/js/myscript/configuracion/procesos.js?t=" . date("mdYHis")));
        $this->layout->view("procesos/procesos");
    }

    public function VListarProcesos()
    {
        $datos = $this->configuracion_model->listarProcesosTodos();
        $this->layout->setLayout("template_ajax");
        $this->layout->view('procesos/VListarProcesos', compact('datos'));
    }

    public function grupoinscripcion()
    {   // TIENE SOLO 2 SEGMENTOS    
        if (!in_array($this->uri->slash_segment(1) . $this->uri->segment(2), $this->session->userdata("sigesco_rutas"))) {
            redirect(base_url() . "inicio/index", 'refresh');
        }
        if (!empty($this->uri->segment(3))) redirect(base_url() . "configuracion/grupoinscripcion", 'refresh');

        $periodos = $this->configuracion_model->listarPeriodosActivos();
        $procesos = $this->configuracion_model->listarProcesosActivos();

        $this->layout->js(array(base_url() . "public/js/myscript/configuracion/grupoinscripcion.js?t=" . date("mdYHis")));
        $this->layout->view("grupoinscripcion/grupoinscripcion", compact('periodos', 'procesos', 'modalidades'));
    }

    public function VListarGrupoInscripcion()
    {
        $tipoCarga  = $this->input->post("tipoCarga", true);

        if ($tipoCarga == 0) { // carga default
            $idPer = $this->session->userdata("sigesco_default_periodo");
            $idPro = $this->session->userdata("sigesco_default_proceso");
        } else {
            $idPer  = $this->input->post("idPer", true);
            $idPro  = $this->input->post("idPro", true);
        }

        $datos = $this->configuracion_model->listarGruposInscripcion($idPer, $idPro);

        $this->layout->setLayout("template_ajax");
        $this->layout->view('grupoinscripcion/VListarGrupoInscripcion', compact('datos'));
    }

    public function pun()
    {   // TIENE SOLO 2 SEGMENTOS    
        if (!in_array($this->uri->slash_segment(1) . $this->uri->segment(2), $this->session->userdata("sigesco_rutas"))) {
            redirect(base_url() . "inicio/index", 'refresh');
        }
        if (!empty($this->uri->segment(3))) redirect(base_url() . "configuracion/pun", 'refresh');

        $periodos = $this->configuracion_model->listarPeriodosActivos();
        $procesos = $this->configuracion_model->listarProcesosActivos();
        $this->layout->js(array(base_url() . "public/js/myscript/configuracion/pun.js?t=" . date("mdYHis")));
        $this->layout->view("pun/pun", compact('periodos', 'procesos'));
    }

    public function VListarPun()
    {
        $tipoCarga  = $this->input->post("tipoCarga", true);

        if ($tipoCarga == 0) { // carga default
            $idPer = $this->session->userdata("sigesco_default_periodo");
            $idPro = $this->session->userdata("sigesco_default_proceso");
        } else {
            $idPer  = $this->input->post("idPer", true);
            $idPro  = $this->input->post("idPro", true);
        }

        $datos = $this->configuracion_model->listarPruebaPun($idPer, $idPro);
        $this->layout->setLayout("template_ajax");
        $this->layout->view('pun/VListarPun', compact('datos'));
    }

    public function VCargarPun()
    {
        $periodos = $this->configuracion_model->listarPeriodosActivos();
        $procesos = $this->configuracion_model->listarProcesosActivos();
        $this->layout->setLayout("template_ajax");
        $this->layout->view('pun/VCargarPun', compact('periodos', 'procesos'));
    }


    public function CUploadDocumento()
    {

        $PATH_FILE  = 'archivos/pun/temporal' . '/';
        if (!is_dir($PATH_FILE)) {
            mkdir($PATH_FILE, 0777, true);
        }
        $name = "Cuadro_merito_pun_" . date("YmdHis");
        $extension   = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));
        if (!empty($_FILES)) {
            $config["upload_path"]       = $PATH_FILE;
            $config["allowed_types"]     = "xlsx";
            $config["file_name"]         = $name . "." . $extension;
            $config["overwrite"]         = true; //sobreescribir
            $config["max_size"]         = 0;
            $config["max_filename"]     = 0;
            //$config["remove_spaces"] 	= false;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload("file")) {
                $mensaje["error"] = "Ocurrió un error al cargar archivo.";
                $mensaje["estado"] = false;
            } else {
                $mensaje["nombre"] = $config["file_name"];
                $mensaje["estado"] = true;
            }
        } else {
            $mensaje["error"] = "No se envió ningun archivo.";
            $mensaje["estado"] = false;
        }
        echo json_encode($mensaje);
    }

    public function CRemoveDocumento()
    {

        $file   = $this->input->post("file");
        $PATH_FILE  = 'archivos/pun/temporal' . '/';

        if ($file && file_exists($PATH_FILE . "/" . $file)) {
            unlink($PATH_FILE . "/" . $file);
            $mensaje["success"] = "Archivo eliminado correctamente";
            $mensaje["estado"] = true;
        } else {
            $mensaje["success"] = "No se encontró archivo";
            $mensaje["estado"] = false;
        }
        echo json_encode($mensaje);
    }

    public function CProcesarArchivoPun()
    {
        $anio           = $this->input->post("anio", true);
        $idPer          = $this->input->post("idPer", true);
        $idPro          = $this->input->post("idPro", true);
        $nombreArchivo  = $this->input->post("nombreArchivo", true);

        $ruta_temp = 'archivos/pun/temporal' . '/' . $nombreArchivo;
        $extension = strtolower(pathinfo($ruta_temp, PATHINFO_EXTENSION));
        $PATH_FILE = 'archivos/pun/';

        if ($nombreArchivo == "") {
            $mensaje["error"] = "No se ha cargado el archivo correctamente.";
            $mensaje["estado"] = false;
            echo json_encode($mensaje);
            exit();
        }

        if (!is_dir($PATH_FILE)) {
            mkdir($PATH_FILE, 0777, true);
        }

        $NuevoNombreArchivo = "Cuadro_merito_pun_" . $anio . "_" . $idPro . "_" . date("YmdHis") . "." . $extension;
        $file = $PATH_FILE . $NuevoNombreArchivo;

        if (!(rcopy($ruta_temp, $file))) {
            $mensaje["error"] = "Error al cargar el archivo.";
            $mensaje["estado"] = false;
            echo json_encode($mensaje);
            exit();
        }
        //rrmdir($ruta_temp); 

        $archivo =  $file;
        $this->load->library('PHPExcel');
        // Cargo la hoja de cálculo
        $objPHPExcel = PHPExcel_IOFactory::load($archivo);
        //Asigno la hoja de calculo activa
        $objPHPExcel->setActiveSheetIndex(0);
        //Obtengo el numero de filas del archivo							
        $numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
        $detalle_cabecera = ["N°", "DOCUMENTO_DE_IDENTIDAD", "APELLIDO_PATERNO", "APELLIDO_MATERNO", "NOMBRES", "ID_ESPECIALIDAD", "S1", "S2", "S3", "S4", "S5", "ORDEN DE MERITO"];
        $letras = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L"];
        $cumple = 1;
        for ($i = 0; $i < count($letras); $i++) {
            $texto = trim($objPHPExcel->getActiveSheet()->getCell($letras[$i] . '1')->getCalculatedValue());
            if ($texto != $detalle_cabecera[$i]) {
                $cumple = 0;
                break;
            }
        }

        $ar_insert      = [];
        $ar_documentos  = [];

        if ($cumple == 1) {
            for ($i = 2; $i <= $numRows; $i++) {
                $documento  = trim($objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue());
                $apaterno   = toMayus($objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue());
                $amaterno   = toMayus($objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue());
                $nombres    = toMayus($objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue());
                $idGin      = trim($objPHPExcel->getActiveSheet()->getCell('F' . $i)->getCalculatedValue());
                $s1         = trim($objPHPExcel->getActiveSheet()->getCell('G' . $i)->getCalculatedValue());
                $s2         = trim($objPHPExcel->getActiveSheet()->getCell('H' . $i)->getCalculatedValue());
                $s3         = trim($objPHPExcel->getActiveSheet()->getCell('I' . $i)->getCalculatedValue());
                $s4         = trim($objPHPExcel->getActiveSheet()->getCell('J' . $i)->getCalculatedValue());
                $s5         = trim($objPHPExcel->getActiveSheet()->getCell('K' . $i)->getCalculatedValue());
                $orden      = trim($objPHPExcel->getActiveSheet()->getCell('L' . $i)->getCalculatedValue());

                if (!is_numeric($idGin)) {
                    $mensaje["error"] = "Revisar la celda F-" . $i . ", según los grupos de inscripción.";
                    $mensaje["estado"] = false;
                    echo json_encode($mensaje);
                    exit();
                }

                if (!is_numeric($orden)) {
                    $mensaje["error"] = "Revisar la celda L-" . $i . ", solo números.";
                    $mensaje["estado"] = false;
                    echo json_encode($mensaje);
                    exit();
                }

                $arreglo = array(
                    "cpe_tipoCuadro"    => 1, //1: PUN, 2. EXPEDIENTE      
                    "cpe_anio"          => $anio,
                    "cpe_documento"     => $documento,
                    "cpe_apaterno"      => $apaterno,
                    "cpe_amaterno"      => $amaterno,
                    "cpe_apellidos"     => trim($apaterno . " " . $amaterno),
                    "cpe_nombres"       => $nombres,
                    "cpe_s1"            => $s1 == "" ? 0 : $s1,
                    "cpe_s2"            => $s2 == "" ? 0 : $s2,
                    "cpe_s3"            => $s3 == "" ? 0 : $s3,
                    "cpe_s4"            => $s4 == "" ? 0 : $s4,
                    "cpe_s5"            => $s5 == "" ? 0 : $s5,
                    "cpe_orden"         => $orden,
                    "cpe_sepresento"    => 2, // estado registrado
                    "cpe_enviadoeval"   => 0,
                    "cpe_fechaCarga"    => date("Y-m-d H:i:s"),
                    "cpe_estado"        => 1,
                    "grupo_inscripcion_gin_id"  => $idGin
                );

                array_push($ar_documentos, $documento);
                array_push($ar_insert, $arreglo);
            }

            $buscar = $this->configuracion_model->buscarDocumentoExiste($ar_documentos, $anio);

            if (!empty($buscar)) {
                $ar_list = [];
                foreach ($buscar as $busca) {
                    $ar_list[] = $busca['cpe_documento'];
                }
                $mensaje["error"] = "Documentos ya se encuentra registrado: " . implode(", ", $ar_list);
                $mensaje["estado"] = false;
                echo json_encode($mensaje);
                exit();
            }

            $insert = $this->configuracion_model->insertBatchCuadroPun($ar_insert);

            if ($insert >= 1) {
                $mensaje["success"] = "Se cargó información correctamente.";
                $mensaje["estado"] = true;
            } else {
                $mensaje["error"] = "Error al cargar información";
                $mensaje["estado"] = false;
            }
        } else {
            $mensaje["error"] = "Formato de archivo no corresponde.";
            $mensaje["estado"] = false;
        }
        echo json_encode($mensaje);
    }


    public function colegios()
    {   // TIENE SOLO 2 SEGMENTOS    
        if (!in_array($this->uri->slash_segment(1) . $this->uri->segment(2), $this->session->userdata("sigesco_rutas"))) {
            redirect(base_url() . "inicio/index", 'refresh');
        }
        if (!empty($this->uri->segment(3))) redirect(base_url() . "configuracion/colegios", 'refresh');

        $periodos = $this->configuracion_model->listarPeriodosActivos();
        $procesos = $this->configuracion_model->listarProcesosActivos();
        $this->layout->js(array(base_url() . "public/js/myscript/configuracion/colegios.js?t=" . date("mdYHis")));
        $this->layout->view("colegios/colegios", compact('periodos', 'procesos'));
    }

    public function VListarColegios()
    {

        $datos = $this->configuracion_model->listarColegios();
        $this->layout->setLayout("template_ajax");
        $this->layout->view('colegios/VListarColegios', compact('datos'));
    }


    public function plazas()
    {


        if (!in_array($this->uri->slash_segment(1) . $this->uri->segment(2), $this->session->userdata("sigesco_rutas"))) {
            redirect(base_url() . "inicio/index", 'refresh');
        }
        if (!empty($this->uri->segment(3))) redirect(base_url() . "configuracion/plazas", 'refresh');


        $this->layout->js(array(base_url() . "public/js/myscript/configuracion/plazas.js?t=" . date("mdYHis")));
        $this->layout->view("plazas/plazas", compact('periodos', 'procesos'));
    }


    public function VNuevaPlaza()
    {
        $periodos   = $this->configuracion_model->listarPeriodosActivos();
        $procesos   = $this->configuracion_model->listarProcesosActivos();
        $colegios   = $this->configuracion_model->listarColegiosActivos();

        $idPer = $this->session->userdata("sigesco_default_periodo");
        $idPro = $this->session->userdata("sigesco_default_proceso");
        $grupos     = $this->configuracion_model->listarGruposInscripcion($idPer, $idPro);
        $this->layout->setLayout("template_ajax");
        $this->layout->view('plazas/VNuevaPlaza', compact('periodos', 'procesos', 'grupos', 'colegios'));
    }


    public function VListarPlazas()
    {
        $datos = $this->configuracion_model->listarPlazas();
        $this->layout->setLayout("template_ajax");
        $this->layout->view('plazas/VListarPlazas', compact('datos'));
    }


    public function VNuevoGrupoInscripcion()
    {
        $periodos   = $this->configuracion_model->listarPeriodosActivos();
        $procesos   = $this->configuracion_model->listarProcesosActivos();
        $modalidades  = $this->configuracion_model->listarModalidades();
        $niveles =   $this->configuracion_model->listarNiveles();

        $idPer = $this->session->userdata("sigesco_default_periodo");
        $idPro = $this->session->userdata("sigesco_default_proceso");

        $this->layout->setLayout("template_ajax");
        $this->layout->view('grupoinscripcion/listar/VNuevoGrupoInscripcion', compact('periodos', 'procesos', 'modalidades', 'niveles'));
    }


    public function CAgregarNuevoGrupoInscripcion()
    {
        /*$idModalidad          = $this->input->post("idModalidad",true); */
        $idNivel           = $this->input->post("idNivel", true);
        $especialidad          = $this->input->post("especialidad", true);
        $idPeriodo          = $this->input->post("idPer", true);
        $idProceso          = $this->input->post("idPro", true);

        $arr_1 = array(
            "niveles_niv_id"  => $idNivel,
            "esp_descripcion" => $especialidad,
            "esp_estado"      => 1
        );

        $idEspecialidad = $this->configuracion_model->insertarEspecialidad($arr_1);

        if ($idEspecialidad < 0) {
            $mensaje["error"]   = "Error al agregar la especialidad.";
            $mensaje["estado"]  = false;
            echo json_encode($mensaje);
            exit();
        }

        $arr_2 = array(
            "procesos_pro_id"  => $idProceso,
            "periodos_per_id" => $idPeriodo,
            "especialidades_esp_id"  => $idEspecialidad,
            "gin_estado"      => 1

        );

        $insert = $this->configuracion_model->insertGrupoInscripcion($arr_2);

        if ($insert >= 1) {
            $mensaje["success"] = "Se registró información correctamente.";
            $mensaje["estado"]  = true;
        } else {
            $mensaje["error"]   = "Error al registrar información.";
            $mensaje["estado"]  = false;
        }
        echo json_encode($mensaje);
    }


    public function eliminarGrupoInscripcion()
    {
        $idGin = $this->input->post("idGin", true);
        $arr_1 = array(
            "gin_id"  => $idGin
        );

        $this->configuracion_model->eliminarGrupoInscripcion($arr_1);

        $mensaje["success"] = "Se eliminó la información correctamente.";
        $mensaje["estado"]  = true;

        echo json_encode($mensaje);
    }


    public function validarGrupoInscripcion()
    {
        $idGin = $this->input->post("idGin", true);
        $arr_1 = array(
            "inscripcion_id"  => $idGin
        );

        $cantidad = $this->configuracion_model->validarGrupoInscripcion($arr_1);

        $response["estado"]  = true;
        $response["data"]  = $cantidad;

        echo json_encode($response);
    }
}
