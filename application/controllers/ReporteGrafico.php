<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ReporteGrafico extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata("sigesco")) {
            if ($this->input->post()) {
                $mensaje["error"]   = "Su sesión ha finalizado. Volver a iniciar sesión.";
                $mensaje["link"]    = base_url() . "login/login";
                $mensaje["estado"]  = false;
                echo json_encode($mensaje);
                exit();
            } else {
                redirect(base_url() . "login/login", 'refresh');
            }
        }
        $this->layout->setLayout("template");
        $this->load->model("reportegrafico_model");
        date_default_timezone_set('America/Lima');
    }

    public function postulantes_adjudicados() {
        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->reportegrafico_model->postulantes_adjudicados($_POST)));
    }

    public function detail($id) {
        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->reportegrafico_model->detail(compact('id'))));
    }

    public function update($id) {
        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->reportegrafico_model->update(compact('id'))));
    }
}
