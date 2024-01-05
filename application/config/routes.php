<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['web/convocatorias'] = 'ConvocatoriasWeb/index';
$route['web/convocatorias/detail'] = 'ConvocatoriasWeb/detail';
$route['web/convocatorias/detailConvocatoriaGrupoInscripcion'] = 'convocatoriasWeb/detailConvocatoriaGrupoInscripcion';
// $route['web/convocatorias/(:any)'] = 'ConvocatoriasWeb/show/$1';
$route['web/convocatorias/(:num)/inscripciones/(:num)'] = 'ConvocatoriasWeb/show/$1/$2';
$route['web/postulantes/(:any)'] = 'ConvocatoriasWeb/postulant/$1';
$route['web/postulaciones/store'] = 'PostulacionesWeb/store';
$route['web/postulaciones/find'] = 'PostulacionesWeb/find';
$route['web/postulaciones/(:any)/update'] = 'PostulacionesWeb/update/$1';
$route['web/postulaciones/(:any)'] = 'PostulacionesWeb/edit/$1';

$route['evaluacion/convocatoria/(:num)/inscripcion/(:num)/preliminar'] = 'Evaluacion/indexPreliminar/$1/$2';
$route['evaluacion/convocatoria/(:num)/inscripcion/(:num)/final'] = 'Evaluacion/indexFinal/$1/$2';
$route['evaluacion/convocatoria/inscripcion/pagination'] = 'Evaluacion/pagination/$1/$2';
$route['evaluacion/convocatoria/inscripcion/postulantes/(:num)/attachedfiles'] = 'Evaluacion/attachedfiles/$1';
$route['evaluacion/convocatoria/inscripcion/postulante/(:num)/revaluar'] = 'Evaluacion/revaluarPreliFinal/$1';
$route['evaluacion/convocatoria/(:num)/inscripcion/(:num)/preliminar/exportar'] = 'Evaluacion/reporte_excel_preliminar/$1/$2';
$route['evaluacion/convocatoria/(:num)/inscripcion/(:num)/final/exportar'] = 'Evaluacion/reporte_excel_final/$1/$2';

$route['adjudicaciones/create'] = 'Adjudicaciones/create';
$route['adjudicaciones/(:num)/edit'] = 'Adjudicaciones/edit/$1';
$route['admin/adjudicaciones/pagination'] = 'Adjudicaciones/pagination';
$route['admin/adjudicaciones/resource'] = 'Adjudicaciones/resource';
$route['admin/adjudicaciones/store'] = 'Adjudicaciones/store';
$route['admin/adjudicaciones/(:num)/remove'] = 'Adjudicaciones/remove/$1';
$route['admin/adjudicaciones/(:num)/update'] = 'Adjudicaciones/update/$1';

$route['configuracion/periodos/store'] = 'Configuracion/registraPeriodo';
$route['configuracion/periodos/(:num)'] = 'Configuracion/editarPeriodo/$1';
$route['configuracion/periodos/(:num)/detail'] = 'Configuracion/detallePeriodo/$1';
$route['configuracion/periodos/(:num)/update'] = 'Configuracion/guardarPeriodo/$1';
$route['configuracion/periodos/(:num)/remove'] = 'Configuracion/eliminarPeriodo/$1';

$route['postulaciones/(:num)/ficha'] = 'Postulaciones/ficha/$1';
$route['postulaciones/(:num)/fichas'] = 'Postulaciones/fichas/$1';

$route['default_controller'] = 'index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['registrar'] = 'registro/index';
