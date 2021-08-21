<?php 
    include('../database.php');

    if (isset($_POST['create_asignacion'])) {
        $tarjeta_responsable = $_POST['tarjeta_responsable'];
        $fecha_asignacion = $_POST['fecha_asignacion'];
        $articulo_idarticulo = $_GET['idarticulo'];
        $empleado_idempleado = $_POST['empleados'];
        $localizacion = $_POST['localizacion'];

        $query = "insert into asignacion(tarjeta_responsable, fecha_asignacion, localizacion, articulo_idarticulo, empleado_idempleado) 
                    values($tarjeta_responsable, '$fecha_asignacion', '$localizacion', $articulo_idarticulo, $empleado_idempleado)";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Consulta ha fallado.");
        }

        $query_update = "update articulo set disponible = 0 where idarticulo = $articulo_idarticulo";
        mysqli_query($conn, $query_update);

        $_SESSION['message'] = '¡Registro creado!';
        $_SESSION['message_type'] = 'success';

        header('location: ../add_articulo.php');
    }

    if (isset($_GET['idasignacion'])) {
        $idasignacion = $_GET['idasignacion'];
        $tarjeta_responsable = $_POST['tarjeta_responsable'];
        $fecha_asignacion = $_POST['fecha_asignacion'];
        $localizacion = $_POST['localizacion'];
        $autorizacion = $_POST['autorizacion'];
        $seccion = $_POST['seccion'];
        $contador_traslado = '';
        $empleado_idempleado = $_POST['empleados'];
        $asignacion_idasignacion = $idasignacion;
        $articulo_idarticulo = '';

        $query_selct = "select articulo_idarticulo, contador_traslado  from asignacion where idasignacion = $idasignacion";
        $result_select = mysqli_query($conn, $query_selct);
        if (mysqli_num_rows($result_select) == 1) {
            $row_select = mysqli_fetch_array($result_select);
            $articulo_idarticulo = $row_select['articulo_idarticulo'];
            $contador_traslado = $row_select['contador_traslado'];
        }

        $contador_traslado = $contador_traslado + 1;
        $query_insert = "insert into asignacion(tarjeta_responsable, fecha_asignacion, localizacion, autorizacion, seccion, contador_traslado, articulo_idarticulo, empleado_idempleado, asignacion_idasignacion) 
        values($tarjeta_responsable, '$fecha_asignacion', '$localizacion', '$autorizacion', '$seccion', $contador_traslado, $articulo_idarticulo, $empleado_idempleado, $asignacion_idasignacion)";
        $result_insert = mysqli_query($conn, $query_insert);

        if (!$result_insert) {
            die("Consulta ha fallado.");
        }

        $query_update_articulo = "update asignacion inner join articulo on articulo_idarticulo = idarticulo set articulo.disponible = 0, asignacion.estado = 0 where idasignacion = $idasignacion";
        mysqli_query($conn, $query_update_articulo);

        $_SESSION['message'] = '¡Registro creado!';
        $_SESSION['message_type'] = 'success';

        header('location: ../traslados_tb.php');
    }
?>