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

    public function create() {
        $this->layout->js(array(base_url()."public/js/myscript/adjudicacion/form.js?t=".date("mdYHis")));
        $this->layout->view("/adjudicacion/form");
    }

    public function edit($id) {
        $this->layout->js(array(base_url()."public/js/myscript/adjudicacion/form.js?t=".date("mdYHis")));
        $this->layout->view("/adjudicacion/form", $this->adjudicaciones_model->edit(compact('id')));
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

    public function resource() {
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($this->adjudicaciones_model->resource()));
    }

    public function datedefault() {
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($this->adjudicaciones_model->datedefault()));
    }

    public function remove($id) {
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($this->adjudicaciones_model->remove(compact('id'))));
    }

    public function store() {
        if ($this->input->post()) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->adjudicaciones_model->store()));
        } else {
            show_404();
        }    
    }

    public function update($id) {
        if ($this->input->post()) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->adjudicaciones_model->update(compact('id'))));
        } else {
            show_404();
        }    
    }
    
    public function updateStatus($id) {
        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->adjudicaciones_model->updateStatus($id)));
    }

    public function acta($id) {
        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->adjudicaciones_model->acta($id)));
    }
        
    public function contrato($id) {
        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->adjudicaciones_model->contrato($id)));
    }

    public function usuarioFirmas() {
        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->adjudicaciones_model->usuarioFirmas()));
    }

    public function plazas() {
        if ($this->input->post()) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->adjudicaciones_model->plazas($_POST)));
        } else {
            show_404();
        }    
    }

    public function postulantes() {
        if ($this->input->post()) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->adjudicaciones_model->postulantes($_POST)));
        } else {
            show_404();
        }    
    }

}
