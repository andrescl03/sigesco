<?php if(isset($mensaje["error"])) { ?> 
	<div class="alert alert-danger" role="alert"><?php echo $mensaje["error"]; ?></div>	
<?php }else{ ?>
	<div class="tresponsive">
	<table id="tb_listadoTusuarios" class="table-condensed table-bordered table-hover table-sm" cellspacing="0" width="100%" style="font-size:13px;">
		<thead>
			<tr class="cabecera_tabla">
				<th class="text-center">#</th>							
				<th class="text-center">DESCRIPCION</th>				
				<th class="text-center">ESTADO</th>
				<th class="text-center">USUARIOS ASIGNADOS</th>				
				<th class="text-center">ACCION</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=0; foreach ($datos as $dato) { ?>
			<tr>										
				<td class="text-center"><b><?php echo $i+1;?></b></td>
				<td><?php echo $dato->tus_usuariodescrip;?></td>						
				<td class="text-center"><?php echo ($dato->tus_estado==1?'<span class="badge bg-success">Activo</span>':'<span class="badge bg-danger">Inactivo</span>')?></td>
				<td class="text-center"><?php echo $dato->total;?></td>				
				<td class="text-center">
					<a type="button" class="badge bg-info text-white btn_editarTusuarios" id="<?php echo $dato->tus_id;?>"><i class="far fa-edit fa-lg"></i></a>
					<a type="button" class="badge bg-danger text-white btn_eliminarTusuarios" id="<?php echo $dato->tus_id;?>" total="<?php echo $dato->total;?>"><i class="far fa-trash-alt fa-lg"></i></a>	
				</td>
				
			</tr>
			<?php $i++; } ?>  								
		</tbody>							
	</table>
</div>	
<?php } ?>