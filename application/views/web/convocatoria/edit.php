<?php 
    $convocatoria = $data['convocatoria'];  
    $postulante = $data['postulante'];  
    $postulacion_archivos = $data['postulacion_archivos'];  
    $postulacion_experiencias_laborales = $data['postulacion_experiencias_laborales'];  
    $postulacion_formaciones_academicas = $data['postulacion_formaciones_academicas'];  
    $postulacion_especializaciones = $data['postulacion_especializaciones'];
    $anexos    = [];
    $anexos[1] = 'Anexo 8';
    $anexos[2] = 'Anexo 9';  
    $anexos[3] = 'Anexo 10';  
    $anexos[4] = 'Anexo 11';  
    $anexos[5] = 'Anexo 12';  
    $anexos[6] = 'Anexo 19';
?>
<div class="container" id="AppConvovatoriaEditWeb"  data-uid="<?php echo $data['uid'] ?>" data-id="<?php echo $convocatoria->con_id ?>" data-type="<?php echo $convocatoria->con_tipo ?>">
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title mx-auto">
                <h3 class="card-label text-center my-2"><p>MI POSTULACIÓN <?php echo $convocatoria->con_anio ?></p>
                    DESDE <?php echo $convocatoria->con_fechainicio ?> AL <?php echo $convocatoria->con_fechafin ?>
                </h3>
            </div>
        </div>
        <div class="card-body">
            <div class="row justify-content-center py-4">
                <div class="col-xl-3 p-0">
                    <div class="tab-list sticky-top">
                        <div class="side-nav">
                            <ul>
                                <!-- <li><a href="" data-scroll="0">Datos de postulación</a></li>
                                <li><a href="" data-scroll="1">Datos personales del postulante</a></li>
                                <li><a href="" data-scroll="2">Datos de ubicación</a></li> -->
                                <li><a href="" data-scroll="3">Formación académica</a></li>
                                <li><a href="" data-scroll="4">Experiencia laboral</a></li>
                                <li><a href="" data-scroll="5">Especialización</a></li>
                                <li><a href="" data-scroll="6">Archivos adjuntos</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9">
                    <!-- <form class="form-postulant needs-validation" id="formPostulant" novalidate> -->
                        <?php if ($convocatoria->con_tipo == 2) { ?>
                        <!-- <div class="card mb-5 section" data-scrolled="0">
                            <form class="form-postulant needs-validation" novalidate>
                                <div class="card-header">
                                    <h5 class="my-2">Datos de Postulación</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Modalidad</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <select class="form-control form-control-solid select-modalidad form-input-validate" name="modalidad_id" required readonly>
                                                <option value="" hidden>[SELECCIONE]</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Nivel</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <select class="form-control form-control-solid select-nivel form-input-validate" name="nivel_id" required readonly>
                                                <option value="" hidden>[SELECCIONE]</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Especialidad</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <select class="form-control form-control-solid select-especialidad form-input-validate" name="especialidad_id" required readonly>
                                                <option value="" hidden>[SELECCIONE]</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <button type="submit" class="btn btn-primary float-end">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div> -->
                        <?php } ?>
                        <!-- <div class="card mb-5 section" data-scrolled="1">
                            <form class="form-postulant needs-validation" novalidate>
                                <input type="hidden" name="any" value="datos_postulante" required>
                                <div class="card-header">
                                    <h5 class="my-2">Datos personales del postulante</h5>
                                </div>
                                <div class="card-body">
                                <?php if ($convocatoria->con_tipo == 1) { ?>
                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Nombres</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <input type="text" name="nombre" class="form-control form-control-solid form-input-validate" required readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Apellido Paterno</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <input type="text" name="apellido_paterno" class="form-control form-control-solid form-input-validate" required readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Apellido Materno</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <input type="text" name="apellido_materno" class="form-control form-control-solid form-input-validate" required readonly>
                                        </div>
                                    </div>
                                <?php } ?>
                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Género</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <select class="form-control form-control-solid form-input-validate" name="genero" required>
                                                <option value="" hidden>[SELECCIONE]</option>
                                                <option value="M">Masculino</option>
                                                <option value="F">Femenino</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Estado Civil</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <select class="form-control form-control-solid form-input-validate" name="estado_civil" required>
                                                <option value="" hidden>[SELECCIONE]</option>
                                                <option value="soltero">Soltero</option>
                                                <option value="casado">Casado</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Nacionalidad</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <select class="form-control form-control-solid form-input-validate" name="nacionalidad" value="<?php echo $postulante->nacionalidad ?>" required>
                                                <option value="" hidden>[SELECCIONE]</option>
                                                <option value="Peruana">Peruana</option>
                                                <option value="Extranjera">Extranjera</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Fecha de Nacimiento</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <input type="date" name="fecha_nacimiento" class="form-control form-control-solid form-input-validate" value="<?php echo $postulante->fecha_nacimiento ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Correo Electrónico</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <input type="email" name="correo" class="form-control form-control-solid form-input-validate" value="<?php echo $postulante->correo ?>" required>
                                            <small>Se enviarán todas las notificaciones del proceso de contratación docente.</small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Número de Celular</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <input type="text" name="numero_celular" class="form-control form-control-solid form-input-validate" value="<?php echo $postulante->numero_celular ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Número de Teléfono</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <input type="text" name="numero_telefono" class="form-control form-control-solid form-input-validate" value="<?php echo $postulante->numero_telefono ?>" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <button type="submit" class="btn btn-primary float-end">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                       
                        <div class="card mb-5 section" data-scrolled="2">
                            <form class="form-postulant needs-validation" novalidate>
                                <input type="hidden" name="any" value="datos_ubicacion" required>
                                <div class="card-header">
                                    <h5 class="my-2">Datos de Ubicación</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Departamento</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <select class="form-control form-control-solid select-department form-input-validate" name="departmento_id" required>
                                                <option value="" hidden>[SELECCIONE]</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Provincia</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <select class="form-control form-control-solid select-province form-input-validate" name="provincia_id" required>
                                                <option value="" hidden>[SELECCIONE]</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Distrito</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <select class="form-control form-control-solid select-district form-input-validate" name="distrito_id" required>
                                                <option value="" hidden>[SELECCIONE]</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Vía</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <input type="text" name="via" class="form-control form-control-solid form-input-validate" value="<?php echo $postulante->via ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Nombre de la Vía</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <input type="text" name="nombre_via" class="form-control form-control-solid form-input-validate" value="<?php echo $postulante->nombre_via ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Nombre de la Zona</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <input type="text" name="zona" class="form-control form-control-solid form-input-validate" value="<?php echo $postulante->zona ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Dirección</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <input type="text" name="direccion" class="form-control form-control-solid form-input-validate" value="<?php echo $postulante->direccion ?>" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <button type="submit" class="btn btn-primary float-end">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div> -->

                        <div class="card mb-5 section" data-scrolled="3">
                            <div class="card-header d-flex justify-content-between">
                                <h5 class="my-2">Formación académica</h5>
                                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#modalAcademicTraining">Agregar</button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead class="text-center">
                                            <tr>
                                                <th>Nivel Educativo</th>
                                                <th>Grado Académico</th>
                                                <th>Universidad</th>
                                                <th>Carrera Profesional</th>
                                                <th>N° de Registro de Título</th>
                                                <th>RD de Título N°</th>
                                                <th>Obtención del Grado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($postulacion_formaciones_academicas as $key => $item) { ?>
                                            <tr>
                                                <td class="text-center"><?php echo $item->nivel_educativo ?></td>
                                                <td class="text-center"><?php echo $item->grado_academico ?></td>
                                                <td class="text-center"><?php echo $item->universidad ?></td>
                                                <td class="text-center"><?php echo $item->carrera_profesional ?></td>
                                                <td class="text-center"><?php echo $item->registro_titulo ?></td>
                                                <td class="text-center"><?php echo $item->rd_titulo ?></td>
                                                <td class="text-center"><?php echo $item->obtencion_grado ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="<?php echo $item->id ?>" data-any="formacion_academica_eliminar">Eliminar</button>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                  
                        <div class="card mb-5 section" data-scrolled="4">
                            <div class="card-header d-flex justify-content-between">
                                <h5 class="my-2">Experiencia laboral</h5>
                                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#modalWorkExperience">Agregar</button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-work-experience mb-0">
                                        <thead class="text-center">
                                            <tr>
                                                <th>Institución educativa</th>
                                                <th>Sector</th>
                                                <th>Puesto</th>
                                                <th>N° RD</th>
                                                <th>N° Contrato</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($postulacion_experiencias_laborales as $key => $item) { ?>
                                            <tr>
                                                <td class="text-center"><?php echo $item->institucion_educativa ?></td>
                                                <td class="text-center"><?php echo $item->sector ?></td>
                                                <td class="text-center"><?php echo $item->puesto ?></td>
                                                <td class="text-center"><?php echo $item->numero_rd ?></td>
                                                <td class="text-center"><?php echo $item->numero_contrato ?></td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="<?php echo $item->id ?>" data-any="experiencia_laboral_eliminar">Eliminar</button>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-5 section" data-scrolled="5">
                            <div class="card-header d-flex justify-content-between">
                                <h5 class="my-2">Especialización</h5>
                                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#modalSpecialization">Agregar</button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead class="text-center">
                                            <tr>
                                                <th>Tipo de especialización</th>
                                                <th>Tema</th>
                                                <th>Nombre de la entidad</th>
                                                <th>Fecha de inicio</th>
                                                <th>Fecha de termino</th>
                                                <th>Número de horas</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($postulacion_especializaciones as $key => $item) { ?>
                                            <tr>
                                                <td class="text-center"><?php echo $item->tipo_especializacion ?></td>
                                                <td class="text-center"><?php echo $item->tema_especializacion ?></td>
                                                <td class="text-center"><?php echo $item->nombre_entidad ?></td>
                                                <td class="text-center"><?php echo $item->fecha_inicio ?></td>
                                                <td class="text-center"><?php echo $item->fecha_termino ?></td>
                                                <td class="text-center"><?php echo $item->numero_horas ?></td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="<?php echo $item->id ?>" data-any="especializacion_eliminar">Eliminar</button>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-5 section" data-scrolled="6">
                            <div class="card-header d-flex justify-content-between">
                                <h5 class="my-2">Archivos adjuntos</h5>
                                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#modalAttachedFile">Agregar</button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-attached-file mb-0">
                                        <thead class="text-center">
                                            <tr>
                                                <th>Tipo</th>
                                                <th>Archivo</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($postulacion_archivos as $key => $item) { ?>
                                            <tr>
                                                <td class="text-center"><?php echo $anexos[$item->tipo_id] ?></td>
                                                <td class="text-center"><a href="<?php echo base_url() ?>public<?php echo $item->url ?>" target="_blank"><?php echo $item->nombre ?></a></td>
                                             <!--<td class="text-center">
                                                    <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="<?php echo $item->id ?>" data-any="archivos_adjuntos_eliminar">Eliminar</button>
                                                </td>-->
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <!-- </form> -->
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="card-toolbar d-flex justify-content-center">
                <a href="/web/convocatorias" type="button" class="btn btn-secondary my-3">Inicio</a>
            </div>
        </div>
        <div class="modal fade" id="modalWorkExperience" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form class="form-postulant needs-validation" novalidate>
                    <input type="hidden" value="experiencia_laboral_guardar" name="any" required>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Experiencia Laboral</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-xl-4 col-lg-4 col-form-label">Institución educativa</label>
                                <div class="col-xl-8 col-lg-8">
                                    <input type="text" name="institucion_educativa" class="form-control form-control-solid" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-4 col-lg-4 col-form-label">Sector</label>
                                <div class="col-xl-8 col-lg-8">
                                    <select class="form-control form-control-solid" name="sector" required>
                                        <option value="" hidden>[SELECCIONE]</option>
                                        <option value="Pública">Pública</option>
                                        <option value="Privada">Privada</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-4 col-lg-4 col-form-label">Puesto</label>
                                <div class="col-xl-8 col-lg-8">
                                    <select class="form-control form-control-solid" name="puesto" required>
                                        <option value="" hidden>[SELECCIONE]</option>
                                        <option value="Docente">Docente</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-4 col-lg-4 col-form-label">N° RD</label>
                                <div class="col-xl-8 col-lg-8">
                                    <input type="text" name="numero_rd" class="form-control form-control-solid" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-4 col-lg-4 col-form-label">N° Contrato</label>
                                <div class="col-xl-8 col-lg-8">
                                    <input type="text" name="numero_contrato" class="form-control form-control-solid" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal fade" id="modalSpecialization" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form class="form-postulant needs-validation" novalidate>
                    <input type="hidden" value="especializacion_guardar" name="any" required>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Especialización</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-xl-4 col-lg-4 col-form-label">Tipo de especialización</label>
                                <div class="col-xl-8 col-lg-8">
                                    <select id="tipoEspecializacion" class="form-control form-control-solid" name="tipo_especializacion" required>
                                        <option value="" hidden>[SELECCIONE]</option>
                                        <option value="Pública">Pública</option>
                                        <option value="Privada">Privada</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-4 col-lg-4 col-form-label">Tema</label>
                                <div class="col-xl-8 col-lg-8">
                                    <input type="text" id="temaEspecializacion" name="tema_especializacion" class="form-control form-control-solid" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-4 col-lg-4 col-form-label">Nombre de la entidad</label>
                                <div class="col-xl-8 col-lg-8">
                                    <input type="text" id="nombreEntidad" name="nombre_entidad" class="form-control form-control-solid" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-4 col-lg-4 col-form-label">Fecha de inicio</label>
                                <div class="col-xl-8 col-lg-8">
                                    <input type="date" id="fechaInicio" name="fecha_inicio" class="form-control form-control-solid" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-4 col-lg-4 col-form-label">Fecha de termino</label>
                                <div class="col-xl-8 col-lg-8">
                                    <input type="date" id="fechaTermino" name="fecha_termino" class="form-control form-control-solid" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-4 col-lg-4 col-form-label">Número de horas</label>
                                <div class="col-xl-8 col-lg-8">
                                    <input type="number" id="numeroHoras" name="numero_horas" class="form-control form-control-solid" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal fade" id="modalAcademicTraining" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form class="form-postulant needs-validation" novalidate>
                    <input type="hidden" value="formacion_academica_guardar" name="any" required>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Formación Académica</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-xl-4 col-lg-4 col-form-label">Nivel educativo</label>
                                <div class="col-xl-8 col-lg-8">
                                    <select class="form-control form-control-solid" name="nivel_educativo" required>
                                        <option value="" hidden>[SELECCIONE]</option>
                                        <option value="Técnico superior">Técnico superior</option>
                                        <option value="Técnico superior">Universitario</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-4 col-lg-4 col-form-label">Grado académico</label>
                                <div class="col-xl-8 col-lg-8">
                                    <select class="form-control form-control-solid" name="grado_academico" required>
                                        <option value="" hidden>[SELECCIONE]</option>
                                        <option value="Estudiante">Estudiante</option>
                                        <option value="Egresado">Egresado</option>
                                        <option value="Titulado">Titulado</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-4 col-lg-4 col-form-label">Universidad</label>
                                <div class="col-xl-8 col-lg-8">
                                    <select class="form-control form-control-solid" name="universidad" required>
                                        <option value="" hidden>[SELECCIONE]</option>
                                        <option value="UPN">Universidad privada del Norte</option>
                                        <option value="Universidad privada del Norte">Universidad de Lima</option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-4 col-lg-4 col-form-label">Carrera profesional</label>
                                <div class="col-xl-8 col-lg-8">
                                    <select class="form-control form-control-solid" name="carrera_profesional" required>
                                        <option value="" hidden>[SELECCIONE]</option>
                                        <option value="Ingenieria de sistemas">Ingenieria de sistemas</option>
                                        <option value="Ingenieria ambiental">Ingenieria ambiental</option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-4 col-lg-4 col-form-label">N° de registro de título</label>
                                <div class="col-xl-8 col-lg-8">
                                    <input type="text" name="registro_titulo" class="form-control form-control-solid" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-4 col-lg-4 col-form-label">RD de título N°</label>
                                <div class="col-xl-8 col-lg-8">
                                    <input type="text" name="rd_titulo" class="form-control form-control-solid" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-4 col-lg-4 col-form-label">Obtención del grado</label>
                                <div class="col-xl-8 col-lg-8">
                                    <input type="text" name="obtencion_grado" class="form-control form-control-solid" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal fade" id="modalAttachedFile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form class="form-postulant needs-validation" novalidate>
                    <input type="hidden" value="archivos_adjuntos_guardar" name="any" required>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Archivo Adjunto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <div class="form-group row">
                                <label class="col-xl-4 col-lg-4 col-form-label">Tipo</label>
                                <div class="col-xl-8 col-lg-8">
                                    <select class="form-control form-control-solid" name="tipo" required>
                                        <option value="" hidden>[SELECCIONE]</option>
                                        <option value="1">Anexo 1</option>
                                        <option value="2">Anexo 2</option>
                                        <option value="3">Anexo 3</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-4 col-lg-4 col-form-label">Archivo</label>
                                <div class="col-xl-8 col-lg-8">
                                    <input class="form-control form-control-solid" name="archivo" type="file" accept="application/pdf" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCELAR</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
