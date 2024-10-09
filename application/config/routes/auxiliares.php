<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$route['web/auxiliares/convocatorias'] = 'auxiliares/convocatoriasWebAuxiliar/index';
$route['web/auxiliares/convocatorias/detail'] = 'auxiliares/convocatoriasWebAuxiliar/detail';
$route['web/auxiliares/convocatorias/reclamo/detail'] = 'auxiliares/convocatoriasWebAuxiliar/detailReclamo';
$route['web/auxiliares/convocatorias/detailConvocatoriaGrupoInscripcion'] = 'auxiliares/convocatoriasWebAuxiliar/detailConvocatoriaGrupoInscripcion';
$route['web/auxiliares/convocatorias/(:num)/inscripciones/(:num)'] = 'auxiliares/convocatoriasWebAuxiliar/show/$1/$2';
$route['web/auxiliares/convocatorias/(:num)/reclamo/(:num)'] = 'auxiliares/convocatoriasWebAuxiliar/reclamo/$1/$2';
$route['web/auxiliares/postulantes/(:any)'] = 'auxiliares/convocatoriasWebAuxiliar/postulant/$1';
$route['web/auxiliares/postulaciones/store'] = 'auxiliares/postulacionesWebAuxiliar/store';
$route['web/auxiliares/postulaciones/expediente/store'] = 'auxiliares/postulacionesWebAuxiliar/expedienteStore';
$route['web/auxiliares/postulaciones/expediente_reclamo/store'] = 'auxiliares/postulacionesWebAuxiliar/expedienteReclamoStore';
$route['web/auxiliares/postulaciones/find'] = 'auxiliares/postulacionesWebAuxiliar/find';
$route['web/auxiliares/postulaciones/reclamo/find'] = 'auxiliares/postulacionesWebAuxiliar/findReclamo';
$route['web/auxiliares/reclamo/store'] = 'auxiliares/postulacionesWebAuxiliar/reclamo_store';
$route['web/auxiliares/postulaciones/(:any)/update'] = 'auxiliares/postulacionesWebAuxiliar/update/$1';
$route['web/auxiliares/postulaciones/(:any)'] = 'auxiliares/postulacionesWebAuxiliar/edit/$1';
$route['web/auxiliares/reportes/registro/(:any)/postulacion'] = 'auxiliares/ReporteDocumentoWebAuxiliar/postulacion/$1';
$route['web/auxiliares/reportes/registro/(:any)/reclamo'] = 'auxiliares/ReporteDocumentoWebAuxiliar/reclamo/$1';
$route['admin/auxiliares/periodos'] = 'auxiliares/configuracionAuxiliar/periodos';
$route['admin/auxiliares/periodos/VListarPeriodos'] = 'auxiliares/configuracionAuxiliar/VListarPeriodos';
$route['admin/auxiliares/periodos/store'] = 'auxiliares/configuracionAuxiliar/registraPeriodo';
$route['admin/auxiliares/periodos/(:num)'] = 'auxiliares/configuracionAuxiliar/editarPeriodo/$1';
$route['admin/auxiliares/periodos/(:num)/detail'] = 'auxiliares/configuracionAuxiliar/detallePeriodo/$1';
$route['admin/auxiliares/periodos/(:num)/update'] = 'auxiliares/configuracionAuxiliar/guardarPeriodo/$1';
$route['admin/auxiliares/periodos/(:num)/remove'] = 'auxiliares/configuracionAuxiliar/eliminarPeriodo/$1';
$route['admin/auxiliares/procesos'] = 'auxiliares/configuracionAuxiliar/procesos';
$route['admin/auxiliares/procesos/VListarProcesos'] = 'auxiliares/configuracionAuxiliar/VListarProcesos';
$route['admin/auxiliares/prelaciones'] = 'auxiliares/prelacionesAuxiliar/index';
$route['admin/auxiliares/prelaciones/store'] = 'auxiliares/prelacionesAuxiliar/store';
$route['admin/auxiliares/prelaciones/create'] = 'auxiliares/prelacionesAuxiliar/create';
$route['admin/auxiliares/prelaciones/pagination'] = 'auxiliares/prelacionesAuxiliar/pagination';
$route['admin/auxiliares/prelaciones/(:num)/update'] = 'auxiliares/prelacionesAuxiliar/update/$1';
$route['admin/auxiliares/prelaciones/(:num)/remove'] = 'auxiliares/prelacionesAuxiliar/remove/$1';
$route['admin/auxiliares/prelaciones/(:num)/edit'] = 'auxiliares/prelacionesAuxiliar/edit/$1';
$route['admin/auxiliares/bonificaciones'] = 'auxiliares/bonificacionesAuxiliar/index';
$route['admin/auxiliares/bonificaciones/store'] = 'auxiliares/bonificacionesAuxiliar/store';
$route['admin/auxiliares/bonificaciones/create'] = 'auxiliares/bonificacionesAuxiliar/create';
$route['admin/auxiliares/bonificaciones/pagination'] = 'auxiliares/bonificacionesAuxiliar/pagination';
$route['admin/auxiliares/bonificaciones/(:num)/update'] = 'auxiliares/bonificacionesAuxiliar/update/$1';
$route['admin/auxiliares/bonificaciones/(:num)/remove'] = 'auxiliares/bonificacionesAuxiliar/remove/$1';
$route['admin/auxiliares/bonificaciones/(:num)/edit'] = 'auxiliares/bonificacionesAuxiliar/edit/$1';

$route['admin/auxiliares/grupoinscripcion'] = 'auxiliares/configuracionAuxiliar/grupoinscripcion';
$route['admin/auxiliares/grupoinscripcion/VListarGrupoInscripcion'] = 'auxiliares/configuracionAuxiliar/VListarGrupoInscripcion';

