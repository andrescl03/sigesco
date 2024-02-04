<div id="AppIndexEvaluationGroupInscripcion" data-any="<?= $any ?>" data-convocatoria="<?= $convocatoria_id ?>" data-inscripcion="<?= $inscripcion_id ?>">


    <h4 class="mt-3"><b><i class="far fa-object-ungroup fa-sm"></i> Listado de Evaluaciones <?= $any == 'preliminar' ? 'Preliminares' : 'Finales' ?></b></h4>
    <ol class="breadcrumb mb-2">
        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"> Inicio</a></li>
        <li class="breadcrumb-item"><a href="<?php echo base_url()."evaluacion/convocatoria/".encryption('0||0'); ?>"> Evaluación de postulantes</a></li>
        <li class="breadcrumb-item"><a href="<?php echo base_url()."evaluacion/convocatoria/".encryption($convocatoria_id.'||0'); ?>"> Grupo de inscripción</a></li>
        <li class="breadcrumb-item active">Preliminar</li>
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
                                                            <div class="d-grid gap-2 col-sm-2">
                                                                <a type="button" target="_blank" href="<?php echo base_url().'evaluacion/convocatoria/'.$convocatoria_id.'/inscripcion/'.$inscripcion_id.'/'.($any == 'preliminar' ? 'preliminar' : 'final').'/exportar' ?>" class="btn btn-outline-success btn-sm" >
                                                                    <b><i class="fa-solid fa-file-excel fa-lg"></i> Exportar</b>
                                                                </a>
                                                            </div>
                                                            <div class="vr"></div>
                                                            <div class="col-sm-6"><input type="text" class="form-control form-control-sm" id="txt_buscador" placeholder="Buscar..." ></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  
                                        </div> 
                                    </div>
                                                                            
                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover" id="tableIndex" style="width:100%; margin:0px;">
                                                <thead>
                                                    <tr class="cabecera_tabla_2">
                                                        <th class="text-center">#</th>
                                                        <th class="text-center">ESPECIALISTA</th>
                                                        <th class="text-center">N° DOCUMENTO</th>
                                                        <th class="text-center">APELLIDOS</th>
                                                        <th class="text-center">NOMBRES</th>
                                                        <th class="text-center">ORDEN DE MERITO</th>
                                                        <th class="text-center">EXPEDIENTES</th>
                                                        <th class="text-center">ADJUNTOS</th>
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
    <!-- Modal -->
    <div class="modal fade" id="modalAttachedFiles" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adjuntos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive mb-3">
                        <table class="table mb-0" width="100%">
                            <thead>
                                <tr class="cabecera_tabla_2">
                                    <th scope="col">N°</th>
                                    <th scope="col">Tipo</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col" class="text-center">Archivo</th>
                                </tr>
                            </thead>
                            <tbody class="tbody-attachedfiles">      
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div> -->
            </div>
        </div>
    </div>
</div>