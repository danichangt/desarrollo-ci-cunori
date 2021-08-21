<?php 

    include("../database.php"); 

    $idmantenimiento = '';
    $fecha_mantenimiento = '';
    $descripcion = '';
    $no_factura = '';
    $valor_neto = '';

    if (isset($_POST['actualizar'])) {
        $idmantenimiento = $_GET['idmantenimiento'];
        $fecha_mantenimiento = $_POST['fecha_mantenimiento'];
        $descripcion = $_POST['descripcion'];
        $no_factura = $_POST['no_factura'];
        $valor_neto = $_POST['valor_neto'];

        $query = "update mantenimiento set fecha_mantenimiento = '$fecha_mantenimiento', descripcion = '$descripcion', no_factura = '$no_factura',
         valor_neto = $valor_neto where idmantenimiento = $idmantenimiento";
        mysqli_query($conn, $query);

        if (!mysqli_query($conn, $query)) {
           die("fallo");
        }
        $_SESSION['message'] = '¡Registro actualizado!';
        $_SESSION['message_type'] = 'info';
        header('location: ../mantenimientos_vw.php');
    }

?>