<?php if(isset($mensaje["error"])) { ?>

<div class="alert alert-danger" role="alert">
  <?php echo $mensaje["error"]; ?>
</div>	
<?php }else{ ?>

	<form id="frm_agregarUsuario">
		<div class="row">		
			<div class="col-lg-12">
				<div class="form-group row">
			    	<label for="txt_dni" class="col-sm-3 col-form-label"><b>DNI:</b></label>
			    	<div class="col-sm-4">
			     		<input type="text" class="form-control form-control-sm" id="txt_dni" name="txt_dni" minlength="8" maxlength="8" onkeypress="return soloNumeros(event)"  onblur="limpiaNumeros(this)" value="<?php echo $datos->usu_dni; ?>">
			    	</div>
			  	</div>
				<div class="form-group row">
			    	<label for="txt_nombre" class="col-sm-3 col-form-label"><b>Nombre:</b></label>
			    	<div class="col-sm-8">
			     		<input type="text" class="form-control form-control-sm" id="txt_nombre" name="txt_nombre" onkeyup="mayus(this)" value="<?php echo $datos->usu_nombre; ?>">
			    	</div>
			  	</div>
			  	<div class="form-group row">
			    	<label for="txt_apellidos" class="col-sm-3 col-form-label"><b>Apellidos:</b></label>
			    	<div class="col-sm-8">
			     		<input type="text" class="form-control form-control-sm" id="txt_apellidos" name="txt_apellidos" onkeypress="return soloLetras(event)" onblur="limpiaLetras(this)" onkeyup="mayus(this)" value="<?php echo $datos->usu_apellidos; ?>">
			    	</div>
			  	</div>
			  	<div class="form-group row">
		    		<label for="opt_tusuario" class="col-sm-3 col-form-label"><b>Tip Usuario:</b></label>
			    	<div class="col-sm-6">						      		
			      		<select class="custom-select form-control-sm" name="opt_tusuario" id="opt_tusuario">	
							<option value="">Elegir...</option>	
							<?php foreach ($tipos as $tipo) { ?>
								<option value="<?php echo $tipo->tus_id; ?>" <?php if($datos->tipo_usuarios_tus_id==$tipo->tus_id){ echo "selected";}  ?>><?php echo $tipo->tus_usuariodescrip; ?></option>						
							<?php } ?>															
						</select>
			    	</div>
	  			</div>
	  			<div class="form-group row">	  																
					<label class="col-sm-3 col-form-label"><b>Estado:</b></label>
					<div class="custom-control custom-radio custom-control-inline mt-2">
					 	<input type="radio" id="opt_estado_1" name="opt_estado" class="custom-control-input" value="1" <?php if($datos->usu_estado==1){ echo "checked";}  ?>>
					 	<label class="custom-control-label" for="opt_estado_1" ><h6><span class="badge badge-success">Activo</span></h6></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline mt-2">
					  <input type="radio" id="opt_estado_2" name="opt_estado" class="custom-control-input" value="0" <?php if($datos->usu_estado==0){ echo "checked";}  ?>>
					  <label class="custom-control-label" for="opt_estado_2"><h6><span class="badge badge-danger">Inactivo</span></h6></label>
					</div>					
				</div>
			</div>			
		</div>					  
	</form>
	

<?php } ?>

