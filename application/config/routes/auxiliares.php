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
$route['admin/auxiliares/periodos/graficos/postulantes'] = 'auxiliares/reporteGraficoAuxiliar/postulantes_adjudicados';
$route['admin/auxiliares/periodos/graficos/evaluados'] = 'auxiliares/reporteGraficoAuxiliar/reporte_evaluados';
$route['admin/auxiliares/periodos/graficos/plazas'] = 'auxiliares/reporteGraficoAuxiliar/plaza_disponibles';
$route['admin/auxiliares/periodos/graficos/estados'] = 'auxiliares/reporteGraficoAuxiliar/reporte_evaluacion_estados';
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
$route['admin/auxiliares/grupoinscripcion/VNuevoGrupoInscripcion'] = 'auxiliares/configuracionAuxiliar/VNuevoGrupoInscripcion';
$route['admin/auxiliares/grupoinscripcion/CAgregarNuevoGrupoInscripcion'] = 'auxiliares/configuracionAuxiliar/CAgregarNuevoGrupoInscripcion';
$route['admin/auxiliares/grupoinscripcion/eliminarGrupoInscripcion'] = 'auxiliares/configuracionAuxiliar/eliminarGrupoInscripcion';
$route['admin/auxiliares/grupoinscripcion/validarGrupoInscripcion'] = 'auxiliares/configuracionAuxiliar/validarGrupoInscripcion';

$route['admin/auxiliares/convocatorias'] = 'auxiliares/ConvocatoriasAuxiliar/listar';
$route['admin/auxiliares/convocatorias/VListarConvocatorias'] = 'auxiliares/ConvocatoriasAuxiliar/VListarConvocatorias';
$route['admin/auxiliares/convocatorias/VNuevaConvocatoria'] = 'auxiliares/ConvocatoriasAuxiliar/vnuevaconvocatoria';
$route['admin/auxiliares/convocatorias/VSelectGrupoInscripcion'] = 'auxiliares/ConvocatoriasAuxiliar/VSelectGrupoInscripcion';
$route['admin/auxiliares/convocatorias/VTablaGrupoInscripcion'] = 'auxiliares/ConvocatoriasAuxiliar/VTablaGrupoInscripcion';
$route['admin/auxiliares/convocatorias/CAgregarNuevaConvocatoria'] = 'auxiliares/ConvocatoriasAuxiliar/CAgregarNuevaConvocatoria';

$route['admin/auxiliares/evaluaciones'] = 'auxiliares/EvaluacionAuxiliar/convocatorias';
$route['admin/auxiliares/evaluaciones/VListarConvocatoriasActivas'] = 'auxiliares/EvaluacionAuxiliar/VListarConvocatoriasActivas';
$route['admin/auxiliares/evaluaciones/VListarEspecialistas'] = 'auxiliares/EvaluacionAuxiliar/VListarEspecialistas';
$route['admin/auxiliares/evaluaciones/CAsignarReasignar'] = 'auxiliares/EvaluacionAuxiliar/CAsignarReasignar';
$route['admin/auxiliares/evaluaciones/VListarCargarExpedientePunEvaluar'] = 'auxiliares/EvaluacionAuxiliar/VListarCargarExpedientePunEvaluar';
$route['admin/auxiliares/evaluaciones/convocatorias/(:num)'] = 'auxiliares/EvaluacionAuxiliar/convocatoria/$1';
$route['admin/auxiliares/evaluaciones/convocatorias/(:num)/inscripciones/reporte/excel'] = 'auxiliares/EvaluacionAuxiliar/reporte_excel_general/$1';
$route['admin/auxiliares/evaluaciones/convocatorias/(:num)/inscripciones/(:num)/sinevaluar'] = 'auxiliares/EvaluacionAuxiliar/indexSinevaluar/$1/$2';
$route['admin/auxiliares/evaluaciones/convocatorias/(:num)/inscripciones/(:num)/preliminar'] = 'auxiliares/EvaluacionAuxiliar/indexPreliminar/$1/$2';
$route['admin/auxiliares/evaluaciones/convocatorias/(:num)/inscripciones/(:num)/final'] = 'auxiliares/EvaluacionAuxiliar/indexFinal/$1/$2';
$route['admin/auxiliares/evaluaciones/convocatorias/(:num)/inscripciones/(:num)/editar'] = 'auxiliares/EvaluacionAuxiliar/editarFicha/$1/$2';

