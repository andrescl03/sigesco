<?php
    $editValues = []; // Placeholder for values when editing
    $datos = [];
    $isEdit = $oldConvocatoria;
    if ($isEdit) {
        $editValues = [
            'periodo' => 1,
            'estado' => $oldConvocatoria['con_estado'],
            'tipoProceso' => $oldConvocatoria['pro_id'],
            'tipoConvocatoria' => $oldConvocatoria['con_tipo'],
            'fechaInicio' => $oldConvocatoria['con_fechainicio'],
            'fechaFin' => $oldConvocatoria['con_fechafin'],
            'horaInicio' => $oldConvocatoria['con_horainicio'],
            'horaFin' => $oldConvocatoria['con_horafin'],
            'fechaInicioReclamo' => $oldConvocatoria['con_fechainicio_reclamo'],
            'fechaFinReclamo' => $oldConvocatoria['con_fechafin_reclamo'],
            'horaInicioReclamo' => $oldConvocatoria['con_horainicio_reclamo'],
            'horaFinReclamo' => $oldConvocatoria['con_horafin_reclamo'],
            'tipo' => $oldConvocatoria['con_tipo']
        ];
        $datos = $convocatoria_grupos;
    }       
     $items = [];
    if ($isEdit) {
        foreach ($convocatoria_grupos as $k => $o) {
            $items[] = $o['gin_id'];
        }
        count($items);
        
    }
?>
<div class="container" 
     id="convocatoriaModalContainer" 
     data-grupoArr="<?= count($items) > 0 ? implode(',',$items) : '' ?>" 
     data-fecha-inicio="<?= $isEdit ? $oldConvocatoria['unix_inicio'] : '' ?>" 
     data-fecha-fin="<?= $isEdit ? $oldConvocatoria['unix_fin'] : '' ?>"
     data-fecha-inicio-reclamo="<?= $isEdit ? $oldConvocatoria['unix_inicio_reclamo'] : '' ?>" 
     data-fecha-fin-reclamo="<?= $isEdit ? $oldConvocatoria['unix_fin_reclamo'] : '' ?>" 

 >

