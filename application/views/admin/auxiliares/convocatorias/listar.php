<h4 class="mt-3"><b><i class="far fa-object-ungroup fa-sm"></i> Convocatorias para la presentación de expedientes</b></h4>
    <ol class="breadcrumb mb-2">
        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"> Inicio</a></li>
        <li class="breadcrumb-item active">Convocatorias para la presentación de expedientes</li>
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
                                                            <div class="d-grid gap-2 col-sm-2">
                                                                <div class="row">
                                                                    <div class="col-sm-6 mt-1"><b>Periodo:</b></div>
                                                                    <div class="col-sm-6">
                                                                        <select class="form-select form-select-sm"  name="opt_periodo" id="opt_periodo" > 
                                                                            <option value="0">Elegir...</option>
                                                                            <?php foreach ($periodos as $periodo) { ?>
                                                                                <option value="<?= $periodo['per_id'] ?>" <?= $periodo['per_default']==1 ? "Selected" : "" ?> ><?= $periodo['per_anio'] ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="vr"></div>
                                                            <div class="d-grid gap-2 col-sm-3">
                                                                <div class="row">
                                                                    <div class="col-sm-5 mt-1"><b>Tipo de proceso:</b></div>
                                                                    <div class="col-sm-7">
                                                                        <select class="form-select form-select-sm"  name="opt_tipoProceso" id="opt_tipoProceso" >
                                                                            <option value="0">Elegir...</option> 
                                                                            <?php foreach ($procesos as $proceso) { ?>
                                                                                <option value="<?= $proceso['pro_id'] ?>" <?= $proceso['pro_default']==1 ? "Selected" : "" ?> ><?= $proceso['pro_descripcion'] ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>   
                                                            <div class="vr"></div>
                                                            <div class="d-grid gap-2 col-sm-2">
                                                                <button type="button" class="btn btn-outline-primary btn-sm btn_modalNuevaConvocatoria" ><b><i class="fa-solid fa-circle-plus fa-lg"></i> Agregar</b></button>
                                                            </div>
                                                            <div class="vr"></div>
                                                            <div class="col-sm-4"><input type="text" class="form-control form-control-sm" id="txt_buscador" placeholder="Buscar..." ></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  
                                        </div> 
                                    </div>
                                    <div class="col-sm-12"  id="view_listarConvocatorias">

                                    </div>                                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="modal_nuevaConvocatoria" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="font-size: 14px;">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="staticBackdropLabel"><b><i class="fas fa-check-double fa-xs"></i> Agregar Nueva Convocatoria: </b><b class="text-dark lb_expediente"></b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="view_nuevaConvocatoria">


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><b><i class="fa-regular fa-circle-xmark fa-lg"></i> Cerrar</b></button>
                    <button type="button" class="btn btn-primary btn-sm" id="btn_agregarNuevaConvocatoria"><b><i class="far fa-check-circle fa-lg"></i> Aceptar</b></button>
                </div>
            </div>
        </div>
    </div>