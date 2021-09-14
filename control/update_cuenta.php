<?php 

    require('../database.php');

    if (isset($_POST['actualizar_datos'])) {
        if (!empty($_POST['usuario']) && !empty($_POST['nombres']) && !empty($_POST['apellidos'])) {

            $stmt = $conn->prepare("update usuario set usuario = ?, nombres = ?, apellidos = ? where idusuario = ?");
            $stmt->bind_param("sssi", $usuario, $nombres, $apellidos, $idusuario);
            $idusuario = $_GET['idusuario'];
            $usuario = $_POST['usuario'];
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            sleep(3);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            if (count($result) > 0) {
                $_SESSION['message'] = '¡Registro actualizado!';
                $_SESSION['message_type'] = 'info';
                
                header('location: ../cuenta_usuario.php');
                $conn->close();
            }
            
        }else{
            $_SESSION['message'] = 'Debe completar todos los campos.';
            $_SESSION['message_type'] = 'danger';

            header('location: ../cuenta_usuario.php');
        }
    }

    if (isset($_POST['actualizar_clave'])) {

        $query_select = $conn->prepare("select clave from usuario where idusuario = ?");
        $query_select->bind_param("i", $idusuario);
        $idusuario = $_GET['idusuario'];
        $query_select->execute();
        $result_select = $query_select->get_result();
        if (count($result_select) > 0) {
            $row = $result_select->fetch_assoc();

            if (count($row) > 0 && password_verify($_POST['clave_anterior'], $row['clave'])) {
                $clave = password_hash($_POST['clave'], PASSWORD_BCRYPT);
                $query_update = $conn->prepare("update usuario set clave = ? where idusuario = ?");
                $query_update->bind_param("si", $clave, $idusuario);
                $query_update->execute();
                $result_update = $query_update->get_result();
                $query_update->close();
                if (count($result_update) > 0) {
                    $_SESSION['message'] = '¡Contraseña actualizada!';
                    $_SESSION['message_type'] = 'info';

                    header('location: ../cuenta_usuario.php');
                    $conn->close();
                }else{
                    $conn->close();
                    die("Consulta ha fallado.");
                }                
            }else{
                $_SESSION['message'] = 'La contraseña anterior es incorrecta.';
                $_SESSION['message_type'] = 'danger';
                header('location: ../cuenta_usuario.php');
            }
        }
        
    }

    if (isset($_POST['usuario_cambiar_clave'])) {
        if (!empty($_POST['usuario_cambiar_clave']) && !empty($_POST['clave']) && !empty($_POST['confirmar_clave']) && !empty($_POST['token'])) {
            if ($_POST['clave'] == $_POST['confirmar_clave']) {
                $stmt_token = $conn->prepare("select token from token where usuario = ?");
                $stmt_token->bind_param("s",$usuario);
                $usuario = $_POST['usuario_cambiar_clave'];
                $stmt_token->execute();
                $result_token = $stmt_token->get_result();
                $stmt_token->close();
                if (count($result_token) > 0) {
                    $row_token = $result_token->fetch_assoc();
                    if ($row_token['token'] == $_POST['token']) {
                        $result_token->free_result();
                        $sql = $conn->prepare("update usuario set clave = ? where usuario = ?");
                        $sql->bind_param("ss", $clave, $usuario);
                        $usuario = $_POST['usuario_cambiar_clave'];
                        $clave = password_hash($_POST['clave'], PASSWORD_BCRYPT);
                        $sql->execute();
                        $result_sql = $sql->get_result();
                        $sql->close();
                        if (count($result_sql) > 0) {
                            $stmt_delete = $conn->prepare("delete from token where usuario = ?");
                            $stmt_delete->bind_param("s",$usuario);
                            $usuario = $_POST['usuario_cambiar_clave'];
                            $stmt_delete->execute();
                            $stmt_delete->close();
                            $_SESSION['message'] = '¡Contraseña actualizada!';
                            $_SESSION['message_type'] = 'info';

                            header('location: ../login.php');
                            $conn->close();
                        }else{
                            die("Err");
                        }
                        
                    }else{
                        $_SESSION['message'] = 'El token ingresdo no es válido.';
                        $_SESSION['message_type'] = 'danger';
                        $result_token->free_result();
                        header('location: ../cambio_clave.php');
                        $conn->close();
                    }
                }else{
                    $conn->close();
                    die("Err");
                }
               
            }else{
                $_SESSION['message'] = 'Las contraseñas no coinciden.';
                $_SESSION['message_type'] = 'danger';
                header('location: ../cambio_clave.php');
                
            }
        }else{
            $_SESSION['message'] = 'Debe completar todos los campos.';
            $_SESSION['message_type'] = 'danger';
            header('location: ../cambio_clave.php');
            
        }
    }

?>