<h4 class="mt-3"><b><i class="far fa-object-ungroup fa-sm"></i> Ficha de evaluación</b></h4>
<ol class="breadcrumb mb-2">
    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"> Inicio</a></li>
    <!-- <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>/porderivar/listar"> Expedientes Por Derivar</a></li>
        <li class="breadcrumb-item active">Registro de Expediente Externo</li> -->
</ol>
<?php
    $postulante = $datos['data']['postulante'];
    $formaciones_academicas = $datos['data']['postulacion_formaciones_academicas'];
    $especializaciones = $datos['data']['postulacion_especializaciones'];
    $experiencias_laborales = $datos['data']['postulacion_experiencias_laborales'];
    $archivos = $datos['data']['postulacion_archivos'];
?>
<style>
    .accordion-button:not(.collapsed){
        background-color: #f8f9fa;
        color: #000;
        font-weight: 550;
    }
    .accordion-button:focus{
        box-shadow: none;
        border-color: #CFD8DC;
    }
</style>
<div class="app-row row">
    <div class="col-md-3">
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDatosPostulante" aria-expanded="false" aria-controls="collapseDatosPostulante">
                        
                        Datos personales del postulante
                    </button>
                </h2>
                <div id="collapseDatosPostulante" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="form-group row mb-1">
                            <label class="col-xl-4 col-lg-4">Nombres</label>
                            <div class="col-xl-8 col-lg-8">
                                <?php echo $postulante->nombre ?>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-xl-4 col-lg-4">Apellido Paterno</label>
                            <div class="col-xl-8 col-lg-8">
                                <?php echo $postulante->apellido_paterno ?>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-xl-4 col-lg-4">Apellido Materno</label>
                            <div class="col-xl-8 col-lg-8">
                                <?php echo $postulante->apellido_materno ?>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-xl-4 col-lg-4">Género</label>
                            <div class="col-xl-8 col-lg-8">
                                <?php echo $postulante->genero ?>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-xl-4 col-lg-4">Estado Civil</label>
                            <div class="col-xl-8 col-lg-8">
                                <?php echo $postulante->estado_civil ?>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-xl-4 col-lg-4">Nacionalidad</label>
                            <div class="col-xl-8 col-lg-8">
                                <?php echo $postulante->nacionalidad ?>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-xl-4 col-lg-4">Fecha de Nacimiento</label>
                            <div class="col-xl-8 col-lg-8">
                                <?php echo $postulante->fecha_nacimiento ?>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-xl-4 col-lg-4">Correo Electrónico</label>
                            <div class="col-xl-8 col-lg-8">
                                <?php echo $postulante->correo ?>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-xl-4 col-lg-4">Número de Celular</label>
                            <div class="col-xl-8 col-lg-8">
                                <?php echo $postulante->numero_celular ?>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-xl-4 col-lg-4">Número de Teléfono</label>
                            <div class="col-xl-8 col-lg-8">
                                <?php echo $postulante->numero_telefono ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseUbicacion" aria-expanded="false" aria-controls="collapseUbicacion">
                        Datos de ubicación
                    </button>
                </h2>
                <div id="collapseUbicacion" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        
                        <div class="form-group row mb-1">
                            <label class="col-xl-4 col-lg-4 col-form-label">Departamento</label>
                            <div class="col-xl-8 col-lg-8">
                                <?php echo $postulante->numero_telefono ?>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-xl-4 col-lg-4 col-form-label">Provincia</label>
                            <div class="col-xl-8 col-lg-8">
                                <?php echo $postulante->numero_telefono ?>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-xl-4 col-lg-4 col-form-label">Distrito</label>
                            <div class="col-xl-8 col-lg-8">
                                <?php echo $postulante->distrito_id ?>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-xl-4 col-lg-4 col-form-label">Vía</label>
                            <div class="col-xl-8 col-lg-8">
                                <?php echo $postulante->via ?>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-xl-4 col-lg-4 col-form-label">Nombre de la Vía</label>
                            <div class="col-xl-8 col-lg-8">
                                <?php echo $postulante->nombre_via ?>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-xl-4 col-lg-4 col-form-label">Nombre de la Zona</label>
                            <div class="col-xl-8 col-lg-8">
                                <?php echo $postulante->zona ?>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-xl-4 col-lg-4 col-form-label">Dirección</label>
                            <div class="col-xl-8 col-lg-8">
                                <?php echo $postulante->direccion ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFormacionAcademica" aria-expanded="false" aria-controls="collapseFormacionAcademica">
                        Formación académica
                    </button>
                </h2>
                <div id="collapseFormacionAcademica" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <?php foreach ($formaciones_academicas as $k => $formacion_academica) { ?>
                            <div class="form-group row mb-1">
                                <label class="col-xl-4 col-lg-4">Nivel Educativo</label>
                                <div class="col-xl-8 col-lg-8">
                                    <?php echo $formacion_academica->nivel_educativo ?>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label class="col-xl-4 col-lg-4">Grado Académico</label>
                                <div class="col-xl-8 col-lg-8">
                                    <?php echo $formacion_academica->grado_academico ?>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label class="col-xl-4 col-lg-4">Universidad</label>
                                <div class="col-xl-8 col-lg-8">
                                    <?php echo $formacion_academica->universidad ?>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label class="col-xl-4 col-lg-4">Carrera Profesional</label>
                                <div class="col-xl-8 col-lg-8">
                                    <?php echo $formacion_academica->carrera_profesional ?>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label class="col-xl-4 col-lg-4 text-secondary">N° de Registro de Título</label>
                                <div class="col-xl-8 col-lg-8 bold">
                                    <?php echo $formacion_academica->registro_titulo ?>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label class="col-xl-4 col-lg-4">RD de Título N°</label>
                                <div class="col-xl-8 col-lg-8">
                                    <?php echo $formacion_academica->rd_titulo ?>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label class="col-xl-4 col-lg-4">Obtención del Grado</label>
                                <div class="col-xl-8 col-lg-8">
                                    <?php echo $formacion_academica->obtencion_grado ?>
                                </div>
                            </div>
                        
                        <?php if ($k < count($formaciones_academicas) - 1) { ?>
                            <hr>
                        <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExperienciaLaboral" aria-expanded="false" aria-controls="collapseExperienciaLaboral">
                        Experiencia laboral
                    </button>
                </h2>
                <div id="collapseExperienciaLaboral" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    <?php foreach ($experiencias_laborales as $k => $experiencia_laboral) { ?>
                        <div class="form-group row mb-1">
                            <label class="col-xl-4 col-lg-4">Institución educativa</label>
                            <div class="col-xl-8 col-lg-8">
                                <?php echo $experiencia_laboral->institucion_educativa ?>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-xl-4 col-lg-4">Sector</label>
                            <div class="col-xl-8 col-lg-8">
                                <?php echo $experiencia_laboral->sector ?>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-xl-4 col-lg-4">Puesto</label>
                            <div class="col-xl-8 col-lg-8">
                                <?php echo $experiencia_laboral->puesto ?>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-xl-4 col-lg-4">N° RD</label>
                            <div class="col-xl-8 col-lg-8">
                                <?php echo $experiencia_laboral->numero_rd ?>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-xl-4 col-lg-4">N° Contrato</label>
                            <div class="col-xl-8 col-lg-8">
                                <?php echo $experiencia_laboral->numero_contrato ?>
                            </div>
                        </div>
                        <?php if ($k < count($experiencias_laborales) - 1) { ?>
                            <hr>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEspecializacion" aria-expanded="false" aria-controls="collapseEspecializacion">
                        Especialización
                    </button>
                </h2>
                <div id="collapseEspecializacion" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    <?php foreach ($especializaciones as $k => $especializacion) { ?>
                        <div class="form-group row mb-1">
                            <label class="col-xl-4 col-lg-4">Tipo de especialización</label>
                            <div class="col-xl-8 col-lg-8">
                                <?php echo $especializacion->tipo_especializacion ?>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-xl-4 col-lg-4">Tema</label>
                            <div class="col-xl-8 col-lg-8">
                                <?php echo $especializacion->tema_especializacion ?>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-xl-4 col-lg-4">Nombre de la entidad</label>
                            <div class="col-xl-8 col-lg-8">
                                <?php echo $especializacion->nombre_entidad ?>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-xl-4 col-lg-4">Fecha de inicio</label>
                            <div class="col-xl-8 col-lg-8">
                                <?php echo $especializacion->fecha_inicio ?>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-xl-4 col-lg-4">Fecha de termino</label>
                            <div class="col-xl-8 col-lg-8">
                                <?php echo $especializacion->fecha_termino ?>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-xl-4 col-lg-4">Número de horas</label>
                            <div class="col-xl-8 col-lg-8">
                                <?php echo $especializacion->numero_horas ?>
                            </div>
                        </div>
                        <?php if ($k < count($especializaciones) - 1) { ?>
                            <hr>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseArchivosAdjuntos" aria-expanded="false" aria-controls="collapseArchivosAdjuntos">
                        Archivos adjuntos
                    </button>
                </h2>
                <div id="collapseArchivosAdjuntos" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body">

                    <?php foreach ($archivos as $k => $archivo) { ?>
                        <div class="form-group row mb-1">
                            <label class="col-xl-4 col-lg-4">Archivo</label>
                            <div class="col-xl-8 col-lg-8">
                                <?php echo $archivo->nombre ?>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-xl-4 col-lg-4">Visualizar</label>
                            <div class="col-xl-8 col-lg-8">
                                <i class="fa fa-file-pdf fa-2xl text-danger" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#modalFilePostulant<?php echo $archivo->id ?>"></i>
                                <div class="modal fade" id="modalFilePostulant<?php echo $archivo->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">ARCHIVO</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-0">
                                                <iframe src="<?php base_url() ?>/public<?php echo $archivo->url ?>" width="100%" height="700px"></iframe>
                                            </div>
                                            <!-- <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if ($k < count($archivos) - 1) { ?>
                            <hr>
                        <?php } ?>
                    <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="tile">
            <div class="tile-body">
                <div class="card border-secondary">
                    <div class="card-body text-dark">
                        <div class="text-right mb-2">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <select class="form-control select-anexo" name="" id="">
                                        <option value="1">Anexo 13</option>
                                        <option value="2">Anexo 14</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>