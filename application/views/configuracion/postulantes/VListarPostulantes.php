<?php //writer($datos);?>
<div class="table-responsive table-docente">
	<table id="tb_listarPun" class="table  table-hover table-sm" cellspacing="0" width="100%" style="font-size:13px; vertical-align: middle;">
		<thead>
			<tr>
				<th class="text-center">#</th>
                <th class="text-center">N° DOCUMENTO</th>
                <th >APELLIDOS</th>
                <th >NOMBRES</th>
                <th class="text-center">GRUPO DE INSCRIPCION</th>			
                <th class="text-center">ORDEN DE MERITO</th>
                 <th class="text-center">ESTADO</th>
                <th class="text-center">OPCIONES</th>

			</tr>
		</thead>
		<tbody>
			<?php $i=0; foreach ($datos as $dato) { ?>
			<tr>										
				<td class="text-center"><b><?= $i+1;?></b></td>
                <td class="text-center"><?= $dato['numero_documento'] ?></td>	
                <td><?= $dato['apellido_paterno']  . ' '  . $dato['apellido_materno']?></td>
                <td><?= $dato['nombre'] ?></td>
                <td class="text-center"><?= $dato['mod_abreviatura']." ".$dato['niv_descripcion'].($dato['esp_descripcion']!="-" ? " ".$dato['esp_descripcion'] : "" ) ?></td>              
                <td class="text-center"><?= $dato['cpe_orden'] ?></td>
                <td class="text-center">
                    <?php if ($dato['intentos_adjudicacion'] >= 2): ?>
                        <span style="color: red;">Fuera del cuadro de mérito</span>
                    <?php elseif ($dato['intentos_adjudicacion'] < 1): ?>
                        <span style="color: green;">Dentro del cuadro de mérito</span>
                       <?php else: ?>
                    <?= $dato['intentos_adjudicacion'] ?>
                    <?php endif; ?>
                </td>
                

                <td class="text-center">
    <?php if ($dato['intentos_adjudicacion'] >= 2): ?>
        <button class="btn btn-xs btn-success">Regresar al cuadro de mérito</button>
    <?php elseif ($dato['intentos_adjudicacion'] < 1): ?>
        <button class="btn btn-xs btn-danger">Retirar del cuadro de mérito</button>
    <?php endif; ?>
</td>


         	</tr>
			<?php $i++; } ?>  								
		</tbody>							
	</table>
</div>