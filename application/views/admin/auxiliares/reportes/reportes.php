<h4 class="mt-3"><b><i class="far fa-object-ungroup fa-sm"></i> Reportes</b></h4>
<ol class="breadcrumb mb-2">
    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"> Inicio</a></li>
    <li class="breadcrumb-item active">Reportes</li>
</ol>
<?php $CargoOficina = $this->session->userdata('CargoOficina'); ?>
<div class="app-row">

    <div class="row">
        <div class="col-lg-12 mt-4">
            <div class="card border-danger">
                <div class="card-header bg-danger text-white">
                    <h5 class="card-title mx-auto text-center">Reporte de auxiliares adjudicados</h5>
                </div>
                <div class="card-body">
                    <form class="form-postulant-inscription">
                        <div class="row">
                            <div class="col-lg-3 mb-3">
                                <div class="input-group">
                                    <span class="input-group-text">Periodo</span>
                                    <select name="periodo_id" class="form-control select-periodo-adjudicado">
                                        <option value="">TODOS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <div class="input-group">
                                    <span class="input-group-text">Fecha Inicio</span>
                                    <input type="date" class="form-control" name="fecha_inicio" />
                                </div>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <div class="input-group">
                                    <span class="input-group-text">Fecha Final</span>
                                    <input type="date" class="form-control" name="fecha_final" />
                                </div>
                            </div>
                            <div class="col-lg-3 my-auto mb-3 text-end">
                                <button type="submit" class="btn btn-danger px-5">
                                    <i class="fa fa-search me-2" aria-hidden="true"></i>Filtrar
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="d-flex justify-content-center" id="loadingchartdiv1">
                                <div class="spinner-border text-danger" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div> <span class="ms-2 my-auto fs-6">Cargando...</span>
                            </div>
                            <div id="chartdiv1" style="height:500px; width:100%;" class="d-none"></div>
                        </div>
                    </div>
                </div>
            </div>
            <style>
                .amcharts-amexport-item.amcharts-amexport-item-level-0 {
                    min-width: 120px !important;
                }
            </style>
        </div>
        <div class="col-lg-12 mt-4">
            <div class="card border-warning">
                <div class="card-header bg-warning">
                    <h5 class="card-title mx-auto text-center text-white">Reporte de plazas</h5>
                </div>
                <div class="card-body">
                    <form class="form-plaza">
                        <div class="row">
                            <div class="col-lg-3 mb-3">
                                <div class="input-group">
                                    <span class="input-group-text">Periodo</span>
                                    <select name="periodo_id" class="form-control select-periodo-plaza">
                                        <option value="">TODOS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 my-auto mb-3">
                                <button type="submit" class="btn btn-success px-5">
                                    <i class="fa fa-search me-2" aria-hidden="true"></i>Filtrar
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="d-flex justify-content-center" id="loadingchartdiv4">
                                <div class="spinner-border text-warning" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div> <span class="ms-2 my-auto fs-6">Cargando...</span>
                            </div>
                            <div id="chartdiv4" style="height:500px; width:100%;" class="d-none"></div>
                        </div>
                    </div>
                </div>
            </div>
            <style>
                .amcharts-amexport-item.amcharts-amexport-item-level-0 {
                    min-width: 120px !important;
                }
            </style>
        </div>
        <div class="col-lg-12 mt-4">
            <div class="card border-success">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mx-auto text-center">Reporte de evaluaciones en estado (cumple, no cumple y
                        observado )</h5>
                </div>
                <div class="card-body">
                    <form class="form-evaluation-estado">
                        <div class="row">
                            <div class="col-lg-3 mb-3">
                                <div class="input-group">
                                    <span class="input-group-text">Periodo</span>
                                    <select name="periodo_id" class="form-control select-periodo-evaluation-estado">
                                        <option value="">TODOS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <div class="input-group">
                                    <span class="input-group-text">Convocatoria</span>
                                    <select name="convocatoria_id"
                                        class="form-control select-evaluation-convocatoria-estado">
                                        <option value="">TODOS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <div class="input-group">
                                    <span class="input-group-text">Especialista</span>
                                    <select name="especialista_id"
                                        class="form-control select-evaluation-especialista-estado">
                                        <option value="">TODOS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <div class="input-group">
                                    <span class="input-group-text">Evaluación</span>
                                    <select name="modulo" class="form-control">
                                        <option value="preliminar">PRELIMINAR</option>
                                        <option value="final">FINAL</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 my-auto mb-3">
                                <button type="submit" class="btn btn-success px-5">
                                    <i class="fa fa-search me-2" aria-hidden="true"></i>Filtrar
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="d-flex justify-content-center" id="loadingchartdiv3">
                                <div class="spinner-border text-success" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div> <span class="ms-2 my-auto fs-6">Cargando...</span>
                            </div>
                            <div id="chartdiv3" style="height:700px; width:100%;" class="d-none"></div>
                        </div>
                    </div>
                </div>
            </div>
            <style>
                .amcharts-amexport-item.amcharts-amexport-item-level-0 {
                    min-width: 120px !important;
                }
            </style>
        </div>
        <div class="col-lg-12 mt-4">
            <div class="card border-info">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mx-auto text-center">Reporte de sin evaluar, preliminar y evaluados</h5>
                </div>
                <div class="card-body">
                    <form class="form-evaluation">
                        <div class="row">
                            <div class="col-lg-3 mb-3">
                                <div class="input-group">
                                    <span class="input-group-text">Periodo</span>
                                    <select name="periodo_id" class="form-control select-periodo-evaluation">
                                        <option value="">TODOS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <div class="input-group">
                                    <span class="input-group-text">Convocatoria</span>
                                    <select name="convocatoria_id" class="form-control select-convocatoria-evaluation">
                                        <option value="">TODOS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <div class="input-group">
                                    <span class="input-group-text">Grupo de inscripción</span>
                                    <select name="inscripcion_id" class="form-control select-inscription-evaluation">
                                        <option value="">TODOS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <div class="input-group">
                                    <span class="input-group-text">Especialista</span>
                                    <select name="especialista_id" class="form-control select-especialista-evaluation">
                                        <option value="">TODOS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 my-auto mb-3">
                                <button type="submit" class="btn btn-info text-white px-5">
                                    <i class="fa fa-search me-2" aria-hidden="true"></i>Filtrar
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="d-flex justify-content-center" id="loadingchartdiv2">
                                <div class="spinner-border text-info" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div> <span class="ms-2 my-auto fs-6">Cargando...</span>
                            </div>
                            <div id="chartdiv2" style="height:400px; width:100%;" class="d-none"></div>
                        </div>
                    </div>
                </div>
            </div>
            <style>
                .amcharts-amexport-item.amcharts-amexport-item-level-0 {
                    min-width: 120px !important;
                }
            </style>
        </div>
    </div>
</div>