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

    public function generar_reporte_adjudicados()
    {

        $ficha = 'REPORTE GENERAL DE ADJUDICADOS';


        $records = $this->adjudicaciones_model->f_details_adjudicados($_POST);

        file_put_contents('log.txt', shell_exec('locale -a'), FILE_APPEND);
        set_time_limit(0);
        setlocale(LC_ALL, 'es_ES');
        $fecha = date('d/m/Y H:i:s');
        ini_set('memory_limit', '-1');

        $this->load->library('excel');

        $hoja = $this->excel->getActiveSheet();

        $this->excel->setActiveSheetIndex(0);
        $hoja->setTitle('Reporte.');
        $hoja->setCellValue('A1', 'REPORTE GENERAL ' . $fecha);
        $hoja->getStyle('A1')->getFont()->setSize(24)->setBold(true);

        $hoja->mergeCells('A1:L1');
        $hoja->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        // Encabezados y estilo
        $headers = ['FECHA DE REGISTRO', 'NÚMERO DE DOCUMENTO', 'NOMBRES', 'APELLIDO PATERNO', 'APELLIDO MATERNO', 'CÓDIGO DE PLAZA', 'FECHA DE INICIO', 'FECHA FIN', 'NOMBRE DE LA I.E', 'MODALIDAD', 'NIVEL', 'ESPECIALIDAD'];
        foreach ($headers as $key => $header) {
            $hoja->setCellValueByColumnAndRow($key, 2, $header);


            $hoja->getStyleByColumnAndRow($key, 2)->getFont()->setSize(15)->setBold(true)->getColor()->setRGB('FFFFFF');

            $hoja->getStyleByColumnAndRow($key, 2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        }

        // Establecer color de fondo para encabezados
        $hoja->getStyle('A2:L2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FF0000');

        $columnas = range('A', 'L');
        foreach ($columnas as $columna) {
            $hoja->getColumnDimension($columna)->setAutoSize(true);
        }

        $cont = 3;

        foreach ($records as $fila) {


            // Aplicar formato de texto a todas las columnas
            foreach (range('A', 'L') as $columna) {
                $hoja->getStyle($columna . $cont)->getNumberFormat()->setFormatCode('@');
            }

            $hoja->getStyle('A' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('A' . $cont, $fila->fecha_registro, PHPExcel_Cell_DataType::TYPE_STRING);

            $hoja->getStyle('B' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('B' . $cont, $fila->numero_documento);

            $hoja->getStyle('C' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('C' . $cont, $fila->nombre);

            $hoja->getStyle('D' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('D' . $cont, $fila->apellido_paterno,  PHPExcel_Cell_DataType::TYPE_STRING);

            $hoja->getStyle('E' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('E' . $cont, $fila->apellido_materno, PHPExcel_Cell_DataType::TYPE_STRING);

            $hoja->getStyle('F' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('F' . $cont, $fila->codigoPlaza, PHPExcel_Cell_DataType::TYPE_STRING);

            $hoja->getStyle('G' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('G' . $cont, $fila->fecha_inicio, PHPExcel_Cell_DataType::TYPE_STRING);

            $hoja->getStyle('H' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('H' . $cont, $fila->fecha_final, PHPExcel_Cell_DataType::TYPE_STRING);

            $hoja->getStyle('I' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('I' . $cont, $fila->ie, PHPExcel_Cell_DataType::TYPE_STRING);

            $hoja->getStyle('J' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('J' . $cont, $fila->mod_abreviatura, PHPExcel_Cell_DataType::TYPE_STRING);

            $hoja->getStyle('K' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('K' . $cont, $fila->niv_descripcion, PHPExcel_Cell_DataType::TYPE_STRING);

            $hoja->getStyle('L' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('L' . $cont, $fila->especialidad, PHPExcel_Cell_DataType::TYPE_STRING);

            $cont++;
        }

        $filename = $ficha . '.xls'; //save our workbook as this file name

        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        //force user to download the Excel file without writing it to server's HD
        //force user to download the Excel file without writing it to server's HD
        /* Obtenemos los caracteres adicionales o mensajes de advertencia y los
            guardamos en el archivo "depuracion.txt" si tenemos permisos */
        file_put_contents('depuracion.txt', ob_get_contents());
        /* Limpiamos el búfer */
        ob_end_clean();

        $objWriter->save('php://output');
    }

}
