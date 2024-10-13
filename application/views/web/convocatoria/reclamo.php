<?php
$convocatoria = $data['convocatoria'];
?>
<div class="container" id="AppConvocatoriaWeb" data-nombre-modalidad="<?php echo $convocatoria->modalidad_nombre ?>" data-nombre-nivel="<?php echo $convocatoria->nivel_nombre ?>" data-nombre-especialidad="<?php echo $convocatoria->especialidad_nombre ?>" data-id="<?php echo $convocatoria->con_id ?>" data-type="<?php echo $convocatoria->con_tipo ?>" data-inscripcion-id="<?php echo $convocatoria->inscripcion_id ?>">
    <div class="card card-custom">
        <div class="card-header">
            <div class="w-100">
                <div class="row my-3">
                    <div class="col-md-12 text-center">
                        <h4 class="mx-auto mb-1 text-uppercase">
                            CONTRATO AUXILIAR <?php echo $convocatoria->con_anio ?> - ETAPA DE RECLAMO
                        </h4>
                    </div>
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
                        <p class="m-0 text-secondary">
                            Inicio: <strong><?php echo $convocatoria->con_fechainicio_reclamo ?></strong>
                            Fin: <strong><?php echo $convocatoria->con_fechafin_reclamo ?></strong>
                            <br>
                            <strong class="ms-2"><?php echo $convocatoria->con_diasrestantes ?> <?php echo $convocatoria->con_diasrestantes > 1 ? 'días restantes' : 'día restante' ?></strong>
                        </p>
                    </div>
                </div>
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
                                <?php if ($convocatoria->con_tipo == 1) { ?>
                                            <div class=" mb-3">
                                                <input type="text" id="inputDocumento" name="numero_documento" class="form-control form-control-solid input-document form-input-document" placeholder="Ingrese su número de documento" required>
                                         
                                            </div>
                                <?php } else { ?>
                                            <div class=" mb-3">
                                                <input type="text" id="inputDocumento" name="numero_documento" class="form-control form-control-solid input-document" placeholder="Ingrese su número de documento" required>
                                            </div>
                                <?php } ?>
                                <div class="alert-postulant">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-4 col-lg-4 col-form-label">Correo Electrónico</label>
                            <div class="col-xl-8 col-lg-8">
                                <input type="email" id="correo" name="correo" class="form-control form-control-solid  form-input-email form-input-document" maxlength="100" required>
                                <div class="invalid-feedback">Por favor este campo es requerido.</div>
                                 <div class="alert alert-primary d-flex align-items-center mb-0" role="alert">
                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
                                    <div>El correo electrónico nos permite validar la identidad del postulante al presentar un reclamo</div>
                                </div>
                            </div>
                        </div>
 
                        <div class="form-group row">
                            <label class="col-xl-4 col-lg-4 col-form-label">Fecha de Nacimiento</label>
                            <div class="col-xl-8 col-lg-8">
                                <input type="date" id="fechanacimiento"  name="fecha_nacimiento" class="form-control form-control-solid form-control-validate form-input-age form-input-document " max="2020-10-10" required>
                                <div class="invalid-feedback">Por favor este campo es requerido.</div>
                            
                                <div class="alert alert-primary d-flex align-items-center mb-0" role="alert">
                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
                                    <div>La fecha de nacimiento nos permite validar la identidad del postulante al presentar un reclamo.</div>
                                </div>

                            </div>
                            
                        </div>
                        <div class="form-group row">
                                            <button class="btn btn-primary btn-documento" type="button">Validar Postulación</button>
                                            <button class="btn btn-danger btn-documento-cancel" type="button" style="display:none;">Cambiar</button>
                                        </div>
                        <div class="form-group row mt-5 section" data-scrolled="1">
                            <div class="offset-xl-4 offset-lg-4 col-xl-8 col-lg-8 col-form-label">
                                <h5>Información encontrada del postulante:</h5>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-4 col-lg-4 col-form-label">Nombres y Apellidos</label>
                            <div class="col-xl-8 col-lg-8">
                                <input type="text" name="nombre" class="form-control form-control-solid form-control-validate form-input-validate" minlength="3" maxlength="100"  readonly>
                            </div>
                        </div>
                         
                        <div class="form-group row">
                            <label class="col-xl-4 col-lg-4 col-form-label">Número de Celular</label>
                            <div class="col-xl-8 col-lg-8">
                                <input type="text" name="numero_celular" class="form-control form-control-solid form-control-validate input-number form-input-validate" maxlength="9" readonly>
                            </div>
                        </div>      
                        
                        
                        <div class="form-group row">
                            <label class="col-xl-4 col-lg-4 col-form-label">Fecha de postulación</label>
                            <div class="col-xl-8 col-lg-8">
                                <input type="text" name="fecha_postulacion" class="form-control form-control-solid form-control-validate input-number form-input-validate" maxlength="9" readonly>
                            </div>
                        </div>


                          <div class="form-group row mt-5 section" data-scrolled="6">
                            <div class="offset-xl-4 offset-lg-4 col-xl-8 col-lg-8 col-form-label d-flex justify-content-between">
                                <h5 class="my-auto">Archivos adjuntos:</h5>
                                <!-- <button type="button" class="btn btn-primary btn-attached-file float-end form-input-validate">Agregar</button> -->
                                <button type="button" class="btn btn-primary btn-attached-file float-end form-input-validate">Agregar</button>
                            </div>
                        </div>
                        <div class="table-responsive">
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
                            <small><b>Recuerda: </b> Solo se podrá ingresar un archivo (PDF) de reclamo por postulación. <br>  <b class="text-danger">IMPORTANTE:</b> el nombre del archivo no debe contener tildes ni espacios en blanco.</small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="card-toolbar d-flex justify-content-between">
                <a href="<?php echo base_url(); ?>web/convocatorias" type="button" class="btn btn-secondary me-3">Regresar</a>
                <button type="submit" class="btn btn-primary px-4 py-2 form-input-validate" form="formPostulant">PROCESAR INFORMACIÓN</button>
            </div>
        </div>
        <div class="modal fade" id="modalPreviewPostulant" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="exampleModalLabel">RESUMEN DE MI REGISTRO DE RECLAMO</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4" id="previewPostulant">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCELAR</button>
                        <button type="button" class="btn btn-primary btn-save">REGISTRAR MI RECLAMO</button>
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
    <div class="modal fade" id="showInformacionPostulacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Cómo llevar a cabo mi proceso de registro de reclamo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-center mx-auto" style="max-width: 80%;">Actualmente te encuentras en el PASO 1 del proceso de reclamo en SIGESCO. Este paso es crucial para iniciar correctamente tu proceso de reclamo.</p>
                <div class="text-center">
                    <img src="<?php echo base_url() ?>assets/image/escala-de-satisfaccion.png" alt="niveles de satisfacción" class="img-fluid" style="max-width: 110px;">
                </div>
                <div id="postulacionCarousel" class="carousel slide" data-bs-ride="carousel">
                    <!-- Indicators -->
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#postulacionCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Paso 1" style="background-color: red;"></button>
                    </div>
                    <!-- Slides -->
                    <div class="carousel-inner">
                        <!-- Paso 1 -->
                        <div class="carousel-item active">
                            <h6 class="fw-bold text-center">PASO ACTUAL: <br>Paso 1 - registro en SIGESCO</h6>
                            <div class="text-center">
                                <img src="<?php echo base_url() ?>assets/image/escala_paso_uno.png" alt="Paso 1" class="img-fluid" style="max-width: 60px;">
                            </div>
                            <p class="text-center mx-auto" style="max-width: 80%;">Accede al sistema SIGESCO y completa el formulario de reclamo. Asegúrate de adjuntar todos los documentos requeridos antes de enviar tu solicitud para avanzar al siguiente paso (paso 2).</p>
                            <div class="mt-3 text-center">
                                <span class="badge bg-primary">Paso 1 de 3</span>
                            </div>
                        </div>
                    </div>
                    <!-- Controles del Carousel (Ocultar si solo hay un paso) -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

