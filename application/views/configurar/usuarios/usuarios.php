<h4 class="mt-4"><b><i class="far fa-object-ungroup fa-sm"></i> Configuración de Usuarios </b></h4>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"> Inicio</a></li>
    <li class="breadcrumb-item active"> Configuración de Usuarios</li>
</ol>
<div class="card mb-4">
    <div class="card-body">
       	<div class="row">		
						<div class="col-lg-6">							
						 	<input type="hidden" class="form-control form-control-sm" name="txt_usuID" id="txt_usuID" class="form-control" value="<?php echo $dato->usu_id; ?>" >
							<div class="form-group row">
						    	<label for="txt_dni" class="col-sm-3 col-form-label"><b>DNI:</b></label>
						    	<div class="col-sm-4">
						     		<input type="text" class="form-control form-control-sm" id="txt_dni" name="txt_dni" minlength="8" maxlength="8" onkeypress="return soloNumeros(event)"  onblur="limpiaNumeros(this)" value="<?php echo $dato->usu_dni; ?>" readonly> 
						    	</div>
						  	</div>
							<div class="form-group row">
						    	<label for="txt_nombre" class="col-sm-3 col-form-label"><b>Nombre:</b></label>
						    	<div class="col-sm-8">
						     		<input type="text" class="form-control form-control-sm" id="txt_nombre" name="txt_nombre" onkeypress="return soloLetras(event)" onblur="limpiaLetras(this)" onkeyup="mayus(this)" value="<?php echo $dato->usu_nombre; ?>" readonly>
						    	</div>
						  	</div>
						  	<div class="form-group row">
						    	<label for="txt_apellidos" class="col-sm-3 col-form-label"><b>Apellidos:</b></label>
						    	<div class="col-sm-8">
						     		<input type="text" class="form-control form-control-sm" id="txt_apellidos" name="txt_apellidos" onkeypress="return soloLetras(event)" onblur="limpiaLetras(this)" onkeyup="mayus(this)" value="<?php echo $dato->usu_apellidos; ?>" readonly>
						    	</div>
						  	</div>
					  	 	<div class="form-group row">
						    	<label for="txt_tipo" class="col-sm-3 col-form-label"><b>Grupo Asignado:</b></label>
						    	<div class="col-sm-8">
						     		<input type="text" class="form-control form-control-sm" id="txt_tipo" name="txt_tipo" value="<?php echo $dato->tus_usuariodescrip; ?>" readonly>
						    	</div>
						  	</div>
					  	 	<div class="form-group row">
						    	<label for="txt_estado" class="col-sm-3 col-form-label"><b>Estado:</b></label>
						    	<div class="col-sm-8">
						     		<input type="text" class="form-control form-control-sm" id="txt_estado" name="txt_estado" value="<?php echo ($dato->usu_estado==1) ? 'Activo' : 'Inactivo';  ?>" readonly>
						    	</div>
						  	</div>
						  	  <button type="button" class="btn btn-primary btn-sm btn_cambiarPassModal"><i class="fas fa-redo fa-lg"></i> Cambiar contraseña</button>								  	  				
						</div>			
					</div>


    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modal_cambiarPass" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-danger" id="staticBackdropLabel"><b><i class="fas fa-check-double fa-xs"></i> Cambiar Contraseña</b></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div id="view_cambiarPass">


            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><b><i class="fas fa-window-close"></i> Cerrar</b></button>
            <button type="button" class="btn btn-primary btn-sm" id="btn_cambiarPass"><b><i class="fas fa-plus-square"></i> Cambiar</b></button>
        </div>
    </div>
  </div>
</div>










