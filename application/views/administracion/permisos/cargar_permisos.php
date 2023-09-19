<?php if(isset($mensaje["error"])) { ?> 
	<div class="alert alert-danger" role="alert"><?php echo $mensaje["error"]; ?></div>	
<?php }else{ ?>
	
	<div class="tresponsive">
	<table id="tb_listadoPermisos" class="table-condensed table-bordered table-hover table-sm" cellspacing="0" width="50%" style="font-size:13px;">
		<thead>
			<tr class="cabecera_tabla">
				<th class="text-center">#</th>							
				<th class="text-center">MÓDULOS</th>
				<th class="text-center">ESTADO</th>							
			</tr>
		</thead>
		<tbody>
			<?php $i=0; foreach ($datos as $dato) { ?>
			<tr>										
				<td class="text-center"><b><?php echo $i+1;?></b></td>
				<td><?php 
						if($dato->mdl_hijode==0){
						echo '<b><i class="fas fa-angle-double-right"></i> '.$dato->mdl_nombre.'</b>';
						}else{
							echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.$dato->mdl_nombre;
						}
					?>				
				</td>
				<td class="text-center">
					<?php //if($dato->mdl_hijode!=0){?>					
						<div class="custom-control custom-checkbox  mr-sm-2 chk_permisos">
						    <input type="checkbox" class="custom-control-input" id="<?php echo 'per_estado_'.$dato->mdl_id;?>" value="<?php echo $dato->mdl_id; ?>" name="name_permisos"<?php if($dato->per_estado==1){ echo "checked";}?>>
						    <label class="custom-control-label" for="<?php echo 'per_estado_'.$dato->mdl_id;?>"></label>
						</div>
					<?php //} ?>
				</td>						
				
			</tr>
			<?php $i++; } ?>  								
		</tbody>							
	</table>
</div>	



<?php } ?>