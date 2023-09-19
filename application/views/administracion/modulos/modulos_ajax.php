<?php if(isset($mensaje["error"])) { ?> 
	<div class="alert alert-danger" role="alert"><?php echo $mensaje["error"]; ?></div>		
<?php }else{ ?>	
	<?php //writer($datos); ?>
	<div class="tresponsive">
	<table id="tb_listadoModulos" class="table-condensed table-bordered table-hover table-sm" cellspacing="0" width="100%" style="font-size:13px;">
		<thead>
			<tr class="cabecera_tabla">
				<th class="text-center">#</th>
				<th class="text-center">NOMBRE DE MODULO</th>							
				<th class="text-center">RUTA</th>
				<th class="text-center">ICONO</th>							
				<th class="text-center">HIJO DE</th>
				<th class="text-center">ESTADO</th>
				<th class="text-center">ACCIONES</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=0; foreach ($datos as $dato) { ?>
			<tr>										
				<td class="text-center"><b><?php echo $i+1;?></b></td>
				<td>
					<?php 
						if($dato->mdl_hijode==0){
						echo '<b><i class="fas fa-angle-double-right"></i> '.$dato->mdl_nombre.'</b>';
						}else{
							echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.$dato->mdl_nombre;
						}
					?>
				</td>
				<td><?php echo $dato->mdl_ruta;?></td>
				<td><?php echo $dato->mdl_icono;?></td>
				<td class="text-center"><?php  echo $dato->hijo;
						/*if($dato->mdl_hijode!=0){					
							echo $datos[$dato->mdl_hijode-6]->mdl_nombre; // se hizo porque los 5 registros de administrador y de ids continuos no debe aparecer (tambien esta restringido en la bd)
						}*/
					?>
				</td>				
				<td class="text-center"><?php echo ($dato->mdl_estado==1?'<span class="badge bg-success">Activo</span>':'<span class="badge bg-danger">Inactivo</span>')?></td>				
				<td class="text-center">
					<a type="button" class="badge bg-info text-white btn_editarModulos" id="<?php echo $dato->mdl_id;?>"><i class="far fa-edit fa-lg"></i></a>
					<a type="button" class="badge bg-danger text-white btn_eliminarModulos" id="<?php echo $dato->mdl_id;?>"><i class="far fa-trash-alt fa-lg"></i></a>	
				</td>
				
			</tr>
			<?php $i++; } ?>  								
		</tbody>							
	</table>
</div>	
<?php } ?>