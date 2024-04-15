<div class="table-responsive">
    <table id="tb_listarEvaluacionPunEvaluar" class="table   table-sm" cellspacing="0" width="100%"
        style="font-size:13px; vertical-align: middle;">
        <thead>
            <tr class="cabecera_tabla_2">
                <th class="text-center">#</th>
                <?php if (in_array("convocatorias/cargarexpedientes", $this->session->userdata("sigesco_rutas"))) { ?>
                <th class="text-center">
                    <div class="custom-control custom-checkbox chk_asignarTodosEval mb-2"
                        style="padding-right: 0px; padding-top: 10px;">
                        <input type="checkbox" class="custom-control-input" id="chk_asignarTodosEval_1">
                        <label class="custom-control-label" for="chk_asignarTodosEval_1"></label>
                    </div>
                </th>
                <?php } ?>
                <th class="text-center">ESPECIALISTA</th>
                <th class="text-center">N° DOCUMENTO</th>

                <th>APELLIDOS</th>
                <th>NOMBRES</th>
                <th class="text-center">ORDEN DE MERITO</th>
                <th class="text-center">NÚMERO DE TRAMITE</th>
                <th class="text-center">NÚMERO DE EXPEDIENTE</th>
                <th class="text-center">ADJUNTOS</th>
                <th class="text-center">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0;
            foreach ($datos as $dato) { ?>
            <tr>
                <td class="text-center"><b><?= $i + 1; ?></b></td>
                <?php if (in_array("convocatorias/cargarexpedientes", $this->session->userdata("sigesco_rutas"))) { ?>
                <td class="text-center">
                    <div class="custom-control custom-checkbox chk_asignarEval" style="padding-right: 20px;">
                        <input type="checkbox" class="custom-control-input" id="chk_asignarEval_<?= $i + 1; ?>"
                            value="<?= $dato['id'] . "||" . ($dato['epe_id'] == NULL ? 0 : $dato['epe_id']) ?>"
                            correlativo="<?= $i + 1; ?>">
                        <label class="custom-control-label" for="chk_asignarEval_<?= $i + 1; ?>"></label>
                    </div>
                </td>
                <?php } ?>
                <td><?= toMayus($dato['usu_nombre'] . " " . $dato['usu_apellidos']) ?></td>
                <td class="text-center"><?= $dato['numero_documento'] ?></td>
                <td><?= $dato['apellido_paterno'] . " " . $dato['apellido_materno'] ?></td>
                <td><?= $dato['nombre'] ?></td>
                <td class="text-center"><?= $dato['cpe_orden'] ?></td>
                <td class="text-center">
                    <span class="badge bg-success" style="font-size: 0.9em;"><?= $dato['uid'] ?></span>
                </td>
                <td class="text-center">
                    <span class="badge bg-success" style="font-size: 0.9em;"><?= $dato['numero_expediente'] ?></span>
                </td>
                <td class="text-center">
                    <div class="d-flex justify-content-center gap-2">
                        <!-- Button trigger modal -->
                        <i class="fa fa-th-list fa-2xl text-danger" aria-hidden="true" data-bs-toggle="modal"
                            data-bs-target="#exampleModal<?php echo $dato['id'] ?>"></i>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal<?php echo $dato['id'] ?>" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Archivos Adjuntados</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive mb-3">
                                            <table class="table mb-0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Tipo</th>
                                                        <th scope="col">Nombre</th>
                                                        <th scope="col">Archivo</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($dato['archivos'] as $k2 => $archivo) { ?>
                                                    <tr class="">
                                                        <td><?php echo $archivo['tipo_nombre'] ?></td>
                                                        <td><?php echo $archivo['nombre'] ?></td>
                                                        <td>
                                                            <a href="/public<?php echo $archivo['url'] ?>"
                                                                target="_blank" donwload><i
                                                                    class="fa-solid fa-file-pdf fa-2xl"></i></a>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="text-center">
                    <div class="d-flex justify-content-center gap-2" data-id="<?= $dato['id'] ?>"
                        data-epe_id="<?= $dato['epe_id'] ?>">
                        <?php if ($dato['epe_id'] != NULL) { ?>
                        <a type="button" class="text-dark" title="Ver Ficha"
                            href="<?= base_url() . "evaluacion/ficha/" . encryption($dato['id'] . "||" . ($dato['epe_id'] == NULL ? 0 : $dato['epe_id'])) ?>"
                            target="_blank">EVALUAR FICHA</a>
                        <?php } ?>
                        <a href="<?= base_url() . 'evaluacion/convocatoria/inscripcion/postulante/' . $dato['id'] . '/editar' ?>"
                            class="menu-link text-danger px-3">EDITAR REGISTRO</a>
                    </div>
                </td>
            </tr>
            <?php $i++;
            } ?>
        </tbody>
    </table>
</div>


<div class="modal fade" id="modal-show-asignacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><strong> Asignación dinámica</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label for="tipoSeleccion">Tipo de selección <br><small>(únicamente se seleccionarán expedientes que aún no han sido derivados)</small> </label><br>
                <div class="form-check form-check-inline">
                    <input type="radio" id="todos" name="tipoSeleccion" value="todos" class="form-check-input">
                    <label for="todos" class="form-check-label">Todos</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" id="ingresarValor" name="tipoSeleccion" value="ingresarValor"
                        class="form-check-input">
                    <label for="ingresarValor" class="form-check-label">Ingresa el valor de expedientes a
                        seleccionar</label>
                </div><br>
                <input type="number" class="form-control mt-2" id="inputValor" disabled>
            </div>
            <div class="modal-footer">
                <button type="submit"
                    class="btn btn-seleccionar-asignacion-expedientes btn-sm btn-success">Seleccionar</button>
                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>