$route['admin/auxiliares/evaluaciones/convocatorias/(:num)/inscripciones/(:num)/preliminar/exportar'] = 'auxiliares/EvaluacionAuxiliar/reporte_excel_preliminar/$1/$2';
$route['admin/auxiliares/evaluaciones/convocatorias/(:num)/inscripciones/(:num)/final/exportar'] = 'auxiliares/EvaluacionAuxiliar/reporte_excel_final/$1/$2';
$route['admin/auxiliares/evaluaciones/convocatorias/(:num)/inscripciones/(:num)/pendiente/exportar'] = 'auxiliares/EvaluacionAuxiliar/reporte_excel_pendiente/$1/$2';
$route['admin/auxiliares/evaluaciones/convocatorias/(:num)/inscripciones/preliminar/exportar'] = 'auxiliares/EvaluacionAuxiliar/reporte_excel_preliminar_total/$1';
$route['admin/auxiliares/evaluaciones/convocatorias/(:num)/inscripciones/final/exportar'] = 'auxiliares/EvaluacionAuxiliar/reporte_excel_final_total/$1';
$route['admin/auxiliares/evaluacion/convocatorias/(:num)/inscripciones/(:num)/procesar/expedientes'] = 'auxiliares/EvaluacionAuxiliar/procesar_expedientes/$1/$2';
$route['admin/auxiliares/evaluacion/convocatorias/(:num)/inscripciones/(:num)/procesar/expedientes_nocumplen'] = 'auxiliares/EvaluacionAuxiliar/procesar_expedientes_nocumplen/$1/$2';

$route['admin/auxiliares/evaluacion/convocatoria/inscripcion/pagination'] = 'auxiliares/EvaluacionAuxiliar/pagination/$1/$2';
$route['admin/auxiliares/evaluacion/convocatoria/inscripcion/postulante/(:num)/ficha'] = 'auxiliares/EvaluacionAuxiliar/ficha/$1';
$route['admin/auxiliares/evaluacion/convocatoria/inscripcion/postulante/status'] = 'auxiliares/EvaluacionAuxiliar/status';
$route['admin/auxiliares/evaluacion/convocatoria/inscripcion/postulante/(:num)/attachedfiles'] = 'auxiliares/EvaluacionAuxiliar/attachedfiles/$1';
$route['admin/auxiliares/evaluacion/convocatoria/inscripcion/postulante/(:num)/revaluar'] = 'auxiliares/EvaluacionAuxiliar/revaluarPreliFinal/$1';
$route['admin/auxiliares/evaluacion/convocatoria/inscripcion/postulante/(:num)/editar'] = 'auxiliares/postulacionesAuxiliar/edit/$1';
$route['admin/auxiliares/evaluacion/convocatoria/inscripcion/postulante/(:num)/detail'] = 'auxiliares/postulacionesAuxiliar/detail/$1';
$route['admin/auxiliares/evaluacion/convocatoria/inscripcion/postulante/(:num)/update'] = 'auxiliares/postulacionesAuxiliar/update/$1';

$route['admin/auxiliares/evaluaciones/postulaciones/(:num)/ficha'] = 'auxiliares/postulacionesAuxiliar/ficha/$1';
$route['admin/auxiliares/evaluaciones/postulaciones/(:num)/fichas'] = 'auxiliares/postulacionesAuxiliar/fichas/$1';

