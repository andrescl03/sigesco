<?php
    $convocatoria = $data['convocatoria'];
    $postulante = $data['postulante'];
?>

<h4 class="mt-3"><b><i class="far fa-object-ungroup fa-sm"></i> Edición del postulante</b></h4>
<ol class="breadcrumb mb-2">
    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"> Inicio</a></li>
    <li class="breadcrumb-item active">Edición del postulante</li>
</ol>
<?php  $CargoOficina = $this->session->userdata('CargoOficina'); ?>
<div class="app-row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <div class="card border-secondary" >
                    <div class="card-body text-dark">
                        <div class="text-right mb-2">
                            <div class="">

                                <div class="container" id="AppConvocatoriaWeb" data-id="<?php echo $postulante->id ?>">
                                  
                                                <div class="row my-1">
                                                    <div class="col-md-12 text-center">
                                                        <h6 class="mb-2 text-secondary text-uppercase">
                                                            <?php echo $convocatoria->con_tipo == 1 ? 'Evaluación PUN (Prueba Única Nacional)' : 'Evaluación de expedientes' ?>
                                                        </h6>
                                                    </div>
                                                    <div class="col-md-12 text-center">
                                                        <h6 class="mb-1 text-secondary text-uppercase">
                                                            <?php echo $convocatoria->modalidad_nombre ?> <?php echo $convocatoria->nivel_nombre ?> <?php echo $convocatoria->especialidad_nombre == '-' ? '' : $convocatoria->especialidad_nombre ?>
                                                        </h6>
                                                    </div>
                                                    <div class="col-md-12 text-center">
                                                        <h6 class="my-2 text-dark text-uppercase">
                                                            <?php echo $postulante->tipo_documento == 1 ? 'DNI' : 'C.E' ?> <?php echo $postulante->numero_documento ?> <?php echo $convocatoria->especialidad_nombre == '-' ? '' : $convocatoria->especialidad_nombre ?>
                                                        </h6>
                                                    </div>
                                                </div>
                                          
                                   
                                    
                                            <form class="form-postulant needs-validation" id="formPostulant" novalidate>
                                                <div class="row justify-content-center py-2">
                                                

                                                    <div class="col-xl-12">
                                                        
                                                        <div class="mb-3 row">
                                                            <div class="offset-xl-4 offset-lg-4 col-xl-8 col-lg-8 col-form-label">
                                                                <h5>Datos personales del postulante:</h5>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label class="col-xl-4 col-lg-4 col-form-label">Nombres</label>
                                                            <div class="col-xl-8 col-lg-8">
                                                                <input type="text" name="nombre" class="form-control form-control-solid form-control-validate form-input-validate" minlength="3" maxlength="100" readonly>
                                                                <div class="invalid-feedback">Por favor este campo es requerido.</div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label class="col-xl-4 col-lg-4 col-form-label">Apellido Paterno</label>
                                                            <div class="col-xl-8 col-lg-8">
                                                                <input type="text" name="apellido_paterno" class="form-control form-control-solid form-control-validate form-input-validate" minlength="3" maxlength="100" readonly>
                                                                <div class="invalid-feedback">Por favor este campo es requerido.</div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label class="col-xl-4 col-lg-4 col-form-label">Apellido Materno</label>
                                                            <div class="col-xl-8 col-lg-8">
                                                                <input type="text" name="apellido_materno" class="form-control form-control-solid form-control-validate form-input-validate" minlength="3" maxlength="100" readonly>
                                                                <div class="invalid-feedback">Por favor este campo es requerido.</div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label class="col-xl-4 col-lg-4 col-form-label">Género</label>
                                                            <div class="col-xl-8 col-lg-8">
                                                                <select class="form-control form-control-solid form-input-validate" name="genero">
                                                                    <option value="" hidden>[SELECCIONE]</option>
                                                                    <option value="M">Masculino</option>
                                                                    <option value="F">Femenino</option>
                                                                </select>
                                                                <div class="invalid-feedback">Por favor este campo es requerido.</div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label class="col-xl-4 col-lg-4 col-form-label">Estado Civil</label>
                                                            <div class="col-xl-8 col-lg-8">
                                                                <select class="form-control form-control-solid form-input-validate" name="estado_civil">
                                                                    <option value="" hidden>[SELECCIONE]</option>
                                                                    <option value="soltero">Soltero(a)</option>
                                                                    <option value="casado">Casado(a)</option>
                                                                    <option value="divorciado">Divorciado(a)</option>
                                                                    <option value="viudo">Viudo(a)</option>
                                                                    <option value="casado">Casado(a)</option>
                                                                </select>
                                                                <div class="invalid-feedback">Por favor este campo es requerido.</div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label class="col-xl-4 col-lg-4 col-form-label">Nacionalidad</label>
                                                            <div class="col-xl-8 col-lg-8">
                                                                <select class="form-control form-control-solid form-input-validate" name="nacionalidad">
                                                                    <option value="" hidden>[SELECCIONE]</option>
                                                                    <option value="Peruana">Peruana</option>
                                                                    <option value="Extranjera">Extranjera</option>
                                                                </select>
                                                                <div class="invalid-feedback">Por favor este campo es requerido.</div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label class="col-xl-4 col-lg-4 col-form-label">Fecha de Nacimiento</label>
                                                            <div class="col-xl-8 col-lg-8">
                                                                <input type="date" name="fecha_nacimiento" class="form-control form-control-solid form-control-validate form-input-age form-input-validate" max="2020-10-10">
                                                                <div class="invalid-feedback">Por favor este campo es requerido.</div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label class="col-xl-4 col-lg-4 col-form-label">Correo Electrónico</label>
                                                            <div class="col-xl-8 col-lg-8">
                                                                <input type="email" name="correo" class="form-control form-control-solid form-input-validate form-input-email" maxlength="100">
                                                                <div class="invalid-feedback">Por favor este campo es requerido.</div>
                                                                <small>Se enviarán todas las notificaciones del proceso de contratación docente.</small>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label class="col-xl-4 col-lg-4 col-form-label">Confirmar Correo Electrónico</label>
                                                            <div class="col-xl-8 col-lg-8">
                                                                <input type="email" name="confirma_correo" class="form-control form-control-solid form-input-validate form-input-confirm-email" maxlength="100" pattern="">
                                                                <div class="invalid-feedback">
                                                                    Por favor confirme el correo electrónico ingresado válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label class="col-xl-4 col-lg-4 col-form-label">Número de Celular</label>
                                                            <div class="col-xl-8 col-lg-8">
                                                                <input type="text" name="numero_celular" class="form-control form-control-solid form-control-validate input-number form-input-validate" maxlength="9">
                                                                <div class="invalid-feedback">Por favor este campo es requerido.</div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label class="col-xl-4 col-lg-4 col-form-label">Número de Teléfono</label>
                                                            <div class="col-xl-8 col-lg-8">
                                                                <input type="text" name="numero_telefono" class="form-control form-control-solid form-control-validate  input-number form-input-validate" maxlength="7">
                                                                <div class="invalid-feedback">Por favor este campo es requerido.</div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label class="col-xl-4 col-lg-4 col-form-label">Afiliación</label>
                                                            <div class="col-xl-8 col-lg-8">
                                                                <select class="form-control form-control-solid form-input-validate" name="afiliacion">
                                                                    <option value="" hidden>[SELECCIONE]</option>
                                                                    <option value="AFP">AFP</option>
                                                                    <option value="ONP">ONP</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label class="col-xl-4 col-lg-4 col-form-label">CUSS</label>
                                                            <div class="col-xl-8 col-lg-8">
                                                                <input type="text" name="cuss" class="form-control form-control-solid form-control-validate  input-number form-input-validate" maxlength="50">
                                                                <div class="invalid-feedback">Por favor este campo es requerido.</div>
                                                            </div>
                                                        </div>
                                               

                                                        <div class="mb-3 row">
                                                            <div class="offset-xl-4 offset-lg-4 col-xl-8 col-lg-8 col-form-label">
                                                                <h5>Datos de Ubicación:</h5>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label class="col-xl-4 col-lg-4 col-form-label">Departamento</label>
                                                            <div class="col-xl-8 col-lg-8">
                                                                <select class="form-control form-control-solid select-department form-input-validate" name="departamento_id">
                                                                    <option value="" hidden>[SELECCIONE]</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label class="col-xl-4 col-lg-4 col-form-label">Provincia</label>
                                                            <div class="col-xl-8 col-lg-8">
                                                                <select class="form-control form-control-solid select-province form-input-validate" name="provincia_id">
                                                                    <option value="" hidden>[SELECCIONE]</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label class="col-xl-4 col-lg-4 col-form-label">Distrito</label>
                                                            <div class="col-xl-8 col-lg-8">
                                                                <select class="form-control form-control-solid select-district form-input-validate" name="distrito_id">
                                                                    <option value="" hidden>[SELECCIONE]</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label class="col-xl-4 col-lg-4 col-form-label">Vía</label>
                                                            <div class="col-xl-8 col-lg-8">
                                                                <select class="form-control form-control-solid select-via form-input-validate" name="via_id">
                                                                    <option value="" hidden>[SELECCIONE]</option>
                                                                </select>
                                                                <div class="invalid-feedback">Por favor este campo es requerido.</div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label class="col-xl-4 col-lg-4 col-form-label">Nombre de la Vía</label>
                                                            <div class="col-xl-8 col-lg-8">
                                                                <input type="text" name="nombre_via" class="form-control form-control-solid form-control-validate  form-input-validate" minlength="3" maxlength="100">
                                                                <div class="invalid-feedback">Por favor este campo es requerido.</div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label class="col-xl-4 col-lg-4 col-form-label">Zona</label>
                                                            <div class="col-xl-8 col-lg-8">
                                                                <select class="form-control form-control-solid select-zona form-input-validate" name="zona_id">
                                                                    <option value="" hidden>[SELECCIONE]</option>
                                                                </select>
                                                                <div class="invalid-feedback">Por favor este campo es requerido.</div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label class="col-xl-4 col-lg-4 col-form-label">Nombre de la Zona</label>
                                                            <div class="col-xl-8 col-lg-8">
                                                                <input type="text" name="nombre_zona" class="form-control form-control-solid form-control-validate  form-input-validate" minlength="3" maxlength="100">
                                                                <div class="invalid-feedback">Por favor este campo es requerido.</div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label class="col-xl-4 col-lg-4 col-form-label">Dirección</label>
                                                            <div class="col-xl-8 col-lg-8">
                                                                <input type="text" name="direccion" class="form-control form-control-solid form-control-validate  form-input-validate" minlength="3" maxlength="100">
                                                                <div class="invalid-feedback">Por favor este campo es requerido.</div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-xl-12">

                                                        <div class="mb-3 row">
                                                            <div class="col-xl-12 col-form-label d-flex justify-content-between">
                                                                <h5 class="my-auto">Formación académica:</h5>
                                                                <button type="button" class="btn btn-primary btn-academic-training float-end form-input-validate">Agregar</button>
                                                            </div>
                                                        </div>
                                                        <div class="table-responsive mb-5">
                                                            <table class="table table-academic-training mb-0">
                                                                <thead class="text-center">
                                                                    <tr>
                                                                        <th>Nivel Educativo</th>
                                                                        <th>Grado Académico</th>
                                                                        <th>Universidad</th>
                                                                        <th>Carrera Profesional</th>
                                                                        <th>N° de Registro de Título</th>
                                                                        <th>RD de Título N°</th>
                                                                        <th>Fecha de obtención del grado</th>
                                                                        <th>Acciones</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <!-- Las filas se agregarán dinámicamente aquí -->
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                        <div class="mb-3 row">
                                                            <div class="col-xl-12 col-form-label d-flex justify-content-between">
                                                                <h5 class="my-auto">Formación Continua:</h5>
                                                                <button type="button" class="btn btn-primary btn-specialization float-end form-input-validate">Agregar</button>
                                                            </div>
                                                        </div>
                                                        <div class="table-responsive mb-5">
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

                                                        <div class="mb-3 row">
                                                            <div class="col-xl-12 col-form-label d-flex justify-content-between">
                                                                <h5 class="my-auto">Experiencia laboral:</h5>
                                                                <button type="button" class="btn btn-primary btn-work-experience float-end form-input-validate">Agregar</button>
                                                            </div>
                                                        </div>
                                                        <div class="table-responsive mb-5">
                                                            <table class="table table-work-experience mb-0">
                                                                <thead class="text-center">
                                                                    <tr>
                                                                        <th>Institución educativa</th>
                                                                        <th>Sector</th>
                                                                        <th>Puesto</th>
                                                                        <th>N° RD</th>
                                                                        <th>N° Contrato</th>
                                                                        <th>Fecha inicio</th>
                                                                        <th>Fecha fin</th>
                                                                        <th>Cantidad de meses</th>
                                                                        <th>Acciones</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <!-- Las filas se agregarán dinámicamente aquí -->
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                        <div class="mb-3 row">
                                                            <div class="col-xl-12 col-form-label d-flex justify-content-between">
                                                                <h5 class="my-auto">Archivos adjuntos:</h5>
                                                                <!-- <button type="button" class="btn btn-primary btn-attached-file float-end form-input-validate">Agregar</button> -->
                                                                <button type="button" class="btn btn-primary btn-attached-file float-end form-input-validate">Agregar</button>
                                                            </div>
                                                        </div>
                                                        <div class="table-responsive mb-5">
                                                            <table class="table table-attached-file">
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
                                                            <small><b>Recuerda: </b> Los tipos que tienen (*) son documentos obligatorios.</small>
                                                        </div>

                                                    </div>

                                              
                                                
                                                </div>
                                            </form>
                                     
                                            <div class="card-toolbar d-flex justify-content-between">
                                                <!--a href="<?php echo base_url(); ?>web/convocatorias" type="button" class="btn btn-secondary me-3">Regresar</a-->
                                                <button type="submit" class="btn btn-primary px-4 py-2 form-input-validate" form="formPostulant">ACTUALIZAR INFORMACIÓN</button>
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
                                                            <div class="mb-3 row">
                                                                <label class="col-xl-4 col-lg-4 col-form-label">Institución educativa</label>
                                                                <div class="col-xl-8 col-lg-8">
                                                                    <input type="text" name="institucion_educativa" class="form-control form-control-solid" minlength="3" maxlength="100" required>
                                                                    <div class="invalid-feedback">Por favor este campo es requerido.</div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label class="col-xl-4 col-lg-4 col-form-label">Sector</label>
                                                                <div class="col-xl-8 col-lg-8">
                                                                    <select class="form-control form-control-solid" name="sector" required>
                                                                        <option value="" hidden>[SELECCIONE]</option>
                                                                        <option value="Pública">Pública</option>
                                                                        <option value="Privada">Privada</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label class="col-xl-4 col-lg-4 col-form-label">Puesto</label>
                                                                <div class="col-xl-8 col-lg-8">
                                                                    <select class="form-control form-control-solid" name="puesto" required>
                                                                        <option value="" hidden>[SELECCIONE]</option>
                                                                        <option value="Docente">Docente</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label class="col-xl-4 col-lg-4 col-form-label">N° RD</label>
                                                                <div class="col-xl-8 col-lg-8">
                                                                    <input type="text" name="numero_rd" class="form-control form-control-solid" minlength="2" maxlength="100" required>
                                                                    <div class="invalid-feedback">Por favor este campo es requerido.</div>
                                                                </div>
                                                            </div>
                                                            <!-- NUEVO-->
                                                            <div class="mb-3 row">
                                                                <label class="col-xl-4 col-lg-4 col-form-label">Fecha de inicio</label>
                                                                <div class="col-xl-8 col-lg-8">
                                                                    <input type="date" id="fechainicio_rd" name="fechainicio_rd" class="form-control form-control-solid" required>
                                                                    <div class="invalid-feedback">Por favor este campo es requerido.</div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label class="col-xl-4 col-lg-4 col-form-label">Fecha de termino</label>
                                                                <div class="col-xl-8 col-lg-8">
                                                                    <input type="date" id="fechatermino_rd" name="fechatermino_rd" class="form-control form-control-solid" required>
                                                                    <div class="invalid-feedback">Por favor este campo es requerido.</div>
                                                                </div>
                                                            </div>
                                                            <!-- NUEVO: Input para mostrar la cantidad de meses -->
                                                            <div class="mb-3 row">
                                                                <label class="col-xl-4 col-lg-4 col-form-label">Cantidad de meses</label>
                                                                <div class="col-xl-8 col-lg-8">
                                                                    <input type="text" id="cantidad_mesesrd" name="cantidad_mesesrd" class="form-control form-control-solid" readonly>
                                                                    <small class="text-muted">Este campo es informátivo que muestra el cálculo de meses que hay entre la fecha de inicio y termino<small>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3 row">
                                                                <label class="col-xl-4 col-lg-4 col-form-label">N° Contrato</label>
                                                                <div class="col-xl-8 col-lg-8">
                                                                    <input type="text" id="numero_contrato" name="numero_contrato" class="form-control form-control-solid" minlength="1" maxlength="100" required>
                                                                    <div class="invalid-feedback">Por favor este campo es requerido.</div>
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
                                                            <h5 class="modal-title" id="exampleModalLabel">Formación Continua</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3 row">
                                                                <label class="col-xl-4 col-lg-4 col-form-label">Tipo de especialización</label>
                                                                <div class="col-xl-8 col-lg-8">
                                                                    <select id="tipoEspecializacion" class="form-control form-control-solid" name="tipo_especializacion" required>
                                                                        <option value="" hidden>[SELECCIONE]</option>
                                                                        <option value="Diplomado">Diplomado</option>
                                                                        <option value="Actualizacion">Actualizacion</option>
                                                                        <option value="Curso">Curso</option>
                                                                        <option value="Taller">Taller</option>
                                                                        <option value="Otros">Otros</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label class="col-xl-4 col-lg-4 col-form-label">Tema</label>
                                                                <div class="col-xl-8 col-lg-8">
                                                                    <input type="text" id="temaEspecializacion" name="tema_especializacion" class="form-control form-control-solid" minlength="3" maxlength="100" required>
                                                                    <div class="invalid-feedback">Por favor este campo es requerido.</div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label class="col-xl-4 col-lg-4 col-form-label">Nombre de la entidad</label>
                                                                <div class="col-xl-8 col-lg-8">

                                                                    <select id="nombre_entidad" class="form-control form-control-solid" name="nombre_entidad" required>
                                                                        <option value="" hidden>[SELECCIONE]</option>
                                                                        <!--  <option value="Pública">Pública</option>
                                                                        <option value="Privada">Privada</option> -->
                                                                        <option value="edutalento">Edutalento</option>
                                                                        <option value="perueduca">Perú Educa</option>
                                                                        <option value="otros">otros</option>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label class="col-xl-4 col-lg-4 col-form-label">Fecha de inicio</label>
                                                                <div class="col-xl-8 col-lg-8">
                                                                    <input type="date" id="fechaInicio" name="fecha_inicio" class="form-control form-control-solid" required>
                                                                    <div class="invalid-feedback">Por favor este campo es requerido.</div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label class="col-xl-4 col-lg-4 col-form-label">Fecha de termino</label>
                                                                <div class="col-xl-8 col-lg-8">
                                                                    <input type="date" id="fechaTermino" name="fecha_termino" class="form-control form-control-solid" required>
                                                                    <div class="invalid-feedback">Por favor este campo es requerido.</div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label class="col-xl-4 col-lg-4 col-form-label">Número de horas</label>
                                                                <div class="col-xl-8 col-lg-8">
                                                                    <input type="number" id="numeroHoras" name="numero_horas" class="form-control form-control-solid" min="16" max="300" required>
                                                                    <div class="invalid-feedback">Por favor este campo es requerido. (mínimo 16 horas)</div>
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
                                                            <div class="mb-3 row">
                                                                <label class="col-xl-4 col-lg-4 col-form-label">Estudios</label>
                                                                <div class="col-xl-8 col-lg-8">
                                                                    <select class="form-control form-control-solid" id="nivel_educativo" name="nivel_educativo" required>
                                                                        <option value="" hidden>[SELECCIONE]</option>
                                                                        <option value="Superior no universitario">Superior no universitario</option>
                                                                        <option value="Superior universitario">Superior universitario</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="mb-3 row">
                                                                <label class="col-xl-4 col-lg-4 col-form-label">Tipo de estudio</label>
                                                                <div class="col-xl-8 col-lg-8">
                                                                    <select class="form-control form-control-solid" name="tipoestudio_educativo" required>
                                                                        <option value="" hidden>[SELECCIONE]</option>
                                                                        <option value="pedagogico">Pedagógico</option>
                                                                        <option value="no pedagogico">No pedagógico</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label class="col-xl-4 col-lg-4 col-form-label">Estado de estudio</label>
                                                                <div class="col-xl-8 col-lg-8">
                                                                    <select class="form-control form-control-solid estadoestudio_educativo" name="estadoestudio_educativo" required>
                                                                        <option value="" hidden>[SELECCIONE]</option>
                                                                        <option value="concluidos">Concluidos</option>
                                                                        <option value="no concluidos">No concluidos</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label class="col-xl-4 col-lg-4 col-form-label">Nivel de estudio</label>
                                                                <div class="col-xl-8 col-lg-8">
                                                                    <select class="form-control form-control-solid grado_academico" name="grado_academico" required>
                                                                        <option value="" hidden>[SELECCIONE]</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3 row">
                                                                <label class="col-xl-4 col-lg-4 col-form-label">Nivel</label>
                                                                <div class="col-xl-8 col-lg-8">
                                                                    <select class="form-control form-control-solid subnivel" name="subnivel" required>
                                                                        <option value="" hidden>[SELECCIONE]</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3 row">
                                                                <label class="col-xl-4 col-lg-4 col-form-label">Mención</label>
                                                                <div class="col-xl-8 col-lg-8">
                                                                    <select class="form-control form-control-solid mencion_academico" name="mencion_academico" required>
                                                                        <option value="" hidden>[SELECCIONE]</option>
                                                                    </select>
                                                                </div>
                                                            </div>


                                                            <div class="mb-3 row">
                                                                <label class="col-xl-4 col-lg-4 col-form-label">Mención de grado</label>
                                                                <div class="col-xl-8 col-lg-8">
                                                                    <input type="text" id="mencion_grado_academico" readonly name="mencion_grado_academico" class="form-control form-control-solid" minlength="3" maxlength="200">
                                                                </div>
                                                            </div>


                                                            <div class="mb-3 row">
                                                                <label class="col-xl-4 col-lg-4 col-form-label">Universidad/Instituto</label>
                                                                <div class="col-xl-8 col-lg-8">
                                                                <!---<select class="form-control form-control-solid" name="universidad" required>
                                                                        <option value="" hidden>[SELECCIONE]</option>
                                                                        <option value="UPN">Universidad privada del Norte</option>
                                                                        <option value="Universidad privada del Norte">Universidad de Lima</option>
                                                                    </select>-->
                                                                    <input type="text" id="universidad"  name="universidad" class="form-control form-control-solid" minlength="3" maxlength="200" required>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3 row">
                                                                <label class="col-xl-4 col-lg-4 col-form-label">Carrera profesional</label>
                                                                <div class="col-xl-8 col-lg-8">
                                                                <!---  <select class="form-control form-control-solid" name="carrera_profesional" required>
                                                                        <option value="" hidden>[SELECCIONE]</option>
                                                                        <option value="Ingenieria de sistemas">Ingenieria de sistemas</option>
                                                                        <option value="Ingenieria ambiental">Ingenieria ambiental</option>
                                                                    </select>-->
                                                                    <input type="text" id="carrera_profesional"  name="carrera_profesional" class="form-control form-control-solid" minlength="3" maxlength="150" required>

                                                                </div>
                                                            </div>

                                                            <div class="mb-3 row">
                                                                <label class="col-xl-4 col-lg-4 col-form-label">N° de registro de título</label>
                                                                <div class="col-xl-8 col-lg-8">
                                                                    <input type="text" name="registro_titulo" class="form-control form-control-solid" minlength="3" maxlength="100" required>
                                                                    <div class="invalid-feedback">Por favor este campo es requerido.</div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3 row">
                                                                <label class="col-xl-4 col-lg-4 col-form-label">RD de título N°</label>
                                                                <div class="col-xl-8 col-lg-8">
                                                                    <input type="text" name="rd_titulo" class="form-control form-control-solid" minlength="3" maxlength="100" required>
                                                                    <div class="invalid-feedback">Por favor este campo es requerido.</div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3 row">
                                                                <label class="col-xl-4 col-lg-4 col-form-label">Fecha de obtención del grado</label>
                                                                <div class="col-xl-8 col-lg-8">
                                                                    <input type="date" name="obtencion_grado" class="form-control form-control-solid"  required>
                                                                    <div class="invalid-feedback">Por favor este campo es requerido.</div>
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
                                                    <div class="modal-header bg-danger text-white">
                                                        <h5 class="modal-title" id="exampleModalLabel">RESUMEN</h5>
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
                                        <div class="modal fade" id="modalViewerAttachedFile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Archivo Adjunto</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body p-0">
                                                        <!-- <iframe id="iframeAttachedFile" src="" title="description" height="600" width="100%" type="application/pdf"></iframe>             -->
                                                        <canvas id="the-canvas" style="border: 1px solid black; direction: ltr;max-width: 100%;" width="100%"></canvas>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CERRAR</button>
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
        </div>
    </div>
