<?php

    include('../database.php');

    if (isset($_POST['create_empleado'])) {
        
        $dpi = $_POST['dpi'];
        $codigo = $_POST['codigo'];
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $areaemp_idarea = $_POST['areaemp_idarea'];

        $query = "insert into empleado (dpi, codigo, nombres, apellidos, areaemp_idarea) values ('$dpi', '$codigo', '$nombres', '$apellidos', $areaemp_idarea)";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("La consulta ha fallado");
        }

        header('Location: ../empleado_vw.php');
    }




?>