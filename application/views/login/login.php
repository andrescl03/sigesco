<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <img class="rounded float-start" src="<?php echo base_url()?>public/images/ugel05_99x99.png">
                            </div>
                            <div class="col">
                                <h1 class="text-center font-weight-light mt-2"><b><?php echo $this->layout->getnombreSistema()?></b></h1>
                                <h5 class="text-center font-weight-light"><b>Iniciar Sesión</b></h5>
                                </div>
                            <div class="col" style="float:right !important;">
                            <img class="rounded float-end" src="<?php echo base_url()?>public/images/documento_3_99x99.png"  >
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="frm_login" class="g-3 needs-validation" novalidate>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputUsuario" name="inputUsuario" type="text" placeholder="Usuario" required/>
                                <label for="inputUsuario">Usuario</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputPassword" name="inputPassword"  type="password" placeholder="Contraseña" required />
                                <label for="inputPassword">Contraseña</label>
                            </div>
                             <!---<div class="form-check mb-3">
                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                <label class="form-check-label" for="inputRememberPassword">Recordar contraseña</label>
                            </div>-->
                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">                             
                            </div>
                            <!-----<div class="d-flex align-items-center justify-content-between mt-0 mb-0">
                                <a class="small" href="#">¿Has olvidado tu contraseña?</a>-->
                                <button type="button" class="btn btn-danger" id="btn_login"><b><i class="fas fa-sign-in-alt"></i> INGRESAR</b></button>
                            </div>
                        
                    </div>
                    <div class="card-footer text-center py-4">
                    <div class="small text-white"><?php echo $this->layout->getDescripcion()." - ".$this->layout->getnombreSistema()?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>