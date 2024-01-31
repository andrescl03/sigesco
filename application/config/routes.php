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

$route['api/mpv/vias'] = 'Mesaparteapi/vias';
$route['api/mpv/zonas'] = 'Mesaparteapi/zonas';
$route['api/mpv/departamentos'] = 'Mesaparteapi/departamentos';
$route['api/mpv/provincias'] = 'Mesaparteapi/provincias';
$route['api/mpv/distritos'] = 'Mesaparteapi/distritos';

$route['web/convocatorias'] = 'convocatoriasWeb/index';
$route['web/convocatorias/detail'] = 'convocatoriasWeb/detail';
$route['web/convocatorias/detailConvocatoriaGrupoInscripcion'] = 'convocatoriasWeb/detailConvocatoriaGrupoInscripcion';
// $route['web/convocatorias/(:any)'] = 'ConvocatoriasWeb/show/$1';
$route['web/convocatorias/(:num)/inscripciones/(:num)'] = 'convocatoriasWeb/show/$1/$2';
$route['web/postulantes/(:any)'] = 'convocatoriasWeb/postulant/$1';
$route['web/postulaciones/store'] = 'postulacionesWeb/store';
$route['web/postulaciones/find'] = 'postulacionesWeb/find';
$route['web/postulaciones/(:any)/update'] = 'postulacionesWeb/update/$1';
$route['web/postulaciones/(:any)'] = 'postulacionesWeb/edit/$1';

$route['reportes/adjudicaciones/(:num)/acta'] = 'reporteDocumento/adjudicacion/$1';
$route['reportes/adjudicaciones/(:num)/contrato'] = 'reporteDocumento/contrato/$1';

$route['evaluacion/convocatoria/(:num)/inscripcion/(:num)/preliminar'] = 'evaluacion/indexPreliminar/$1/$2';
$route['evaluacion/convocatoria/(:num)/inscripcion/(:num)/final'] = 'evaluacion/indexFinal/$1/$2';
$route['evaluacion/convocatoria/(:num)/inscripcion/(:num)/editar'] = 'evaluacion/editarFicha/$1/$2';

$route['evaluacion/convocatoria/inscripcion/pagination'] = 'evaluacion/pagination/$1/$2';
$route['evaluacion/convocatoria/inscripcion/postulantes/(:num)/attachedfiles'] = 'evaluacion/attachedfiles/$1';
$route['evaluacion/convocatoria/inscripcion/postulante/(:num)/revaluar'] = 'evaluacion/revaluarPreliFinal/$1';
$route['evaluacion/convocatoria/inscripcion/postulante/(:num)/editar'] = 'postulaciones/edit/$1';
$route['evaluacion/convocatoria/inscripcion/postulante/(:num)/detail'] = 'postulaciones/detail/$1';
$route['evaluacion/convocatoria/(:num)/inscripcion/(:num)/preliminar/exportar'] = 'evaluacion/reporte_excel_preliminar/$1/$2';
$route['evaluacion/convocatoria/(:num)/inscripcion/(:num)/final/exportar'] = 'evaluacion/reporte_excel_final/$1/$2';

$route['adjudicaciones/create'] = 'adjudicaciones/create';
$route['adjudicaciones/(:num)/edit'] = 'adjudicaciones/edit/$1';
$route['adjudicaciones/postulantes/(:num)/status'] = 'adjudicaciones/updateStatus/$1';
$route['admin/adjudicaciones/pagination'] = 'adjudicaciones/pagination';
$route['admin/adjudicaciones/resource'] = 'adjudicaciones/resource';
$route['admin/adjudicaciones/store'] = 'adjudicaciones/store';
$route['admin/adjudicaciones/(:num)/remove'] = 'adjudicaciones/remove/$1';
$route['admin/adjudicaciones/(:num)/update'] = 'adjudicaciones/update/$1';

$route['configuracion/periodos/store'] = 'configuracion/registraPeriodo';
$route['configuracion/periodos/(:num)'] = 'configuracion/editarPeriodo/$1';
$route['configuracion/periodos/(:num)/detail'] = 'configuracion/detallePeriodo/$1';
$route['configuracion/periodos/(:num)/update'] = 'configuracion/guardarPeriodo/$1';
$route['configuracion/periodos/(:num)/remove'] = 'configuracion/eliminarPeriodo/$1';

$route['postulaciones/(:num)/ficha'] = 'postulaciones/ficha/$1';
$route['postulaciones/(:num)/fichas'] = 'postulaciones/fichas/$1';

$route['default_controller'] = 'index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['registrar'] = 'registro/index';
