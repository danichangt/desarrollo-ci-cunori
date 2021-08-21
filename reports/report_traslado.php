<?php 

    include('../database.php');
    include('../lib/fpdf183/fpdf.php');

    $idasignacion = '';
    $fecha_traslado = '';
    $autorizacion = '';
    $seccion = '';
    $dpi = '';
    $codigo = '';
    $nombres = '';
    $apellidos = '';
    $contador = '';

    if (isset($_GET['idasignacion'])) {
        $idasignacion = $_GET['idasignacion'];

        $query = "select fecha_asignacion, autorizacion, seccion, contador_traslado as contador, dpi, codigo, nombres, apellidos from asignacion inner join 
        empleado on empleado_idempleado = idempleado where idasignacion = $idasignacion";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $fecha_traslado = $row['fecha_asignacion'];
            $autorizacion = $row['autorizacion'];
            $seccion = $row['seccion'];
            $dpi = $row['dpi'];
            $codigo = $row['codigo'];
            $nombres = $row['nombres'];
            $apellidos = $row['apellidos'];
            $contador = $row['contador'];
        }
    }


    $pdf = new FPDF('L','cm', array(14, 21.5));
    $pdf->SetMargins(1,3.3,1);
    $pdf->AddPage();
    $pdf->SetFont('Arial','',10);

    switch ($contador) {
        case 1:
            $pdf->Cell(2.5,0.5,$fecha_traslado, 0, 0, 'C', 0);
            $pdf->Cell(2.6,0.5,utf8_decode($autorizacion), 0, 0, 'C', 0);
            $pdf->Cell(0.15,0.5,'', 0, 0, 'C', 0);
            $pdf->MultiCell(9, 0.4, utf8_decode($seccion), 0, 'J', 0);
            $pdf->setXY(15.4,3.3);
            $pdf->Cell(0.15,0.5,'', 0, 0, 'C', 0);
            $pdf->MultiCell(2.6, 0.4, utf8_decode($dpi.'/'.$codigo."\n".$nombres.$apellidos), 0, 'J', 0);
            $pdf->Output('I', 'Reporte_traslado_'.'.pdf', true);
            break;
        
        case 2:
            $pdf->setXY(1,5.5);
            $pdf->Cell(2.5,0.5,$fecha_traslado, 0, 0, 'C', 0);
            $pdf->Cell(2.6,0.5,utf8_decode($autorizacion), 0, 0, 'C', 0);
            $pdf->Cell(0.15,0.5,'', 0, 0, 'C', 0);
            $pdf->MultiCell(9, 0.4, utf8_decode($seccion), 0, 'J', 0);
            $pdf->setXY(15.4,5.5);
            $pdf->Cell(0.15,0.5,'', 0, 0, 'C', 0);
            $pdf->MultiCell(2.6, 0.4, utf8_decode($dpi.'/'.$codigo."\n".$nombres.$apellidos), 0, 'J', 0);
            $pdf->Output('I', 'Reporte_traslado_'.'.pdf', true);
            break;

        case 3:
                $pdf->setXY(1,7.7);
                $pdf->Cell(2.5,0.5,$fecha_traslado, 0, 0, 'C', 0);
                $pdf->Cell(2.6,0.5,utf8_decode($autorizacion), 0, 0, 'C', 0);
                $pdf->Cell(0.15,0.5,'', 0, 0, 'C', 0);
                $pdf->MultiCell(9, 0.4, utf8_decode($seccion), 0, 'J', 0);
                $pdf->setXY(15.4,7.7);
                $pdf->Cell(0.15,0.5,'', 0, 0, 'C', 0);
                $pdf->MultiCell(2.6, 0.4, utf8_decode($dpi.'/'.$codigo."\n".$nombres.$apellidos), 0, 'J', 0);
                $pdf->Output('I', 'Reporte_traslado_'.'.pdf', true);
                break;

        case 4:
            $pdf->setXY(1,9.9);
            $pdf->Cell(2.5,0.5,$fecha_traslado, 0, 0, 'C', 0);
            $pdf->Cell(2.6,0.5,utf8_decode($autorizacion), 0, 0, 'C', 0);
            $pdf->Cell(0.15,0.5,'', 0, 0, 'C', 0);
            $pdf->MultiCell(9, 0.4, utf8_decode($seccion), 0, 'J', 0);
            $pdf->setXY(15.4,9.9);
            $pdf->Cell(0.15,0.5,'', 0, 0, 'C', 0);
            $pdf->MultiCell(2.6, 0.4, utf8_decode($dpi.'/'.$codigo."\n".$nombres.$apellidos), 0, 'J', 0);
            $pdf->Output('I', 'Reporte_traslado_'.'.pdf', true);
            break;

    }
    
    
?>