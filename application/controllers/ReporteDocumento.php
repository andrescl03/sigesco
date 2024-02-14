<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ReporteDocumento extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // $session = $this->Usuario_model->datos();
        // if (empty($session)) {
        //     redirect('inicio', 'refresh');
        // }
        // $this->load->model('Documento_model', 'documento');
        // $this->load->model('Reserva_model', 'reserva');
        // $this->load->model('Plaza_model', 'plaza');
        // $this->load->model('Evaluacion_expediente_model', 'evaluacion_expediente');
        // $this->load->model('Evaluacion_expediente_anexo10_model', 'evaluacion_expediente_anexo10');

        $this->load->model('adjudicaciones_model');
    }

    var $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

    public function reporte_personal_pdf() {
        //*******  LLAMARA A LA LIBRERIA - PDF  ********//
        $this->load->library('Pdf3');

        $id = $this->input->get('conv');

        $datos = $this->evaluacion_expediente_anexo10->reporte_personal_pdf($id);
        $this->db->reconnect();
        ob_start();
        $this->pdf = new Pdf ();
        // Agregamos una página
        $this->pdf->AddPage('');
        // Define el alias para el número de página que se imprimirá en el pie
        $this->pdf->AliasNbPages();
        /*
         * Se define el titulo, márgenes izquierdo, derecho y
         * el color de relleno predeterminado
         */

        $this->pdf->SetFont('Arial', 'BU', 15);

        $this->pdf->Cell(180, 8, utf8_decode('REPORTE DE EVALUACIÓN - ANEXO 10 '), 0, 0, 'C');

        $this->pdf->Ln(7);

        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', 'BU', 9);
        $this->pdf->Cell(40, 7, 'DATOS PERSONALES', '', 0, 'L', 0);
        $this->pdf->Cell(135, 7, 'EVALUADO POR', '', 0, 'R', 0);
        $this->pdf->Ln(6);

        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, 'DNI', '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(0, 7, utf8_decode($datos [0] ['dni']), '', 0, 'L', 0);
        $nombre_especialista = strtoupper($datos [0] ['nombre_completo']);
        $this->pdf->Cell(1, 7, utf8_decode($nombre_especialista), '', 0, 'R', 0);
        $this->pdf->Ln(4);

        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, 'NOMBRE COMPLETO', '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(0, 7, utf8_decode($datos [0] ['nombres']), '', 0, 'L', 0);
        $this->pdf->Cell(1, 7, utf8_decode($datos [0] ['descripcion_rol']), '', 0, 'R', 0);
        $this->pdf->Ln(6);

        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', 'BU', 9);
        $this->pdf->Cell(40, 7, 'DATOS CONVOCATORIA', '', 0, 'L', 0);
        $this->pdf->Ln(6);

        // $this->pdf->SetFont('Arial', '', 8);
        // $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        // $this->pdf->Cell(40, 7, 'NIVEL', '', 0, 'L', 0);
        // $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        // $this->pdf->Cell(0, 7, utf8_decode($datos [0] ['nivel']), '', 0, 'L', 0);
        // $this->pdf->Ln(4);

        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, 'ESPECIALIDAD', '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(0, 7, utf8_decode($datos [0] ['especialidad_completa']), '', 0, 'L', 0);

        $this->pdf->Ln(6);

        $this->pdf->SetFillColor(212, 212, 212);
        $this->pdf->SetTextColor(0, 0, 0);

        $this->pdf->setfont('Arial', 'B', 9);

        /*-------------------FORMACION PROFESIONAL-------------------*/
            $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
            $this->pdf->SetFont('Arial', 'BU', 9);
            $this->pdf->Cell(40, 7, utf8_decode('FORMACION ACADÉMICA Y PROFESIONAL'), '', 0, 'L', 0);
            $this->pdf->SetFont('Arial', 'B', 9);
            $this->pdf->Cell(255, 7, 'NUM. EXP: '.utf8_decode($datos [0] ['num_exp']), '', 0, 'C', 0);
            // $this->pdf->Cell(100, 7, 'NUM. EXP: '.utf8_decode($datos [0] ['especialidad_completa']), '', 0, 'L', 0);
            $this->pdf->Ln(8);

            $this->pdf->SetFont('Arial', '', 8);

            $dni = utf8_decode($datos[0]['dni']);
            $nombres = utf8_decode($datos[0]['nombres']);
            $suma = utf8_decode($datos[0]['suma']);
            $sumb = utf8_decode($datos[0]['sumb']);
            $sumc = utf8_decode($datos[0]['sumc']);
            $bonif = utf8_decode($datos[0]['bonif']);
            $suma_final = utf8_decode($datos[0]['suma_final']);

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->Cell(165, 5, 'Aspecto a Evaluar', 1, 0, 'C', true);
            $this->pdf->Cell(20, 5, 'Punt. Maximo', 1, 0, 'C', true);
            $this->pdf->Ln(5);

            //*** COLOCAMOS LOS DATOS EN LAS CELDAS DEL PDF ***//
            
 
            $this->pdf->Cell(6, 5, '', 0, 0, 'L', false);

            $this->pdf->SetWidths(array(165,20,25));
            //un arreglo con alineacion de cada celda
            $this->pdf->SetAligns(array('C','C','C'));

            $this->pdf->Row(array(utf8_decode("Estudios de pregrado: a.1 Otro Título Profesional Pedagógico o Título de Segunda Especialidad en Educación, no afín al nivel o ciclo de la especialidad que postula"),utf8_decode($datos [0] ['a1'])));
 
            
            $this->pdf->Cell(6, 5, '', 0, 'B', 'C', false);
            $this->pdf->Cell(165, 5, utf8_decode('Estudios de pregrado: a.2 Título Profesional Universitario no Pedagógico, afín al nivel o ciclo de la especialidad que postula'), 1, 0, 'C');
            $this->pdf->Cell(20, 5, $datos [0] ['a2'], 1, 0, 'C');
            $this->pdf->Ln(5);

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->Cell(165, 5, utf8_decode('Estudios de pregrado: a.3 Titulo Profesional Técnico'), 1, 0, 'C');
            $this->pdf->Cell(20, 5, $datos [0] ['a3'], 1, 0, 'C');
            $this->pdf->Ln(5);

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->Cell(165, 5, utf8_decode('Estudios de pregrado: a.4 Estudios de pregrado en educación financiados a través de PRONABEC'), 1, 0, 'C');
            $this->pdf->Cell(20, 5, $datos [0] ['a4'], 1, 0, 'C');
            $this->pdf->Ln(5);

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->Cell(165, 5, utf8_decode('Estudios de pregrado: a.5 Constancia de quinto superior de su promoción en sus estudios pedagógicos'), 1, 0, 'C');
            $this->pdf->Cell(20, 5, $datos [0] ['a5'], 1, 0, 'C');
            $this->pdf->Ln(5);

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->Cell(165, 5, utf8_decode('Estudios de pregrado: a.6 Constancia de tercio superior de su promoción en sus estudios pedagógicos'), 1, 0, 'C');
            $this->pdf->Cell(20, 5, $datos [0] ['a6'], 1, 0, 'C');
            $this->pdf->Ln(5);

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->Cell(165, 5, utf8_decode('Estudios de posgrado: a.7 Grado de Doctor registrado en SUNEDU'), 1, 0, 'C');
            $this->pdf->Cell(20, 5, $datos [0] ['a7'], 1, 0, 'C');
            $this->pdf->Ln(5);

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->Cell(165, 5, utf8_decode('Estudios de posgrado: a.8 Estudios concluidos de Doctorado'), 1, 0, 'C');
            $this->pdf->Cell(20, 5, $datos [0] ['a8'], 1, 0, 'C');
            $this->pdf->Ln(5);

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->Cell(165, 5, utf8_decode('Estudios de posgrado: a.9 Grado de Maestro/Magister registrado en SUNEDU en área'), 1, 0, 'C');
            $this->pdf->Cell(20, 5, $datos [0] ['a9'], 1, 0, 'C');
            $this->pdf->Ln(5);


            $this->pdf->Cell(6, 5, '', 0, 0, 'C');
            $this->pdf->Cell(165, 5, utf8_decode('Estudios de posgrado: a.10 Estudios concluidos de Maestría'), 1, 0, 'C');
            $this->pdf->Cell(20, 5, $datos [0] ['a10'], 1, 0, 'C');
            $this->pdf->Ln(5);


            $this->pdf->Cell(6, 5, '', 0, 0, 'C');
            $this->pdf->Cell(165, 5, utf8_decode('Estudios de posgrado: a.11 Diplomado de Posgrado (hasta un máximo de tres (3) diplomados)'), 1, 0, 'C');
            $this->pdf->Cell(20, 5, $datos [0] ['a11'], 1, 0, 'C');
            $this->pdf->Ln(5);

 

            /*FOOTER PARTE A*/
            $this->pdf->SetFont('Arial', 'B', 8);
            $this->pdf->Cell(151, 5, '', 0, 0, 'C');
            $this->pdf->Cell(20, 5, 'Total Maximo', 1, 0, 'C', true);
            $this->pdf->Cell(20, 5, $datos [0] ['suma'], 1, 0, 'C');
            $this->pdf->Ln(5);

            /*-------CAPACITACIONES Y ACTUALIZACIONES--------*/
            $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
            $this->pdf->SetFont('Arial', 'BU', 9);
            $this->pdf->Cell(40, 7, utf8_decode('FORMACIÓN CONTINUA'), '', 0, 'L', 0);
            $this->pdf->Ln(8);

            $this->pdf->SetFont('Arial', '', 8);

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->Cell(165, 5, 'Aspecto a Evaluar', 1, 0, 'C', true);
            $this->pdf->Cell(20, 5, 'Punt. Maximo', 1, 0, 'C', true);
            $this->pdf->Ln(5);

            //*** COLOCAMOS LOS DATOS EN LAS CELDAS DEL PDF ***//
            //un arreglo con su medida  a lo ancho

            $this->pdf->Cell(6, 5, '', 0, 0, 'L', false);
            $this->pdf->SetWidths(array(165,20,25));
            //un arreglo con alineacion de cada celda
            $this->pdf->SetAligns(array('C','C','C'));
            $this->pdf->Row(array(utf8_decode("b.1 Programas de Formación Docente, Actualización, Especialización o Segunda Especialización, afín al área curricular o campo de conocimiento que postula:
            - Realizado en los últimos cinco (05) años.
            - Presenciales, virtuales o semipresenciales.
            - Duración mínima de 126 horas cronológicas o 7 créditos.
            - Dos (02) puntos por cada certificación hasta un máximo de seis (6)."),utf8_decode($datos [0] ['b1'])));

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->SetWidths(array(165,20,25));
            //un arreglo con alineacion de cada celda
            $this->pdf->SetAligns(array('C','C','C'));
            $this->pdf->Row(array(utf8_decode("b.2 Cursos o Módulos de Formación Docente, afín al área curricular o campo de conocimiento que postula:
            -Realizado en los últimos cinco (05) años.
            -Presenciales, virtuales o semipresenciales.
            -Duración mínima de 36 horas cronológicas.
            -Dos (2) puntos por cada certificación hasta un máximo de cuatro (4)."),utf8_decode($datos [0] ['b2'])));

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->SetWidths(array(165,20,25));
            //un arreglo con alineacion de cada celda
            $this->pdf->SetAligns(array('C','C','C'));
            $this->pdf->Row(array(utf8_decode("b.3 Talleres de capacitación, seminarios y congresos.
            -Realizado en los últimos cinco (05) años.
            -Duración mínima de 16 horas cronológicas.
            -Presenciales, virtuales o semipresenciales.
            -Dos (2) puntos por cada certificación hasta un máximo de tres (3)."),utf8_decode($datos [0] ['b3'])));


            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->SetWidths(array(165,20,25));
            //un arreglo con alineacion de cada celda
            $this->pdf->SetAligns(array('C','C','C'));
            $this->pdf->Row(array(utf8_decode("b.4 Otros programas de formación continua, incluyendo temas de pedagogía:
            -Cursos de Ofimática igual o mayores a 24 horas o su equivalente en créditos."),utf8_decode($datos [0] ['b4'])));

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->SetWidths(array(165,20,25));
            //un arreglo con alineacion de cada celda
            $this->pdf->SetAligns(array('C','C','C'));
            $this->pdf->Row(array(utf8_decode("b.5 Otros programas de formación continua, incluyendo temas de pedagogía:
            -Certificación de dominio de idioma extranjero.
            -Mínimo Nivel Intermedio.
            -Certificación emitida por un centro de idiomas certificado."),utf8_decode($datos [0] ['b5'])));



            /*FOOTER PARTE B*/
            $this->pdf->SetFont('Arial', 'B', 8);
            $this->pdf->Cell(151, 5, '', 0, 0, 'C');
            $this->pdf->Cell(20, 5, 'Total Maximo', 1, 0, 'C', true);
            $this->pdf->Cell(20, 5, $datos [0] ['sumb'], 1, 0, 'C');
            $this->pdf->Ln(5);

            /*------------EXPERIENCIA LABORAL-------------------*/

            $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
            $this->pdf->SetFont('Arial', 'BU', 9);
            $this->pdf->Cell(40, 7, 'EXPERIENCIA LABORAL', '', 0, 'L', 0);
            $this->pdf->Ln(8);

            $this->pdf->SetFont('Arial', '', 8);

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->Cell(165, 5, 'Aspecto a Evaluar', 1, 0, 'C', true);
            $this->pdf->Cell(20, 5, 'Punt. Maximo', 1, 0, 'C', true);
            $this->pdf->Ln(5);

            $this->pdf->Cell(6, 5, '', 0, 0, 'L', false);
            $this->pdf->SetWidths(array(165,20,25));
            //un arreglo con alineacion de cada celda
            $this->pdf->SetAligns(array('C','C','C'));
            $this->pdf->Row(array(utf8_decode("c.1 Experiencia Laboral docente, en la modalidad educativa o el nivel educativo o ciclo al que postula, durante los meses de marzo a diciembre, teniendo en cuenta:
            -Corresponde 0.20 puntos por cada mes acreditado de labor en IE ubicada en zona urbana.
            -Corresponde 0.30 puntos por cada mes acreditado de labor en IE ubicada en zona de frontera.
            -Corresponde 0.30 puntos por cada mes acreditado de labor en IE ubicada en zona rural.
            -Corresponde 0.40 puntos por cada mes acreditado de labor en IE ubicada en zona VRAEM.
            c.2 Experiencia laboral como PEC:
            -Cursos de Ofimática igual o mayores a 24 horas o su equivalente en créditos."),utf8_decode($datos [0] ['c1'])));


            
            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->SetWidths(array(165,20,25));
            //un arreglo con alineacion de cada celda
            $this->pdf->SetAligns(array('C','C','C'));
            $this->pdf->Row(array(utf8_decode("c.3 Experiencia profesional como practicante: Corresponde 0.20 puntos por cada mes acreditado de labor"),utf8_decode($datos [0] ['c2'])));

            $this->pdf->SetFont('Arial', 'B', 8);
            $this->pdf->Cell(151, 5, '', 0, 0, 'L');
            $this->pdf->Cell(20, 5, 'Total Maximo', 1, 0, 'C', true);
            $this->pdf->Cell(20, 5, $datos [0] ['sumc'], 1, 0, 'C');
            $this->pdf->Ln(15);
            

            $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
            $this->pdf->SetFont('Arial', 'BU', 9);
            $this->pdf->Cell(40, 7, 'MERITOS', '', 0, 'L', 0);
            $this->pdf->Ln(8);

            $this->pdf->SetFont('Arial', '', 8);

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->Cell(165, 5, 'Aspecto a Evaluar', 1, 0, 'C', true);
            $this->pdf->Cell(20, 5, 'Punt. Maximo', 1, 0, 'C', true);
            $this->pdf->Ln(5);


            $this->pdf->Cell(6, 5, '', 0, 0, 'L', false);
            $this->pdf->SetWidths(array(165,20,25));
            //un arreglo con alineacion de cada celda
            $this->pdf->SetAligns(array('C','C','C'));
            $this->pdf->Row(array(utf8_decode("d.1 Felicitación por desempeño o trabajo destacado en el campo pedagógico:
            -Resolución Ministerial o Directoral emitida por MINEDU (3 puntos).
            -Resolución Directoral Regional o de UGEL (2 puntos).
            -Resolución Institucional (1 punto).."),utf8_decode($datos [0] ['d1'])));



            $this->pdf->SetFont('Arial', 'B', 8);
            $this->pdf->Cell(151, 5, '', 0, 0, 'L');
            $this->pdf->Cell(20, 5, 'Total Maximo', 1, 0, 'C', true);
            $this->pdf->Cell(20, 5, $datos [0] ['sumd'], 1, 0, 'C');
            $this->pdf->Ln(5);
            




            /*------------FOOTER FINAL-------------------*/
            $this->pdf->Ln(2);
            $this->pdf->SetFont('Arial', 'B', 8);

            $this->pdf->Cell(101, 5, '', 0, 0, 'C');
            $this->pdf->Cell(30, 5, 'Nota Parcial', 1, 0, 'C', true);
            $this->pdf->Cell(30, 5, 'Bonificacion', 1, 0, 'C', true);
            $this->pdf->Cell(30, 5, 'Resultado Final', 1, 0, 'C', true);
            $this->pdf->Ln(5);

            $this->pdf->SetFont('Arial', '', 8);
            $this->pdf->Cell(101, 5, '', 0, 0, 'C');
            $this->pdf->Cell(30, 5, $datos [0] ['suma_parcial'],1, 0, 'C');
            $this->pdf->Cell(30, 5, $datos [0] ['bonif'], 1, 0, 'C');

            $this->pdf->SetFont('Arial', 'B', 8);
            $this->pdf->Cell(30, 5, $datos [0] ['suma_final'], 1, 0, 'C');

            $this->pdf->Ln(2);
            $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
            $this->pdf->SetFont('Arial', 'BU', 9);
            $this->pdf->Cell(40, 7, 'OBSERVACIONES', '', 0, 'L', 0);
            $this->pdf->Ln(7);

            $this->pdf->SetFont('Arial', '', 8);
            // $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
            // $this->pdf->Cell(0, 7, strtoupper(utf8_decode($datos [0] ['obs'])), '', 0, 'L', 0);
            $this->pdf->Cell(6, 5, '', 0, 0, 'L', false);
            $this->pdf->SetWidths(array(185,20,25));
                //un arreglo con alineacion de cada celda
            $this->pdf->SetAligns(array('C','C','C'));
            $this->pdf->Row(array(utf8_decode($datos [0] ['obs'])));

            // $this->pdf->Ln(70);
            // $this->pdf->Cell(90, 0, utf8_decode('Comision de contratacion docente 2018 - UGEL 04 '), '', 0, 'L', 0);
            $this->pdf->Ln(18);
            $this->pdf->SetFont('Arial', '', 9);
            $this->pdf->Cell(90, 0, utf8_decode('Comision de contratacion docente ' .date('Y'). ' - ' .date("d/m/y". " " ).'UGEL N° 05 - SJL'), '', 0, 'L', 0);
            $this->pdf->Ln(5);
            $this->pdf->Cell(90, 0, utf8_decode('Registrado - ' .$datos [0] ['fecha_exacta']), '', 0, 'L', 0);

            $this->pdf->Output("Reporte_Evaluacion_Personal.pdf", 'I');
            ob_end_flush();
    }

    public function reporte_personal_pdf_do() {
        //*******  LLAMARA A LA LIBRERIA - PDF  ********//
        $this->load->library('Pdf3');

        $id = $this->input->get('conv');

        $datos = $this->evaluacion_expediente->reporte_personal_pdf_do($id);
        $this->db->reconnect();
        ob_start();
        $this->pdf = new Pdf ();
        // Agregamos una página
        $this->pdf->AddPage('');
        // Define el alias para el número de página que se imprimirá en el pie
        $this->pdf->AliasNbPages();
        /*
         * Se define el titulo, márgenes izquierdo, derecho y
         * el color de relleno predeterminado
         */

        $this->pdf->SetFont('Arial', 'BU', 15);

        $this->pdf->Cell(180, 8, utf8_decode('REPORTE DE EVALUACIÓN - ANEXO 8B '), 0, 0, 'C');

        $this->pdf->Ln(7);

        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', 'BU', 9);
        $this->pdf->Cell(40, 7, 'DATOS PERSONALES', '', 0, 'L', 0);
        $this->pdf->Cell(135, 7, 'EVALUADO POR', '', 0, 'R', 0);
        $this->pdf->Ln(6);

        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, 'DNI', '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(0, 7, utf8_decode($datos [0] ['dni']), '', 0, 'L', 0);
        $nombre_especialista = strtoupper($datos [0] ['nombre_completo']);
        $this->pdf->Cell(1, 7, utf8_decode($nombre_especialista), '', 0, 'R', 0);
        $this->pdf->Ln(4);

        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, 'NOMBRE COMPLETO', '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(0, 7, utf8_decode($datos [0] ['nombres']), '', 0, 'L', 0);
        $this->pdf->Cell(1, 7, utf8_decode($datos [0] ['descripcion_rol']), '', 0, 'R', 0);
        $this->pdf->Ln(6);

        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', 'BU', 9);
        $this->pdf->Cell(40, 7, 'DATOS CONVOCATORIA', '', 0, 'L', 0);
        $this->pdf->Ln(6);

        // $this->pdf->SetFont('Arial', '', 8);
        // $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        // $this->pdf->Cell(40, 7, 'NIVEL', '', 0, 'L', 0);
        // $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        // $this->pdf->Cell(0, 7, utf8_decode($datos [0] ['nivel']), '', 0, 'L', 0);
        // $this->pdf->Ln(4);

        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, 'ESPECIALIDAD', '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(0, 7, utf8_decode($datos [0] ['especialidad_completa']), '', 0, 'L', 0);

        $this->pdf->Ln(6);

        $this->pdf->SetFillColor(212, 212, 212);
        $this->pdf->SetTextColor(0, 0, 0);

        $this->pdf->setfont('Arial', 'B', 9);

        /*-------------------FORMACION PROFESIONAL-------------------*/
            $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
            $this->pdf->SetFont('Arial', 'BU', 9);
            $this->pdf->Cell(40, 7, utf8_decode('FORMACION ACADÉMICA'), '', 0, 'L', 0);
            $this->pdf->SetFont('Arial', 'B', 9);
            $this->pdf->Cell(255, 7, 'NUM. EXP: '.utf8_decode($datos [0] ['num_exp']), '', 0, 'C', 0);
            // $this->pdf->Cell(100, 7, 'NUM. EXP: '.utf8_decode($datos [0] ['especialidad_completa']), '', 0, 'L', 0);
            $this->pdf->Ln(8);

            $this->pdf->SetFont('Arial', '', 8);

            $dni = utf8_decode($datos[0]['dni']);
            $nombres = utf8_decode($datos[0]['nombres']);
            $suma = utf8_decode($datos[0]['suma']);
            $sumb = utf8_decode($datos[0]['sumb']);
            $sumc = utf8_decode($datos[0]['sumc']);
            $bonif = utf8_decode($datos[0]['bonif']);
            $suma_final = utf8_decode($datos[0]['suma_final']);

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->Cell(165, 5, 'Aspecto a Evaluar', 1, 0, 'C', true);
            $this->pdf->Cell(20, 5, 'Punt. Maximo', 1, 0, 'C', true);
            $this->pdf->Ln(5);

            //*** COLOCAMOS LOS DATOS EN LAS CELDAS DEL PDF ***//
            $this->pdf->Cell(6, 5, '', 0, 0,'R', false);
            $this->pdf->Cell(165, 5, utf8_decode('a.1 Título Profesional Pedagógico'), 1, 0, 'C');
            $this->pdf->Cell(20, 5, $datos [0] ['a1'], 1, 0, 'C');
            $this->pdf->Ln(5);

            $this->pdf->Cell(6, 5, '', 0, 'B', 'C', false);
            $this->pdf->Cell(165, 5, utf8_decode('a.2 Título de Segunda Especialidad- en la especialidad requerida (excluyente con a.1)'), 1, 0, 'C');
            $this->pdf->Cell(20, 5, $datos [0] ['a2'], 1, 0, 'C');
            $this->pdf->Ln(5);

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->Cell(165, 5, utf8_decode('a.3 Título de Segunda Especialidad- en la especialidad requerida (excluyente con a.1)'), 1, 0, 'C');
            $this->pdf->Cell(20, 5, $datos [0] ['a3'], 1, 0, 'C');
            $this->pdf->Ln(5);

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->Cell(165, 5, utf8_decode('a.4 Grado de Bachiller en Educación, sin título de profesor o licenciado en Educación.'), 1, 0, 'C');
            $this->pdf->Cell(20, 5, $datos [0] ['a4'], 1, 0, 'C');
            $this->pdf->Ln(5);

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->Cell(165, 5, utf8_decode('a.5 Grado de Bachiller sin título profesional, salvo el título profesional corresponda a otra carrera y no a complementación académica.'), 1, 0, 'C');
            $this->pdf->Cell(20, 5, $datos [0] ['a5'], 1, 0, 'C');
            $this->pdf->Ln(5);

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->Cell(165, 5, utf8_decode('a.6 Egresado de educación de universidad o de instituto superior pedagógico, sin título profesional pedagógico.'), 1, 0, 'C');
            $this->pdf->Cell(20, 5, $datos [0] ['a6'], 1, 0, 'C');
            $this->pdf->Ln(5);

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->Cell(165, 5, utf8_decode('a.7 Título Profesional Técnico'), 1, 0, 'C');
            $this->pdf->Cell(20, 5, $datos [0] ['a7'], 1, 0, 'C');
            $this->pdf->Ln(5);

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->Cell(165, 5, utf8_decode('a.8 Estudios de educación mínimo VIII ciclo, sin ser egresados.'), 1, 0, 'C');
            $this->pdf->Cell(20, 5, $datos [0] ['a8'], 1, 0, 'C');
            $this->pdf->Ln(5);

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->Cell(165, 5, utf8_decode('a.9 Estudios concluidos de segunda especialidad.'), 1, 0, 'C');
            $this->pdf->Cell(20, 5, $datos [0] ['a9'], 1, 0, 'C');
            $this->pdf->Ln(5);


            $this->pdf->Cell(6, 5, '', 0, 0, 'C');
            $this->pdf->Cell(165, 5, utf8_decode('a.10 Diplomado otorgado por universidades (hasta un máximo de dos (02) diplomados)*'), 1, 0, 'C');
            $this->pdf->Cell(20, 5, $datos [0] ['a10'], 1, 0, 'C');
            $this->pdf->Ln(5);


            $this->pdf->Cell(6, 5, '', 0, 0, 'C');
            $this->pdf->Cell(165, 5, utf8_decode('a.11 Estudios de pregrado o posgrado en educación financiados a través de PRONABEC'), 1, 0, 'C');
            $this->pdf->Cell(20, 5, $datos [0] ['a11'], 1, 0, 'C');
            $this->pdf->Ln(5);


            $this->pdf->Cell(6, 5, '', 0, 0, 'C');
            $this->pdf->Cell(165, 5, utf8_decode('a.12 Constancia de pertenecer al tercio superior de su promoción de estudios pedagógicos.'), 1, 0, 'C');
            $this->pdf->Cell(20, 5, $datos [0] ['a12'], 1, 0, 'C');
            $this->pdf->Ln(5);

            /*FOOTER PARTE A*/
            $this->pdf->SetFont('Arial', 'B', 8);
            $this->pdf->Cell(151, 5, '', 0, 0, 'C');
            $this->pdf->Cell(20, 5, 'Total Maximo', 1, 0, 'C', true);
            $this->pdf->Cell(20, 5, $datos [0] ['suma'], 1, 0, 'C');
            $this->pdf->Ln(5);

            /*-------CAPACITACIONES Y ACTUALIZACIONES--------*/
            $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
            $this->pdf->SetFont('Arial', 'BU', 9);
            $this->pdf->Cell(40, 7, utf8_decode('FORMACIÓN PROFESIONAL'), '', 0, 'L', 0);
            $this->pdf->Ln(8);

            $this->pdf->SetFont('Arial', '', 8);

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->Cell(165, 5, 'Aspecto a Evaluar', 1, 0, 'C', true);
            $this->pdf->Cell(20, 5, 'Punt. Maximo', 1, 0, 'C', true);
            $this->pdf->Ln(5);

            //*** COLOCAMOS LOS DATOS EN LAS CELDAS DEL PDF ***//
            //un arreglo con su medida  a lo ancho

            $this->pdf->Cell(6, 5, '', 0, 0, 'L', false);
            $this->pdf->SetWidths(array(165,20,25));
            //un arreglo con alineacion de cada celda
            $this->pdf->SetAligns(array('C','C','C'));
            $this->pdf->Row(array(utf8_decode("b.1 Programas de Formación Docente, Actualización, Especialización o Segunda Especialización, afín a la modalidad y nivel al que postula: - Realizado en los últimos cinco (05) años. - Presenciales, virtuales o semipresenciales - Duración mínima de 126 horas cronológicas o 7 créditos. - Dos (02) puntos por cada uno de ellos."),utf8_decode($datos [0] ['b1'])));

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->SetWidths(array(165,20,25));
            //un arreglo con alineacion de cada celda
            $this->pdf->SetAligns(array('C','C','C'));
            $this->pdf->Row(array(utf8_decode("b.2 Cursos o Módulos de Formación Docente, afín a la modalidad y nivel al que postula: - Realizado en los últimos cinco (05) años. - Presenciales, virtuales o semipresenciales. - Duración mínima de 36 horas cronológicas. - Dos (02) puntos por cada uno de ellos."),utf8_decode($datos [0] ['b2'])));

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->SetWidths(array(165,20,25));
            //un arreglo con alineacion de cada celda
            $this->pdf->SetAligns(array('C','C','C'));
            $this->pdf->Row(array(utf8_decode("b.3 Talleres de capacitación, seminarios y congresos - Realizado en los últimos cinco (05) años. - Duración mínima de 16 horas cronológicas. - Presenciales. - Dos (02) puntos por cada uno de ellos."),utf8_decode($datos [0] ['b3'])));

            /*FOOTER PARTE B*/
            $this->pdf->SetFont('Arial', 'B', 8);
            $this->pdf->Cell(151, 5, '', 0, 0, 'C');
            $this->pdf->Cell(20, 5, 'Total Maximo', 1, 0, 'C', true);
            $this->pdf->Cell(20, 5, $datos [0] ['sumb'], 1, 0, 'C');
            $this->pdf->Ln(5);

            /*------------EXPERIENCIA LABORAL-------------------*/

            $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
            $this->pdf->SetFont('Arial', 'BU', 9);
            $this->pdf->Cell(40, 7, 'EXPERIENCIA LABORAL', '', 0, 'L', 0);
            $this->pdf->Ln(8);

            $this->pdf->SetFont('Arial', '', 8);

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->Cell(165, 5, 'Aspecto a Evaluar', 1, 0, 'C', true);
            $this->pdf->Cell(20, 5, 'Punt. Maximo', 1, 0, 'C', true);
            $this->pdf->Ln(5);

            $this->pdf->Cell(6, 5, '', 0, 0, 'L', false);
            $this->pdf->SetWidths(array(165,20,25));
            //un arreglo con alineacion de cada celda
            $this->pdf->SetAligns(array('C','C','C'));
            $this->pdf->Row(array(utf8_decode("c.1 Experiencia Laboral docente, en el nivel, ciclo y modalidad educativa al que postula, durante los meses de marzo a diciembre, teniendo en cuenta, durante los meses de marzo a diciembre, teniendo en cuenta: -Corresponde 0.20 puntos por cada mes acreditado de labor en IE ubicada en zona urbana. -Corresponde 0.30 puntos por cada mes acreditado de labor en IE ubicada en zona de frontera. -Corresponde 0.30 puntos por cada mes acreditado de labor en IE ubicada en zona rural. -Corresponde 0.40 puntos por cada mes acreditado de labor en IE ubicada en zona VRAEM. -Máximo a considerar 50 meses --Máximo a considerar 10 meses por cada año lectivo. -Un mes equivale a 30 días -No corresponde puntaje por periodos menores a 30 días, ni es acumulable los días para completar un mes (30 días)."),utf8_decode($datos [0] ['c1'])));

            $this->pdf->SetFont('Arial', 'B', 8);
            $this->pdf->Cell(151, 5, '', 0, 0, 'L');
            $this->pdf->Cell(20, 5, 'Total Maximo', 1, 0, 'C', true);
            $this->pdf->Cell(20, 5, $datos [0] ['sumc'], 1, 0, 'C');
            $this->pdf->Ln(5);


            /*------------FOOTER FINAL-------------------*/
            $this->pdf->Ln(2);
            $this->pdf->SetFont('Arial', 'B', 8);

            $this->pdf->Cell(101, 5, '', 0, 0, 'C');
            $this->pdf->Cell(30, 5, 'Nota Parcial', 1, 0, 'C', true);
            $this->pdf->Cell(30, 5, 'Bonificacion', 1, 0, 'C', true);
            $this->pdf->Cell(30, 5, 'Resultado Final', 1, 0, 'C', true);
            $this->pdf->Ln(5);

            $this->pdf->SetFont('Arial', '', 8);
            $this->pdf->Cell(101, 5, '', 0, 0, 'C');
            $this->pdf->Cell(30, 5, $datos [0] ['suma_parcial'],1, 0, 'C');
            $this->pdf->Cell(30, 5, $datos [0] ['bonif'], 1, 0, 'C');

            $this->pdf->SetFont('Arial', 'B', 8);
            $this->pdf->Cell(30, 5, $datos [0] ['suma_final'], 1, 0, 'C');

            $this->pdf->Ln(2);
            $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
            $this->pdf->SetFont('Arial', 'BU', 9);
            $this->pdf->Cell(40, 7, 'OBSERVACIONES', '', 0, 'L', 0);
            $this->pdf->Ln(7);

            $this->pdf->SetFont('Arial', '', 8);
            // $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
            // $this->pdf->Cell(0, 7, strtoupper(utf8_decode($datos [0] ['obs'])), '', 0, 'L', 0);
            $this->pdf->Cell(6, 5, '', 0, 0, 'L', false);
            $this->pdf->SetWidths(array(185,20,25));
                //un arreglo con alineacion de cada celda
            $this->pdf->SetAligns(array('C','C','C'));
            $this->pdf->Row(array(utf8_decode($datos [0] ['obs'])));

            // $this->pdf->Ln(70);
            // $this->pdf->Cell(90, 0, utf8_decode('Comision de contratacion docente 2018 - UGEL 04 '), '', 0, 'L', 0);
            $this->pdf->Ln(18);
            $this->pdf->SetFont('Arial', '', 9);
            $this->pdf->Cell(90, 0, utf8_decode('Comision de contratacion docente ' .date('Y'). ' - ' .date("d/m/y". " " ).'UGEL N° 05 - SJL'), '', 0, 'L', 0);
            $this->pdf->Ln(5);
            $this->pdf->Cell(90, 0, utf8_decode('Registrado - ' .$datos [0] ['fecha_exacta']), '', 0, 'L', 0);

            $this->pdf->Output("Reporte_Evaluacion_Personal_FaseIII.pdf", 'I');
            ob_end_flush();
    }

    public function reporte_personal_pdf_ce() {
        //*******  LLAMARA A LA LIBRERIA - PDF  ********//
        $this->load->library('Pdf3');

        $id = $this->input->get('conv');

        $datos = $this->evaluacion_expediente->reporte_personal_pdf_ce($id);
        $this->db->reconnect();
        ob_start();
        $this->pdf = new Pdf ();
        // Agregamos una página
        $this->pdf->AddPage('');
        // Define el alias para el número de página que se imprimirá en el pie
        $this->pdf->AliasNbPages();
        /*
         * Se define el titulo, márgenes izquierdo, derecho y
         * el color de relleno predeterminado
         */

        $this->pdf->SetFont('Arial', 'BU', 15);

        $this->pdf->Cell(180, 8, 'REPORTE DE EVALUACION - CETPRO ', 0, 0, 'C');

        $this->pdf->Ln(7);

        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', 'BU', 9);
        $this->pdf->Cell(40, 7, 'DATOS PERSONALES', '', 0, 'L', 0);
        $this->pdf->Cell(100, 7, 'EVALUADO POR', '', 0, 'R', 0);
        $this->pdf->Ln(6);

        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, 'DNI', '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(0, 7, utf8_decode($datos [0] ['dni']), '', 0, 'L', 0);
        $nombre_especialista = strtoupper($datos [0] ['nombre_completo']);
        $this->pdf->Cell(1, 7, utf8_decode($nombre_especialista), '', 0, 'R', 0);
        $this->pdf->Ln(4);

        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, 'NOMBRE COMPLETO', '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(0, 7, utf8_decode($datos [0] ['nombres']), '', 0, 'L', 0);
        $this->pdf->Cell(1, 7, utf8_decode($datos [0] ['descripcion_rol']), '', 0, 'R', 0);
        $this->pdf->Ln(6);

        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', 'BU', 9);
        $this->pdf->Cell(40, 7, 'DATOS CONVOCATORIA', '', 0, 'L', 0);
        $this->pdf->Ln(6);

        // $this->pdf->SetFont('Arial', '', 8);
        // $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        // $this->pdf->Cell(40, 7, 'NIVEL', '', 0, 'L', 0);
        // $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        // $this->pdf->Cell(0, 7, utf8_decode($datos [0] ['nivel']), '', 0, 'L', 0);
        // $this->pdf->Ln(4);

        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, 'ESPECIALIDAD', '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(0, 7, utf8_decode($datos [0] ['especialidad_completa']), '', 0, 'L', 0);

        $this->pdf->Ln(6);

        $this->pdf->SetFillColor(212, 212, 212);
        $this->pdf->SetTextColor(0, 0, 0);

        $this->pdf->setfont('Arial', 'B', 9);

        /*-------------------FORMACI0N ACADEMICA-------------------*/
            $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
            $this->pdf->SetFont('Arial', 'BU', 9);
            $this->pdf->Cell(40, 7, utf8_decode('FORMACION ACADÉMICA'), '', 0, 'L', 0);
            $this->pdf->SetFont('Arial', 'B', 9);
            $this->pdf->Cell(255, 7, 'NUM. EXP: '.utf8_decode($datos [0] ['num_exp']), '', 0, 'C', 0);
            $this->pdf->Ln(5);

            $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
            $this->pdf->SetFont('Arial', 'B', 9);
            $this->pdf->Cell(40, 7, utf8_decode('1.1 Estudios de pregrado'), '', 0, 'L', 0);
            $this->pdf->Ln(8);

            $this->pdf->SetFont('Arial', '', 8);

            $dni = utf8_decode($datos[0]['dni']);
            $nombres = utf8_decode($datos[0]['nombres']);
            $suma = utf8_decode($datos[0]['suma']);
            $sumb = utf8_decode($datos[0]['sumb']);
            $sumc = utf8_decode($datos[0]['sumc']);
            $bonif = utf8_decode($datos[0]['bonif']);
            $suma_final = utf8_decode($datos[0]['suma_final']);

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->Cell(165, 5, 'Aspecto a Evaluar', 1, 0, 'C', true);
            $this->pdf->Cell(20, 5, 'Punt. Maximo', 1, 0, 'C', true);
            $this->pdf->Ln(5);

            //*** COLOCAMOS LOS DATOS EN LAS CELDAS DEL PDF ***//
            $this->pdf->Cell(6, 5, '', 0, 0,'R', false);
            $this->pdf->Cell(165, 5, utf8_decode('a.1 Título profesional'), 1, 0, 'C');
            $this->pdf->Cell(20, 5, $datos [0] ['a1'], 1, 0, 'C');
            $this->pdf->Ln(5);

            $this->pdf->Cell(6, 5, '', 0, 'B', 'C', false);
            $this->pdf->Cell(165, 5, utf8_decode('a.2 Título profesional técnico'), 1, 0, 'C');
            $this->pdf->Cell(20, 5, $datos [0] ['a2'], 1, 0, 'C');
            $this->pdf->Ln(5);

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->Cell(165, 5, utf8_decode('a.3 Título técnico'), 1, 0, 'C');
            $this->pdf->Cell(20, 5, $datos [0] ['a3'], 1, 0, 'C');
            $this->pdf->Ln(5);
 
            /*-------*/
            $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
            $this->pdf->SetFont('Arial', 'B', 9);
            $this->pdf->Cell(40, 7, utf8_decode('1.2 Estudios de posgrado'), '', 0, 'L', 0);
            $this->pdf->SetFont('Arial', '', 8);
            $this->pdf->Ln(7);

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->Cell(165, 5, utf8_decode('a.4 Grado de doctor'), 1, 0, 'C');
            $this->pdf->Cell(20, 5, $datos [0] ['a4'], 1, 0, 'C');
            $this->pdf->Ln(5);

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->Cell(165, 5, utf8_decode('a.5 Estudios concluidos de doctorado'), 1, 0, 'C');
            $this->pdf->Cell(20, 5, $datos [0] ['a5'], 1, 0, 'C');
            $this->pdf->Ln(5);

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->Cell(165, 5, utf8_decode('a.6 Grado de maestro/magíster'), 1, 0, 'C');
            $this->pdf->Cell(20, 5, $datos [0] ['a6'], 1, 0, 'C');
            $this->pdf->Ln(5);

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->Cell(165, 5, utf8_decode('a.7 Estudios concluidos de maestría'), 1, 0, 'C');
            $this->pdf->Cell(20, 5, $datos [0] ['a7'], 1, 0, 'C');
            $this->pdf->Ln(5);
            

            /*FOOTER PARTE A*/
            $this->pdf->SetFont('Arial', 'B', 8);
            $this->pdf->Cell(151, 5, '', 0, 0, 'C');
            $this->pdf->Cell(20, 5, 'Total Maximo', 1, 0, 'C', true);
            $this->pdf->Cell(20, 5, $datos [0] ['suma'], 1, 0, 'C');
            $this->pdf->Ln(7);

            /*-------*/
            $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
            $this->pdf->SetFont('Arial', 'B', 9);
            $this->pdf->Cell(40, 7, utf8_decode('1.3 Capacitación y actualización en la especialidad'), '', 0, 'L', 0);
            $this->pdf->SetFont('Arial', '', 8);
            $this->pdf->Ln(7);

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->Cell(165, 5, utf8_decode('b.1 Programas afi nes a la especialidad con duración mayor a 96 horas o su equivalente en créditos.'), 1, 0, 'C');
            $this->pdf->Cell(20, 5, $datos [0] ['b1'], 1, 0, 'C');
            $this->pdf->Ln(5);

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->Cell(165, 5, utf8_decode('b.2 Programas afi nes a la especialidad con duración igual o mayor a 16 horas y hasta 96 horas o su equivalente en créditos.'), 1, 0, 'C');
            $this->pdf->Cell(20, 5, $datos [0] ['b2'], 1, 0, 'C');
            $this->pdf->Ln(7);

            /*-------*/
            $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
            $this->pdf->SetFont('Arial', 'B', 9);
            $this->pdf->Cell(40, 7, utf8_decode('1.4 Otros programas de formación continua, incluyendo temas de pedagogía'), '', 0, 'L', 0);
            $this->pdf->SetFont('Arial', '', 8);
            $this->pdf->Ln(7);

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->Cell(165, 5, utf8_decode('b.3 Programas con duración mayor a 96 horas o su equivalente en créditos'), 1, 0, 'C');
            $this->pdf->Cell(20, 5, $datos [0] ['b3'], 1, 0, 'C');
            $this->pdf->Ln(5);

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->Cell(165, 5, utf8_decode('b.4 Programas con duración igual o mayor a 16 horas y hasta 96 horas o su equivalente en créditos'), 1, 0, 'C');
            $this->pdf->Cell(20, 5, $datos [0] ['b4'], 1, 0, 'C');
            $this->pdf->Ln(5);

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->Cell(165, 5, utf8_decode('b.5 Cursos de Ofi mática igual o mayores a 24 horas o su equivalente en créditos'), 1, 0, 'C');
            $this->pdf->Cell(20, 5, $datos [0] ['b5'], 1, 0, 'C');
            $this->pdf->Ln(5);

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->Cell(165, 5, utf8_decode('b.6 Certificación de dominio del idioma inglés'), 1, 0, 'C');
            $this->pdf->Cell(20, 5, $datos [0] ['b6'], 1, 0, 'C');
            $this->pdf->Ln(5);

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->Cell(165, 5, utf8_decode('b.7 Lenguas Originarias'), 1, 0, 'C');
            $this->pdf->Cell(20, 5, $datos [0] ['b7'], 1, 0, 'C');
            $this->pdf->Ln(5);

            /*FOOTER PARTE B*/
            $this->pdf->SetFont('Arial', 'B', 8);
            $this->pdf->Cell(151, 5, '', 0, 0, 'C');
            $this->pdf->Cell(20, 5, 'Total Maximo', 1, 0, 'C', true);
            $this->pdf->Cell(20, 5, $datos [0] ['sumb'], 1, 0, 'C');
            $this->pdf->Ln(5);

            /*-------EXPERIENCIA PROFESIONAL--------*/
            $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
            $this->pdf->SetFont('Arial', 'BU', 9);
            $this->pdf->Cell(40, 7, utf8_decode('EXPERIENCIA PROFESIONAL'), '', 0, 'L', 0);
            $this->pdf->Ln(7);
            $this->pdf->SetFont('Arial', '', 8);

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->Cell(165, 5, 'Aspecto a Evaluar', 1, 0, 'C', true);
            $this->pdf->Cell(20, 5, 'Punt. Maximo', 1, 0, 'C', true);
            $this->pdf->Ln(5);

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->Cell(165, 5, utf8_decode('c.1 Experiencia laboral en el sector productivo (instituciones públicas o privadas)'), 1, 0, 'C');
            $this->pdf->Cell(20, 5, $datos [0] ['c1'], 1, 0, 'C');
            $this->pdf->Ln(5);

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->Cell(165, 5, utf8_decode('c.2 Experiencia docente en Educación Superior o Técnico – productiva'), 1, 0, 'C');
            $this->pdf->Cell(20, 5, $datos [0] ['c2'], 1, 0, 'C');
            $this->pdf->Ln(5);

            /*FOOTER PARTE C*/
            $this->pdf->SetFont('Arial', 'B', 8);
            $this->pdf->Cell(151, 5, '', 0, 0, 'C');
            $this->pdf->Cell(20, 5, 'Total Maximo', 1, 0, 'C', true);
            $this->pdf->Cell(20, 5, $datos [0] ['sumc'], 1, 0, 'C');
            $this->pdf->Ln(3);

            /*-----------------MÉRITOS-------------------*/
            $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
            $this->pdf->SetFont('Arial', 'BU', 9);
            $this->pdf->Cell(40, 7, utf8_decode('MÉRITOS'), '', 0, 'L', 0);
            $this->pdf->Ln(7);
            $this->pdf->SetFont('Arial', '', 8);

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->Cell(165, 5, 'Aspecto a Evaluar', 1, 0, 'C', true);
            $this->pdf->Cell(20, 5, 'Punt. Maximo', 1, 0, 'C', true);
            $this->pdf->Ln(5);

            $this->pdf->Cell(6, 5, '', 0, 0, 'C', false);
            $this->pdf->Cell(165, 5, utf8_decode('d.1 Reconocimiento o felicitación por logro o contribución en la gestión o práctica pedagógica o proyecto de innovación'), 1, 0, 'C');
            $this->pdf->Cell(20, 5, $datos [0] ['d1'], 1, 0, 'C');
            $this->pdf->Ln(5);

            /*FOOTER PARTE D*/
            $this->pdf->SetFont('Arial', 'B', 8);
            $this->pdf->Cell(151, 5, '', 0, 0, 'C');
            $this->pdf->Cell(20, 5, 'Total Maximo', 1, 0, 'C', true);
            $this->pdf->Cell(20, 5, $datos [0] ['sumd'], 1, 0, 'C');
            $this->pdf->Ln(5);    


            /*------------FOOTER FINAL-------------------*/
            $this->pdf->Ln(2);
            $this->pdf->SetFont('Arial', 'B', 8);

            $this->pdf->Cell(101, 5, '', 0, 0, 'C');
            $this->pdf->Cell(30, 5, 'Nota Parcial', 1, 0, 'C', true);
            $this->pdf->Cell(30, 5, 'Bonificacion', 1, 0, 'C', true);
            $this->pdf->Cell(30, 5, 'Resultado Final', 1, 0, 'C', true);
            $this->pdf->Ln(5);

            $this->pdf->SetFont('Arial', '', 8);
            $this->pdf->Cell(101, 5, '', 0, 0, 'C');
            $this->pdf->Cell(30, 5, $datos [0] ['suma_parcial'],1, 0, 'C');
            $this->pdf->Cell(30, 5, $datos [0] ['bonif'], 1, 0, 'C');

            $this->pdf->SetFont('Arial', 'B', 8);
            $this->pdf->Cell(30, 5, $datos [0] ['suma_final'], 1, 0, 'C');

            $this->pdf->Ln(6);
            $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
            $this->pdf->SetFont('Arial', 'BU', 9);
            $this->pdf->Cell(40, 7, 'OBSERVACIONES', '', 0, 'L', 0);
            $this->pdf->Ln(5);

            $this->pdf->SetFont('Arial', '', 8);
            $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
            $this->pdf->Cell(0, 7, strtoupper(utf8_decode($datos [0] ['obs'])), '', 0, 'L', 0);

            // $this->pdf->Ln(70);
            // $this->pdf->Cell(90, 0, utf8_decode('Comision de contratacion docente 2018 - UGEL 04 '), '', 0, 'L', 0);
            $this->pdf->Ln(21);
            $this->pdf->SetFont('Arial', '', 9);
            $this->pdf->Cell(90, 0, utf8_decode('Comision de contratacion docente ' .date('Y'). ' - ' .date("d/m/y". " " ).'UGEL N° 05 - SJL'), '', 0, 'L', 0);
            $this->pdf->Ln(5);
            $this->pdf->Cell(90, 0, utf8_decode('Registrado - ' .$datos [0] ['fecha_exacta']), '', 0, 'L', 0);

            $this->pdf->Output("Reporte_Evaluacion_Personal_Cetpro.pdf", 'I');
            ob_end_flush();
    }

    public function reporte_personalizado() {
        //*******  LLAMARA A LA LIBRERIA - PDF  ********//
        $this->load->library('pdf');
        //****** OBTENEMOS LOS DATOS DEL MODAL *******//
        $fecha = $this->input->get('fecha');
        $etapa = $this->input->get('etapa');
        $modalidadb = $this->input->get('modalidadb');
        $nivelb = $this->input->get('nivelb');
        $espec = $this->input->get('espec');
        $ie = $this->input->get('ie');
        $datos = $this->plaza->obtener_reporte($fecha, $etapa, $modalidadb, $nivelb, $espec, $ie);
        $this->db->reconnect();
        if (empty($datos)) {
            redirect("documento/reporte_personalizado/" . $fecha, "refresh");
        }
        ob_start();
        $this->pdf = new Pdf2 ();
        // Agregamos una página
        $this->pdf->AddPage('L');
        // Define el alias para el número de página que se imprimirá en el pie
        $this->pdf->AliasNbPages();
        /*
         * Se define el titulo, márgenes izquierdo, derecho y
         * el color de relleno predeterminado
         */
        $this->pdf->SetFont('Arial', 'BU', 12);
        $modo = 1;
        //$titulo = ($datos [0] ['etapaID'] == 1) ? 'ACTA DE ADJUDICACIÓN' : 'ACTA DE ADJUDICACIÓN EXCEPCIONAL';
        if (!empty($fecha)) {
            $this->pdf->Cell(280, 8, 'PLAZAS ADJUDICADAS EL ' . $fecha, 0, 0, 'C');
        }if (!empty($etapa)) {
            $this->pdf->Cell(280, 8, 'PLAZAS ADJUDICADAS EN ' . utf8_decode($datos [0] ['etapa']), 0, 0, 'C');
        }if ($nivelb == '--SELECCIONE NIVEL--') {
            $this->pdf->Cell(280, 8, 'PLAZAS ADJUDICADAS DE ' . utf8_decode($datos [0] ['modalidad']), 0, 0, 'C');
        }if (!empty($modalidadb) && !empty($nivelb)) {
            $this->pdf->Cell(280, 8, 'PLAZAS ADJUDICADAS DE ' . utf8_decode($datos [0] ['modalidad']) . ' ' . utf8_decode($datos [0] ['nivel']), 0, 0, 'C');
        }if (!empty($espec)) {
            $this->pdf->Cell(280, 8, 'PLAZAS ADJUDICADAS POR ESPECIALIDAD', 0, 0, 'C');
        }if (!empty($ie)) {
            $this->pdf->Cell(280, 8, 'PLAZAS ADJUDICADAS POR COLEGIO', 0, 0, 'C');
        } else {
            $this->pdf->Cell(280, 8, 'PLAZAS ADJUDICADAS', 0, 0, 'C');
        }

        $this->pdf->Ln(10);

        $this->pdf->SetFillColor(212, 212, 212);
        $this->pdf->SetTextColor(0, 0, 0);

        $this->pdf->setfont('Arial', 'B', 8);


        $this->pdf->Cell(5, 5, '#', 1, 0, 'C', true);
        $this->pdf->Cell(30, 5, 'ETAPA', 1, 0, 'C', true);
        $this->pdf->Cell(20, 5, 'CODIGO', 1, 0, 'C', true);
        $this->pdf->Cell(40, 5, 'COLEGIO', 1, 0, 'C', true);
        $this->pdf->Cell(20, 5, 'MODALIDAD', 1, 0, 'C', true);
        $this->pdf->Cell(30, 5, 'NIVEL', 1, 0, 'C', true);
        $this->pdf->Cell(40, 5, 'ESPECIALIDAD', 1, 0, 'C', true);
        $this->pdf->Cell(50, 5, 'DOCENTE', 1, 0, 'C', true);
        $this->pdf->Cell(15, 5, 'DNI / CE', 1, 0, 'C', true);
        $this->pdf->Cell(25, 5, 'FECHA', 1, 0, 'C', true);
        $this->pdf->Ln(5);

        $contador = 1;

        for ($i = 0; $i < count($datos); $i++) {

            $this->pdf->SetFont('Arial', '', 6);

            $etapa = $datos[$i]['etapa'];
            $codigoPlaza = $datos[$i]['codigoPlaza'];
            $ie = utf8_decode($datos[$i]['ie']);
            $modalidad = utf8_decode($datos[$i]['modalidad']);
            $nivel = utf8_decode($datos[$i]['nivel']);
            $especialida = utf8_decode($datos[$i]['especialidad']);
            $nombres = utf8_decode($datos[$i]['nombres']);
            $dcumento = utf8_decode($datos[$i]['numDoc']);
            $fecha = $datos[$i]['fechaAsignacion'];

            //*** COLOCAMOS LOS DATOS EN LAS CELDAS DEL PDF ***//
            $this->pdf->Cell(5, 5, $contador, 1, 0, 'C');
            $this->pdf->Cell(30, 5, $etapa, 1, 0, 'C');
            $this->pdf->Cell(20, 5, $codigoPlaza, 1, 0, 'C');
            $this->pdf->Cell(40, 5, $ie, 1, 0, 'C');
            $this->pdf->Cell(20, 5, $modalidad, 1, 0, 'C');
            $this->pdf->Cell(30, 5, $nivel, 1, 0, 'C');
            $this->pdf->Cell(40, 5, $especialida, 1, 0, 'C');
            $this->pdf->Cell(50, 5, $nombres, 1, 0, 'C');
            $this->pdf->Cell(15, 5, $dcumento, 1, 0, 'C');
            $this->pdf->Cell(25, 5, $fecha, 1, 0, 'C');
            $this->pdf->Ln(5);
            $contador++;
        }
        $this->pdf->Output("Acta.pdf", 'I');
        ob_end_flush();
    }

    /** REPROTE INDIVIDUAL * */
    public function adjudicacion_plaza() {
        //*******  LLAMARA A LA LIBRERIA - PDF  ********//
        $this->load->library('pdf');
        $adjudicacionID = $this->input->get('id');
        //****** OBTENEMOS LOS DATOS DEL MODAL *******//
        $datos = $this->plaza->obtener_datos_adj($adjudicacionID);
        $this->db->reconnect();
        if (empty($datos)) {
            redirect("adjudicacion/adjudicacion_plaza/" . $adjudicacionID, "refresh");
        }
        ob_start();
        $this->pdf = new Pdf ();
        // Agregamos una página
        $this->pdf->AddPage('');
        // Define el alias para el número de página que se imprimirá en el pie
        $this->pdf->AliasNbPages();
        /*
         * Se define el titulo, márgenes izquierdo, derecho y
         * el color de relleno predeterminado
         */
        $this->pdf->SetFont('Arial', 'BU', 15);
        $modo = 1;
        //$titulo = ($datos [0] ['etapaID'] == 1) ? 'ACTA DE ADJUDICACIÓN' : 'ACTA DE ADJUDICACIÓN EXCEPCIONAL';
        $this->pdf->Cell(0, 10, utf8_decode('REPORTE INDIVIDUAL DE ADJUDICACIÓN'), 0, 0, 'C');
        $this->pdf->Ln(6);
        //******* SUBTITULO DEL DOCENTE********//
        $this->pdf->Ln(8);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', 'BU', 9);
        $this->pdf->Cell(40, 7, utf8_decode('DATOS DEL DOCENTE'), '', 0, 'L', 0);
        $this->pdf->SetFont('Arial', '', 8);
        //******* NOMBRES ********//
        $this->pdf->Ln(7);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, 'Profesor', '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(0, 7, utf8_decode($datos [0] ['nombres']), '', 0, 'L', 0);
        //******* NUMERO DE DOCUMENTO ********//
        $this->pdf->Ln(4);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, utf8_decode('Número de ' . $datos [0] ['tipodoc']), '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(0, 7, utf8_decode($datos [0] ['numDoc']), '', 0, 'L', 0);
        //******* NUMERO DE EXPEDIENTE ********//
        $this->pdf->Ln(4);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, utf8_decode('Número de Expediente'), '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(0, 7, utf8_decode($datos [0] ['numExpediente']), '', 0, 'L', 0);
        //******* FECHA DE INICIO ********//
        $this->pdf->Ln(4);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, utf8_decode('Fecha de Inicio'), '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(0, 7, utf8_decode($datos [0] ['fechaInicio']), '', 0, 'L', 0);
        //******* FECHA DE FIN ********//
        $this->pdf->Ln(4);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, utf8_decode('Fecha Fin'), '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(0, 7, utf8_decode($datos [0] ['fechaTermino']), '', 0, 'L', 0);
        //******* FECHA DE ASIGNACION ********//
        $this->pdf->Ln(4);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, utf8_decode('Fecha de adjudicación'), '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(0, 7, utf8_decode(date_format(date_create($datos [0] ['fechaAsignacion']), "d") . ' de ' . $this->meses[date_format(date_create($datos [0] ['fechaAsignacion']), "m") - 1] . ' del ' . date('Y') . ' a las ' . date_format(date_create($datos [0] ['fechaAsignacion']), "g:i A")), '', 0, 'L', 0);
        //******* REGISTRADO POR ********//
        $this->pdf->Ln(4);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, utf8_decode('Adjudicado por'), '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(0, 7, utf8_decode($datos [0] ['registradoPor']), '', 0, 'L', 0);
        //******* SUBTITULO DE LA PLAZA ********//
        $this->pdf->Ln(8);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', 'BU', 9);
        $this->pdf->Cell(40, 7, utf8_decode('DATOS DE PLAZA'), '', 0, 'L', 0);
        $this->pdf->SetFont('Arial', '', 8);
        //******* ETAPA ********//
        $this->pdf->Ln(7);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, 'Etapa', '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(0, 7, utf8_decode($datos [0] ['etapa']), '', 0, 'L', 0);
        //******* CODIGO DE PLAZA ********//
        $this->pdf->Ln(4);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, utf8_decode('Código Único'), '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(0, 7, utf8_decode($datos [0] ['codigoPlaza']), '', 0, 'L', 0);
        //******* MOTIVO DE VACANTE ********//
        $this->pdf->Ln(4);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, 'Motivo de Vacante', '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $y = $this->pdf->GetY();
        $x = $this->pdf->GetX();
        $this->pdf->SetXY($x, $y + 1.5);
        $this->pdf->MultiCell(0, 4, utf8_decode($datos [0] ['motivoVacante']), 0, 'L', 0);
        $y = $this->pdf->GetY();
        $x = $this->pdf->GetX();
        $this->pdf->SetXY($x, $y - 1.5);
        //******* COLEGIO ********//
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, utf8_decode('Institución Educativa'), '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(0, 7, utf8_decode($datos [0] ['ie']), '', 0, 'L', 0);
        //******* CARGO ********//
        $this->pdf->Ln(4);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, utf8_decode('Cargo'), '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(0, 7, utf8_decode($datos [0] ['cargo']), '', 0, 'L', 0);
        //******* ESPECIALIDAD ********//
        $this->pdf->Ln(4);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, utf8_decode('Área Curricular / Especialidad'), '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(0, 7, utf8_decode($datos [0] ['especialidad']), '', 0, 'L', 0);
        //******* NIVEL ********//
        $this->pdf->Ln(4);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, 'Nivel / Ciclo', '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(0, 7, utf8_decode($datos [0] ['nivel']), '', 0, 'L', 0);
        //******* MODALIDAD ********//
        $this->pdf->Ln(4);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, 'Modalidad / Forma', '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(0, 7, utf8_decode($datos [0] ['modalidad']), '', 0, 'L', 0);
        //******* CARACTERISTICA ********//
        $this->pdf->Ln(4);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, 'Caracteristica', '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(0, 7, utf8_decode($datos [0] ['caracteristica']), '', 0, 'L', 0);
        //******* TIPO ********//
        $this->pdf->Ln(4);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, 'Tipo', '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(0, 7, utf8_decode($datos [0] ['tipo']), '', 0, 'L', 0);
        //******* JORNADA ********//
        $this->pdf->Ln(4);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, 'Jornada', '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(0, 7, utf8_decode($datos [0] ['jornada']), '', 0, 'L', 0);
        //******* TIPO DE VACANTE ********//
        $this->pdf->Ln(4);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, 'Tipo de Vacante', '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(0, 7, utf8_decode($datos [0] ['tipoVacante']), '', 0, 'L', 0);

        $this->pdf->Output("Adjucacion.pdf", 'I');
        ob_end_flush();
    }

    /** INICIO - GENERACIÓN DE DOCUMENTO DE ADJUDICACIÓN (ACTA DE ADJUDICACIÓN) * */
    public function adjudicacion($id) {
        $this->load->library('pdf');
        // $convocatoriaID = $this->input->get('conv');
        // $plazaID = $this->input->get('plaza');


        $datos = []; // $this->documento->obtener_datos_acta($convocatoriaID, $plazaID);

        $detail = $this->adjudicaciones_model->f_detail($id);
        $adjudicacion = $detail['adjudicacion'];

        $postulante = $adjudicacion->postulacion;
        $convocatoria = $adjudicacion->convocatoria;
        $plaza = $adjudicacion->plaza;
        $firmas = $adjudicacion->firmas;
        $tipo_documento = $postulante->tipo_documento == 1 ? 'DNI' : 'C.E';
        // echo json_encode($firmas); exit;
        $this->db->reconnect();

        if (empty($adjudicacion)) {
            redirect("adjudicaciones");
        }
        ob_start();

        $this->pdf = new Pdf ();

        // Agregamos una página
        $this->pdf->AddPage();

        // Define el alias para el número de página que se imprimirá en el pie
        $this->pdf->AliasNbPages();

        /*
         * Se define el titulo, márgenes izquierdo, derecho y
         * el color de relleno predeterminado
         */


        $this->pdf->SetFont('Arial', 'BU', 17);
        $modo = 1;

        //$titulo = ($datos [0] ['etapaID'] == 1) ? 'ACTA DE ADJUDICACIÓN' : 'ACTA DE ADJUDICACIÓN EXCEPCIONAL';
        $this->pdf->Cell(0, 10, utf8_decode('ACTA DE ADJUDICACIÓN'), 0, 0, 'C');
        $this->pdf->Ln(6);
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Cell(0, 10, utf8_decode('CONTRATACIÓN POR RESULTADOS DE LA PN'), 0, 0, 'C');
        $this->pdf->Ln(5);
        $this->pdf->SetFont('Arial', '', 9);
        $this->pdf->Ln(10);
        // $this->Cell(20, 4,utf8_decode('De conformida con el resultado obtenido en el Proceso para Contratación de Docentes, regulado por la Norma Técnica aprobada con R.M. Nº 023-2015-MINEDU, se adjunta el cargo vacante a:'),'',0, 'L', 0);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('De conformidad con el resultado obtenido en el Proceso para Contratación de Docentes, regulado por la Norma Técnica aprobada con D.S. N° 0020-2023-MINEDU, se adjudica el cargo vacante a:'), 0);
        $this->pdf->Ln(3);

        $this->pdf->Ln(5);

        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', 'BU', 9);
        $this->pdf->Cell(40, 7, 'DATOS PERSONALES', '', 0, 'L', 0);

        $this->pdf->Ln(7);
        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, 'Apellidos y Nombres', '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(0, 7, utf8_decode($postulante->nombre), '', 0, 'L', 0);
        $this->pdf->Ln(4);

        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, utf8_decode('Número de ' . $tipo_documento), '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(0, 7, utf8_decode($postulante->numero_documento), '', 0, 'L', 0);
        $this->pdf->Ln(4);

        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, 'Puntaje', '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, $postulante->puntaje, '', 0, 'L', 0);
        $this->pdf->Cell(15, 7, 'En letras', '', 0, 'LU', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(0, 7, utf8_decode(strtoupper($this->num2letras($postulante->puntaje))), '', 0, 'L', 0);

        $this->pdf->Ln(4);

        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, utf8_decode('Etapa de contratación'), '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, 'Segunda Etapa', '', 0, 'L', 0);
        
        
        $this->pdf->Ln(8);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', 'BU', 9);
        $this->pdf->Cell(40, 7, 'DATOS DE LA VACANTE', '', 0, 'L', 0);
        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->Ln(7);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, 'Cargo', '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(0, 7, utf8_decode($plaza->cargo), '', 0, 'L', 0);
        $this->pdf->Ln(4);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, utf8_decode('Código Único'), '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(0, 7, utf8_decode($plaza->codigoPlaza), '', 0, 'L', 0);
        $this->pdf->Ln(4);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, 'Motivo de Vacante', '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $y = $this->pdf->GetY();
        $x = $this->pdf->GetX();
        $this->pdf->SetXY($x, $y + 1.5);
        $this->pdf->MultiCell(0, 4, utf8_decode($plaza->motivo_vacante), 0, 'L', 0);
        $y = $this->pdf->GetY();
        $x = $this->pdf->GetX();
        $this->pdf->SetXY($x, $y - 1.5);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, utf8_decode('Institución Educativa'), '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(0, 7, utf8_decode($plaza->ie), '', 0, 'L', 0);
        $this->pdf->Ln(4);
                
        //        --------
        //        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        //        $this->pdf->Cell(40, 7, utf8_decode('Área Curricular / Especialidad'), '', 0, 'L', 0);
        //        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        //        $this->pdf->Cell(0, 7, utf8_decode($datos [0] ['especialidad']), '', 0, 'L', 0);
        //        
        //        -----
           $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, utf8_decode('Área Curricular / Especialidad'), '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $y = $this->pdf->GetY();
        $x = $this->pdf->GetX();
        $this->pdf->SetXY($x, $y + 1.5);
        $this->pdf->MultiCell(0, 4, utf8_decode($plaza->especialidad), 0, 'L', 0);
        $y = $this->pdf->GetY();
        $x = $this->pdf->GetX();
        $this->pdf->SetXY($x, $y - 1.5);

        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);

        $this->pdf->Cell(90, 7, utf8_decode('o campo de conocimiento'), '', 0, 'L', 0);

        
        
        $this->pdf->Ln(5);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, 'Nivel / Ciclo', '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(0, 7, utf8_decode($convocatoria->nivel_nombre), '', 0, 'L', 0);
        $this->pdf->Ln(4);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, 'Modalidad / Forma', '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(0, 7, utf8_decode($convocatoria->modalidad_nombre), '', 0, 'L', 0);
        $this->pdf->Ln(4);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, 'Jornada Laboral', '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(0, 7, utf8_decode($plaza->jornada), '', 0, 'L', 0);
        $this->pdf->Ln(4);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, 'Inicio de Contrato', '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, utf8_decode($adjudicacion->fecha_inicio), '', 0, 'L', 0);
        $this->pdf->Cell(15, 7, 'Termino', '', 0, 'LU', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(0, 7, utf8_decode($adjudicacion->fecha_final), '', 0, 'L', 0);
        $this->pdf->Ln(4);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, 'Distrito', '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(0, 7, utf8_decode($postulante->distrito_nombre), '', 0, 'L', 0);
        $this->pdf->Ln(4);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, 'Provincia', '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(0, 7, utf8_decode($postulante->provincia_nombre), '', 0, 'L', 0);
        $this->pdf->Ln(4);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, 'Departamento', '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(0, 7, utf8_decode($postulante->departamento_nombre), '', 0, 'L', 0);
        $this->pdf->Ln(4);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, 'UGEL', '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->Cell(0, 7, utf8_decode('UGEL 05'), '', 0, 'L', 0);
        $this->pdf->Ln(5);
        $this->pdf->Cell(0, 10, utf8_decode('SJL, ' . date_format(date_create($adjudicacion->fecha_registro), "d") . ' de ' . $this->meses[date_format(date_create($adjudicacion->fecha_registro), "m") - 1] . ' del ' . date('Y') . ' siendo las ' . date_format(date_create($adjudicacion->fecha_registro), "g:i A")), 0, 0, 'R');
        


        $this->pdf->SetFont('Arial', 'B', 6);

        // $xml = simplexml_load_string($datos [0] ['firmas'], 'SimpleXMLElement', LIBXML_NOCDATA);
        // $lista_firmas = json_decode(json_encode((array) $xml), TRUE);
        // $lista_firmas = $lista_firmas['miembro'];

        // $totalfirmas = count($lista_firmas);
        $contador = 0;
        $lista_firmas = $firmas;
        // var_dump($firmas); exit;
        foreach ($lista_firmas as $fila) {
            $y = $this->pdf->GetY();
            $x = $this->pdf->GetX();

            if ($x + 40 > 180) {
                $this->pdf->Ln(30);
            }

            if ($contador != 0 && $contador % 3 == 0) {
                if ($totalfirmas - $contador == 2) {
                    $this->pdf->Cell(30, 7, '', '', 0, 'C', 0);
                }
                if ($totalfirmas - $contador == 1) {
                    $this->pdf->Cell(55, 7, '', '', 0, 'C', 0);
                }
            }



            $xpx = $this->pdf->GetX();
            /*  if( $fila['firmaActiva'] == 1){
              $this->pdf->Image($fila['firma'], $this->pdf->GetX()+15, $this->pdf->GetY()-23,42,0, 'png');
              } */

            //            $this->pdf->Cell(11,11, $this->pdf->Image('./Archivo/colegio12.png', $this->pdf->GetX(), $this->pdf->GetY(),11),1)
            //            "./Archivo/" .$imagen
            //            ;
            //            $imagen = utf8_decode($fila['archivo']);
            //            $this->pdf->MultiCell(10, 10, $this->pdf->Image("./Archivo/" . $imagen, $this->pdf->GetX() + 10, $this->pdf->GetY() + 3, 50), 0, "C");

            // $imagen = utf8_decode($fila['archivo']);

            if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
                isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
                $protocol = 'https://';
            }
            else {
                $protocol = 'http://';
            }
            $hostname = $protocol .  $_SERVER['SERVER_NAME'] . '/public';

            $imagen = $fila->usu_firma ? ($hostname. utf8_decode($fila->usu_firma)) : "https://img.freepik.com/foto-gratis/fondo_53876-32170.jpg";

            //            $this->pdf->MultiCell(15, 10, $this->pdf->Image("./Archivo/" . $imagen, $this->pdf->GetX() + 40, $this->pdf->GetY() + 4, 55), 0, "C");

            // $this->pdf->Cell(11, 11, $this->pdf->Image(__DIR__."/../../public" . $imagen, $this->pdf->GetX() + 25, $this->pdf->GetY() - 20, 40), 0);
            // https://upload.wikimedia.org/wikipedia/commons/thumb/1/14/Firma_Ildefonso_Leal.jpg/800px-Firma_Ildefonso_Leal.jpg
            
            $this->pdf->Cell(11, 11, $this->pdf->Image($imagen, $this->pdf->GetX() + 25, $this->pdf->GetY() - 20, 40), 0);


            $this->pdf->Cell(15, 7, '', '', 0, 'C', 0);
            $this->pdf->Cell(40, 7, utf8_decode($fila->usu_nombre), 'T', 0, 'C', 0);
            $yp = $this->pdf->GetY();
            $xp = $this->pdf->GetX();
            $this->pdf->SetXY($xpx + 20, $yp + 6);
            $this->pdf->MultiCell(50, 2, utf8_decode($fila->usu_apellidos), 0, 'C');

            $this->pdf->SetXY($xp, $yp);
            ++$contador;
        }




      
        /* FOOTER */
        $this->pdf->SetY(- 38);
        /*
          $this->pdf->Image('' . $qr . '', 180, 5, 23, 23);
         */
        $this->pdf->Line(80, 260, 130, 260);
        $this->pdf->Rect(140, 240, 20, 25);
        $this->pdf->Cell(85, 7, '', '', 0, 'C', 0);


       /*
         $this->pdf->SetFont('Arial', 'B', 6);
        $this->pdf->Cell(0, 7, utf8_decode($datos [0] ['nombres']),'', 0, 'LU', 0);
        $this->pdf->Ln(4);*/

       
        $this->pdf->Cell(35, 7, 'Firma del Docente', '', 0, 'LU', 0);
        $this->pdf->Ln(4);
        $this->pdf->Cell(80, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(5, 7, '', '', 0, 'LU', 0);
        $this->pdf->Cell(0, 7, $tipo_documento . ' ' . $postulante->numero_documento, '', 0, 'LU', 0);


        $this->pdf->SetFont('Arial', 'B', 6);
        $this->pdf->Cell(35, 7, '', '', 0, 'LU', 0);
        $this->pdf->Ln(4);

         $this->pdf->SetFont('Arial', 'B', 6);
         $this->pdf->Ln(2);

        
        // $this->pdf->setExpediente($datos [0] ['expediente']);
        // $this->pdf->setCodVerificacion($datos [0] ['detalleID']);
        // $this->pdf->setClave($datos [0] ['claveExpediente']);

        $fileName = 'Acta-' . $postulante->uid . '.pdf'; 
        $this->pdf->Output($fileName,'I');
        
        
      
        ob_end_flush();
    }

 
    /** FINAL - GENERACIÓN DE DOCUMENTO DE ADJUDICACIÓN (ACTA DE ADJUDICACIÓN) * */

    /** INICIO - GENERACIÓN DEL DOCUMENTO DE RESERVA (ACTA DE PETICIÓN Y CONFORMIDAD) * */
    public function reserva() {
        $this->load->library('pdf');

        $reservaID = $this->input->get('cod');

        $datos = $this->documento->obtener_datos_reserva($reservaID);


        ob_start();

        $this->pdf = new Pdf ();

        // Agregamos una página
        $this->pdf->AddPage();

        // Define el alias para el número de página que se imprimirá en el pie
        $this->pdf->AliasNbPages();

        /*
         * Se define el titulo, márgenes izquierdo, derecho y
         * el color de relleno predeterminado
         */


        $this->pdf->SetFont('Arial', 'BU', 17);


        //$titulo = ($datos [0] ['etapaID'] == 1) ? 'ACTA DE ADJUDICACIÓN' : 'ACTA DE ADJUDICACIÓN EXCEPCIONAL';
        $this->pdf->Cell(0, 10, utf8_decode('ACTA DE PETICIÓN Y CONFORMIDAD'), 0, 0, 'C');
        //  $this->pdf->Cell ( 120, 15, utf8_decode ('ACTA DE PETICIÓN Y CONFORMIDAD'), 0, 0, 'C' );
        $this->pdf->Ln('10');
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Ln(10);
        // $this->Cell(20, 4,utf8_decode('De conformida con el resultado obtenido en el Proceso para Contratación de Docentes, regulado por la Norma Técnica aprobada con R.M. Nº 023-2015-MINEDU, se adjunta el cargo vacante a:'),'',0, 'L', 0);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->MultiCell(180, 7, utf8_decode('En SJL, a los ' . date_format(date_create($datos [0] ['fechaReg']), "d") . ' días del mes de ' . $this->meses[date_format(date_create($datos [0] ['fechaReg']), "m") - 1] . ' del año ' . date_format(date_create($datos [0] ['fechaReg']), "Y") . ', siendo las ' . date_format(date_create($datos [0] ['fechaReg']), "g:i A") . ' horas, los miembros del Comité de Contratación Docente de la ' . $datos [0] ['ugel'] . ', y el docente ' . $datos [0] ['nombres'] . ' de la especialidad de ' . utf8_decode($datos [0] ['especialidad']) . ' en uso de su derecho que le confiere del ' . $datos [0] ['descrip_doc'] . 'D.S. Nº 001-2017' . $datos [0] ['numero'] . '-MINEDU, que aprueba la Norma que regula el procedimiento, requisitos y condiciones para las contrataciones en el marco del contrato del servicio docente a que hace referencia la Ley Nº 30328. Ley que establece medidas en materia educativa y dicta otras disposiciones, cuyo texto en calidad de Anexo, forma parte integrante del presente ' . $datos [0] ['descrip_doc'] . ', y acordamos elaborar el acta en los siguientes términos:'), 0);
        $this->pdf->Ln(3);

        $this->pdf->Ln(5);

        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', 'BU', 10);
        $this->pdf->Cell(40, 7, 'PRIMERO.-', 0);
        $this->pdf->Ln(5);
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->MultiCell(180, 7, utf8_decode('Que, el docente voluntariamente elige la plaza vacante de la institución educativa ' . $datos [0] ['ie'] . ', código de plaza Nº ' . $datos [0] ['codigoPlaza'] . ', en uso de sus derecho amparada por la norma acotada. Sin lugar a reclamo alguno posterior en caso que la plaza sea ocupada por reubicación de excedente, reasignación por salud u otro.'), 0);
        $this->pdf->Ln(15);
        $this->pdf->Cell(20, 7, '', '', 0, 'C', 0);
        $this->pdf->MultiCell(0, 7, utf8_decode('Se firma el presente documento en señal de conformidad entre las partes:'), 0);

        $this->pdf->Ln(8);


        $this->pdf->Ln(25);
        $this->pdf->SetFont('Arial', 'B', 6);


        $xml = simplexml_load_string($datos [0] ['firmas'], 'SimpleXMLElement', LIBXML_NOCDATA);
        $lista_firmas = json_decode(json_encode((array) $xml), TRUE);
        $lista_firmas = $lista_firmas['miembro'];

        $totalfirmas = count($lista_firmas);
        $contador = 0;
        foreach ($lista_firmas as $fila) {
            $y = $this->pdf->GetY();
            $x = $this->pdf->GetX();

            if ($x + 40 > 180) {
                $this->pdf->Ln(30);
            }

            if ($contador != 0 && $contador % 3 == 0) {
                if ($totalfirmas - $contador == 2) {
                    $this->pdf->Cell(30, 7, '', '', 0, 'C', 0);
                }
                if ($totalfirmas - $contador == 1) {
                    $this->pdf->Cell(55, 7, '', '', 0, 'C', 0);
                }
            }

            $xpx = $this->pdf->GetX();
            /* if( $fila['firmaActiva'] == 1){
              $this->pdf->Image($fila['firma'], $this->pdf->GetX()+15, $this->pdf->GetY()-23,42,42, 'png');
              } */




            $this->pdf->Cell(15, 7, '', '', 0, 'C', 0);
            $this->pdf->Cell(40, 7, utf8_decode($fila['nombres']), 'T', 0, 'C', 0);
            $yp = $this->pdf->GetY();
            $xp = $this->pdf->GetX();
            $this->pdf->SetXY($xpx + 15, $yp + 6);
            $this->pdf->MultiCell(40, 2, utf8_decode($fila['cargo']), 0, 'C');
            $this->pdf->SetXY($xp, $yp);
            ++$contador;
        }

        /* FOOTER */
        $this->pdf->SetY(- 38);
        $this->pdf->Line(80, 260, 130, 260);
        $this->pdf->Rect(140, 240, 20, 25);
        $this->pdf->Cell(85, 7, '', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', 'B', 6);
        $this->pdf->Cell(35, 7, 'Firma del Docente', '', 0, 'LU', 0);
        $this->pdf->Ln(4);
        $this->pdf->Cell(80, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(10, 7, 'D.N.I. ', '', 0, 'LU', 0);
        $this->pdf->Cell(0, 7, $datos [0] ['numDoc'], '', 0, 'LU', 0);

        /* $this->pdf->setExpediente($datos [0] ['numExpediente']); */
        /* $this->pdf->setCodVerificacion('1010');
          $this->pdf->SetY ( - 15 ); */

        $this->pdf->Output("Reserva.pdf", 'I');
        ob_end_flush();
    }

    /** FINAL - GENERACIÓN DEL DOCUMENTO DE RESERVA (ACTA DE PETICIÓN Y CONFORMIDAD) * */
    function bold($pdf, $val) {
        $pdf->SetFont('', 'B');
        return $pdf->Text(0, 0, $val);
        $pdf->SetFont('', '');
    }

    /** INICIO - GENERACIÓN DE DOCUMENTO DE CONTRATO DE TRABAJO (ANEXO N° 1) * */
   public function contrato($id) {
        $this->load->library('pdf');

        /*$convocatoriaID = $this->input->get('conv');
        $plazaID = $this->input->get('plaza');
        $datos = $this->documento->obtener_datos_acta($convocatoriaID, $plazaID);*/

        $detail = $this->adjudicaciones_model->f_detail($id);
        $adjudicacion = $detail['adjudicacion'];

        $postulante = $adjudicacion->postulacion;
        $convocatoria = $adjudicacion->convocatoria;
        $plaza = $adjudicacion->plaza;
        $firmas = $adjudicacion->firmas;
        $tipo_documento = $postulante->tipo_documento == 1 ? 'DNI' : 'C.E';

        $this->db->reconnect();

        if (empty($adjudicacion)) {
            redirect("adjudicaciones");
        }
        ob_start();

        $this->pdf = new Pdf ();

        // Agregamos una página
        $this->pdf->AddPage();

        // Define el alias para el número de página que se imprimirá en el pie
        $this->pdf->AliasNbPages();

        /*
         * Se define el titulo, márgenes izquierdo, derecho y
         * el color de relleno predeterminado
         */
        $this->pdf->SetFont('Arial', 'B', 12);
        
        $this->pdf->Ln(6);
        //$titulo = ($datos [0] ['etapaID'] == 1) ? 'ACTA DE ADJUDICACIÓN' : 'ACTA DE ADJUDICACIÓN EXCEPCIONAL';
        $this->pdf->MultiCell(0, 6, utf8_decode('CONTRATO DE TRABAJO PARA PROFESORES EN INSTITUCIONES EDUCATIVAS PÚBLICAS DE EDUCACIÓN BÁSICA Y EDUCACIÓN TÉCNICO PRODUCTIVA'), 0, 'C');
        $this->pdf->SetFont('Arial', '', 9);
        $this->pdf->Ln(10);
        // $this->Cell(20, 4,utf8_decode('De conformida con el resultado obtenido en el Proceso para Contratación de Docentes, regulado por la Norma Técnica aprobada con R.M. Nº 023-2015-MINEDU, se adjunta el cargo vacante a:'),'',0, 'L', 0);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('Por el presente documento celebran el contrato de servicio docente, de una parte la DIRECCIÓN REGIONAL DE EDUCACIÓN, UNIDAD DE GESTION EDUCATIVA LOCAL O5, con  domicilio  en ' . $postulante->direccion . ', representada  para  estos efectos por su Director(a), el/la señor(a) ' . $postulante->nombre . ' idenficado(a) con D.N.I. N° ' . $postulante->numero_documento . ', designado(a) mediante Resolución N°..........................................  A quien en adelante se denomina LA DRE/GRE/UGEL; y de otra parte, el Señor(a) ' . $postulante->nombre . ', identificado(a) con ' . $tipo_documento . ' N° ' . $postulante->numero_documento . ' y domiciliado en ' . $postulante->direccion . ', quien en adelante se denomina PROFESOR(A); en los términos y condiciones siguientes: '), 0);
        $this->pdf->Ln(6);

        $this->pdf->Cell(5, 5, '', '', 0, 'R', 0);
        $this->pdf->SetFont('', 'B');
        $this->pdf->MultiCell(0, 5, utf8_decode('CLÁUSULA PRIMERA'), 0);
        $this->pdf->SetFont('', '');
        $this->pdf->Cell(5, 5, '', '', 0, 'R', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('En atención a las necesidades de contar con los servicios de un Profesional Docente, el Comité de Contratación de la DRE / UGEL adjudicó la plaza orgánica/eventual/temporal/horas al señor(a) ' . $postulante->nombre . ' para desempeñar funciones docentes.'), 0);

        $this->pdf->Ln(3);
        $this->pdf->Cell(5, 5, '', '', 0, 'R', 0);
        $this->pdf->SetFont('', 'B');
        $this->pdf->MultiCell(0, 5, utf8_decode('CLÁUSULA SEGUNDA'), 0);
        $this->pdf->SetFont('', '');
        $this->pdf->Cell(5, 5, '', '', 0, 'R', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('Por el presente, la  DRE / GRE/ UGEL contrata los servicios del PROFESOR para que cumpla funciones docentes en la plaza con código ' . utf8_decode($plaza->codigoPlaza) . ' (horas libres para completar el plan de estudios) perteneciente a la Institución Educativa ' . $plaza->ie . ' de la modalidad educativa de ' . utf8_decode($convocatoria->modalidad_nombre) . ' - ' . utf8_decode($postulante->nivel_nombre) . ', ubicada en el Distrito de ' . utf8_decode($postulante->distrito_nombre) . ', Provincia de ' . utf8_decode($postulante->provincia_nombre) . ', Región de LIMA.'), 0);

        $this->pdf->Ln(3);
        $this->pdf->Cell(5, 5, '', '', 0, 'R', 0);
        $this->pdf->SetFont('', 'B');
        $this->pdf->MultiCell(0, 5, utf8_decode('CLÁUSULA TERCERA'), 0);
        $this->pdf->SetFont('', '');
        $this->pdf->Cell(5, 5, '', '', 0, 'R', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('Las partes acuerdan que el plazo de duración del presente contrato de servicio docente se inicia el ' . date_format(date_create($adjudicacion->fecha_inicio), "d") . ' de ' . $this->meses[date_format(date_create($adjudicacion->fecha_inicio), "m") - 1] . ' del ' . date_format(date_create($adjudicacion->fecha_inicio), "Y") . ' y finaliza el ' . date_format(date_create($adjudicacion->fecha_final), "d") . ' de ' . $this->meses[date_format(date_create($adjudicacion->fecha_final), "m") - 1] . ' del ' . date_format(date_create($adjudicacion->fecha_final), "Y") . '.'), 0);

        $this->pdf->Ln(3);
        $this->pdf->Cell(5, 5, '', '', 0, 'R', 0);
        $this->pdf->SetFont('', 'B');
        $this->pdf->MultiCell(0, 5, utf8_decode('CLÁUSULA CUARTA'), 0);
        $this->pdf->SetFont('', '');
        $this->pdf->Cell(5, 5, '', '', 0, 'R', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('El PROFESOR en virtud al presente contrato de servicio docente percibe la remuneración mensual fijada por Decreto Supremo. Adicionalmente en caso corresponda, percibe los derechos y beneficios de conformidad a la normativa específica que lo regula.'), 0);

        $this->pdf->Ln(3);
        $this->pdf->Cell(5, 5, '', '', 0, 'R', 0);
        $this->pdf->SetFont('', 'B');
        $this->pdf->MultiCell(0, 5, utf8_decode('CLÁUSULA QUINTA'), 0);
        $this->pdf->SetFont('', '');
        $this->pdf->Cell(5, 5, '', '', 0, 'R', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('La jornada de trabajo del PROFESOR es de ' . $plaza->jornada . ' horas pedagógicas semanales - mensuales.                               '), 0);

        $this->pdf->Ln(3);
        $this->pdf->Cell(5, 5, '', '', 0, 'R', 0);
        $this->pdf->SetFont('', 'B');
        $this->pdf->MultiCell(0, 5, utf8_decode('CLÁUSULA SEXTA'), 0);
        $this->pdf->SetFont('', '');
        $this->pdf->Cell(5, 5, '', '', 0, 'R', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('Constituyen causal de resolución del contrato:'), 0);

       
        $this->pdf->Cell(15, 5, 'a)', '', 0, 'R', 0);
        $this->pdf->MultiCell(170, 5, utf8_decode('Límite de edad, al cumplir 65 años de edad.'), 0);
        $this->pdf->Cell(15, 5, 'b)', '', 0, 'R', 0);
        $this->pdf->MultiCell(170, 5, utf8_decode('La renuncia.'), 0);
        $this->pdf->Cell(15, 5, 'c)', '', 0, 'R', 0);
        $this->pdf->MultiCell(170, 5, utf8_decode('El mutuo acuerdo entre las partes.'), 0);
        $this->pdf->Cell(15, 5, 'd)', '', 0, 'R', 0);
        $this->pdf->MultiCell(170, 5, utf8_decode('Desplazamiento de personal titular.'), 0);
        $this->pdf->Cell(15, 5, 'e)', '', 0, 'R', 0);
        $this->pdf->MultiCell(170, 5, utf8_decode('Reestructuración o reorganización de la IE.'), 0);
        $this->pdf->Cell(15, 5, 'f)', '', 0, 'R', 0);
        $this->pdf->MultiCell(170, 5, utf8_decode('Modificación de las condiciones esenciales del contrato'), 0);
        $this->pdf->Cell(15, 5, 'g)', '', 0, 'R', 0);
        $this->pdf->MultiCell(170, 5, utf8_decode('El recurso administrativo resuelto a favor de un tercero, que se encuentre firme.'), 0);
        $this->pdf->Cell(15, 5, 'h)', '', 0, 'R', 0);
        $this->pdf->MultiCell(170, 5, utf8_decode('La culminación anticipada del motivo de ausencia del servidor titular a quien reemplaza el contratado.'), 0);
        $this->pdf->Cell(15, 5, 'i)', '', 0, 'R', 0);
        $this->pdf->MultiCell(170, 5, utf8_decode('Cambio del motivo de ausencia del servidor a quien reemplaza el contratado.'), 0);
        $this->pdf->Cell(15, 5, 'j)', '', 0, 'R', 0);
        $this->pdf->MultiCell(170, 5, utf8_decode('El fallecimiento del servidor contratado.'), 0);
        $this->pdf->Cell(15, 5, 'k)', '', 0, 'R', 0);
        $this->pdf->MultiCell(170, 5, utf8_decode('Declararse su inhabilitación administrativa o judicialmente.'), 0);
        $this->pdf->Cell(15, 5, 'l)', '', 0, 'R', 0);
        $this->pdf->MultiCell(170, 5, utf8_decode('Haber sido condenado por delito doloso mediante sentencia con calidad de cosa juzgada o consentida.'), 0);
        $this->pdf->Cell(15, 5, 'm)', '', 0, 'R', 0);
        $this->pdf->MultiCell(170, 5, utf8_decode('No asumir el cargo hasta el cuarto día desde el inicio de la vigencia del contrato.'), 0);
        $this->pdf->Cell(15, 5, 'n)', '', 0, 'R', 0);
        $this->pdf->MultiCell(170, 5, utf8_decode('No cumplir con los requisitos para la contratación docente establecidos en la presente norma.'), 0);
        $this->pdf->Cell(15, 5, 'o)', '', 0, 'R', 0);
        $this->pdf->MultiCell(170, 5, utf8_decode('Por incompatibilidad horaria y de distancia.'), 0);
        $this->pdf->Cell(15, 5, 'p)', '', 0, 'R', 0);
        $this->pdf->MultiCell(170, 5, utf8_decode('Presentar declaración jurada falsa o documentación falsa o adulterada.'), 0);
        $this->pdf->Cell(15, 5, 'q)', '', 0, 'R', 0);
        $this->pdf->MultiCell(170, 5, utf8_decode('Negativa de suscribir autorización para el descuento por planilla de sus remuneraciones, para el pago de la pensión alimenticia que tenga pendiente, siempre que se verifique que aparece inscrito en el REDAM.'), 0);
        $this->pdf->Cell(15, 5, 'r)', '', 0, 'R', 0);
        $this->pdf->MultiCell(170, 5, utf8_decode('Entre otros que tipifique el Minedu a través de norma específica o complementaria.'), 0);
  

        $this->pdf->Ln(3);
        $this->pdf->Cell(5, 5, '', '', 0, 'R', 0);
        $this->pdf->SetFont('', 'B');
        $this->pdf->MultiCell(0, 5, utf8_decode('CLÁUSULA SÉTIMA'), 0);
        $this->pdf->SetFont('', '');
        $this->pdf->Cell(5, 5, '', '', 0, 'R', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('El presente contrato de servicio docente es vigente a partir del plazo establecido en la cláusula tercera.'), 0);

        $this->pdf->Ln(3);
        $this->pdf->Cell(5, 5, '', '', 0, 'R', 0);
        $this->pdf->SetFont('', 'B');
        $this->pdf->MultiCell(0, 5, utf8_decode('CLÁUSULA OCTAVA'), 0);
        $this->pdf->SetFont('', '');
        $this->pdf->Cell(5, 5, '', '', 0, 'R', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('El presente contrato de servicio docente se aprueba mediante la resolución administrativa correspondiente.'), 0);

        $this->pdf->Ln(3);
        $this->pdf->Cell(5, 5, '', '', 0, 'R', 0);
        $this->pdf->SetFont('', 'B');
        $this->pdf->MultiCell(0, 5, utf8_decode('CLÁUSULA NOVENA'), 0);
        $this->pdf->SetFont('', '');
        $this->pdf->Cell(5, 5, '', '', 0, 'R', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('Para efectos de cualquier controversia que se genere con motivo de la celebración  y  ejecución del  presente contrato, las partes se someten a  la jurisdicción y competencia de los jueces y tribunales del domicilio de la DRE/GRE/UGEL respectiva.'), 0);



        $this->pdf->Ln(15);

        $this->pdf->Cell(5, 5, '', '', 0, 'R', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('El presente contrato se suscribe en dos ejemplares del mismo tenor, en señal de conformidad y aceptación, en ' . $postulante->distrito_nombre . ', el ' . date_format(date_create($adjudicacion->fecha_registro), "d") . ' de ' . $this->meses[date_format(date_create($adjudicacion->fecha_registro), "m") - 1] . ' del ' . date_format(date_create($adjudicacion->fecha_registro), "Y") . ' siendo las ' . date_format(date_create($adjudicacion->fecha_registro), "g:i A")), 0);


        $this->pdf->SetFont('Arial', 'B', 7);


        $this->pdf->SetY(- 67);
        /* FRIMA TITULAR */
        $this->pdf->Line(50, 230, 90, 230);
        $this->pdf->Line(110, 230, 150, 230);
        $this->pdf->Cell(45, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(65, 7, 'TITULAR DRE/GRE/UGEL', '', 0, 'LU', 0);
        $this->pdf->Cell(30, 7, 'EL PROFESOR', '', 0, 'LU', 0);
        $this->pdf->Ln(4);

        $this->pdf->setExpediente($postulante->uid);
        // $this->pdf->setCodVerificacion($datos [0] ['detalleID']);
        
         $fileName = 'Contrato-' . $postulante->uid . '.pdf'; 
        $this->pdf->Output($fileName, 'I');

        ob_end_flush();
    }

    /** FINAL -  GENERACIÓN DE DOCUMENTO DE CONTRATO DE TRABAJO (ANEXO N° 1)  * */

    /** INICIO - GENERACIÓN DE DOCUMENTO DE DECLARACIÓN JURADA (ANEXO N° 5 - DECLARACIÓN JUARADA PARA CONTRATACIÓN) * */
    public function declaracion() {

       $this->load->library('pdf');

        $convocatoriaID = $this->input->get('conv');
        $plazaID = $this->input->get('plaza');
        $datos = $this->documento->obtener_datos_acta($convocatoriaID, $plazaID);
        $this->db->reconnect();

        if (empty($datos)) {
            redirect("adjudicacion/adjudicar/" . $convocatoriaID, "refresh");
        }
        ob_start();

        $this->pdf = new Pdf ();

        // Agregamos una página
        $this->pdf->AddPage();

        // Define el alias para el número de página que se imprimirá en el pie
        $this->pdf->AliasNbPages();

        /*
         * Se define el titulo, márgenes izquierdo, derecho y
         * el color de relleno predeterminado
         */


        $this->pdf->SetFont('Arial', 'B', 13);
        $this->pdf->Ln(6);
        //$titulo = ($datos [0] ['etapaID'] == 1) ? 'ACTA DE ADJUDICACIÓN' : 'ACTA DE ADJUDICACIÓN EXCEPCIONAL';
           $this->pdf->Cell(0, 10, utf8_decode('ANEXO N° 05'), 0, 0, 'C');
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Ln(7);
        $this->pdf->Cell(0, 10, utf8_decode('DECLARACIÓN JURADA PARA EL PROCESO DE CONTRATACIÓN EN LA '. $datos [0] ['etapa'] ), 0, 0, 'C');
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Ln(13);
        // $this->Cell(20, 4,utf8_decode('De conformida con el resultado obtenido en el Proceso para Contratación de Docentes, regulado por la Norma Técnica aprobada con R.M. Nº 023-2015-MINEDU, se adjunta el cargo vacante a:'),'',0, 'L', 0);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('Yo, ' . $datos [0] ['nombres'] . ' identificado(a) con ' . $datos [0] ['tipodoc'] . ' N° ' . $datos [0] ['numdoc'] . ', y domicilio actual en _____________________________________________________________________________________. '), 0);
        $this->pdf->Ln(4);

        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('DECLARO BAJO JURAMENTO:'), 0);
        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->Ln(4);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('Poseer título de profesor o de licenciado en educación correspondiente a la modalidad ' . $datos [0] ['Modalidad'] . ' ,nivel/ciclo ' . $datos [0] ['Nivel'] . ' y/o Área Curricular, ' . $datos [0] ['Especialidad'] . '; Registro en la DRE o SUNEDU N° _________________. '), 0);
        $this->pdf->Ln(4);
        $this->pdf->Cell(10, 5, '-', '', 0, 'R', 0);
        $this->pdf->MultiCell(170, 5, utf8_decode('Tener buena conducta.'), 0);
        $this->pdf->Ln(1);
        $this->pdf->Cell(10, 5, '-', '', 0, 'R', 0);
        $this->pdf->MultiCell(170, 5, utf8_decode('Gozar de buena salud física y mental que permita ejercer la docencia.'), 0);
        $this->pdf->Ln(1);
        $this->pdf->Cell(10, 5, '-', '', 0, 'R', 0);
        $this->pdf->MultiCell(170, 5, utf8_decode('No haber sido condenado por delito doloso.'), 0);
        $this->pdf->Ln(1);
//        $this->pdf->Cell(10, 5, '-', '', 0, 'R', 0);
//        $this->pdf->MultiCell(170, 5, utf8_decode('No haber sido sancionado administrativamente con destitución, cese temporal, suspensión, amonestación o separación del servicio en el periodo comprendido en los últimos cinco años, a la fecha inclusive.'), 0);
        $this->pdf->Ln(1);
        $this->pdf->Cell(10, 5, '-', '', 0, 'R', 0);
        $this->pdf->MultiCell(170, 5, utf8_decode('No haber sido condenado por los delitos de terrorismo, apología al terrorismo, delito contra la libertad sexual, delitos de corrupción de funcionarios y/o delitos de tráfico de drogas; ni haber incurrido en actos de violencia que atenten con los derechos fundamentales de la persona y contra el patrimonio; haber impedido el normal funcionamiento de los servicios públicos, así como los delitos previstos en la Ley N° 29988 y los literales c) y j) del articulo 49 de la Ley 29944.'), 0);
        $this->pdf->Ln(1);
               $this->pdf->Cell(10, 5, '-', '', 0, 'R', 0);
        $this->pdf->MultiCell(170, 5, utf8_decode('No tener antecedentes judiciales, penales y policiales.'), 0);
        $this->pdf->Ln(1);
        $this->pdf->Cell(10, 5, '-', '', 0, 'R', 0);
        $this->pdf->MultiCell(170, 5, utf8_decode('No encontrarme inhabilitado para ejercer la función pública.'), 0);
                $this->pdf->Ln(1);
        $this->pdf->Cell(10, 5, '-', '', 0, 'R', 0);
        $this->pdf->MultiCell(170, 5, utf8_decode('No encontrarme impedido de prestar labor docente efectiva, conforme al marco normativo vigente.'), 0);
                  $this->pdf->Ln(1);
        $this->pdf->Cell(10, 5, '-', '', 0, 'R', 0);
        $this->pdf->MultiCell(170, 5, utf8_decode('No encontrarme comprendido en los alcances de la Ley 30901.'), 0);
                $this->pdf->Ln(1);
        $this->pdf->Cell(10, 5, '-', '', 0, 'R', 0);
        $this->pdf->MultiCell(170, 5, utf8_decode('Tener menos de 65 años de edad.'), 0);
                $this->pdf->Ln(1);
        $this->pdf->Cell(10, 5, '-', '', 0, 'R', 0);
        $this->pdf->MultiCell(170, 5, utf8_decode('Ser peruano de Nacimiento, de estar postulando a una plaza vacante en una IE ubicada en zona de frontera.'), 0);
                        $this->pdf->Ln(1);
        $this->pdf->Cell(10, 5, '-', '', 0, 'R', 0);
        $this->pdf->MultiCell(170, 5, utf8_decode('No haber presentado renuncia a contrato docente en el ámbito de la región a la que postuló.'), 0);
        $this->pdf->Ln(1);
        $this->pdf->Cell(10, 5, '-', '', 0, 'R', 0);
        $this->pdf->MultiCell(170, 5, utf8_decode('La veracidad de la información y de la documentación que adjunto en copia simple.'), 0);
          $this->pdf->Ln(1);
        $this->pdf->Cell(10, 5, '-', '', 0, 'R', 0);
        $this->pdf->MultiCell(170, 5, utf8_decode('No tener grado de parentezco hasta el cuarto grado de consanguinidad, segundo de afinidad y por razón de matrimonio o uniuones de hecho, con personal que bajo cualquier modalidad de contratación, goza de facultad de contratación de personal, o tenga injerencia directa o indirecta en le proceso de contratación. En caso de tener pariente, preciso los nombres y apellidos de quien  o quienes me unen el grado de parentezco o vinculo conyugal, .................................................................. cargo y dependencia ............................................................................., para su verificación y fines pertinentes..'), 0);
        $this->pdf->Ln(4);
      
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('Frimo la presente declaración de conformidad con lo establecido en el artículo 49 del Texto único Ordenado de la Ley N° 27444, Ley del Procedimiento Administrativo General, y en caso de resultar falsa la información que proporciono, me sujeto a los alcances de lo establecido en el artículo 411 del Código Penal, concordante en el artículo 33 del Texto Único Ordenado de la Ley N° 27444, Ley del Procedimiento Administrativo General; autorizo a efectuar la comprobación de la veracidad de la información declarada en el presente documento.'), 0);

          $this->pdf->Ln(4);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('En fé de lo cual firmo la presente.'.' Dado en la ciudad de Lima, ' . date_format(date_create($datos [0] ['fechaAsignacion']), "d") . ' de ' . $this->meses[date_format(date_create($datos [0] ['fechaAsignacion']), "m") - 1] . ' del ' . date('Y') . ' siendo las ' . date_format(date_create($datos [0] ['fechaAsignacion']), "g:i A")), 0);

        
//        $this->pdf->Ln(3);
//
//        $this->pdf->SetFont('Arial', '', 9);
//
//        $this->pdf->Cell(0, 10, utf8_decode('      Dado en la ciudad de Lima, ' . date_format(date_create($datos [0] ['fechaAsignacion']), "d") . ' de ' . $this->meses[date_format(date_create($datos [0] ['fechaAsignacion']), "m") - 1] . ' del ' . date('Y') . ' siendo las ' . date_format(date_create($datos [0] ['fechaAsignacion']), "g:i A")), 0, 0, 'L');


//        $this->pdf->SetFont('Arial', '', 8);
//
//        $this->pdf->Ln(18);
//        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
//        $this->pdf->MultiCell(180, 5, utf8_decode('Nota: Si el postulante oculta la información y/o consigna información falsa será excluido del proceso de selección de personal. En caso de haberse producido la contratación, se deberá proceder con la conclusión o anulación del contrato por comisión de falta grave, con arreglo a las normas vigentes, sin perjucio de la responsabilidad penal que hubiera incurrido (Art. 4° DS 017-96-PCM )'), 0);

        $this->pdf->SetFont('Arial', 'B', 6);

        /* FOOTER */
        $this->pdf->SetY(- 38);
        $this->pdf->Line(80, 260, 130, 260);
        $this->pdf->Rect(140, 240, 20, 25);
        $this->pdf->Cell(85, 7, '', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', 'B', 6);
        $this->pdf->Cell(35, 7, 'Firma del Docente', '', 0, 'LU', 0);
        $this->pdf->Ln(4);
        $this->pdf->Cell(80, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(5, 7, '', '', 0, 'LU', 0);
        $this->pdf->Cell(0, 7, $datos [0] ['tipodoc'] . ' ' . $datos [0] ['numdoc'], '', 0, 'LU', 0);

        $this->pdf->setExpediente($datos [0] ['expediente']);
        $this->pdf->setCodVerificacion($datos [0] ['detalleID']);

        $this->pdf->Output("Declaración.pdf", 'I');
        ob_end_flush();
    }

    
    
    
       public function anexo6A() {

        $this->load->library('pdf');

        $convocatoriaID = $this->input->get('conv');
        $plazaID = $this->input->get('plaza');
        $datos = $this->documento->obtener_datos_acta($convocatoriaID, $plazaID);
        $this->db->reconnect();

        if (empty($datos)) {
            redirect("adjudicacion/adjudicar/" . $convocatoriaID, "refresh");
        }
        ob_start();

        $this->pdf = new Pdf ();

        // Agregamos una página
        $this->pdf->AddPage();

        // Define el alias para el número de página que se imprimirá en el pie
        $this->pdf->AliasNbPages();

        /*
         * Se define el titulo, márgenes izquierdo, derecho y
         * el color de relleno predeterminado
         */


        $this->pdf->SetFont('Arial', 'B', 13);
        $this->pdf->Ln(6);
        //$titulo = ($datos [0] ['etapaID'] == 1) ? 'ACTA DE ADJUDICACIÓN' : 'ACTA DE ADJUDICACIÓN EXCEPCIONAL';
           $this->pdf->Cell(0, 10, utf8_decode('ANEXO N° 6-A'), 0, 0, 'C');
        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->Ln(10);
        $this->pdf->Cell(0, 10, utf8_decode('DECLARACIÓN JURADA - REGISTRO DE DEUDORES ALIMENTARIOS MOROSOS - REDAM'), 0, 0, 'C');
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Ln(20);
        // $this->Cell(20, 4,utf8_decode('De conformida con el resultado obtenido en el Proceso para Contratación de Docentes, regulado por la Norma Técnica aprobada con R.M. Nº 023-2015-MINEDU, se adjunta el cargo vacante a:'),'',0, 'L', 0);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('Yo, ' . $datos [0] ['nombres'] . ' identificado(a) con ' . $datos [0] ['tipodoc'] . ' N° ' . $datos [0] ['numdoc'] . ', y con domicilio actual en ___________________________________________________________________________________ ; '), 0);
        $this->pdf->Ln(4);

        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('DECLARO BAJO JURAMENTO:'), 0);
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Ln(4);
//        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
//        $this->pdf->MultiCell(180, 5, utf8_decode('Poseer título de profesor o de licenciado en educación correspondiente a la modalidad _______________________________ ,forma/nivel/ciclo ________________________ y/o área que corresponda, ___________________________________________________________________. '), 0);
//        $this->pdf->Ln(4);
        $this->pdf->Cell(10, 5, '', 0, 'R', 0);
        $this->pdf->MultiCell(170, 5, utf8_decode('Que, en virtud a lo dispuesto en el articulo 10° de la Ley N° 28970:'), 0);
        $this->pdf->Ln(4);
        $this->pdf->Cell(10, 5, '', 0, 'R', 0);
        $this->pdf->MultiCell(170, 5, utf8_decode('(      ) me encuentro en el registro de deudores alimentario moroso.'), 0);
        $this->pdf->Ln(4);
        $this->pdf->Cell(10, 5, '', 0, 'R', 0);
        $this->pdf->MultiCell(170, 5, utf8_decode('(   ) me encuentro en el registro de deudores alimentario moroso, por lo que autorizo para que se descuente por planilla el monto de la pensión mensual fijada en el proceso de alimentos, por cual la oficina correspondiente de la entidad comunicará al REDAM la respectiva autorización dentro del plazo de tres (03) días hábiles.'), 0);
;

        $this->pdf->Ln(4);
        $this->pdf->SetFont('Arial', '', 9);

        $this->pdf->Cell(0, 10, utf8_decode('Dado en la ciudad de Lima, ' . date_format(date_create($datos [0] ['fechaAsignacion']), "d") . ' de ' . $this->meses[date_format(date_create($datos [0] ['fechaAsignacion']), "m") - 1] . ' del ' . date('Y') . ' siendo las ' . date_format(date_create($datos [0] ['fechaAsignacion']), "g:i A")), 0, 0, 'R');


        
//        $this->pdf->SetFont('Arial', '', 8);
//
//        $this->pdf->Ln(18);
//        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
//        $this->pdf->MultiCell(180, 5, utf8_decode('Nota: Si el postulante oculta la información y/o consigna información falsa será excluido del proceso de selección de personal. En caso de haberse producido la contratación, se deberá proceder con la conclusión o anulación del contrato por comisión de falta grave, con arreglo a las normas vigentes, sin perjucio de la responsabilidad penal que hubiera incurrido (Art. 4° DS 017-96-PCM )'), 0);

        $this->pdf->SetFont('Arial', 'B', 6);

        /* FOOTER */
        $this->pdf->SetY(- 128);
        $this->pdf->Line(80, 170, 140, 170);
        $this->pdf->Rect(150, 150, 20, 25);
         $this->pdf->Cell(85, 7, '', '', 0, 'C', 0);
            $this->pdf->SetFont('Arial', 'B', 6);
        $this->pdf->Cell(35, 7, 'Firma del Docente', '', 0, 'LU', 0);
        $this->pdf->Ln(4);
        $this->pdf->Cell(80, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(5, 7, '', '', 0, 'LU', 0);
        $this->pdf->Cell(0, 7, $datos [0] ['tipodoc'] . ' ' . $datos [0] ['numdoc'], '', 0, 'LU', 0);

            $this->pdf->Ln(30);
        $this->pdf->SetFont('Arial', 'B', 8);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('*   Incorporado por el Decreto Legislativo N° 1377.'), 0);
        
        $this->pdf->setExpediente($datos [0] ['expediente']);
        $this->pdf->setCodVerificacion($datos [0] ['detalleID']);
        
        $fileName = 'Anexo6A-' . $datos [0] ['expediente'] . '.pdf'; 
        $this->pdf->Output($fileName, 'I');

        ob_end_flush();
    }

    
    
       public function anexo6B() {

       $this->load->library('pdf');

        $convocatoriaID = $this->input->get('conv');
        $plazaID = $this->input->get('plaza');
        
        
        $datos = $this->documento->obtener_datos_acta($convocatoriaID, $plazaID);
        
//        $datos_frmdocente = $this->documento->obtener_datos_frmdocente($numDoc);
        
        $this->db->reconnect();

        if (empty($datos)) {
            redirect("adjudicacion/adjudicar/" . $convocatoriaID, "refresh");
        }
        ob_start();

        $this->pdf = new Pdf ();

        // Agregamos una página
        $this->pdf->AddPage();

        // Define el alias para el número de página que se imprimirá en el pie
        $this->pdf->AliasNbPages();

        /*
         * Se define el titulo, márgenes izquierdo, derecho y
         * el color de relleno predeterminado
         */


        $this->pdf->SetFont('Arial', 'B', 13);
        $this->pdf->Ln(2);
        //$titulo = ($datos [0] ['etapaID'] == 1) ? 'ACTA DE ADJUDICACIÓN' : 'ACTA DE ADJUDICACIÓN EXCEPCIONAL';
           $this->pdf->Cell(0, 10, utf8_decode('ANEXO N° 6 - B'), 0, 0, 'C');
        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->Ln(10);
        $this->pdf->Cell(0, 10, utf8_decode('DECLARACIÓN JURADA - NO ENCONTRARSE INSCRITO EN EL REGISTRO DE DEUDORES DE'), 0, 0, 'C');
        $this->pdf->Ln(7);
        $this->pdf->Cell(0, 10, utf8_decode('REPARACIONES CIVILES - REDERECI'), 0, 0, 'C');

        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Ln(15);
        // $this->Cell(20, 4,utf8_decode('De conformida con el resultado obtenido en el Proceso para Contratación de Docentes, regulado por la Norma Técnica aprobada con R.M. Nº 023-2015-MINEDU, se adjunta el cargo vacante a:'),'',0, 'L', 0);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('Yo, ' . $datos [0] ['nombres'] . ' identificado(a) con ' . $datos [0] ['tipodoc'] . ' N° ' . $datos [0] ['numdoc'] . ', y con domicilio actual en ____________________________________________________________________________________________' ), 0);
        $this->pdf->Ln(4);

        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('DECLARO BAJO JURAMENTO:'), 0);
        $this->pdf->SetFont('Arial', '', 10);     
        $this->pdf->Ln(4);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('No encontrarme inscrito en el Registro de Deudores de Reparaciones Civiles (REDERECI) y, por lo tanto, de no contar con ninguno de los impedimentos establecidos en el articulo 5 de la ley N°30353* (Ley que crea el Registro de Deudores de Reparaciones Civiles - REDERECI) para acceder al ejercicios de la función pública y contratar con el Estado.'), 0);
        
        $this->pdf->Ln(4);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('En caso de resultar falsa la información que proporción, me sujero a los alcances de lo establecidos en el artículo 411 del Código Penal, concordante con el artículo 33 del Texto Único Ordenado de la Ley N° 27444, Ley del Procedimiento Administrativo General, aprobado por el Decreto Supremo N° 006-2017-JUS.'), 0);
        $this->pdf->Ln(4);

        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('En mérito a lo expresado, firmo el presente documento.'), 0);

        $this->pdf->Ln(4);
        $this->pdf->SetFont('Arial', '', 10);

        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('En la ciudad de Lima a los ' . date_format(date_create($datos [0] ['fechaAsignacion']), "d") . ' días del mes de ' . $this->meses[date_format(date_create($datos [0] ['fechaAsignacion']), "m") - 1] . ' del ' . date('Y') ), 0);

        /* FOOTER -38*/
        $this->pdf->SetY(- 128);
        $this->pdf->Line(20, 170, 65, 170);

        $this->pdf->Rect(140, 150, 20, 25);

        $this->pdf->Cell(25, 7, '', '', 0, 'L', 0);
        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->Cell(35, 7, 'Firma del Docente ', '', 0, 'LU', 0);

        $this->pdf->Ln(7);
        $this->pdf->Cell(5, 7, '', '', 0, 'L', 0);
        $this->pdf->Cell(5, 7, '', '', 0, 'LU', 0);
        $this->pdf->Cell(0, 7,   $datos [0] ['tipodoc'] . ' ' . $datos [0] ['numdoc'] .'                                                                                                                                 Huella digital', '', 0, 'LU', 0);
        $this->pdf->Ln(4);
        $this->pdf->Cell(0, 7, '                                                                                                                                                                    (Indice derecho)', '', 0, 'LU', 0);

        $this->pdf->Ln(30);
        $this->pdf->SetFont('Arial', 'B', 8);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('*   Articulo 5. Impedimento para acceder al ejercicio de la función pública y contratar con el Estado.'), 0);

        $this->pdf->Ln(1);
        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('Las personas inscritar en el REDERECI están impedidas de ejercer función, cargo, empleo, contrato o comisión de cargo público, así como postular y acceder a cargos públicos que procedan de elección popular. Estos impedimentos subsisten hasta la cancelación integra de la reparacíon civil dispuesta.'), 0);

        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('Lo dispuesto en el párrafo anterior es inaplicable a las personas condenadas por delitos perseguibles mediante el ejercicio privado de la acción penal.'), 0);

        $this->pdf->setExpediente($datos [0] ['expediente']);
        $this->pdf->setCodVerificacion($datos [0] ['detalleID']);
        
        $fileName = 'Anexo6B-' . $datos [0] ['expediente'] . '.pdf'; 
        $this->pdf->Output($fileName, 'I');

        ob_end_flush();
    }

    
         public function anexo7() {

        $this->load->library('pdf');

        $convocatoriaID = $this->input->get('conv');
        $plazaID = $this->input->get('plaza');
        $datos = $this->documento->obtener_datos_acta($convocatoriaID, $plazaID);
        $this->db->reconnect();

        if (empty($datos)) {
            redirect("adjudicacion/adjudicar/" . $convocatoriaID, "refresh");
        }
        ob_start();

        $this->pdf = new Pdf ();

        // Agregamos una página
        $this->pdf->AddPage();

        // Define el alias para el número de página que se imprimirá en el pie
        $this->pdf->AliasNbPages();

        /*
         * Se define el titulo, márgenes izquierdo, derecho y
         * el color de relleno predeterminado
         */


        $this->pdf->SetFont('Arial', 'B', 13);
        $this->pdf->Ln(6);
        $this->pdf->Cell(0, 10, utf8_decode('ANEXO N° 7'), 0, 0, 'C');
        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->Ln(10);
        $this->pdf->Cell(0, 10, utf8_decode('DECLARACIÓN JURADA DE DOBLE PERCEPCIÓN DEL ESTADO'), 0, 0, 'C');
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Ln(14);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('Yo, ' . $datos [0] ['nombres'] . ' identificado(a) con ' . $datos [0] ['tipodoc'] . ' N° ' . $datos [0] ['numdoc'] . ', con dirección domiciliaria _______________________________________________________________________________________________________ en el Distrito: ________________ Provincia: ____________________ Departamento: _________________. '), 0);
        $this->pdf->Ln(4);

        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('DECLARO BAJO JURAMENTO:'), 0);
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Ln(4);
        $this->pdf->Cell(10, 5, '', '', 0, '', 0);
        $this->pdf->MultiCell(170, 5, utf8_decode('1. Que, tengo conocimiento que ningún funcinario o servidor público puede desempeñar más de un empleo o cargo público remunerado, *con excepción de uno o más por función docente.*'), 0);
        $this->pdf->Ln(2);
        $this->pdf->Cell(10, 5, '', '', 0, '', 0);
        $this->pdf->MultiCell(170, 5, utf8_decode('2. Que, en la actualidad (NO) presto servicios remunerados.'), 0);

        $this->pdf->Ln(2);
        $this->pdf->Cell(10, 5, '', '', 0, '', 0);
        $this->pdf->MultiCell(170, 5, utf8_decode('3. Que, en la actualidad (SI) presto servicios remunerados, en ____________________________________________ en el Cargo de ___________________________________ en la condición de ( ) Nombrado        ( ) Contratado; en el cual percibo los siguientes ingresos:'), 0);
        $this->pdf->Ln(2);
        $this->pdf->Cell(10, 5, '', '', 0, '', 0);
        $this->pdf->MultiCell(170, 5, utf8_decode('[  ] Remuneración          [  ] Dietas          [  ] Incentivos laborales          [  ] Honorarios              '), 0);

        $this->pdf->Cell(10, 5, '', '', 0, '', 0);
        $this->pdf->MultiCell(170, 5, utf8_decode('[  ] Otros: __________________________________________________________'), 0);

        $this->pdf->Ln(4);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('Por lo que declaro que NO tengo incompatibilidad horaria entre las instituciones públicas donde laboro, lo cual sutento con mis horarios de trabajo debidamente visados por la institución.'), 0);

        $this->pdf->Ln(4);
        $this->pdf->SetFont('Arial', '', 9);

        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('En la ciudad de Lima a los ' . date_format(date_create($datos [0] ['fechaAsignacion']), "d") . ' días del mes de ' . $this->meses[date_format(date_create($datos [0] ['fechaAsignacion']), "m") - 1] . ' del ' . date('Y') ), 0);

        $this->pdf->SetY(- 100);
        $this->pdf->Line(30, 198, 80, 198);

        $this->pdf->Rect(140, 178, 20, 25);

        $this->pdf->Cell(34, 7, '', '', 0, 'L', 0);
        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->Cell(35, 7, 'Frima del Docente ', '', 0, 'LU', 0);

        $this->pdf->Ln(7);
        $this->pdf->Cell(5, 7, '', '', 0, 'L', 0);
        $this->pdf->Cell(5, 7, '', '', 0, 'LU', 0);
        $this->pdf->Cell(0, 7, '                                                                                                        Huella digital', '', 0, 'C', 0);
        $this->pdf->Ln(4);
        $this->pdf->Cell(0, 7, '                                                                                                                    (Indice derecho)', '', 0, 'C', 0);

        $this->pdf->Ln(30);
        $this->pdf->SetFont('Arial', 'B', 8);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('*   Articulo 40° de la Constitución Política del Perú.'), 0);

        $this->pdf->setExpediente($datos [0] ['expediente']);
        $this->pdf->setCodVerificacion($datos [0] ['detalleID']);
        
        $fileName = 'Anexo7-' . $datos [0] ['expediente'] . '.pdf'; 
        $this->pdf->Output($fileName, 'I');

        ob_end_flush();
    }
    
    
    
    public function resolucion($id) {

        $this->load->library('pdf');

        $datos = []; // $this->documento->obtener_datos_acta($convocatoriaID, $plazaID);

        $detail = $this->adjudicaciones_model->f_detail($id);
        $adjudicacion = $detail['adjudicacion'];

        $postulante = $adjudicacion->postulacion;
        $convocatoria = $adjudicacion->convocatoria;
        $plaza = $adjudicacion->plaza;
        $firmas = $adjudicacion->firmas;
        $tipo_documento = $postulante->tipo_documento == 1 ? 'DNI' : 'C.E';

        $this->db->reconnect();

        if (empty($adjudicacion)) {
            redirect("adjudicaciones");
        }
        ob_start();

        $this->pdf = new Pdf ();

        $this->pdf->header = 0;

        // Agregamos una página
        $this->pdf->AddPage();

        // Define el alias para el número de página que se imprimirá en el pie
        $this->pdf->AliasNbPages();

            $this->pdf->SetFont ( 'Times', 'B', 9 );
                        
                    $this->pdf->setFillColor ( 230, 230, 230 );
            $this->pdf->SetFont ( 'Times', 'BI', 13 );
            
            $this->pdf->Ln ( 2 );
            $this->pdf->Cell ( 200, 7, utf8_decode ( 'Unidad de Gestión Educativa Local Nº 05 - San Juan de Lurigancho y El Agustino' ), 0, 0, 'C', 0 );
            $this->pdf->Ln ( 6 );
            $this->pdf->SetFont ( 'Arial', 'IB', 9 );
            $this->pdf->Cell ( 200, 5, utf8_decode ( '"Año del Bicentenario, de la consolidación de nuestra Independencia,' ), 0, 0, 'C', 0 );
                        $this->pdf->Ln ( 5 );
            $this->pdf->SetFont ( 'Arial', 'IB', 9 );
                        $this->pdf->Cell ( 200, 5, utf8_decode ( 'y de la conmemoración de las heroicas batallas de Junín y Ayacucho."' ), 0, 0, 'C', 0 );
            $this->pdf->Ln ( 35 );
                        
            $this->pdf->Image ( 'public/images/escudo.jpg', 97, 30, 25 );

            $this->pdf->SetFont ( 'Times', 'BI', 17  );
            
            $this->pdf->Cell ( 170, 6, utf8_decode ( 'Resolución Directoral Nº _______-2024' ), 0, 0, 'C', 0 );
            $this->pdf->Ln ( 9 );
        
                        $fontSize = 10;
            $cellHeight = 4.4;
            $this->pdf->SetFont ( 'Arial', '', $fontSize );
//          $this->pdf->Cell(10, $cellHeight, utf8_decode( '' ), 0, 0, 'J', 0);
            $this->pdf->Cell(144, 5, utf8_decode( 'San Juan de Lurigancho y El Agustino,' ), 0, 0, 'C', 0);
            $this->pdf->Ln ( 10 );
                        $this->pdf->SetFont ( 'Arial', '', $fontSize );
//          $this->pdf->Cell(10, $cellHeight, utf8_decode( '' ), 0, 0, 'J', 0);
            $this->pdf->Cell(144, 5, utf8_decode( 'Vistos, los documentos adjuntos, y;' ), 0, 0, 'C', 0);

            $this->pdf->Ln ( 10 );
                                $this->pdf->SetFont ( 'Arial', 'B', $fontSize );
            $mensaje = 'CONSIDERANDO:';
//          $this->pdf->Cell(10, $cellHeight, utf8_decode( '' ), 0, 0, 'J', 0);
            $this->pdf->Cell(120, 5,  utf8_decode( $mensaje ), 0, 0, 'C', 0);
            //$this->pdf->MultiCell(0, $cellHeight, utf8_decode($mensaje), 0, 'L', 0, 20);
                        $this->pdf->Ln ( 7 );
                        
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('                 Que, es política del Ministerio de Educación garantizar el buen inicio del año escolar en concordancia con las políticas priorizadas y los compromisos de gestión escolar;'), 0);
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Ln(4);
        
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('                 Que, el artículo 76° de la Ley N° 29944, Ley de Reforma Magisterial dispone que las plazas vacantes existentes en las instituciones educativas públicas no cubiertas por nombramiento son atendidas vía concurso público de contratación docente'), 0);
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Ln(4);
        
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('                 Que, el artículo 1° de la Ley Nº 30328, Ley que establece medidas en materia educativa y dicta otras disposiciones, señala que el Contrato de Servicio Docente regulado en la Ley de Reforma Magisterial tiene por finalidad permitir la contratación temporal del profesorado en instituciones educativas públicas de educación básica y técnico productiva; es de plazo determinado y procede en el caso que exista plaza vacante en las instituciones educativas;'), 0);
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Ln(4);
        
   $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('                 Que, por Decreto Supremo Nº 020-2023-MINEDU, se aprueba la Norma que regula el procedimiento para las contrataciones de profesores y su renovación en el marco del contrato de servicio docente en educación básica y técnico productiva, a que hace referencia la ley N° 30328, ley que establece medidas en materia educativa y dicta otras disposiciones, con el objetivo de establecer disposiciones en relación al procedimiento, requisitos y condiciones para la contratación de profesores y la renovación de su contrato, en los programas educativos y en las IIEE públicas de Educación Básica y Técnico Productiva'), 0);
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Ln(4);
        
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('                 Estando a lo actuado por el comité de contratación docente / Jefe de Recursos Humanos, con el visto bueno de las dependencias correspondientes de la UGEL, el contrato suscrito entre el docente adjudicado y el titular de la entidad, y;'), 0);
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Ln(4);

        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('                 De conformidad con la Ley N° 28044 Ley General de Educación, Ley N° 29944 Ley de Reforma Magisterial y su modificatoria, Ley N° 31953:Ley de Presupuesto del Sector Público para el Año Fiscal 2024, Ley Nº 30328, Ley que establece medidas en materia educativa y dicta otras disposiciones, el Decreto Supremo N° 004-2013-ED que aprueba el Reglamento de la Ley de Reforma Magisterial y sus modificatorias, el Decreto Supremo N° 001-2015-MINEDU, que aprueba el Reglamento de Organización y Funciones del Ministerio de Educación, el Manual de Operaciones de la DRELM aprobado por R.M. 215-2015-MINEDU y las facultades previstas en la Ley 27444 Ley del Procedimiento Administrativo General;
        '), 0);
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Ln(4);

        
             $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('                 SE RESUELVE:'), 0);
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Ln(4);
        
           $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('                 ARTÍCULO 1º.- APROBAR EL CONTRATO, por servicios personales según el anexo que forma parte de la presente, suscrito por la Unidad Ejecutora y el personal docente que a continuación se indica:'), 0);
        $this->pdf->SetFont('Arial', '', 10);
        
        
        $this->pdf->Ln(5);
        



        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', 'BU', 9);
        $this->pdf->Cell(40, 7, '1.1. DATOS PERSONALES', '', 0, 'L', 0);
        $this->pdf->Ln(7);
        
        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->Cell(40, 7, 'APELLIDOS Y NOMBRES', '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', 'B', 8);
        $this->pdf->Cell(0, 7, utf8_decode(  $postulante->apellido_paterno . " " . $postulante->apellido_materno . ", " . $postulante->nombre), '', 0, 'L', 0);
        $this->pdf->Ln(4);

        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->Cell(40, 7, utf8_decode('DOC. DE IDENTIDAD'), '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', 'B', 8);
        $this->pdf->Cell(0, 7,utf8_decode(strlen($postulante->numero_documento) == 9 ? 'C.E. N°'. $postulante->numero_documento : 'D.N.I. N°'. $postulante->numero_documento), '', 0, 'L', 0);
        $this->pdf->Ln(4);

        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->Cell(40, 7, utf8_decode('SEXO '), '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', 'B', 8);
        $this->pdf->Cell(0, 7, utf8_decode($postulante->genero == 'M' ? 'MASCULINO': 'FEMENINO'), '', 0, 'L', 0);
        $this->pdf->Ln(4);
 
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->Cell(40, 7, utf8_decode('FECHA DE NACIMIENTO'), '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', 'B', 8);
        $this->pdf->Cell(0, 7, utf8_decode($postulante->fecha_nacimiento), '', 0, 'L', 0);
        $this->pdf->Ln(4);

         
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->Cell(40, 7, utf8_decode('REGIMEN PENSIONARIO'), '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', 'B', 8);
        $this->pdf->Cell(0, 7, utf8_decode($postulante->afiliacion == 'AFP' ? 'A.F.P.' : 'O.N.P.'), '', 0, 'L', 0);
        $this->pdf->Ln(4);


        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->Cell(40, 7, 'CUSSPP', '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', 'B', 8);
        $this->pdf->Cell(40, 7, utf8_decode($postulante->cuss), '', 0, 'L', 0);
        $this->pdf->Ln(5);


        
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->Cell(40, 7, utf8_decode('FECHA DE AFILIACIÓN'), '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', 'B', 8);
        $this->pdf->Cell(0, 7, utf8_decode("__________________"), '', 0, 'L', 0);
        $this->pdf->Ln(5);


        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->Cell(40, 7, utf8_decode('TITULO Y/O GRADO'), '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', 'B', 8);
        $this->pdf->Cell(0, 7, utf8_decode("__________________"), '', 0, 'L', 0);
        $this->pdf->Ln(4);
        


        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', '', 8);

        $this->pdf->Cell(40, 7, utf8_decode('ESPECIALIDAD'), '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', 'B', 8);
        $this->pdf->Cell(0, 7, utf8_decode("__________________"), '', 0, 'L', 0);


        $this->pdf->Ln(5);
        

        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', 'BU', 9);
        $this->pdf->Cell(40, 7, '1.2. DATOS DE LA PLAZA', '', 0, 'L', 0);
        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->Ln(7);


        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', '', 8);

        $this->pdf->Cell(40, 7, 'NIVEL Y/O MODALIDAD', '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', 'B', 8);

        $this->pdf->Cell(0, 7, utf8_decode("AAA"), '', 0, 'L', 0);
        $this->pdf->Ln(4);
        

        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->Cell(40, 7, utf8_decode('INSTITUCION EDUCATIVA'), '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', 'B', 8);
        $this->pdf->Cell(0, 7, utf8_decode($plaza->codigoPlaza), '', 0, 'L', 0);
        $this->pdf->Ln(4);


        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->Cell(40, 7, utf8_decode('CODIGO DE PLAZA'), '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', 'B', 8);
        $this->pdf->Cell(0, 7, utf8_decode($plaza->ie), '', 0, 'L', 0);
        $this->pdf->Ln(4);
        
       
        
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->Cell(40, 7, 'CARGO', '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', 'B', 8);
        $this->pdf->Cell(0, 7, utf8_decode($plaza->cargo), '', 0, 'L', 0);
        $this->pdf->Ln(4);
        
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->Cell(40, 7, 'MOTIVO DE VACANTE', '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $y = $this->pdf->GetY();
        $x = $this->pdf->GetX();
        $this->pdf->SetXY($x, $y + 1.5);
        $this->pdf->SetFont('Arial', 'B', 8);
        $this->pdf->MultiCell(0, 4, utf8_decode($plaza->motivo_vacante), 0, 'L', 0);
        
      
        
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', 'BU', 9);
        $this->pdf->Cell(40, 7, '1.3. DATOS DEL  CONTRATO', '', 0, 'L', 0);
        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->Ln(7);
        
         $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
         $this->pdf->SetFont('Arial', '', 8);

        $this->pdf->Cell(40, 7, 'NUM. DE EXPEDIENTE', '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', 'B', 8);
        $this->pdf->Cell(40, 7, utf8_decode($postulante->numero_expediente), '', 0, 'L', 0);
        $this->pdf->SetFont('Arial', '', 8);

        $this->pdf->Cell(15, 7, utf8_decode('Nº DE FOLIOS'), '', 0, 'LU', 0);
        $this->pdf->Cell(10, 7, '  :', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', 'B', 8);

         $this->pdf->Cell(0, 7, utf8_decode("__________________"), '', 0, 'L', 0);
        $this->pdf->Ln(5);
        
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->Cell(40, 7, 'REFERENCIA', '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', 'B', 8);

        $this->pdf->Cell(0, 7, utf8_decode('__________________'), '', 0, 'L', 0);
        $this->pdf->Ln(4);
        
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->Cell(40, 7, 'VIGENCIA DEL CONTRATO', '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', 'B', 8);

        $this->pdf->Cell(0, 7, utf8_decode('Desde el '. $adjudicacion->fecha_inicio .  ' hasta el '. $adjudicacion->fecha_final .""), '', 0, 'L', 0);
        $this->pdf->Ln(4);
        
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->Cell(40, 7, 'JORNADA LABORAL', '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', 'B', 8);
        $this->pdf->Cell(0, 7, utf8_decode($plaza->jornada).' '. utf8_decode('Horas Pedagógicas'), '', 0, 'L', 0);
        $this->pdf->Ln(5);
        
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', '', 8);

        $this->pdf->Cell(40, 7, 'DE LA ADJUDICACION', '', 0, 'L', 0);
        $this->pdf->Cell(10, 7, ':', '', 0, 'C', 0);
        $this->pdf->SetFont('Arial', 'B', 8);
        $this->pdf->Cell(0, 7, utf8_decode("__________________"), '', 0, 'L', 0);
        $this->pdf->Ln(10);

         $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('               ARTICULO 2°.- ESTABLECER, conforme al Anexo 1 del Decreto Supremo N° 020-2023-MINEDU, que contiene el documento "Contrato de Servicio Docente", es causal de resolución del contrato cualquiera de los motivos señalados en la Cláusula Sexta.'), 0);
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Ln(4);
        
               $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('               ARTICULO 3°.- AFÉCTESE a la cadena presupuestal correspondiente de acuerdo al Texto Único Ordenado del Clasificador de Gastos, tal como lo dispone La Ley N° 31953 que aprueba el Presupuesto del Sector Público para el Año Fiscal 2024.'), 0);
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Ln(4);
        
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Cell(5, 7, '', '', 0, 'C', 0);
        $this->pdf->MultiCell(180, 5, utf8_decode('               ARTÍCULO 4°.- NOTIFICAR, la presente resolución a la parte interesada e instancias administrativas pertinentes para su conocimiento y acciones de Ley.'), 0);
        $this->pdf->SetFont('Arial', '', 10);

        $this->pdf->Ln(15);


                    $this->pdf->MultiCell ( 170, $cellHeight, utf8_decode ( 'Regístrese y Comuníquese,' ), 0, 'C', 0 );
            $this->pdf->Ln ( 23 );
            $this->pdf->Cell ( 170, $cellHeight, utf8_decode ( '________________________________________________' ), 0, 0, 'C', 0 );
            $this->pdf->Ln ( $cellHeight );
            
 
            $this->pdf->SetFont ( 'Arial', 'B', $fontSize );
            $this->pdf->Cell ( 170, $cellHeight, utf8_decode ( 'Lic. JENNY KEITH LARA QUISPE' ), 0, 0, 'C', 0 );
            $this->pdf->Ln ( $cellHeight - 0.7 );
            $this->pdf->SetFont ( 'Arial', '', $fontSize - 1 );
            $this->pdf->Cell ( 170, $cellHeight, utf8_decode ( 'Directora del Programa Sectorial II' ), 0, 0, 'C', 0 );
            $this->pdf->Ln ( 4 );

            $this->pdf->Cell ( 170, $cellHeight, utf8_decode ( 'Unidad de Gestión Educativa Local Nº 05 - San Juan de Lurigancho y El Agustino' ), 0, 0, 'C', 0 );

            $this->pdf->Ln ( 7 );
                        
            $this->pdf->SetFont ( 'Arial', '', 5.2 );
            $this->pdf->Cell ( 170, $cellHeight, utf8_decode ( 'JKLQ/D.UGEL05' ), 0, 0, 'L', 0 );
            $this->pdf->Ln ( 2.5 );
            $this->pdf->Cell ( 170, $cellHeight, utf8_decode ( 'CMLLF/J.ARH' ), 0, 0, 'L', 0 );
            $this->pdf->Ln ( 2.5 );
            $this->pdf->Cell ( 170, $cellHeight, utf8_decode ( 'JRMC/C.EAP-ARH' ), 0, 0, 'L', 0 );
            $this->pdf->Ln ( 2.5 );
            $this->pdf->Cell ( 170, $cellHeight, utf8_decode ( 'JMQ/TEC. ADM-EAP' ), 0, 0, 'L', 0 );
        
//        $this->pdf->setExpediente($datos [0] ['expediente']);
//        $this->pdf->setCodVerificacion($datos [0] ['detalleID']);

       $fileName = 'Resolucion-' . "AA" . '.pdf'; 
        $this->pdf->Output($fileName, 'I');
        ob_end_flush();
    }
    
    
    
    
    
    
    
    /** FINAL - GENERACIÓN DE DOCUMENTO DE DECLARACIÓN JURADA (ANEXO N° 5 - DECLARACIÓN JUARADA PARA CONTRATACIÓN) * */

    /** INICIO - FUNCIÓN PARA CONVERTIR LOS NÚMERO EN LETRAS * */
    function num2letras($num, $fem = false, $dec = true) {
        $matuni [2] = "dos";

        $matuni [3] = "tres";

        $matuni [4] = "cuatro";

        $matuni [5] = "cinco";

        $matuni [6] = "seis";

        $matuni [7] = "siete";

        $matuni [8] = "ocho";

        $matuni [9] = "nueve";

        $matuni [10] = "diez";

        $matuni [11] = "once";

        $matuni [12] = "doce";

        $matuni [13] = "trece";

        $matuni [14] = "catorce";

        $matuni [15] = "quince";

        $matuni [16] = "dieciseis";

        $matuni [17] = "diecisiete";

        $matuni [18] = "dieciocho";

        $matuni [19] = "diecinueve";

        $matuni [20] = "veinte";

        $matunisub [2] = "dos";

        $matunisub [3] = "tres";

        $matunisub [4] = "cuatro";

        $matunisub [5] = "quin";

        $matunisub [6] = "seis";

        $matunisub [7] = "sete";

        $matunisub [8] = "ocho";

        $matunisub [9] = "nove";

        $matdec [2] = "veint";

        $matdec [3] = "treinta";

        $matdec [4] = "cuarenta";

        $matdec [5] = "cincuenta";

        $matdec [6] = "sesenta";

        $matdec [7] = "setenta";

        $matdec [8] = "ochenta";

        $matdec [9] = "noventa";

        $matsub [3] = 'mill';

        $matsub [5] = 'bill';

        $matsub [7] = 'mill';

        $matsub [9] = 'trill';

        $matsub [11] = 'mill';

        $matsub [13] = 'bill';

        $matsub [15] = 'mill';

        $matmil [4] = 'millones';

        $matmil [6] = 'billones';

        $matmil [7] = 'de billones';

        $matmil [8] = 'millones de billones';

        $matmil [10] = 'trillones';

        $matmil [11] = 'de trillones';

        $matmil [12] = 'millones de trillones';

        $matmil [13] = 'de trillones';

        $matmil [14] = 'billones de trillones';

        $matmil [15] = 'de billones de trillones';

        $matmil [16] = 'millones de billones de trillones';

        $tex = null;

        $fin = null;

        $neg = null;

        $float = null;

        // Zi hack

        $float = explode('.', $num);

        $num = $float [0];

        $num = trim($num);

        if ($num [0] == '-') {

            $neg = 'menos ';

            $num = substr($num, 1);
        } else
            $neg = '';

        while ($num [0] == '0')
            $num = substr($num, 1);

        if ($num [0] < '1' or $num [0] > 9)
            $num = '0' . $num;

        $zeros = true;

        $punt = false;

        $ent = '';

        $fra = '';

        for ($c = 0; $c < strlen($num); $c ++) {

            $n = $num [$c];

            if (!(strpos(".,'''", $n) === false)) {

                if ($punt)
                    break;

                else {

                    $punt = true;

                    continue;
                }
            } elseif (!(strpos('0123456789', $n) === false)) {

                if ($punt) {

                    if ($n != '0')
                        $zeros = false;

                    $fra .= $n;
                } else
                    $ent .= $n;
            } else
                break;
        }

        $ent = '     ' . $ent;

        if ($dec and $fra and ! $zeros) {

            $fin = ' coma';

            for ($n = 0; $n < strlen($fra); $n ++) {

                if (($s = $fra [$n]) == '0')
                    $fin .= ' cero';

                elseif ($s == '1')
                    $fin .= $fem ? ' una' : ' un';
                else
                    $fin .= ' ' . $matuni [$s];
            }
        } else
            $fin = '';

        if ((int) $ent === 0)
            return 'Cero ' . $fin;

        $tex = '';

        $sub = 0;

        $mils = 0;

        $neutro = false;

        while (($num = substr($ent, - 3)) != '   ') {

            $ent = substr($ent, 0, - 3);

            if (++$sub < 3 and $fem) {

                $matuni [1] = 'una';

                $subcent = 'as';
            } else {

                $matuni [1] = $neutro ? 'un' : 'uno';

                $subcent = 'os';
            }

            $t = '';

            $n2 = substr($num, 1);

            if ($n2 == '00') {
                
            } elseif ($n2 < 21)
                $t = ' ' . $matuni [(int) $n2];

            elseif ($n2 < 30) {

                $n3 = $num [2];

                if ($n3 != 0)
                    $t = 'i' . $matuni [$n3];

                $n2 = $num [1];

                $t = ' ' . $matdec [$n2] . $t;
            } else {

                $n3 = $num [2];

                if ($n3 != 0)
                    $t = ' y ' . $matuni [$n3];

                $n2 = $num [1];

                $t = ' ' . $matdec [$n2] . $t;
            }

            $n = $num [0];

            if ($n == 1) {

                $t = ' ciento' . $t;
            } elseif ($n == 5) {

                $t = ' ' . $matunisub [$n] . 'ient' . $subcent . $t;
            } elseif ($n != 0) {

                $t = ' ' . $matunisub [$n] . 'cient' . $subcent . $t;
            }

            if ($sub == 1) {
                
            } elseif (!isset($matsub [$sub])) {

                if ($num == 1) {

                    $t = ' mil';
                } elseif ($num > 1) {

                    $t .= ' mil';
                }
            } elseif ($num == 1) {

                $t .= ' ' . $matsub [$sub] . '?n';
            } elseif ($num > 1) {

                $t .= ' ' . $matsub [$sub] . 'ones';
            }

            if ($num == '000')
                $mils ++;

            elseif ($mils != 0) {

                if (isset($matmil [$sub]))
                    $t .= ' ' . $matmil [$sub];

                $mils = 0;
            }

            $neutro = true;

            $tex = $t . $tex;
        }

        $tex = $neg . substr($tex, 1) . $fin;

        // Zi hack --> return ucfirst($tex);

        $end_num = ucfirst($tex) . ' y ' . $float [1] . '/1000 Puntos ';

        return $end_num;
    }


}