<form id="frmMantenimientoConvocatoria" data-id="<?= $isEdit ? $oldConvocatoria['con_id'] : 0 ?>">
        <div class="row">
            <div class="col-md-2 mb-2 mt-1"><b>Periodo:</b></div>
            <div class="col-md-4 mb-2">
                <select class="form-select form-select-sm" name="opt_periodoModal" id="opt_periodoModal">
                    <option value="">Elegir...</option>
                    <?php foreach ($periodos as $periodo) { ?>
                        <option value="<?= $periodo['per_id'] ?>" <?= ($isEdit && $editValues['periodo'] == $periodo['per_id']) ? "selected" : "" ?>><?= $periodo['per_anio'] ?></option>

                    <?php } ?>
                </select>
            </div>
            <div class="col-md-2 mb-2 mt-1"><b>Estado:</b></div>
            <div class="col-md-4 mb-2">
                <select class="form-select form-select-sm" name="opt_estado" id="opt_estado">
                    <option value="1" <?= ($isEdit && $editValues['estado'] == 1) ? "selected" : "" ?>>Abierto</option>
                    <option value="0" <?= ($isEdit && $editValues['estado'] == 0) ? "selected" : "" ?>>Cerrado</option>
                </select>
            </div>

            <div class="w-100"></div>

            <div class="col-md-2 mb-2 mt-1"><b>Tipo de proceso:</b></div>
            <div class="col-md-10 mb-2">
                <select class="form-select form-select-sm" name="opt_tipoProcesoModal" id="opt_tipoProcesoModal">
                    <option value="">Elegir...</option>
                    <?php foreach ($procesos as $proceso) { ?>
                        <option value="<?= $proceso['pro_id'] ?>" <?= $proceso['pro_id'] == 2 ? "Selected" : "" ?>><?= $proceso['pro_descripcion'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-2 mb-2 mt-1"><b>Tipo de convocatoria:</b></div>
            <div class="col-md-10 mb-2">
                <select class="form-select form-select-sm" name="opt_tipoConvocatoriaModal" id="opt_tipoConvocatoriaModal">
                    <option value="">Elegir...</option>
                    <?php foreach ($tipos as $tipo) { ?>
                        <option value="<?= $tipo['tipo_id'] ?>" <?= $isEdit ? ($tipo['tipo_id'] == $editValues['tipo'] ? "Selected" : "") : ($tipo['pro_default'] == 2 ? "Selected" : "") ?>><?= $tipo['descripcion'] ?></option>
                    <?php } ?>
                </select>
            </div>

        </div>

        <div class="row">
            <div class="col-md-12 mb-2 mt-1"><b>Fecha de la convocatoria:</b></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="input-daterange" id="dp_fechasBusqueda">
                    <div class="row">
                        <div class="col-md-2 mb-2 mt-1"><b>Fecha Desde:</b></div>
                        <div class="col-md-4 mb-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend" style="color: Dodgerblue; background-color: #ffff;"><i class="far fa-calendar-alt fa-lg"></i></span>
                                </div>
                                <input type="text" class="form-control form-control-sm" id="fecha_inicio" name="fecha_inicio" placeholder="Desde" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-2 mb-2 mt-1"><b>Fecha Hasta:</b></div>
                        <div class="col-md-4 mb-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend" style="color: Dodgerblue; background-color: #ffff;"><i class="far fa-calendar-alt fa-lg"></i></span>
                                </div>
                                <input type="text" class="form-control form-control-sm" id="fecha_fin" name="fecha_fin" placeholder="Hasta" value="" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mb-2 mt-1"><b>Fecha de reclamo:</b></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="input-daterange" id="dp_fechasBusquedaReclamo">
                    <div class="row">
                        <div class="col-md-2 mb-2 mt-1"><b>Fecha Desde:</b></div>
                        <div class="col-md-4 mb-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend" style="color: Dodgerblue; background-color: #ffff;"><i class="far fa-calendar-alt fa-lg"></i></span>
                                </div>
                                <input type="text" class="form-control form-control-sm" id="fecha_inicio_reclamo" name="fecha_inicio_reclamo" placeholder="Desde" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-2 mb-2 mt-1"><b>Fecha Hasta:</b></div>
                        <div class="col-md-4 mb-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend" style="color: Dodgerblue; background-color: #ffff;"><i class="far fa-calendar-alt fa-lg"></i></span>
                                </div>
                                <input type="text" class="form-control form-control-sm" id="fecha_fin_reclamo" name="fecha_fin_reclamo" placeholder="Hasta" value="" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-3" style="background-color: #DE1F29; border: 0 none; height: 2px;">

        <div class="row">
            <div class="col-md-3 mb-2 mt-1"><b>Grupo de Inscripción:</b></div>
            <div class="col-md-6 mb-2" id="view_selectGrupoInscripcion">
                <select class="form-select form-select-sm" name="opt_grupoInscripcion" id="opt_grupoInscripcion">
                    <option value="">Elegir...</option>
                    <?php foreach ($grupos as $grupo) { ?>
                        <option value="<?= $grupo['gin_id'] ?>"><?= $grupo['mod_abreviatura'] . " " . $grupo['niv_descripcion'] . ($grupo['esp_descripcion'] != "-" ? " " . $grupo['esp_descripcion'] : "") ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="d-grid gap-2 col-md-3 mb-2">
                <button class="btn btn-outline-success btn-sm btn_asignarGrupoInscripcion" type="button"><b><i class="fa-solid fa-circle-chevron-down fa-lg"></i> Asignar</b></button>
            </div>
        </div>
        <div class="row" id="view_tablaGrupoInscripcion">
            <div class="table-responsive">
                <table id="tb_listarGrupoInscripcion" class="table table-sm" cellspacing="0" width="100%" style="font-size:13px; vertical-align: middle;">
                    <thead>
                        <tr class="cabecera_tabla_2">
                            <th class="text-center">#</th>
                            <th class="text-center">Grupo de Inscripción</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0;
                        foreach ($datos as $dato) {   ?>
                            <tr>
                                <td class="text-center"><b><?= $i + 1 ?></b></td>
                                <td><?= $dato['mod_abreviatura'] . " " . $dato['niv_descripcion'] . ($dato['esp_descripcion'] != "-" ? " " . $dato['esp_descripcion'] : "") ?></td>
                                <td class="text-center"><a type="button" class="text-danger btn_eliminarAccion" title="Eliminar" idGin=<?= $dato['gin_id'] ?>><b><i class="fa-solid fa-trash-can fa-lg"></i></b></a></td>
                            </tr>
                        <?php $i++;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>



    </form>
</div>