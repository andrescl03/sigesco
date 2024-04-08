<div class="container">
<?php
 //Obtener el año actual del servidor
   $anioActual = date("Y");
?>
    <div class="card card-custom ">
        <div class="card-header">
            <div class="card-title ">
                <h1 class="card-label ">LISTA DE CONVOCATORIAS PARA EL PROCESO DE CONTRATACIÓN DOCENTE - <?php echo $anioActual; ?></h1>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead style="background-color:red" class="text-white">
                            <tr>
                                <!-- <th class="text-center">#</th>-->
                                <th class="text-center">NÚMERO</th>
                                <th class="text-center">TIPO</th>
                                <th class="text-center">FECHA INICIO DE POSTULACION</th>
                                <th class="text-center">FECHA FIN DE POSTULACION</th>
                                <th class="text-center">FECHA INICIO DE RECLAMO</th>
                                <th class="text-center">FECHA FIN DE RECLAMO</th>
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
                                        <td class="text-center"><?= $dato['descripcion'] ?></td>
                                        <td class="text-center"><?= format_date($dato['con_fechainicio'], "d/m/Y") . " " . substr($dato['con_horainicio'], 0, 5) ?> </td>
                                        <td class="text-center"><?= format_date($dato['con_fechafin'], "d/m/Y") . " " . substr($dato['con_horafin'], 0, 5) ?></td>
                                        <td class="text-center"><?= $dato['con_fechainicio_reclamo'] ? (format_date($dato['con_fechainicio_reclamo'], "d/m/Y") . " " . substr($dato['con_horainicio_reclamo'],0,5 )) : ('')?></td>
                                        <td class="text-center"><?= $dato['con_fechafin_reclamo'] ? (format_date($dato['con_fechafin_reclamo'], "d/m/Y") . " " . substr($dato['con_horafin_reclamo'],0,5 )) : ('')?></td>
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
                                        <?php
                                            $validateFechaInicio =  $now_unix >= strtotime($dato['con_fechainicio'] . ' ' . substr($dato['con_horainicio'], 0, 5));
                                            $validateFechaFin = ($dato['con_fechafin_reclamo']) ? $now_unix <= (strtotime($dato['con_fechafin_reclamo'] . ' ' . substr($dato['con_horafin_reclamo'], 0, 5))) : $now_unix <=   (strtotime($dato['con_fechafin'] . ' ' . substr($dato['con_horafin'], 0, 5))); 
                                            $isButtonActive = $validateFechaInicio && $validateFechaFin ;
                                            $buttonClass = $isButtonActive ? "btn btn-sm btn-danger" : "btn btn-sm btn-danger disabled";
                                        ?>
                                        <td class="text-center">
                                            <span class=""><?php echo $isButtonActive  ? 'ABIERTO' : 'CERRADO' ?> </span>
                                        </td>
                                       
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <?php if ($dato['con_tipo'] == 2  || $dato['con_tipo'] == 1) { ?>
                                                    <a type="button" class="<?= $buttonClass ?>"  title="Ingresar a postular" data-bs-toggle="modal" data-bs-target="#postularModal" data-conid="<?= $dato['con_id'] ?>" data-contitle="<?= "CONV-" . sprintf('%04d', $dato['con_numero']) . "-" . $dato['con_anio']  ?>" <b> <i class="fa-solid fa-arrow-right-to-bracket fa-2xl"></i>POSTULAR</b>
                                                    </a>
                                                <?php } ?>

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
    <div class="modal fade" id="postularModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <!-- Puedes agregar más botones en el footer si es necesario. -->
                </div>
            </div>
        </div>
    </div>
</div>