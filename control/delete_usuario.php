<?php 

    require('../database.php');
    
    if (isset($_GET['idusuario'])) {
        
        $stmt_select = $conn->prepare("select rol_idrol from usuario where idusuario = ?");
        $stmt_select->bind_param("i", $idusuario);
        $idusuario = $_GET['idusuario'];
        $stmt_select->execute();
        $result_select = $stmt_select->get_result();
        $stmt_select->close();
        if (count($result_select) > 0) {
            $row = $result_select->fetch_assoc();
            if ($_SESSION['rol'] == $row['rol_idrol']) {

                $_SESSION['message'] = 'No se puede eliminar al administrador del sistema.';
                $_SESSION['message_type'] = 'danger';
                $result_select->free_result();
                header('location: ../usuarios.php');
                $conn->close();
            }else{
                $stmt = $conn->prepare("delete from usuario where idusuario = ?");
                $stmt->bind_param("i", $idusuario);
                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->close();
                if(count($result) > 0){
                    $_SESSION['message'] = '¡Usuario eliminado!';
                    $_SESSION['message_type'] = 'danger';

                    header('location: ../usuarios.php');
                    
                    $conn->close();
                }else{
                    $conn->close();
                    die("Consulta ha fallado.");
                }
                
            }
        }
    }

?>