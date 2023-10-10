<?php
class Ubigeo_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Función para listar los departamentos
    public function getDepartamentos() {
        $query = $this->db->get('ubigeo_peru_departments');
        return $query->result();
    }

    // Función para listar las provincias basadas en el ID del departamento
    public function getProvincias($departmentId) {
        $this->db->where('department_id', $departmentId);
        $query = $this->db->get('ubigeo_peru_provinces');
        return $query->result();
    }

    // Función para listar los distritos basados en el ID de la provincia
    public function getDistritos($provinceId) {
        $this->db->where('province_id', $provinceId);
        $query = $this->db->get('ubigeo_peru_districts');
        return $query->result();
    }
}
?>