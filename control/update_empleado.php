<?php

    include('../database.php');

    $dpi = '';
    $codigo = '';
    $nombres = '';
    $apellidos = '';
    $areaemp_idarea = '';

    if (isset($_POST['actualizar'])) {
        $idempleado = $_GET['idempleado'];
        $dpi = $_POST['dpi'];
        $codigo = $_POST['codigo'];
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $areaemp_idarea = $_POST['areaemp_idarea'];


        $query = "update empleado set dpi = '$dpi', codigo = '$codigo', nombres = '$nombres', apellidos = '$apellidos', areaemp_idarea = $areaemp_idarea where idempleado = $idempleado";
        mysqli_query($conn, $query);

        $_SESSION['message'] = '¡Registro actualizado!';
        $_SESSION['message_type'] = 'info';
        header('Location: ../empleado_vw.php');

    }

?>