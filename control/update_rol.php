<?php 

    require("../database.php"); 


    if (isset($_POST['actualizar'])) {
        if (!empty($_POST['rol'])) {

            if ($_POST['crear'] != 1) {
                $crear = 0;
            }else{
                $crear = $_POST['crear'];
            }

            if ($_POST['leer'] != 1) {
                $leer = 0;
            }else{
                $leer = $_POST['leer'];
            }

            if ($_POST['editar'] != 1) {
                $editar = 0;
            }else{
                $editar = $_POST['editar'];
            }

            if ($_POST['eliminar'] != 1) {
                $eliminar = 0;
            }else{
                $eliminar = $_POST['eliminar'];
            }

            $stmt = $conn->prepare("update rol set rol = ?, crear = ?, leer = ?, editar = ?,  eliminar = ? where idrol = ?");
            $stmt->bind_param("siiiii", $rol, $crear, $leer, $editar, $eliminar, $idrol);
            $idrol = $_GET['idrol'];
            $rol = $_POST['rol'];
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            if (count($result)) {
                $_SESSION['message'] = '¡Registro actualizado!';
                $_SESSION['message_type'] = 'info';

                header('location: ../roles.php');
                $conn->close();
            }else{
                $conn->close();
                die("Consulta ha fallado.");
            }                 
        }else{
            $_SESSION['message'] = 'Debe completar todos los campos.';
            $_SESSION['message_type'] = 'danger';

            header('location: ../roles.php');
        }
        
    }

?>