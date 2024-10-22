<?php //writer($datos);?>
<div class="table-responsive">
	<table id="tb_listarPlazas" class="table  table-hover table-sm" cellspacing="0" width="100%" style="font-size:13px; vertical-align: middle;">
		<thead>
			<tr class="cabecera_tabla_2">
				<th class="text-center">#</th>
                <th class="text-center">Modalidad de contratación</th>
                <th >Código de plaza</th>
                <th >IE</th>
                <th class="text-center">Modalidad</th>			
                <th class="text-center">Nivel</th>
                <th class="text-center">Jornada</th>
                <th class="text-center">Distrito</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=0; foreach ($datos as $dato) { ?>
			<tr>										
        	</tr>
			<?php $i++; } ?>  								
		</tbody>							
	</table>
</div>