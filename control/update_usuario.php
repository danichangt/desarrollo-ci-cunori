<?php 

    require("../database.php"); 

    if (isset($_POST['actualizar'])) {
        if (!empty($_POST['rol_idrol'])) {

            if ($_POST['estado'] != 1) {
                $estado = 0;
            }else{
                $estado = $_POST['estado'];
            }
            $stmt = $conn->prepare("update usuario set rol_idrol = ?, estado = ? where idusuario = ?");
            $stmt->bind_param("iii", $rol_idrol, $estado, $idusuario);
            $idusuario = $_GET['idusuario'];
            $rol_idrol = $_POST['rol_idrol'];
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            if (count($result) > 0) {
                $_SESSION['message'] = '¡Registro actualizado!';
                $_SESSION['message_type'] = 'info';

                header('location: ../usuarios.php');
                $conn->close();
            }else{
                $conn->close();
                die("Consulta ha fallado.");
            }
        }else{
            $_SESSION['message'] = 'Debe completar todos los campos.';
            $_SESSION['message_type'] = 'danger';

            header('location: ../usuarios.php');
        }
        
    }

?>
