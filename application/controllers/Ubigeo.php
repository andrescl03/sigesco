<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ubigeo extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ubigeo_model');
    }

    public function obtenerDepartamentos()
    {
        $response = array(
            'status' => 200,
            'message' => 'Success',
            'departamentos' => $this->Ubigeo_model->getDepartamentos(),
        );

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function obtenerProvincias()
    {
        $departmentId = $this->input->post('department_id');

        $provincias = $this->Ubigeo_model->getProvincias($departmentId);

        $response = array(
            'status' => 200,
            'message' => 'Success',
            'provincias' => $provincias,
        );
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function obtenerDistritos()
    {
        $provinceId = $this->input->post('province_id');

        $distritos = $this->Ubigeo_model->getDistritos($provinceId);

        $response = array(
            'status' => 200,
            'message' => 'Success',
            'distritos' => $distritos,
        );

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

}
