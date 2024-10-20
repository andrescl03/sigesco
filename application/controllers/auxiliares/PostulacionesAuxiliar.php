<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PostulacionesAuxiliar extends CI_Controller {

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
        $this->load->model("auxiliares/postulaciones_auxiliar_model");
        date_default_timezone_set('America/Lima');
    }

    public function ficha($id) {
        if ($this->input->post()) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->postulaciones_auxiliar_model->ficha($id)));
        } else {
            show_404();
        }  
    }

    public function fichas($id) {
        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->postulaciones_auxiliar_model->fichas($id)));
    }

    public function edit($id) {
        if (is_numeric($id)) {
            $this->layout->js(array(base_url() . "public/js/myscript/postulacion/edit.js"));
            $response = $this->postulaciones_auxiliar_model->edit(compact('id'));
            if ($response['success']) {
                return $this->layout->view("/postulacion/edit", $response);
            }
        }
        show_404();
    }

    public function detail($id) {
        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->postulaciones_auxiliar_model->detail(compact('id'))));
    }

    public function update($id) {
        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->postulaciones_auxiliar_model->update(compact('id'))));
    }
}
