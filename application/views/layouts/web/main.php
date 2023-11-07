<!doctype html>
<html lang="es">
<head>
    <title>POSTULACIÓN - SIGESCO</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="<?php echo base_url() ?>/assets/image/favicon/favicon.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/public/css/bootstrapv5.0.2/bootstrap.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/css/bundle.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/css/web/main.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

    <script>
        window.AppMain = {
            url: "<?php echo base_url() ?>"
        };
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
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
        </symbol>
        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
        </symbol>
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </symbol>
    </svg>
    <?php $this->load->view('layouts/web/partials/header'); ?>
    <section class="d-flex flex-column-fluid container-page py-4">
        <div class="content">
            <?php echo $content_for_layout?>
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
    <?php $this->load->view('layouts/web/partials/footer'); ?>
    <script src="<?php echo base_url()?>public/js/jquery/jquery-3.6.0.min.js"></script>           
    <script src="<?php echo base_url()?>public/css/bootstrapv5.0.2/bootstrap.bundle.js" crossorigin="anonymous"></script>
    <script src="<?php echo base_url()?>public/css/bootstrapv5.0.2/popper.min.js" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script> -->
    <script src="<?php echo base_url() ?>/public/js/utilities/helper.js"></script>
    <script src="<?php echo base_url() ?>/public/js/utilities/sweetalert2.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/web/main.js"></script>
    <script src='<?php echo base_url() ?>/public/js/sha1/sha1.js'></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.4.456/build/pdf.min.js"></script>
    <?php echo $this->layout->js ?>
</body>

</html>