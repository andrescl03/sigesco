
<div class="col-sm-12"  id="view_listarEvaluacionPun">
    
    <div class="table-responsive">
        <table id="tb_listarEvaluacionPun" class="table  table-hover table-sm" cellspacing="0" width="100%" style="font-size:13px; vertical-align: middle;">
            <thead>
                <tr class="cabecera_tabla_2">
                    <th class="text-center">#</th>
                    <th class="text-center">                       
                        <div class="custom-control custom-checkbox chk_asignarTodosEval mb-2" style="padding-right: 0px; padding-top: 10px;">
                            <input type="checkbox" class="custom-control-input" id="chk_asignarTodosEval_1" >
                            <label class="custom-control-label" for="chk_asignarTodosEval_1"></label>
                        </div>                      
                    </th>
                    <th class="text-center">N° DOCUMENTO</th>
                    <th >APELLIDOS</th>
                    <th >NOMBRES</th>
                    <th class="text-center">ORDEN DE MERITO</th>
                    <th class="text-center">EXPEDIENTES</th>
                    <th class="text-center">ADJUNTOS</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=0; foreach ($datos as $dato) { ?>
                <tr>
                    <td class="text-center"><b><?= $i+1;?></b></td>
                    <td class="text-center">
                        <div class="custom-control custom-checkbox <?= (($dato['cpe_sepresento']==2)  ? "chk_asignarEval" : "") ?>" style="padding-right: 20px;">
                            <input type="checkbox" class="custom-control-input" id="chk_asignarEval_<?= $i+1;?>" value="<?= $dato['cpe_id']."||".count($dato['expediente']) ?>" <?= ($dato['cpe_sepresento']!=2 ? "checked disabled" : "") ?>  correlativo ="<?= $i+1;?>" >
                            <label class="custom-control-label" for="chk_asignarEval_<?= $i+1;?>"></label>
                        </div>                   
                    </td>
                    <td class="text-center"><?= $dato['cpe_documento'] ?></td>	
                    <td><?= $dato['cpe_apellidos'] ?></td>
                    <td><?= $dato['cpe_nombres'] ?></td>
                    <td class="text-center"><?= $dato['cpe_orden'] ?></td>
                    <td class="text-center">
                        <?php
                            if($dato['cpe_sepresento'] == 0){ //0: NO SE PRESENTÓ , 2: REGISTRADO, 1: PRESENTO EXP.
                                echo '<span class="badge bg-warning text-dark" style="font-size: 0.85em;">NO REGISTRÓ EXPEDIENTE</span>';
                            }else{                            
                                foreach ($dato['expediente'] as $value_1) {
                                    if($dato['cpe_sepresento'] == 1){
                                        echo '<span class="badge bg-success" style="font-size: 0.9em;">'.$value_1['codigo'].'</span>'."</br>";
                                    }else{
                                        echo "<b>".$value_1['codigo']."</b>"."</br>";
                                    }
                                }
                            }
                          
                        ?>
                    </td>
                    <td class="text-center">
                    <div class="d-flex justify-content-center gap-2">                  
                        <?php 
                            foreach ($dato['expediente'] as $key => $value_1) {
                                foreach ($value_1['archivo'] as $value_2) {
                                    switch ($value_2['procedencia']) {
                                        case '1':  // MPV
                                            $url = base_url().'descargas/expedientesmpv/'.encryption($value_2['idArch']);
                                        break;
                                        case '2': // INTERNO                                      
                                            $url = base_url().'descargas/expedientes/'.encryption($value_2['idArch']);
                                        break;
                                    }
                                    switch ($value_2['tipo']) {
                                        case '1':  // ADJUNTO
                                            $icono = '<i class="fa-solid fa-file-pdf fa-2xl"></i>';
                                            $color = 'text-danger';
                                        break;
                                        case '2': // FUT
                                            $icono = '<i class="fa-solid fa-file-pdf fa-2xl"></i>';
                                            $color = 'text-primary';
                                        break;
                                    }
                                    echo '<a type="button" class="'.$color.'" title="Descargar" href="'.$url.'" target="_blank" ><b>'.$icono.'</b></a>';
                                }                                
                                if($key != count($dato['expediente'])-1){
                                    echo '<div class="vr"></div>';
                                }
                            }
                        ?>
                        </div> 
                    </td>
                </tr>
                <?php $i++; } ?>
            </tbody>	
        </table>
    </div>





</div>