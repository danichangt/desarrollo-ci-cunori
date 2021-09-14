<?php
    
    require('../database.php');

    if (isset($_POST['codigo_control'])) {
        if (!empty($_POST['codigo_control']) && !empty($_POST['descripcion'])) {
            
            $stmt = $conn->prepare("insert into categoria (codigo_control, descripcion) values (?, ?)");
            $stmt->bind_param("is", $codigo_control, $descripcion);
            $codigo_control = $_POST['codigo_control'];
            $descripcion = $_POST['descripcion'];
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();

            if (count($result) > 0) {
                $_SESSION['message'] = '¡Registro creado!';
                $_SESSION['message_type'] = 'success';

                header('location: ../categoria_vw.php');
                $conn->close();
            }else{
                $conn->close();
                die("Consulta ha fallado.");
            }
        }else{
            $_SESSION['message'] = 'Debe completar todos los campos.';
            $_SESSION['message_type'] = 'danger';

            header('location: ../categoria_vw.php');
        }
    
    }

?>