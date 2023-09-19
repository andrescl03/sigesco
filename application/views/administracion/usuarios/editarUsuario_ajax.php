 <?php if(isset($mensaje["error"])) { ?>

<div class="alert alert-danger" role="alert">
  <?php echo $mensaje["error"]; ?>
</div>	
<?php }else{ ?>

	<form id="frm_editarUsuario">
		<div class="row">		
			<div class="col-lg-12">
				<input type="hidden" class="form-control form-control-sm" name="cad_antes" id="cad_antes" class="form-control" value="<?php echo $dato->usu_dni.'_'.$dato->usu_nombre.'_'.$dato->usu_apellidos.'_'.$dato->tipo_usuarios_tus_id.'_'.$dato->usu_estado; ?>">
			 	<input type="hidden" class="form-control form-control-sm" name="txt_usuID" id="txt_usuID" class="form-control" value="<?php echo $dato->usu_id; ?>" >
				<div class="form-group row">
			    	<label for="txt_dni" class="col-sm-3 col-form-label"><b>DNI:</b></label>
			    	<div class="col-sm-4">
			     		<input type="text" class="form-control form-control-sm" id="txt_dni" name="txt_dni" minlength="8" maxlength="8" onkeypress="return soloNumeros(event)"  onblur="limpiaNumeros(this)" value="<?php echo $dato->usu_dni; ?>">
			    	</div>
			  	</div>
				<div class="form-group row">
			    	<label for="txt_nombre" class="col-sm-3 col-form-label"><b>Nombre:</b></label>
			    	<div class="col-sm-8">
			     		<input type="text" class="form-control form-control-sm" id="txt_nombre" name="txt_nombre" onkeyup="mayus(this)" value="<?php echo $dato->usu_nombre; ?>">
			    	</div>
			  	</div>
			  	<div class="form-group row">
			    	<label for="txt_apellidos" class="col-sm-3 col-form-label"><b>Apellidos:</b></label>
			    	<div class="col-sm-8">
			     		<input type="text" class="form-control form-control-sm" id="txt_apellidos" name="txt_apellidos" onkeypress="return soloLetras(event)" onblur="limpiaLetras(this)" onkeyup="mayus(this)" value="<?php echo $dato->usu_apellidos; ?>">
			    	</div>
			  	</div>
			  	<div class="form-group row">
		    		<label for="opt_tusuario" class="col-sm-3 col-form-label"><b>Tip Usuario:</b></label>
			    	<div class="col-sm-8">						      		
			      		<select class="form-select form-select-sm" name="opt_tusuario" id="opt_tusuario">	
							<option value="">Elegir...</option>	
							<?php foreach ($tipos as $tipo) { ?>
								<option value="<?php echo $tipo->tus_id; ?>" <?php if($dato->tipo_usuarios_tus_id==$tipo->tus_id){ echo "selected";}  ?>><?php echo $tipo->tus_usuariodescrip; ?></option>						
							<?php } ?>															
						</select>
			    	</div>
	  			</div>

	  			<div class="form-group row">
					<label for="#" class="col-sm-3 col-form-label"><b>Estado:</b></label>
					<div class="col-sm-6 mt-2">  		   
					<div class="d-flex justify-content-center ">
						<div class="custom-control custom-radio">		        	
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="opt_estado" id="opt_estado_1" value="1" <?php if($dato->usu_estado==1){ echo "checked";}  ?>>
								<label class="form-check-label" for="inlineRadio1"><span class="badge bg-success">Activo</span></label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="opt_estado" id="opt_estado_2" value="0" <?php if($dato->usu_estado==0){ echo "checked";}  ?>>
								<label class="form-check-label" for="inlineRadio1"><h6><span class="badge bg-danger">Inactivo</span></h6></label>
							</div>
						</div> 
					</div>
					</div>        						  			
				</div>
				
			</div>			
		</div>					  
	</form>
	

<?php } ?>

