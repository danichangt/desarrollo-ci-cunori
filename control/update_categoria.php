<?php 

    require('../database.php'); 

    if (isset($_POST['actualizar'])) {
        if (!empty($_POST['codigo_control']) && !empty($_POST['descripcion'])) {

            $stmt = $conn->prepare("update categoria set codigo_control = ?, descripcion = ? where idcategoria = ?");
            $stmt->bind_param("ssi", $codigo_control, $descripcion, $idcategoria);
            $idcategoria = $_GET['idcategoria'];
            $codigo_control = $_POST['codigo_control'];
            $descripcion = $_POST['descripcion'];
            $stmt->execute();

            $_SESSION['message'] = '¡Registro actualizado!';
            $_SESSION['message_type'] = 'info';

            header('location: ../categoria_vw.php');
            $stmt->close();
            $conn->close();
        }else{
            $_SESSION['message'] = 'Debe completar todos los campos.';
            $_SESSION['message_type'] = 'danger';

            header('location: ../categoria_vw.php');
        }
        
    }

?>