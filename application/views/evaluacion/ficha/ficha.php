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
                            <div class="col-lg-12">
                                <strong>Nombres: </strong>
                                <span>
                                    <?php echo $postulante->nombre ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <div class="col-lg-12">
                                <strong>Apellido Paterno: </strong>
                                <span>
                                    <?php echo $postulante->apellido_paterno ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <div class="col-lg-12">
                                <strong>Apellido Materno</strong>
                                <span>
                                    <?php echo $postulante->apellido_materno ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <div class="col-lg-12">
                                <strong>Género</strong>
                                <span>
                                    <?php echo $postulante->genero ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <div class="col-lg-12">
                                <strong>Estado Civil</strong>
                                <span>
                                    <?php echo $postulante->estado_civil ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <div class="col-lg-12">
                                <strong>Nacionalidad</strong>
                                <span>
                                    <?php echo $postulante->nacionalidad ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <div class="col-lg-12">
                                <strong>Fecha de Nacimiento</strong>
                                <span>
                                    <?php echo $postulante->fecha_nacimiento ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <div class="col-lg-12">
                                <strong>Correo Electrónico</strong>
                                <span>
                                    <?php echo $postulante->correo ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <div class="col-lg-12">
                                <strong>Número de Celular</strong>
                                <span>
                                    <?php echo $postulante->numero_celular ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <div class="col-lg-12">
                                <strong>Número de Teléfono</strong>
                                <span>
                                    <?php echo $postulante->numero_telefono ?>
                                </span>
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
                            <div class="col-lg-12">
                                <strong>Departamento</strong>
                                <span>
                                    <?php echo $postulante->numero_telefono ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <div class="col-lg-12">
                                <strong>Provincia</strong>
                                <span>
                                    <?php echo $postulante->numero_telefono ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <div class="col-lg-12">
                                <strong>Distrito</strong>
                                <span>
                                    <?php echo $postulante->distrito_id ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <div class="col-lg-12">
                                <strong>Vía</strong>
                                <span>
                                    <?php echo $postulante->via ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <div class="col-lg-12">
                                <strong>Nombre de la Vía</strong>
                                <span>
                                    <?php echo $postulante->nombre_via ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <div class="col-lg-12">
                                <strong>Nombre de la Zona</strong>
                                <span>
                                    <?php echo $postulante->zona ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <div class="col-lg-12">
                                <strong>Dirección</strong>
                                <span>
                                    <?php echo $postulante->direccion ?>
                                </span>
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
                                <div class="col-lg-12">
                                    <strong>Nivel Educativo</strong>
                                    <span>
                                        <?php echo $formacion_academica->nivel_educativo ?>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <div class="col-lg-12">
                                    <strong>Grado Académico</strong>
                                    <span>
                                        <?php echo $formacion_academica->grado_academico ?>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <div class="col-lg-12">
                                    <strong>Universidad</strong>
                                    <span>
                                        <?php echo $formacion_academica->universidad ?>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <div class="col-lg-12">
                                    <strong>Carrera Profesional</strong>
                                    <span>
                                        <?php echo $formacion_academica->carrera_profesional ?>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <div class="col-lg-12">
                                    <strong>N° de Registro de Título</strong>
                                    <span>
                                        <?php echo $formacion_academica->registro_titulo ?>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <div class="col-lg-12">
                                    <strong>RD de Título N°</strong>
                                    <span>
                                        <?php echo $formacion_academica->rd_titulo ?>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <div class="col-lg-12">
                                    <strong>Obtención del Grado</strong>
                                    <span>
                                        <?php echo $formacion_academica->obtencion_grado ?>
                                    </span>
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
                            <div class="col-lg-12">
                                <strong>Institución educativa</strong>
                                <span>
                                    <?php echo $experiencia_laboral->institucion_educativa ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <div class="col-lg-12">
                                <strong>Sector</strong>
                                <span>
                                    <?php echo $experiencia_laboral->sector ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <div class="col-lg-12">
                                <strong>Puesto</strong>
                                <span>
                                    <?php echo $experiencia_laboral->puesto ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <div class="col-lg-12">
                                <strong>N° RD</strong>
                                <span>
                                    <?php echo $experiencia_laboral->numero_rd ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <div class="col-lg-12">
                                <strong>N° Contrato</strong>
                                <span>
                                    <?php echo $experiencia_laboral->numero_contrato ?>
                                </span>
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
                            <div class="col-lg-12">
                                <strong>Tipo de especialización</strong>
                                <span>
                                    <?php echo $especializacion->tipo_especializacion ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <div class="col-lg-12">
                                <strong>Tema</strong>
                                <span>
                                    <?php echo $especializacion->tema_especializacion ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <div class="col-lg-12">
                                <strong>Nombre de la entidad</strong>
                                <span>
                                    <?php echo $especializacion->nombre_entidad ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <div class="col-lg-12">
                                <strong>Fecha de inicio</strong>
                                <span>
                                    <?php echo $especializacion->fecha_inicio ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <div class="col-lg-12">
                                <strong>Fecha de termino</strong>
                                <span>
                                    <?php echo $especializacion->fecha_termino ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <div class="col-lg-12">
                                <strong>Número de horas</strong>
                                <span>
                                    <?php echo $especializacion->numero_horas ?>
                                </span>
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
                            <div class="col-lg-12">
                                <strong>Archivo</strong>
                                <span>
                                    <?php echo $archivo->nombre ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <div class="col-lg-12">
                                <strong>Visualizar</strong>
                                <span>
                                    <i class="fa fa-file-pdf fa-2xl text-danger ms-2" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#modalFilePostulant<?php echo $archivo->id ?>"></i>
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
                                </span>
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
                            <!-- <div class="row mb-3">
                                <div class="col-md-12">
                                    <select class="form-control select-anexo" name="" id="">
                                        <option value="1">Anexo 13</option>
                                        <option value="2">Anexo 14</option>
                                    </select>
                                </div>
                            </div> -->
                            <div class="row">
                             
                                <div id="containerFicha">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>