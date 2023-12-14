<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Adjudicaciones extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('America/Lima');
        $this->layout->setLayout("template");
        $this->load->model("adjudicaciones_model");
    }

    public function index() {
        $this->layout->js(array(base_url()."public/js/myscript/adjudicacion/index.js?t=".date("mdYHis")));
        $this->layout->view("/adjudicacion/index");
    }

    public function pagination() {
        if ($this->input->post()) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->adjudicaciones_model->pagination($_POST)));
        } else {
            show_404();
        }    
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

    public function store() {
        if ($this->input->post()) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->postulaciones_model->store()));
        } else {
			show_404();
		}
    }  

    public function find() {
        if ($this->input->post()) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->postulaciones_model->find($_POST)));
        } else {
            show_404();
        }    
    }

    public function update($uid) {
        if ($this->input->post()) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->postulaciones_model->update(compact('uid'))));
        } else {
            show_404();
        }  
    }

    public function edit($uid) {
        if (!empty(trim($uid))) {
            $this->layout->js(array(base_url()."public/web/js/convocatorias/edit.js"));
            $this->layout->view("/web/convocatoria/edit", $this->postulaciones_model->edit(compact('uid')));    
		} else {
			show_404();
		}
    }

}
