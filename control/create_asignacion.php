<?php 
    include('../database.php');

    if (isset($_POST['create_asignacion'])) {
        $tarjeta_responsable = $_POST['tarjeta_responsable'];
        $fecha_asignacion = $_POST['fecha_asignacion'];
        $articulo_idarticulo = $_GET['idarticulo'];
        $empleado_idempleado = $_POST['empleados'];

        $query = "insert into asignacion(tarjeta_responsable, fecha_asignacion, articulo_idarticulo, empleado_idempleado) 
                    values($tarjeta_responsable, '$fecha_asignacion', $articulo_idarticulo, $empleado_idempleado)";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Consulta ha fallado.");
        }

        $query_update = "update articulo set disponible = 0 where idarticulo = $articulo_idarticulo";
        mysqli_query($conn, $query_update);

        $_SESSION['message'] = '¡El bien ha sido asignado satisfactoriamente!';
        $_SESSION['message_type'] = 'success';

        header('Location: ../add_articulo.php');
    }
?>