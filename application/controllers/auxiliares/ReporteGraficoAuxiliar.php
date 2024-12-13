<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ReporteGraficoAuxiliar extends CI_Controller {

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
        $this->load->model("auxiliares/reportegrafico_auxiliar_model");
        date_default_timezone_set('America/Lima');
    }

    public function postulantes_adjudicados() {
        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->reportegrafico_auxiliar_model->postulantes_adjudicados($_POST)));
    }

    public function plaza_disponibles() {
        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->reportegrafico_auxiliar_model->plaza_disponibles($_POST)));
    }

    public function reporte_evaluados() {
        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->reportegrafico_auxiliar_model->reporte_evaluados($_POST)));
    }

    public function reporte_evaluacion_estados() {
        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->reportegrafico_auxiliar_model->reporte_evaluacion_estados($_POST)));
    }
}
