<?php if(isset($mensaje["error"])) { ?>

<div class="alert alert-danger" role="alert">
  <?php echo $mensaje["error"]; ?>
</div>	
<?php }else{ ?>

	<form id="frm_editarTusuario">
		<div class="row">		
			<div class="col-lg-12">
				<input type="hidden" class="form-control form-control-sm" name="cad_antes" id="cad_antes" class="form-control" value="<?php echo $dato->tus_usuariodescrip.'_'.$dato->tus_estado; ?>">
			 	<input type="hidden" class="form-control form-control-sm" name="txt_tusID" id="txt_tusID" class="form-control" value="<?php echo $dato->tus_id; ?>" >
				<div class="form-group row">
			    	<label for="txt_descripcion" class="col-sm-3 col-form-label"><b>Descripción:</b></label>
			    	<div class="col-sm-8">
			     		<input type="text" class="form-control form-control-sm" id="txt_descripcion" name="txt_descripcion" onkeyup="mayus(this)" value="<?php echo $dato->tus_usuariodescrip; ?>">
			    	</div>
			  	</div>			   

					<div class="form-group row">
						<label for="#" class="col-sm-3 col-form-label"><b>Estado:</b></label>
						<div class="col-sm-6 mt-2">  		   
						<div class="d-flex justify-content-center ">
							<div class="custom-control custom-radio">		        	
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="opt_estado" id="opt_estado_1" value="1" <?php echo (($dato->tus_estado==1) ? "checked" : "");  ?>>
									<label class="form-check-label" for="inlineRadio1"><span class="badge bg-success">Activo</span></label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="opt_estado" id="opt_estado_2" value="0" <?php echo (($dato->tus_estado==0) ? "checked" : "");  ?>>
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

