<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <img class="rounded float-start" src="<?php echo base_url()?>public/images/ugel05_99x99.png">
                        <h3 class="text-center font-weight-light my-3"><b><i class="fas fa-mail-bulk"></i> SINOE - UGEL 05</b></h3>
                        <h5 class="text-center font-weight-light my-2"><b>Recuperar contraseña</b></h5>
                    </div>
                    <div class="card-body">
                        <div class="small mb-3 text-muted">Ingrese su dirección de correo electrónico y número de documento para enviarle una nueva contraseña.</div>
                        <form id="frm_recupacion">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="txt_correo"  name="txt_correo" type="email" placeholder="name@example.com" />
                                <label for="txt_correo">Correo electrónico</label>
                            </div>
                             <div class="form-floating mb-3">
                                <input class="form-control" id="txt_numDocumento" name="txt_numDocumento" type="text" placeholder="12345678" />
                                <label for="txt_numDocumento">N° de documento</label>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                <a class="small" href="<?php echo base_url(); ?>login/receptor">Regresar a iniciar sesión</a>
                               
                                <button type="button" class="btn btn-danger" id="btn_login"><i class="fas fa-lock-open"></i> Reiniciar Contraseña</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center py-3">
                       <div class="small"><a href="<?php echo base_url(); ?>registrar/formulario">Necesitas una cuenta? Regístrate!</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>