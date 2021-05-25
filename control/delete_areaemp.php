<?php

    include('../database.php');

    if (isset($_GET['idarea'])) {

        $idarea = $_GET['idarea'];
        $query = "delete from areaemp where idarea = $idarea";
        $result = mysqli_query($conn, $query);
        if(!$result){
            die("La eliminación ha fallado.");
        }

        header('Location: ../areaemp_vw.php');

    }

?>