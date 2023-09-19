<?php

defined("BASEPATH") OR exit("No direct script access allowed");

class Errores extends CI_Controller {

	public function __construct(){
		parent::__construct();
		//$this->layout->setLayout("template");		
		date_default_timezone_set('America/Lima');	
	}

    public function error404(){  
		$this->layout->setLayout("template_ajax");           
        $this->layout->view("error404");
    }

	public function errorLogin(){  
		$this->layout->setLayout("template_ajax");           
        $this->layout->view("errorLogin");
    }





}