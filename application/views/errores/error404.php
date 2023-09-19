<?php $base_url = load_class('Config')->config['base_url']; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>404 Error - UGEL 05</title>
     
		<link href="<?php echo $base_url?>public/css/styles.css" rel="stylesheet" />
        <script src="<?php echo $base_url?>public/js/fontawesome/all.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div id="layoutError">
            <div id="layoutError_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="text-center mt-4">
                                    <img class="mb-4 img-error" src="<?php echo $base_url?>public/images/error-404-monochrome.svg" />
                                    <p class="lead">¡Lo siento! No puede encontrar la información buscada. Se recomienda revisar la consulta realizada y si el error persiste comunicarse con el administrador del sistema.</p>
                                    <a href="<?php echo  $base_url  ?>">
                                        <i class="fas fa-arrow-left me-1"></i>
                                        Volver al inicio
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutError_footer">
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
    </body>
</html>


