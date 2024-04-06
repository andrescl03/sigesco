<?php //writer($datos);?>
<div class="table-responsive">
	<table id="tb_listarConvocatorias" class="table  table-hover table-sm" cellspacing="0" width="100%" style="font-size:13px; vertical-align: middle;">
		<thead>
			<tr class="cabecera_tabla_2">
				<th class="text-center">#</th>
                <th class="text-center">NÚMERO</th>
                <th class="text-center">FECHA DE INICIO DE LA CONVOCATORIA</th>
                <th class="text-center">FECHA DE FIN DE LA CONVOCATORIA</th>
				<th class="text-center">FECHA DE INICIO DE RECLAMO</th>
				<th class="text-center">FECHA DE FIN DE RECLAMO</th>
                <th class="text-center">GRUPOS DE INSCRIPCIÓN</th>
                <th class="text-center">ESTADO</th>
                <th class="text-center">ACCIONES</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				$arrUnicos = [];
				$i=0; 
				foreach ($datos as $dato) { 
					if (!in_array($dato['con_id'], $arrUnicos)) {
						$arrUnicos[] = $dato['con_id'];
			?>
			<tr>
				<td class="text-center"><b><?= $i+1;?></b></td>
                <td class="text-center"><b><?= "CONV-".sprintf('%04d', $dato['con_numero'])."-".$dato['con_anio'] ?></b></td>
                <td class="text-center"><?= format_date($dato['con_fechainicio'], "d/m/Y") ?></td>              
                <td class="text-center"><?= format_date($dato['con_fechafin'], "d/m/Y") ?></td>
				<td class="text-center"><?= format_date($dato['con_fechainicio_reclamo'], "d/m/Y") ?></td>
				<td class="text-center"><?= format_date($dato['con_fechafin_reclamo'], "d/m/Y") ?></td>
				
                <td>
					<ul class="list-group list-group-flush">
					<?php
						foreach ($datos as $dat) {
							if($dato['con_id'] == $dat['con_id']){
								echo '<li>'.$dat['mod_abreviatura']." ".$dat['niv_descripcion'].($dat['esp_descripcion']!="-" ? " ".$dat['esp_descripcion'] : "").'</li>';
							}						
						}
					?>
					</ul>
				</td>
                <td class="text-center">
					<?php
						if($dato['con_estado']=='1'){
							echo '<span class="badge rounded-pill bg-success" style="font-size: 1em;">Abierto</span>';
						}else{
							echo '<span class="badge rounded-pill bg-danger" style="font-size: 1em;">Cerrado</span>';
						}
					?>
				</td>
                <td class="text-center">
					<div class="d-flex justify-content-center gap-2">
                        <a type="button" class="text-danger btn_modaleditarConvocatoria" title="Editar convocatoria" idConv=<?= $dato['con_id'] ?>  ><b><i class="fa-solid fa-pen-to-square fa-2xl"></i> </b></a>
                    </div>
				</td>
        	</tr>
			<?php $i++; } }?>
		</tbody>
	</table>
</div>