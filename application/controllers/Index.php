<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->layout->setLayout("template");	
	}

	public function index(){
		//Lo redirecciona
		redirect(base_url()."principal/index",301);

	}

}
