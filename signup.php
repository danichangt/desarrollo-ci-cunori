<?php
    require('database.php');
    require('utils/funciones.php');

    if (isset($_POST['usuario'])){
        if (!empty($_POST['usuario']) && !empty($_POST['clave']) && !empty($_POST['nombres']) && !empty($_POST['apellidos']) && 
        !empty($_POST['rol_idrol'])) {

            if (is_valid_email($_POST['usuario']) == true) {
                $stmt = $conn->prepare("insert into usuario (usuario, nombres, apellidos, clave, rol_idrol) values (?,?,?,?,?)");
                $stmt->bind_param("ssssi", $usuario, $nombres, $apellidos, $clave, $rol_idrol);
                $usuario = $_POST['usuario'];
                $clave = password_hash($_POST['clave'], PASSWORD_BCRYPT);
                $nombres = $_POST['nombres'];
                $apellidos = $_POST['apellidos'];
                $rol_idrol = $_POST['rol_idrol'];
                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->close();

                if (count($result) > 0) {
                    
                    $_SESSION['message'] = '¡Registro creado!';
                    $_SESSION['message_type'] = 'success';

                    header('location: usuarios.php');
                    $conn->close();
                }else{
                    $conn->close();
                    die("Consulta ha fallado.");
                }
            }else{
                $_SESSION['message'] = 'Debe ingresar un email válido.';
                $_SESSION['message_type'] = 'danger';
                header('location: usuarios.php');
            }
            
        }else{
            $_SESSION['message'] = 'Debe completar todos los campos.';
            $_SESSION['message_type'] = 'danger';
            header('location: usuarios.php');
        }
        
    }

?>