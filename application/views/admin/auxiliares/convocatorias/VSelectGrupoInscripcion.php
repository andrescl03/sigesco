<select class="form-select form-select-sm" name="opt_grupoInscripcion" id="opt_grupoInscripcion" > 
    <option value="">Elegir...</option>             
    <?php foreach ($grupos as $grupo) { ?>
        <option value="<?= $grupo['gin_id'] ?>" ><?= $grupo['mod_abreviatura']." ".$grupo['niv_descripcion'].($grupo['esp_descripcion']!="-" ? " ".$grupo['esp_descripcion'] : "" ) ?></option>
    <?php } ?>
</select>