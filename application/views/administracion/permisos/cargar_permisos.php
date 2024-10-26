<?php if(isset($mensaje["error"])) { ?> 
	<div class="alert alert-danger" role="alert"><?php echo $mensaje["error"]; ?></div>	
<?php }else{ ?>
	<?php
		function tieneHijos($menu, $parentId) {
			foreach ($menu as $item) {
				if ($item['mdl_hijode'] == $parentId) {
					return true;
				}
			}
			return false;
		}			
		function imprimirMenu($menu, $parentId = 0, $nivel = 1) {
			foreach ($menu as $item) {
				if ($item['mdl_hijode'] == $parentId) {
					// Agregar margen basado en el nivel para diferenciar hijos de padres
					$marginLeft = $nivel * 15; // 20px de margen por nivel
					$esPadre = tieneHijos($menu, $item['mdl_id']);
					$nombreEstilado = $esPadre ? "<strong>{$item['mdl_nombre']}</strong>" : $item['mdl_nombre'];
					echo "<tr>";
					echo "<td>{$item['mdl_orden']}</td>";
					// Primera columna: nombre con margen y negrita si es un padre
					echo "<td style='padding-left: {$marginLeft}px;'>{$nombreEstilado}</td>";
					// Segunda columna: otra información
					echo '<td class="text-center">
							<div class="custom-control custom-checkbox  mr-sm-2 chk_permisos">
								<input type="checkbox" class="custom-control-input" id="per_estado_'.$item['mdl_id'].'" value="'.$item['mdl_id'].'" name="name_permisos" '.($item['per_estado']==1?"checked":"").'>
								<label class="custom-control-label" for="per_estado_'.$item['mdl_id'].'"></label>
							</div>
						 </td>';
					echo "</tr>";
					// Llamada recursiva para los hijos de este elemento
					imprimirMenu($menu, $item['mdl_id'], $nivel + 1);
				}
			}
		}
	?>
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
			<?php imprimirMenu(json_decode(json_encode($datos), true)); ?>
			<?php $i=0; foreach ($datos as $dato) { ?>
			<!-- <tr>										
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
					<div class="custom-control custom-checkbox  mr-sm-2 chk_permisos">
						<input type="checkbox" class="custom-control-input" id="<?php echo 'per_estado_'.$dato->mdl_id;?>" value="<?php echo $dato->mdl_id; ?>" name="name_permisos"<?php if($dato->per_estado==1){ echo "checked";}?>>
						<label class="custom-control-label" for="<?php echo 'per_estado_'.$dato->mdl_id;?>"></label>
					</div>
				</td>
			</tr> -->
			<?php $i++; } ?>  								
		</tbody>							
	</table>
</div>	



<?php } ?>