$route['admin/auxiliares/adjudicaciones'] = 'auxiliares/adjudicacionesAuxiliar/index';
$route['admin/auxiliares/adjudicaciones/listarGruposInscripcion'] = 'auxiliares/adjudicacionesAuxiliar/listarGruposInscripcion';
$route['admin/auxiliares/adjudicaciones/usuarios/firmas'] = 'auxiliares/adjudicacionesAuxiliar/usuarioFirmas';
$route['admin/auxiliares/adjudicaciones/plazas'] = 'auxiliares/adjudicacionesAuxiliar/plazas';
$route['admin/auxiliares/adjudicaciones/postulantes'] = 'auxiliares/adjudicacionesAuxiliar/postulantes';
$route['admin/auxiliares/adjudicaciones/create'] = 'auxiliares/adjudicacionesAuxiliar/create';
$route['admin/auxiliares/adjudicaciones/(:num)/edit'] = 'auxiliares/adjudicacionesAuxiliar/edit/$1';
$route['admin/auxiliares/adjudicaciones/postulantes/(:num)/status'] = 'auxiliares/adjudicacionesAuxiliar/updateStatus/$1';
$route['admin/auxiliares/adjudicaciones/pagination'] = 'auxiliares/adjudicacionesAuxiliar/pagination';
$route['admin/auxiliares/adjudicaciones/resource'] = 'auxiliares/adjudicacionesAuxiliar/resource';
$route['admin/auxiliares/adjudicaciones/assignment/searching'] = 'auxiliares/adjudicacionesAuxiliar/searching';
$route['admin/auxiliares/adjudicaciones/assignment/pagination'] = 'auxiliares/adjudicacionesAuxiliar/paginationAssignment';
$route['admin/auxiliares/adjudicaciones/store'] = 'auxiliares/adjudicacionesAuxiliar/store';
$route['admin/auxiliares/adjudicaciones/(:num)/remove'] = 'auxiliares/adjudicacionesAuxiliar/remove/$1';
$route['admin/auxiliares/adjudicaciones/(:num)/update'] = 'auxiliares/adjudicacionesAuxiliar/update/$1';
$route['admin/auxiliares/adjudicaciones/datedefault'] = 'auxiliares/adjudicacionesAuxiliar/datedefault';
$route['admin/auxiliares/adjudicaciones/reporte'] = 'auxiliares/adjudicacionesAuxiliar/generar_reporte_adjudicados';
$route['admin/auxiliares/adjudicaciones/(:num)/actafirmada'] = 'auxiliares/adjudicacionesAuxiliar/uploadactafirmada/$1';

$route['admin/auxiliares/reportes/adjudicaciones/(:num)/acta'] = 'auxiliares/reporteDocumentoWebAuxiliar/adjudicacion/$1';
$route['admin/auxiliares/reportes/adjudicaciones/(:num)/contrato'] = 'auxiliares/reporteDocumentoWebAuxiliar/contrato/$1';
$route['admin/auxiliares/reportes/adjudicaciones/(:num)/rd'] = 'auxiliares/reporteDocumentoWebAuxiliar/resolucion/$1';

$route['admin/auxiliares/plazas'] = 'auxiliares/plazasAuxiliar/index';
$route['admin/auxiliares/plazas/store'] = 'auxiliares/plazasAuxiliar/store';
$route['admin/auxiliares/plazas/create'] = 'auxiliares/plazasAuxiliar/create';
$route['admin/auxiliares/plazas/upload'] = 'auxiliares/plazasAuxiliar/upload';
$route['admin/auxiliares/plazas/pagination'] = 'auxiliares/plazasAuxiliar/pagination';
$route['admin/auxiliares/plazas/(:num)/update'] = 'auxiliares/plazasAuxiliar/update/$1';
$route['admin/auxiliares/plazas/(:num)/remove'] = 'auxiliares/plazasAuxiliar/remove/$1';
$route['admin/auxiliares/plazas/(:num)/edit'] = 'auxiliares/plazasAuxiliar/edit/$1';
$route['admin/auxiliares/plazas/postulantes/liberar'] = 'auxiliares/plazasAuxiliar/liberar';
$route['admin/auxiliares/plazas/exportar'] = 'auxiliares/plazasAuxiliar/reporte_plazas';

$route['admin/auxiliares/reportes'] = 'auxiliares/configuracionAuxiliar/reportes';

$route['admin/auxiliares/colegios'] = 'auxiliares/configuracionAuxiliar/colegios';
$route['admin/auxiliares/colegios/VListarColegios'] = 'auxiliares/configuracionAuxiliar/VListarColegios';

$route['admin/auxiliares/adjudicaciones/assignment/searching'] = 'adjudicaciones/searching';
$route['admin/auxiliares/adjudicaciones/assignment/pagination'] = 'adjudicaciones/paginationAssignment';