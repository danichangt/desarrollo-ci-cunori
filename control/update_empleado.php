<?php

    require('../database.php');

    if (isset($_POST['actualizar'])) {
        if (!empty($_POST['dpi']) && !empty($_POST['codigo']) && !empty($_POST['nombres']) && !empty($_POST['apellidos']) && 
        !empty($_POST['areaemp_idarea'])) {       

            $stmt = $conn->prepare("update empleado set dpi = ?, codigo = ?, nombres = ?, apellidos = ?, areaemp_idarea = ? where idempleado = ?");
            $stmt->bind_param("ssssii", $dpi, $codigo, $nombres, $apellidos, $areaemp_idarea, $idempleado);
            $idempleado = $_GET['idempleado'];
            $dpi = $_POST['dpi'];
            $codigo = $_POST['codigo'];
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $areaemp_idarea = $_POST['areaemp_idarea'];
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            if (count($result) > 0) {
                $_SESSION['message'] = '¡Registro actualizado!';
                $_SESSION['message_type'] = 'info';

                header('location: ../empleado_vw.php');
                $conn->close();
            }else{
                $conn->close();
                die("Consulta ha fallado.");
            }          
        }else{
            $_SESSION['message'] = 'Debe completar todos los campos.';
            $_SESSION['message_type'] = 'danger';

            header('location: ../empleado_vw.php');
        }
        
    }

?>