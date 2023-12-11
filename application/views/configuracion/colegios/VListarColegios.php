<?php //writer($datos);?>
<div class="table-responsive">
	<table id="tb_listarColegios" class="table  table-hover table-sm" cellspacing="0" width="100%" style="font-size:13px; vertical-align: middle;">
		<thead>
			<tr class="cabecera_tabla_2">
				<th class="text-center">#</th>
                <th class="text-center">Código local</th>
                <th class="text-center">Código modular</th>
                <th class="text-center">Modalidad/Nivel</th>
                <th class="text-center" >IE</th>
                <th class="text-center">Distrito</th>			
                <th class="text-center">Dirección</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=0; foreach ($datos as $dato) { ?>
			<tr>										
				<td class="text-center"><b><?= $i+1;?></b></td>
                <td class="text-center"><?= $dato['loc_codigo'] ?></td>	
                <td class="text-center"><?= $dato['mod_codigo'] ?></td>	
                <td class="text-center"><?=  $dato['mod_modformabrev'] . '/' . $dato['mod_nivel'] ?></td>
                <td class="text-center"><?= $dato['mod_nombre'] ?></td>
                <td class="text-center"><?= $dato['loc_distrito']  ?></td>              
                <td class="text-center"><?= $dato['loc_direccion'] ?></td>
        	</tr>
			<?php $i++; } ?>  								
		</tbody>							
	</table>
</div>