<?php 
    include('../database.php');

    if (isset($_POST['create_mantenimiento'])) {
        $fecha_mantenimiento = $_POST['fecha_mantenimiento'];
        $no_clave_control = $_POST['no_clave_control'];
        $tarjeta_responsable = $_POST['tarjeta_responsable'];
        $descripcion = $_POST['descripcion'];
        $no_factura = $_POST['no_factura'];
        $valor_neto = $_POST['valor_neto'];

        $query = "insert into mantenimiento(fecha_mantenimiento, no_clave_control, tarjeta_responsable, descripcion, no_factura, valor_neto) 
        values('$fecha_mantenimiento', '$no_clave_control', $tarjeta_responsable, '$descripcion', '$no_factura', $valor_neto)";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Consulta ha fallado.");
        }

        $_SESSION['message'] = '¡Mantenimiento registrado exitosamente!';
        $_SESSION['message_type'] = 'success';

        header('Location: ../mantenimientos_vw.php');
    }
?>