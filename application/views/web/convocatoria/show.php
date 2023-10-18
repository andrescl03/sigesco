<?php $convocatoria = $data['convocatoria'];  ?>
<div class="container" id="AppConvocatoriaWeb" data-id="<?php echo $convocatoria->con_id ?>" data-type="<?php echo $convocatoria->con_type_postulacion ?>">
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title mx-auto">
                <h3 class="card-label text-center my-2"><p>CONVOCATORIA REGISTRO DE DOCENTE <?php echo $convocatoria->con_anio ?></p>
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
                                <li><a href="" data-scroll="0">Datos de postulación</a></li>
                                <li><a href="" data-scroll="1">Datos personales del postulante</a></li>
                                <li><a href="" data-scroll="2">Datos de ubicación</a></li>
                                <li><a href="" data-scroll="3">Formación académica</a></li>
                                <li><a href="" data-scroll="4">Experiencia laboral</a></li>
                                <li><a href="" data-scroll="5">Especialización</a></li>
                                <li><a href="" data-scroll="6">Archivos adjuntos</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9">
                    <form class="form-postulant needs-validation" id="formPostulant" novalidate>
                        <div class="form-group row section" data-scrolled="0">
                            <label class="col-xl-4 col-lg-4 col-form-label">Tipo de Documento</label>
                            <div class="col-xl-8 col-lg-8">
                                <div class="form-group form-check form-check-inline">
                                    <input class="form-check-input form-radio-document" type="radio" name="tipo_documento" id="radio4" value="1" checked>
                                    <label class="form-check-label" for="radio4">DNI</label>
                                </div>
                                <div class="form-group form-check form-check-inline">
                                    <input class="form-check-input form-radio-document" type="radio" name="tipo_documento" id="radio444" value="2">
                                    <label class="form-check-label" for="radio444">Carnet de Extranjería</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-4 col-lg-4 col-form-label">Número de Documento</label>
                            <div class="col-xl-8 col-lg-8">
                                <?php if ($convocatoria->con_type_postulacion == 2) { ?>
                                <div class="input-group mb-3">
                                    <input type="text" id="inputDocumento" name="numero_documento" class="form-control form-control-solid form-input-document" placeholder="Ingrese su número de documento" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary btn-documento" type="button">Validar</button>
                                        <button class="btn btn-danger btn-documento-cancel" type="button" style="display:none;">Cambiar</button>
                                    </div>
                                </div>
                                <div class="alert-postulant">
                                    
                                </div>
                                <?php } else { ?>
                                    <div class="input-group mb-3">
                                        <input type="text" id="inputDocumento" name="numero_documento" class="form-control form-control-solid" placeholder="Ingrese su número de documento" required>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary btn-documento" type="button">Validar</button>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
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
                        <div class="form-group row mt-5 section" data-scrolled="1">
                            <div class="offset-xl-4 offset-lg-4 col-xl-8 col-lg-8 col-form-label">
                                <h5>Datos personales del postulante:</h5>
                            </div>
                        </div>
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
                                <select class="form-control form-control-solid form-input-validate" name="nacionalidad" required>
                                    <option value="" hidden>[SELECCIONE]</option>
                                    <option value="Peruana">Peruana</option>
                                    <option value="Extranjera">Extranjera</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-4 col-lg-4 col-form-label">Fecha de Nacimiento</label>
                            <div class="col-xl-8 col-lg-8">
                                <input type="date" name="fecha_nacimiento" class="form-control form-control-solid form-input-validate" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-4 col-lg-4 col-form-label">Correo Electrónico</label>
                            <div class="col-xl-8 col-lg-8">
                                <input type="email" name="correo" class="form-control form-control-solid form-input-validate" required>
                                <small>Se enviarán todas las notificaciones del proceso de contratación docente.</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-4 col-lg-4 col-form-label">Número de Celular</label>
                            <div class="col-xl-8 col-lg-8">
                                <input type="text" name="numero_celular" class="form-control form-control-solid form-input-validate" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-4 col-lg-4 col-form-label">Número de Teléfono</label>
                            <div class="col-xl-8 col-lg-8">
                                <input type="text" name="numero_telefono" class="form-control form-control-solid form-input-validate" required>
                            </div>
                        </div>
                        <div class="form-group row mt-5 section" data-scrolled="2">
                            <div class="offset-xl-4 offset-lg-4 col-xl-8 col-lg-8 col-form-label">
                                <h5>Datos de Ubicación:</h5>
                            </div>
                        </div>
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
                                <input type="text" name="via" class="form-control form-control-solid form-input-validate" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-4 col-lg-4 col-form-label">Nombre de la Vía</label>
                            <div class="col-xl-8 col-lg-8">
                                <input type="text" name="nombre_via" class="form-control form-control-solid form-input-validate" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-4 col-lg-4 col-form-label">Nombre de la Zona</label>
                            <div class="col-xl-8 col-lg-8">
                                <input type="text" name="zona" class="form-control form-control-solid form-input-validate" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-4 col-lg-4 col-form-label">Dirección</label>
                            <div class="col-xl-8 col-lg-8">
                                <input type="text" name="direccion" class="form-control form-control-solid form-input-validate" required>
                            </div>
                        </div>
                        <div class="form-group row mt-5 section" data-scrolled="3">
                            <div class="offset-xl-4 offset-lg-4 col-xl-8 col-lg-8 col-form-label d-flex justify-content-between">
                                <h5 class="my-auto">Formación académica:</h5>
                                <button type="button" class="btn btn-primary btn-academic-training float-end form-input-validate">Agregar</button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-academic-training mb-0">
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
                                    <!-- Las filas se agregarán dinámicamente aquí -->
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group row mt-5 section" data-scrolled="4">
                            <div class="offset-xl-4 offset-lg-4 col-xl-8 col-lg-8 col-form-label d-flex justify-content-between">
                                <h5 class="my-auto">Experiencia laboral:</h5>
                                <button type="button" class="btn btn-primary btn-work-experience float-end form-input-validate">Agregar</button>
                            </div>
                        </div>
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
                                    <!-- Las filas se agregarán dinámicamente aquí -->
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group row mt-5 section" data-scrolled="5">
                            <div class="offset-xl-4 offset-lg-4 col-xl-8 col-lg-8 col-form-label d-flex justify-content-between">
                                <h5 class="my-auto">Especialización:</h5>
                                <button type="button" class="btn btn-primary btn-specialization float-end form-input-validate">Agregar</button>
                            </div>
                        </div>
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
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Las filas se agregarán dinámicamente aquí -->
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group row mt-5 section" data-scrolled="6">
                            <div class="offset-xl-4 offset-lg-4 col-xl-8 col-lg-8 col-form-label d-flex justify-content-between">
                                <h5 class="my-auto">Archivos adjuntos:</h5>
                                <!-- <button type="button" class="btn btn-primary btn-attached-file float-end form-input-validate">Agregar</button> -->
                                <button type="button" class="btn btn-primary btn-attached-file float-end form-input-validate">Agregar</button>
                            </div>
                        </div>
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
                                    <!-- Las filas se agregarán dinámicamente aquí -->
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="card-toolbar d-flex justify-content-between">
                <a href="/web/convocatorias" type="button" class="btn btn-secondary me-3">Regresar</a>
                <button type="submit" class="btn btn-primary px-4 py-2 form-input-validate" form="formPostulant">PROCESAR INFORMACIÓN</button>
            </div>
        </div>
        <div class="modal fade" id="modalWorkExperience" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form class="form-work-experience needs-validation" novalidate>
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
                <form class="form-specialization needs-validation" novalidate>
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
                <form class="form-academic-training needs-validation" novalidate>
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
        <div class="modal fade" id="modalPreviewPostulant" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Resumen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4" id="previewPostulant">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCELAR</button>
                        <button type="button" class="btn btn-primary btn-save">REGISTRAR MI POSTULACIÓN</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>