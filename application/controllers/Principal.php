<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->layout->setLayout("template_principal");		
        //$this->load->model("consultas_model");
		date_default_timezone_set('America/Lima');	
	}

	public function index(){

		/*$Oficina  = $this->session->userdata("SedeOficinaId");
        $sql     = "EXEC GEX_SEL_OperacionesListar_new ?";   // ETAPA ACTUAL
        $query   =  $this->DB2->query( $sql,[$Oficina]);    
        $dato   = $query->row_array();  */
        $dato = 1;
		$this->layout->view("index/index", compact('dato')); 
	}
		
	

}
