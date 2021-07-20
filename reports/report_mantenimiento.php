<?php 

    include('../database.php');
    include('plantilla_mantenimiento.php');


    $idmantenimiento = '';
    $fecha_mantenimiento = '';
    $no_clave_control = '';
    $tarjeta_responsable = '';
    $descripcion = '';
    $no_factura = '';
    $valor_neto = '';

    if (isset($_GET['idmantenimiento'])) {
        $idmantenimiento = $_GET['idmantenimiento'];

        $query = "select idmantenimiento, fecha_mantenimiento, no_clave_control, tarjeta_responsable, descripcion, no_factura, valor_neto from mantenimiento 
        where idmantenimiento = $idmantenimiento";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            $fecha_mantenimiento = $row['fecha_mantenimiento'];
            $no_clave_control = $row['no_clave_control'];
            $tarjeta_responsable = $row['tarjeta_responsable'];
            $descripcion = $row['descripcion'];
            $no_factura = $row['no_factura'];
            $valor_neto = $row['valor_neto'];
        }
    }

    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();

    $pdf->SetFillColor(232,232,232);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(210,6,'No. Clave de Control: '.$no_clave_control, 0, 1, 'L', 0);
    $pdf->Cell(210,6,'No. Tarjeta de Responsable: '.$tarjeta_responsable, 0, 1, 'L', 0);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(30,6,'Fecha', 0, 0, 'C', 1);
    $pdf->Cell(80,6, utf8_decode('Descripción'), 0, 0, 'C', 1);
    $pdf->Cell(40,6,'No. Factura', 0, 0, 'C', 1);
    $pdf->Cell(40,6,'Valor Neto', 0, 1, 'C', 1);

    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(30,10,$fecha_mantenimiento, 0, 0, 'C', 0);
    $pdf->MultiCell(80,5, utf8_decode($descripcion), 0, 'J', 0);
    $pdf->SetXY(120,68);
    $pdf->Cell(40,10,$no_factura, 0, 0, 'C', 0);
    $pdf->Cell(40,10,'Q '.$valor_neto, 0, 1, 'C', 0);

    $pdf->Output();
?>