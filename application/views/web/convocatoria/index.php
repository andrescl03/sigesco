<div class="container">
    <div class="card card-custom ">
        <div class="card-header ">
            <div class="card-title ">
                <h1 class="card-label ">Lista de convocatorias para el proceso de contratación docente - 2023</h1>
            </div>
        </div>
        <div class="card-body">
            <div class="">
                <table class="table table-hover">
                    <thead style="background-color:red" class="text-white">
                        <tr>
                            <!-- <th class="text-center">#</th>-->
                            <th class="text-center">NÚMERO</th>
                            <th class="text-center">FECHA DE INICIO</th>
                            <th class="text-center">FECHA DE FIN</th>
                            <th class="text-center">GRUPOS DE INSCRIPCIÓN</th>
                            <th class="text-center">ESTADO</th>
                            <th class="text-center">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $arrUnicos = [];
                        $i = 0;
                        foreach ($datos as $dato) {
                            if (!in_array($dato['con_id'], $arrUnicos)) {
                                $arrUnicos[] = $dato['con_id'];
                                $cadena = $dato['con_id'] . "||0";
                        ?>
                                <tr>
                                    <!--<td class="text-center"><b><?= $i + 1; ?></b></td>-->
                                    <td class="text-center"><b><?= "CONV-" . sprintf('%04d', $dato['con_numero']) . "-" . $dato['con_anio'] ?></b></td>
                                    <td class="text-center"><?= format_date($dato['con_fechainicio'], "d/m/Y") ?></td>
                                    <td class="text-center"><?= format_date($dato['con_fechafin'], "d/m/Y") ?></td>
                                    <td>
                                        <ul class="list-group list-group-flush">
                                            <?php
                                            foreach ($datos as $dat) {
                                                if ($dato['con_id'] == $dat['con_id']) {
                                                    echo '<li>' . $dat['mod_abreviatura'] . " " . $dat['niv_descripcion'] . ($dat['esp_descripcion'] != "-" ? " " . $dat['esp_descripcion'] : "") . '</li>';
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </td>
                                    <td class="text-center">
                                        <span class=""><?php echo $dato['con_estado'] ? 'ABIERTO' : 'CERRADO' ?> </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                        <a type="button" class="btn btn-danger <?= $dato['con_estado'] ? '' : 'disabled' ?>" title="Ingresar a postular" href="<?= base_url() ?>web/convocatorias/<?= $dato['con_id'] ?>">
    <b><i class="fa-solid fa-arrow-right-to-bracket fa-2xl"></i>POSTULAR</b>
</a>
                                        </div>
                                    </td>
                                </tr>
                        <?php $i++;
                            }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>