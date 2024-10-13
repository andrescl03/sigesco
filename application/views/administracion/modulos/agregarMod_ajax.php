<?php if(isset($mensaje["error"])) { ?>
	<div class="alert alert-danger" role="alert">
	  <?php echo $mensaje["error"]; ?>
	</div>	
<?php }else{ ?>
	<form id="frm_agregarModulo">
		<div class="row">		
			<div class="col-lg-12">
				<div class="form-group row">
			    	<label for="txt_nombre" class="col-sm-3 col-form-label"><b>Módulo:</b></label>
			    	<div class="col-sm-8">
			     		<input type="text" class="form-control form-control-sm" id="txt_nombre" name="txt_nombre" onkeyup="mayus(this)">
			    	</div>
			  	</div>
			  	<div class="form-group row">
		    		<label for="opt_hijode" class="col-sm-3 col-form-label"><b>Hijo de:</b></label>
			    	<div class="col-sm-8">						      		
			      		<select class="form-select form-select-sm" name="opt_hijode" id="opt_hijode">	
							<option value="">Elegir...</option>
							<option value="0">Padre</option>
							<?php foreach ($padres as $dato) { ?>
								<option value="<?php echo $dato->mdl_id; ?>"><?php echo $dato->pathname; ?></option>						
							<?php } ?>	
																						
						</select>
			    	</div>
	  			</div>
				<div class="form-group row">
			    	<label for="txt_ruta" class="col-sm-3 col-form-label"><b>Ruta:</b></label>
			    	<div class="col-sm-8">
			     		<input type="text" class="form-control form-control-sm" id="txt_ruta" name="txt_ruta" onkeyup="minus(this)">
			    	</div>
			  	</div>
			  	<div class="form-group row">
			    	<label for="txt_icono" class="col-sm-3 col-form-label"><b>Icono:</b></label>
			    	<div class="col-sm-8">
			     		<input type="text" class="form-control form-control-sm" id="txt_icono" name="txt_icono" onkeyup="minus(this)">
			    	</div>
			  	</div>	  		

				<div class="form-group row">
					<label for="#" class="col-sm-3 col-form-label"><b>Estado:</b></label>
					<div class="col-sm-6 mt-2">  		   
						<div class="d-flex justify-content-center ">
							<div class="custom-control custom-radio">		        	
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="opt_estado" id="opt_estado_1" value="1">
									<label class="form-check-label" for="inlineRadio1"><span class="badge bg-success">Activo</span></label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="opt_estado" id="opt_estado_2" value="0">
									<label class="form-check-label" for="inlineRadio1"><h6><span class="badge bg-danger">Inactivo</span></h6></label>
								</div>
							</div> 
						</div>
					</div>        						  			
				</div>

			</div>			
		</div>					  
	</form>
	<div id="msg_doble">		
	</div>	

<?php } ?>

