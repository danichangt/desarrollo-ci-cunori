<?php 
    include("../database.php"); 

    $idasignacion = '';
    $tarjeta_responsable = '';
    $fecha_asignacion = '';
    $articulo_idarticulo = '';
    $empleado_idempleado = '';

    if (isset($_POST['actualizar'])) {
        $idasignacion = $_GET['idasignacion'];
        $tarjeta_responsable = $_POST['tarjeta_responsable'];
        $fecha_asignacion = $_POST['fecha_asignacion'];
        $empleado_idempleado = $_POST['empleado_idempleado'];
        $articulo_idarticulo = $_POST['articulo_idarticulo'];
        $tarjeta_responsable_anterior = '';

        $query_select = "select tarjeta_responsable from asignacion where idasignacion = $idasignacion";
        $result_select = mysqli_query($conn, $query_select);
        if (mysqli_num_rows($result_select) == 1) {
            $row = mysqli_fetch_assoc($result_select);
            $tarjeta_responsable_anterior = $row['tarjeta_responsable'];
        }
        
        if ($tarjeta_responsable != $tarjeta_responsable_anterior) {
            $query_update_contador = "update asignacion set contador_traslado = 1 where idasignacion = $idasignacion";
            $result_update = mysqli_query($conn, $query_update_contador);
            $query = "update asignacion set tarjeta_responsable = $tarjeta_responsable, fecha_asignacion = '$fecha_asignacion', empleado_idempleado = $empleado_idempleado 
            where idasignacion = $idasignacion";
            $result = mysqli_query($conn, $query);
        }else{
            $query = "update asignacion set tarjeta_responsable = $tarjeta_responsable, fecha_asignacion = '$fecha_asignacion', empleado_idempleado = $empleado_idempleado 
            where idasignacion = $idasignacion";
            $result = mysqli_query($conn, $query);
        }

        if (!$result) {
            die("fallo");
        }
        $_SESSION['message'] = '¡Registro actualizado!';
        $_SESSION['message_type'] = 'info';

        header('location: ../asignaciones_tb.php');
    }


?>