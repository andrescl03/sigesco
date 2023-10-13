<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ConvocatoriasWeb extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout->setLayout("/web/main");
        $this->load->model("convocatorias_model");
        date_default_timezone_set('America/Lima');
    }

    public function index() {
        $dato = 1;
        $this->layout->js(array(base_url()."public/web/js/convocatorias/index.js"));
        $this->layout->view("/web/convocatoria/index", compact('dato'));
    }

    public function show() {
        $dato = 1;
        $this->layout->js(array(base_url()."public/web/js/convocatorias/show.js"));
        $this->layout->view("/web/convocatoria/show", compact('dato'));
    }

    public function obtenerDatosPostulante() {

        $document = $this->input->post('document');
        $response = array(
            'status' => 200,
            'message' => 'Success',
            'datos' => $this->convocatorias_model->obtenerDatosDocentePUN($document),
        );
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
}
