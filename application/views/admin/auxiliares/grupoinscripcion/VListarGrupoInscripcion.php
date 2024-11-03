<?php //writer($datos);?>
<div class="table-responsive table-auxiliar">
	<table id="tb_listarGrupoInscripcion" class="table  table-hover table-sm" cellspacing="0" width="100%" style="font-size:13px; vertical-align: middle;">
		<thead>
			<tr>
				<!--<th class="text-center">#</th>-->
				<th class="text-center">N°</th>            
                <th class="text-center">MODALIDAD</th>							
				<th class="text-center">NIVEL</th>	
                <th class="text-center">ESPECIALIDADES</th>
				<th class="text-center">OPCIONES</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=0; foreach ($datos as $key => $dato) { ?>
			<tr>										
				<td class="text-center"><b><?= $dato['gin_correlative'] ?></b></td>			              
                <td class="text-center"><b><?= ($i>0 && $dato['mod_id']==$datos[$i-1]['mod_id']) ? "" : $dato['mod_nombre']." - ".$dato['mod_abreviatura']  ?></b></td>	
                <td class="text-center"><b><?= ($i>0 && $dato['niv_id']==$datos[$i-1]['niv_id']) ? ""  :$dato['niv_descripcion'] ?></b></td>
                <td ><?= $dato['esp_descripcion'] ?></td>
				<td class="text-center"><a type="button" class="text-danger btn_eliminarAccion" title="Eliminar"  idGin=<?= $dato['gin_id'] ?> ><b><i class="fa-solid fa-trash-can fa-lg"></i></b></a></td>  
        	</tr>
			<?php $i++; } ?>  								
		</tbody>							
	</table>
</div>