<?php 

    include('../database.php');
    include('plantilla_mantenimiento.php');


    $idmantenimiento = '';
    $fecha_mantenimiento = '';
    $no_clave_control = '';
    $tarjeta_responsable = '';
    $responsable = '';
    $tipo_bien = '';
    $descripcion = '';
    $no_factura = '';
    $valor_neto = '';
    $areaemp = '';
    $localizacion = '';

    if (isset($_GET['idmantenimiento'])) {
        $idmantenimiento = $_GET['idmantenimiento'];

        $query = "select m.idmantenimiento, m.fecha_mantenimiento, b.no_clave_control, a.tarjeta_responsable, m.descripcion, m.no_factura, m.valor_neto,
         e.nombres, e.apellidos, t.descripcion as tipo, ae.descripcion as area, a.localizacion from mantenimiento m inner join asignacion a on m.asignacion_idasignacion = a.idasignacion inner join articulo b 
         on a.articulo_idarticulo = b.idarticulo inner join empleado e on a.empleado_idempleado = e.idempleado inner join tipo t on b.tipo_idtipo = t.idtipo inner join areaemp ae
         on e.areaemp_idarea = ae.idarea where idmantenimiento = $idmantenimiento";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            $fecha_mantenimiento = $row['fecha_mantenimiento'];
            $no_clave_control = $row['no_clave_control'];
            $tarjeta_responsable = $row['tarjeta_responsable'];
            $responsable = $row['nombres'].$row['apellidos'];
            $areaemp = $row['area'];
            $localizacion = $row['localizacion'];
            $tipo_bien = $row['tipo'];
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
    $pdf->Cell(105,6,'No. Clave de Control: '.$no_clave_control, 0, 0, 'L', 0);
    $pdf->Cell(105,6,utf8_decode('Tipo de bien: '.$tipo_bien), 0, 1, 'L', 0);
    $pdf->Cell(105,6,'No. Tarjeta de Responsable: '.$tarjeta_responsable, 0, 0, 'L', 0);
    $pdf->Cell(105,6,utf8_decode('Localización: '.$localizacion), 0, 1, 'L', 0);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(25,6,'Fecha', 0, 0, 'C', 1);
    $pdf->Cell(75,6, utf8_decode('Descripción'), 0, 0, 'C', 1);
    $pdf->Cell(32,6,'No. Factura', 0, 0, 'C', 1);
    $pdf->Cell(30,6,'Valor Neto', 0, 0, 'C', 1);
    $pdf->Cell(30,6,'Firma', 0, 1, 'C', 1);

    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(25,6,$fecha_mantenimiento, 0, 0, 'C', 0);
    $pdf->MultiCell(75,5, utf8_decode($descripcion), 0, 'J', 0);
    $pdf->SetXY(110,68);
    $pdf->Cell(32,6,$no_factura, 0, 0, 'C', 0);
    $pdf->Cell(30,6,'Q '.$valor_neto, 0, 1, 'C', 0);

    $pdf->SetXY(10,-36);
    $pdf->Cell(80,6,utf8_decode($responsable), 0, 0, 'C', 0);
    $pdf->SetXY(10,-30);
    $pdf->Cell(80,6,'Nombre del responsable', 'T', 0, 'C', 0);
    $pdf->SetXY(-90,-36);
    $pdf->Cell(80,6,utf8_decode($areaemp), 0, 0, 'C', 0);
    $pdf->SetXY(-90,-30);
    $pdf->Cell(80,6,utf8_decode('Área del empleado'), 'T', 0, 'C', 0);

    $pdf->Output('I', 'Reporte_mantenimiento'.$no_factura.'.pdf', true);
?>