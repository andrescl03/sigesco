<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Postulaciones extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout->setLayout("template");
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

    public function edit($id) {
        if (is_numeric($id)) {
            $this->layout->js(array(base_url() . "public/js/myscript/postulacion/edit.js"));
            $response = $this->postulaciones_model->edit(compact('id'));
            if ($response['success']) {
                return $this->layout->view("/postulacion/edit", $response);
            }
        }
        show_404();
    }

    public function detail($id) {
        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->postulaciones_model->detail(compact('id'))));
    }

    public function update($id) {
        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->postulaciones_model->update(compact('id'))));
    }
}
