
  <h4 class="mt-4"><b><i class="far fa-object-ungroup fa-sm"></i> Grupos de Usuarios</b></h4>
  <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"> Inicio</a></li>
      <li class="breadcrumb-item active">Grupos de Usuarios</li>
  </ol>

  <div class="app-row">
  	<div class="col-md-12">
  	  <div class="tile">
  	    <div class="tile-body">
  	    	<div class="card border-secondary" >
  			  	<div class="card-body text-dark">  			  		
              <div class="text-right mb-2">
                <button type="button" class="btn btn-primary btn-sm btn_agregarTusuarios"><i class="far fa-plus-square fa-lg"></i> Agregar</button>    
              </div>			  		
  	  				<div id="mostrarTusuarios"></div>
  	  				<div class="mt-2" id="msg">
  			  	</div>
  			</div>
  		</div>
  	  </div>
  	</div>
  </div>
</div>


<div class="modal fade" id="modal_agregarTusuarios" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-danger" id="staticBackdropLabel"><b><i class="fas fa-check-double fa-xs"></i> Agregar Tipos de Usuarios</b></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div id="contentAgregarTusuario">


            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><b><i class="fas fa-window-close"></i> Cerrar</b></button>
            <button type="button" class="btn btn-primary btn-sm" id="btn_agregarTus"><b><i class="fas fa-plus-square"></i> Agregar</b></button>
        </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modal_confirAgregarTus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-danger" id="staticBackdropLabel"><b><i class="fas fa-check-double fa-xs"></i> Confirmar</b></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
              ¿Está seguro de agregar un nuevo Grupo de Usuarios?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><b><i class="fas fa-window-close"></i> Cerrar</b></button>
            <button type="button" class="btn btn-primary btn-sm" id="btn_confirAgregarTus"><b><i class="fas fa-plus-square"></i> Aceptar</b></button>
        </div>
    </div>
  </div>
</div>

  
<div class="modal fade" id="modal_editarTusuarios" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-danger" id="staticBackdropLabel"><b><i class="fas fa-check-double fa-xs"></i> Editar Tipo de Usuario</b></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div id="view_EditarTusuario">


            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><b><i class="fas fa-window-close"></i> Cerrar</b></button>
            <button type="button" class="btn btn-danger btn-sm" id="btn_editarTusuario"><b><i class="far fa-edit"></i> Editar</b></button>
        </div>
    </div>
  </div>
</div>





