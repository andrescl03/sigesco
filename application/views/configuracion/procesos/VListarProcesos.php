<div class="table-responsive">
	<table id="tb_listarProcesos" class="table  table-hover table-sm" cellspacing="0" width="100%" style="font-size:13px; vertical-align: middle;">
		<thead>
			<tr class="cabecera_tabla_2">
				<th class="text-center">#</th>
				<!-- __________NO CONTEMPLADO__________ -->
                <!--<th class="text-center">
                    [ - ]
                </th>-->           							
				<th class="text-center">DESCRIPCIÓN</th>
				<!-- __________NO CONTEMPLADO__________ -->
                <!--<th class="text-center">ACCIONES</th>-->       
			</tr>
		</thead>
		<tbody>
			<?php $i=0; foreach ($datos as $dato) { ?>
			<tr>										
				<td class="text-center"><b><?= $i+1;?></b></td>
				<!-- __________NO CONTEMPLADO__________ -->
				<!--<td class="text-center">
                    <div class="custom-control custom-checkbox chk_asignar" >
                        <input type="checkbox" class="custom-control-input" id="chk_asignar_<?= $i+1;?>" value="<?= $dato['pro_id']; ?>"  <?= ($dato['pro_estado'] == '1') ? "checked" : "" ?> >
                        <label class="custom-control-label" for="chk_asignar_<?= $i+1;?>"></label>
                    </div>
                </td>-->           
                <td class="text-center"><?= $dato['pro_descripcion'];?></td>	
                <!-- __________NO CONTEMPLADO__________ -->
				<!--
                <td class="text-center">                    
                    <div class="d-flex justify-content-center gap-2">
                        <a type="button" class="text-danger btn_editarProceso" title="Editar registro" ><b><i class="fa-solid fa-pen-to-square fa-xl"></i> </b></a>                        
                    </div>                                       
                </td>--> 	  
        	</tr>
			<?php $i++; } ?>  								
		</tbody>							
	</table>
</div>