</div>

<!-- Modal -->
<div class="modal fade" id="showInformacionPostulacion_paso_dos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">INSTRUCCIONES</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div id="div-step-2">
                        <p class="text-center mx-auto" style="max-width: 80%;">
                            <b>¡Estás en el PASO 2!</b> Para continuar con tu reclamo en SIGESCO, debes ahora completar el registro en el portal <b>MINEDU EN LÍNEA</b>.
                        </p>
                    <div class="text-center">
                        <img src="<?php echo base_url() ?>assets/image/escala-de-satisfaccion.png" alt="niveles de satisfacción" class="img-fluid" style="max-width: 110px;">
                    </div>
                    <div id="postulacionCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#postulacionCarousel" data-bs-slide-to="0" aria-label="Paso 1" style="background-color: red;"></button>
                            <button type="button" data-bs-target="#postulacionCarousel" data-bs-slide-to="1" class="active" aria-current="true" aria-label="Paso 2" style="background-color: yellow;"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <h6 class="fw-bold text-center">Paso Actual: <br> Registro en MINEDU EN LÍNEA</h6>
                                <div class="text-center">
                                    <img src="<?php echo base_url() ?>assets/image/escala_paso_dos.png" alt="Paso 2" class="img-fluid" style="max-width: 60px;">
                                </div>
                                <p class="text-center mx-auto" style="max-width: 80%;">
                                    Para completar el Paso 2, asegurate de:
                                    <ol>
                                        <li>Ingresa al portal MINEDU EN LÍNEA.</li>
                                        <li>Completa el formulario de registro.</li>
                                        <li>Cargar y enviar la <b>Ficha de reclamo</b>.</li>
                                        <li>Cargar y enviar el <b>Consolidado de Documentos</b>.</li>
                                        <li>Adjunta los documentos necesarios.</li>
                                    </ol>
                                    Una vez completado, estarás listo para avanzar al paso final (Paso 3).
                                </p>
                                <div class="mt-3 text-center">
                                    <span class="badge bg-primary">Paso 2 de 3</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a class="btn-print-reporte-ficha-postulacion btn btn-primary mx-2" target="_blank" >Descargar Ficha de reclamo</a>
                    <a id="documentos_unificados"  class="btn btn-secondary mx-2" target="_blank">Descargar Consolidado de Documentos</a>
                </div>
                <div class="text-center mt-4">
                     <a href="https://enlinea.minedu.gob.pe/login" target="_blank" class="btn btn-danger mx-2">IR A MINEDU EN LÍNEA</a>
                </div>
                <hr>
                   
                <div id="div-step-3">
                        <p class="text-center mx-auto" style="max-width: 80%;">
                            <b>PASO 3</b>
                        </p>
                    <div class="text-center">
                        <img src="<?php echo base_url() ?>assets/image/escala-de-satisfaccion.png" alt="niveles de satisfacción" class="img-fluid" style="max-width: 110px;">
                    </div>
                    <div id="postulacionCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#postulacionCarousel" data-bs-slide-to="0" aria-label="Paso 1" style="background-color: red;"></button>
                            <button type="button" data-bs-target="#postulacionCarousel" data-bs-slide-to="1"   aria-label="Paso 2" style="background-color: yellow;"></button>
                            <button type="button" data-bs-target="#postulacionCarousel" data-bs-slide-to="2" class="active" aria-current="true" aria-label="Paso 3" style="background-color: green;"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <h6 class="fw-bold text-center">Paso siguiente: <br> Registra el número de expediente de MINEDU EN LINEA en SIGESCO</h6>
                                <div class="text-center">
                                    <img src="<?php echo base_url() ?>assets/image/escala_paso_tres.png" alt="Paso 2" class="img-fluid" style="max-width: 60px;">
                                </div>
                                <p class="text-center mx-auto" style="max-width: 80%;">
                                    Para completar el Paso 3:
                                    <ol>
                                        <li>Completa el número de expediente que obtuviste de MINEDU EN LÍNEA y click en GUARDAR.</li>
                                    </ol>
                                </p>
                                <div class="mt-3 text-center">
                                    <span class="badge bg-primary">Paso 3 de 3</span>
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="container mt-5 text-center mx-auto">
                                <form id="form-number-expediente" novalidate>
                                    <div class="mb-3">
                                        <label for="numeroExpediente" class="form-label">Número de expediente de MINEDU EN LÍNEA:</label>
                                        <input type="text" maxlength="20" id="numeroExpediente" name="numeroExpediente" class="form-control" placeholder="Número de expediente" required>
                                        <input type="hidden" id="uidExpediente" name="uidExpediente">
                                    </div>
                                    <button type="button" class="btn btn-success btn-registrar-numero-expediente">Registrar expediente y terminar mi reclamo</button>
                                </form>
                     </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
        </div>
    </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', () => {
const myModal = new bootstrap.Modal(document.getElementById('showInformacionPostulacion'), {
        keyboard: false
    });
    myModal.show();
});
</script>