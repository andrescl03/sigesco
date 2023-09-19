<?php if(isset($mensaje["error"])) { ?> 
	<div class="alert alert-danger" role="alert"><?php echo $mensaje["error"]; ?></div>	
<?php }else{ ?>
	
	<form id="frm_verPermisos">
		<div class="row">		
			<div class="col-lg-12">		  	
			  	<div class="form-group row">
			  		<input type="hidden" class="form-control" id="tus_id" name="tus_id" >
		    		<label for="opt_tusuario" class="col-sm-2 col-form-label"><b>Seleccionar Grupo:</b></label>
			    	<div class="col-sm-4">						      		
			      		<select class="form-select form-select-sm" name="opt_tusuario" id="opt_tusuario">	
							<option value="">Elegir...</option>
							<?php foreach ($datos as $dato) { ?>
								<option value="<?php echo $dato->tus_id; ?>"><?php echo $dato->tus_usuariodescrip?></option>						
							<?php } ?>																	
						</select>
			    	</div>
	  			</div>
			</div>	
			<div class="col-lg-12">
				<div id="verPermisos"></div>
			</div>		
		</div>					  
	</form>



<?php } ?>