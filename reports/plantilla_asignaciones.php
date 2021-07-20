<?php 

    require('../lib/fpdf183/fpdf.php');

    class PDF extends FPDF {

        function Header(){
            $this->Image('../images/usac.png', 10, 6, 25);
            $this->SetFont('Arial','','12');
            $this->Ln();
            $this->Cell(30);
            $this->Cell(120,5, 'UNIVERSIDAD DE SAN CARLOS DE GUATEMALA', 0,1,'L');
            $this->Cell(30);
            $this->Cell(120,5, 'CENTRO UNIVERSITARIO DE ORIENTE', 0,1,'L');
            $this->Cell(30);
            $this->Cell(120,5, 'CONTROL DE INVENTARIOS', 0,1,'L');

            $this->Ln(15);
            $this->SetFont('Arial','B','12');
            $this->Cell(0, 6, utf8_decode('TARJETA DE CONTROL DE ASIGNACIÓN DE BIENES'), 0, 1, 'C');
            $this->Ln(3);
        }

        function Footer() {
            $this->SetY(-15);
            $this->SetFont('Arial','', 8);
            $this->Cell(0, 10, utf8_decode('Página ').$this->PageNo().' de {nb}', 0, 0, 'C');
        }

    }
?>