<div id="AppIndexAdjudicacionAdmin">


    <h4 class="mt-3"><b><i class="far fa-object-ungroup fa-sm"></i> Listado de Adjudicaciones</b></h4>
    <ol class="breadcrumb mb-2">
        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"> Inicio</a></li>
        <li class="breadcrumb-item active">Adjudicaciones</li>
    </ol>
    <div class="app-row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="card border-secondary">
                        <div class="card-body text-dark">
                            <div class="text-right mb-2">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card border bg-light">
                                            <div class="card-body" style="padding: 0.8rem 1rem;">
                                                <div class="row">
                                                    <div class="col-sm-12 ">
                                                        <div class="d-flex align-content-start flex-wrap gap-3">
                                                            <div class="d-grid gap-2 col-sm-2">
                                                                <a type="button" href="<?php echo base_url(); ?>adjudicaciones/create" class="btn btn-outline-primary btn-sm">
                                                                    <b><i class="fa-solid fa-file-signature fa-lg"></i> Agregar</b>
                                                                </a>
                                                            </div>
                                                            <div class="vr"></div>
                                                            <div class="col-sm-6">
                                                                <div class="input-group">

                                                                    <input type="text" class="form-control form-control-sm" id="txt_buscador" placeholder="Buscar...">
                                                                    <button type="button" class="input-group-text btn btn-sm btn-primary shadow-none btn-search">Buscar</button>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-2" >
                                                                <button type="button" target="_blank" class="btn-reporte-adjudicados btn btn-sm btn-primary">
                                                                    Reporte adjudicados
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover" id="tableIndexAdjudicacion" style="width:100%; margin:0px;">
                                                <thead>
                                                    <tr class="cabecera_tabla_2">
                                                        <th class="text-center">ID</th>
                                                        <th class="text-center">CÓDIGO DE PLAZA</th>
                                                        <th class="text-center">DOCUMENTO</th>
                                                        <th class="text-center">DOCENTE</th>
                                                        <th class="text-center">FECHA DE INICIO</th>
                                                        <th class="text-center">FECHA DE FIN</th>
                                                        <th class="text-center">FECHA DE REGISTRO</th>
                                                        <th class="text-center">IE</th>
                                                        <th class="text-center">MODALIDAD</th>
                                                        <th class="text-center">NIVEL</th>
                                                        <th class="text-center">ESPECIALIDAD</th>
                                                        <th class="text-center">DOCUMENTOS</th>
                                                        <th class="text-center">ACCIONES</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

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

</div>