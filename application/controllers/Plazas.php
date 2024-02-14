<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Plazas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout->setLayout("template");
        $this->load->model("plazas_model");
        $this->load->model("email_model");
        date_default_timezone_set('America/Lima');
    }

    public function index() {
        $this->layout->js(array(base_url() . "public/js/myscript/plazas/index.js"));
        return $this->layout->view("/configuracion/plazas/index", $this->plazas_model->index());
    }

    public function store() {
        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->plazas_model->store()));
    }

    public function update($id) {
        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->plazas_model->update(compact('id'))));
    }

    public function remove($id) {
        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->plazas_model->remove(compact('id'))));
    }

    public function edit($id) {
        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->plazas_model->edit(compact('id'))));
    }

    public function pagination() {
        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->plazas_model->pagination()));
    }

}
