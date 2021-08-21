<?php 
    include('../database.php');

    $idasignacion = '';
    $fecha_asignacion = '';
    $autorizacion = '';
    $seccion = '';

    if (isset($_POST['actualizar'])) {
        $idasignacion = $_GET['idasignacion'];
        $fecha_asignacion = $_POST['fecha_asignacion'];
        $autorizacion = $_POST['autorizacion'];
        $seccion = $_POST['seccion'];

        $query = "update asignacion set fecha_asignacion = '$fecha_asignacion', autorizacion = '$autorizacion', seccion = '$seccion' where idasignacion = $idasignacion";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            die("fallo");
        }

        $_SESSION['message'] = '¡Registro actualizado!';
        $_SESSION['message_type'] = 'info';

        header('Location: ../traslados_tb.php');
    }

?>