<?php 

    include("../database.php"); 


    $idtipo ='';
    $descripcion = '';

    if (isset($_POST['actualizar'])) {
        $idtipo = $_GET['idtipo'];
        $descripcion = $_POST['descripcion'];

        $query = "update tipo set descripcion = '$descripcion' where idtipo = $idtipo";
        mysqli_query($conn, $query);

        $_SESSION['message'] = '¡Registro actualizado!';
        $_SESSION['message_type'] = 'info';
        header('Location: ../tipo_bien_vw.php');
    }

?>
