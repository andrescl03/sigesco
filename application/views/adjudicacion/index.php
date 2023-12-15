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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group pull-right">
                        <input type="text" class="search form-control" placeholder="What you looking for?">
                    </div>
                    <span class="counter pull-right"></span>
                    <table class="table table-hover table-bordered results">
                    <thead>
                        <tr>
                        <th>#</th>
                        <th class="col-md-5 col-xs-5">Name / Surname</th>
                        <th class="col-md-4 col-xs-4">Job</th>
                        <th class="col-md-3 col-xs-3">City</th>
                        </tr>
                        <tr class="warning no-result">
                        <td colspan="4"><i class="fa fa-warning"></i> No result</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th scope="row">1</th>
                        <td>Vatanay Özbeyli</td>
                        <td>UI & UX</td>
                        <td>Istanbul</td>
                        </tr>
                        <tr>
                        <th scope="row">2</th>
                        <td>Burak Özkan</td>
                        <td>Software Developer</td>
                        <td>Istanbul</td>
                        </tr>
                        <tr>
                        <th scope="row">3</th>
                        <td>Egemen Özbeyli</td>
                        <td>Purchasing</td>
                        <td>Kocaeli</td>
                        </tr>
                        <tr>
                        <th scope="row">4</th>
                        <td>Engin Kızıl</td>
                        <td>Sales</td>
                        <td>Bozuyük</td>
                        </tr>
                    </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <!-- Puedes agregar más botones en el footer si es necesario. -->
                </div>
            </div>
        </div>
    </div>
</div>