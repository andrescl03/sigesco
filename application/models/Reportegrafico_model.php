<?php
class Reportegrafico_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('tools');
    }


    public function postulantes_adjudicados($request)
    {
        $response = $this->tools->responseDefault();
        try {

            $fecha_inicio = isset($request['fecha_inicio']) ? $request['fecha_inicio'] : "";
            $fecha_final = isset($request['fecha_final']) ? $request['fecha_final'] : "";
            $periodo_id = isset($request['periodo_id']) ? $request['periodo_id'] : "";

            $anio = $this->tools->getDateHour("Y");
            $sql = "SELECT 
                        *
                    FROM periodos 
                    WHERE per_estado = 1;";
            $periodos = $this->db->query($sql)->result_array();

            if (!$periodo_id) {
                foreach ($periodos as $k => $v) {
                    if ($v['per_anio'] == $anio) {
                        $periodo_id = $v['per_id'];
                    }
                }
                if (!$periodo_id) {
                    $periodo_id = 1; 
                }
            }

            $where = "";
            if ($fecha_inicio) {
                $where .= " AND T1.fecha_registro >= '" . $fecha_inicio . " 00:00:00'";
            }

            if ($fecha_final) {
                $where .= " AND T1.fecha_registro <= '" . $fecha_final . " 23:59:59'";
            }

            $sql = "SELECT 
                        COUNT(*) AS value, 
                        T4.esp_id, 
                        T4.esp_descripcion, 
                        T5.niv_descripcion, 
                        T6.mod_nombre, 
                        T6.mod_abreviatura,
                        CONCAT(T4.esp_descripcion,' ', T5.niv_descripcion, ' ', T6.mod_abreviatura) AS category
                    FROM adjudicaciones T1 
                    JOIN postulaciones T2 ON T2.id = T1.postulacion_id
                    JOIN grupo_inscripcion T3 ON T3.gin_id = T2.inscripcion_id
                    JOIN especialidades T4 ON T4.esp_id = T3.especialidades_esp_id
                    JOIN niveles T5 ON T5.niv_id = T4.niveles_niv_id
                    JOIN modalidades T6 ON T6.mod_id = T5.modalidad_mod_id
                    WHERE T3.procesos_pro_id = 1
                    AND T3.periodos_per_id = $periodo_id
                    $where
                    GROUP BY T4.esp_id;";
            $grafico = $this->db->query($sql)->result_object();

            $response['success'] = true;
            $response['data'] = compact('grafico', 'fecha_inicio', 'fecha_final', 'periodo_id', 'periodos');
            $response['message'] = "Se proceso correctamente";
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
        }
        return $response;
    }

    public function plaza_disponibles($request)
    {
        $response = $this->tools->responseDefault();
        try {

            $periodo_id = isset($request['periodo_id']) ? $request['periodo_id'] : "";

            $anio = $this->tools->getDateHour("Y");
            $sql = "SELECT 
                        *
                    FROM periodos 
                    WHERE per_estado = 1;";
            $periodos = $this->db->query($sql)->result_array();

            if (!$periodo_id) {
                foreach ($periodos as $k => $v) {
                    if ($v['per_anio'] == $anio) {
                        $periodo_id = $v['per_id'];
                    }
                }
                if (!$periodo_id) {
                    $periodo_id = 1; 
                }
            }

            $sql = "SELECT 
                        COUNT(*) AS value, 
                        T4.esp_id, 
                        T4.esp_descripcion, 
                        T5.niv_descripcion, 
                        T6.mod_nombre, 
                        T6.mod_abreviatura,
                        CONCAT(T4.esp_descripcion,' ', T5.niv_descripcion, ' ', T6.mod_abreviatura) AS category
                    FROM adjudicaciones T1 
                    JOIN postulaciones T2 ON T2.id = T1.postulacion_id
                    JOIN grupo_inscripcion T3 ON T3.gin_id = T2.inscripcion_id
                    JOIN especialidades T4 ON T4.esp_id = T3.especialidades_esp_id
                    JOIN niveles T5 ON T5.niv_id = T4.niveles_niv_id
                    JOIN modalidades T6 ON T6.mod_id = T5.modalidad_mod_id
                    WHERE T3.procesos_pro_id = 1
                    AND T3.periodos_per_id = $periodo_id
                    GROUP BY T4.esp_id;";
            $items = $this->db->query($sql)->result_array();

            $sql = "SELECT*FROM plazas plz WHERE plz.tipo_proceso = 1 AND plz.periodo_id = 1;";
            $plazas = $this->db->query($sql)->result_array();

            $key_plazas = [];
            foreach ($plazas as $k => $v) {
                $key_plazas[$v['especialidad_general_id']][] = $v;
            }

            $grafico = [];
            foreach ($items as $item) {
                $tplazas = isset($key_plazas[$item['esp_id']]) ? count($key_plazas[$item['esp_id']]) : 0;
                $notavailable = intval($item['value']);
                $available = $tplazas - $notavailable;
                $grafico[] = [
                    'category' => $item['category'],
                    'available' => 15, // $available > 0 ? $available : 0,
                    'notavailable' => $notavailable,
                ];
            }

            $response['success'] = true;
            $response['data'] = compact('grafico', 'periodo_id', 'periodos');
            $response['message'] = "Se proceso correctamente";
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
        }
        return $response;
    }

    public function reporte_evaluados($request)
    {
        $response = $this->tools->responseDefault();
        try {

            $convocatoria_id = isset($request['convocatoria_id']) ? $request['convocatoria_id'] : "";
            $inscripcion_id = isset($request['inscripcion_id']) ? $request['inscripcion_id'] : "";
            $especialista_id = isset($request['especialista_id']) ? $request['especialista_id'] : "";
            $periodo_id = isset($request['periodo_id']) ? $request['periodo_id'] : "";

            $anio = $this->tools->getDateHour("Y");
            $sql = "SELECT 
                        *
                    FROM periodos 
                    WHERE per_estado = 1;";
            $periodos = $this->db->query($sql)->result_array();

            if (!$periodo_id) {
                foreach ($periodos as $k => $v) {
                    if ($v['per_anio'] == $anio) {
                        $periodo_id = $v['per_id'];
                    }
                }
                if (!$periodo_id) {
                    $periodo_id = 1; 
                }
            }

            $pwhere = "";
            if ($convocatoria_id) {
                $pwhere .= " AND POS.convocatoria_id = " . $convocatoria_id;
            }

            if ($inscripcion_id) {
                $pwhere .= " AND POS.inscripcion_id = " . $inscripcion_id;
            }

            if ($especialista_id) {
                $pwhere .= " AND EPE.epe_especialistaAsignado = " . $especialista_id;
            }

            $sql = "SELECT
                        POS.*,
                        EPE.epe_id AS epe_id,
                        EPE.epe_especialistaAsignado
                    FROM postulaciones AS POS
                    JOIN grupo_inscripcion AS GIN ON GIN.gin_id = POS.inscripcion_id
                    LEFT JOIN evaluacion_pun_exp AS EPE ON POS.id = EPE.postulacion_id
                    WHERE POS.deleted_at IS NULL
                    AND GIN.procesos_pro_id = 1
                    AND GIN.periodos_per_id = $periodo_id
                    $pwhere
                    GROUP BY POS.id";
            $postulaciones = $this->db->query($sql)->result_array();

            $keys_postulaciones = [];
            $especialista_dnis = [];
            $key_inscripcion_especialistas = [];
            foreach ($postulaciones as $k => $o) {
                $keys_postulaciones[$o['inscripcion_id']][$o['estado']][] = $o;
                $especialista_dnis[$o['epe_especialistaAsignado']] = $o['epe_especialistaAsignado'];
                $key_inscripcion_especialistas[$o['inscripcion_id']][$o['epe_especialistaAsignado']] = $o['epe_especialistaAsignado'];
            }

            $especialistas = [];
            if (count($especialista_dnis)) {
                $sql = "SELECT
                            *
                        FROM usuarios
                        WHERE usu_dni IN ('".implode("','", $especialista_dnis)."')";
                $especialistas = $this->db->query($sql)->result_array();
            }

            $key_especialistas = [];
            foreach ($especialistas as $k => $v) {
                if ($v['usu_dni']) {
                    $key_especialistas[$v['usu_dni']] = $v; 
                }
            }

            $cantidad_preliminar = 0;
            $cantidad_sin_evaluar = 0;
            $cantidad_final = 0;

            foreach ($keys_postulaciones as $key => $values) {
                if (isset($keys_postulaciones[$key]['enviado'])) {
                    $cantidad_sin_evaluar += count($keys_postulaciones[$key]['enviado']);
                }
                if (isset($keys_postulaciones[$key]['rechazado'])) {
                    $cantidad_preliminar += count($keys_postulaciones[$key]['rechazado']);
                }
                if (isset($keys_postulaciones[$key]['revisado'])) {
                    $cantidad_preliminar += count($keys_postulaciones[$key]['revisado']);
                }
                if (isset($keys_postulaciones[$key]['finalizado'])) {
                    $cantidad_final += count($keys_postulaciones[$key]['finalizado']);
                }
            }


            $grafico = [
                [
                    "category" => "Sin Evaluar",
                    "value" => $cantidad_sin_evaluar,
                    "color" => "#90CAF9"
                ],
                [
                    "category" => "Preliminar",
                    "value" => $cantidad_preliminar,
                    "color" => "#C5E1A5"
                ],
                [
                    "category" => "Evaluados",
                    "value" => $cantidad_final,
                    "color" => "#B39DDB"
                ],
            ];

            $sql = "SELECT 
                        *,
                        CONCAT('CONV-', LPAD(con_numero, 4, '0'), '-', con_anio) as con_name,
                        CONCAT(mod_abreviatura, ' ', niv_descripcion, ' ', esp_descripcion) as gin_name
                    FROM modalidades moda 
                    INNER JOIN niveles niv ON moda.mod_id = niv.modalidad_mod_id 
                    INNER JOIN especialidades esp ON niv.niv_id = esp.niveles_niv_id 
                    INNER JOIN grupo_inscripcion gin ON esp.esp_id = gin.especialidades_esp_id 
                    INNER JOIN convocatorias_detalle cde ON gin.gin_id = cde.grupo_inscripcion_gin_id 
                    INNER JOIN convocatorias con ON con.con_id = cde.convocatorias_con_id 
                    WHERE cde.cde_estado = 1 
                    AND gin.periodos_per_id = $periodo_id 
                    AND gin.procesos_pro_id = 1
                    ORDER BY con.con_id desc, moda.mod_id asc, niv.niv_id asc, esp.esp_id ASC;";
            $modalidades = $this->db->query($sql)->result_array();

            $convocatorias = [];
            $keys_modalidades = [];
            foreach ($modalidades as $k => $v) {
                $convocatorias[$v['con_id']] = [
                    'con_id' => $v['con_id'],
                    'con_numero' => $v['con_numero'],
                    'con_estado' => $v['con_estado'],
                    'con_name' => $v['con_name'],
                    'con_tipo' => $v['con_tipo'],
                    'con_modalidades' => []
                ];
                $keys_modalidades[$v['con_id']][] = $v;
            }

            $convocatorias = array_values($convocatorias);
            foreach ($convocatorias as $k => $v) {
                if (isset($keys_modalidades[$v['con_id']])) {
                    $con_modalidades = array_values($keys_modalidades[$v['con_id']]);
                    foreach ($con_modalidades as $k2 => $v2) {
                        $con_modalidades[$k2]['especialistas'] = [];
                        if (isset($key_inscripcion_especialistas[$v2['gin_id']])) {
                            $inscripcion_especialistas = array_values($key_inscripcion_especialistas[$v2['gin_id']]);
                            $iespecialistas = [];
                            foreach ($inscripcion_especialistas as $k3 => $v3) {
                                if (isset($key_especialistas[$v3])) {
                                    $iespecialistas[] = $key_especialistas[$v3];
                                }
                            }
                            $con_modalidades[$k2]['especialistas'] = $iespecialistas;
                        }
                    }
                    $convocatorias[$k]['con_modalidades'] = $con_modalidades;
                }
            }

            $response['success'] = true;
            $response['data'] = compact('convocatorias', 'grafico', 'periodo_id', 'periodos');
            $response['message'] = "Se proceso correctamente";
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
        }
        return $response;
    }

    public function reporte_evaluacion_estados($request)
    {
        $response = $this->tools->responseDefault();
        try {

            $convocatoria_id = isset($request['convocatoria_id']) ? $request['convocatoria_id'] : "";
            $especialista_id = isset($request['especialista_id']) ? $request['especialista_id'] : "";
            $periodo_id = isset($request['periodo_id']) ? $request['periodo_id'] : "";
            $modulo = isset($request['modulo']) ? $request['modulo'] : "";

            $anio = $this->tools->getDateHour("Y");
            $sql = "SELECT 
                        *
                    FROM periodos 
                    WHERE per_estado = 1;";
            $periodos = $this->db->query($sql)->result_array();

            if (!$periodo_id) {
                foreach ($periodos as $k => $v) {
                    if ($v['per_anio'] == $anio) {
                        $periodo_id = $v['per_id'];
                    }
                }
                if (!$periodo_id) {
                    $periodo_id = 1; 
                }
            }

            $where = "";
            if ($convocatoria_id) {
                $where .= " AND pos.convocatoria_id = " . $convocatoria_id;
            }

            if ($especialista_id) {
                $where .= " AND epe.epe_especialistaAsignado = " . $especialista_id;
            }

            $mwhere = " AND pos.estado IN ('rechazado','revisado')";
            if (strtolower($modulo) == 'final') {
                $mwhere = " AND pos.estado = 'finalizado'";
            }

            $sql = "SELECT 
                        pos.*,
                        epe.epe_id,
                        epe.epe_especialistaAsignado,
                        esp.esp_id,
                        esp.esp_descripcion, 
                        usu.usu_nombre, 
                        usu.usu_apellidos, 
                        usu.usu_dni,
                        pe.estado as estado_evaluacion,
                        pe.estado as prerequisito_estado,
                        con.con_id, 
                        con.con_tipo as convocatoria_tipo_id,
                        CONCAT(esp.esp_descripcion,' ', niv.niv_descripcion, ' ', moda.mod_abreviatura) AS category
                    FROM postulaciones pos
                    INNER JOIN evaluacion_pun_exp epe ON epe.postulacion_id = pos.id
                    INNER JOIN usuarios usu ON usu.usu_dni = epe.epe_especialistaAsignado
                    INNER JOIN convocatorias con ON con.con_id = pos.convocatoria_id
                    INNER JOIN postulacion_evaluaciones pe ON pos.id = pe.postulacion_id AND pe.promedio = 0
                    INNER JOIN grupo_inscripcion gin ON gin.gin_id = pos.inscripcion_id
                    JOIN especialidades esp ON esp.esp_id = gin.especialidades_esp_id
                    JOIN niveles niv ON niv.niv_id = esp.niveles_niv_id
                    JOIN modalidades moda ON moda.mod_id = niv.modalidad_mod_id
                    WHERE pos.deleted_at IS NULL
                    AND gin.procesos_pro_id = 1
                    AND gin.periodos_per_id = $periodo_id";
            $all = $this->db->query($sql)->result_array();

            $sql .= $mwhere . $where; 
            $items = $this->db->query($sql)->result_array();

            $convocatoria_ids = [];
            $especialista_dnis = [];
            $key_estados = [];
            $key_especialidades = [];
            $key_convocatoria_especialidades = [];
            foreach ($items as $k => $v) {
                $key_estados[$v['esp_id']][$v['estado_evaluacion']][] = $v; 
                $key_especialidades[$v['esp_id']] = [
                    'category' => $v['category'],
                    'esp_id' => $v['esp_id'],
                    'observed' => 0,
                    'comply' => 0,
                    'notcomply' => 0
                ];
            }
            foreach ($key_estados as $k => $v) {
                if (isset($key_estados[$k][0])) { // no cumple
                    $key_especialidades[$k]['notcomply'] = intval($key_especialidades[$k]['notcomply']) + count($key_estados[$k][0]);
                }
                if (isset($key_estados[$k][1])) { // cumple
                    $key_especialidades[$k]['comply'] = intval($key_especialidades[$k]['comply']) + count($key_estados[$k][1]);
                }
                if (isset($key_estados[$k][2])) { // observado
                    $key_especialidades[$k]['observed'] = intval($key_especialidades[$k]['observed']) + count($key_estados[$k][2]);
                }
            }

            foreach ($all as $k => $v) {
                $convocatoria_ids[$v['con_id']] = $v['con_id'];
                $especialista_dnis[$v['epe_especialistaAsignado']] = $v['epe_especialistaAsignado'];
                $key_convocatoria_especialidades[$v['con_id']][$v['epe_especialistaAsignado']] = $v['epe_especialistaAsignado'];
            }
            $grafico = array_values($key_especialidades);

            $convocatorias = [];
            if (count($convocatoria_ids)) {
                $sql = "SELECT
                            *,
                            CONCAT('CONV-', LPAD(con_numero, 4, '0'), '-', con_anio) as con_name
                        FROM convocatorias
                        WHERE con_id IN (".implode(",", $convocatoria_ids).") ORDER BY con_numero DESC";
                $convocatorias = $this->db->query($sql)->result_array();
            }

            $especialistas = [];
            if (count($especialista_dnis)) {
                $sql = "SELECT
                            *
                        FROM usuarios
                        WHERE usu_dni IN ('".implode("','", $especialista_dnis)."')";
                $especialistas = $this->db->query($sql)->result_array();
            }

            $key_especialistas = [];
            foreach ($especialistas as $k => $v) {
                if ($v['usu_dni']) {
                    $key_especialistas[$v['usu_dni']] = $v; 
                }
            }

            foreach ($convocatorias as $k => $v) {
                $mespecialistas = [];
                if (isset($key_convocatoria_especialidades[$v['con_id']])) {
                    if (isset($key_convocatoria_especialidades[$v['con_id']])) {
                        $values = $key_convocatoria_especialidades[$v['con_id']];
                        foreach ($values as $k2 => $v2) {
                            if (isset($key_especialistas[$key_convocatoria_especialidades[$v['con_id']][$v2]])) {
                                $mespecialistas[] = $key_especialistas[$key_convocatoria_especialidades[$v['con_id']][$v2]];
                            }
                        }
                    }
                }
                $convocatorias[$k]['especialistas'] = $mespecialistas;
            }
            
            $response['success'] = true;
            $response['data'] = compact('convocatorias', 'grafico', 'periodos', 'periodo_id');
            $response['message'] = "Se proceso correctamente";
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
        }
        return $response;
    }

}
