<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Bonificaciones extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout->setLayout("template");
        $this->load->model("bonificaciones_model");
        date_default_timezone_set('America/Lima');
    }

    public function index() {
        $this->layout->js(array(base_url() . "public/js/myscript/bonificaciones/index.js?v=".date("mdYHis")));
        return $this->layout->view("/configuracion/bonificaciones/index", $this->bonificaciones_model->index());
    }

    public function store() {
        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->bonificaciones_model->store()));
    }

    public function update($id) {
        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->bonificaciones_model->update(compact('id'))));
    }

    public function remove($id) {
        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->bonificaciones_model->remove(compact('id'))));
    }

    public function edit($id) {
        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->bonificaciones_model->edit(compact('id'))));
    }

    public function create() {
        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->bonificaciones_model->create()));
    }

    public function pagination() {
        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->bonificaciones_model->pagination()));
    }

}
