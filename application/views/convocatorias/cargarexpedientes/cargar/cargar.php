<h4 class="mt-3"><b><i class="far fa-object-ungroup fa-sm"></i> Cargar expedientes / <?= $dato['pro_descripcion'] ?> | Convocatoria <?= sprintf('%04d', $dato['con_numero'])."-".$dato['con_anio'] ?> / <?= $dato['mod_abreviatura']." ".$dato['niv_descripcion'].($dato['esp_descripcion']!="-" ? " ".$dato['esp_descripcion'] : "" ) ?></b></h4>
    <ol class="breadcrumb mb-2">
        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"> Inicio</a></li>
        <li class="breadcrumb-item"><a href="<?php echo base_url()."convocatorias/cargarexpedientes/".encryption('0||0'); ?>"> Cargar expedientes</a></li>
        <li class="breadcrumb-item"><a href="<?php echo base_url()."convocatorias/cargarexpedientes/".encryption($dato['con_id'].'||0'); ?>"> <?= $dato['pro_descripcion'] ?> | Convocatoria <?= sprintf('%04d', $dato['con_numero'])."-".$dato['con_anio'] ?></a></li>
        <li class="breadcrumb-item active"><?= $dato['mod_abreviatura']." ".$dato['niv_descripcion'].($dato['esp_descripcion']!="-" ? " ".$dato['esp_descripcion'] : "" ) ?></li>
    </ol>  
    <input type="text" class="form-control form-control-sm" id="txt_idGin" name="txt_idGin" value="<?= $dato['gin_id'] ?>" >
    <input type="text" class="form-control form-control-sm" id="txt_anio" name="txt_anio" value="<?= $dato['con_anio'] ?>" >
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
                                                            <div class="d-grid gap-2 col-sm-5">
                                                                <div class="row">
                                                                    <div class="col-sm-4 mt-1"><b>Tipo de evaluación:</b></div>
                                                                    <div class="col-sm-8">
                                                                        <select class="form-select form-select-sm"  name="opt_tipoEvaluacion" id="opt_tipoEvaluacion" > 
                                                                            <option value="">Elegir...</option>
                                                                            <option value="1">Evaluación PUN</option>
                                                                            <option value="2">Evaluación de Expedientes</option>
                                                                            <!--<option value="3">Evaluación para contratación directa</option>-->
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="vr"></div>
                                                            <div class="col-sm-4"><input type="text" class="form-control form-control-sm" id="txt_buscador" placeholder="Buscar..." ></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  
                                        </div> 
                                    </div>
                                    <div class="col-sm-12"  id="view_listarCargarExpedienteControles">

                                    
                                    </div>
                                    <div class="col-sm-12"  id="view_listarCargarExpediente">

                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


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


    <!-- <div class="modal fade" id="modal_buscarExpedientes" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
    </div> -->


   