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
        $usuarios    = $this->input->post("usuarios",true);
        $convId     = $this->input->post("convId",true);
        $ar_insert = [];
        $ar_update = [];

        // Obtener la cantidad de usuarios y calcular la asignación equitativa
        $numUsuarios = count($usuarios);

        // Distribuir las asignaciones entre los usuarios de manera alternada
        $usuarioIndex = 0;

        for ($i=0; $i <count($cadena) ; $i++) { 
            $arreglo    = explode("||",$cadena[$i]);     
            $idCpu      = $arreglo[0];
            $idEpu      = $arreglo[1];           

        // Obtener el usuario actual para la asignación
        $usuarioActual = $usuarios[$usuarioIndex];

            if($idEpu == 0){ // no tiene asignacion              
                $arr_1 = array(                       
                    "epe_tipoevaluacion"        => 1, // 1: PRELIMINAR
                    "epe_especialistaAsignado"  => $usuarioActual,                    
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
                    "epe_especialistaAsignado"  => $usuarioActual,
                    "epe_fechaAsignacion"       => date("Y-m-d H:i:s"),
                    "epe_fechaModificacion"     => date("Y-m-d H:i:s")
                );
                array_push($ar_update, $arr_2);
            }

            $usuarioIndex = ($usuarioIndex + 1) % $numUsuarios;

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
        $this->layout->js(array(
            // base_url()."public/js/myscript/evaluacion/ficha.js?t=".date("mdYHis"),
            base_url()."public/js/myscript/evaluacion/guide.js?v=".date("mdYHis")));
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
    
    public function procesar_expedientes_nocumplen($convocatoria_id, $inscripcion_id){

        if ($convocatoria_id > 0 && $inscripcion_id > 0) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->evaluacion_model->procesarExpedientesPreliminarNoCumpleFinal($convocatoria_id, $inscripcion_id)));
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
            // base_url()."public/js/myscript/evaluacion/ficha.js?t=".date("mdYHis"),
            base_url()."public/js/myscript/evaluacion/guide.js?v=".date("mdYHis")
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
        $this->reporte_excel_2($convocatoria_id, -1 , 'finalizado', 'FICHA_FINAL');
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
        $this->generar_reporte_excel_2($response['data'], $ficha, $estado);
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
        $hoja->setCellValue('A2', 'NÚMERO DE EXPEDIENTE')->getStyle('A2')->getFont()->setSize(15)->setBold(true);
        $hoja->setCellValue('B2', 'INSCRIPCIÓN')->getStyle('B2')->getFont()->setSize(15)->setBold(true);
        $hoja->setCellValue('C2', 'DNI')->getStyle('C2')->getFont()->setSize(15)->setBold(true);
        $hoja->setCellValue('D2', 'NOMBRES')->getStyle('D2')->getFont()->setSize(15)->setBold(true);
        $hoja->setCellValue('E2', 'APELLIDOS')->getStyle('E2')->getFont()->setSize(15)->setBold(true);
        $hoja->setCellValue('F2', 'ESPECIALISTA')->getStyle('F2')->getFont()->setSize(15)->setBold(true);
        if ($convocatoria->con_tipo == 2) {
            $hoja->setCellValue('G2', 'PRELACIÓN')->getStyle('G2')->getFont()->setSize(15)->setBold(true);
        }
        $hoja->setCellValue('H2', 'NÚMERO TRAMITE')->getStyle('H2')->getFont()->setSize(15)->setBold(true);
        $hoja->setCellValue('I2', 'ESTADO')->getStyle('I2')->getFont()->setSize(15)->setBold(true);
        $hoja->setCellValue('J2', ($convocatoria->con_tipo == 2 ? "" : "ORDEN DE MERITO"))->getStyle('J2')->getFont()->setSize(15)->setBold(true);
        $hoja->setCellValue('K2', 'PUNTAJE')->getStyle('K2')->getFont()->setSize(15)->setBold(true);
        $hoja->setCellValue('L2', 'OBSERVACIÓN')->getStyle('L2')->getFont()->setSize(15)->setBold(true);
        $hoja->setCellValue('M2', 'ESPECIALIDAD DEL DOCENTE (ETP)')->getStyle('M2')->getFont()->setSize(15)->setBold(true);


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
            $hoja->setCellValue('A' . $cont, $fila->numero_expediente, PHPExcel_Cell_DataType::TYPE_STRING);
            
            $hoja->getStyle('B' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('B' . $cont, $inscripcion, PHPExcel_Cell_DataType::TYPE_STRING);

            $hoja->getStyle('C' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('C' . $cont, $fila->numero_documento);

            $hoja->getStyle('D' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('D' . $cont, $fila->nombre);

            $hoja->getStyle('E' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('E' . $cont, $apellidos);

            $hoja->getStyle('F' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('F' . $cont, $especialista, PHPExcel_Cell_DataType::TYPE_STRING);
           
            if ($convocatoria->con_tipo == 2) {
                $hoja->getStyle('G' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $hoja->setCellValue('G' . $cont, $fila->prelacion, PHPExcel_Cell_DataType::TYPE_STRING);    
            }
 
            $hoja->getStyle('H' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('H' . $cont, $fila->uid, PHPExcel_Cell_DataType::TYPE_STRING);

            $hoja->getStyle('I' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('I' . $cont, $fila->prerequisito_estado_texto, PHPExcel_Cell_DataType::TYPE_STRING);

            $hoja->getStyle('J' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('J' . $cont, $cpe_orden);

            $hoja->getStyle('K' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('K' . $cont, $fila->puntaje);

            $hoja->getStyle('L' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('L' . $cont, $fila->prerequisito_observacion, PHPExcel_Cell_DataType::TYPE_STRING);

            $hoja->getStyle('M' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('M' . $cont, $fila->prerequisito_especialidad, PHPExcel_Cell_DataType::TYPE_STRING);

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

    public function generar_reporte_excel_2($data, $ficha = null, $estado) {
        $records = $data['records'];
        $convocatoria = $data['convocatoria'];
        $ficha = $ficha ? $ficha : 'REPORTE_DE_EVALUACIÓN';
        file_put_contents('log.txt', shell_exec('locale -a'), FILE_APPEND);
        set_time_limit(0);
        setlocale(LC_ALL, 'es_ES');
        $fecha = date('d/m/Y H:i:s');
        ini_set('memory_limit', '-1');

        $this->load->library('excel');

        $hoja = $this->excel->getActiveSheet();

            //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
            //name the worksheet
        $hoja->setTitle('Reporte.');

        $hoja->mergeCells('A1:U1'); 

        // Add image
        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setName('Logo');
        $objDrawing->setDescription('Logo');
        $objDrawing->setPath('./assets/image/logo_excel.png'); // Path to your logo file
        $objDrawing->setHeight(50); // Set the height of the image
        $objDrawing->setCoordinates('B1'); // Positioning

        // Calculate the horizontal offset to center the image
        $columnWidths = 0;
        for ($col = 'A'; $col <= 'T'; $col++) {
            $columnWidths += $hoja->getColumnDimension($col)->getWidth();
        }
        $offsetX = ($columnWidths * 0) / 2; // Estimate offset (6 pixels per column width unit)
        $objDrawing->setOffsetX($offsetX); // Set horizontal offset
        $objDrawing->setWorksheet($hoja);

        // Adjust row height
        $hoja->getRowDimension('1')->setRowHeight(70);
        $hoja = $this->excel->getActiveSheet();

        //activate worksheet number 1
        if ($estado == 'revisado') {
            $orden = 'PRELIMINAR';
        }
        if ($estado == 'finalizado') {
            $orden = 'FINAL';
        }
        $this->excel->setActiveSheetIndex(0);
           //name the worksheet
       $hoja->setTitle('Reporte.');
       //set cell A1 content with some text
       $hoja->setCellValue('A2', 'CONTRATO DOCENTE PERIODO 2024  ' . ' - ' . ' ORDEN DE MÉRITO ' . $orden);
       //change the font size
       $hoja->getStyle('A2')->getFont()->setSize(24);
       //make the font become bold
       $hoja->getStyle('A2')->getFont()->setBold(true);
       //merge cell A1 until D1
       $hoja->mergeCells('A2:U2');
       $hoja->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


        // Center align headers
    $headerColumns = range('A', 'U');
    foreach ($headerColumns as $column) {
        $hoja->getStyle($column . '3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    }

    
       //set aligment to center for that merged cell (A1 to D1)

        $hoja->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('E3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('F3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        if ($convocatoria->con_tipo == 2) {
        $hoja->getStyle('G2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      } 
      
        $hoja->getStyle('H3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('I3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('J3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('K3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('L3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('M3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      

        $hoja->getStyle('N3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('O3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('P3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('Q3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $hoja->getStyle('R3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('S3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('T3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $hoja->getStyle('U3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $hoja->setCellValue('A3', 'NÚMERO DE EXPEDIENTE')->getStyle('A3')->getFont()->setSize(15)->setBold(true);
        $hoja->setCellValue('B3', 'INSCRIPCIÓN')->getStyle('B3')->getFont()->setSize(15)->setBold(true);
        $hoja->setCellValue('C3', 'DNI')->getStyle('C3')->getFont()->setSize(15)->setBold(true);
        $hoja->setCellValue('D3', 'NOMBRES')->getStyle('D3')->getFont()->setSize(15)->setBold(true);
        $hoja->setCellValue('E3', 'APELLIDOS')->getStyle('E3')->getFont()->setSize(15)->setBold(true);
        $hoja->setCellValue('F3', 'ESPECIALISTA')->getStyle('F3')->getFont()->setSize(15)->setBold(true);

        if ($convocatoria->con_tipo == 2) {
            $hoja->setCellValue('G3', 'PRELACIÓN')->getStyle('G3')->getFont()->setSize(15)->setBold(true);
        }
            $hoja->setCellValue('H3', 'NÚMERO TRAMITE')->getStyle('H3')->getFont()->setSize(15)->setBold(true);
            $hoja->setCellValue('I3', 'ESTADO')->getStyle('I3')->getFont()->setSize(15)->setBold(true);
            $hoja->setCellValue('J3', ($convocatoria->con_tipo == 2 ? "" : "ORDEN DE MERITO"))->getStyle('J3')->getFont()->setSize(15)->setBold(true);
            $hoja->setCellValue('K3', 'PUNTAJE')->getStyle('K3')->getFont()->setSize(15)->setBold(true);
            $hoja->setCellValue('L3', 'OBSERVACIÓN')->getStyle('L3')->getFont()->setSize(15)->setBold(true);
            $hoja->setCellValue('M3', 'ESPECIALIDAD DEL DOCENTE (ETP)')->getStyle('M3')->getFont()->setSize(15)->setBold(true);
            $hoja->setCellValue('N3', 'FORMACIÓN ACADEMICA Y PROFESIONAL')->getStyle('N3')->getFont()->setSize(15)->setBold(true);
            $hoja->setCellValue('O3', 'FORMACIÓN CONTINUA')->getStyle('O3')->getFont()->setSize(15)->setBold(true);
            $hoja->setCellValue('P3', 'EXPERIENCIA LABORAL')->getStyle('P3')->getFont()->setSize(15)->setBold(true);
            $hoja->setCellValue('Q3', 'MERITOS')->getStyle('Q3')->getFont()->setSize(15)->setBold(true);
            $hoja->setCellValue('R3', 'BONIFICACION')->getStyle('R3')->getFont()->setSize(15)->setBold(true);
            $hoja->setCellValue('S3', 'ORDEN DE MÉRITO LOCAL')->getStyle('S3')->getFont()->setSize(15)->setBold(true);
            
            if ($convocatoria->con_tipo == 2) {
                $hoja->setCellValue('T3', 'ABSOLUCION DE RECLAMO')->getStyle('T3')->getFont()->setSize(15)->setBold(true);
            }
        
            $hoja->setCellValue('U3', 'PUNTAJE PARCIAL')->getStyle('U3')->getFont()->setSize(15)->setBold(true);        
            // $hoja->setAutoFilter('A:L');
            $hoja->getStyle('A3:U3')->getFill()->getStartColor()->setRGB('FF0000');

            $hoja->getColumnDimension('A')->setAutoSize(true);
            $hoja->getColumnDimension('B')->setAutoSize(true);
            $hoja->getColumnDimension('C')->setAutoSize(true);
            $hoja->getColumnDimension('D')->setAutoSize(true);
            $hoja->getColumnDimension('E')->setAutoSize(true);
            $hoja->getColumnDimension('F')->setAutoSize(true);
            if ($convocatoria->con_tipo == 2) {
                $hoja->getColumnDimension('G')->setAutoSize(true);
            }
        
            $hoja->getColumnDimension('H')->setAutoSize(true);
            $hoja->getColumnDimension('I')->setAutoSize(true);
            $hoja->getColumnDimension('J')->setAutoSize(true);
            $hoja->getColumnDimension('K')->setAutoSize(true);
            $hoja->getColumnDimension('L')->setAutoSize(true);
            $hoja->getColumnDimension('M')->setAutoSize(true);
    
            $hoja->getColumnDimension('N')->setAutoSize(true);
            $hoja->getColumnDimension('O')->setAutoSize(true);
            $hoja->getColumnDimension('P')->setAutoSize(true);
            $hoja->getColumnDimension('Q')->setAutoSize(true);
            $hoja->getColumnDimension('R')->setAutoSize(true);
            $hoja->getColumnDimension('S')->setAutoSize(true);
     
            if ($convocatoria->con_tipo == 2) {
                $hoja->getColumnDimension('T')->setAutoSize(true);
            }
            $hoja->getColumnDimension('U')->setAutoSize(true);
            $cont = 4;
            
            foreach ($records as $fila) {
                $apellidos = $fila->apellido_paterno . ' ' . $fila->apellido_materno;
                $especialista = $fila->usu_nombre . ' ' . $fila->usu_apellidos;
                $inscripcion = $fila->modalidad_abreviatura . " " . $fila->nivel_descripcion . ($fila->especialidad_descripcion != "-" ? " " . $fila->especialidad_descripcion : "") ;
                $cpe_orden = $convocatoria->con_tipo == 2 ? "" : $fila->cpe_orden;

                        
                $hoja->getStyle('A' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $hoja->setCellValue('A' . $cont, $fila->numero_expediente, PHPExcel_Cell_DataType::TYPE_STRING);
            

                $hoja->getStyle('B' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $hoja->setCellValue('B' . $cont, $inscripcion, PHPExcel_Cell_DataType::TYPE_STRING);

                $hoja->getStyle('C' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $hoja->setCellValue('C' . $cont, $fila->numero_documento);

                $hoja->getStyle('D' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $hoja->setCellValue('D' . $cont, $fila->nombre);

                $hoja->getStyle('E' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $hoja->setCellValue('E' . $cont, $apellidos);
    
                $hoja->getStyle('F' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $hoja->setCellValue('F' . $cont, $especialista, PHPExcel_Cell_DataType::TYPE_STRING);

                
                if ($convocatoria->con_tipo == 2) {
                    $hoja->getStyle('G' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $hoja->setCellValue('G' . $cont, $fila->prelacion, PHPExcel_Cell_DataType::TYPE_STRING);    
                }

                $hoja->getStyle('H' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $hoja->setCellValue('H' . $cont, $fila->uid, PHPExcel_Cell_DataType::TYPE_STRING);

                $hoja->getStyle('I' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $hoja->setCellValue('I' . $cont, $fila->prerequisito_estado_texto, PHPExcel_Cell_DataType::TYPE_STRING);

                $hoja->getStyle('J' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $hoja->setCellValue('J' . $cont, $cpe_orden);

                $hoja->getStyle('K' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $hoja->setCellValue('K' . $cont, $fila->puntaje);

                $hoja->getStyle('L' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $hoja->setCellValue('L' . $cont, $fila->prerequisito_observacion, PHPExcel_Cell_DataType::TYPE_STRING);

                $hoja->getStyle('M' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $hoja->setCellValue('M' . $cont, $fila->prerequisito_especialidad, PHPExcel_Cell_DataType::TYPE_STRING);

        

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

                
                // meritos
                $hoja->getStyle('R' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $hoja->setCellValue('R' . $cont, $fila->bonificacion != '' ? $fila->bonificacion . '%' :'');

                $hoja->getStyle('S' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $hoja->setCellValue('S' . $cont, $fila->cuadro_control);

                if ($convocatoria->con_tipo == 2) {
                    $hoja->getStyle('T' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $hoja->setCellValue('T' . $cont, $fila->prerequisito_absolucion, PHPExcel_Cell_DataType::TYPE_STRING);    
                }

                $hoja->getStyle('U' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('U' . $cont, $fila->puntaje_parcial);
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
