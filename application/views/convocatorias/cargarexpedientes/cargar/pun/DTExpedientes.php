<div class="table-responsive">
    <table id="tb_listarExpedientes" class="table  table-hover table-sm" cellspacing="0" width="100%" style="font-size:13px; vertical-align: middle;">
        <thead>
            <tr class="cabecera_tabla_2">
                <th class="text-center">#</th>
                <th class="text-center">                            
                    <!--<div class="custom-control custom-checkbox chk_asignarTodosExp mb-2" style="padding-right: 0px; padding-top: 10px;">
                        <input type="checkbox" class="custom-control-input" id="chk_asignarTodosExp_1" >
                        <label class="custom-control-label" for="chk_asignarTodosExp_1"></label>
                    </div>-->
                 [ - ]  
                </th>
                <th class="text-center">EXPEDIENTE</th>
                <th class="text-center">N° DOCUMENTO</th>
                <th class="text-center">NOMBRES Y APELLIDOS</th>
                <th class="text-center">ADJUNTOS</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i=0; $i < count($arreglo) ; $i++) { ?>
            <tr>
                <td class="text-center"><b><?= $i+1;?></b></td>
                <td class="text-center">
                    <div class="custom-control custom-checkbox <?= (($arreglo[$i]["habilitado"]==1 &&  $arreglo[$i]["chekeado"]==1)  ? "chk_asignarExp" : "") ?>" style="padding-right: 10px;">
                        <input type="checkbox" class="custom-control-input" id="chk_asignarExp_<?= $i+1;?>" value="<?= $arreglo[$i]['tra_anio']."||".$arreglo[$i]['tra_numero'] ?>"  <?= ($arreglo[$i]["chekeado"]==1 ? "checked" : "") ?> <?= ($arreglo[$i]["habilitado"]==0 ? "disabled" : "") ?> >
                        <label class="custom-control-label" for="chk_asignarExp_<?= $i+1;?>"></label>
                    </div> 
                </td>
                <td class="text-center"><?= $arreglo[$i]["tra_numeroExpediente"]; ?> </td>
                <td class="text-center">
                    <?php 
                        if($arreglo[$i]["ins_tipoDocumentoID"]=="2903"){
                            echo '********';
                        }else{
                            echo $arreglo[$i]["ins_numeroDocumento"]; 	
                        }							
                    ?> 
                </td>
                <td>
                    <?php 
                        if($arreglo[$i]["ins_tipoDocumentoID"]=="2903"){
                            echo $arreglo[$i]["ins_apellidos"]; 
                        }else{
                            if($arreglo[$i]["ins_tipoDocumentoID"]=="2103"){
                                echo $arreglo[$i]["ins_razonSocial"]; 
                            }else{
                                echo $arreglo[$i]["ins_nombres"]." ".$arreglo[$i]["ins_apellidos"]; 
                            }
                        }
                    ?>
                </td>
                <td class="text-center">
                    <div class="d-flex justify-content-center gap-2">       
                        <?php if(empty($arreglo[$i]["urlAdjunto"])) { // no esta difinido ?> 
                            
                            <a type="button" class="text-danger" href="<?php echo URL_MPV.$arreglo[$i]["tra_urlArchivo"]; ?>"  target="_blank" title="Descargar Trámite Virtual" ><i class="far fa-file-pdf fa-xl"></i></a>
                            <a type="button" class="text-success" href="<?php echo URL_MPV.$arreglo[$i]["tra_urlAdjunto"]; ?>"  target="_blank" title="Descargar Archivos Adjuntos"><i class="far fa-file-archive fa-xl"></i></a>	

                        <?php }else{ ?>						

                            <?php for ($k=0; $k < count($arreglo[$i]["urlAdjunto"]) ; $k++) { ?>
                            
                                <?php if($k==0){ ?>	
                                    <a type="button" class="text-danger" href="<?php echo URL_MPV.$arreglo[$i]["urlArchivo"][$k]; ?>"  target="_blank" title="Descargar Trámite Virtual" ><i class="far fa-file-pdf fa-xl"></i></a>
                                    <a type="button" class="text-success" href="<?php echo URL_MPV.$arreglo[$i]["urlAdjunto"][$k]; ?>"  target="_blank" title="Descargar Archivos Adjuntos"><i class="far fa-file-archive fa-xl"></i></a>	
                                <?php }else{ ?>
                                    
                                    <?php if($arreglo[$i]["sub_total"]-1>=$k ){ ?>
                                    <a type="button" class="text-primary" href="<?php echo URL_MPV.$arreglo[$i]["urlAdjunto"][$k]; ?>"  target="_blank" title="Descargar Archivos Adjuntos"><i class="far fa-file-archive fa-xl"></i></a>
                                    <?php } ?>

                                <?php } ?>

                            <?php } ?>

                                <?php if($arreglo[$i]["sub_total"]==$arreglo[$i]["total"]){ ?>
                                    <a type="button" class="text-primary" href="<?php echo URL_MPV.$arreglo[$i]["tra_urlAdjunto"]; ?>"  target="_blank" title="Descargar Archivos Adjuntos"><i class="far fa-file-archive fa-xl"></i></a>
                                <?php } ?>						

                        <?php } ?>
                    </div>              
                </td>
                
            </tr>
            <?php } ?>
        </tbody>	
    </table>
</div>



    


