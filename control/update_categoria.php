<?php 

    include('../database.php'); 


    $codigo_control ='';
    $descripcion = '';

    if (isset($_GET['idcategoria'])) {
        $idcategoria = $_GET['idcategoria'];
        $query = "select * from categoria where idcategoria = '$idcategoria'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            $codigo_control = $row['codigo_control'];
            $descripcion = $row['descripcion'];
        }
    }

    if (isset($_POST['actualizar'])) {
        $idcategoria = $_GET['idcategoria'];
        $codigo_control = $_POST['codigo_control'];
        $descripcion = $_POST['descripcion'];

        $query = "update categoria set codigo_control = '$codigo_control', descripcion = '$descripcion' where idcategoria = $idcategoria";
        mysqli_query($conn, $query);

        $_SESSION['message'] = '¡Registro actualizado!';
        $_SESSION['message_type'] = 'info';
        header('location: ../categoria_vw.php');
    }

?>