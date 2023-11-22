
<h4 class="mt-3"><b><i class="far fa-object-ungroup fa-sm"></i> Evaluación de postulantes / <?= $datos[0]['pro_descripcion'] ?> | Convocatoria <?= sprintf('%04d', $datos[0]['con_numero'])."-".$datos[0]['con_anio'] ?></b></h4>
    <ol class="breadcrumb mb-2">
        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"> Inicio</a></li>
        <li class="breadcrumb-item"><a href="<?php echo base_url()."evaluacion/convocatoria/".encryption('0||0'); ?>"> Evaluación de postulantes</a></li>
        <li class="breadcrumb-item active"><?= $datos[0]['pro_descripcion'] ?> | Convocatoria <?= sprintf('%04d', $datos[0]['con_numero'])."-".$datos[0]['con_anio'] ?></li>
    </ol>   
    <div class="app-row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="card border-secondary" >
                        <div class="card-body text-dark">
                            <div class="text-right mb-2">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card border bg-light">
                                            <div class="card-body" style="padding: 0.8rem 1rem;">
                                                <div class="row">
                                                    <div class="col-sm-12 ">
                                                        <div class="d-flex align-content-start flex-wrap gap-3">                                                       
                                                            <div class="col-sm-4"><input type="text" class="form-control form-control-sm" id="txt_buscador" placeholder="Buscar..." ></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  
                                        </div> 
                                    </div>
                                    <div class="col-sm-12"  id="">

                                        <div class="table-responsive">
                                            <table id="tb_listarConvocatorias" class="table  table-hover table-sm" cellspacing="0" width="100%" style="font-size:13px; vertical-align: middle;">
                                                <thead>
                                                    <tr class="cabecera_tabla_2">
                                                        <th class="text-center">#</th>                                                   
                                                        <th class="text-center">GRUPOS DE INSCRIPCIÓN</th>
                                                        <th class="text-center">ASIGNACIÓN</th>
                                                        <th class="text-center">EVALUACIÓN PRELIMINAR</th>
                                                        <th class="text-center">EVALUACIÓN FINAL</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        writer($datos);
                                                        $i=0; foreach ($datos as $dato) { 
                                                            $cadena = $dato['con_id']."||".$dato['gin_id'];
                                                            $parte_1 = ($dato['tp_asigando'] > 0 ? $dato['tp_asigando'] : 0) + ($dato['te_asigando'] > 0 ? $dato['te_asigando'] : 0);
                                                            $parte_2 = $dato['tp_docentes'] + $dato['te_docentes'];
                                                    ?>
                                                    <tr>
                                                        <td class="text-center"><b><?= $i+1;?></b></td>
                                                        <td><?= $dato['mod_abreviatura']." ".$dato['niv_descripcion'].($dato['esp_descripcion']!="-" ? " ".$dato['esp_descripcion'] : "" ) ?></td>
                                                        <td class="text-center"><span class="badge rounded-pill bg-warning text-dark" style="font-size: 1em;"><?= $parte_1 ." / ".$parte_2 ?></span></b></td>
                                                        <td class="text-center">
                                                            <div class="d-flex justify-content-center gap-3">
                                                                <?php 
                                                                    if($dato['tp_preliminar'] > 0 ){ 
                                                                        if($dato['tp_mis_preliminar'] > 0){
                                                                            $valor_1 = $dato['tp_mis_preliminar']." / ".$dato['tp_preliminar']." PUN";
                                                                            $color_1 = "badge bg-success";
                                                                        }else{
                                                                            $valor_1 = $dato['tp_preliminar']." PUN";
                                                                            $color_1 = "badge bg-secondary";
                                                                        }
                                                                ?>

                                                                <a type="button"  title="Ingresar a detalle" href="<?= base_url()?>evaluacion/convocatoria/<?= encryption($cadena."||1||1") ?>" >                                                                
                                                                    <span class="<?= $color_1 ?>" style="font-size: 1em;"><b><i class="fa-solid fa-arrow-right-to-bracket fa-lg"></i> <?= $valor_1 ?></b> </span>
                                                                </a>
                                                                <?php } ?>

                                                                <?php 
                                                                    if($dato['te_preliminar'] > 0 ){ 
                                                                        if($dato['te_mis_preliminar'] > 0){
                                                                            $valor_1 = $dato['te_mis_preliminar']." / ".$dato['te_preliminar']." EXP";
                                                                            $color_1 = "badge bg-primary";
                                                                        }else{
                                                                            $valor_1 = $dato['te_preliminar']." EXP";
                                                                            $color_1 = "badge bg-secondary";
                                                                        }
                                                                ?>

                                                                <a type="button"  title="Ingresar a detalle" href="<?= base_url()?>evaluacion/convocatoria/<?= encryption($cadena."||2||1") ?>" >                                                                
                                                                    <span class="<?= $color_1 ?>" style="font-size: 1em;"><b><i class="fa-solid fa-arrow-right-to-bracket fa-lg"></i> <?= $valor_1 ?></b> </span>
                                                                </a>
                                                                <?php } ?>
                                                                <a type="button"  title="Ingresar a detalle" href="<?= base_url()?>evaluacion/convocatoria/<?= encryption($cadena."||1||1") ?>" >                                                                
                                                                    <span class="badge bg-success" style="font-size: 1em;"><b><i class="fa-solid fa-arrow-right-to-bracket fa-lg"></i> <?= $valor_1 ?></b> </span>
                                                                </a>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="d-flex justify-content-center gap-3">
                                                                <?php 
                                                                    if($dato['tp_final'] > 0 ){ 
                                                                        if($dato['tp_mis_final'] > 0){
                                                                            $valor_1 = $dato['tp_mis_final']." / ".$dato['tp_final']." PUN";
                                                                            $color_1 = "badge bg-success";
                                                                        }else{
                                                                            $valor_1 = $dato['tp_final']." PUN";
                                                                            $color_1 = "badge bg-secondary";
                                                                        }
                                                                ?>
                                                                <a type="button"  title="Ingresar a detalle" href="<?= base_url()?>evaluacion/convocatoria/<?= encryption($cadena."||1||2") ?>" >                                                                
                                                                    <span class="<?= $color_1 ?>" style="font-size: 1em;"><b><i class="fa-solid fa-arrow-right-to-bracket fa-lg"></i> <?= $valor_1 ?></b> </span>
                                                                </a>
                                                                <?php } ?>

                                                                <?php 
                                                                    if($dato['te_final'] > 0 ){ 
                                                                        if($dato['te_mis_final'] > 0){
                                                                            $valor_1 = $dato['te_mis_final']." / ".$dato['te_final']." EXP";
                                                                            $color_1 = "badge bg-success";
                                                                        }else{
                                                                            $valor_1 = $dato['te_final']." EXP";
                                                                            $color_1 = "badge bg-secondary";
                                                                        }
                                                                ?>
                                                                <a type="button"  title="Ingresar a detalle" href="<?= base_url()?>evaluacion/convocatoria/<?= encryption($cadena."||2||2") ?>" >                                                                
                                                                    <span class="<?= $color_1 ?>" style="font-size: 1em;"><b><i class="fa-solid fa-arrow-right-to-bracket fa-lg"></i> <?= $valor_1 ?></b> </span>
                                                                </a>
                                                                <?php } ?>
                                                               
                                                            </div>           
                                                        </td>                                                           
                                                    </tr>
                                                    <?php $i++; } ?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>                                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>