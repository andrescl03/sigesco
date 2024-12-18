<h4 class="mt-3"><b><i class="far fa-object-ungroup fa-sm"></i> Evaluación de postulantes / <?= $datos[0]['pro_descripcion'] ?> | Convocatoria <?= sprintf('%04d', $datos[0]['con_numero']) . "-" . $datos[0]['con_anio'] ?></b></h4>
<ol class="breadcrumb mb-2">
    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"> Inicio</a></li>
    <li class="breadcrumb-item"><a href="<?php echo base_url() . "evaluacion/convocatoria/" . encryption('0||0'); ?>"> Evaluación de postulantes</a></li>
    <li class="breadcrumb-item active"><?= $datos[0]['pro_descripcion'] ?> | Convocatoria <?= sprintf('%04d', $datos[0]['con_numero']) . "-" . $datos[0]['con_anio'] ?></li>
</ol>
<div class="app-row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <div class="card border-secondary">
                    <div class="card-body text-dark">
                        <div class="text-right mb-2">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card border bg-light">
                                        <div class="card-body" style="padding: 0.8rem 1rem;">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <div class="d-flex align-content-start flex-wrap gap-3">
                                                        <div class="col-sm-12"><input type="text" class="form-control form-control-sm" id="txt_buscador" placeholder="Buscar..."></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <?php
                                                    if (in_array($this->session->userdata("sigesco_tus_iduser"), array('1', '2'))) { ?>
                                                        <button type="button" class="btn btn-sm btn-success me-2 mb-2" data-bs-toggle="modal" data-bs-target="#modalExcelReport">
                                                            Reporte General
                                                        </button>
                                                        <a type="button" target="_blank" href="<?php echo base_url() . 'evaluacion/convocatoria/' . $datos[0]['con_numero'] . '/inscripcion/preliminar/exportar' ?>" class="btn btn-sm btn-primary me-2 mb-2">
                                                            Reporte General Preliminar
                                                        </a>
                                                        <a type="button" target="_blank" href="<?php echo base_url() . 'evaluacion/convocatoria/' . $datos[0]['con_numero'] . '/inscripcion/final/exportar' ?>" class="btn btn-sm btn-primary me-2 mb-2">
                                                            Reporte General Final
                                                        </a>

                                                        <button data-id="<?= $datos[0]['con_numero'] ?>" type="button" id="btn-procesar-expedientes" class="btn btn-sm btn-danger btn-procesar-expedientes mb-2">
                                                            Procesar expedientes de la MPV para esta convocatoria
                                                        </button>
                                                    <?php } ?>
                                                </div>
                                                <div class="col-sm-4">
                                                    <?php
                                                    $totalPostulaciones = 0;
                                                    foreach ($datos as $indice => $dato) {
                                                        $totalPostulaciones += $dato['total_postulaciones'];
                                                    }
                                                    ?>
                                                    <div class="d-flex align-content-start flex-wrap gap-3">
                                                        CANTIDAD DE POSTULANTES PARA LA CONVOCATORIA <?= sprintf('%04d', $datos[0]['con_numero']) . "-" . $datos[0]['con_anio'] ?>:<b><?php echo $totalPostulaciones ?> REGISTROS</b>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12" id="">

                                    <div class="table-responsive">
                                        <table id="tb_listarConvocatorias" class="table  table-hover table-sm" cellspacing="0" width="100%" style="font-size:13px; vertical-align: middle;">
                                            <thead>
                                                <tr class="cabecera_tabla_2">
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">GRUPOS DE INSCRIPCIÓN</th>
                                                    <th class="text-center">ASIGNACIÓN</th>
                                                    <th class="text-center">SIN EVALUAR</th>
                                                    <th class="text-center">EVALUACIÓN PRELIMINAR</th>
                                                    <th class="text-center">EVALUACIÓN FINAL</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 0;
                                                $total_cantidad_sin_evaluar = 0;
                                                $total_cantidad_preliminar = 0;
                                                $total_cantidad_final = 0;
                                                foreach ($datos as $dato) {
                                                    $cadena = $dato['con_id'] . "||" . $dato['gin_id'];
                                                    $parte_1 = ($dato['tp_asigando'] > 0 ? $dato['tp_asigando'] : 0) + ($dato['te_asigando'] > 0 ? $dato['te_asigando'] : 0);
                                                    $parte_2 = $dato['tp_docentes'] + $dato['te_docentes'];
                                                ?>
                                                    <?php if ($dato['total_asignados']  > 0 || in_array($this->session->userdata('sigesco_tus_iduser'), [1, 2])) { ?>
                                                        <tr>
                                                            <td class="text-center"><b><?= $i + 1; ?></b></td>
                                                            <td><?= $dato['mod_abreviatura'] . " " . $dato['niv_descripcion'] . ($dato['esp_descripcion'] != "-" ? " " . $dato['esp_descripcion'] : "") ?></td>
                                                            <td class="text-center"><span class="badge rounded-pill bg-warning text-dark" style="font-size: 1em;"><?= $dato['total_asignados'] . " / " . $dato['cantidad_final'] ?></span></b></td>
                                                            <!-- <td class="text-center">
                                                            <div class="d-flex justify-content-center gap-3">
                                                                <?php
                                                                if ($dato['tp_preliminar'] > 0) {
                                                                    if ($dato['tp_mis_preliminar'] > 0) {
                                                                        $valor_1 = $dato['tp_mis_preliminar'] . " / " . $dato['tp_preliminar'] . " PUN";
                                                                        $color_1 = "badge bg-success";
                                                                    } else {
                                                                        $valor_1 = $dato['tp_preliminar'] . " PUN";
                                                                        $color_1 = "badge bg-secondary";
                                                                    }
                                                                ?>

                                                                <a type="button"  title="Ingresar a detalle" href="<?= base_url() ?>evaluacion/convocatoria/<?= encryption($cadena . "||1||1") ?>" >                                                                
                                                                    <span class="<?= $color_1 ?>" style="font-size: 1em;"><b><i class="fa-solid fa-arrow-right-to-bracket fa-lg"></i> <?= $valor_1 ?></b> </span>
                                                                </a>
                                                                <?php } ?>

                                                                <?php
                                                                if ($dato['te_preliminar'] > 0) {
                                                                    if ($dato['te_mis_preliminar'] > 0) {
                                                                        $valor_1 = $dato['te_mis_preliminar'] . " / " . $dato['te_preliminar'] . " EXP";
                                                                        $color_1 = "badge bg-primary";
                                                                    } else {
                                                                        $valor_1 = $dato['te_preliminar'] . " EXP";
                                                                        $color_1 = "badge bg-secondary";
                                                                    }
                                                                ?>

                                                                <a type="button"  title="Ingresar a detalle" href="<?= base_url() ?>evaluacion/convocatoria/<?= encryption($cadena . "||2||1") ?>" >                                                                
                                                                    <span class="<?= $color_1 ?>" style="font-size: 1em;"><b><i class="fa-solid fa-arrow-right-to-bracket fa-lg"></i> <?= $valor_1 ?></b> </span>
                                                                </a>
                                                                <?php } ?>
                                                            </div>
                                                        </td> -->
                                                            <td class="text-center">
                                                                <span class="badge rounded-pill bg-light text-dark" style="font-size: 1em;"><?= $dato['cantidad_sin_evaluar'] ?></span></b>
                                                                <a type="button" title="Ingresar a detalle" href="<?= base_url() ?>evaluacion/convocatoria/<?= encryption($cadena . "||1||1") ?>">
                                                                    <span class="badge bg-success" style="font-size: 1em;"><b><i class="fa-solid fa-arrow-right-to-bracket fa-lg"></i> <?= $valor_1 ?></b> </span>
                                                                </a>
                                                            </td>
                                                            <td class="text-center">
                                                                <span class="badge rounded-pill bg-light text-dark" style="font-size: 1em;"><?= $dato['cantidad_preliminar'] ?></span></b>
                                                                <a type="button" title="Ingresar a detalle" href="<?= base_url() ?>evaluacion/convocatoria/<?= $dato['con_id'] ?>/inscripcion/<?= $dato['gin_id'] ?>/preliminar">
                                                                    <span class="badge bg-success" style="font-size: 1em;"><b><i class="fa-solid fa-arrow-right-to-bracket fa-lg"></i> <?= $valor_1 ?></b> </span>
                                                                </a>
                                                            </td>
                                                            <td class="text-center">
                                                                <span class="badge rounded-pill bg-light text-dark" style="font-size: 1em;"><?= $dato['cantidad_final'] ?></span></b>
                                                                <a type="button" title="Ingresar a detalle" href="<?= base_url() ?>evaluacion/convocatoria/<?= $dato['con_id'] ?>/inscripcion/<?= $dato['gin_id'] ?>/final">
                                                                    <span class="badge bg-success" style="font-size: 1em;"><b><i class="fa-solid fa-arrow-right-to-bracket fa-lg"></i> <?= $valor_1 ?></b> </span>
                                                                </a>
                                                            </td>
                                                            <!-- <td class="text-center">
                                                            <div class="d-flex justify-content-center gap-3">
                                                                <?php
                                                                if ($dato['tp_final'] > 0) {
                                                                    if ($dato['tp_mis_final'] > 0) {
                                                                        $valor_1 = $dato['tp_mis_final'] . " / " . $dato['tp_final'] . " PUN";
                                                                        $color_1 = "badge bg-success";
                                                                    } else {
                                                                        $valor_1 = $dato['tp_final'] . " PUN";
                                                                        $color_1 = "badge bg-secondary";
                                                                    }
                                                                ?>
                                                                <a type="button"  title="Ingresar a detalle" href="<?= base_url() ?>evaluacion/convocatoria/<?= encryption($cadena . "||1||2") ?>" >                                                                
                                                                    <span class="<?= $color_1 ?>" style="font-size: 1em;"><b><i class="fa-solid fa-arrow-right-to-bracket fa-lg"></i> <?= $valor_1 ?></b> </span>
                                                                </a>
                                                                <?php } ?>

                                                                <?php
                                                                if ($dato['te_final'] > 0) {
                                                                    if ($dato['te_mis_final'] > 0) {
                                                                        $valor_1 = $dato['te_mis_final'] . " / " . $dato['te_final'] . " EXP";
                                                                        $color_1 = "badge bg-success";
                                                                    } else {
                                                                        $valor_1 = $dato['te_final'] . " EXP";
                                                                        $color_1 = "badge bg-secondary";
                                                                    }
                                                                ?>
                                                                <a type="button"  title="Ingresar a detalle" href="<?= base_url() ?>evaluacion/convocatoria/<?= encryption($cadena . "||2||2") ?>" >                                                                
                                                                    <span class="<?= $color_1 ?>" style="font-size: 1em;"><b><i class="fa-solid fa-arrow-right-to-bracket fa-lg"></i> <?= $valor_1 ?></b> </span>
                                                                </a>
                                                                <?php } ?>
                                                               
                                                            </div>           
                                                        </td>                                                            -->
                                                        </tr>
                                                <?php 
                                                
                                                $total_cantidad_sin_evaluar += $dato['cantidad_sin_evaluar'] ;
                                                $total_cantidad_preliminar += $dato['cantidad_preliminar'] ;
                                                $total_cantidad_final += $dato['cantidad_final'];
                                                $i++;
                                                    }
                                                } ?>
                                                <tr>
                                                    <td class="text-center"><b><?= $i + 1; ?></b></td>
                                                    <td class="text-center"><b>TOTAL</b></td>
                                                    <td class="text-center"><span class="badge bg-danger text-white" style="font-size: 1em;"><?= $totalPostulaciones ?></span></td>
                                                    <td class="text-center"><span class="badge bg-danger text-white" style="font-size: 1em;"><?= $total_cantidad_sin_evaluar ?></span></td>
                                                    <td class="text-center"><span class="badge bg-danger text-white" style="font-size: 1em;"><?= $total_cantidad_preliminar ?></span></td>
                                                    <td class="text-center">
                                                    <span class="badge bg-danger text-white" style="font-size: 1em;"><?= $total_cantidad_final ?></span>
                                                     </tr>
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
</div>

