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
            <?php $i=0; foreach ($datos as $dato) {   ?>
                <tr>
                    <td class="text-center"><b><?= $i+1 ?></b></td>
                    <td><?= $dato['mod_abreviatura']." ".$dato['niv_descripcion'].($dato['esp_descripcion']!="-" ? " ".$dato['esp_descripcion'] : "" ) ?></td>
                    <td class="text-center"><a type="button" class="text-danger btn_eliminarAccion" title="Eliminar"  idGin=<?= $dato['gin_id'] ?> ><b><i class="fa-solid fa-trash-can fa-lg"></i></b></a></td> 
                </tr>
            <?php $i++;} ?>
        </tbody>
    </table>
</div> 