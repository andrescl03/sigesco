<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ConvocatoriasWebAuxiliar extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->layout->setLayout("/web/main");
        $this->load->model("auxiliares/convocatorias_web_auxiliar_model");
        date_default_timezone_set('America/Lima');
        $this->load->library('tools');

    }

    public function index()
    {
        $dato = 1;
        $idPer  = true;
        $idPro  = 2;
        $datos  = $this->convocatorias_web_auxiliar_model->index($idPer, $idPro);

        $now_unix = strtotime($this->tools->getDateHour());

        $this->layout->js(array(base_url() . "public/web/js/convocatorias/auxiliares/index.js"));
        $this->layout->view("/web/convocatoria/auxiliares/index", compact('dato', 'datos', 'now_unix'));
    }


    public function show($convocatoria_id, $inscripcion_id)
    {
        if (is_numeric($convocatoria_id) && is_numeric($inscripcion_id)) {
            $this->layout->js(array(base_url() . "public/web/js/convocatorias/auxiliares/show.js"));
            $response = $this->convocatorias_web_auxiliar_model->show(compact('convocatoria_id', 'inscripcion_id'));
            if ($response['success']) {
                return $this->layout->view("/web/convocatoria/auxiliares/show", $response);
            }
        }
        show_404();
    }

    public function reclamo($convocatoria_id, $inscripcion_id)
    {
        if (is_numeric($convocatoria_id) && is_numeric($inscripcion_id)) {
            $this->layout->js(array(base_url() . "public/web/js/convocatorias/auxiliares/show-reclamo.js"));
            $response = $this->convocatorias_web_auxiliar_model->showReclamo(compact('convocatoria_id', 'inscripcion_id'));
            if ($response['success']) {
                return $this->layout->view("/web/convocatoria/auxiliares/reclamo", $response);
            }
        }
        show_404();
    }


    public function detail()
    {
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($this->convocatorias_web_auxiliar_model->detail()));
    }

    public function detailReclamo()
    {
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($this->convocatorias_web_auxiliar_model->detailReclamo()));
    }
    public function detailConvocatoriaGrupoInscripcion()
    {
        $idConvocatoria = $this->input->post("idConv", true);
        $now_unix = strtotime($this->tools->getDateHour());

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array($this->convocatorias_web_auxiliar_model->detailConvocatoriaGrupoInscripcion($idConvocatoria), $now_unix)));
            
    }
}
