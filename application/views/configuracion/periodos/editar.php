<style>
    #AppEditarPeriodoAdmin .accordion-button {
        width: auto;
        padding: 0.5rem;
        box-shadow: none !important;
        background-color: transparent !important;
    }

    #AppEditarPeriodoAdmin .colvert {
        writing-mode: vertical-lr;
        transform: rotate(180deg);
        text-align: center;
        vertical-align: middle;
    }
    #AppEditarPeriodoAdmin td,
    #AppEditarPeriodoAdmin th {
        vertical-align: middle;
    }
</style>
<h4 class="mt-3"><b><i class="far fa-object-ungroup fa-sm"></i> Editar Periodo</b></h4>
    <ol class="breadcrumb mb-2">
        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"> Inicio</a></li>
        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>configuracion/periodos"> Periodos</a></li>
        <li class="breadcrumb-item active">Editar Periodo</li>
    </ol>
    <?php  $CargoOficina = $this->session->userdata('CargoOficina'); ?>
    <div class="app-row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="card border-secondary" >
                        <div class="card-body text-dark" id="AppEditarPeriodoAdmin" data-id="<?php echo $id; ?>">
                            <div class="text-right mb-2">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <nav>
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <button class="nav-link active" id="nav-1-tab" data-bs-toggle="tab" data-bs-target="#nav-1" type="button" role="tab" aria-controls="nav-1" aria-selected="true">Edición</button>
                                                <button class="nav-link" id="nav-2-tab" data-bs-toggle="tab" data-bs-target="#nav-2" type="button" role="tab" aria-controls="nav-2" aria-selected="false">Anexos</button>
                                            </div>
                                        </nav>
                                        <div class="tab-content" id="nav-tabContent">

                                            <div class="tab-pane fade show active pt-4" id="nav-1" role="tabpanel" aria-labelledby="nav-1-tab">
                                                <form class="mt-4 form-periodo">
                                                    <div class="row">
                                                        <div class="col-md-3 mb-3">
                                                            <label class="form-label">Año</label>
                                                            <input type="number" class="form-control" placeholder="" name="anio" required>
                                                        </div>
                                                        <div class="col-md-9 mb-3">
                                                            <label class="form-label">Nombre</label>
                                                            <input type="text" class="form-control" placeholder="" name="name" minlength="3" maxlength="100" required>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-md-12 mb-3 text-end">
                                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane fade pt-4" id="nav-2" role="tabpanel" aria-labelledby="nav-2-tab">
                                                <div class="row mb-5">
                                                    <div class="col">
                                                        <select class="form-control select-anexo" name="" id="">
                                                            <option value="" hidden>[SELECCIONE]</option>
                                                            <option value="1">Anexo 13</option>
                                                            <option value="2">Anexo 14</option>
                                                        </select>
                                                    </div>
                                                    <div class="col text-end">
                                                        <!-- <button type="button" class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#exampleModal2">Agregar</button> -->
                                                    </div>
                                                </div>
                                                <div class="container-sheet">    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        
                                </div>
                            </div>

                            <div class="modal fade" id="modalViewerAnexo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-fullscreen">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">ANEXO</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center bg-light">RUBRO</th>
                                                        <th class="text-center bg-light">CRITERIOS</th>
                                                        <th class="text-center bg-light">SUBCRITERIOS</th>
                                                        <th class="text-center bg-light">EVALUACIÓN</th>
                                                        <th class="text-center bg-light">Puntaje máximo por subcriterio</th>
                                                        <th class="text-center bg-light">Puntaje máximo por rubro</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="tbody-anexo">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ...
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ...
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
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

  