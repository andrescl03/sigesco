<div class="row">  
    <div class="col-md-12">       
        <div class="row">
            <div class="col-md-12" >                 
                <div class="input-daterange" id="dp_fechasBusqueda">
                    <div class="row">
                        <div class="col-md-2 mb-2 mt-1"><b>Fecha Desde:</b></div>
                        <div class="col-md-4 mb-2">                
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend" style="color: Dodgerblue; background-color: #ffff;"><i class="far fa-calendar-alt fa-lg"></i></span>
                                </div>
                                <input type="text" class="form-control form-control-sm" id="fecha_inicio" name="fecha_inicio" placeholder="Desde"  value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-2 mb-2 mt-1"><b>Fecha Hasta:</b></div>
                        <div class="col-md-4 mb-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend" style="color: Dodgerblue; background-color: #ffff;"><i class="far fa-calendar-alt fa-lg"></i></span>
                                </div>
                                <input type="text" class="form-control form-control-sm" id="fecha_fin" name="fecha_fin" placeholder="Hasta" value="" readonly>
                            </div>
                        </div>
                    </div>       
                </div>
            </div>
        </div>  
        <div class="row">
            <div class="col-md-2 mb-2 mt-1"><b>Grupo Trámite:</b></div>
            <div class="col-md-8 mb-2">
                <select class="form-select form-select-sm"  data-placeholder="Elegir grupo de trámite..." name="opt_grupoTramite" id="opt_grupoTramite" >              
                    <option></option>
                    <?php foreach ($grupos as $grupo) { ?>
                        <option value="<?= $grupo['grt_id'] ?>" ><?= toMayus($grupo['grt_descripcion']) ?></option>
                    <?php }  ?> 
                </select>
            </div> 

            <div class="w-100"></div>

            <div class="col-md-2 mb-2 mt-1"><b>Nombre trámite:</b></div>
            <div class="col-md-8 mb-2" id="view_tramites">
                <select class="form-select form-select-sm"  data-placeholder="Elegir trámite..." name="opt_tramite" id="opt_tramite" >
                    <option></option>
                   <!-- <?php foreach ($tramites as $tramite) { ?>
                        <option value="<?= $tramite['tcr_id'] ?>" ><?= toMayus($tramite['tcr_descripcion']) ?></option>
                    <?php }  ?> -->
                </select>
            </div>
            <div class="col-md-2 mb-2">
                <button type="button" class="btn btn-outline-success btn-sm btn_buscarExpedientesExp" ><b><i class="fa-solid fa-magnifying-glass fa-lg"></i> Buscar</b></button>
            </div>
        </div>

        <div class="row mt-3" >
            <div class="col-sm-12">
                <div class="card border bg-light">
                    <div class="card-body" style="padding: 0.8rem 1rem;">
                        <div class="row">
                            <div class="col-sm-9">
                                <div class="d-flex align-content-start flex-wrap gap-3">
                                    <div class="col-sm-12"><input type="text" class="form-control form-control-sm" id="txt_buscadorExp" placeholder="Buscar..." ></div>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div> 
            </div>
            <div class="col-sm-12" id="view_tablaExpedientes">
                <div class="table-responsive">
                    <table id="tb_listarExpedientes" class="table  table-hover table-sm" cellspacing="0" width="100%" style="font-size:13px; vertical-align: middle;">
                        <thead>
                            <tr class="cabecera_tabla_2">
                                <th class="text-center">#</th>
                                <th class="text-center">
                                [ - ]
                                    <!--<div class="custom-control custom-checkbox chk_asignarTodosExp text-center mb-2" style="padding-right: 0px; padding-top: 10px;">
                                        <input type="checkbox" class="custom-control-input" id="chk_asignarTodosExp_1" >
                                        <label class="custom-control-label" for="chk_asignarTodosExp_1"></label>
                                    </div>-->
                                </th>
                                <th class="text-center">EXPEDIENTE</th>
                                <th class="text-center">N° DOCUMENTO</th>
                                <th class="text-center">NOMBRES Y APELLIDOS</th>
                                <th class="text-center">ADJUNTOS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $datos = []; $i=0; foreach ($datos as $dato) { ?>
                            <tr>
                                <td class="text-center"><b><?= $i+1;?></b></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>	
                    </table>
                </div>
            </div>
        </div>        
    </div>   
</div>