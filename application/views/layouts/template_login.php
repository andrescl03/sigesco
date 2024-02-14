
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="<?php echo $this->layout->getDescripcion()?>" />
        <meta name="keywords" content="<?php echo $this->layout->getKeywords()?>" />
        <meta name="author" content="Ing. Luis Alberto Arrascue Bazan | correo: abluis15@gmail.com | Cel: 959817779" />
        <title><?php echo $this->layout->getTitle()?></title>
        <link rel="icon" type="image/png" href="<?php echo base_url()?>public/images/favicon.ico" />

        <link rel="stylesheet" href="<?php echo base_url()?>public/css/animate.css.4.1.1/animate.min.css" />    

        <link href="<?php echo base_url()?>public/css/styles.css" rel="stylesheet" />
        <link href="<?php echo base_url()?>public/css/estilos.css" rel="stylesheet" />
        <link href="<?php echo base_url()?>public/css/estilos_2.css" rel="stylesheet" />

        <!--<link rel="stylesheet" href="<?php echo base_url()?>public/js/alertifyjs/css/alertify.min.css">
        <link rel="stylesheet" href="<?php echo base_url()?>public/js/alertifyjs/css/themes/bootstrap.min.css">  -->

        
    </head>
    <body class="bg-rojo">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
               <?php echo $content_for_layout?> 
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Equipo de desarrollo Ugel05 © Copyright <?= date("Y") ?> - Todos los Derechos Reservados</div>
                            <div>
                                <a href="#">Política de privacidad</a>
                                &middot;
                                <a href="#">Términos &amp; Condiciones</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="<?php echo base_url()?>public/js/jquery/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

        <script src="<?php echo base_url()?>public/js/fontawesome/all.js" crossorigin="anonymous"></script>

        <script src="<?php echo base_url()?>public/js/blockUI/jquery.blockUI.js"></script>

        <!--<script src="<?php echo base_url()?>public/js/alertifyjs/alertify.min.js"></script>-->
        <script src="<?php echo base_url()?>public/js/sweetalert/sweetalert2.all.min.js"></script>
        
        <script src="<?php echo base_url()?>public/js/script.js"></script>
        <script defer src="<?php echo base_url()?>public/js/jquery.validate/jquery.validate-1.19.3.min.js"></script>
        <script src='<?php echo base_url()?>public/js/sha1/sha1.js'></script> 
  
        <?php echo $this->layout->js?>

    </body> 
 
</html>
