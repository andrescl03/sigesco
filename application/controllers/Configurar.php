<?php

defined("BASEPATH") OR exit("No direct script access allowed");

class Configurar extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->layout->setLayout("template");
		$this->load->model("configurar_model");	
		date_default_timezone_set('America/Lima');	
	}

	public function usuarios(){
		if($this->session->userdata("sigesco_dni")){
			//if(in_array($this->uri->uri_string(), $this->session->userdata("sigesco_rutas"))){
				$this->layout->js(array(base_url()."public/js/myscript/configurar/usuarios.js"));
				$dni=$this->session->userdata('sigesco_dni');
				$id=$this->session->userdata('sigesco_id');
				$dato=$this->configurar_model->buscarUsuario($dni, $id);
	    		$this->layout->view("usuarios/usuarios",compact("dato"));
			/*}else{
				redirect(base_url()."index",301);
			}*/			
    	}else{    		
    		redirect(base_url()."login/login",301);
	    }			
	}


	public function cambiarPassModal_ajax(){
		if($this->session->userdata("sigesco_dni")){
			if ($this->input->post()){			
				$mensaje["success"]="Correcto.";							
			}else{
				$mensaje["error"]="No se ha enviado ninguna petición";
			}
			$this->layout->setLayout("template_ajax");					
			$this->layout->view("usuarios/cambiarPassModal_ajax",compact("mensaje"));
		}else{    		
	    		redirect(base_url()."login/login",301);
	    }
	}

	public  function UpdateUsuario_ajax(){
		if($this->session->userdata("sigesco_dni")){
			if ($this->input->post()){										
				$usuID=$this->input->post('usuID', true);
				$dni=$this->input->post('dni', true);	
				$old=$this->input->post('old', true);
				$new_1=$this->input->post('new_1', true);
				$new_2=$this->input->post('new_2', true);		         

				if($new_1==$new_2){
					$dato=$this->configurar_model->buscarPassAnterior($usuID, $dni);
					if(!empty($dato)){
						if($dato->usu_pass==$old){
							$ar_update=array(							
								"usu_pass"=>$new_1,												
								'usu_fechaModificacion'=>date("Y-m-d H:i:s")						
							);				
							if(!empty($ar_update)){					
								$update=$this->configurar_model->updateUsuario($ar_update, $usuID);
								if($update>0){									
									$mensaje["success"]="Se actualizó correctamente.";	
									$mensaje["estado"]=true;	
								}else{
									$mensaje["error"]="No se pudo actualizar ningún registro.";
									$mensaje["estado"]=false;				 				
								}
							}else{
								$mensaje["error"]="No se ha enviado ninguna petición.";
								$mensaje["estado"]=false;				 				
							}
						}else{
							$mensaje["error"]="Contraseña anterior no coincide.";
							$mensaje["estado"]=false;
						}
					}else{
						$mensaje["error"]="Usuario no registrado.";
						$mensaje["estado"]=false;
					}
				}else{
					$mensaje["error"]="Contraseñas no coinciden.";
					$mensaje["estado"]=false;
				}
				





			}else{
				$mensaje["error"]="No se ha enviado ninguna petición.";
				$mensaje["estado"]=false;	
			}
			echo json_encode($mensaje);	
		}else{    		
    		redirect(base_url()."login/login",301);
	    }
	}



}

?>