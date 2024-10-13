<?php if(isset($mensaje["error"])) { ?>
	<div class="alert alert-danger" role="alert">
	  <?php echo $mensaje["error"]; ?>
	</div>	
<?php }else{ ?>
	<form id="frm_editarModulo">
		<div class="row">		
			<div class="col-lg-12">
				 <input type="hidden" class="form-control form-control-sm" name="cad_antes" id="cad_antes" class="form-control" value="<?php echo $modulo->mdl_nombre.'_'.$modulo->mdl_hijode.'_'.$modulo->mdl_ruta.'_'.$modulo->mdl_icono.'_'.$modulo->mdl_estado; ?>">
			 	<input type="hidden" class="form-control form-control-sm" name="txt_mldID" id="txt_mldID" class="form-control" value="<?php echo $modulo->mdl_id; ?>" >
				<div class="form-group row">
			    	<label for="txt_nombre" class="col-sm-3 col-form-label"><b>Módulo:</b></label>
			    	<div class="col-sm-8">
			     		<input type="text" class="form-control form-control-sm" id="txt_nombre" name="txt_nombre" onkeyup="mayus(this)" value="<?php echo $modulo->mdl_nombre; ?>">
			    	</div>
			  	</div>
			  	<div class="form-group row">
		    		<label for="opt_hijode" class="col-sm-3 col-form-label"><b>Hijo de:</b></label>
			    	<div class="col-sm-8">						      		
			      		<select class="form-select form-select-sm" name="opt_hijode" id="opt_hijode">	
							<option value="">Elegir...</option>
							<?php  // if($modulo->mdl_hijode==0){ ?>
							<option value="0" <?php echo (($modulo->mdl_hijode==0) ? "Selected" : ""); ?>>Padre</option>
							<?php // } ?>
							<?php foreach ($padres as $dato) { 
								if ($dato->mdl_id == $modulo->mdl_id) {
									continue;
								}	
							?>
								<option value="<?php echo $dato->mdl_id; ?>" <?php echo (($dato->mdl_id==$modulo->mdl_hijode) ? "Selected" : ""); ?>><?php echo $dato->pathname; // echo $dato->mdl_nombre; ?></option>						
							<?php } ?>																						
						</select>
			    	</div>
	  			</div>
				<div class="form-group row">
			    	<label for="txt_ruta" class="col-sm-3 col-form-label"><b>Ruta:</b></label>
			    	<div class="col-sm-8">
			     		<input type="text" class="form-control form-control-sm" id="txt_ruta" name="txt_ruta" onkeyup="minus(this)" value="<?php echo $modulo->mdl_ruta; ?>">
			    	</div>
			  	</div>
			  	<div class="form-group row">
			    	<label for="txt_icono" class="col-sm-3 col-form-label"><b>Icono:</b></label>
			    	<div class="col-sm-8">
			     		<input type="text" class="form-control form-control-sm" id="txt_icono" name="txt_icono" onkeyup="minus(this)" value="<?php echo $modulo->mdl_icono; ?>">
			    	</div>
			  	</div>
			  	<?php //if($modulo->mdl_hijode!=0){ ?>
				<div class="form-group row">
					<label for="#" class="col-sm-3 col-form-label"><b>Estado:</b></label>
					<div class="col-sm-6 mt-2">  		   
						<div class="d-flex justify-content-center ">
							<div class="custom-control custom-radio">		        	
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="opt_estado" id="opt_estado_1" value="1" <?php echo (($modulo->mdl_estado==1) ? "checked" : "");  ?>>
									<label class="form-check-label" for="inlineRadio1"><span class="badge bg-success">Activo</span></label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="opt_estado" id="opt_estado_2" value="0" <?php echo (($modulo->mdl_estado==0) ? "checked" : "");  ?>>
									<label class="form-check-label" for="inlineRadio1"><h6><span class="badge bg-danger">Inactivo</span></h6></label>
								</div>
							</div> 
						</div>
					</div>        						  			
				</div>
				<?php //} ?>

			</div>			
		</div>					  
	</form>
	<div id="msg_doble">		
	</div>	

<?php } ?>

