<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PrelacionesAuxiliar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout->setLayout("template");
        $this->load->model("auxiliares/prelaciones_auxiliar_model");
        date_default_timezone_set('America/Lima');
    }

    public function index() {
        $this->layout->js(array(base_url() . "public/admin/auxiliares/prelaciones/index.js?v=".date("mdYHis")));
        return $this->layout->view("/admin/auxiliares/prelaciones/index", $this->prelaciones_auxiliar_model->index());
    }

    public function store() {
        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->prelaciones_auxiliar_model->store()));
    }

    public function update($id) {
        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->prelaciones_auxiliar_model->update(compact('id'))));
    }

    public function remove($id) {
        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->prelaciones_auxiliar_model->remove(compact('id'))));
    }

    public function edit($id) {
        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->prelaciones_auxiliar_model->edit(compact('id'))));
    }

    public function create() {
        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->prelaciones_auxiliar_model->create()));
    }

    public function pagination() {
        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->prelaciones_auxiliar_model->pagination()));
    }

}
