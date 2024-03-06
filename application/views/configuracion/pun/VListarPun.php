<?php //writer($datos);?>
<div class="table-responsive">
	<table id="tb_listarPun" class="table  table-hover table-sm" cellspacing="0" width="100%" style="font-size:13px; vertical-align: middle;">
		<thead>
			<tr class="cabecera_tabla_2">
				<th class="text-center">#</th>
                <th class="text-center">N° DOCUMENTO</th>
                <th >APELLIDOS</th>
                <th >NOMBRES</th>
                <th class="text-center">GRUPO DE INSCRIPCION</th>			
                <th class="text-center">S1</th>
                <th class="text-center">S2</th>
                <th class="text-center">S3</th>
                <th class="text-center">ORDEN DE MERITO</th>
                <th class="text-center">TIPO DE AFILIACION</th>
                <th class="text-center">CUSS</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=0; foreach ($datos as $dato) { ?>
			<tr>										
				<td class="text-center"><b><?= $i+1;?></b></td>
                <td class="text-center"><?= $dato['cpe_documento'] ?></td>	
                <td><?= $dato['cpe_apellidos'] ?></td>
                <td><?= $dato['cpe_nombres'] ?></td>
                <td class="text-center"><?= $dato['mod_abreviatura']." ".$dato['niv_descripcion'].($dato['esp_descripcion']!="-" ? " ".$dato['esp_descripcion'] : "" ) ?></td>              
                <td class="text-center"><?= $dato['cpe_s1'] ?></td>
                <td class="text-center"><?= $dato['cpe_s2'] ?></td>
                <td class="text-center"><?= $dato['cpe_s3'] ?></td>
                <td class="text-center"><?= $dato['cpe_orden'] ?></td>
                <td class="text-center"><?= $dato['afiliacion'] ?></td>
                <td class="text-center"><?= $dato['cuss'] ?></td>
        	</tr>
			<?php $i++; } ?>  								
		</tbody>							
	</table>
</div>