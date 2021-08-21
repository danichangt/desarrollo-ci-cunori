<?php 

    include('../database.php');
    include('../lib/fpdf183/fpdf.php');

    $idasignacion = '';
    $fecha = '';
    $tarjeta_responsable = '';
    $no_clave_control = '';
    $localizacion = '';
    $descripcion = '';
    $valor = '';
    
    $dpi = '';
    $codigo = '';
    $nombres = '';
    $apellidos = '';

    if (isset($_GET['idasignacion'])) {
        $idasignacion = $_GET['idasignacion'];

        $query = "select a.fecha_asignacion, a.tarjeta_responsable, a.localizacion, b.no_clave_control, b.descripcion, b.valor, e.dpi, e.codigo, e.nombres, e.apellidos from asignacion a inner join articulo b 
        on a.articulo_idarticulo = b.idarticulo inner join empleado e on a.empleado_idempleado = e.idempleado where idasignacion = $idasignacion";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $fecha = $row['fecha_asignacion'];
            $tarjeta_responsable = $row['tarjeta_responsable'];
            $no_clave_control = $row['no_clave_control'];
            $localizacion = $row['localizacion'];
            $descripcion = $row['descripcion'];
            $valor = $row['valor'];
            $dpi = $row['dpi'];
            $codigo = $row['codigo'];
            $nombres = $row['nombres'];
            $apellidos = $row['apellidos'];
        }
    }


    $pdf = new FPDF('L','cm', array(14, 21.5));
    $pdf->SetMargins(1.35,3.7,1.35);
    $pdf->AddPage();
    $pdf->SetFont('Arial','',10);
    $pdf->setXY(16.25,3.2);
    $pdf->Cell(3.9,0.5,$localizacion, 0, 1, 'L', 0);
    $pdf->setXY(1.35,5.7);
    $pdf->Cell(2.5,0.5,$fecha, 0, 0, 'C', 0);
    $pdf->Cell(2.5,0.5,$no_clave_control, 0, 0, 'C', 0);
    $pdf->Cell(0.15,0.5,'', 0, 0, 'C', 0);
    $pdf->MultiCell(6, 0.4, utf8_decode($descripcion), 0, 'J', 0);
    $pdf->setXY(12.5,5.7);
    $pdf->Cell(0.15,0.5,'', 0, 0, 'C', 0);
    $pdf->Cell(2.5,0.5,'Q'.$valor, 0, 0, 'C', 0);
    $pdf->MultiCell(2.5, 0.4, utf8_decode($dpi."/\n".$codigo."\n".$nombres.$apellidos), 0, 'J', 0);
    $pdf->Output('I', 'Reporte_asignacion_'.$tarjeta_responsable.'.pdf', true);
?>