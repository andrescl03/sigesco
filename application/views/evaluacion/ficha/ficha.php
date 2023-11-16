<h4 class="mt-3"><b><i class="far fa-object-ungroup fa-sm"></i> Ficha de evaluación</b></h4>
<ol class="breadcrumb mb-2">
    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"> Inicio</a></li>
    <!-- <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>/porderivar/listar"> Expedientes Por Derivar</a></li>
        <li class="breadcrumb-item active">Registro de Expediente Externo</li> -->
</ol>

<div class="app-row">
    <div class="col-md-12">
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDatosPostulante" aria-expanded="false" aria-controls="collapseDatosPostulante">
                        
                        Datos personales del postulante
                    </button>
                </h2>
                <div id="collapseDatosPostulante" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="card card-body mb-5 ">
                            <div class="form-group row mb-1">
                                <label class="col-xl-4 col-lg-4">Nombres</label>
                                <div class="col-xl-8 col-lg-8">
                                    <input type="text" name="nombre" class="form-control form-control-solid form-control-validate form-input-validate" minlength="3" maxlength="50" required readonly>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label class="col-xl-4 col-lg-4">Apellido Paterno</label>
                                <div class="col-xl-8 col-lg-8">
                                    <input type="text" name="apellido_paterno" class="form-control form-control-solid form-control-validate form-input-validate" minlength="3" maxlength="50" required readonly>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label class="col-xl-4 col-lg-4">Apellido Materno</label>
                                <div class="col-xl-8 col-lg-8">
                                    <input type="text" name="apellido_materno" class="form-control form-control-solid form-control-validate form-input-validate" minlength="3" maxlength="50" required readonly>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label class="col-xl-4 col-lg-4">Género</label>
                                <div class="col-xl-8 col-lg-8">
                                    <input type="text" name="apellido_materno" class="form-control form-control-solid form-control-validate form-input-validate" minlength="3" maxlength="50" required readonly>

                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label class="col-xl-4 col-lg-4">Estado Civil</label>
                                <div class="col-xl-8 col-lg-8">
                                    <input type="text" name="estado_civil" class="form-control form-control-solid form-control-validate form-input-validate" minlength="3" maxlength="50" required readonly>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label class="col-xl-4 col-lg-4">Nacionalidad</label>
                                <div class="col-xl-8 col-lg-8">
                                    <input type="text" name="nacionalidad" class="form-control form-control-solid form-control-validate form-input-validate" minlength="3" maxlength="50" required readonly>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label class="col-xl-4 col-lg-4">Fecha de Nacimiento</label>
                                <div class="col-xl-8 col-lg-8">
                                    <input type="date" name="fecha_nacimiento" class="form-control form-control-solid form-control-validate form-input-age form-input-validate" max="2020-10-10" required readonly>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label class="col-xl-4 col-lg-4">Correo Electrónico</label>
                                <div class="col-xl-8 col-lg-8">
                                    <input type="email" name="correo" class="form-control form-control-solid form-input-validate form-input-email" maxlength="100" required readonly>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label class="col-xl-4 col-lg-4">Número de Celular</label>
                                <div class="col-xl-8 col-lg-8">
                                    <input type="text" name="numero_celular" class="form-control form-control-solid form-control-validate input-number form-input-validate" maxlength="9" required readonly>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label class="col-xl-4 col-lg-4">Número de Teléfono</label>
                                <div class="col-xl-8 col-lg-8">
                                    <input type="text" name="numero_telefono" class="form-control form-control-solid form-control-validate  input-number form-input-validate" maxlength="6" required readonly>
                                </div>
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
                        <div class="card card-body">
                            <div class="form-group row mb-1">
                                <label class="col-xl-4 col-lg-4 col-form-label">Departamento</label>
                                <div class="col-xl-8 col-lg-8">
                                    <input type="text" name="departmento_id" class="form-control form-control-solid select-department form-input-validate" readonly>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label class="col-xl-4 col-lg-4 col-form-label">Provincia</label>
                                <div class="col-xl-8 col-lg-8">
                                    <input type="text" name="provincia_id" class="form-control form-control-solid select-province form-input-validate" readonly>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label class="col-xl-4 col-lg-4 col-form-label">Distrito</label>
                                <div class="col-xl-8 col-lg-8">
                                    <input type="text" name="distrito_id" class="form-control form-control-solid select-district form-input-validate" readonly>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label class="col-xl-4 col-lg-4 col-form-label">Vía</label>
                                <div class="col-xl-8 col-lg-8">
                                    <input type="text" name="via" class="form-control form-control-solid form-input-validate" minlength="3" maxlength="50" readonly>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label class="col-xl-4 col-lg-4 col-form-label">Nombre de la Vía</label>
                                <div class="col-xl-8 col-lg-8">
                                    <input type="text" name="nombre_via" class="form-control form-control-solid form-control-validate  form-input-validate" minlength="3" maxlength="50" readonly>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label class="col-xl-4 col-lg-4 col-form-label">Nombre de la Zona</label>
                                <div class="col-xl-8 col-lg-8">
                                    <input type="text" name="zona" class="form-control form-control-solid form-control-validate  form-input-validate" minlength="3" maxlength="50" readonly>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label class="col-xl-4 col-lg-4 col-form-label">Dirección</label>
                                <div class="col-xl-8 col-lg-8">
                                    <input type="text" name="direccion" class="form-control form-control-solid form-control-validate  form-input-validate" minlength="3" maxlength="100" readonly>
                                </div>
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
                        <div class="card card-body">
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