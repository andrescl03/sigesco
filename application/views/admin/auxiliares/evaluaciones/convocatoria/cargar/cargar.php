<h4 class="mt-3"><b><i class="far fa-object-ungroup fa-sm"></i> Evaluación de postulantes / <?= $dato['pro_descripcion'] ?> | Convocatoria <?= sprintf('%04d', $dato['con_numero'])."-".$dato['con_anio'] ?> / <?= $dato['mod_abreviatura']." ".$dato['niv_descripcion'].($dato['esp_descripcion']!="-" ? " ".$dato['esp_descripcion'] : "" )." | ".($eval== '1' ? "PUN" : "POR EXPEDIENTE")."-".($tipo== '1' ? "Preliminar" : "Final") ?></b></h4>
    <ol class="breadcrumb mb-2">
        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"> Inicio</a></li>
        <li class="breadcrumb-item"><a href="<?php echo base_url()."evaluacion/convocatoria/".encryption('0||0'); ?>"> Evaluación de postulantes</a></li>
        <li class="breadcrumb-item"><a href="<?php echo base_url()."evaluacion/convocatoria/".encryption($dato['con_id'].'||0'); ?>"> <?= $dato['pro_descripcion'] ?> | Convocatoria <?= sprintf('%04d', $dato['con_numero'])."-".$dato['con_anio'] ?></a></li>
        <li class="breadcrumb-item active"><?= $dato['mod_abreviatura']." ".$dato['niv_descripcion'].($dato['esp_descripcion']!="-" ? " ".$dato['esp_descripcion'] : "" )." | ".($eval== '1' ? "PUN" : "POR EXPEDIENTE")."-".($tipo== '1' ? "Preliminar" : "Final") ?></li>
    </ol>  
    <input type="hidden" class="form-control form-control-sm" id="txt_idGin" name="txt_idGin" value="<?= $dato['gin_id'] ?>" >
    <input type="hidden" class="form-control form-control-sm" id="txt_eval" name="txt_eval" value="<?= $eval ?>" >
    <input type="hidden" class="form-control form-control-sm" id="txt_tipo" name="txt_tipo" value="<?= $tipo ?>" >
    <input type="hidden" class="form-control form-control-sm" id="txt_idConv" name="txt_idConv" value="<?= $dato['convocatorias_con_id'] ?>" >
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
                                                            <div class="col-sm-4">
                                                                <input type="text" class="form-control form-control-sm" id="txt_buscador" placeholder="Buscar..." >
                                                            </div>
                                                            <?php if(in_array("convocatorias/cargarexpedientes", $this->session->userdata("sigesco_rutas"))){ ?>
                                                                <div class="vr"></div>
                                                                <div class="form-check mt-1">
                                                                    <input class="form-check-input" type="checkbox" value="" id="chk_especialistasTodos">
                                                                    <label class="form-check-label" for="chk_especialistasTodos">
                                                                    <b>Especialistas (Todos)</b>
                                                                    </label>
                                                                </div>                                                            
                                                                <div class="vr"></div>
                                                                <button type="button" class="btn btn-outline-primary btn-sm btn_modalAsignarReasignar" ><b><i class="fa-solid fa-user-check fa-lg"></i> Asignar o Reasignar</b></button>
                                                            <?php } ?>  

                                                            <div class="vr"></div>
                                                            <a type="button" target="_blank" href="<?php echo base_url().'evaluacion/convocatoria/'.$dato['convocatorias_con_id'].'/inscripcion/'.$dato['gin_id'].'/pendiente/exportar' ?>" class="btn btn-outline-success btn-sm" >
                                                                <b><i class="fa-solid fa-cloud-arrow-down fa-lg"></i></i> Descargar Reporte</b>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  
                                        </div> 
                                    </div>
                                    <div class="col-sm-12"  id="view_listarCargarExpedientePunEvaluar">

                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal_asignarReasignar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="font-size: 14px;">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="staticBackdropLabel"><b><i class="fas fa-check-double fa-xs"></i> Asignar - Reasignar Especialista</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">       
                    <div id="view_asignarReasignar">


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><b><i class="fa-regular fa-circle-xmark fa-lg"></i> Cerrar</b></button>
                    <button type="button" class="btn btn-primary btn-sm" id="btn_asignarReasignar"><b><i class="far fa-check-circle fa-lg"></i> Agregar</b></button>
                </div>
            </div>
        </div>
    </div>

<!--
    <div class="modal fade" id="modal_buscarExpedientes" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="font-size: 14px;">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="staticBackdropLabel"><b><i class="fas fa-check-double fa-xs"></i> Buscar Expedientes</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">       
                    <div id="view_buscarExpedientes">


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><b><i class="fa-regular fa-circle-xmark fa-lg"></i> Cerrar</b></button>
                    <button type="button" class="btn btn-primary btn-sm" id="btn_agregarExpedientes"><b><i class="far fa-check-circle fa-lg"></i> Agregar</b></button>
                </div>
            </div>
        </div>
    </div>

-->