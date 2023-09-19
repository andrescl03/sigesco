<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Administracion extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->layout->setLayout("template");
		$this->load->model("administracion_model");	
		date_default_timezone_set('America/Lima');	
	}

	public function tusuarios(){
		if($this->session->userdata("sigesco_dni")){
			if(in_array($this->uri->uri_string(), $this->session->userdata("sigesco_rutas"))){
				$this->layout->js(array(base_url()."public/js/myscript/administracion/tusuarios.js"));
	    		$this->layout->view("tiposusuarios/tusuarios");
			}else{
				redirect(base_url()."index",301);
			}			
    	}else{    		
    		redirect(base_url()."login/login",301);
	    }			
	}

	public function tusuarios_ajax(){
		if($this->session->userdata("sigesco_dni")){			//echo $this->uri->uri_string();		
			if ($this->input->post()){
				$datos=$this->administracion_model->buscar_tusuarios();
				if(!empty($datos)){
					$mensaje["success"]="Información encontrada.";	
				}else{
					$mensaje["error"]="No hay ningún registro en la base de datos.";			 				
				}
			}else{
				$mensaje["error"]="No se ha enviado ninguna petición.";
			}
			$this->layout->setLayout("template_ajax");					
			$this->layout->view("tiposusuarios/tusuarios_ajax",compact("datos","mensaje"));
		}else{    		
	    		redirect(base_url()."login/login",301);
	    }
	}

	public function agregarTus_ajax(){
		if($this->session->userdata("sigesco_dni")){
			if ($this->input->post()){			
				$mensaje["success"]="Correcto.";							
			}else{
				$mensaje["error"]="No se ha enviado ninguna petición";
			}
			$this->layout->setLayout("template_ajax");					
			$this->layout->view("tiposusuarios/agregarTus_ajax",compact("mensaje"));
		}else{    		
	    		redirect(base_url()."login/login",301);
	    }
	}