</div>

<script>
    document.getElementById('nivel_educativo').addEventListener('change', function() {
        var nivelEducativo = this.value;
        var gradoAcademicoSelect = document.getElementsByName('grado_academico')[0];
        var subnivelSelect = document.getElementsByName('subnivel')[0];
        var mencionAcademicoSelect = document.getElementsByName('mencion_academico')[0];
        var mencionGradoInput = document.getElementById('mencion_grado_academico');
         mencionGradoInput.value ="";
        // Función para agregar opciones a un elemento select
        function agregarOpciones(selectElement, opciones) {
            selectElement.innerHTML = '<option value="" hidden>[SELECCIONE]</option>';
            opciones.forEach(function(opcion) {
                selectElement.innerHTML += '<option value="' + opcion + '">' + opcion + '</option>';
            });
        }

        // Definir opciones según el nivel educativo
        var opcionesGradoAcademico = [];
        var opcionesSubnivel = [];
        var opcionesMencionAcademico = [];

        if (nivelEducativo === 'Superior no universitario') {
            opcionesGradoAcademico = ['Títulado', 'Egresado', 'VI Ciclo'];
            opcionesSubnivel = ['Profesor de educación', 'Profesor de educación inicial', 'Profesor de educación primaria', 'Profesor de educación secundaria', 'Profesor de educación e informática', 'Profesor de educación física'];
            opcionesMencionAcademico = ['no disponible para el grado'];
        } else if (nivelEducativo === 'Superior universitario') {
            opcionesGradoAcademico = ['Egresado', 'Bachiller', 'Titulado', 'Maestría', 'Doctorado','2da especialidad'];
            opcionesSubnivel = ['De educación', 'De educación inicial', 'De educación primaria', 'De educación secundaria', 'De educación física'];
            opcionesMencionAcademico = ['Egresado', 'Licenciado', 'Bachiller', 'Maestro', 'Doctor'];
        }

        agregarOpciones(gradoAcademicoSelect, opcionesGradoAcademico);
        agregarOpciones(subnivelSelect, opcionesSubnivel);
        agregarOpciones(mencionAcademicoSelect, opcionesMencionAcademico);

        function actualizarMencionGrado() {
            if (document.getElementById('nivel_educativo').value == "Superior universitario") {
                mencionGradoInput.value = mencionAcademicoSelect.value + ' ' + subnivelSelect.value;
            }
        }
        subnivelSelect.addEventListener('change', actualizarMencionGrado);
        mencionAcademicoSelect.addEventListener('change', actualizarMencionGrado);

        actualizarMencionGrado();

    });


    function calcularCantidadMeses() {
        // Obtener las fechas ingresadas por el usuario
        var fechaInicioInput = document.getElementById('fechainicio_rd');
        var fechaTerminoInput = document.getElementById('fechatermino_rd');

        var fechaInicio = moment(fechaInicioInput.value);
        var fechaTermino = moment(fechaTerminoInput.value);

        // Almacenar las fechas originales
        var fechaInicioOriginal = moment(fechaInicio);
        var fechaTerminoOriginal = moment(fechaTermino);


        if (fechaInicio.isAfter(fechaTermino)) {

            fechaInicioInput.value = fechaInicioOriginal.format('DD/MM/YYYY');
            fechaTerminoInput.value = fechaTerminoOriginal.format('DD/MM/YYYY');
            sweet2.show({
                type: 'error',
                text: 'La fecha ingresada es incorrecta'
            });

            return;
        }

        var cantidadMeses = fechaTermino.diff(fechaInicio, 'months');

        if (cantidadMeses >= 0) {
            document.getElementById('cantidad_mesesrd').value = cantidadMeses;
        }
    }
    document.getElementById('fechainicio_rd').addEventListener('change', calcularCantidadMeses);
    document.getElementById('fechatermino_rd').addEventListener('change', calcularCantidadMeses);
</script>