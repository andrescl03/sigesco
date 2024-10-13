<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ALL ^ E_NOTICE);

class ConvocatoriasAuxiliar extends CI_Controller {

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
        $this->load->model("auxiliares/convocatorias_auxiliar_model");
        $this->load->model("auxiliares/configuracion_auxiliar_model");
        $this->load->model("mesadepartes_model");
		date_default_timezone_set('America/Lima');
	}

    public function listar(){   // TIENE SOLO 2 SEGMENTOS
        /*if(!in_array($this->uri->slash_segment(1).$this->uri->segment(2), $this->session->userdata("sigesco_rutas"))){            
            redirect(base_url()."inicio/index",'refresh');
        }        
        if (!empty($this->uri->segment(3))) redirect(base_url()."convocatorias/listar", 'refresh');*/

        $periodos   = $this->configuracion_auxiliar_model->listarPeriodosActivos();
        $procesos   = $this->configuracion_auxiliar_model->listarProcesosActivos();
        $this->layout->js(array(base_url()."public/admin/auxiliares/convocatorias/listar.js?t=".date("mdYHis")));
		$this->layout->view("/admin/auxiliares/convocatorias/listar", compact('periodos', 'procesos')); 
	}



    public function VListarConvocatoriasActivas(){
        $tipoCarga  = $this->input->post("tipoCarga",true); 
        if ($tipoCarga == 0){ // carga default
            $idPer = $this->session->userdata("sigesco_default_periodo");
            $idPro = 2; // $this->session->userdata("sigesco_default_proceso");
        }else{
            $idPer  = $this->input->post("idPer",true);  
            $idPro  = $this->input->post("idPro",true);  
        }
        $datos  = $this->convocatorias_auxiliar_model->listarConvocatoriasActivas($idPer, $idPro); 
        $this->layout->setLayout("template_ajax");
        $this->layout->view('/admin/auxiliares/convocatorias/VListarConvocatoriasActivas', compact('datos'));
    }

    public function listarConvocatoriasAjax(){   // TIENE SOLO 2 SEGMENTOS

        $tipoCarga  = $this->input->post("tipoCarga",true); 
        if ($tipoCarga == 0){ // carga default
            $idPer = $this->session->userdata("sigesco_default_periodo");
            $idPro = 2; // $this->session->userdata("sigesco_default_proceso");
        }else{
            $idPer  = $this->input->post("idPer",true);  
            $idPro  = $this->input->post("idPro",true);  
        }

        $response = array(
            'status' => 200,
            'message' => 'Success',
            'convocatorias' => $this->convocatorias_auxiliar_model->listarConvocatoriasActivas($idPer,$idPro),
        );

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));

	}


    public function VListarConvocatorias(){
        $tipoCarga  = $this->input->post("tipoCarga",true);       

        if ($tipoCarga == 0){ // carga default
            $idPer = $this->session->userdata("sigesco_default_periodo");
            $idPro = 2; // $this->session->userdata("sigesco_default_proceso");
        }else{
            $idPer  = $this->input->post("idPer",true);  
            $idPro  = $this->input->post("idPro",true);  
        }

        $datos  = $this->convocatorias_auxiliar_model->listarConvocatoriasTodas($idPer, $idPro);     
        $this->layout->setLayout("template_ajax");
        $this->layout->view('/admin/auxiliares/convocatorias/VListarConvocatorias', compact('datos'));
    }

    public function vnuevaconvocatoria()
    {
        $update  = $this->input->post("update", true);
        $periodos   = $this->configuracion_auxiliar_model->listarPeriodosActivos();
        $procesos   = $this->configuracion_auxiliar_model->listarProcesosActivos();
        $tipos      = $this->configuracion_auxiliar_model->listarTipoConvocatoria();
        $idPer = $this->session->userdata("sigesco_default_periodo");
        $idPro = 2; // $this->session->userdata("sigesco_default_proceso");
        $grupos = $this->configuracion_auxiliar_model->listarGruposInscripcion($idPer, $idPro);
        $convocatoria_grupos = [];
        if ($update == "true") {
            $idConv = $this->input->post("idConv", true);
            $oldConvocatoria = $this->convocatorias_auxiliar_model->listarConvocatoriaxId($idConv);
            $oldConvocatoria['unix_inicio'] = $oldConvocatoria['con_fechainicio'] . ' ' . $oldConvocatoria['con_horainicio'];
            $oldConvocatoria['unix_fin'] = $oldConvocatoria['con_fechafin'] . ' ' . $oldConvocatoria['con_horafin'];
            
            $oldConvocatoria['unix_inicio_reclamo'] = $oldConvocatoria['con_fechainicio_reclamo'] . ' ' . $oldConvocatoria['con_horainicio_reclamo'];
            $oldConvocatoria['unix_fin_reclamo'] = $oldConvocatoria['con_fechafin_reclamo'] . ' ' . $oldConvocatoria['con_horafin_reclamo'];

            $convocatoria_grupos = $this->convocatorias_auxiliar_model->listarGruposInscripcionxConvocatoria($idConv);
 
         }  

        $this->layout->setLayout("template_ajax");
        $this->layout->view('/admin/auxiliares/convocatorias/VNuevaConvocatoria', compact('periodos', 'procesos', 'grupos','oldConvocatoria', 'convocatoria_grupos', 'tipos'));
    }

    public function VSelectGrupoInscripcion(){ 
        $idPer  = $this->input->post("idPer",true);
        $idPro  = $this->input->post("idPro",true);
        $grupos = $this->configuracion_auxiliar_model->listarGruposInscripcion($idPer, $idPro);      
        $this->layout->setLayout("template_ajax");
        $this->layout->view('/admin/auxiliares/convocatorias/VSelectGrupoInscripcion', compact('grupos'));
    }
    
    public function VTablaGrupoInscripcion(){
        $grupoArr   = $this->input->post("grupoArr",true);
        if(!empty($grupoArr)){
            $datos = $this->convocatorias_auxiliar_model->listarGruposInscripcionxIds($grupoArr);
        }else{
            $datos = [];
        }
        $this->layout->setLayout("template_ajax");
        $this->layout->view('/admin/auxiliares/convocatorias/VTablaGrupoInscripcion', compact('datos'));
    }

    public function CAgregarNuevaConvocatoria(){
        $id             = $this->input->post("id",true);
        $idPer          = $this->input->post("idPer",true);
        $anio           = $this->input->post("anio",true);
        $idPro          = $this->input->post("idPro",true);
        $estado         = $this->input->post("estado",true);
        $fechaDesde     = $this->input->post("fechaDesde",true);
        $fechaHasta     = $this->input->post("fechaHasta",true);
        $fechaDesdeReclamo     = $this->input->post("fechaDesdeReclamo",true);
        $fechaHastaReclamo     = $this->input->post("fechaHastaReclamo",true);
        $grupoArr       = $this->input->post("grupoArr",true);
        $idTipo         = $this->input->post("idTipo",true);

        $dateInicio     = new DateTime( $fechaDesde );
        $fechaInicio    = $dateInicio->format("Y-m-d");
        $horaInicio = $dateInicio->format( "H:i");

        $dateFin        = new DateTime( $fechaHasta );
        $fechaFin       = $dateFin->format( "Y-m-d"); 
        $horaFin  = $dateFin->format( "H:i");


        $dateInicioReclamo    = new DateTime( $fechaDesdeReclamo );
        $fechaInicioReclamo    = $dateInicioReclamo->format("Y-m-d");
        $horaInicioReclamo = $dateInicioReclamo->format( "H:i");

        $dateFinReclamo        = new DateTime( $fechaHastaReclamo );
        $fechaFinReclamo       = $dateFinReclamo->format( "Y-m-d"); 
        $horaFinReclamo  = $dateFinReclamo->format( "H:i");

        $buscar = $this->convocatorias_auxiliar_model->buscarUltimoNumero($anio);
        if(!empty($buscar)){
            $numero = $buscar['ultimoNumero'] + 1;
        }else{
            $numero = 1;
        }

        $arr_1 = array(                       
            // "con_numero"        => $numero,
            "con_anio"  	    => $anio,
            "con_fechainicio"   => $fechaInicio,
            "con_fechafin"      => $fechaFin,
            "con_horainicio"    => $horaInicio,
            "con_horafin"       => $horaFin,
            "con_fechainicio_reclamo" => $fechaInicioReclamo,
            "con_fechafin_reclamo" => $fechaFinReclamo,
            "con_horainicio_reclamo"    => $horaInicioReclamo,
            "con_horafin_reclamo"    => $horaFinReclamo,
            "con_estado"        => $estado,
            "con_tipo"          => $idTipo
        );
        $update = false;
        if ($id > 0) {
            $idCon = $id;
            $update = true;
            $this->convocatorias_auxiliar_model->actualizarConvocatoria($arr_1, ['con_id'=>$idCon]);
            $this->convocatorias_auxiliar_model->eliminarDetalleConvocatoria(['convocatorias_con_id'=>$idCon]);
        } else {
            $arr_1["con_numero"] = $numero;
            $idCon = $this->convocatorias_auxiliar_model->insertarConvocatoria($arr_1);

            if($idCon < 0){
                $mensaje["error"]   = "Error al agregar convocatoria.";
                $mensaje["estado"]  = false;
                echo json_encode($mensaje); 
                exit();
            }
        }

        $ar_insert  = [];
        for ($i=0; $i < count($grupoArr) ; $i++) { 
            $arr_2 = array(
                "convocatorias_con_id"      => $idCon,
                "grupo_inscripcion_gin_id"  => $grupoArr[$i],                
                "cde_estado"                => 1
            );
            array_push($ar_insert, $arr_2);
        }

        $insert = $this->convocatorias_auxiliar_model->insertBatchDetalleConvocatoria($ar_insert);

        if($insert >= 1){
            $mensaje["success"] = "Se ".($update ? 'actualizo':'registro')." información correctamente.";	
            $mensaje["estado"]  = true;      
        }else{
            $mensaje["error"]   = "Error al ".($update ? 'actualizar':'registrar')." información.";
            $mensaje["estado"]  = false;
        }

        echo json_encode($mensaje); 
    }

    public function cargarexpedientes($cadena = null){   // TIENE SOLO 3 SEGMENTOS
        if(!in_array($this->uri->slash_segment(1).$this->uri->segment(2), $this->session->userdata("sigesco_rutas"))){            
            redirect(base_url()."inicio/index",'refresh');
        }
        if (!empty($this->uri->segment(4))) redirect(base_url()."convocatorias/cargarexpedientes/".$cadena, 'refresh');
        if (empty($cadena)) redirect(base_url()."convocatorias/cargarexpedientes/".encryption('0||0'));

        $_cadena    = decryption($cadena); // cadena tiene 2 parametros
        $arreglo    = explode("||",$_cadena);     
        $idCon      = $arreglo[0];
        $idGin      = $arreglo[1];

        if($idCon == '0' && $idGin == '0'){
            $periodos   = $this->configuracion_auxiliar_model->listarPeriodosActivos();
            $procesos   = $this->configuracion_auxiliar_model->listarProcesosActivos();

            $this->layout->js(array(base_url()."public/admin/auxiliares/convocatorias/cargarexpedientes.js?t=".date("mdYHis")));
		    $this->layout->view("cargarexpedientes/cargarexpedientes", compact('periodos', 'procesos')); 
        }

        if($idCon != '0' && $idGin == '0'){
            $datos   = $this->convocatorias_auxiliar_model->listarGruposInscripcionxConvocatoria($idCon);
            $this->layout->js(array(base_url()."public/admin/auxiliares/convocatorias/grupos.js?t=".date("mdYHis")));
		    $this->layout->view("cargarexpedientes/grupos/grupos", compact('datos')); 
        }

        if($idCon != '0' && $idGin != '0'){
            $dato   = $this->convocatorias_auxiliar_model->listarGrupoInscripcionxConvocatoriaYEspecialidad($idCon, $idGin);
            $this->layout->js(array(base_url()."public/admin/auxiliares/convocatorias/cargar.js?t=".date("mdYHis")));
		    $this->layout->view("cargarexpedientes/cargar/cargar", compact('dato')); 
        }
	}

 

    public function VListarCargarExpedientesControlesPun(){       
        $idGin      = $this->input->post("idGin",true);             
        $this->layout->setLayout("template_ajax");
        $this->layout->view('cargarexpedientes/cargar/pun/VControlesPun', compact('datos'));
    }

    public function VListarCargarExpedientesControlesExp(){       
        $idGin      = $this->input->post("idGin",true);             
        $this->layout->setLayout("template_ajax");
        $this->layout->view('cargarexpedientes/cargar/exp/VControlesExp', compact('datos'));
    }

    public function VListarCargarExpedientesPunExp(){ 
        $tipoEval   = $this->input->post("tipoEval",true); //1: PRUEBA PUN , 2 : EVAL EXP.
        $idGin      = $this->input->post("idGin",true);
        $estado     = $this->input->post("estado",true); //0: todos, 1: sin evaluacion
        switch ($tipoEval) {
            case '1':
                /**
                 * Listar aquellos q son cpe_sepresento= 2 (quiere decir q estan en esado de registro solamente);
                 */
                if($estado==1){ // sin evaluacion
                    $datos    = $this->convocatorias_auxiliar_model->listarCuadroPunxIdGrupoSinEvaluacion($idGin);
                }else{ // todos
                    $datos    = $this->convocatorias_auxiliar_model->listarCuadroPunxIdGrupoTodos($idGin);
                }                
                foreach ($datos as $key_1 => $dato) {
                    $idCpu = $dato['cpe_id'];
                    $asignaciones = $this->convocatorias_auxiliar_model->listarAsignacionxCuadroPun($idCpu);                  
                    if(!empty($asignaciones)){
                        foreach ($asignaciones as $key_2 =>$asignacion) {
                            $datos[$key_1]['expediente'][$key_2]['idExp']   = $asignacion['exp_id'];
                            $datos[$key_1]['expediente'][$key_2]['codigo']  = $asignacion['exp_codigo'];

                            $archivos = $this->convocatorias_auxiliar_model->listarArchivosDetalle($asignacion['exp_id']);
                            
                            foreach ($archivos as $key_3 => $archivo) {
                                $datos[$key_1]['expediente'][$key_2]['archivo'][$key_3]['tipo'] = $archivo['adt_tipoArchivo'];
                                $datos[$key_1]['expediente'][$key_2]['archivo'][$key_3]['procedencia'] = $archivo['adt_procedenciaArchivo'];
                                $datos[$key_1]['expediente'][$key_2]['archivo'][$key_3]['idArch'] = $archivo['adt_id'];
                            }
                        }
                    }else{
                        $datos[$key_1]['expediente'] = [];
                    }
                }
                $this->layout->setLayout("template_ajax");
                $this->layout->view('cargarexpedientes/cargar/pun/pun', compact('datos'));
                break;
            case '2':
                if($estado==1){ // sin evaluacion
                    $datos    = $this->convocatorias_auxiliar_model->listarCuadroExpxIdGrupoSinEvaluacion($idGin);
                }else{ // todos
                    $datos    = $this->convocatorias_auxiliar_model->listarCuadroExpxIdGrupoTodos($idGin);
                }

                foreach ($datos as $key_1 => $dato) {
                    $idCpu = $dato['cpe_id'];
                    $asignaciones = $this->convocatorias_auxiliar_model->listarAsignacionxCuadroPun($idCpu);                  
                    if(!empty($asignaciones)){
                        foreach ($asignaciones as $key_2 =>$asignacion) {
                            $datos[$key_1]['expediente'][$key_2]['idExp']   = $asignacion['exp_id'];
                            $datos[$key_1]['expediente'][$key_2]['codigo']  = $asignacion['exp_codigo'];

                            $archivos = $this->convocatorias_auxiliar_model->listarArchivosDetalle($asignacion['exp_id']);
                            
                            foreach ($archivos as $key_3 => $archivo) {
                                $datos[$key_1]['expediente'][$key_2]['archivo'][$key_3]['tipo'] = $archivo['adt_tipoArchivo'];
                                $datos[$key_1]['expediente'][$key_2]['archivo'][$key_3]['procedencia'] = $archivo['adt_procedenciaArchivo'];
                                $datos[$key_1]['expediente'][$key_2]['archivo'][$key_3]['idArch'] = $archivo['adt_id'];
                            }
                        }
                    }else{
                        $datos[$key_1]['expediente'] = [];
                    }
                }   
                
                $this->layout->setLayout("template_ajax");
                $this->layout->view('cargarexpedientes/cargar/exp/exp', compact('datos'));
                break;
        }
    }

    public function VBuscarExpedientes(){
        $grupos  =   $this->mesadepartes_model->gruposTupa();

        $this->layout->setLayout("template_ajax");
        $this->layout->view('cargarexpedientes/cargar/pun/VBuscarExpedientes', compact('grupos'));
    }

    public function VComboTramites(){
        $grupo   = $this->input->post("grupo",true);
        $tramites =   $this->mesadepartes_model->tipoTramite($grupo);

        $this->layout->setLayout("template_ajax");
        $this->layout->view('cargarexpedientes/cargar/pun/VComboTramites', compact('tramites'));
    }

    public function DTExpedientes(){
        $FechaDesde = $this->input->post("FechaDesde",true);
        $FechaHasta = $this->input->post("FechaHasta",true);
        $TramiteId  = $this->input->post("TramiteId",true);
        $idGin      = $this->input->post("idGin",true);
        

        $F_inicio = new DateTime($FechaDesde);
        $F_desde=$F_inicio->format('Y-m-d');

        $F_fin = new DateTime($FechaHasta);
        $F_hasta=$F_fin->format('Y-m-d');

        $buscarDocentes = $this->convocatorias_auxiliar_model->buscarDocentesPun($idGin);
        $datos  = $this->mesadepartes_model->buscarExpedientesProcesados($F_desde, $F_hasta, $TramiteId);
        $arreglo=[];
        $i=0;
        $flag="";
        $k=0;
        foreach ($datos as $dato) { 
            $arreglo[$i]["tra_id"]=$dato->tra_id;		
            $arreglo[$i]["tra_anio"]=$dato->tra_anio;
            $arreglo[$i]["tra_numero"]=$dato->tra_numero;           
            $arreglo[$i]["tcr_id"]=$dato->tcr_id;
            $arreglo[$i]["ins_nombres"]=$dato->ins_nombres;
            $arreglo[$i]["ins_apellidos"]=$dato->ins_apellidos;
            $arreglo[$i]["ins_razonSocial"]=$dato->ins_razonSocial;
            $arreglo[$i]["ins_tipoDocumentoID"]=$dato->ins_tipoDocumentoID;
            $arreglo[$i]["ins_numeroDocumento"]=$dato->ins_numeroDocumento;
            $arreglo[$i]["ins_codigoTramite"]=$dato->ins_codigoTramite;							
            $arreglo[$i]["tcr_descripcion"]=$dato->tcr_descripcion;
            $arreglo[$i]["tra_numeroExpediente"]=$dato->tra_numeroExpediente;
            $arreglo[$i]["tra_fechaAtencion"]=$dato->tra_fechaAtencion;
            $arreglo[$i]["tra_areaDerivada"]=$dato->tra_areaDerivada;						
            $arreglo[$i]["tra_urlArchivo"]=$dato->tra_urlArchivo;
            $arreglo[$i]["tra_urlAdjunto"]=$dato->tra_urlAdjunto;
            $arreglo[$i]["tra_fechaRegistro"]=$dato->tra_fechaRegistro;
            $arreglo[$i]["tra_urlAdjunto"]=$dato->tra_urlAdjunto;
            $arreglo[$i]["tra_usuarioAtiende"]=$dato->tra_usuarioAtiende;
            $arreglo[$i]["tra_estadoProceso"]=$dato->tra_estadoProceso;

            /**
             * IMPLEMENTADO PARA VERIFICAR EL ESTADO DE LOS DOCENTES Y EXPEDEINTES
             */
            /**
             * BUSCAR SI EL EXPEDIENTES YA FUE ASIGNADO A OTRO DOCENTE...SI ES EL CASO CARGARÁ CON CHECK Y DESHABILITADO
             */
            $buscarAsignacion = $this->convocatorias_auxiliar_model->buscarAsignacionExpediente($dato->tra_anio, $dato->tra_numero);
            if(!empty($buscarAsignacion)){  
                $arreglo[$i]["chekeado"]=1;
                $arreglo[$i]["habilitado"]=0;
            }else{
                /**
                 * CASO CONTARIO BUSCAR COINCIDENCIA DE DOCUMENTOS EN EL PUN QUE SE ENCUENTREN SIN EVALUACION  ...SI ES EL CASO CARGARÁ CON CHECK Y HABILITADO
                 */ 
                $found_key = (string)array_search($dato->ins_numeroDocumento, array_column($buscarDocentes, 'cpe_documento'));    
                $key = ($found_key == null ? -1 : $found_key);
                if($key >= 0){
                    $arreglo[$i]["chekeado"]=1;
                    $arreglo[$i]["habilitado"]=1;
                }else{
                    $arreglo[$i]["chekeado"]=0;
                    $arreglo[$i]["habilitado"]=0;
                }
            }               

            $insID=$dato->inscripcion_ins_id;
            $valores=$this->mesadepartes_model->listarTramitesObservados($insID);
            
            if(!empty($valores)){
                $j=0;	
                $arreglo[$i]["total"]=count($valores)+1;						
                if($flag==$insID || $flag==""){
                    $arreglo[$i]["sub_total"]=count($valores)+1-$k;	
                    $flag=$insID;
                }else{
                    $k=0;
                    $arreglo[$i]["sub_total"]=count($valores)+1-$k;								
                    $flag="";
                }	

                foreach ($valores as $valor) {                
                    $arreglo[$i]["urlArchivo"][$j]=$valor->urlArchivo;
                    $arreglo[$i]["urlAdjunto"][$j]=$valor->urlAdjunto;
                    $j++;
                
                }
                $k++;							
            }
            $i++;					
        }

        $this->layout->setLayout("template_ajax");
        $this->layout->view('cargarexpedientes/cargar/pun/DTExpedientes', compact('arreglo'));
    }
   
    public function CAsisgnarExpedientes(){
        $expedientes    = $this->input->post("expedientes",true);
        $idGin          = $this->input->post("idGin",true);

        for ($i=0; $i < count($expedientes) ; $i++) { 
            $arrExp   = explode("||",$expedientes[$i]);
            $Anio       = $arrExp[0];
            $Numero     = $arrExp[1];            
            $buscarDocentes = $this->convocatorias_auxiliar_model->buscarDocentesPun($idGin);
            $archivosMPV   =  $this->mesadepartes_model->buscarExpedienteyDetalle($Anio, $Numero);
            if (!empty($archivosMPV)) {   // si existe en mesa de partes 
                $arrInsert  = array( 
                    "exp_numero"        => $Numero,
                    "exp_anio"          => $Anio,                    
                    "exp_codigo"        => $archivosMPV[0]['tra_numeroExpediente'],
                    "exp_remitente"     => toMayus($archivosMPV[0]['ins_nombres']." ".$archivosMPV[0]['ins_apellidos']),
                    "exp_documento"     => $archivosMPV[0]['ins_numeroDocumento'],
                    "exp_telefono1"     => $archivosMPV[0]['ins_telefono1'],
                    "exp_telefono2"     => $archivosMPV[0]['ins_telefono2'],
                    "exp_correo"        => $archivosMPV[0]['ins_correoElectronico'],
                    "exp_esprinicipal"  => 1,
                    "exp_tipo"          => 1, // 1: EVALUACION INICIAL, 2: RECLAMO
                    "exp_fechaCreacion" => date("Y-m-d H:i:s"),
                    "exp_estado"        => 1
                );  
                        
                $expId	= $this->convocatorias_auxiliar_model->insertExpediente($arrInsert);

                if ($expId<=0){ 
                    $mensaje["error"]="Error al asignar expediente.";
                    $mensaje["estado"]=false; 
                    echo json_encode($mensaje); 
                    exit();                   
                }

                $arrInsert =[];               
                foreach ($archivosMPV as $archivo) {
                    $arreglo=array(
                        "adt_nombreArchivo"         => $archivo['tra_urlAdjunto'],
                        "adt_extensionArchivo"      => strtolower(pathinfo($archivo['tra_urlAdjunto'], PATHINFO_EXTENSION)),
                        "adt_tipoArchivo"           => '1', //1: documento 2: anexo
                        "adt_procedenciaArchivo"    => '1', // 1:MPV 2:INTERNO
                        "adt_fechaCreacionArchivo"  => date("Y-m-d H:i:s"),
                        "adt_estado"                => 1,
                        "expedientes_exp_id"        => $expId
                    );

                    array_push($arrInsert,$arreglo);                             
                }

                $arreglo=array(
                    "adt_nombreArchivo"             => $archivosMPV[0]['tra_urlArchivo'],
                    "adt_extensionArchivo"          => strtolower(pathinfo($archivosMPV[0]['tra_urlArchivo'], PATHINFO_EXTENSION)),
                    "adt_tipoArchivo"               => '2', //1: documento 2: anexo
                    "adt_procedenciaArchivo"        => '1', // 1:MPV 2:INTERNO
                    "adt_fechaCreacionArchivo"      => date("Y-m-d H:i:s"),                  
                    "adt_estado"                    => 1,
                    "expedientes_exp_id"            => $expId
                );

                array_push($arrInsert,$arreglo);   

                $insertId	= $this->convocatorias_auxiliar_model->insertArchivosDetalleBatch($arrInsert);  
                if ($insertId<=0){ // NO SE HA REGISTRADO EL ARCHIVO.
                    $mensaje["error"]="Error al registar expedientes.";                         
                    $mensaje["estado"]=false; 
                    echo json_encode($mensaje); 
                    exit();                   
                }

                $arrInsert =[];
                
                $found_key = (string)array_search($archivosMPV[0]['ins_numeroDocumento'], array_column($buscarDocentes, 'cpe_documento'));    
                $key = ($found_key == null ? -1 : $found_key);
                if($key >= 0){ 
                    $arrInsert  = array( 
                        "expedientes_exp_id"    => $expId,
                        "cuadro_pun_exp_cpe_id"     => $buscarDocentes[$key]['cpe_id'],
                        "aep_tipoAsignacion"    => 1, // 1: asignacion automática, 2: asignacion manual
                        "aep_fechaCreacion"     => date("Y-m-d H:i:s"),      
                        "aep_estado"            => 1
                    );

                    $insertId	= $this->convocatorias_auxiliar_model->insertAsigancionExpedientePun($arrInsert);  
                    if ($insertId<=0){ // NO SE HA REGISTRADO EL ARCHIVO.
                        $mensaje["error"]="Error al registar expedientes.";                         
                        $mensaje["estado"]=false; 
                        echo json_encode($mensaje); 
                        exit();                   
                    }
                }
            }
        }

        if($insertId >= 1){
            $mensaje["success"] = "Se agregó expedientes correctamente.";	
            $mensaje["estado"]  = true;      
        }else{
            $mensaje["error"]   = "No se pudo agregar expedientes.";
            $mensaje["estado"]  = false;
        }

        echo json_encode($mensaje); 
    }

    public function CEnviarEvaluar(){        
        $cuadroPun  = $this->input->post("cuadroPun",true);
        $ar_update  = [];
        for ($i=0; $i < count($cuadroPun) ; $i++) {
            $arrCpu   = explode("||", $cuadroPun[$i]);
            $idCpu       = $arrCpu[0];
            $totalExp    = $arrCpu[1];   

            $arr_1= array(
                "cpe_id"                => $idCpu,
                "cpe_sepresento"        => ($totalExp==0 ? 0 : 1), //0: NO PRESENTO EXPEDIENTE 1: SI PRESENTÓ
                "cpe_enviadoeval"       => ($totalExp==0 ? 0 : 1), //0: NO SE ENVIA XQ NO TIENE EXPEDIENTES, 1: SE ENVIA XQ TIENE EXPEDIENTE
                "cpe_fechaModificacion" => date("Y-m-d H:i:s"),
            );
            array_push($ar_update, $arr_1);
        }
       
        $update=$this->convocatorias_auxiliar_model->updateBatchCuadroPun($ar_update);
        if($update > 0){
            $mensaje["success"] = "Se envió a evaluación correctamente.";	
            $mensaje["estado"]  = true;      
        }else{
            $mensaje["error"]   = "Error al enviar a evaluación.";
            $mensaje["estado"]  = false;
        }

        echo json_encode($mensaje); 
    }

    public function CQuitarAsisgnacionExpedientes(){        
        $cuadroPun  = $this->input->post("cuadroPun",true);
        $ar_update  = [];
        for ($i=0; $i < count($cuadroPun) ; $i++) {
            $arrCpu   = explode("||", $cuadroPun[$i]);
            $idCpu       = $arrCpu[0];
            $totalExp    = $arrCpu[1];

            if ($totalExp > 1){ //si tiene mas de uno, no corresponde eliminar masivo
                $mensaje["error"]="Los docentes con más de un expediente asignado, se gestionan de manera individual.";                         
                $mensaje["estado"]=false; 
                echo json_encode($mensaje); 
                exit();                   
            }

            $arr_1= array(
                "cuadro_pun_exp_cpe_id"     => $idCpu,
                "aep_fechaModificacion" => date("Y-m-d H:i:s"),
                "aep_estado"            => 0
            );
            array_push($ar_update, $arr_1);
        }
       
        $update=$this->convocatorias_auxiliar_model->updateBatchAsignacionExpedientePunxIdPun($ar_update);
        if($update > 0){
            $mensaje["success"] = "Se quitó asignación correctamente.";	
            $mensaje["estado"]  = true;      
        }else{
            $mensaje["error"]   = "Error al quitar asignación.";
            $mensaje["estado"]  = false;
        }

        echo json_encode($mensaje); 
    }

    public function VBuscarExpedientesExp(){
        $grupos  =   $this->mesadepartes_model->gruposTupa();

        $this->layout->setLayout("template_ajax");
        $this->layout->view('cargarexpedientes/cargar/exp/VBuscarExpedientesExp', compact('grupos'));
    }

    public function DTExpedientesExp(){
        $FechaDesde = $this->input->post("FechaDesde",true);
        $FechaHasta = $this->input->post("FechaHasta",true);
        $TramiteId  = $this->input->post("TramiteId",true);
        $idGin      = $this->input->post("idGin",true);
        

        $F_inicio = new DateTime($FechaDesde);
        $F_desde=$F_inicio->format('Y-m-d');

        $F_fin = new DateTime($FechaHasta);
        $F_hasta=$F_fin->format('Y-m-d');

        $buscarDocentes = $this->convocatorias_auxiliar_model->buscarDocentesExp($idGin);
        $datos  = $this->mesadepartes_model->buscarExpedientesProcesados($F_desde, $F_hasta, $TramiteId);
        $arreglo=[];
        $i=0;
        $flag="";
        $k=0;
        foreach ($datos as $dato) { 
            $arreglo[$i]["tra_id"]=$dato->tra_id;		
            $arreglo[$i]["tra_anio"]=$dato->tra_anio;
            $arreglo[$i]["tra_numero"]=$dato->tra_numero;           
            $arreglo[$i]["tcr_id"]=$dato->tcr_id;
            $arreglo[$i]["ins_nombres"]=$dato->ins_nombres;
            $arreglo[$i]["ins_apellidos"]=$dato->ins_apellidos;
            $arreglo[$i]["ins_razonSocial"]=$dato->ins_razonSocial;
            $arreglo[$i]["ins_tipoDocumentoID"]=$dato->ins_tipoDocumentoID;
            $arreglo[$i]["ins_numeroDocumento"]=$dato->ins_numeroDocumento;
            $arreglo[$i]["ins_codigoTramite"]=$dato->ins_codigoTramite;							
            $arreglo[$i]["tcr_descripcion"]=$dato->tcr_descripcion;
            $arreglo[$i]["tra_numeroExpediente"]=$dato->tra_numeroExpediente;
            $arreglo[$i]["tra_fechaAtencion"]=$dato->tra_fechaAtencion;
            $arreglo[$i]["tra_areaDerivada"]=$dato->tra_areaDerivada;						
            $arreglo[$i]["tra_urlArchivo"]=$dato->tra_urlArchivo;
            $arreglo[$i]["tra_urlAdjunto"]=$dato->tra_urlAdjunto;
            $arreglo[$i]["tra_fechaRegistro"]=$dato->tra_fechaRegistro;
            $arreglo[$i]["tra_urlAdjunto"]=$dato->tra_urlAdjunto;
            $arreglo[$i]["tra_usuarioAtiende"]=$dato->tra_usuarioAtiende;
            $arreglo[$i]["tra_estadoProceso"]=$dato->tra_estadoProceso;

            /**
             * IMPLEMENTADO PARA VERIFICAR EL ESTADO DE LOS DOCENTES Y EXPEDEINTES
             */
            /**
             * BUSCAR SI EL EXPEDIENTES YA FUE ASIGNADO A OTRO DOCENTE...SI ES EL CASO CARGARÁ CON CHECK Y DESHABILITADO
             */
            $buscarAsignacion = $this->convocatorias_auxiliar_model->buscarAsignacionExpediente($dato->tra_anio, $dato->tra_numero);
            if(!empty($buscarAsignacion)){  
                $arreglo[$i]["chekeado"]=1;
                $arreglo[$i]["habilitado"]=0;
            }else{
                $arreglo[$i]["chekeado"]    = 0;
                $arreglo[$i]["habilitado"]  = 1;
                // /**
                //  * CASO CONTARIO BUSCAR COINCIDENCIA DE DOCUMENTOS EN LA EVAL. X EXPED. QUE SE ENCUENTREN SIN EVALUACION  ...SI ES EL CASO CARGARÁ CON CHECK Y HABILITADO
                //  */ 
                // $found_key = (string)array_search($dato->ins_numeroDocumento, array_column($buscarDocentes, 'cpe_documento'));    
                // $key = ($found_key == null ? -1 : $found_key);
                // if($key >= 0){
                //     $arreglo[$i]["chekeado"]=1;
                //     $arreglo[$i]["habilitado"]=1;
                // }else{
                //     $arreglo[$i]["chekeado"]=0;
                //     $arreglo[$i]["habilitado"]=0;
                // }
            }               

            $insID  = $dato->inscripcion_ins_id;
            $valores= $this->mesadepartes_model->listarTramitesObservados($insID);
            
            if(!empty($valores)){
                $j=0;	
                $arreglo[$i]["total"]=count($valores)+1;						
                if($flag==$insID || $flag==""){
                    $arreglo[$i]["sub_total"]=count($valores)+1-$k;	
                    $flag=$insID;
                }else{
                    $k=0;
                    $arreglo[$i]["sub_total"]=count($valores)+1-$k;								
                    $flag="";
                }	

                foreach ($valores as $valor) {                
                    $arreglo[$i]["urlArchivo"][$j]=$valor->urlArchivo;
                    $arreglo[$i]["urlAdjunto"][$j]=$valor->urlAdjunto;
                    $j++;
                
                }
                $k++;							
            }
            $i++;					
        }

        $this->layout->setLayout("template_ajax");
        $this->layout->view('cargarexpedientes/cargar/exp/DTExpedientesExp', compact('arreglo'));
    }

    public function CAsisgnarExpedientesExp(){
        $expedientes    = $this->input->post("expedientes",true);
        $idGin          = $this->input->post("idGin",true);
        $anio          = $this->input->post("anio",true);

        for ($i=0; $i < count($expedientes) ; $i++) { 
            $arrExp   = explode("||",$expedientes[$i]);
            $Anio       = $arrExp[0];
            $Numero     = $arrExp[1];     
            
            $archivosMPV   =  $this->mesadepartes_model->buscarExpedienteyDetalle($Anio, $Numero);
            /**
             * ||| SE AGREGA PARA QUE PRIMERO LO REGISTRE EN LA TABLA CUADRO_PUN_EXP SI NO EXISTE
             */
            $buscarDocentes = $this->convocatorias_auxiliar_model->buscarDocentesExp($idGin);

            $arrInsert =[];
                
            $found_key = (string)array_search($archivosMPV[0]['ins_numeroDocumento'], array_column($buscarDocentes, 'cpe_documento'));    
            $key = ($found_key == null ? -1 : $found_key);
            if($key < 0){ // no existe
                $arrInsert  = array( 
                    "cpe_tipoCuadro"    => 2,// 1: PUN, 2: EVAL EXP
                    "cpe_anio"          => $anio,
                    "cpe_documento"     => toMayus($archivosMPV[0]['ins_numeroDocumento']),
                    "cpe_apellidos"     => toMayus($archivosMPV[0]['ins_apellidos']),
                    "cpe_nombres"       => toMayus($archivosMPV[0]['ins_nombres']),
                    "cpe_sepresento"    => 2, // 2:estado registrado
                    "cpe_enviadoeval"   => 0, //0: no enviado a evaluacion
                    "cpe_fechaCarga"    => date("Y-m-d H:i:s"),
                    "cpe_estado"        => 1,
                    "grupo_inscripcion_gin_id"  => $idGin                
                );

                $insertId	= $this->convocatorias_auxiliar_model->insertCuadroPunExp($arrInsert);  
                if ($insertId<=0){ // NO SE HA REGISTRADO EL ARCHIVO.
                    $mensaje["error"]="Error al registar expedientes.";                         
                    $mensaje["estado"]=false; 
                    echo json_encode($mensaje); 
                    exit();                   
                }
            }

            /**
             * |||===============================================================================================================
             */
           
            if (!empty($archivosMPV)) {   // si existe en mesa de partes 
                $arrInsert  = array( 
                    "exp_numero"        => $Numero,
                    "exp_anio"          => $Anio,                    
                    "exp_codigo"        => $archivosMPV[0]['tra_numeroExpediente'],
                    "exp_remitente"     => toMayus($archivosMPV[0]['ins_nombres']." ".$archivosMPV[0]['ins_apellidos']),
                    "exp_documento"     => $archivosMPV[0]['ins_numeroDocumento'],
                    "exp_telefono1"     => $archivosMPV[0]['ins_telefono1'],
                    "exp_telefono2"     => $archivosMPV[0]['ins_telefono2'],
                    "exp_correo"        => $archivosMPV[0]['ins_correoElectronico'],
                    "exp_esprinicipal"  => 1,
                    "exp_tipo"          => 1, // 1: EVALUACION INICIAL, 2: RECLAMO
                    "exp_fechaCreacion" => date("Y-m-d H:i:s"),
                    "exp_estado"        => 1
                );  
                        
                $expId	= $this->convocatorias_auxiliar_model->insertExpediente($arrInsert);

                if ($expId<=0){ 
                    $mensaje["error"]="Error al asignar expediente.";
                    $mensaje["estado"]=false; 
                    echo json_encode($mensaje); 
                    exit();                   
                }

                $arrInsert =[];               
                foreach ($archivosMPV as $archivo) {
                    $arreglo=array(
                        "adt_nombreArchivo"         => $archivo['tra_urlAdjunto'],
                        "adt_extensionArchivo"      => strtolower(pathinfo($archivo['tra_urlAdjunto'], PATHINFO_EXTENSION)),
                        "adt_tipoArchivo"           => '1', //1: documento 2: anexo
                        "adt_procedenciaArchivo"    => '1', // 1:MPV 2:INTERNO
                        "adt_fechaCreacionArchivo"  => date("Y-m-d H:i:s"),
                        "adt_estado"                => 1,
                        "expedientes_exp_id"        => $expId
                    );

                    array_push($arrInsert,$arreglo);                             
                }

                $arreglo=array(
                    "adt_nombreArchivo"             => $archivosMPV[0]['tra_urlArchivo'],
                    "adt_extensionArchivo"          => strtolower(pathinfo($archivosMPV[0]['tra_urlArchivo'], PATHINFO_EXTENSION)),
                    "adt_tipoArchivo"               => '2', //1: documento 2: anexo
                    "adt_procedenciaArchivo"        => '1', // 1:MPV 2:INTERNO
                    "adt_fechaCreacionArchivo"      => date("Y-m-d H:i:s"),                  
                    "adt_estado"                    => 1,
                    "expedientes_exp_id"            => $expId
                );

                array_push($arrInsert,$arreglo);   

                $insertId	= $this->convocatorias_auxiliar_model->insertArchivosDetalleBatch($arrInsert);  
                if ($insertId<=0){ // NO SE HA REGISTRADO EL ARCHIVO.
                    $mensaje["error"]="Error al registar expedientes.";                         
                    $mensaje["estado"]=false; 
                    echo json_encode($mensaje); 
                    exit();                   
                }

                $arrInsert =[];
                $buscarDocentes = $this->convocatorias_auxiliar_model->buscarDocentesExp($idGin);
                $found_key = (string)array_search($archivosMPV[0]['ins_numeroDocumento'], array_column($buscarDocentes, 'cpe_documento'));    
                $key = ($found_key == null ? -1 : $found_key);
                if($key >= 0){ 
                    $arrInsert  = array( 
                        "expedientes_exp_id"    => $expId,
                        "cuadro_pun_exp_cpe_id"     => $buscarDocentes[$key]['cpe_id'],
                        "aep_tipoAsignacion"    => 1, // 1: asignacion automática, 2: asignacion manual
                        "aep_fechaCreacion"     => date("Y-m-d H:i:s"),      
                        "aep_estado"            => 1
                    );

                    $insertId	= $this->convocatorias_auxiliar_model->insertAsigancionExpedientePun($arrInsert);  
                    if ($insertId<=0){ // NO SE HA REGISTRADO EL ARCHIVO.
                        $mensaje["error"]="Error al registar expedientes.";                         
                        $mensaje["estado"]=false; 
                        echo json_encode($mensaje); 
                        exit();                   
                    }
                }
            }
        }

        if($insertId >= 1){
            $mensaje["success"] = "Se agregó expedientes correctamente.";	
            $mensaje["estado"]  = true;      
        }else{
            $mensaje["error"]   = "No se pudo agregar expedientes.";
            $mensaje["estado"]  = false;
        }

        echo json_encode($mensaje); 
    }












}