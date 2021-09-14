<?php 
    require '../database.php';
    require '../lib/PHPMailer/PHPMailerAutoload.php';

    if (!empty($_POST['usuario'])) {
        
        $stmt = $conn->prepare("select count(1) as registro from usuario where usuario = ?");
        $stmt->bind_param("s", $usuario);
        $usuario = $_POST['usuario'];
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if (mysqli_num_rows($result) == 1) {
            $row = $result->fetch_assoc();
            $registro = $row['registro'];

            $sql = $conn->prepare("select concat_ws(' ', nombres, apellidos) as nombre_completo from usuario where usuario = ?");
            $sql->bind_param("s", $usuario);
            $usuario = $_POST['usuario'];
            $sql->execute();
            $result_sql = $sql->get_result();
            $sql->close();
            $row_sql = $result_sql->fetch_assoc();
            
            $nombre = $row_sql['nombre_completo'];

            if ($registro == 1) {
                //Token
                $stmt_token = $conn->prepare("insert into token (usuario, token) values (?,?)");
                $stmt_token->bind_param("ss", $usuario, $token);
                $usuario = $_POST['usuario'];
                $token = generateToken();
                $stmt_token->execute();
                $stmt_token->close();
                //PHPMailer
                mailer($usuario, $nombre, $token);
                
                $result_sql->free_result();
                $conn->close();
            }else{
                $_SESSION['message'] = 'El usuario no existe.';
                $_SESSION['message_type'] = 'danger';

                $result_sql->free_result();
                header('location: ../recuperar_clave.php');
                $conn->close();
            }
        }
    }

    function mailer($usuario, $nombre, $token){
        $mail = new PHPMailer();
	
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        
        $mail->Username = '@correo'; //Correo de donde enviaremos los correos
        $mail->Password = '@clave'; // Password de la cuenta de envío
        
        $mail->setFrom('@correo', 'Control de Inventarios - CUNORI');
        $mail->addAddress($usuario, $nombre); //Correo receptor
        
        
        $mail->Subject = utf8_decode('Recuperar contraseña');
        $mail->Body    = 'Para recuperar tu contraseña haz <strong><a href="https://localhost/controlinventarios_cunori/cambio_clave.php">click aquí.</a></strong><br>Token de recuperación: <strong>'.$token.'</strong>';
        $mail->IsHTML(true);
        
        if($mail->send()) {
            $_SESSION['message'] = 'Hemos enviado un correo de recuperación de contraseña al correo electrónico ingresado.';
            $_SESSION['message_type'] = 'success';
            header('location: ../login.php');
        } else {
            $_SESSION['message'] = 'Ha ocurrido un error enviado el correo de recuperación.';
            $_SESSION['message_type'] = 'danger';
            header('location: ../recuperar_clave.php');
        }
    }

    function generateToken(){
        $generate_token = md5(uniqid(mt_rand(),false));
        return $generate_token;
    }
?>