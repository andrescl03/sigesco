<h4 class="mt-3"><b><i class="far fa-object-ungroup fa-sm"></i> Ficha de evaluación</b></h4>
<ol class="breadcrumb mb-2">
    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"> Inicio</a></li>
    <!-- <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>/porderivar/listar"> Expedientes Por Derivar</a></li>
        <li class="breadcrumb-item active">Registro de Expediente Externo</li> -->
</ol>
<?php 
    $postulante = $datos['data']['postulante'];
    $formaciones_academicas = $datos['data']['postulacion_formaciones_academicas'];
?>
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
                        <div class="card card-body">
                            <div class="table-responsive">
                                <table class="table table-work-experience mb-0">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Institución educativa</th>
                                            <th>Sector</th>
                                            <th>Puesto</th>
                                            <th>N° RD</th>
                                            <th>N° Contrato</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Las filas se agregarán dinámicamente aquí -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
                        <div class="card card-body">
                            <div class="table-responsive">
                                <table class="table table-specialization mb-0">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Tipo de especialización</th>
                                            <th>Tema</th>
                                            <th>Nombre de la entidad</th>
                                            <th>Fecha de inicio</th>
                                            <th>Fecha de termino</th>
                                            <th>Número de horas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Las filas se agregarán dinámicamente aquí -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
                        <div class="card card-body">
                            <div class="table-responsive">
                                <table class="table table-attached-file mb-0">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Tipo</th>
                                            <th>Archivo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Las filas se agregarán dinámicamente aquí -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
                            <div class="row mb-5">
                                <div class="col">
                                    <select class="form-control select-anexo" name="" id="">
                                        <option value="1">Anexo 13</option>
                                        <option value="2">Anexo 14</option>
                                    </select>
                                </div>
                                <div class="col text-end">
                                    <!-- <button type="button" class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#exampleModal2">Agregar</button> -->
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