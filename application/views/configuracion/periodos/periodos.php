<h4 class="mt-3"><b><i class="far fa-object-ungroup fa-sm"></i> Periodos</b></h4>
    <ol class="breadcrumb mb-2">
        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"> Inicio</a></li>
        <li class="breadcrumb-item active">Periodos</li>
    </ol>
    <?php  $CargoOficina = $this->session->userdata('CargoOficina'); ?>
    <div class="app-row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="card border-secondary" >
                        <div class="card-body text-dark">
                            <div class="text-right mb-2">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card border bg-light">
                                            <div class="card-body" style="padding: 0.8rem 1rem;">
                                                <div class="row">
                                                    <div class="col-sm-12 ">
                                                        <div class="d-flex align-content-start flex-wrap gap-3">
                                                            <div class="d-grid gap-2 col-sm-2"><button type="button" class="btn btn-outline-primary btn-sm btn_agregarPeriodo" ><b><i class="fa-solid fa-file-signature fa-lg"></i> Agregar</b></button></div>
                                                            <div class="vr"></div>
                                                            <div class="col-sm-6"><input type="text" class="form-control form-control-sm" id="txt_buscador" placeholder="Buscar..." ></div>
                                                            <div class="vr"></div>
                                                            <div class="col-sm-1 text-center">
                                                                <a type="button" class="btn btn-sm btn-outline-primary" href="<?php echo base_url(); ?>prelaciones">
                                                                    Prelaciones
                                                                </a>
                                                            </div>
                                                            <div class="vr"></div>
                                                            <div class="col-sm-1 text-center">
                                                                <a type="button" class="btn btn-sm btn-outline-primary" href="<?php echo base_url(); ?>bonificaciones">
                                                                    Bonificaciones
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  
                                        </div> 
                                    </div>
                                    <div class="col-sm-12"  id="view_listarPeriodos">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_agregarPeriodos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="font-size: 14px;">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="staticBackdropLabel"><b><i class="fas fa-check-double fa-xs"></i> Agregar Periodo: </b><b class="text-dark lb_expediente"></b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="container">
                            <form id="formCreatePeriodo" class="formCreatePeriodo">
                                <div class="mb-3 row">
                                    <label class="col-4 col-form-label">Nombre</label>
                                    <div class="col-8">
                                        <input type="text" class="form-control" name="name" placeholder="Nombre" required/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-4 col-form-label">Año</label>
                                    <div class="col-8">
                                        <input type="number" class="form-control" name="anio" placeholder="Año" required/>
                                    </div>
                                </div>
                            </form> 
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><b><i class="fas fa-window-close"></i> Cerrar</b></button>
                    <button type="submit" class="btn btn-primary btn-sm" form="formCreatePeriodo"><b><i class="fas fa-plus-square"></i> Agregar</b></button>
                </div>
            </div>
        </div>
    </div>


  