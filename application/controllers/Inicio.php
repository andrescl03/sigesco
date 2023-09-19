<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

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
        $this->load->model("inicio_model");
		date_default_timezone_set('America/Lima');	
	}

	public function index(){

		/*$Oficina  = $this->session->userdata("SedeOficinaId");
        $sql     = "EXEC GEX_SEL_OperacionesListar_new ?";   // ETAPA ACTUAL
        $query   =  $this->DB2->query( $sql,[$Oficina]);    
        $dato   = $query->row_array();  */

        $dato =1;
        $periodo= $this->inicio_model->listarPeriodosDefault();
        $proceso= $this->inicio_model->listarProcesosDefault();

        $this->session->set_userdata("sigesco_default_periodo",$periodo['per_id']);
        $this->session->set_userdata("sigesco_default_proceso",$proceso['pro_id']);

        
		$this->layout->view("index", compact('dato')); 
	}


    
		
	

}
