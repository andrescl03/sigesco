<?php 
function isAllowedBaseRoute($url, $baseRoutes) {
    foreach ($baseRoutes as $baseRoute) {

        if (strpos($url, $baseRoute) === 0) {

            return true;
        }
    }
    return false;
}

$currentUrl = $_SERVER['REQUEST_URI'];

$baseRoutes = [
    '/sigesco/web/auxiliares'
];

if (isAllowedBaseRoute($currentUrl, $baseRoutes)) {
    $module = "AUXILIAR";
} else {
    $module = "DOCENTE";
}
?>
<nav class="navbar navbar-expand-lg navbar-light shadow-sm" style="background-color:#de1f29;">
    <div class="container-fluid">
        <!-- Branding -->
        <a class="navbar-brand text-white d-flex align-items-center" href="#" style="font-size: 1.75rem; font-weight: bold; white-space: normal;">
            SISTEMA DE GESTIÓN DE CONTRATACIÓN  <?= $module ?> - SIGESCO
        </a>
        <!-- Toggle button for smaller screens  
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> -->
        <!-- Navbar links -->
         <!-- <div class="collapse navbar-collapse" id="navbarTogglerDemo03"> -->
        <div>
            <div class="ms-auto">
                <a href="#" role="button">
                    <img src="<?php echo base_url() ?>assets/image/logo-ugel05.jpg" alt="UGEL 05 Logo" style="height: 60px;">
                </a>
            </div>
        </div>
    </div>
</nav>