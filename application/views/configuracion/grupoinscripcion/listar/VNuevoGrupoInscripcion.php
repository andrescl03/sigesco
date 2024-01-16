<div class="container">

    <script>
        var dataNiveles = <?php echo json_encode($niveles); ?>;
    </script>

    <form id="frmMantenimientoGrupoInscripcion">

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
            <div class="w-100"></div>
            <div class="col-md-2 mb-2 mt-1"><b>Modalidad:</b></div>
            <div class="col-md-10 mb-2">
                <select class="form-select form-select-sm" name="opt_ModalidadModal" id="opt_ModalidadModal">
                    <option value="" hidden>[SELECCIONE]</option>
                    <?php foreach ($modalidades as $modalidad) { ?>
                        <option value="<?= $modalidad->mod_id ?>"><?= $modalidad->mod_nombre ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="w-100"></div>
            <div class="col-md-2 mb-2 mt-1"><b>Nivel:</b></div>
            <div class="col-md-10 mb-2">
                <select class="form-select form-select-sm" name="opt_NivelModal" id="opt_NivelModal">
                    <option option value="" hidden>[SELECCIONE]</option>

                </select>
            </div>
            <div class="w-100"></div>
            <div class="col-md-2 mb-2 mt-1"><b>Especialidad:</b></div>
            <div class="col-md-10 mb-2">
                <input type="text" class="form-control form-control-sm" id="opt_especialidad" name="opt_especialidad" minlength="1" maxlength="100">
            </div>
        </div>
    </form>
</div>