<h4 class="mt-3"><b><i class="far fa-object-ungroup fa-sm"></i> Plazas</b></h4>
    <ol class="breadcrumb mb-2">
        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"> Inicio</a></li>
        <li class="breadcrumb-item active">Plazas</li>
    </ol>
    <?php  $CargoOficina = $this->session->userdata('CargoOficina');            
            $periodos = $data['periodos'];
            $procesos = $data['procesos'];
            $colegios = $data['colegios']; 
    ?>
    <div class="app-row" id="AppIndexPlaza">
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
                                                                                <option value="<?= $periodo->per_id ?>" <?= $periodo->per_default==1 ? "Selected" : "" ?> ><?= $periodo->per_anio ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="vr"></div>
                                                            <div class="d-grid gap-2 col-sm-3">
                                                                <div class="row">
                                                                    <div class="col-sm-5 mt-1"><b>Tipo de plaza:</b></div>
                                                                    <div class="col-sm-7">
                                                                        <select class="form-select form-select-sm"  name="opt_tipoProceso" id="opt_tipoProceso" >
                                                                            <option value="0">Elegir...</option> 
                                                                            <?php foreach ($procesos as $proceso) { ?>
                                                                                <option value="<?= $proceso->pro_id ?>" <?= $proceso->pro_default==1 ? "Selected" : "" ?> ><?= $proceso->pro_descripcion ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="vr"></div>
                                                            <div class="d-grid gap-2 col-sm-2">
                                                                <button type="button" class="btn btn-outline-primary btn-sm btn-create" ><b><i class="fa-solid fa-circle-plus fa-lg"></i> Agregar</b></button>
                                                            </div>
                                                            <div class="vr"></div>
                                                            <div class="col-sm-4">
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control form-control-sm shadow-none" placeholder="Escribe aquí..." id="txtBuscador">
                                                                    <button type="button" class="input-group-text btn btn-sm btn-primary shadow-none btn-search">Buscar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>                                             
                                                </div>
                                            </div>  
                                        </div> 
                                    </div>
                                    <div class="col-sm-12"  id="view_listarPlazas">
                                        <div class="table-responsive">
                                            <table id="tableIndex" class="table  table-hover table-sm" cellspacing="0" width="100%" style="font-size:13px; vertical-align: middle;">
                                                <thead>
                                                    <tr class="cabecera_tabla_2">
                                                        <th class="text-center">#</th>
                                                        <th class="text-center">CÓDIGO DE PLAZA</th>
                                                        <th >I.E</th>
                                                        <th class="text-center">Especialidad</th>
                                                        <th class="text-center">Jornada</th>
                                                        <th class="text-center">Tipo Vacante</th>
                                                        <th class="text-center">Motivo Vacante</th>
                                                        <th class="text-center">Estado</th>
                                                        <th class="text-center">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>	
                                                </tbody>							
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalPlaza" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="font-size: 14px;">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="staticBackdropLabel"><b><i class="fas fa-check-double fa-xs"></i> Mantenimiento de plaza: </b><b class="text-dark lb_expediente"></b></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <form class="form-plaza" id="formPlaza">
                                <div class="row">
                                    <div class="col-md-2 mb-2 mt-1"><b>Periodo:</b></div>
                                    <div class="col-md-4 mb-2">
                                        <select class="form-select form-select-sm" name="periodo_id" required>
                                            <option value="" hidden>Elegir...</option>
                                            <?php foreach ($periodos as $periodo) { ?>
                                                <option value="<?= $periodo->per_id ?>" <?= $periodo->per_default == 1 ? "Selected" : "" ?>><?= $periodo->per_anio ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2 mb-2 mt-1"><b>Estado:</b></div>
                                    <div class="col-md-4 mb-2">
                                        <select class="form-select form-select-sm" name="estado" required>
                                            <option value="1">Abierto</option>
                                            <option value="0">Cerrado</option>
                                        </select>
                                    </div>

                                    <div class="w-100"></div>

                                    <div class="col-md-2 mb-2 mt-1"><b>Tipo de proceso:</b></div>
                                    <div class="col-md-10 mb-2">
                                        <select class="form-select form-select-sm" name="tipo_proceso" required>
                                            <option value="" hidden>Elegir...</option>
                                            <?php foreach ($procesos as $proceso) { ?>
                                                <option value="<?= $proceso->pro_id ?>" <?= $proceso->pro_default == 1 ? "Selected" : "" ?>><?= $proceso->pro_descripcion ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-md-2 mb-2 mt-1"><b>Codigo Plaza :</b></div>
                                    <div class="col-md-10 mb-2">
                                        <input class="form-control form-control-sm" name="codigo_plaza" type="text" required/>
                                    </div>

                                    <div class="col-md-2 mb-2 mt-1"><b>Modalidad de contratación:</b></div>
                                    <div class="col-md-10 mb-2">
                                        <select class="form-select form-select-sm" name="tipo_convocatoria" required>
                                            <option value="" hidden>Elegir...</option>
                                            <?php $tipos = [['id' => 1, 'descripcion' => 'PUN'],  ['id' => 2, 'descripcion' => 'EVALUACION DE EXPEDIENTE']]; ?>
                                            <?php foreach ($tipos as $tipo) { ?>
                                                <option value="<?= $tipo['id'] ?>" <?= $tipo['id'] == 1 ? "Selected" : "" ?>><?= $tipo['descripcion'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-md-2 mb-2 mt-1"><b>Institución Educativa:</b></div>
                                    <div class="col-md-10 mb-2">
                                        <select class="form-select form-select-sm" name="colegio_id" required>
                                            <option value="" hidden>Elegir...</option>
                                            <?php foreach ($colegios as $colegio) { ?>
                                                <option value="<?= $colegio->loc_id ?>" <?= $colegio->loc_id == 1 ? "Selected" : "" ?>><?= $colegio->mod_nombre ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-md-2 mb-2 mt-1"><b>Nivel:</b></div>
                                    <div class="col-md-10 mb-2">
                                        <select class="form-select form-select-sm" name="nivel">
                                            <option value="" hidden>Elegir...</option>
                                            <?php $tipos = [['id' => 1, 'descripcion' => 'INICIAL'],  ['id' => 2, 'descripcion' => 'PRIMARIA'] , ['id' => 3, 'descripcion' => 'SECUNDARIA'] ]; ?>
                                            <?php foreach ($tipos as $tipo) { ?>
                                                <option value="<?= $tipo['id'] ?>" <?= $tipo['id'] == 1 ? "Selected" : "" ?>><?= $tipo['descripcion'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2 mb-2 mt-1"><b>Especialidad:</b></div>
                                    <div class="col-md-10 mb-2">
                                        <input class="form-control form-control-sm" name="especialidad" type="text" required/>
                                    </div>

                                    <div class="col-md-2 mb-2 mt-1"><b>Jornada :</b></div>
                                    <div class="col-md-10 mb-2">
                                        <input class="form-control form-control-sm" name="jornada" type="number" required/>
                                    </div>


                                    <div class="col-md-2 mb-2 mt-1"><b>Tipo de vacante:</b></div>
                                    <div class="col-md-10 mb-2">
                                        <select class="form-select form-select-sm" name="tipo_vacante" required>
                                            <option value="" hidden selected>Elegir...</option>
                                            <option value="Plaza">Plaza</option>
                                            <option value="Vacante por contrato eventual">Vacante por contrato eventual</option>
                                            <option value="Reemplazo de titular">Reemplazo de titular</option>
                                            <option value="Contrato por horas">Contrato por horas</option>

                                        </select>
                                    </div>
                                    <div class="col-md-2 mb-2 mt-1"><b>Motivo de vacante:</b></div>
                                    <div class="col-md-10 mb-2">
                                        <input class="form-control form-control-sm" name="motivo_vacante" type="text" required/>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><b><i class="fa-regular fa-circle-xmark fa-lg"></i> Cerrar</b></button>
                        <button type="submit" class="btn btn-primary btn-sm" form="formPlaza"><b><i class="far fa-check-circle fa-lg"></i> Aceptar</b></button>
                    </div>
                </div>
            </div>
        </div>
    </div>