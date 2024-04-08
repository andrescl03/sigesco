<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ConvocatoriasWeb extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->layout->setLayout("/web/main");
        $this->load->model("convocatorias_web_model");
        date_default_timezone_set('America/Lima');
        $this->load->library('tools');

    }

    public function index()
    {
        $dato = 1;
        $idPer  = true;
        $idPro  = true;
        $datos  = $this->convocatorias_web_model->index($idPer, $idPro);

        $now_unix = strtotime($this->tools->getDateHour());

        $this->layout->js(array(base_url() . "public/web/js/convocatorias/index.js"));
        $this->layout->view("/web/convocatoria/index", compact('dato', 'datos', 'now_unix'));
    }

    public function show($convocatoria_id, $inscripcion_id)
    {
        if (is_numeric($convocatoria_id) && is_numeric($inscripcion_id)) {
            $this->layout->js(array(base_url() . "public/web/js/convocatorias/show.js"));
            $response = $this->convocatorias_web_model->show(compact('convocatoria_id', 'inscripcion_id'));
            if ($response['success']) {
                return $this->layout->view("/web/convocatoria/show", $response);
            }
        }
        show_404();
    }

    public function reclamo($convocatoria_id, $inscripcion_id)
    {
        if (is_numeric($convocatoria_id) && is_numeric($inscripcion_id)) {
            $this->layout->js(array(base_url() . "public/web/js/convocatorias/show.js"));
            $response = $this->convocatorias_web_model->show(compact('convocatoria_id', 'inscripcion_id'));
            if ($response['success']) {
                return $this->layout->view("/web/convocatoria/reclamo", $response);
            }
        }
        show_404();
    }


    public function detail()
    {
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($this->convocatorias_web_model->detail()));
    }

    public function detailConvocatoriaGrupoInscripcion()
    {
        $idConvocatoria = $this->input->post("idConv", true);
        $now_unix = strtotime($this->tools->getDateHour());

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array($this->convocatorias_web_model->detailConvocatoriaGrupoInscripcion($idConvocatoria), $now_unix)));
            
    }
}
