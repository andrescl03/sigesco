<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * CodeIgniter PDF Library
 *
 * Generate PDF in CodeIgniter applications.
 *
 * @package            CodeIgniter
 * @subpackage        Libraries
 * @category        Libraries
 * @author            CodexWorld
 * @license            https://www.codexworld.com/license/
 * @link            https://www.codexworld.com
 */

// Incluimos el archivo fpdf
require_once APPPATH . "/third_party/fpdf/fpdf.php";

// reference the Dompdf namespace
use Dompdf\Dompdf;

class Pdf_
{
    public function __construct(){
        
        // include autoloader
        require_once dirname(__FILE__).'/dompdf/autoload.inc.php';
        
        // instantiate and use the dompdf class
        $pdf = new DOMPDF();
        
        $CI =& get_instance();
        $CI->dompdf = $pdf;
        
    }
}


//Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
class Pdf extends FPDF {

    var $exp;
    var $cod_verificacion;

    public function __construct() {
        parent::__construct();
    }

    // El encabezado del PDF
    public function Header() {

        $this->Image('dist/img/logo.png', 9, 10, 189, 15);
        $this->Ln(17);
        $this->SetFont('Arial', 'BU', 13);
    }

    function setExpediente($numero) {
        $this->exp = $numero;
    }

    function getExpediente() {
        return $this->exp;
    }

    function setCodVerificacion($numero) {
        $this->cod_verificacion = $numero;
    }

    function getCodVerificacion() {
        return $this->cod_verificacion;
    }

    // El pie del pdf
    public function Footer() {
        /*$this->SetY(-25);
        $this->Line(50, 270, 110, 270);
        $this->Rect(120, 244, 50, 30);
        $this->Cell(60, 7, '', '', 0, 'C', 0);
        $this->SetFont('Arial', 'B', 7);
        $this->Cell(70, 7, utf8_decode('Recibí conforme'), '', 0, 'LU', 0);
        $this->Cell(20, 7, utf8_decode('SELLO'), '', 0, 'LU', 0);
        $this->Ln(4);
        $this->Cell(80, 7, '', '', 0, 'C', 0);
        $this->Cell(0, 7, '', '', 0, 'LU', 0);
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo(), 0, 0, 'C');*/
    }

    /* FUNCIONES PARA CREAR TABLA DINAMICA */

    // Margins
    var $left = 10;
    var $right = 10;
    var $top = 10;
    var $bottom = 10;

    // Create Table
    public function WriteTable($tcolums) {
        // go through all colums
        for ($i = 0; $i < sizeof($tcolums); $i++) {
            $current_col = $tcolums[$i];
            $height = 0;

            // get max height of current col
            $nb = 0;
            for ($b = 0; $b < sizeof($current_col); $b++) {
                // set style
                $this->SetFont($current_col[$b]['font_name'], $current_col[$b]['font_style'], $current_col[$b]['font_size']);
                $color = explode(",", $current_col[$b]['fillcolor']);
                $this->SetFillColor($color[0], $color[1], $color[2]);
                $color = explode(",", $current_col[$b]['textcolor']);
                $this->SetTextColor($color[0], $color[1], $color[2]);
                $color = explode(",", $current_col[$b]['drawcolor']);
                $this->SetDrawColor($color[0], $color[1], $color[2]);
                $this->SetLineWidth($current_col[$b]['linewidth']);

                $nb = max($nb, $this->NbLines($current_col[$b]['width'], $current_col[$b]['text']));
                $height = $current_col[$b]['height'];
            }
            $h = $height * $nb;


            // Issue a page break first if needed
            $this->CheckPageBreak($h);

            // Draw the cells of the row
            for ($b = 0; $b < sizeof($current_col); $b++) {
                $w = $current_col[$b]['width'];
                $a = $current_col[$b]['align'];

                // Save the current position
                $x = $this->GetX();
                $y = $this->GetY();

                // set style
                $this->SetFont($current_col[$b]['font_name'], $current_col[$b]['font_style'], $current_col[$b]['font_size']);
                $color = explode(",", $current_col[$b]['fillcolor']);
                $this->SetFillColor($color[0], $color[1], $color[2]);
                $color = explode(",", $current_col[$b]['textcolor']);
                $this->SetTextColor($color[0], $color[1], $color[2]);
                $color = explode(",", $current_col[$b]['drawcolor']);
                $this->SetDrawColor($color[0], $color[1], $color[2]);
                $this->SetLineWidth($current_col[$b]['linewidth']);

                $color = explode(",", $current_col[$b]['fillcolor']);
                $this->SetDrawColor($color[0], $color[1], $color[2]);


                // Draw Cell Background
                $this->Rect($x, $y, $w, $h, 'FD');

                $color = explode(",", $current_col[$b]['drawcolor']);
                $this->SetDrawColor($color[0], $color[1], $color[2]);

                // Draw Cell Border
                if (substr_count($current_col[$b]['linearea'], "T") > 0) {
                    $this->Line($x, $y, $x + $w, $y);
                }

                if (substr_count($current_col[$b]['linearea'], "B") > 0) {
                    $this->Line($x, $y + $h, $x + $w, $y + $h);
                }

                if (substr_count($current_col[$b]['linearea'], "L") > 0) {
                    $this->Line($x, $y, $x, $y + $h);
                }

                if (substr_count($current_col[$b]['linearea'], "R") > 0) {
                    $this->Line($x + $w, $y, $x + $w, $y + $h);
                }


                // Print the text
                $this->MultiCell($w, $current_col[$b]['height'], $current_col[$b]['text'], 0, $a, 0);

                // Put the position to the right of the cell
                $this->SetXY($x + $w, $y);
            }

            // Go to the next line
            $this->Ln($h);
        }
    }

    // If the height h would cause an overflow, add a new page immediately
    public function CheckPageBreak($h) {
        if (($this->GetY() + 35) + $h > $this->PageBreakTrigger) {
            $this->AddPage($this->CurOrientation);
            $this->SetFont('Arial', 'B', 7);
            $this->Ln(10);
            $this->Cell(15, 6, '', 0, 0, 0);
            $this->Cell(30, 6, utf8_decode('DOCUMENTO'), 1, 0, 'C');
            $this->Cell(30, 6, utf8_decode('FECHA EMISIÓN'), 1, 0, 'C');
            $this->Cell(50, 6, utf8_decode('ASUNTO'), 1, 0, 'C');
            $this->Cell(50, 6, utf8_decode('FECHA DERIVACIÓN'), 1, 0, 'C');
            $this->Ln(6);
        }
    }

    // Computes the number of lines a MultiCell of width w will take
    public function NbLines($w, $txt) {
        $cw = &$this->CurrentFont['cw'];
        if ($w == 0)
            $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 and $s[$nb - 1] == "\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ')
                $sep = $i;
            $l += $cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j)
                        $i++;
                } else
                    $i = $sep + 1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else
                $i++;
        }
        return $nl;
    }

}

?>