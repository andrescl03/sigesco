<!doctype html>
<html lang="es">
<head>
    <title>POSTULACIÓN - SIGESCO</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="<?php echo base_url() ?>/assets/image/favicon/favicon.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/public/css/bootstrapv5.0.2/bootstrap.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/css/bundle.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/css/web/main.css">
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
    <?php echo $this->layout->js ?>
    <script>
        // $(document).ready(AppConvenio.insert());
    </script>
    <script>
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