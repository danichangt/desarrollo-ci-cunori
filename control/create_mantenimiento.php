<?php 
    include('../database.php');

    if (isset($_POST['create_mantenimiento'])) {
        $idasignacion = $_GET['idasignacion'];
        $fecha_mantenimiento = $_POST['fecha_mantenimiento'];
        $descripcion = $_POST['descripcion'];
        $no_factura = $_POST['no_factura'];
        $valor_neto = $_POST['valor_neto'];
        $query = "insert into mantenimiento(fecha_mantenimiento, descripcion, no_factura, valor_neto, asignacion_idasignacion) 
        values('$fecha_mantenimiento','$descripcion', '$no_factura', $valor_neto, $idasignacion)";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Consulta ha fallado.");
        }

        $_SESSION['message'] = '¡Registro creado!';
        $_SESSION['message_type'] = 'success';

        header('location: ../mantenimientos_vw.php');
    }
?>