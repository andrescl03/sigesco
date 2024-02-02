<?php if(isset($mensaje["error"])) { ?> 

<?php }else{ ?>
	<form id="frm_cambiarPass">
		<div class="row">		
			<div class="col-lg-12">
				<div class="form-group row">
			    	<label for="txt_passOld" class="col-sm-4 col-form-label"><b>Contraseña Anterior:</b></label>
			    	<div class="col-sm-6">
			     		<input type="password" class="form-control form-control-sm" id="txt_passOld" name="txt_passOld" maxlength="40">
			    	</div>
			  	</div>
			  	 <hr class="">   
				<div class="form-group row">
			    	<label for="txt_passNew_1" class="col-sm-4 col-form-label"><b>Nueva Contraseña:</b></label>
			    	<div class="col-sm-6">
			     		<input type="password" class="form-control form-control-sm" id="txt_passNew_1" name="txt_passNew_1" minlength="6" maxlength="40">
			    	</div>
			  	</div>
				<div class="form-group row">
			    	<label for="txt_passNew_2" class="col-sm-4 col-form-label"><b>Repetir Contraseña:</b></label>
			    	<div class="col-sm-6">
			     		<input type="password" class="form-control form-control-sm" id="txt_passNew_2" name="txt_passNew_2" minlength="6" maxlength="40">
			    	</div>
			  	</div>
			</div>			
		</div>					  
	</form>
<?php } ?>
