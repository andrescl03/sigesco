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
$route['admin/auxiliares/periodos'] = 'auxiliares/configuracionAuxiliar/periodos';
$route['admin/auxiliares/periodos/VListarPeriodos'] = 'auxiliares/configuracionAuxiliar/VListarPeriodos';
$route['admin/auxiliares/periodos/store'] = 'auxiliares/configuracionAuxiliar/registraPeriodo';
$route['admin/auxiliares/periodos/(:num)'] = 'auxiliares/configuracionAuxiliar/editarPeriodo/$1';
$route['admin/auxiliares/periodos/(:num)/detail'] = 'auxiliares/configuracionAuxiliar/detallePeriodo/$1';
$route['admin/auxiliares/periodos/(:num)/update'] = 'auxiliares/configuracionAuxiliar/guardarPeriodo/$1';
$route['admin/auxiliares/periodos/(:num)/remove'] = 'auxiliares/configuracionAuxiliar/eliminarPeriodo/$1';

