<div id="AppCreateAdjudicacionAdmin" data-id="<?php echo isset($data['adjudicacion']) ? $data['adjudicacion']->id : 0 ?>">
    <h4 class="mt-3"><b><i class="far fa-object-ungroup fa-sm"></i> Crear Adjudicación</b></h4>
    <ol class="breadcrumb mb-2">
        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"> Inicio</a></li>
        <li class="breadcrumb-item active">Adjudicaciones</li>
    </ol>
    <div class="app-row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="card border-secondary" >
                        <div class="card-body text-dark">
                            <div class="text-right mb-2">
                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="d-flex">
                                                    <h5 class="col">Docente</h5>
                                                    <div class="col text-end">
                                                        <button type="button" class="btn btn-sm btn-outline-secondary btn-docente">
                                                         <i class="fa-solid fa-file-signature fa-lg me-1"></i> Buscar Docente
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="col-md-12 list-docente">
                                                    No disponible
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="d-flex">
                                                    <h5 class="col">Plaza</h5>
                                                    <div class="col text-end">
                                                        <button type="button" class="btn btn-sm btn-outline-secondary btn-plaza">
                                                            <i class="fa-solid fa-file-signature fa-lg me-1"></i> Buscar Plaza
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="col-md-12 list-plaza">
                                                    No disponible
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Adjudicación</h5>
                                            </div>
                                            <div class="card-body">
                                                <form id="formAdjudicacion">
                                                    <div class="row">                                                    
                                                        <div class="col-md-4 mb-3">
                                                            <label for="" class="form-label">Fecha de Registro</label>
                                                            <input type="date" name="fecha_registro" class="form-control" placeholder="" required/>
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <label for="" class="form-label">Inicio Contrato</label>
                                                            <input type="date" name="fecha_inicio" class="form-control" placeholder="" required/>
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <label for="" class="form-label">Término Contrato</label>
                                                            <input type="date" name="fecha_final" class="form-control" placeholder="" required/>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="d-flex">
                                                    <h5 class="col">Firmas en el acta</h5>
                                                    <div class="col text-end">
                                                        <button type="button" class="btn btn-sm btn-outline-secondary btn-firma">
                                                            <i class="fa-solid fa-file-signature fa-lg me-1"></i> Buscar Firma
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="col-md-12 list-firmas">
                                                    No disponible
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-3 text-end">
                                        <a href="<?php echo base_url(); ?>adjudicaciones" type="button" class="btn btn-outline-secondary">
                                            Cancelar
                                        </a>
                                        <button type="submit" class="btn btn-outline-primary" form="formAdjudicacion">
                                            Guardar
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalDocentes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Listado de Docentes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group pull-right mb-2">
                            <input type="text" class="search search-postulaciones form-control" placeholder="Buscar">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered results table-postulaciones mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Docente</th>
                                        <th>Número de Documento</th>
                                        <th>Modalidad</th>
                                        <th>Nivel</th>
                                        <th>Especialidad</th>
                                        <th>Puntaje</th>
                                        <th>Fecha de Registro</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary btn-docente-add">Agregar</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalPlazas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Listado de Plazas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group pull-right mb-2">
                            <input type="text" class="search search-plazas form-control" placeholder="Buscar">
                        </div>
                    </div>
                    <div class="col-md-12 table-responsive">
                        <table class="table table-bordered table-plazas mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Código Plaza</th>
                                    <th>Insitución Educativa</th>
                                    <th>Modalidad</th>
                                    <th>Nivel</th>
                                    <th>Especialidad</th>
                                    <th>Jornada</th>
                                    <th>Tipo Vacante</th>
                                    <th>Motivo</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary btn-plaza-add">Agregar</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalFirmas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Listado de Firmas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group pull-right mb-2">
                            <input type="text" class="search search-firmas form-control" placeholder="Buscar">
                        </div>
                    </div>
                    <div class="col-md-12 table-responsive">
                        <table class="table table-bordered table-firmas mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Usuario</th>
                                    <th>Número Documento</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary btn-firma-add">Agregar</button>
            </div>
            </div>
        </div>
    </div>

</div>
