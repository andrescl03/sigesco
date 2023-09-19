<table id="tb_listarAsignarReasignar" class="table  table-hover table-sm" cellspacing="0" width="100%" style="font-size:13px; vertical-align: middle;">
		<thead>
		    <tr class="cabecera_tabla_2">	
		    	<th class="text-center">[-]</th>				      
		        <th class="text-center">USUARIOS</th>
		        <th class="text-center">TOTAL PENDIENTES</th>
		       			        
			</tr>
		</thead>
		<tbody> 
		    <?php $i=1; foreach ($datos as $dato) { ?>              
		    <tr>
		      		              
				<td class="text-center">
		    		<div class="custom-control custom-radio opt_usuario">
		               	<input type="radio" class="custom-control-input" id="opt_usuario_<?= $dato['usu_id'];?>" name="radio-stacked" value="<?= $dato['usu_dni'];?>">
						<label class="custom-control-label" for="opt_usuario_<?= $dato['usu_id'];?>"></label>
		            </div>
		        </td>
		        <td><b><?= toMayus($dato['usu_nombre']." ".$dato['usu_apellidos']) ?></b></td>
		        <td class="text-center">
                    <span class="badge bg-warning text-dark" style="font-size: 1.1em;"><?= $dato['total'];?></span>
                </td>          
		    </tr>	    

		    <?php $i++; } ?>                                    
		</tbody>                            
	</table>