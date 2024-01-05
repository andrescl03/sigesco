<div class="table-responsive">
	<table id="tb_listarPeriodos" class="table  table-hover table-sm" cellspacing="0" width="100%" style="font-size:13px; vertical-align: middle;">
		<thead>
			<tr class="cabecera_tabla_2">
				<th class="text-center">#</th>
                <!-- <th class="text-center">
                    [ - ]
                </th> -->
                <th class="text-center">AÑO</th>							
				<th class="text-center">NOMBRE</th>	
                <th class="text-center">ACCIONES</th>                
			</tr>
		</thead>
		<tbody>
			<?php $i=0; foreach ($datos as $dato) { ?>
			<tr>										
				<td class="text-center"><b><?= $i+1;?></b></td>
				<!-- <td class="text-center">
                    <div class="custom-control custom-checkbox chk_asignar" >
                        <input type="checkbox" class="custom-control-input" id="chk_asignar_<?= $i+1;?>" value="<?= $dato['per_id']; ?>"  <?= ($dato['per_estado'] == '1') ? "checked" : "" ?> >
                        <label class="custom-control-label" for="chk_asignar_<?= $i+1;?>"></label>
                    </div>
                </td>                 -->
                <td class="text-center"><?= $dato['per_anio'];?></td>	
                <td ><?= $dato['per_nombre'];?></td>               
                <td class="text-center">                    
                    <div class="d-flex justify-content-center gap-2">
                        <a type="button" class="text-danger btn_editarPeriodo" title="Editar registro" href="<?php echo base_url()?>configuracion/periodos/<?php echo $dato['per_id'] ?>"><b><i class="fa-solid fa-pen-to-square fa-xl"></i> </b></a>                        
                    </div>                                       
                </td>	  
        	</tr>
			<?php $i++; } ?>  								
		</tbody>							
	</table>
</div>
