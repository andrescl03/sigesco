<?php $convocatoria = $data['convocatoria'];  ?>
<div class="container" id="AppConvocatoriaWeb">
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title mx-auto">
                <h3 class="card-label">CONVOCATORIA REGISTRO DE DOCENTE 2023</h3>
            </div>
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-xl-3">
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
                <div class="col-xl-8">
                    <form class="form-postulant" id="formPostulant">
                        <div class="form-group row section" data-scrolled="0">
                            <label class="col-xl-4 col-lg-4 col-form-label">Tipo de Documento</label>
                            <div class="col-xl-8 col-lg-8">
                                <div class="form-group form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="tipo_documento" id="radio4" value="1" checked>
                                    <label class="form-check-label" for="radio4">DNI</label>
                                </div>
                                <div class="form-group form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="tipo_documento" id="radio444" value="3">
                                    <label class="form-check-label" for="radio444">Carnet de Extranjería</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-4 col-lg-4 col-form-label">Número de Documento</label>
                            <div class="col-xl-8 col-lg-8">
                                <div class="input-group mb-3">
                                    <input type="text" id="inputDocumento" name="documento" class="form-control form-control-solid" placeholder="Ingrese su número de documento" aria-describedby="button-addon2" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary btn-documento" type="button">Validar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-4 col-lg-4 col-form-label">Modalidad</label>
                            <div class="col-xl-8 col-lg-8">
                                <select class="form-control form-control-solid" name="modalidad" required>
                                    <option value="" hidden>[SELECCIONE]</option>
                                    <option value="EBR">Educación Básica Regular</option>
                                    <option value="EBA">Educación Básica Alternativa</option>
                                    <option value="EBE">Educación Básica Especial</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-4 col-lg-4 col-form-label">Nivel</label>
                            <div class="col-xl-8 col-lg-8">
                                <select class="form-control form-control-solid" name="nivel" required>
                                    <option value="" hidden>[SELECCIONE]</option>
                                    <option value="Inicial">Inicial</option>
                                    <option value="Primaria">Primaria</option>
                                    <option value="Secundaria">Secundaria</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-4 col-lg-4 col-form-label">Especialidad</label>
                            <div class="col-xl-8 col-lg-8">
                                <input type="text" id="applicant_name" name="especialidad" class="form-control form-control-solid" required>
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
                                <input type="text" id="first_name" name="nombre" class="form-control form-control-solid" required readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-4 col-lg-4 col-form-label">Apellido Paterno</label>
                            <div class="col-xl-8 col-lg-8">
                                <input type="text" id="last_name" name="apellido_paterno" class="form-control form-control-solid" required readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-4 col-lg-4 col-form-label">Apellido Materno</label>
                            <div class="col-xl-8 col-lg-8">
                                <input type="text" id="mothers_last_name" name="apellido_materno" class="form-control form-control-solid" required readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-4 col-lg-4 col-form-label">Género</label>
                            <div class="col-xl-8 col-lg-8">
                                <select class="form-control form-control-solid" name="genero" required>
                                    <option value="0">[SELECCIONE]</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-4 col-lg-4 col-form-label">Estado Civil</label>
                            <div class="col-xl-8 col-lg-8">
                                <select class="form-control form-control-solid" name="estado_civil" required>
                                    <option value="" hidden>[SELECCIONE]</option>
                                    <option value="Soltero">Soltero</option>
                                    <option value="Casado">Casado</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-4 col-lg-4 col-form-label">Nacionalidad</label>
                            <div class="col-xl-8 col-lg-8">
                                <select class="form-control form-control-solid" name="nacionalidad" required>
                                    <option value="" hidden>[SELECCIONE]</option>
                                    <option value="Peruana">Peruana</option>
                                    <option value="Extranjera">Extranjera</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-4 col-lg-4 col-form-label">Fecha de Nacimiento</label>
                            <div class="col-xl-8 col-lg-8">
                                <input type="date" name="fecha_nacimiento" class="form-control form-control-solid" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-4 col-lg-4 col-form-label">Correo Electrónico</label>
                            <div class="col-xl-8 col-lg-8">
                                <input type="email" name="correo" class="form-control form-control-solid" required>
                                <small>Se enviarán todas las notificaciones del proceso de contratación docente.</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-4 col-lg-4 col-form-label">Número de Celular</label>
                            <div class="col-xl-8 col-lg-8">
                                <input type="text" name="numero_celular" class="form-control form-control-solid" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-4 col-lg-4 col-form-label">Número de Teléfono</label>
                            <div class="col-xl-8 col-lg-8">
                                <input type="text" name="numero_telefono" class="form-control form-control-solid" required>
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
                                <select class="form-control form-control-solid select-department" name="departmento" required>
                                    <option value="" hidden>[SELECCIONE]</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-4 col-lg-4 col-form-label">Provincia</label>
                            <div class="col-xl-8 col-lg-8">
                                <select class="form-control form-control-solid select-province" name="provincia" required>
                                    <option value="" hidden>[SELECCIONE]</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-4 col-lg-4 col-form-label">Distrito</label>
                            <div class="col-xl-8 col-lg-8">
                                <select class="form-control form-control-solid select-district" name="distrito" required>
                                    <option value="" hidden>[SELECCIONE]</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-4 col-lg-4 col-form-label">Vía</label>
                            <div class="col-xl-8 col-lg-8">
                                <input type="text" name="via" class="form-control form-control-solid" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-4 col-lg-4 col-form-label">Nombre de la Vía</label>
                            <div class="col-xl-8 col-lg-8">
                                <input type="text" name="nombre_via" class="form-control form-control-solid" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-4 col-lg-4 col-form-label">Nombre de la Zona</label>
                            <div class="col-xl-8 col-lg-8">
                                <input type="text" name="zona" class="form-control form-control-solid" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-4 col-lg-4 col-form-label">Dirección</label>
                            <div class="col-xl-8 col-lg-8">
                                <input type="text" name="direccion" class="form-control form-control-solid" required>
                            </div>
                        </div>
                        <div class="form-group row mt-5 section" data-scrolled="3">
                            <div class="offset-xl-4 offset-lg-4 col-xl-8 col-lg-8 col-form-label d-flex justify-content-between">
                                <h5 class="my-auto">Formación académica:</h5>
                                <button type="button" class="btn btn-primary btn-academic-training float-end">Agregar</button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-academic-training">
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
                                <button type="button" class="btn btn-primary btn-work-experience float-end">Agregar</button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-work-experience">
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
                                <button type="button" class="btn btn-primary btn-specialization float-end">Agregar</button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-specialization">
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
                            <div class="offset-xl-4 offset-lg-4 col-xl-8 col-lg-8 col-form-label">
                                <h5>Archivos adjuntos:</h5>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-xl-12 col-lg-12" id="panel-file">
                                <div class="d-flex mb-4">
                                    <div class="custom-file">
                                        <input type="file" name="files[]" class="custom-file-input" id="customFile" multiple>
                                        <label class="custom-file-label" for="customFile">Seleccionar</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="card-toolbar text-end">
                <button type="submit" class="btn btn-primary px-4 py-2" form="formPostulant">REGISTRAR MI POSTULACIÓN</button>
            </div>
        </div>
        <div class="modal fade" id="modalWorkExperience" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form class="form-work-experience">
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
                                        <option value="0">[SELECCIONE]</option>
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
                <form class="form-specialization">
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
                                        <option value="0">[SELECCIONE]</option>
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
                <form class="form-academic-training">
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
                                        <option value="">[SELECCIONE]</option>
                                        <option value="Técnico superior">Técnico superior</option>
                                        <option value="Técnico superior">Universitario</option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-4 col-lg-4 col-form-label">Grado académico</label>
                                <div class="col-xl-8 col-lg-8">
                                    <select class="form-control form-control-solid" name="grado_academico" required>
                                        <option value="">[SELECCIONE]</option>
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
                                        <option value="">[SELECCIONE]</option>
                                        <option value="UPN">Universidad privada del Norte</option>
                                        <option value="Universidad privada del Norte">Universidad de Lima</option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-4 col-lg-4 col-form-label">Carrera profesional</label>
                                <div class="col-xl-8 col-lg-8">
                                    <select class="form-control form-control-solid" name="carrera_profesional" required>
                                        <option value="0">[SELECCIONE]</option>
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary btn-save">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>