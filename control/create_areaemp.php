<?php

    include('../database.php');

    if (isset($_POST['create_areaemp'])) {
        $descripcion = $_POST['descripcion'];

        $query = "insert into areaemp(descripcion) values('$descripcion')";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Consulta ha fallado.");
        }

        header('Location: ../areaemp_vw.php');
    }

?>