<div class="modal fade" id="modalExcelReport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">GENERAR REPORTE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form id="formReportExcelGeneral" action="<?php echo base_url(); ?>/evaluacion/convocatoria/<?= $convocatoria_id ?>/inscripcion/reporte/excel" method="post" target="_blank">
                        <div class="mb-3 row">
                            <label class="col-4 col-form-label">Inscripción</label>
                            <div class="col-8">
                                <select class="form-control" name="inscripcion_id" required>
                                    <option selected hidden value="">[SELECCIONE]</option>
                                    <option value="-1">TODOS</option>
                                    <?php
                                    foreach ($datos as $dato) {
                                    ?>
                                        <option value="<?= $dato['gin_id'] ?>"><?= $dato['mod_abreviatura'] . " " . $dato['niv_descripcion'] . ($dato['esp_descripcion'] != "-" ? " " . $dato['esp_descripcion'] : "") ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-4 col-form-label">Estado</label>
                            <div class="col-8">
                                <select class="form-control" name="estado" required>
                                    <option selected hidden value="">[SELECCIONE]</option>
                                    <option value="-1">TODOS</option>
                                    <option value="enviado">Enviado</option>
                                    <option value="revisado">Revisado</option>
                                    <option value="rechazado">Rechazado</option>
                                    <option value="finalizado">Finalizado</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success" form="formReportExcelGeneral">Generar Excel</button>
            </div>
        </div>
    </div>
</div>