<h4 class="mt-3"><b><i class="far fa-object-ungroup fa-sm"></i> Grupo de Inscripción</b></h4>
    <ol class="breadcrumb mb-2">
        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"> Inicio</a></li>
        <li class="breadcrumb-item active">Grupo de Inscripción</li>
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
                                                            <div class="col-sm-4"><input type="text" class="form-control form-control-sm" id="txt_buscador" placeholder="Buscar..." ></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  
                                        </div> 
                                    </div>
                                    <div class="col-sm-12"  id="view_listarGrupoInscripcion">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>