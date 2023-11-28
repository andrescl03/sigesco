<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Postulaciones extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout->setLayout("/web/main");
        $this->load->model("postulaciones_model");
        $this->load->model("email_model");
        date_default_timezone_set('America/Lima');
    }

    public function ficha($id) {
        if ($this->input->post()) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->postulaciones_model->ficha($id)));
        } else {
            show_404();
        }  
    }

    public function fichas($id) {
        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->postulaciones_model->fichas($id)));
    }
}
