<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PostulacionesWeb extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout->setLayout("/web/main");
        $this->load->model("postulaciones_model");
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
        if ($this->input->post()) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->postulaciones_model->find()));
        } else {
            show_404();
        }    
    }
}
