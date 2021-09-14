<?php 
    require('../database.php');

    if (isset($_POST['actualizar'])) {
        if (!empty($_POST['fecha_asignacion']) && !empty($_POST['fecha_asignacion']) && !empty($_POST['fecha_asignacion']) ) {

            $stmt = $conn->prepare("update asignacion set fecha_asignacion = ?, autorizacion = ?, seccion = ? where idasignacion = ?");
            $stmt->bind_param("sssi", $fecha_asignacion, $autorizacion, $seccion, $idasignacion);
            $idasignacion = $_GET['idasignacion'];
            $fecha_asignacion = $_POST['fecha_asignacion'];
            $autorizacion = $_POST['autorizacion'];
            $seccion = $_POST['seccion'];
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            if (count($result) > 0) {
                $_SESSION['message'] = '¡Registro actualizado!';
                $_SESSION['message_type'] = 'info';

                header('location: ../traslados_tb.php');
                $conn->close();
            }else{
                $conn->close();
                die("Consulta ha fallado.");
            }
        }else{
            $_SESSION['message'] = 'Debe completar todos los campos.';
            $_SESSION['message_type'] = 'danger';

            header('location: ../traslados_tb.php');
        }
        
    }

?>