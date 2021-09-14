<?php

    require('../database.php');

    if (isset($_POST['descripcion'])) {
        if (!empty($_POST['descripcion'])) {
            
            $stmt = $conn->prepare("insert into tipo (descripcion) values (?)");
            $stmt->bind_param("s", $descripcion);
            $descripcion = $_POST['descripcion'];
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();

            if (count($result)) {
                $_SESSION['message'] = '¡Registro creado!';
                $_SESSION['message_type'] = 'success';

                header('location: ../tipo_bien_vw.php');
                $conn->close();
            }else{
                $conn->close();
                die("Consulta ha fallado.");
            }
        }else{
            $_SESSION['message'] = 'Debe completar todos los campos.';
            $_SESSION['message_type'] = 'danger';

            header('location: ../tipo_bien_vw.php');
        }
        
    }

?>