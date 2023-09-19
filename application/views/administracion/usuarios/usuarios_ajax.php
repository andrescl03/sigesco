<?php if(isset($mensaje["error"])) { ?> 
	<div class="alert alert-danger" role="alert"><?php echo $mensaje["error"]; ?></div>	
<?php }else{ ?>	
	<div class="tresponsive">
	<table id="tb_listadoUsuarios" class="table-condensed table-bordered table-hover table-sm" cellspacing="0" width="100%" style="font-size:13px;">
		<thead>
			<tr class="cabecera_tabla">
				<th class="text-center">#</th>
				<th class="text-center">USUARIO</th>							
				<th class="text-center">NOMBRES Y APELLIDOS</th>
				<th class="text-center">TIPO DE USUARIO</th>							
				<th class="text-center">ESTADO</th>
				<th class="text-center">ACCIONES</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=0; foreach ($datos as $dato) { ?>
			<tr>										
				<td class="text-center"><b><?php echo $i+1;?></b></td>
				<td class="text-center"><?php echo $dato->usu_dni;?></td>
				<td><?php echo $dato->usu_nombre.' '. $dato->usu_apellidos;?></td>						
				<td class="text-center"><?php echo $dato->tus_usuariodescrip.' '.($dato->tus_estado==1?'<span class="badge bg-success">Activo</span>':'<span class="badge bg-danger">Inactivo</span>');?></td>
				<td class="text-center"><?php echo ($dato->usu_estado==1?'<span class="badge bg-success">Activo</span>':'<span class="badge bg-danger">Inactivo</span>')?></td>				
				<td class="text-center">					
					<a type="button" class="badge bg-info text-white btn_editarUsuarios" id="<?php echo $dato->usu_id;?>" title="Editar"><i class="far fa-edit fa-lg"></i></a>
					<a type="button" class="badge bg-danger text-white btn_eliminarUsuarios" id="<?php echo $dato->usu_id;?>" title="Eliminar"><i class="far fa-trash-alt fa-lg"></i></a>
					<a type="button" class="badge bg-success text-white btn_resetPassword" id="<?php echo $dato->usu_id;?>" dni="<?php echo $dato->usu_dni;?>" title="Resetear Password"><i class="fas fa-redo fa-lg"></i></a>						
				</td>			
			</tr>
			<?php $i++; } ?>  								
		</tbody>							
	</table>
</div>	
<?php } ?>