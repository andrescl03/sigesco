<?php //writer($datos);?>
<div class="table-responsive">
	<table id="tb_listarGrupoInscripcion" class="table  table-hover table-sm" cellspacing="0" width="100%" style="font-size:13px; vertical-align: middle;">
		<thead>
			<tr class="cabecera_tabla_2">
				<!--<th class="text-center">#</th>-->
				<th class="text-center">ID</th>            
                <th class="text-center">MODALIDAD</th>							
				<th class="text-center">NIVEL</th>	
                <th class="text-center">ESPECIALIDADES</th>                
			</tr>
		</thead>
		<tbody>
			<?php $i=0; foreach ($datos as $dato) { ?>
			<tr>										
				<!--<td class="text-center"><b><?= $i+1 ?></b></td>-->
				<td class="text-center"><b><?= $dato['esp_id'] ?></b></td>			              
                <td class="text-center"><b><?= ($i>0 && $dato['mod_id']==$datos[$i-1]['mod_id']) ? "" : toMayus($dato['mod_nombre']." - ".$dato['mod_abreviatura'])  ?></b></td>	
                <td class="text-center"><b><?= ($i>0 && $dato['niv_id']==$datos[$i-1]['niv_id']) ? ""  :toMayus($dato['niv_descripcion']) ?></b></td>
                <td ><?= $dato['esp_descripcion'] ?></td>
        	</tr>
			<?php $i++; } ?>  								
		</tbody>							
	</table>
</div>