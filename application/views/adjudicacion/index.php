<div class="container" id="AppIndexAdjudicacionAdmin">
    <div class="card bg-white my-5">
        <div class="card-header bg-white">
            <div class="card-title w-100 d-flex justify-content-between align-items-center bg-white">
                <h4 class="card-label">Lista de adjudicaciones</h4>
                <button type="button" class="btn btn-primary btn-new">Nueva</button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-hover" id="tableIndexAdjudicacion" style="width:100%; margin:0px;">
                        <thead style="background-color:red" class="text-white">
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">PLAZA</th>
                                <th class="text-center">DOCENTE</th>
                                <th class="text-center">FECHA DE INICIO</th>
                                <th class="text-center">FECHA DE FIN</th>
                                <th class="text-center">FECHA DE REGISTRO</th>
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
    <div class="modal fade" id="modalNewAdjudicacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nueva Adjudicación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row mb-3">
                        <div class="col-md-12 mb-2">
                            <h5>Listado de Docentes</h5>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group pull-right mb-2">
                                <input type="text" class="search search-postulaciones form-control" placeholder="Buscar">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-bordered results table-postulaciones">
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

                    <div class="row mb-3">
                        <div class="col-md-12 mb-2">
                            <h5>Listado de Plazas</h5>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group pull-right mb-2">
                                <input type="text" class="search search-plazas form-control" placeholder="Buscar">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-bordered table-plazas">
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

                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <h5>Resumen</h5>
                        </div>
                        <div class="col-md-12">
                            <form id="formAdjudicacion">
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label for="" class="form-label">Inicio Contrato</label>
                                        <input type="date" name="fecha_inicio" class="form-control" placeholder="" required/>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="" class="form-label">Término Contrato</label>
                                        <input type="date" name="fecha_final" class="form-control" placeholder="" required/>
                                    </div>
                                </div>                         
                            </form>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" form="formAdjudicacion">Guardar</button>
                    <!-- Puedes agregar más botones en el footer si es necesario. -->
                </div>
            </div>
        </div>
    </div>
</div>