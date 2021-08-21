<?php 

    include("../database.php"); 


    $idarea ='';
    $descripcion = '';


    if (isset($_POST['actualizar'])) {
        $idarea = $_GET['idarea'];
        $descripcion = $_POST['descripcion'];

        $query = "update areaemp set descripcion = '$descripcion' where idarea = $idarea";
        mysqli_query($conn, $query);

        $_SESSION['message'] = '¡Registro actualizado!';
        $_SESSION['message_type'] = 'info';
        header('Location: ../areaemp_vw.php');
    }

?>