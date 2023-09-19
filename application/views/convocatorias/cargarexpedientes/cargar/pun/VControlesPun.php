<div class="col-sm-12 mt-1">
    <div class="card border bg-light">
        <div class="card-body" style="padding: 0.8rem 1rem;">
            <div class="row">
                <div class="col-sm-12 ">
                    <div class="d-flex align-content-start flex-wrap gap-3">                                                     
                        <button type="button" class="btn btn-outline-primary btn-sm btn_modalBuscarExpedientes" ><b><i class="fa-solid fa-magnifying-glass fa-lg"></i> Buscar Expedientes</b></button>
                        <div class="vr"></div>
                        <button type="button" class="btn btn-outline-success btn-sm btn_excel" ><b><i class="fa-regular fa-square-check fa-lg"></i> Asignación Manual</b></button>
                        <div class="vr"></div>
                        <button type="button" class="btn btn-outline-danger btn-sm btn_quitarAsignacion"><b><i class="fa-regular fa-circle-xmark fa-lg"></i> Quitar Asignación</b></button>
                        <div class="vr"></div>
                        <button type="button" class="btn btn-outline-secondary btn-sm btn_enviarEvaluacion" ><b><i class="fa-solid fa-square-arrow-up-right fa-lg"></i> Enviar Evaluación</b></button> 
                    </div>
                </div>
                <div class="col-sm-12 mt-3">
                    <div class="row">
                        <div class="col-md-2"><b>Estado Docentes:</b></div>
                        <div class="col-md-4">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="chk_tipoRegistro" id="tipoRegistro_0" value="0" >
                                <label class="form-check-label" for="tipoRegistro_0">Todos</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="chk_tipoRegistro" id="tipoRegistro_1" value="1" checked>
                                <label class="form-check-label" for="tipoRegistro_1">Sin Evaluación</label>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="chk_rango">
                                <label class="form-check-label" for="chk_rango">
                                <b>Seleccionar en rango</b>
                                </label>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>