<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PlazasAuxiliar extends CI_Controller {

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

        date_default_timezone_set('America/Lima');
        $this->layout->setLayout("template");
        $this->load->model("auxiliares/plazas_auxiliar_model");
        $this->load->model("email_model");
    }

    public function index() {
        $this->layout->js(array(base_url() . "public/admin/auxiliares/plazas/index.js?v=".date("mdYHis")));
        return $this->layout->view("/admin/auxiliares/plazas/index", $this->plazas_auxiliar_model->index());
    }

    public function store() {
        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->plazas_auxiliar_model->store()));
    }

    public function create() {
        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->plazas_auxiliar_model->create()));
    }

    public function update($id) {
        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->plazas_auxiliar_model->update(compact('id'))));
    }

    public function remove($id) {
        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->plazas_auxiliar_model->remove(compact('id'))));
    }

    public function edit($id) {
        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->plazas_auxiliar_model->edit(compact('id'))));
    }

    public function liberar() {
        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->plazas_auxiliar_model->liberar()));
    }

    public function pagination() {
        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->plazas_auxiliar_model->pagination()));
    }

    public function upload() {
        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->plazas_auxiliar_model->upload()));
    }

    public function reporte_plazas()

    {

        $estado =  $this->input->post('estado');

        if($estado == 1){
            $name_estado = 'DISPONIBLES';
            $records = $this->plazas_auxiliar_model->f_details_plazas();

        }
        if($estado == 2){
            $name_estado = 'LIBERADAS';
            $records = $this->plazas_auxiliar_model->f_details_plazas_liberadas();

        }

        $ficha = 'REPORTE DE PLAZAS ' . $name_estado;


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
        $headers = ['CÓDIGO DE PLAZA', 'NOMBRE DE LA I.E', 'CARGO', 'CARACTERÍSTICA', 'TIPO', 'JORNADA LABORAL', 'TIPO DE VACANTE', 'MOTIVO DE VACANTE', 'MODALIDAD', 'NIVEL', 'ESPECIALIDAD', 'OBSERVACION'];
        foreach ($headers as $key => $header) {
            $hoja->setCellValueByColumnAndRow($key, 2, $header);

            $hoja->getStyleByColumnAndRow($key, 2)->getFont()->setSize(15)->setBold(true)->getColor()->setRGB('FFFFFF');

            $hoja->getStyleByColumnAndRow($key, 2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        }

        $hoja->getStyle('A2:L2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FF0000');

        $columnas = range('A', 'L');
        foreach ($columnas as $columna) {
            $hoja->getColumnDimension($columna)->setAutoSize(true);
        }

        $cont = 3;

        foreach ($records as $fila) {

            foreach (range('A', 'L') as $columna) {
                $hoja->getStyle($columna . $cont)->getNumberFormat()->setFormatCode('@');
            }

            $hoja->getStyle('A' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('A' . $cont, $fila->codigo_plaza, PHPExcel_Cell_DataType::TYPE_STRING);

            $hoja->getStyle('B' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('B' . $cont, $fila->ie);

            $hoja->getStyle('C' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('C' . $cont, $fila->cargo);

            $hoja->getStyle('D' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('D' . $cont, $fila->caracteristica,  PHPExcel_Cell_DataType::TYPE_STRING);

            $hoja->getStyle('E' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('E' . $cont, $fila->tipo, PHPExcel_Cell_DataType::TYPE_STRING);

            $hoja->getStyle('F' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('F' . $cont, $fila->jornada, PHPExcel_Cell_DataType::TYPE_STRING);

            $hoja->getStyle('G' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('G' . $cont, $fila->tipo_vacante, PHPExcel_Cell_DataType::TYPE_STRING);

            $hoja->getStyle('H' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('H' . $cont, $fila->motivo_vacante, PHPExcel_Cell_DataType::TYPE_STRING);

            $hoja->getStyle('I' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('I' . $cont, $fila->mod_abreviatura, PHPExcel_Cell_DataType::TYPE_STRING);

            $hoja->getStyle('J' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('J' . $cont, $fila->niv_descripcion, PHPExcel_Cell_DataType::TYPE_STRING);

            $hoja->getStyle('K' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('K' . $cont, $fila->especialidad, PHPExcel_Cell_DataType::TYPE_STRING);

            $hoja->getStyle('L' . $cont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $hoja->setCellValue('L' . $cont, $fila->observacion_liberacion, PHPExcel_Cell_DataType::TYPE_STRING);


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
