<!--
  Desarrollado por: Ing. Luis Alberto Arrascue Bazan
  Cel: 959817779
  correo: abluis15@gmail.com
  Año 2022
-->
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
        
        <link rel="stylesheet" href="<?php echo base_url()?>public/css/animate.css.4.1.1/animate.min.css" />

        <link href="<?php echo base_url()?>public/css/styles.css" rel="stylesheet" />
        <link href="<?php echo base_url()?>public/css/estilos.css" rel="stylesheet" />

       <link rel="stylesheet" href="<?php echo base_url()?>public/js/alertifyjs/css/alertify.min.css">
        <link rel="stylesheet" href="<?php echo base_url()?>public/js/alertifyjs/css/themes/bootstrap.min.css">

        <link href="<?php echo base_url()?>public/css/estilos_2.css?t=1.5" rel="stylesheet" />
      
    </head>    
    <body class="sb-nav-fixed ">
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





        <script src="<?php echo base_url()?>public/js/script.js"></script>
        <script src='<?php echo base_url()?>public/js/sha1/sha1.js'></script>    
        <script defer src="<?php echo base_url()?>public/js/jquery.validate/jquery.validate-1.19.3.min.js"></script>
        <?php echo $this->layout->js?>    
    </body>
</html>