//
	public function agregarTUsuario_ajax(){
		if($this->session->userdata("sigesco_dni")){
			if ($this->input->post()){	
				$desc=trim($this->input->post("tus_usuariodescrip",true));
				$buscar=$this->administracion_model->buscarTusuarioxDescrip($desc);

				if(empty($buscar) || $buscar->tus_usuariodescrip!=$desc){
					$arreglo=array(
						"tus_usuariodescrip"=>$desc,
						"tus_estado"=>$this->input->post("tus_estado",true),
						"tus_fechaRegistro"=>date("Y-m-d H:i:s"),				
						"tus_flag"=>1									
					);
					$id=$this->administracion_model->agregar_Tusuario($arreglo);							
					if(!empty($id)){
						$modulos=$this->administracion_model->buscar_modulos();
						if(!empty($modulos)){
							$arr=[];					
							foreach ($modulos as $modulo) {						
								$buscando=$this->administracion_model->buscar_permisos($id, $modulo->mdl_id);
								if(empty($buscando)){ // no existe
									$arreglo=array(
										"tipo_usuarios_tus_id"=>$id,
										"modulos_mdl_id"=>$modulo->mdl_id,
										"per_fechaRegistro"=>date("Y-m-d H:i:s"),
										"per_estado"=>0,
										"per_flag"=>1													
									);
									array_push($arr,$arreglo);							
								}	
							}
							$this->administracion_model->insertarPermisos($arr);						
						}
						$mensaje["success"]="Tipo de Usuario agregado correctamente.";
						$mensaje["estado"]=true;						
					}else{
						$mensaje["error"]="No se pudo agregar dicho Tipo de Usuario.";
						$mensaje["estado"]=false;			 			
					}
				}else{
					$mensaje["error"]="Descripción ya existe.";
					$mensaje["estado"]=false;
				}
			}else{
				$mensaje["error"]="No se ha enviado ninguna petición";
				$mensaje["estado"]=false;
			}
			echo json_encode($mensaje);	
		}else{    		
    		redirect(base_url()."login/login",301);
	    }
	}

	
	public function editarTusuario_ajax(){
		if($this->session->userdata("sigesco_dni")){
			if ($this->input->post()){
				$tus_id=$this->input->post("tus_id",true);				
				$dato=$this->administracion_model->buscar_tusuariosxId($tus_id);				
				if(!empty($dato)){
					$mensaje["success"]="Usuario Encontrado.";	
				}else{
					$mensaje["error"]="No se ha encontrado ningún usuario.";			 			
				}				
			}else{
				$mensaje["error"]="No se ha enviado ninguna petición";
			}
			$this->layout->setLayout("template_ajax");					
			$this->layout->view("tiposusuarios/editarTusuario_ajax",compact("dato","mensaje"));
		}else{    		
	    		redirect(base_url()."login/login",301);
	    }
	}

	
	public  function UpdateTusuarios_ajax(){
		if($this->session->userdata("sigesco_dni")){
			if ($this->input->post()){										
				$tusID=$this->input->post('tusID', true);
				$descripcion=$this->input->post('descripcion', true);		   
		        $estado=$this->input->post('estado', true);

		        $buscar=$this->administracion_model->buscarTusuarioxDescrip($descripcion);
		        //writer($buscar);
		        if(empty($buscar) || $buscar->tus_id==$tusID){		        	
					$ar_update=array(					
						'tus_usuariodescrip'=>$descripcion,
						'tus_estado'=>$estado,					
						'tus_fechaModificacion'=>date("Y-m-d H:i:s")						
					);

					if(!empty($ar_update)){					
						$update=$this->administracion_model->updateTusuarios($ar_update, $tusID);
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
					$mensaje["error"]="Descripción ya existe.";
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

	public  function eliminarTusuarios_ajax(){
		if($this->session->userdata("sigesco_dni")){
			if ($this->input->post()){										
				$tusID=$this->input->post('tusID', true);
				$total=$this->input->post('total', true);

		        if($total==0){		        	
					$ar_update=array(					
						'tus_flag'=>0,
						'tus_estado'=>0,					
						'tus_fechaModificacion'=>date("Y-m-d H:i:s")						
					);
					if(!empty($ar_update)){					
						$update=$this->administracion_model->updateTusuarios($ar_update, $tusID);
						if($update>0){									
							$mensaje["success"]="Se eliminó correctamente.";	
							$mensaje["estado"]=true;	
						}else{
							$mensaje["error"]="No se pudo eliminar ningún registro.";
							$mensaje["estado"]=false;				 				
						}
					}else{
						$mensaje["error"]="No se ha enviado ninguna petición.";
						$mensaje["estado"]=false;				 				
					}
				}else{
					$mensaje["error"]="Grupo tiene usuarios registrados.";
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

	

//===============================================================

	public function usuarios(){
		if($this->session->userdata("sigesco_dni")){
			if(in_array($this->uri->uri_string(), $this->session->userdata("sigesco_rutas"))){			
				$this->layout->js(array(base_url()."public/js/myscript/administracion/usuarios.js"));
		    	$this->layout->view("usuarios/usuarios");
		    }else{
		    	redirect(base_url()."index",301);		    }
    	}else{    		
	    		redirect(base_url()."login/login",301);
	    }			
	}

	public function usuarios_ajax(){
		if($this->session->userdata("sigesco_dni")){
			if ($this->input->post()){
				$datos=$this->administracion_model->buscar_usuarios();
				if(!empty($datos)){
					$mensaje["success"]="Información encontrada.";	
				}else{
					$mensaje["error"]="No hay ningún registro en la base de datos.";			 				
				}
			}else{
				$mensaje["error"]="No se ha enviado ninguna petición.";
			}
			$this->layout->setLayout("template_ajax");					
			$this->layout->view("usuarios/usuarios_ajax",compact("datos","mensaje"));
		}else{    		
	    		redirect(base_url()."login/login",301);
	    }
	}

	public function agregar_ajax(){
		if($this->session->userdata("sigesco_dni")){
			if ($this->input->post()){				
				$datos=$this->administracion_model->buscar_tusuariosOtro();
				if(!empty($datos)){
					$mensaje["success"]="Carga Correcta.";	
				}else{
					$mensaje["error"]="Primero es necesario agregar un Tipo de Usuario.";			 			
				}				
			}else{
				$mensaje["error"]="No se ha enviado ninguna petición";
			}
			$this->layout->setLayout("template_ajax");					
			$this->layout->view("usuarios/agregar_ajax",compact("datos","mensaje"));
		}else{    		
	    		redirect(base_url()."login/login",301);
	    }
	}

	public function agregarUsuario_ajax(){
		if($this->session->userdata("sigesco_dni")){
			if ($this->input->post()){
				$usu_dni=$this->input->post("usu_dni",true);				
				$respuesta=$this->administracion_model->buscar_usuariosOtro($usu_dni);
				if(empty($respuesta)){		// diferente de ""						
					$arreglo=array(
						"usu_dni"=>$this->input->post("usu_dni",true),
						"usu_nombre"=>$this->input->post("usu_nombre",true),
						"usu_apellidos"=>$this->input->post("usu_apellidos",true),
						"usu_pass"=>sha1($this->input->post("usu_dni",true)),
						"usu_flag"=>1,
						"usu_fechaRegistro"=>date("Y-m-d H:i:s"),
						"tipo_usuarios_tus_id"=>$this->input->post("tus_id",true),
						"usu_estado"=>$this->input->post("usu_estado",true)								
					);
					$datos=$this->administracion_model->agregar_Usuario($arreglo);							
					if(!empty($datos)){
						$mensaje["success"]="Usuario agregado correctamente.";
						$mensaje["estado"]=true;	
					}else{
						$mensaje["error"]="No se pudo agregar dicho usuario.";
						$mensaje["estado"]=false;
					}
				}else{
					$mensaje["error"]="Usuario ya se encuentra registrado.";
					$mensaje["estado"]=false;
				}								
			}else{
				$mensaje["error"]="No se ha enviado ninguna petición";
				$mensaje["estado"]=false;
			}
			echo json_encode($mensaje);	
		}else{    		
	    		redirect(base_url()."login/login",301);
	    }
	}


	public function editarUsuario_ajax(){
		if($this->session->userdata("sigesco_dni")){
			if ($this->input->post()){	
				$id=$this->input->post("usu_id",true);			
				$dato=$this->administracion_model->buscar_usuariosId($id);
				$tipos=$this->administracion_model->buscar_tusuariosOtro();
				if(!empty($dato)){
					$mensaje["success"]="Usuario Encontrado.";	
				}else{
					$mensaje["error"]="Usuario no encontrado.";			 			
				}				
			}else{
				$mensaje["error"]="No se ha enviado ninguna petición";
			}
			$this->layout->setLayout("template_ajax");					
			$this->layout->view("usuarios/editarUsuario_ajax",compact("dato","tipos","mensaje"));
		}else{    		
	    		redirect(base_url()."login/login",301);
	    }
	}
	
	public  function UpdateUsuario_ajax(){
		if($this->session->userdata("sigesco_dni")){
			if ($this->input->post()){										
				$usuID=$this->input->post('usuID', true);
				$dni=$this->input->post('dni', true);	
				$nombres=$this->input->post('nombres', true);
				$apellidos=$this->input->post('apellidos', true);
				$tipoUsuario=$this->input->post('tipoUsuario', true);
		        $estado=$this->input->post('estado', true); 

				$respuesta=$this->administracion_model->buscar_usuariosOtro($dni);
				if(empty($respuesta) || $respuesta->usu_id==$usuID){		
					$ar_update=array(					
						'usu_dni'=>$dni,
						'usu_nombre'=>$nombres,
						'usu_apellidos'=>$apellidos,
						"usu_pass"=>sha1($dni),
						'tipo_usuarios_tus_id'=>$tipoUsuario,
						'usu_estado'=>$estado,					
						'usu_fechaModificacion'=>date("Y-m-d H:i:s")						
					);				
					if(!empty($ar_update)){					
						$update=$this->administracion_model->updateUsuario($ar_update, $usuID);
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
					$mensaje["error"]="Usuario ya se encuentra registrado.";
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

	
	public  function eliminarUsuarios_ajax(){
		if($this->session->userdata("sigesco_dni")){
			if ($this->input->post()){										
				$usuID=$this->input->post('usuID', true);		        	        	
				$ar_update=array(					
					'usu_estado'=>0,
					'usu_flag'=>0,					
					'usu_fechaModificacion'=>date("Y-m-d H:i:s")						
				);
				if(!empty($ar_update)){					
					$update=$this->administracion_model->updateUsuario($ar_update, $usuID);
					if($update>0){									
						$mensaje["success"]="Se eliminó correctamente.";	
						$mensaje["estado"]=true;	
					}else{
						$mensaje["error"]="No se pudo eliminar ningún registro.";
						$mensaje["estado"]=false;				 				
					}
				}else{
					$mensaje["error"]="No se ha enviado ninguna petición.";
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

	public  function resetPassowrd_ajax(){
		if($this->session->userdata("sigesco_dni")){
			if ($this->input->post()){										
				$usuID=$this->input->post('usuID', true);
				$dni=$this->input->post('dni', true);		        	        	
					$ar_update=array(					
						'usu_pass'=>sha1($dni),											
						'usu_fechaModificacion'=>date("Y-m-d H:i:s")						
					);
					if(!empty($ar_update)){					
						$update=$this->administracion_model->updateUsuario($ar_update, $usuID);
						if($update>0){									
							$mensaje["success"]="Contraseña reseteado.";	
							$mensaje["estado"]=true;	
						}else{
							$mensaje["error"]="No se pudo resetear la contraseña.";
							$mensaje["estado"]=false;				 				
						}
					}else{
						$mensaje["error"]="No se ha enviado ninguna petición.";
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



//===============================================================


	public function modulos(){
		if($this->session->userdata("sigesco_dni")){
			if(in_array($this->uri->uri_string(), $this->session->userdata("sigesco_rutas"))){
				$this->layout->js(array(base_url()."public/js/myscript/administracion/modulos.js"));			
		    	$this->layout->view("modulos/modulos");
		    }else{
		    	redirect(base_url()."index",301);
		    }
    	}else{    		
	    		redirect(base_url()."login/login",301);
	    }			
	}

	public function modulos_ajax(){
		if($this->session->userdata("sigesco_dni")){
			if ($this->input->post()){
				$datos=$this->administracion_model->buscar_modulos();
				if(!empty($datos)){
					$mensaje["success"]="Información encontrada.";	
				}else{
					$mensaje["error"]="No hay ningún registro en la base de datos.";			 				
				}
			}else{
				$mensaje["error"]="No se ha enviado ninguna petición.";
			}
			$this->layout->setLayout("template_ajax");					
			$this->layout->view("modulos/modulos_ajax",compact("datos","mensaje"));
		}else{    		
	    		redirect(base_url()."login/login",301);
	    }
	}

	public function agregarMod_ajax(){
		if($this->session->userdata("sigesco_dni")){
			if ($this->input->post()){				
				$datos=$this->administracion_model->buscar_modulosPadre();
				$mensaje["success"]="Carga Correcta.";	
			/*	if(!empty($datos)){
					$mensaje["success"]="Carga Correcta.";	
				}else{
					$mensaje["error"]="Primero es necesario agregar un Tipo de Usuario.";			 			
				}*/				
			}else{
				$mensaje["error"]="No se ha enviado ninguna petición";
			}
			$this->layout->setLayout("template_ajax");					
			$this->layout->view("modulos/agregarMod_ajax",compact("datos","mensaje"));
		}else{    		
	    		redirect(base_url()."login/login",301);
	    }
	}

	public function agregarModulo_ajax(){
		if($this->session->userdata("sigesco_dni")){
			if ($this->input->post()){
				$hijo=$this->input->post("mdl_hijode",true);						
				$arreglo=array(
					"mdl_nombre"=>trim(strtoupper($this->input->post("mdl_nombre",true))),
					"mdl_ruta"=>trim(strtolower($this->input->post("mdl_ruta",true))),
					"mdl_icono"=>trim(strtolower($this->input->post("mdl_icono",true))),
					"mdl_hijode"=>$this->input->post("mdl_hijode",true),
					"mdl_fechaRegistro"=>date("Y-m-d H:i:s"),
					"mdl_estado"=>1,
					"mdl_flag"=>1														
				);
				$id=$this->administracion_model->agregar_Modulo($arreglo);
				if($hijo==0){
					$orden=$id.'.'.'0';	
				}else{
					$orden=$hijo.'.'.$id;
				}
				$up_arreglo=array(
					"mdl_orden"=>$orden									
				);
				$update=$this->administracion_model->updateModulo($up_arreglo,$id);

				if(!empty($update)){
					$tusuarios=$this->administracion_model->buscar_tusuarios();
					if(!empty($tusuarios)){
						$arr=[];					
						foreach ($tusuarios as $tusuario) {						
							$buscando=$this->administracion_model->buscar_permisos($tusuario->tus_id, $id);
							if(empty($buscando)){ // no existe
								$arreglo=array(
									"tipo_usuarios_tus_id"=>$tusuario->tus_id,
									"modulos_mdl_id"=>$id,
									"per_fechaRegistro"=>date("Y-m-d H:i:s"),
									"per_estado"=>0,
									"per_flag"=>1													
								);
								array_push($arr,$arreglo);							
							}	
						}
						$this->administracion_model->insertarPermisos($arr);
					}				
					$mensaje["success"]="Módulo agregado correctamente.";
					$mensaje["estado"]=true;		
				}else{
					$mensaje["error"]="No se pudo agregar dicho módulo.";
					$mensaje["estado"]=false;				 			
				}												
			}else{
				$mensaje["error"]="No se ha enviado ninguna petición";
				$mensaje["estado"]=false;	
			}
			echo json_encode($mensaje);	
		}else{    		
    		redirect(base_url()."login/login",301);
	    }
	}

	public function editarMod_ajax(){
		if($this->session->userdata("sigesco_dni")){
			if ($this->input->post()){
				$mdl_id=$this->input->post("mdl_id",true);
				$datos=$this->administracion_model->buscar_modulosPadre();
				$modulo=$this->administracion_model->buscarModulosxID($mdl_id);

				$mensaje["success"]="Carga Correcta.";	
			/*	if(!empty($datos)){
					$mensaje["success"]="Carga Correcta.";	
				}else{
					$mensaje["error"]="Primero es necesario agregar un Tipo de Usuario.";			 			
				}*/				
			}else{
				$mensaje["error"]="No se ha enviado ninguna petición";
			}
			$this->layout->setLayout("template_ajax");					
			$this->layout->view("modulos/editarMod_ajax",compact("datos","modulo","mensaje"));
		}else{    		
	    		redirect(base_url()."login/login",301);
	    }
	}
	
	public  function UpdateModulos_ajax(){
		if($this->session->userdata("sigesco_dni")){
			if ($this->input->post()){										
				$mldID=$this->input->post('mldID', true);
				$nombre=$this->input->post('nombre', true);
		        $hijode=$this->input->post('hijode', true);
		        $ruta=$this->input->post('ruta', true);
		        $icono=$this->input->post('icono', true);
		        $estado=$this->input->post('estado', true); 			
					
				$ar_update=array(					
					'mdl_nombre'=>$nombre,
					'mdl_ruta'=>$ruta,
					'mdl_icono'=>$icono,
					'mdl_hijode'=>$hijode,
					'mdl_estado'=>$estado,
					'mdl_orden'=>(($hijode==0) ? $mldID: ($hijode.'.'.$mldID)),			
					'mdl_fechaModificacion'=>date("Y-m-d H:i:s")						
				);
			
				if(!empty($ar_update)){					
					$update=$this->administracion_model->updateModulo($ar_update, $mldID);
					if($update>0){
						if($estado==0 && $hijode==0){
							$ar_estado=array(							
								'mdl_estado'=>0														
							);
							$update_estado=$this->administracion_model->updateModuloxEstado($ar_estado,$mldID);
						}else{
							if($estado==1 && $hijode==0){
								$ar_estado=array(							
									'mdl_estado'=>1														
								);
								$update_estado=$this->administracion_model->updateModuloxEstado($ar_estado,$mldID);
							}
						}					
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
				$mensaje["error"]="No se ha enviado ninguna petición.";
				$mensaje["estado"]=false;	
			}
			echo json_encode($mensaje);	
		}else{    		
    		redirect(base_url()."login/login",301);
	    }
	}


	public  function eliminarModulos_ajax(){
		if($this->session->userdata("sigesco_dni")){
			if ($this->input->post()){										
				$mdlID=$this->input->post('mdlID', true);
				$buscar=$this->administracion_model->buscarHijos($mdlID);
				if(empty($buscar)){	
					$ar_update=array(					
						'mdl_estado'=>0,
						'mdl_flag'=>0,					
						'mdl_fechaModificacion'=>date("Y-m-d H:i:s")						
					);
					if(!empty($ar_update)){					
						$update=$this->administracion_model->updateModulo($ar_update, $mdlID);
						if($update>0){									
							$mensaje["success"]="Se eliminó correctamente.";	
							$mensaje["estado"]=true;	
						}else{
							$mensaje["error"]="No se pudo eliminar ningún registro.";
							$mensaje["estado"]=false;				 				
						}
					}else{
						$mensaje["error"]="No se ha enviado ninguna petición.";
						$mensaje["estado"]=false;				 				
					}
				}else{
					$mensaje["error"]="No se puede eliminar, tiene hijos asociados.";
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























//===============================================================

	public function permisos(){
		if($this->session->userdata("sigesco_dni")){
			if(in_array($this->uri->uri_string(), $this->session->userdata("sigesco_rutas"))){
				$this->layout->js(array(base_url()."public/js/myscript/administracion/permisos.js"));			
		    	$this->layout->view("permisos/permisos");
		    }else{
		    	redirect(base_url()."index",301);
		    }
    	}else{    		
	    		redirect(base_url()."login/login",301);
	    }			
	}

	public function permisos_ajax(){
		if($this->session->userdata("sigesco_dni")){
			if ($this->input->post()){
				$datos=$this->administracion_model->buscar_tusuariosActivos();
				if(!empty($datos)){
					$mensaje["success"]="Información encontrada.";	
				}else{
					$mensaje["error"]="No hay ningún registro en la base de datos.";			 				
				}
			}else{
				$mensaje["error"]="No se ha enviado ninguna petición.";
			}
			$this->layout->setLayout("template_ajax");					
			$this->layout->view("permisos/permisos_ajax",compact("datos","mensaje"));
		}else{    		
	    		redirect(base_url()."login/login",301);
	    }
	}

	public function cargar_permisos(){
		if($this->session->userdata("sigesco_dni")){
			if ($this->input->post()){
				$tus_id=$this->input->post("tus_id",true);
				$datos=$this->administracion_model->buscar_permisosxtipo($tus_id);
				if(!empty($datos)){
					$mensaje["success"]="Información encontrada.";	
				}else{
					$mensaje["error"]="No hay ningún registro en la base de datos.";			 				
				}
			}else{
				$mensaje["error"]="No se ha enviado ninguna petición.";
			}
			$this->layout->setLayout("template_ajax");					
			$this->layout->view("permisos/cargar_permisos",compact("datos","mensaje"));
		}else{    		
	    		redirect(base_url()."login/login",301);
	    }
	}


	public function cambiar_estadoPermiso(){
		if($this->session->userdata("sigesco_dni")){
			if ($this->input->post()){
				$estado=$this->input->post("per_estado",true);				
				$arreglo=array(
					"per_estado"=>$estado,
					"per_fechaModificacion"=>date("Y-m-d H:i:s")								
				);
				$tus_id=$this->input->post("tus_id",true);
				$mdl_id=$this->input->post("mdl_id",true);

				$respuesta=$this->administracion_model->actualiza_permisos($arreglo, $tus_id, $mdl_id);
				if($respuesta=="SI"){
					if($estado==1){
						$mensaje["success"]="Permiso brindado.";
						$mensaje["estado"]=true;
					}else{
						$mensaje["error"]="Permiso quitado.";
						$mensaje["estado"]=true;
					}					
				}else{
					$mensaje["error"]="No se relizó ninguna actualización de información.";
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


