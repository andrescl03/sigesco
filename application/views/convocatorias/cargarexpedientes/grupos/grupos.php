
<h4 class="mt-3"><b><i class="far fa-object-ungroup fa-sm"></i> Cargar expedientes / <?= $datos[0]['pro_descripcion'] ?> | Convocatoria <?= sprintf('%04d', $datos[0]['con_numero'])."-".$datos[0]['con_anio'] ?></b></h4>
    <ol class="breadcrumb mb-2">
        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"> Inicio</a></li>
        <li class="breadcrumb-item"><a href="<?php echo base_url()."convocatorias/cargarexpedientes/".encryption('0||0'); ?>"> Cargar expedientes</a></li>
        <li class="breadcrumb-item active"><?= $datos[0]['pro_descripcion'] ?> | Convocatoria <?= sprintf('%04d', $datos[0]['con_numero'])."-".$datos[0]['con_anio'] ?></li>
    </ol>   
    <div class="app-row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="card border-secondary" >
                        <div class="card-body text-dark">
                            <div class="text-right mb-2">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card border bg-light">
                                            <div class="card-body" style="padding: 0.8rem 1rem;">
                                                <div class="row">
                                                    <div class="col-sm-12 ">
                                                        <div class="d-flex align-content-start flex-wrap gap-3">                                                       
                                                            <div class="col-sm-4"><input type="text" class="form-control form-control-sm" id="txt_buscador" placeholder="Buscar..." ></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  
                                        </div> 
                                    </div>
                                    <div class="col-sm-12"  id="">

                                        <div class="table-responsive">
                                            <table id="tb_listarConvocatorias" class="table  table-hover table-sm" cellspacing="0" width="100%" style="font-size:13px; vertical-align: middle;">
                                                <thead>
                                                    <tr class="cabecera_tabla_2">
                                                        <th class="text-center">#</th>                                                   
                                                        <th class="text-center">GRUPOS DE INSCRIPCIÓN</th>               
                                                        <th class="text-center">ACCIONES</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        $i=0; foreach ($datos as $dato) { 
                                                            $cadena = $dato['con_id']."||".$dato['gin_id'];
                                                    ?>
                                                    <tr>
                                                        <td class="text-center"><b><?= $i+1;?></b></td>
                                                        <td><?= $dato['mod_abreviatura']." ".$dato['niv_descripcion'].($dato['esp_descripcion']!="-" ? " ".$dato['esp_descripcion'] : "" ) ?></td>
                                                    
                                                        <td class="text-center">
                                                            <div class="d-flex justify-content-center gap-2">
                                                                <a type="button" class="text-success" title="Ingresar a detalle" href="<?= base_url()?>convocatorias/cargarexpedientes/<?= encryption($cadena) ?>" ><b><i class="fa-solid fa-arrow-right-to-bracket fa-2xl"></i> </b></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php $i++; } ?>
                                                </tbody>
                                            </table>
                                        </div>



                                    </div>                                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>