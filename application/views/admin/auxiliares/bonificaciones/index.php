<h4 class="mt-3"><b><i class="far fa-object-ungroup fa-sm"></i> Bonificaciones</b></h4>
<ol class="breadcrumb mb-2">
    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"> Inicio</a></li>
    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/auxiliares/periodos"> Periodos</a></li>
    <li class="breadcrumb-item active">prelaciones</li>
</ol>
<div class="app-row" id="AppIndexPlaza">
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
                                                            <button type="button" class="btn btn-outline-primary btn-sm btn-create"><b><i class="fa-solid fa-circle-plus fa-lg"></i> Agregar</b></button>
                                                        </div>
                                                        <div class="vr"></div>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control form-control-sm shadow-none" placeholder="Escribe aquí..." id="txtBuscador">
                                                                <button type="button" class="input-group-text btn btn-sm btn-primary shadow-none btn-search">Buscar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12" id="view_listarPlazas">
                                    <div class="table-responsive table-auxiliar">
                                        <table id="tableIndex" class="table  table-hover table-sm" cellspacing="0" width="100%" style="font-size:13px; vertical-align: middle;">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">BONIFICACIÓN</th>
                                                    <th class="text-center">VALOR</th>
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
    <div class="modal fade" id="modalCreateUpdate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="font-size: 14px;">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="staticBackdropLabel"><b><i class="fas fa-check-double fa-xs"></i> Mantenimiento de bonificación: </b><b class="text-dark lb_expediente"></b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form class="form-create-update" id="formCreateUpdate">
                            <div class="row">

                                <div class="col-md-2 mb-2 mt-1"><b>Nombre:</b></div>
                                <div class="col-md-10 mb-2">
                                    <textarea class="form-control form-control-sm" name="nombre" type="text" required></textarea>
                                </div>
                                <div class="col-md-2 mb-2 mt-1"><b>Valor:</b></div>
                                <div class="col-md-10 mb-2">
                                    <input class="form-control form-control-sm" name="puntaje" type="number" min="0" step="0.10" required />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><b><i class="fa-regular fa-circle-xmark fa-lg"></i> Cerrar</b></button>
                    <button type="submit" class="btn btn-primary btn-sm" form="formCreateUpdate"><b><i class="far fa-check-circle fa-lg"></i> Aceptar</b></button>
                </div>
            </div>
        </div>
    </div>

</div>