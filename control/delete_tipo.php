<?php

    include('../database.php');

    if (isset($_GET['idtipo'])) {

        $idtipo = $_GET['idtipo'];
        $query = "delete from tipo where idtipo = $idtipo";
        $result = mysqli_query($conn, $query);
        if(!$result){
            die("La eliminación ha fallado.");
        }
        $_SESSION['message'] = 'Tipo eliminada satisfactoriamente.';
        $_SESSION['message_type'] = 'danger';

        
        header('Location: ../tipo_bien_vw.php');

    }

?>