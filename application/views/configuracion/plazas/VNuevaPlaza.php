<div class="container">
    <form id="frmMantenimientoPlaza">

        <div class="row">
            <div class="col-md-2 mb-2 mt-1"><b>Periodo:</b></div>
            <div class="col-md-4 mb-2">
                <select class="form-select form-select-sm" name="opt_periodoModal" id="opt_periodoModal">
                    <option value="">Elegir...</option>
                    <?php foreach ($periodos as $periodo) { ?>
                        <option value="<?= $periodo['per_id'] ?>" <?= $periodo['per_default'] == 1 ? "Selected" : "" ?>><?= $periodo['per_anio'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-2 mb-2 mt-1"><b>Estado:</b></div>
            <div class="col-md-4 mb-2">
                <select class="form-select form-select-sm" name="opt_estado" id="opt_estado">
                    <option value="1">Abierto</option>
                    <option value="0">Cerrado</option>
                </select>
            </div>

            <div class="w-100"></div>

            <div class="col-md-2 mb-2 mt-1"><b>Tipo de proceso:</b></div>
            <div class="col-md-10 mb-2">
                <select class="form-select form-select-sm" name="opt_tipoProcesoModal" id="opt_tipoProcesoModal">
                    <option value="">Elegir...</option>
                    <?php foreach ($procesos as $proceso) { ?>
                        <option value="<?= $proceso['pro_id'] ?>" <?= $proceso['pro_default'] == 1 ? "Selected" : "" ?>><?= $proceso['pro_descripcion'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="col-md-2 mb-2 mt-1"><b>Modalidad de contratación:</b></div>
            <div class="col-md-10 mb-2">
                <select class="form-select form-select-sm" name="opt_tipoConvocatoriaModal" id="opt_tipoConvocatoriaModal">
                    <option value="">Elegir...</option>
                    <?php $tipos = [['id' => 1, 'descripcion' => 'PUN'],  ['id' => 2, 'descripcion' => 'EVALUACION DE EXPEDIENTE']]; ?>
                    <?php foreach ($tipos as $tipo) { ?>
                        <option value="<?= $tipo['id'] ?>" <?= $tipo['pro_default'] == 1 ? "Selected" : "" ?>><?= $tipo['descripcion'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="col-md-2 mb-2 mt-1"><b>Institución Educativa:</b></div>
            <div class="col-md-10 mb-2">
                <select class="form-select form-select-sm" name="opt_ieModal" id="opt_ieModal">
                    <option value="">Elegir...</option>
                    <?php foreach ($colegios as $colegio) { ?>
                        <option value="<?= $colegio['loc_id'] ?>" <?= $colegio['loc_id'] == 1 ? "Selected" : "" ?>><?= $colegio['mod_nombre'] ?></option>
                    <?php } ?>
                </select>
            </div>


            <div class="col-md-2 mb-2 mt-1"><b>Nivel:</b></div>
            <div class="col-md-10 mb-2">
                <select class="form-select form-select-sm" name="opt_tipoConvocatoriaModal" id="opt_tipoConvocatoriaModal">
                    <option value="">Elegir...</option>
                    <?php $tipos = [['id' => 1, 'descripcion' => 'PUN'],  ['id' => 2, 'descripcion' => 'EVALUACION DE EXPEDIENTE']]; ?>
                    <?php foreach ($tipos as $tipo) { ?>
                        <option value="<?= $tipo['id'] ?>" <?= $tipo['pro_default'] == 1 ? "Selected" : "" ?>><?= $tipo['descripcion'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-2 mb-2 mt-1"><b>Especialidad:</b></div>
            <div class="col-md-10 mb-2">
                <input class="form-control form-control-sm" id="" name="" type="text" />
            </div>

            <div class="col-md-2 mb-2 mt-1"><b>Jornada :</b></div>
            <div class="col-md-10 mb-2">
                <input class="form-control form-control-sm" id="" name="" type="number" />
            </div>


            <div class="col-md-2 mb-2 mt-1"><b>Tipo de vacante:</b></div>
            <div class="col-md-10 mb-2">
                <select class="form-select form-select-sm" name="opt_tipoConvocatoriaModal" id="opt_tipoConvocatoriaModal">
                    <option value="">Elegir...</option>
                    <option value="">Plaza</option>
                    <option value="">Vacante por contrato eventual</option>
                    <option value="">Reemplazo de titular</option>
                    <option value="">Contrato por horas</option>

                </select>
            </div>


            <div class="col-md-2 mb-2 mt-1"><b>Motivo de vacante:</b></div>
            <div class="col-md-10 mb-2">
                <input class="form-control form-control-sm" id="" name="" type="text" />
            </div>

        </div>

    </form>
</div>