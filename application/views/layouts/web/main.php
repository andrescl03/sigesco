<!doctype html>
<html lang="es">
<head>
    <title>POSTULACIÓN - SIGESCO</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="<?php echo base_url() ?>/assets/image/favicon/favicon.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/public/css/bootstrapv5.0.2/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/css/bundle.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/css/web/main.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <script>
        localStorage.setItem("BASE_URL", "<?php echo base_url() ?>");
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
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script> -->
    <script src="<?php echo base_url()?>public/js/jquery/jquery-3.6.0.min.js"></script>           
    <script src="<?php echo base_url()?>public/css/bootstrapv5.0.2/bootstrap.bundle.js" crossorigin="anonymous"></script>
    <script src="<?php echo base_url()?>public/css/bootstrapv5.0.2/popper.min.js" crossorigin="anonymous"></script>


    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <script src="<?php echo base_url() ?>/public/js/utilities/helper.js"></script>
    <script src="<?php echo base_url() ?>/public/js/utilities/sweetalert2.js"></script>
    <script src="<?php echo base_url() ?>/public/js/utilities/vue.js"></script>

    <script src="<?php echo base_url() ?>/assets/js/web/main.js"></script>
    <script src='<?php echo base_url() ?>/public/js/sha1/sha1.js'></script>

    
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <?php echo $this->layout->js ?>    

    <!-- <script src='<?php echo base_url() ?>/assets/js/web/convenios.js'></script> -->
    <script>
        // $(document).ready(AppConvenio.insert());
    </script>
    <script>
        $(document).ready(function() {
            // $("#miModal").modal('show');

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