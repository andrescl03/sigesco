<h4 class="mt-3"><b><i class="far fa-object-ungroup fa-sm"></i> Ficha de evaluación</b></h4>
    <ol class="breadcrumb mb-2">
        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"> Inicio</a></li>
        <!-- <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>/porderivar/listar"> Expedientes Por Derivar</a></li>
        <li class="breadcrumb-item active">Registro de Expediente Externo</li> -->
    </ol>

    <div class="app-row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="card border-secondary" >
                        <div class="card-body text-dark">  			  		
                            <div class="text-right mb-2">
                                <div class="row">  
                                    
                                    <?php // writer($datos); ?>
                                    <div class="table-responsive">
                                        <table id="tb_listarConvocatorias" class="table table-sm table-bordered" cellspacing="0" width="100%" style="font-size:13px; vertical-align: middle;">
                                            <thead>
                                                <tr class="">
                                                    <th class="text-center">RUBRO</th>
                                                    <th class="text-center">CRITERIO</th>
                                                    <th class="text-center">SUBCRITERIO</th>
                                                    <th class="text-center">EVALUACIÓN</th>
                                                    <th class="text-center">PUNTAJE MAXIMO POR CRITERIO</th> 
                                                    <th class="text-center">PUNTAJE MAXIMO POR RUBRO</th>                                                  
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    <?php  
                                                        $i=0; 
                                                        foreach ($datos as $dato) { 
                                                            if($dato['cfi_tipoColumna'] == "RUBRO"){
                                                                $col_R = 3;                                                                
                                                            }else{
                                                                $col_R = 1;                                                                
                                                            }
                                                            if($dato['cfi_tipoColumna'] == "CRITERIO"){
                                                                $col_C = 2;                                                               
                                                            }else{
                                                                $col_C = 1;                                                             
                                                            }                                                            
                                                            if($dato['cfi_tipoColumna'] == "PRE_SUBCRITERIO" || $dato['cfi_tipoColumna'] == "SUBCRITERIO"){                                                                
                                                                if($dato['cfi_rangoInicio'] == $dato['cfi_id']){ 
                                                                    $row_SUB =  (int) ($dato['cfi_rangoFin'] - $dato['cfi_rangoInicio']+1);
                                                                }else{
                                                                    $row_SUB = 1; 
                                                                }                                                         
                                                            }else{                                                               
                                                                $row_SUB = 1;
                                                            }
                                                            if($dato['cfi_tipoColumna'] == "RUBRO"){                                                                
                                                                if($dato['cfi_rangoInicio'] == $dato['cfi_id']){ 
                                                                    $row_RUBRO =  (int) ($dato['cfi_rangoFin'] - $dato['cfi_rangoInicio']+1);
                                                                }else{
                                                                    $row_RUBRO = 1; 
                                                                }                                                         
                                                            }else{                                                               
                                                                $row_RUBRO = 1;
                                                            }
                                                        
                                                    ?>
                                                        <tr>
                                                            <td colspan="<?= $col_R ?>" style="font-size:16px;" class="text-primary">
                                                                <b>
                                                                <?php 
                                                                    if($dato['cfi_tipoColumna'] == "RUBRO"){
                                                                        echo toMayus($dato['cfi_descripcion']);
                                                                    }
                                                                ?>
                                                                </b>
                                                            </td>

                                                            <?php if($dato['cfi_tipoColumna'] != "RUBRO"){ ?>

                                                                <td colspan="<?= $col_C ?>" style="font-size:15px;">
                                                                    <b>
                                                                    <?php 
                                                                        if($dato['cfi_tipoColumna'] == "CRITERIO"){
                                                                            echo $dato['cfi_descripcion'];
                                                                        }
                                                                    ?>
                                                                    </b>
                                                                </td>

                                                                <?php if($dato['cfi_tipoColumna'] != "CRITERIO"){ ?>

                                                                    <td>
                                                                        <?php 
                                                                            if($dato['cfi_tipoColumna'] == "PRE_SUBCRITERIO"){
                                                                                echo $dato['cfi_descripcion'];
                                                                            }
                                                                            if($dato['cfi_tipoColumna'] == "SUBCRITERIO"){
                                                                                echo $dato['cfi_descripcion'];
                                                                            }
                                                                            if($dato['cfi_tipoColumna'] == "POST_SUBCRITERIO"){
                                                                                echo $dato['cfi_descripcion'];
                                                                            }

                                                                        ?>
                                                                    </td>
                                                                <?php } ?>
                                                            
                                                            <?php } ?>

                                                            <td class="text-center" style="background: #f5f9f4;">
                                                                <?php 
                                                                
                                                                    if($dato['cfi_tipoColumna'] == "SUBCRITERIO" || $dato['cfi_tipoColumna'] == "POST_SUBCRITERIO" ){
                                                                       
                                                                        if($dato['cfi_tipoInput']=="checkbox"){
                                                                            echo '<div class="form-check"><input class="form-check-input" type="checkbox" value="" id="pregunta_'.$i.'" style="width: 1.5em;height: 1.5em; float:none;"><label class="form-check-label" for="pregunta_'.$i.'"></label></div>';
                                                                        }
                                                                        if($dato['cfi_tipoInput']=="select+"){
                                                                            echo "<b>".$dato['cfi_etiquetaInput'].':</b>';
                                                                            echo '<select class="form-select form-select-sm" name="pregunta_'.$i.'" id="pregunta_'.$i.'">';                                                                           
                                                                            for ($i=0; $i <= $dato['cfi_limite'] ; $i++) { 
                                                                               echo '<option value="'.$i.'">'.$i.'</option>';
                                                                            }
                                                                            echo '<option value="'.($i-1).'">'.($i-1).' +</option>';
                                                                            echo '</select>';
                                                                            
                                                                        }
                                                                        if($dato['cfi_tipoInput']=="number"){
                                                                            echo "<b>".$dato['cfi_etiquetaInput'].':</b>';
                                                                            echo ' <input type="text" class="form-control form-control-sm" name="pregunta_'.$i.'" id="pregunta_'.$i.'" onkeypress="return soloNumeros(event)" onblur="limpiaNumeros(this)" >';
                                                                        }
                                                                    }
                                                                ?> 
                                                            </td>

                                                            <?php  if($dato['cfi_tipoColumna'] == "PRE_SUBCRITERIO" || $dato['cfi_tipoColumna'] == "SUBCRITERIO"){ ?>
                                                            <?php  if($dato['cfi_rangoInicio'] == $dato['cfi_id']){  ?>
                                                                <td class="text-center" rowspan="<?= $row_SUB ?>">                                                                    
                                                                         <?= $dato['cfi_maxPuntaje']; ?>
                                                                </td>
                                                                <?php } }else{ ?>
                                                                
                                                                <td class="text-center" >                                                                    
                                                                      
                                                                </td>
                                                            <?php } ?>



                                                            <?php  if($dato['cfi_tipoColumna'] == "RUBRO"){ ?>
                                                            <?php  if($dato['cfi_rangoInicio'] == $dato['cfi_id']){  ?>
                                                                <td class="text-center" rowspan="<?= $row_RUBRO ?>">                                                                    
                                                                         <?= $dato['cfi_maxPuntaje']; ?>
                                                                </td>
                                                            <?php } } ?>
                                                                
                                                                

                                                          

                                                        </tr>
                                                    <?php $i++; 
                                                
                                                    } ?>   
                                                    
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