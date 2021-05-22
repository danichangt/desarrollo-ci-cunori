<?php

    include('../database.php');

    if (isset($_GET['codigo_control'])) {

        $codigo_control = $_GET['codigo_control'];
        $query = "delete from categoria where codigo_control = '$codigo_control'";
        $result = mysqli_query($conn, $query);
        if(!$result){
            echo $codigo_control;
            die("La eliminación ha fallado.");
        }
        $_SESSION['message'] = 'Categoría eliminada satisfactoriamente.';
        $_SESSION['message_type'] = 'danger';

        
        header('Location: ../categoria_vw.php');

    }

?>