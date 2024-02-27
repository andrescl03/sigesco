<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ALL ^ E_NOTICE);

class Evaluacion extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata("sigesco")){
            if ($this->input->post()){ 
                $mensaje["error"]   = "Su sesión ha finalizado. Volver a iniciar sesión.";
                $mensaje["link"]    = base_url()."login/login";
                $mensaje["estado"]  = false; 
                echo json_encode($mensaje); 
                exit();
            }else{
                redirect(base_url()."login/login",'refresh');
            }
        }
		$this->layout->setLayout("template");
        $this->load->model("convocatorias_model");
        $this->load->model("evaluacion_model");
        $this->load->model("configuracion_model");
        $this->load->model("postulaciones_model");
        //$this->load->model("mesadepartes_model");
		date_default_timezone_set('America/Lima');
	}

    public function convocatoria($cadena = null){   // TIENE SOLO 3 SEGMENTOS
        if(!in_array($this->uri->slash_segment(1).$this->uri->segment(2), $this->session->userdata("sigesco_rutas"))){            
            redirect(base_url()."inicio/index",'refresh');
        }
        if (!empty($this->uri->segment(4))) redirect(base_url()."evaluacion/convocatoria/".$cadena, 'refresh');
        if (empty($cadena)) redirect(base_url()."evaluacion/convocatoria/".encryption('0||0'));

        $_cadena    = decryption($cadena); // cadena tiene 2 parametros
        $arreglo    = explode("||",$_cadena);     
        $idCon      = $arreglo[0];
        $idGin      = $arreglo[1];
        $eval       = $arreglo[2]; // 1: PUN, 2: POR EXP   
        $tipo       = $arreglo[3]; // 1: PRELIMINAR, 2: FINAL   

        if($idCon == '0' && $idGin == '0'){
            $periodos   = $this->configuracion_model->listarPeriodosActivos();
            $procesos   = $this->configuracion_model->listarProcesosActivos();

            $this->layout->js(array(base_url()."public/js/myscript/evaluacion/convocatoria.js?t=".date("mdYHis")));
		    $this->layout->view("convocatoria/convocatoria", compact('periodos', 'procesos')); 
        }

        if($idCon != '0' && $idGin == '0'){
            $datos   = $this->evaluacion_model->listarGruposInscripcionxConvocatoria($idCon);
            // $gruposInscripcion = $this->evaluacion_model->listarGruposAsignadosXConvocatoria($idConv);


            /*foreach ($datos as $key_1 => $dato) {
                $_idGin = $dato['gin_id'];
                $usuario = $this->session->userdata("sigesco_dni");
                $docente   = $this->evaluacion_model->listarCuadroPunxIdGrupoConEvaluacion($_idGin, $usuario);
                $datos[$key_1]['tp_docentes']    = $docente['t_docentes'];
                $datos[$key_1]['tp_asigando']    = $docente['t_asigando'];
                $datos[$key_1]['tp_preliminar']  = $docente['t_preliminar'];
                $datos[$key_1]['tp_final']       = $docente['t_final'];
                $datos[$key_1]['tp_mis_preliminar']  = $docente['t_mis_preliminar'];
                $datos[$key_1]['tp_mis_final']       = $docente['t_mis_final'];

                $docente   = $this->evaluacion_model->listarCuadroExpxIdGrupoConEvaluacion($_idGin, $usuario);
                $datos[$key_1]['te_docentes']    = $docente['t_docentes'];
                $datos[$key_1]['te_asigando']    = $docente['t_asigando'];
                $datos[$key_1]['te_preliminar']  = $docente['t_preliminar'];
                $datos[$key_1]['te_final']       = $docente['t_final'];
                $datos[$key_1]['te_mis_preliminar']  = $docente['t_mis_preliminar'];
                $datos[$key_1]['te_mis_final']       = $docente['t_mis_final'];
            }*/
            $this->layout->js(array(base_url()."public/js/myscript/evaluacion/grupos.js?t=".date("mdYHis")));
		    $this->layout->view("convocatoria/grupos/grupos", ['datos' => $datos, 'convocatoria_id' => $idCon]); 
        }

        if($idCon != '0' && $idGin != '0'){
            $dato   = $this->evaluacion_model->listarGrupoInscripcionxConvocatoriaYEspecialidad($idCon, $idGin);
            $this->layout->js(array(base_url()."public/js/myscript/evaluacion/cargar.js?t=".date("mdYHis")));
		    $this->layout->view("convocatoria/cargar/cargar", compact('dato', 'eval', 'tipo')); 
        }
	}

    public function VListarConvocatoriasActivas(){
        $tipoCarga  = $this->input->post("tipoCarga",true); 
        if ($tipoCarga == 0){ // carga default
            $idPer = $this->session->userdata("sigesco_default_periodo");
            $idPro = $this->session->userdata("sigesco_default_proceso");
        }else{
            $idPer  = $this->input->post("idPer",true);  
            $idPro  = $this->input->post("idPro",true);  
        }
        $datos  = $this->convocatorias_model->listarConvocatoriasActivas($idPer, $idPro); 
              
        $this->layout->setLayout("template_ajax");
        $this->layout->view('convocatoria/VListarConvocatoriasActivas', compact('datos'));
    }


    public function VListarCargarExpedientePunEvaluar(){     
        $idGin      = $this->input->post("idGin",true);
        $evaluc     = $this->input->post("evaluc",true); // 1: PUN, 2: POR EXP    
        $tipo       = $this->input->post("tipo",true);  // 1: PRELIMINAR, 2: FINAL   
        $todos      = $this->input->post("todos",true); // 0: POR ESPECIALISTA, 1: TODOS
        $convId     = $this->input->post("convId",true);
        $usuario    = $this->session->userdata("sigesco_dni");
       
        switch ($tipo) {
            case '1':
                if($todos==1){// 1: todos
                    $datos    = $this->evaluacion_model->listarCuadroPunxIdGrupoEnviadoEvaluacionPreliminarV2($convId, $idGin);
                }else{// 0: por especialista
                    $datos    = $this->evaluacion_model->listarCuadroPunxIdGrupoEnviadoEvaluacionPreliminarxUsuarioV2($convId, $idGin, $usuario);
                }
                // writer($datos);
                /*foreach ($datos as $key_1 => $dato) {
                    $idCpu = $dato['cpe_id'];
                    $asignaciones = $this->convocatorias_model->listarAsignacionxCuadroPun($idCpu);
                    if(!empty($asignaciones)){
                        foreach ($asignaciones as $key_2 =>$asignacion) {
                            $datos[$key_1]['expediente'][$key_2]['idExp']   = $asignacion['exp_id'];
                            $datos[$key_1]['expediente'][$key_2]['codigo']  = $asignacion['exp_codigo'];

                            $archivos = $this->convocatorias_model->listarArchivosDetalle($asignacion['exp_id']);
                            
                            foreach ($archivos as $key_3 => $archivo) {
                                $datos[$key_1]['expediente'][$key_2]['archivo'][$key_3]['tipo'] = $archivo['adt_tipoArchivo'];
                                $datos[$key_1]['expediente'][$key_2]['archivo'][$key_3]['procedencia'] = $archivo['adt_procedenciaArchivo'];
                                $datos[$key_1]['expediente'][$key_2]['archivo'][$key_3]['idArch'] = $archivo['adt_id'];
                            }
                        }
                    }else{
                        $datos[$key_1]['expediente'] = [];
                    }
                }*/
                //writer($datos);
                $this->layout->setLayout("template_ajax");
                $this->layout->view('convocatoria/cargar/pun/pun', compact('datos'));

                break;
            case '2':
                # code...
                break;
        }                
                
    }

    public function VListarEspecialistas(){
        $idConv      = $this->input->post("idConv",true); //iConvocatoria

        $datos   = $this->evaluacion_model->verEspecialistasAcceso();

        $grupos   = $this->evaluacion_model->VerGrupodeInscripcionxConvocatoria($idConv);// Listar grupos de inscripcion de la idconv
        $ar_idGin = [];
        foreach ($grupos as $grupo) {        
            array_push($ar_idGin, $grupo['grupo_inscripcion_gin_id']);
        }
        $contador =  $this->evaluacion_model->contarEspecialistasAsignadosaPunxConvocatoriaPreliminarV2($ar_idGin, $idConv);

        foreach ($datos as $key_1 => $dato) {
            $found_key = (string)array_search($dato['usu_dni'], array_column($contador, 'dni_espec'));    
            $key = ($found_key == null ? -1 : $found_key);
            if($key >= 0){
                $datos[$key_1]["total"]=$contador[$key]['total'];
              
            }else{
                $datos[$key_1]["total"]=0;
            }
        }

        $this->layout->setLayout("template_ajax");
        $this->layout->view('convocatoria/cargar/pun/VListarEspecialistas', compact('datos'));
    }

    public function CAsignarReasignar(){
        $cadena     = $this->input->post("cadena",true);
        $usuario    = $this->input->post("usuario",true);
        $convId     = $this->input->post("convId",true);
        $ar_insert = [];
        $ar_update = [];
        for ($i=0; $i <count($cadena) ; $i++) { 
            $arreglo    = explode("||",$cadena[$i]);     
            $idCpu      = $arreglo[0];
            $idEpu      = $arreglo[1];           
            if($idEpu == 0){ // no tiene asignacion              
                $arr_1 = array(                       
                    "epe_tipoevaluacion"        => 1, // 1: PRELIMINAR
                    "epe_especialistaAsignado"  => $usuario,                    
                    "epe_fechaAsignacion"       => date("Y-m-d H:i:s"),
                    "epe_fechaApertura"         => date("Y-m-d H:i:s"),                
                    "epe_estadoEvaluacion"      => 1, // 1: abierto, 2: cerrado
                    "epe_estado"                => 1, // 1: activo
                    // "cuadro_pun_exp_cpe_id"         => $idCpu
                    "postulacion_id"      => $idCpu
                );
                array_push($ar_insert, $arr_1);

            }else{ // actualizar asignacion

                $arr_2 = array(  
                    "epe_id"                    => $idEpu,
                    "epe_especialistaAsignado"  => $usuario,
                    "epe_fechaAsignacion"       => date("Y-m-d H:i:s"),
                    "epe_fechaModificacion"     => date("Y-m-d H:i:s")
                );
                array_push($ar_update, $arr_2);
            }
        }

        if(!empty($ar_insert)){
            $insert = $this->evaluacion_model->insertarBatchEvaluacionPun($ar_insert);   
        }

        if(!empty($ar_update)){            
            $update = $this->evaluacion_model->updateBatchEvaluacionPun($ar_update);            
        }

         if($update > 0 || $insert > 0){
            $mensaje["success"] = "se registró especialista correctamente.";	
            $mensaje["estado"]  = true;      
        }else{
            $mensaje["error"]   = "Error al registrar especialista.";
            $mensaje["estado"]  = false;
        }
        echo json_encode($mensaje); 
    }


    public function ficha($cadena = null){   // TIENE SOLO 3 SEGMENTOS

        $_cadena    = decryption($cadena); // cadena tiene 2 parametros
        $arreglo    = explode("||",$_cadena);     
        $idCpu      = $arreglo[0];
        $idEpu      = $arreglo[1];       
        

        if (count($arreglo) != 2) redirect(base_url()."errores/error404");

        $datos = $this->postulaciones_model->show(['id' => $idCpu]);
        // $datos = $this->evaluacion_model->verFichaEvaluacion(); 
        $this->layout->css(array(base_url()."public/css/ficha.css?t=".date("mdYHis")));
        $this->layout->js(array(base_url()."public/js/myscript/evaluacion/ficha.js?t=".date("mdYHis"),
        base_url()."public/js/myscript/evaluacion/guide.js?t=".date("mdYHis")));
        $revaluar = 0;
        $this->layout->view("ficha/ficha", compact('datos', 'revaluar')); 
	}
    
    public function indexPreliminar($convocatoria_id, $inscripcion_id) {
        $this->layout->js(array(base_url()."public/js/myscript/evaluacion/evaluacion.js?t=".date("mdYHis")));
        $this->layout->view("/evaluacion/convocatoria/grupos/evaluacion", ['any' => 'preliminar', 'convocatoria_id' => $convocatoria_id, 'inscripcion_id' => $inscripcion_id]);
    }

    public function indexFinal($convocatoria_id, $inscripcion_id) {
        $this->layout->js(array(base_url()."public/js/myscript/evaluacion/evaluacion.js?t=".date("mdYHis")));
        $this->layout->view("/evaluacion/convocatoria/grupos/evaluacion", ['any' => 'final', 'convocatoria_id' => $convocatoria_id, 'inscripcion_id' => $inscripcion_id]);
    }

    public function pagination() {
        if ($this->input->post()) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->evaluacion_model->pagination()));
        } else {
            show_404();
        }    
    }

    public function attachedfiles($id) {
        if ($id > 0) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->evaluacion_model->attachedfiles(compact('id'))));   
        } else {
            show_404();
        }    
    }


    public function procesar_expedientes($convocatoria_id, $inscripcion_id)
    {
        if ($convocatoria_id > 0 && $inscripcion_id > 0) {

            $this->output
                ->set_content_type('application/json')->set_output(json_encode($this->evaluacion_model->procesarExpedientesPreliminarCumpleFinal($convocatoria_id, $inscripcion_id)));
        } else {
            show_404();
        }
    }
    
    public function status() {
        if ($this->input->post()) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->evaluacion_model->status()));
        } else {
            show_404();
        }    
    }

    public function revaluarPreliFinal($id) {
        $datos = $this->postulaciones_model->show(['id' => $id]);
        $this->layout->css(array(base_url()."public/css/ficha.css?t=".date("mdYHis")));
        $this->layout->js(array(
            base_url()."public/js/myscript/evaluacion/ficha.js?t=".date("mdYHis"),
            base_url()."public/js/myscript/evaluacion/guide.js?t=".date("mdYHis")
        ));
        $revaluar = 1;
        $this->layout->view("ficha/ficha", compact('datos', 'revaluar'));       
	}

    public function reporte_excel_preliminar($convocatoria_id, $inscripcion_id) {
        $this->reporte_excel($convocatoria_id, $inscripcion_id, 'revisado', 'FICHA_PRELIMINAR');
    }
    public function reporte_excel_final($convocatoria_id, $inscripcion_id) {
        $this->reporte_excel($convocatoria_id, $inscripcion_id, 'finalizado', 'FICHA_FINAL');
    }

    public function reporte_excel_pendiente($convocatoria_id, $inscripcion_id) {
        $this->reporte_excel($convocatoria_id, $inscripcion_id, 'enviado', 'EXPENDIENTES_SIN_EVALUAR');
    }

    public function reporte_excel_preliminar_total($convocatoria_id) {
        $this->reporte_excel_2($convocatoria_id, -1 , 'revisado', 'FICHA_PRELIMINAR');
    }

    public function reporte_excel_final_total($convocatoria_id) {
        $this->reporte_excel($convocatoria_id, -1 , 'finalizado', 'FICHA_FINAL');
    }

    public function reporte_excel($convocatoria_id, $inscripcion_id, $estado, $ficha) {
        $response = $this->evaluacion_model->f_report_postulant($convocatoria_id, $inscripcion_id, $estado, true);
        if (!$response['success']) {
            echo $response['message'];
        }
        // $records = $response['data']['records'];
        $this->generar_reporte_excel($response['data'], $ficha);
    }

    public function reporte_excel_2($convocatoria_id, $inscripcion_id, $estado, $ficha) {
        $response = $this->evaluacion_model->f_report_postulant($convocatoria_id, $inscripcion_id, $estado, true);
        if (!$response['success']) {
            echo $response['message'];
        }
        // $records = $response['data']['records'];
        $this->generar_reporte_excel_2($response['data'], $ficha);
    }

    public function reporte_excel_general($convocatoria_id) {
        $estado  = $this->input->post("estado", true);
        $inscripcion_id  = $this->input->post("inscripcion_id", true);
        $response = $this->evaluacion_model->f_report_postulant($convocatoria_id, $inscripcion_id, $estado);
        if (!$response['success']) {
            echo $response['message'];
        }
        // $records = $response['data']['records'];
        $this->generar_reporte_excel($response['data']);
    }

    public function generar_reporte_excel($data, $ficha = null) {
        $records = $data['records'];
        $convocatoria = $data['convocatoria'];
        $ficha = $ficha ? $ficha : 'REPORTE_DE_EVALUACIÓN';

        /* A partir de ahora cualquier salida al navegador se guardarÃ¡ en un buffer */
        /* Obtenemos el listado de locales disponibles en el sistema */
        file_put_contents('log.txt', shell_exec('locale -a'), FILE_APPEND);
        set_time_limit(0);
        setlocale(LC_ALL, 'es_ES');
        $fecha = date('d/m/Y H:i:s');
        ini_set('memory_limit', '-1');
        // $datos = null;
        // $datos = $this->gestion->listar_reporte_horas();
    
        $this->load->library('excel');

        $hoja = $this->excel->getActiveSheet();

            //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
            //name the worksheet
        $hoja->setTitle('Reporte.');
        //set cell A1 content with some text
        $hoja->setCellValue('A1', 'REPORTE GENERAL ' . $fecha);
        //change the font size
        $hoja->getStyle('A1')->getFont()->setSize(24);
        //make the font become bold
        $hoja->getStyle('A1')->getFont()->setBold(true);
        //merge cell A1 until D1
        $hoja->mergeCells('A1:M1');
        //set aligment to center for that merged cell (A1 to D1)

        $hoja->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('E2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('F2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('G2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('H2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('I2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('K2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        if ($convocatoria->con_tipo == 2) {
            $hoja->getStyle('M2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        }

        $hoja->setCellValue('A2', 'INSCRIPCIÓN')->getStyle('A2')->getFont()->setSize(15)->setBold(true);
        $hoja->setCellValue('B2', 'DNI')->getStyle('B2')->getFont()->setSize(15)->setBold(true);
        $hoja->setCellValue('C2', 'NOMBRES')->getStyle('C2')->getFont()->setSize(15)->setBold(true);
        $hoja->setCellValue('D2', 'APELLIDOS')->getStyle('D2')->getFont()->setSize(15)->setBold(true);
        $hoja->setCellValue('E2', 'NÚMERO TRAMITE')->getStyle('G2')->getFont()->setSize(15)->setBold(true);
        $hoja->setCellValue('F2', 'NÚMERO DE EXPEDIENTE')->getStyle('H2')->getFont()->setSize(15)->setBold(true);
        $hoja->setCellValue('G2', 'ESTADO')->getStyle('I2')->getFont()->setSize(15)->setBold(true);
        $hoja->setCellValue('H2', 'ESPECIALISTA')->getStyle('J2')->getFont()->setSize(15)->setBold(true);
        $hoja->setCellValue('I2', ($convocatoria->con_tipo == 2 ? "" : "ORDEN DE MERITO"))->getStyle('E2')->getFont()->setSize(15)->setBold(true);
        $hoja->setCellValue('J2', 'PUNTAJE')->getStyle('F2')->getFont()->setSize(15)->setBold(true);
        $hoja->setCellValue('K2', 'OBSERVACIÓN')->getStyle('K2')->getFont()->setSize(15)->setBold(true);
        $hoja->setCellValue('L2', 'ESPECIALIDAD DEL DOCENTE (ETP)')->getStyle('L2')->getFont()->setSize(15)->setBold(true);
        if ($convocatoria->con_tipo == 2) {
            $hoja->setCellValue('M2', 'PRELACIÓN')->getStyle('M2')->getFont()->setSize(15)->setBold(true);
        }

     // $hoja->setAutoFilter('A:L');
        $hoja->getStyle('A2:M2')->getFill()->getStartColor()->setRGB('FF0000');

        $hoja->getColumnDimension('A')->setAutoSize(true);
        $hoja->getColumnDimension('B')->setAutoSize(true);
        $hoja->getColumnDimension('C')->setAutoSize(true);
        $hoja->getColumnDimension('D')->setAutoSize(true);
        $hoja->getColumnDimension('E')->setAutoSize(true);
        $hoja->getColumnDimension('F')->setAutoSize(true);
        $hoja->getColumnDimension('G')->setAutoSize(true);
        $hoja->getColumnDimension('H')->setAutoSize(true);
        $hoja->getColumnDimension('I')->setAutoSize(true);
        $hoja->getColumnDimension('J')->setAutoSize(true);
        $hoja->getColumnDimension('K')->setAutoSize(true);
        $hoja->getColumnDimension('L')->setAutoSize(true);
        if ($convocatoria->con_tipo == 2) {
            $hoja->getColumnDimension('M')->setAutoSize(true);
        }
        $cont = 3;

        foreach ($records as $fila) {
            $apellidos = $fila->apellido_paterno . ' ' . $fila->apellido_materno;
            $especialista = $fila->usu_nombre . ' ' . $fila->usu_apellidos;
            $inscripcion = $fila->modalidad_abreviatura . " " . $fila->nivel_descripcion . ($fila->especialidad_descripcion != "-" ? " " . $fila->especialidad_descripcion : "") ;
            $cpe_orden = $convocatoria->con_tipo == 2 ? "" : $fila->cpe_orden;
            $hoja->getStyle('A' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('A' . $cont, $inscripcion, PHPExcel_Cell_DataType::TYPE_STRING);

            $hoja->getStyle('B' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('B' . $cont, $fila->numero_documento);

            $hoja->getStyle('C' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('C' . $cont, $fila->nombre);

            $hoja->getStyle('D' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('D' . $cont, $apellidos);
 
            $hoja->getStyle('E' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('E' . $cont, $fila->uid, PHPExcel_Cell_DataType::TYPE_STRING);
            
            $hoja->getStyle('F' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('F' . $cont, $fila->numero_expediente, PHPExcel_Cell_DataType::TYPE_STRING);
            
            $hoja->getStyle('G' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('G' . $cont, $fila->prerequisito_estado_texto, PHPExcel_Cell_DataType::TYPE_STRING);

            $hoja->getStyle('H' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('H' . $cont, $especialista, PHPExcel_Cell_DataType::TYPE_STRING);
           
            $hoja->getStyle('I' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('I' . $cont, $cpe_orden);

            $hoja->getStyle('J' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('J' . $cont, $fila->puntaje);

            $hoja->getStyle('K' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('K' . $cont, $fila->prerequisito_observacion, PHPExcel_Cell_DataType::TYPE_STRING);

            $hoja->getStyle('L' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('L' . $cont, $fila->prerequisito_especialidad, PHPExcel_Cell_DataType::TYPE_STRING);

            if ($convocatoria->con_tipo == 2) {
                $hoja->getStyle('M' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $hoja->setCellValue('M' . $cont, $fila->prelacion, PHPExcel_Cell_DataType::TYPE_STRING);    
            }
            $cont++;
        }

        $filename = $ficha . '.xls'; //save our workbook as this file name

        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        //force user to download the Excel file without writing it to server's HD
        //force user to download the Excel file without writing it to server's HD
        /* Obtenemos los caracteres adicionales o mensajes de advertencia y los
            guardamos en el archivo "depuracion.txt" si tenemos permisos */
        file_put_contents('depuracion.txt', ob_get_contents());
        /* Limpiamos el búfer */
        ob_end_clean();

        $objWriter->save('php://output');
    }

    public function generar_reporte_excel_2($data, $ficha = null) {
        $records = $data['records'];
        $convocatoria = $data['convocatoria'];
        $ficha = $ficha ? $ficha : 'REPORTE_DE_EVALUACIÓN';
        // echo json_encode($records); exit;
        // echo json_encode($records[0]->anexo_plantilla->sections); exit;
        /* A partir de ahora cualquier salida al navegador se guardarÃ¡ en un buffer */
        /* Obtenemos el listado de locales disponibles en el sistema */
        file_put_contents('log.txt', shell_exec('locale -a'), FILE_APPEND);
        set_time_limit(0);
        setlocale(LC_ALL, 'es_ES');
        $fecha = date('d/m/Y H:i:s');
        ini_set('memory_limit', '-1');
        // $datos = null;
        // $datos = $this->gestion->listar_reporte_horas();
    
        $this->load->library('excel');

        $hoja = $this->excel->getActiveSheet();

            //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
            //name the worksheet
        $hoja->setTitle('Reporte.');
        //set cell A1 content with some text
        $hoja->setCellValue('A1', 'REPORTE GENERAL ' . $fecha);
        //change the font size
        $hoja->getStyle('A1')->getFont()->setSize(24);
        //make the font become bold
        $hoja->getStyle('A1')->getFont()->setBold(true);
        //merge cell A1 until D1
        $hoja->mergeCells('A1:M1');
        //set aligment to center for that merged cell (A1 to D1)

        $hoja->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('E2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('F2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('G2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('H2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('I2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('K2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        if ($convocatoria->con_tipo == 2) {
            $hoja->getStyle('M2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        }

        $hoja->getStyle('N2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('O2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('P2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('Q2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $hoja->setCellValue('A2', 'INSCRIPCIÓN')->getStyle('A2')->getFont()->setSize(15)->setBold(true);
        $hoja->setCellValue('B2', 'DNI')->getStyle('B2')->getFont()->setSize(15)->setBold(true);
        $hoja->setCellValue('C2', 'NOMBRES')->getStyle('C2')->getFont()->setSize(15)->setBold(true);
        $hoja->setCellValue('D2', 'APELLIDOS')->getStyle('D2')->getFont()->setSize(15)->setBold(true);
        $hoja->setCellValue('E2', 'NÚMERO TRAMITE')->getStyle('G2')->getFont()->setSize(15)->setBold(true);
        $hoja->setCellValue('F2', 'NÚMERO DE EXPEDIENTE')->getStyle('H2')->getFont()->setSize(15)->setBold(true);
        $hoja->setCellValue('G2', 'ESTADO')->getStyle('I2')->getFont()->setSize(15)->setBold(true);
        $hoja->setCellValue('H2', 'ESPECIALISTA')->getStyle('J2')->getFont()->setSize(15)->setBold(true);
        $hoja->setCellValue('I2', ($convocatoria->con_tipo == 2 ? "" : "ORDEN DE MERITO"))->getStyle('E2')->getFont()->setSize(15)->setBold(true);
        $hoja->setCellValue('J2', 'PUNTAJE')->getStyle('F2')->getFont()->setSize(15)->setBold(true);
        $hoja->setCellValue('K2', 'OBSERVACIÓN')->getStyle('K2')->getFont()->setSize(15)->setBold(true);
        $hoja->setCellValue('L2', 'ESPECIALIDAD DEL DOCENTE (ETP)')->getStyle('L2')->getFont()->setSize(15)->setBold(true);
        if ($convocatoria->con_tipo == 2) {
            $hoja->setCellValue('M2', 'PRELACIÓN')->getStyle('M2')->getFont()->setSize(15)->setBold(true);
        }
        $hoja->setCellValue('N2', 'FORMACIÓN ACADEMICA Y PROFESIONAL')->getStyle('N2')->getFont()->setSize(15)->setBold(true);
        $hoja->setCellValue('O2', 'FORMACIÓN CONTINUA')->getStyle('O2')->getFont()->setSize(15)->setBold(true);
        $hoja->setCellValue('P2', 'EXPERIENCIA LABORAL')->getStyle('P2')->getFont()->setSize(15)->setBold(true);
        $hoja->setCellValue('Q2', 'MERITOS')->getStyle('Q2')->getFont()->setSize(15)->setBold(true);

     // $hoja->setAutoFilter('A:L');
        $hoja->getStyle('A2:Q2')->getFill()->getStartColor()->setRGB('FF0000');

        $hoja->getColumnDimension('A')->setAutoSize(true);
        $hoja->getColumnDimension('B')->setAutoSize(true);
        $hoja->getColumnDimension('C')->setAutoSize(true);
        $hoja->getColumnDimension('D')->setAutoSize(true);
        $hoja->getColumnDimension('E')->setAutoSize(true);
        $hoja->getColumnDimension('F')->setAutoSize(true);
        $hoja->getColumnDimension('G')->setAutoSize(true);
        $hoja->getColumnDimension('H')->setAutoSize(true);
        $hoja->getColumnDimension('I')->setAutoSize(true);
        $hoja->getColumnDimension('J')->setAutoSize(true);
        $hoja->getColumnDimension('K')->setAutoSize(true);
        $hoja->getColumnDimension('L')->setAutoSize(true);
        if ($convocatoria->con_tipo == 2) {
            $hoja->getColumnDimension('M')->setAutoSize(true);
        }
        $hoja->getColumnDimension('N')->setAutoSize(true);
        $hoja->getColumnDimension('O')->setAutoSize(true);
        $hoja->getColumnDimension('P')->setAutoSize(true);
        $hoja->getColumnDimension('Q')->setAutoSize(true);
        $cont = 3;

        foreach ($records as $fila) {
            $apellidos = $fila->apellido_paterno . ' ' . $fila->apellido_materno;
            $especialista = $fila->usu_nombre . ' ' . $fila->usu_apellidos;
            $inscripcion = $fila->modalidad_abreviatura . " " . $fila->nivel_descripcion . ($fila->especialidad_descripcion != "-" ? " " . $fila->especialidad_descripcion : "") ;
            $cpe_orden = $convocatoria->con_tipo == 2 ? "" : $fila->cpe_orden;
            $hoja->getStyle('A' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('A' . $cont, $inscripcion, PHPExcel_Cell_DataType::TYPE_STRING);

            $hoja->getStyle('B' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('B' . $cont, $fila->numero_documento);

            $hoja->getStyle('C' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('C' . $cont, $fila->nombre);

            $hoja->getStyle('D' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('D' . $cont, $apellidos);
 
            $hoja->getStyle('E' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('E' . $cont, $fila->uid, PHPExcel_Cell_DataType::TYPE_STRING);
            
            $hoja->getStyle('F' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('F' . $cont, $fila->numero_expediente, PHPExcel_Cell_DataType::TYPE_STRING);
            
            $hoja->getStyle('G' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('G' . $cont, $fila->prerequisito_estado_texto, PHPExcel_Cell_DataType::TYPE_STRING);

            $hoja->getStyle('H' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('H' . $cont, $especialista, PHPExcel_Cell_DataType::TYPE_STRING);
           
            $hoja->getStyle('I' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('I' . $cont, $cpe_orden);

            $hoja->getStyle('J' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('J' . $cont, $fila->puntaje);

            $hoja->getStyle('K' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('K' . $cont, $fila->prerequisito_observacion, PHPExcel_Cell_DataType::TYPE_STRING);

            $hoja->getStyle('L' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('L' . $cont, $fila->prerequisito_especialidad, PHPExcel_Cell_DataType::TYPE_STRING);

            if ($convocatoria->con_tipo == 2) {
                $hoja->getStyle('M' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $hoja->setCellValue('M' . $cont, $fila->prelacion, PHPExcel_Cell_DataType::TYPE_STRING);    
            }

            $anexo_plantilla = $fila->anexo_plantilla;
            // formacion academica

            $puntaje_1 = 0;
            $puntaje_2 = 0;
            $puntaje_3 = 0;
            $puntaje_4 = 0;

            if ($anexo_plantilla) {
                if ($anexo_plantilla->sections) {
                    $sections = $anexo_plantilla->sections;
                    if (isset($sections[0])) {
                        $groups = $sections[0]->groups;
                        if ($groups) {
                            foreach ($groups as $key => $group) {
                                $questions = $group->questions;
                                foreach ($questions as $key => $question) {
                                    $puntaje_1 += floatval($question->value);
                                }
                            }
                        }
                    }
                    if (isset($sections[1])) {
                        $groups = $sections[1]->groups;
                        if ($groups) {
                            foreach ($groups as $key => $group) {
                                $questions = $group->questions;
                                foreach ($questions as $key => $question) {
                                    $puntaje_2 += floatval($question->value);
                                }
                            }
                        }
                    }
                    if (isset($sections[2])) {
                        $groups = $sections[2]->groups;
                        if ($groups) {
                            foreach ($groups as $key => $group) {
                                $questions = $group->questions;
                                foreach ($questions as $key => $question) {
                                    $puntaje_3 += floatval($question->value);
                                }
                            }
                        }
                    }
                    if (isset($sections[3])) {
                        $groups = $sections[3]->groups;
                        if ($groups) {
                            foreach ($groups as $key => $group) {
                                $questions = $group->questions;
                                foreach ($questions as $key => $question) {
                                    $puntaje_4 += floatval($question->value);
                                }
                            }
                        }
                    }
                }
            }

            $hoja->getStyle('N' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('N' . $cont, $puntaje_1);

            // formacion continua

            $hoja->getStyle('O' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('O' . $cont, $puntaje_2);

            // experiencia

            $hoja->getStyle('P' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('P' . $cont, $puntaje_3);

            // meritos

            $hoja->getStyle('Q' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('Q' . $cont, $puntaje_4);


            $cont++;
        }

        $filename = $ficha . '.xls'; //save our workbook as this file name

        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        //force user to download the Excel file without writing it to server's HD
        //force user to download the Excel file without writing it to server's HD
        /* Obtenemos los caracteres adicionales o mensajes de advertencia y los
            guardamos en el archivo "depuracion.txt" si tenemos permisos */
        file_put_contents('depuracion.txt', ob_get_contents());
        /* Limpiamos el búfer */
        ob_end_clean();

        $objWriter->save('php://output');
    }
}
