<?php
/*   
	Desarrollado por: 
		- Ing. Luis Alberto Arrascue Bazán 959817779
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->layout->setLayout("template_login");
		$this->load->model("login_model");
		date_default_timezone_set('America/Lima');
	}

	public function login(){
		if (!empty($this->uri->segment(3))) redirect(base_url()."login/login", 'refresh');
		$this->layout->js(array(base_url()."public/js/myscript/login.js?t=".date("mdYHis")));
		$this->layout->view("login");			
	}

	public function validarLogin_ajax(){
		if ($this->input->post()){
			$usuario	= $this->input->post("usu_dni",true);
			$pass		= $this->input->post("usu_pass",true);
			$datos		= $this->login_model->validar($usuario, $pass);
			
			if(empty($datos)){//usuario no existe
				$mensaje["error"]="Error de usuario o contraseña.";
				$mensaje["estado"]=false;
			}else{				
				$this->session->set_userdata("sigesco",true);
				$this->session->set_userdata("sigesco_id",$datos->usu_id);
				$this->session->set_userdata("sigesco_dni",$datos->usu_dni);
				$this->session->set_userdata("sigesco_nombre",$datos->usu_nombre);
				$this->session->set_userdata("sigesco_apellidos",$datos->usu_apellidos);
				$this->session->set_userdata("sigesco_estado",$datos->usu_estado);
				$this->session->set_userdata("sigesco_tus_iduser",$datos->tipo_usuarios_tus_id);
				$this->session->set_userdata("sigesco_tus_usuariodescrip",$datos->tus_usuariodescrip);				
				
				$mensaje["link"]=base_url()."inicio/index";
				$mensaje["success"]="Credenciales correctas.";	
				$mensaje["estado"]=true;			
			}

			echo json_encode($mensaje);	
		}else{
			redirect(base_url()."login/login",301);
		}
	}

	public function logout(){
		$array_items= array('sigesco', 'sigesco_id', 'sigesco_dni', 'sigesco_nombre', 'sigesco_apellidos', 'sigesco_estado', 'sigesco_tus_iduser', 'sigesco_tus_usuariodescrip','sigesco_rutas');
		$this->session->unset_userdata($array_items);	
		//$this->session->sess_destroy();
		redirect(base_url()."login/login",'refresh');			
	}





}