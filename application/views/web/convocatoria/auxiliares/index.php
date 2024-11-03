<div class="container">
    <!-- PHP para obtener el año actual -->
    <?php
    $anioActual = date("Y");
    ?>
    <!-- Tarjeta con la lista de convocatorias -->
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h1 class="card-label text-dark"><b>LISTA DE CONVOCATORIAS PARA EL PROCESO DE CONTRATACIÓN AUXILIAR - <?php echo $anioActual; ?></b></h1>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead  class="text-white bg-auxiliar">
                            <tr>
                                <th class="text-center">NÚMERO</th>
                                <th class="text-center">FECHA INICIO DE POSTULACIÓN</th>
                                <th class="text-center">FECHA FIN DE POSTULACIÓN</th>
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

                                    $groupsList = '';

                                    foreach ($datos as $dat) {
                                        if ($dato['con_id'] == $dat['con_id']) {
                                            $groupsList .= '<li>' . $dat['mod_abreviatura'] . " " . $dat['niv_descripcion'] . ($dat['esp_descripcion'] != "-" ? " " . $dat['esp_descripcion'] : "") . '</li>';
                                        }
                                    }
                            ?>
                                    <tr>
                                        <td class="text-center"><b><?= "CONV-CEA-" . sprintf('%04d', $dato['con_numero']) . "-" . $dato['con_anio'] ?></b></td>
                                        <td class="text-center"><?= format_date($dato['con_fechainicio'], "d/m/Y") . " " . substr($dato['con_horainicio'], 0, 5) ?></td>
                                        <td class="text-center"><?= format_date($dato['con_fechafin'], "d/m/Y") . " " . substr($dato['con_horafin'], 0, 5) ?></td>
                                        <td class="text-center"><?= $dato['con_fechainicio_reclamo'] ? (format_date($dato['con_fechainicio_reclamo'], "d/m/Y") . " " . substr($dato['con_horainicio_reclamo'], 0, 5)) : '' ?></td>
                                        <td class="text-center"><?= $dato['con_fechafin_reclamo'] ? (format_date($dato['con_fechafin_reclamo'], "d/m/Y") . " " . substr($dato['con_horafin_reclamo'], 0, 5)) : '' ?></td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#groupsModal" data-groups="<?= htmlspecialchars($groupsList) ?>" data-title="<?= "CONV-CEA-" . sprintf('%04d', $dato['con_numero']) . "-" . $dato['con_anio'] ?>">
                                                Ver Grupos
                                            </button>
                                        </td>
                                        <?php
                                        $validateFechaInicio = $now_unix >= strtotime($dato['con_fechainicio'] . ' ' . substr($dato['con_horainicio'], 0, 5));
                                        $validateFechaFin = ($dato['con_fechafin_reclamo']) ? $now_unix <= (strtotime($dato['con_fechafin_reclamo'] . ' ' . substr($dato['con_horafin_reclamo'], 0, 5))) : $now_unix <= (strtotime($dato['con_fechafin'] . ' ' . substr($dato['con_horafin'], 0, 5)));
                                        $isButtonActive = $validateFechaInicio && $validateFechaFin;
                                        $buttonClass = $isButtonActive ? "btn btn-sm btn-danger" : "btn btn-sm btn-danger disabled";
                                        ?>
                                        <td class="text-center">
                                            <span><?php echo $isButtonActive ? 'ABIERTO' : 'CERRADO' ?></span>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <?php if ($dato['con_tipo'] == 2 || $dato['con_tipo'] == 1) { ?>
                                                    <a type="button" class="<?= $buttonClass ?>" title="Ingresar a postular" data-bs-toggle="modal" data-bs-target="#postularModal" data-conid="<?= $dato['con_id'] ?>" data-contitle="<?= "CONV-CEA-" . sprintf('%04d', $dato['con_numero']) . "-" . $dato['con_anio'] ?>">
                                                        <b><i class="fa-solid fa-arrow-right-to-bracket fa-2xl"></i> POSTULAR</b>
                                                    </a>
                                                <?php } ?>
                                            </div>
                                        </td>
                                    </tr> <!--TEMPORAL -->
                            <?php $i++;
                                }
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

 
    
    <!-- Modal para postular -->
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
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para información del proceso de postulación -->
    <div class="modal fade" id="showInformacionPostulacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Cómo llevar a cabo mi proceso de postulación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-center mx-auto" style="max-width: 80%;">La plataforma SIGESCO utiliza tres niveles de indicadores para mostrar en qué etapa de la postulación te encuentras. Estos indicadores te ayudarán a seguir el progreso de tu postulación de manera clara y sencilla.</p>
                    <div class="text-center">
                        <img src="<?php echo base_url() ?>assets/image/escala-de-satisfaccion.png" alt="niveles de satisfacción" class="img-fluid" style="max-width: 110px;">
                    </div>
                    <div id="postulacionCarousel" class="carousel slide" data-bs-ride="carousel">
                        <!-- Indicators -->
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#postulacionCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Paso 1" style="background-color: red;"></button>
                            <button type="button" data-bs-target="#postulacionCarousel" data-bs-slide-to="1" aria-label="Paso 2" style="background-color: yellow;"></button>
                            <button type="button" data-bs-target="#postulacionCarousel" data-bs-slide-to="2" aria-label="Paso 3" style="background-color: green;"></button>
                        </div>
                        <!-- Slides -->
                        <div class="carousel-inner">
                            <!-- Paso 1 -->
                            <div class="carousel-item active">
                                <h6 class="fw-bold text-center">1. Postulación en SIGESCO</h6>
                                <div class="text-center">
                                    <img src="<?php echo base_url() ?>assets/image/escala_paso_uno.png" alt="niveles de satisfacción" class="img-fluid" style="max-width: 60px;">
                                </div>
                                <p class="text-center mx-auto" style="max-width: 80%;">Accede al sistema SIGESCO y completa el formulario de postulación. Asegúrate de adjuntar todos los documentos requeridos antes de enviar tu solicitud.</p>
                                <div class="mt-3 text-center">
                                    <span class="badge bg-primary">Paso 1 de 3</span>
                                </div>
                            </div>

                            <!-- Paso 2 -->
                            <div class="carousel-item">
                                <h6 class="fw-bold text-center">2. Postulación en Minedu en Línea</h6>
                                <div class="text-center">
                                    <img src="<?php echo base_url() ?>assets/image/escala_paso_dos.png" alt="niveles de satisfacción" class="img-fluid" style="max-width: 60px;">
                                </div>
                                <p class="text-center mx-auto" style="max-width: 80%;">Una vez que hayas completado tu postulación en SIGESCO, ingresa al portal del Minedu en Línea. Aquí deberás verificar la información de tu postulación y confirmar tu solicitud.</p>
                                <div class="mt-3 text-center">
                                    <span class="badge bg-primary">Paso 2 de 3</span>
                                </div>
                            </div>

                            <!-- Paso 3 -->
                            <div class="carousel-item">
                                <h6 class="fw-bold text-center">3. Asignación de Expediente</h6>
                                <div class="text-center">
                                    <img src="<?php echo base_url() ?>assets/image/escala_paso_tres.png" alt="niveles de satisfacción" class="img-fluid" style="max-width: 60px;">
                                </div>
                                <p class="text-center mx-auto" style="max-width: 80%;">Después de confirmar tu postulación en el Minedu en Línea, recibirás un número de expediente. Este número es necesario registrarlo en SIGESCO para dar por culminado su proceso de postulación.</p>
                                <div class="mt-3 text-center">
                                    <span class="badge bg-primary">Paso 3 de 3</span>
                                </div>
                            </div>
                        </div>
                        <!-- Controles del Carousel -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#postulacionCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: red;"></span>
                            <span class="visually-hidden">Anterior</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#postulacionCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: red;"></span>
                            <span class="visually-hidden">Siguiente</span>
                        </button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal para ver grupos de inscripción -->
<div class="modal fade" id="groupsModal" tabindex="-1" aria-labelledby="groupsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="groupsModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Lista de grupos de inscripción</th>
                            </tr>
                        </thead>
                        <tbody id="groupsTableBody">
                            <!-- Aquí se llenará la tabla de grupos dinámicamente -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

</div>