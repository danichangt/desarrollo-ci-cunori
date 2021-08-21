<?php

    include('../database.php');
    include('plantilla_asignaciones.php');

    $idempleado = '';

    $codigo = '';
    $nombres = '';
    $apellidos = '';
    date_default_timezone_set("America/Guatemala");
    $fecha = date("d/m/Y, G:i");

    $ae_descripcion = '';

    
    if(isset($_GET['idempleado'])){
        $idempleado = $_GET['idempleado'];
        $query = "select e.codigo, e.nombres, e.apellidos, ae.descripcion as area from empleado e inner join areaemp ae on e.areaemp_idarea = ae.idarea where e.idempleado = $idempleado";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);

            $codigo = $row['codigo'];
            $nombres = $row['nombres'];
            $apellidos = $row['apellidos'];

            $ae_descripcion = $row['area'];
        }
    }

    

    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage('L', 'Letter', 0);

    $pdf->SetFillColor(232,232,232);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(110,6,utf8_decode('Código de Empleado: '.$codigo), 0, 0, 'L', 0);
    $pdf->SetX(-66);
    $pdf->Cell(110,6,utf8_decode('Área: '.$ae_descripcion), 0, 1, 'L', 0);
    $pdf->SetX(10);
    $pdf->Cell(0,6,utf8_decode('Nombre Completo: '.$nombres.$apellidos), 0, 0, 'L', 0);
    $pdf->SetX(-66);
    $pdf->Cell(0,6,utf8_decode('Creado el: '.$fecha), 0, 1, 'L', 0);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(10,6,'', 0, 0, 'C', 1);//no
    $pdf->Cell(25,6,'', 0, 0, 'C', 1);//fecha
    $pdf->Cell(30,6,utf8_decode('Tarjeta de'), 0, 0, 'C', 1);
    $pdf->Cell(25,6,utf8_decode('Código de'), 0, 0, 'C', 1);
    $pdf->Cell(22,6,'', 0, 0, 'C', 1);//valor
    $pdf->Cell(20,6,'', 0, 0, 'C', 1);//folio
    $pdf->Cell(40,6,'', 0, 0, 'C', 1);//localizacion
    $pdf->Cell(0,6,'', 0, 1, 'C', 1);//descripcion
    $pdf->Cell(10,6,'No.', 0, 0, 'C', 1);
    $pdf->Cell(25,6,'Fecha', 0, 0, 'C', 1);
    $pdf->Cell(30,6,utf8_decode('Responsable'), 0, 0, 'C', 1);
    $pdf->Cell(25,6,utf8_decode('Control'), 0, 0, 'C', 1);
    $pdf->Cell(22,6,'Valor', 0, 0, 'C', 1);
    $pdf->Cell(20,6,'Folio', 0, 0, 'C', 1);
    $pdf->Cell(40,6,utf8_decode('Localización'), 0, 0, 'C', 1);
    $pdf->Cell(0,6, utf8_decode('Descripción'), 0, 1, 'C', 1);
    

    $pdf->SetFont('Arial', '', 11);
    $contador = 1;
    $query_bienes = "select a.fecha_asignacion, a.tarjeta_responsable, b.no_clave_control, a.localizacion, b.descripcion, b.folio, b.valor from asignacion a inner join articulo b 
    on a.articulo_idarticulo = b.idarticulo where a.empleado_idempleado = $idempleado and a.estado = 1 order by a.fecha_asignacion asc";
    $result_bienes = mysqli_query($conn, $query_bienes);
    
    while ($row2 = mysqli_fetch_assoc($result_bienes)) {
        $pdf->Cell(10,6,$contador, 'T', 0, 'C', 0);
        $pdf->Cell(25,6,$row2['fecha_asignacion'], 'T', 0, 'C', 0);
        $pdf->Cell(30,6,$row2['tarjeta_responsable'],'T', 0, 'C', 0);
        $pdf->Cell(25,6,$row2['no_clave_control'], 'T', 0, 'C', 0);
        $pdf->Cell(22,6,'Q '.$row2['valor'], 'T', 0, 'C', 0);
        $pdf->Cell(20,6,$row2['folio'], 'T', 0, 'C', 0);
        $pdf->Cell(40,6,$row2['localizacion'], 'T', 0, 'C', 0);
        $pdf->MultiCell(0,6, utf8_decode($row2['descripcion']), 'T', 'J', 0);
        $pdf->Ln(3);
        $contador = $contador + 1;
    }

    $pdf->Output('I', 'Reporte_asignaciones_'.$nombres.$apellidos.'.pdf', true);
?>