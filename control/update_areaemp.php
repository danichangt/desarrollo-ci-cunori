<?php 

    require("../database.php"); 

    if (isset($_POST['actualizar'])) {
        if (!empty($_POST['descripcion'])) {

            $stmt = $conn->prepare("update areaemp set descripcion = ? where idarea = ?");
            $stmt->bind_param("si", $descripcion, $idarea);
            $descripcion = $_POST['descripcion'];
            $idarea = $_GET['idarea'];
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            if (count($result) > 0) {
                $_SESSION['message'] = '¡Registro actualizado!';
                $_SESSION['message_type'] = 'info';

                header('location: ../areaemp_vw.php');
                $conn->close();
            }else{
                $conn->close();
                die("Consulta ha fallado.");
            }
        }else{
            $_SESSION['message'] = 'Debe completar todos los campos.';
            $_SESSION['message_type'] = 'danger';

            header('location: ../areaemp_vw.php');
        }
  
    }

?>