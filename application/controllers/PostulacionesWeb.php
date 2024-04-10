<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PostulacionesWeb extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout->setLayout("/web/main");
        $this->load->model("postulaciones_model");
        $this->load->model("email_model");
        date_default_timezone_set('America/Lima');

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
        log_message_ci("Ingresa a busqueda" . json_encode($this->input->post()));

        if ($this->input->post()) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->postulaciones_model->find($_POST)));
        } else {
            show_404();
        }    
    }

    
    public function findReclamo() {
        log_message_ci("Ingresa a busqueda" . json_encode($this->input->post()));

        if ($this->input->post()) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->postulaciones_model->findReclamo($_POST)));
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
