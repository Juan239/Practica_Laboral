<?php
require('fpdf/fpdf.php');
$data = json_decode($_GET['data'], true);

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        $data = json_decode($_GET['data'], true);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->Cell(30,10,utf8_decode('Orden de trabajo N°'.$data['ot_id']),0,0,'C');
        // Salto de línea
        $this->Ln(20);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-25);

        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10,utf8_decode('Página '.$this->PageNo().'/{nb}'),0,0,'C');

        $this->SetXY(-100,-50);
        $this->SetFont('Arial','B',14);
        $this->Cell(0,10,'Firma responsable',0,1,'C');

        $this->SetXY(-300,-50);
        $this->SetFont('Arial','B',14);
        $this->Cell(0,10,'Firma emisor',0,1,'C');
        

        // Arial italic 8
        
    }
}


$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);


// Datos de la orden de trabajo
$pdf->Cell(0,10,utf8_decode('Establecimiento: '.$data['Establecimiento']),0,1);
$pdf->Cell(0,10, utf8_decode('Intervención: '.$data['Intervencion']),0,1);
$pdf->Cell(0,10,utf8_decode('Fecha: '.$data['Fecha']),0,1);
$pdf->Cell(0,10,utf8_decode('Responsable: '.$data['Responsable']),0,1);

$pdf->Ln(10);

// Subtítulo Descripción
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,10,utf8_decode('Descripción'),0,1);
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,10,utf8_decode($data['Descripcion']),0,1);

// Espacio adicional
$pdf->Ln(20);

// Subtítulo Observaciones
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,10,'Observaciones',0,1);
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,10,utf8_decode($data['Observaciones']),0,1);


$pdf->Ln(30);
// Firma


$pdf->Output();
?>
