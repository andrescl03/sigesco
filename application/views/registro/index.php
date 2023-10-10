<!doctype html>
<html lang="es">

<head>
    <title>POSTULACIÓN - SIGESCO</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="<?php echo base_url() ?>/assets/image/favicon/favicon.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/css/bundle.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/css/web/main.css">
    <script>
        localStorage.setItem("CONVERSA_URL", "<?php echo base_url() ?>");
    </script>
    <style>
        .container-page::before {
            background: url("<?php echo base_url() ?>assets/image/cover.png");
        }
    </style>
    <link rel="stylesheet" type='text/css' href="<?php echo base_url() ?>/assets/css/web/convenio.css">
    <style>
        .note-editor.note-frame {
            border: 0px;
        }

        .note-editable,
        .note-statusbar {
            background-color: #f3f6f9 !important;
        }
    </style>
</head>

<body>

    <?php $this->load->view('registro/layouts/header'); ?>
    <section class="d-flex flex-column-fluid container-page py-4">
        <div class="content">
            <div class="container">
                <div class="card card-custom">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">Registro - Proceso de Contratación Docente
                            </h3>
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
                                <form id="frmSave" @submit="onSave">


                                    <div class="form-group row section" data-scrolled="0">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Tipo de Postulación</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <select class="form-control form-control-solid" name="postulation_type" id="postulation_type" required>
                                                <option value="0">[SELECCIONE]</option>
                                                <option value="PUN">PUN</option>
                                                <option value="EVALUACION-EXPEDIENTE">Evaluación de Expedientes</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row section" data-scrolled="0">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Convocatoria</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <select class="form-control form-control-solid" name="announcement" id="announcement" required>
                                                <option value="0">[SELECCIONE]</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Tipo de Documento</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <div class="form-group form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="document_type_representative" id="radio4" value="1" checked>
                                                <label class="form-check-label" for="radio4">DNI</label>
                                            </div>

                                            <div class="form-group form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="document_type_representative" id="radio444" value="3">
                                                <label class="form-check-label" for="radio444">Carnet de Extranjería</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Número de Documento</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <div class="input-group mb-3">
                                                <input type="text" id="dni_applicant" name="dni_applicant" class="form-control form-control-solid" placeholder="Ingrese su número de documento" aria-describedby="button-addon2" required>
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="button" id="button-addon2" @click="onSearchDNI">Validar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Modalidad</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <select class="form-control form-control-solid" name="modality" required>
                                                <option value="0">[SELECCIONE]</option>
                                                <option value="EBR">Educación Básica Regular</option>
                                                <option value="EBA">Educación Básica Alternativa</option>
                                                <option value="EBE">Educación Básica Especial</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Nivel</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <select class="form-control form-control-solid" name="level" required>
                                                <option value="0">[SELECCIONE]</option>
                                                <option value="Inicial">Inicial</option>
                                                <option value="Primaria">Primaria</option>
                                                <option value="Secundaria">Secundaria</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Especialidad</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <input type="text" id="applicant_name" name="applicant_name" class="form-control form-control-solid" required readonly>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row mt-5 section" data-scrolled="1">
                                        <div class="offset-xl-4 offset-lg-4 col-xl-8 col-lg-8 col-form-label">
                                            <h5>Datos personales del postulante:</h5>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Nombres</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <input type="text" id="first_name" name="first_name" class="form-control form-control-solid" required readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Apellido Paterno</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <input type="text" id="last_name" name="last_name" class="form-control form-control-solid" required readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Apellido Materno</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <input type="text" id="mothers_last_name" name="mothers_last_name" class="form-control form-control-solid" required readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Género</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <select class="form-control form-control-solid" name="gender" required>
                                                <option value="0">[SELECCIONE]</option>
                                                <option value="Masculino">Masculino</option>
                                                <option value="Femenino">Femenino</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Estado Civil</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <select class="form-control form-control-solid" name="marital_status" required>
                                                <option value="0">[SELECCIONE]</option>
                                                <option value="Soltero">Soltero</option>
                                                <option value="Casado">Casado</option>
                                                <!-- Agrega más opciones según sea necesario -->
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Nacionalidad</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <select class="form-control form-control-solid" name="nationality" required>
                                                <option value="0">[SELECCIONE]</option>
                                                <option value="Peruana">Peruana</option>
                                                <option value="Extranjera">Extranjera</option>
                                                <!-- Agrega más opciones según sea necesario -->
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Fecha de Nacimiento</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <input type="date" name="birth_date" class="form-control form-control-solid" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Correo Electrónico</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <input type="email" name="email_applicant" class="form-control form-control-solid" required>
                                            <small>Se enviarán todas las notificaciones del proceso de contratación docente.</small>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Número de Celular</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <input type="text" name="cell_phone" class="form-control form-control-solid" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Número de Teléfono</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <input type="text" name="phone_number" class="form-control form-control-solid" required>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="form-group row mt-5 section" data-scrolled="2">
                                        <div class="offset-xl-4 offset-lg-4 col-xl-8 col-lg-8 col-form-label">
                                            <h5>Datos de Ubicación:</h5>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Departamento</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <select class="form-control form-control-solid" id="department" name="department" required>
                                                <option value="0">[SELECCIONE]</option>
                                                <!-- Agrega más opciones según sea necesario -->
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Provincia</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <select class="form-control form-control-solid" id="province" name="province" required>
                                                <option value="0">[SELECCIONE]</option>
                                                <!-- Agrega más opciones según sea necesario -->
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Distrito</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <select class="form-control form-control-solid" id="district" name="district" required>
                                                <option value="0">[SELECCIONE]</option>
                                                <!-- Agrega más opciones según sea necesario -->
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Vía</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <input type="text" name="street_type" class="form-control form-control-solid" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Nombre de la Vía</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <input type="text" name="street_name" class="form-control form-control-solid" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Nombre de la Zona</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <input type="text" name="zone_name" class="form-control form-control-solid" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Dirección</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <input type="text" name="address" class="form-control form-control-solid" required>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row mt-5 section" data-scrolled="3">
                                        <div class="offset-xl-4 offset-lg-4 col-xl-8 col-lg-8 col-form-label">
                                            <h5>Formación académica:</h5>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Nivel educativo</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <select class="form-control form-control-solid" name="management_institution_public" required>
                                                <option value="">[SELECCIONE]</option>
                                                <option value="Técnico superior">Técnico superior</option>
                                                <option value="Técnico superior">Universitario</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Grado académico</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <select class="form-control form-control-solid" name="management_institution_public" required>
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
                                            <select class="form-control form-control-solid" name="management_institution_public" required>
                                                <option value="">[SELECCIONE]</option>
                                                <option value="UPN">Universidad privada del Norte</option>
                                                <option value="Universidad privada del Norte">Universidad de Lima</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Carrera profesional</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <select class="form-control form-control-solid" name="management_institution_public" required>
                                                <option value="0">[SELECCIONE]</option>
                                                <option value="Ingenieria de sistemas">Ingenieria de sistemas</option>
                                                <option value="Ingenieria ambiental">Ingenieria ambiental</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">N° de registro de título</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <input type="email" name="email_entity" class="form-control form-control-solid" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">RD de título N°</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <input type="email" name="email_entity" class="form-control form-control-solid" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-4 col-lg-4 col-form-label">Obtención del grado</label>
                                        <div class="col-xl-8 col-lg-8">
                                            <input type="email" name="email_entity" class="form-control form-control-solid" required>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <div class="col-xl-4 offset-xl-8 col-lg-4 offset-lg-8">
                                            <button type="button" class="btn btn-block btn-primary" id="agregarRegistroBtn">Agregar</button>
                                        </div>
                                    </div>


                                    <div class="table-responsive">
                                        <table class="table" id="tablaRegistros">
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

                                    <hr>
                                    <div class="form-group row mt-5 section" data-scrolled="4">
                                        <div class="offset-xl-4 offset-lg-4 col-xl-8 col-lg-8 col-form-label">
                                            <h5>Experiencia laboral:</h5>
                                        </div>
                                    </div>
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
                                                <option value="0">[SELECCIONE]</option>
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

                                    <div class="form-group row">
                                        <div class="col-xl-4 offset-xl-8 col-lg-4 offset-lg-8">
                                            <button type="button" class="btn btn-block btn-primary" id="agregarRegistroBtnExperienciaLaboral">Agregar</button>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table" id="tablaRegistrosExperienciaLaboral">
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

                                    <hr>
                                    <div class="form-group row mt-5 section" data-scrolled="5">
                                        <div class="offset-xl-4 offset-lg-4 col-xl-8 col-lg-8 col-form-label">
                                            <h5>Especialización:</h5>
                                        </div>
                                    </div>
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

                                    <div class="form-group row">
                                        <div class="col-xl-4 offset-xl-8 col-lg-4 offset-lg-8">
                                            <button type="button" class="btn btn-block btn-primary" id="agregarRegistroBtnEspecializacion">Agregar</button>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table" id="tablaRegistrosEspecializacion">
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
                                                    <input type="file" name="files[]" class="custom-file-input" id="customFile" multiple required>
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
                        <div class="card-toolbar text-right">
                            <button type="button" id="buttonguardar" class="btn btn-primary px-4 py-2">REGISTRAR MI POSTULACIÓN</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header  text-white" style="background-color:#de1f29 !important">
                    <h5 class="modal-title" id="exampleModalLongTitle">CONTRATO DOCENTE - 2023 | UGEL 05</h5>
                    <button type="button " class="close" data-dismiss="modal" aria-label="Close">
                        <span style="color:white" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Estimado usuario, bienvenido al registro de datos para el proceso de contratación docente de la UGEL N.° 05.</p>
                    <p>Recuerde verificar sus datos antes de finalizar su postulación</p>
                    <p>A continuación se adjunta el procedimiento a seguir para llevar a cabo con éxito su postulación</p>
                    <div id="carouselExample" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="https://i.ibb.co/6g0LzmC/Captura-de-pantalla-2023-10-04-101003.png" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="https://i.ibb.co/6g0LzmC/Captura-de-pantalla-2023-10-04-101003.png" class="d-block w-100" alt="...">
                            </div>
                            <!-- Agrega más elementos de carousel-item según sea necesario -->
                        </div>
                        <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR VENTANA DE AYUDA</button>
                </div>
            </div>
        </div>
    </div>

    <!-- <?php $this->load->view('registro/layouts/scrollTop'); ?>-->
    <?php $this->load->view('registro/layouts/footer'); ?>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?php echo base_url() ?>/assets/js/utilitarian/swal2.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/utilitarian/help.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/web/main.js"></script>
    <script src='<?php echo base_url() ?>/public/js/sha1/sha1.js'></script>
    <script src='<?php echo base_url() ?>/assets/js/web/convenios.js'></script>
    <script>
        $(document).ready(AppConvenio.insert());
    </script>
    <script>
        $(document).ready(function() {

            $("#miModal").modal('show');

            $('#postulation_type').on('change', function() {
                var selectedOption = $(this).val();
                if (selectedOption != 0) {
                    Swal.fire({
                        icon: 'success',
                        title: 'IMPORTANTE',
                        text: "Estimado postulante usted está seleccionado el tipo de postulación:" + selectedOption
                    });

                }
            });



            $.ajax({
                url: '<?php echo base_url("ubigeo/obtenerDepartamentos"); ?>', // Ruta del controlador que lista departamentos
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Llenar el select de departamentos con los datos recibidos
                    $.each(response.departamentos, function(index, departamento) {
                        $('#department').append('<option value="' + departamento.id + '">' + departamento.name + '</option>');
                    });
                }
            });


            $('#department').change(function() {
                var departmentId = $(this).val();

                // Llamada AJAX para obtener provincias basadas en el ID del departamento
                $.ajax({
                    url: '<?php echo base_url("ubigeo/obtenerProvincias"); ?>',
                    type: 'POST',
                    data: {
                        department_id: departmentId
                    },
                    dataType: 'json',
                    success: function(response) {
                        // Llenar el select de provincias con los datos recibidos
                        $('#province').empty();
                        $.each(response.provincias, function(index, provincia) {
                            $('#province').append('<option value="' + provincia.id + '">' + provincia.name + '</option>');
                        });
                    }
                });
            });


            // Evento cuando se selecciona una provincia
            $('#province').change(function() {
                var provinceId = $(this).val();

                // Llamada AJAX para obtener distritos basados en el ID de la provincia
                $.ajax({
                    url: '<?php echo base_url("ubigeo/obtenerDistritos"); ?>',
                    type: 'POST',
                    data: {
                        province_id: provinceId
                    },
                    dataType: 'json',
                    success: function(response) {
                        // Llenar el select de distritos con los datos recibidos
                        $('#district').empty();
                        $.each(response.distritos, function(index, distrito) {
                            $('#district').append('<option value="' + distrito.id + '">' + distrito.name + '</option>');
                        });
                    }
                });
            });
            $('#postulation_type').change(function() {
                $.ajax({
                    url: '<?php echo base_url("convocatorias/listarConvocatoriasAjax"); ?>',
                    type: 'POST',
                    data: {
                        "a": "a"
                    },
                    dataType: 'json',
                    success: function(response) {
                        // Llenar el select de distritos con los datos recibidos
                        let arrUnicos = [];

                        $.each(response.convocatorias, function(index, convocatoria) {

                            if (!arrUnicos.includes(convocatoria['con_id'])) {
                                arrUnicos.push(convocatoria['con_id']);


                                var convocatoriaNumero = convocatoria['con_numero'].toString().padStart(4, '0');

                                var convocatoriaAnio = convocatoria['con_anio'];

                                var optionValue = "CONV-" + convocatoriaNumero + "-" + convocatoriaAnio;

                                var optionText = '<option value="' + optionValue + '">' + optionValue + '</option>';

                                $('#announcement').append(optionText);
                            }

                        });
                    }
                });
            });

            // Manejar el clic en el botón "Agregar Registro"
            $("#agregarRegistroBtn").click(function() {
                // Obtener los valores del formulario
                var nivelEducativo = $("select[name='management_institution_public']:eq(0)").val();
                var gradoAcademico = $("select[name='management_institution_public']:eq(1)").val();
                var universidad = $("select[name='management_institution_public']:eq(2)").val();
                var carreraProfesional = $("select[name='management_institution_public']:eq(3)").val();
                var numRegistroTitulo = $("input[name='email_entity']:eq(0)").val();
                var rdNumTitulo = $("input[name='email_entity']:eq(1)").val();
                var obtencionGrado = $("input[name='email_entity']:eq(2)").val();

                // Crear una nueva fila en la tabla y agregar los datos
                var newRow = "<tr><td>" + nivelEducativo + "</td><td>" + gradoAcademico + "</td><td>" + universidad + "</td><td>" + carreraProfesional + "</td><td>" + numRegistroTitulo + "</td><td>" + rdNumTitulo + "</td><td>" + obtencionGrado + "</td><td><button class='btn btn-danger eliminarRegistroBtn'>Eliminar</button></td></tr>";

                // Agregar la nueva fila a la tabla
                $("#tablaRegistros").append(newRow);

                // Limpiar el formulario después de agregar el registro
                $("form")[0].reset();
            });

            // Manejar clics en los botones "Eliminar"
            $(document).on("click", ".eliminarRegistroBtn", function() {
                $(this).closest("tr").remove();
            });

            $(document).ready(function() {
                // Función para agregar una nueva fila a la tabla
                $("#agregarRegistroBtnExperienciaLaboral").click(function() {
                    var institucion = $("input[name='institucion_educativa']").val();
                    var sector = $("select[name='sector']").val();
                    var puesto = $("select[name='puesto']").val();
                    var numeroRD = $("input[name='numero_rd']").val();
                    var numeroContrato = $("input[name='numero_contrato']").val();

                    // Validar que los campos no estén vacíos
                    if (institucion && sector && puesto && numeroRD && numeroContrato) {
                        // Construir la fila de la tabla con los datos del formulario
                        var fila = "<tr><td>" + institucion + "</td><td>" + sector + "</td><td>" + puesto + "</td><td>" + numeroRD + "</td><td>" + numeroContrato + "</td><td><button class='btn btn-danger eliminarFila'>Eliminar</button></td></tr>";

                        // Agregar la fila a la tabla
                        $("#tablaRegistrosExperienciaLaboral tbody").append(fila);

                        // Limpiar los campos del formulario
                        $("input[name='institucion_educativa']").val("");
                        $("select[name='sector']").val("1");
                        $("select[name='puesto']").val("1");
                        $("input[name='numero_rd']").val("");
                        $("input[name='numero_contrato']").val("");
                    } else {
                        alert("Por favor, complete todos los campos antes de agregar el registro.");
                    }
                });
                // Función para eliminar una fila
                $(document).on("click", ".eliminarFila", function() {
                    $(this).closest("tr").remove();
                });
            });


            $(document).ready(function() {
                // Función para agregar una nueva fila a la tabla
                $("#agregarRegistroBtnEspecializacion").click(function() {
                    var tipoEspecializacion = $("#tipoEspecializacion").val();
                    var temaEspecializacion = $("#temaEspecializacion").val();
                    var nombreEntidad = $("#nombreEntidad").val();
                    var fechaInicio = $("#fechaInicio").val();
                    var fechaTermino = $("#fechaTermino").val();
                    var numeroHoras = $("#numeroHoras").val();

                    // Validar que los campos no estén vacíos

                    // Construir la fila de la tabla con los datos del formulario
                    var fila = "<tr><td>" + tipoEspecializacion + "</td><td>" + temaEspecializacion + "</td><td>" + nombreEntidad + "</td><td>" + fechaInicio + "</td><td>" + fechaTermino + "</td><td>" + numeroHoras + "</td><td><button class='btn btn-danger eliminarFila'>Eliminar</button></td></tr>";

                    // Agregar la fila a la tabla
                    $("#tablaRegistrosEspecializacion tbody").append(fila);

                    // Limpiar los campos del formulario
                    $("#tipoEspecializacion").val("0");
                    $("#temaEspecializacion").val("");
                    $("#nombreEntidad").val("");
                    $("#fechaInicio").val("");
                    $("#fechaTermino").val("");
                    $("#numeroHoras").val("");
                });

                // Función para eliminar una fila
                $(document).on("click", ".eliminarFila", function() {
                    $(this).closest("tr").remove();

                });
            });


        });

        $(document).ready(function() {
            $("#button-addon2").click(function() {

                let document = $('input[name="dni_applicant"]').val();


                if (document == '') {
                    Swal.fire(
                        'Error',
                        'Por favor ingrese el número de documento y tipo de postulación',
                        'error'
                    )
                } else {
                    $.ajax({
                        url: '<?php echo base_url("registro/obtenerDatosPostulante"); ?>',
                        type: 'POST',
                        data: {
                            document: document
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 200) {
                                if (response.datos && response.datos.length > 0) {

                                    let nombre = response.datos['cpe_nombres'];
                                    let apaterno = response.datos['cpe_apaterno'];
                                    let amaterno = response.datos['cpe_amaterno'];
                                    $('#first_name').val("Danilo Andrés");
                                    $('#last_name').val("Carrión");
                                    $('#mothers_last_name').val("Lava");

                                    Swal.fire(
                                        'Contrato docente',
                                        'Bienvenido al proceso de contratación docente - PUN',
                                        'success'
                                    );
                                } else {
                                    Swal.fire(
                                        'Error',
                                        'El postulante no está en el cuadro de mérito de la PUN',
                                        'error'
                                    );
                                }
                            } else {
                                Swal.fire(
                                    'Error',
                                    'Error en la solicitud',
                                    'error'
                                );
                            }
                        }
                    });

                    $("#").prop("readonly", false);

                    $("input[readonly]").prop("readonly", false);

                }

            });

            $('#buttonguardar').click(function() {
                Swal.fire(
                    'Contrato docente',
                    'Registro exitoso por favor, revise su bandeja de correo',
                    'success'
                )
            })

        });
    </script>
</body>

</html>