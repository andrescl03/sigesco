
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

        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/js/DataTables2/datatables.min.css"/>

        <link rel="stylesheet" href="<?php echo base_url()?>public/js/dropzone/dropzone.min.css">   
        
        <link rel="stylesheet" href="<?php echo base_url()?>public/js/select2-bootstrap5/select2.min.css" />
        <link rel="stylesheet" href="<?php echo base_url()?>public/js/select2-bootstrap5/select2-bootstrap-5-theme.css" />
        
        <link href="<?php echo base_url()?>public/js/datepicker/css/bootstrap-datepicker.css"  rel="stylesheet"> 
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

        <link rel="stylesheet" href="<?php echo base_url()?>public/css/animate.css.4.1.1/animate.min.css" />

        <link href="<?php echo base_url()?>public/css/styles.css" rel="stylesheet" />
        <link href="<?php echo base_url()?>public/css/estilos.css" rel="stylesheet" />

       <link rel="stylesheet" href="<?php echo base_url()?>public/js/alertifyjs/css/alertify.min.css">
        <link rel="stylesheet" href="<?php echo base_url()?>public/js/alertifyjs/css/themes/bootstrap.min.css">

        <link href="<?php echo base_url()?>public/css/estilos_2.css?t=1.5" rel="stylesheet" />
        <link href="<?php echo base_url()?>public/css/main.css?t=<?php echo time()?>" rel="stylesheet" />
        <script>
            window.AppMain = {
                url: "<?php echo base_url() ?>"
            };
        </script>
    </head>    
    <body class="sb-nav-fixed ">
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
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-rojo">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="<?php echo base_url()?>inicio/index"><h1><img class="rounded float-start border border-white border-2 py-1 px-1 rounded-3" src="<?php echo base_url()?>public/images/documento_3_46x46.png" width="20%" >&nbsp;<b><?php echo $this->layout->getnombreSistema()?></b></h1></a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                <!--<div class="rounded-pill text-dark  px-3 pb-1" style="background-color: #FFFFFF;"><b>Oficina: 
                    <a href="<?= base_url()?>usuarios/permisos" class="link-primary"> <?php 
                                if($this->session->userdata("sigex")){
                                    echo toMayus($this->session->userdata("Descripcion")); 
                                }
                            ?>
                    </a></b>
                    </div> 
                </div>-->
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?php echo base_url()?>configurar/usuarios"><i class="fas fa-user-cog"></i> Configuración</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url()?>inicio/perfil"><i class="fas fa-user"></i> Perfil</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="<?php echo base_url()?>login/logout"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-danger" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">MENÚ</div>
                            <a class="nav-link" href="<?php echo base_url()?>inicio/index">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-gear"></i></div>
                                Inicio
                            </a>                       
                            
                            <?php 
                                  $sesion_user = $this->session->userdata('sigesco_id');
                                  $sesion_estado = $this->session->userdata('sigesco_estado');

                                  $data_modulo = $this->login_model->modulos($sesion_user,$sesion_estado);
                                  $html = ""; //init        
                                  $rutas=[];
                                  if(!(empty($data_modulo))){
                                    $i=1; 
                                       
                                    foreach ($data_modulo as $row){
                                      if ($row->mdl_hijode == '0'){
                                        $icono = $row->mdl_icono;
                                        $mdl_nombre = strtoupper($row->mdl_nombre);
                                       $html .=   '<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts_'.$i.'" aria-expanded="false" aria-controls="collapseLayouts_'.$i.'" style="font-size: 14px;"><div class="sb-nav-link-icon"><i class="'.$icono.'"></i></div>'.$mdl_nombre.'<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>
                                       <div class="collapse" id="collapseLayouts_'.$i.'" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion"><nav class="sb-sidenav-menu-nested nav">';
                                          foreach ($data_modulo as $subcat){
                                            if ($subcat->mdl_hijode == $row->mdl_id){
                                              $ruta = base_url().$subcat->mdl_ruta;
                                              $icono      = $subcat->mdl_icono;
                                              $mdl_nombre = $subcat->mdl_nombre;
                                              $html .= '<a class="nav-link" href="'.$ruta.'"><i class="'.$icono.'"></i>&nbsp;'. $mdl_nombre.'</a>';
                                              array_push($rutas, $subcat->mdl_ruta);
                                            }
                                          }
                                            $html .= "</nav>";
                                            $html .= '</div>';
                                           
                                      }
                                    $i++;}
                                    echo $html;  
                                    $this->session->set_userdata("sigesco_rutas",$rutas);  
                                  }                            


                                ?>

                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Bienvenido:</div>
                            <?php 
                                if($this->session->userdata("sigesco")){
                                    echo ($this->session->userdata("sigesco_nombre"));                                    
                                }
                            ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                    	<?php echo $content_for_layout?>
                    </div>
                </main>
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
 		<script src="<?php echo base_url()?>public/js/jquery/jquery-3.6.0.min.js"></script>
           
        <script src="<?php echo base_url()?>public/css/bootstrapv5.0.2/bootstrap.bundle.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url()?>public/css/bootstrapv5.0.2/popper.min.js" crossorigin="anonymous"></script>
  
      
        <script src="<?php echo base_url()?>public/js/fontawesome/all.js" crossorigin="anonymous"></script>

        <script src="<?php echo base_url()?>public/js/select2-bootstrap5/select2.min.js"></script>

       

        <!--<script src="<?php echo base_url()?>public/js/DataTables/pdfmake.min.js"></script>
        <script src="<?php echo base_url()?>public/js/DataTables/vfs_fonts.js"></script>-->
        <script src="<?php echo base_url()?>public/js/DataTables2/datatables.min.js"></script>


        <script src="<?php echo base_url()?>public/js/blockUI/jquery.blockUI.js"></script>
        <script src="<?php echo base_url()?>public/js/dropzone/dropzone.js"> </script>

       
        
       <script src="<?php echo base_url()?>public/js/alertifyjs/alertify.min.js"></script>

        <script src="<?php echo base_url()?>public/js/sweetalert/sweetalert2.all.min.js"></script>

  
    <script src="<?php echo base_url()?>public/js/datepicker/js/bootstrap-datepicker.js"> </script>
        <script src="<?php echo base_url()?>public/js/datepicker/locales/bootstrap-datepicker.es.min.js"> </script>                        

 


    
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

        <script src="<?php echo base_url() ?>/public/js/utilities/helper.js"></script>

        <script src="<?php echo base_url()?>public/js/script.js"></script>
        <script src='<?php echo base_url()?>public/js/sha1/sha1.js'></script>    
        <script defer src="<?php echo base_url()?>public/js/jquery.validate/jquery.validate-1.19.3.min.js"></script>
        <script src="<?php echo base_url() ?>/public/js/utilities/sweetalert2.js"></script>
        <?php echo $this->layout->js?>    
    </body>
</html>
