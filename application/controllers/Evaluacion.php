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
            foreach ($datos as $key_1 => $dato) {
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



            }
            $this->layout->js(array(base_url()."public/js/myscript/evaluacion/grupos.js?t=".date("mdYHis")));
		    $this->layout->view("convocatoria/grupos/grupos", compact('datos')); 
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
                    $datos    = $this->evaluacion_model->listarCuadroPunxIdGrupoEnviadoEvaluacionPreliminarV2($convId);
                }else{// 0: por especialista
                    $datos    = $this->evaluacion_model->listarCuadroPunxIdGrupoEnviadoEvaluacionPreliminarxUsuarioV2($convId, $usuario);
                }
                // writer($datos);
                foreach ($datos as $key_1 => $dato) {
                    /*$idCpu = $dato['cpe_id'];
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
                    }*/
                }
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
        $contador =  $this->evaluacion_model->contarEspecialistasAsignadosaPunxConvocatoriaPreliminar($ar_idGin);

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
                    "cuadro_pun_exp_cpe_id"         => $idCpu
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


        $datos = $this->evaluacion_model->verFichaEvaluacion(); 
     
        $this->layout->js(array(base_url()."public/js/myscript/evaluacion/ficha.js?t=".date("mdYHis"),
        base_url()."public/js/myscript/evaluacion/guide.js?t=".date("mdYHis")));
        $this->layout->view("ficha/ficha", compact('datos')); 

       
	}
    

    













}
