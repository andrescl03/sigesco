<select class="form-select form-select-sm"  data-placeholder="Elegir trámite..." name="opt_tramite" id="opt_tramite" >
    <option></option>
    <?php foreach ($tramites as $tramite) { ?>
        <option value="<?= $tramite['tcr_id'] ?>" ><?= toMayus($tramite['tcr_descripcion']) ?></option>
    <?php }  ?>
</select>