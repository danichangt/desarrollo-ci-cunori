<?php 
    include("../database.php"); 

    if (isset($_POST['actualizar'])) {
        if (!empty($_POST['tarjeta_responsable']) && !empty($_POST['fecha_asignacion']) && !empty($_POST['empleado_idempleado'])) {
            
            $tarjeta_responsable_anterior = '';

            $stmt_select = $conn->prepare("select tarjeta_responsable from asignacion where idasignacion = ?");
            $stmt_select->bind_param("i", $idasignacion);
            $idasignacion = $_GET['idasignacion'];
            $stmt_select->execute();
            $result_select = $stmt_select->get_result();
            $stmt_select->close();
            if (count($result_select) > 0) {
                $row = $result_select->fetch_assoc();
                $tarjeta_responsable_anterior = $row['tarjeta_responsable'];
                $result_select->free_result();
            }
            
            if ($tarjeta_responsable != $tarjeta_responsable_anterior) {
                $stmt_update_contador = $conn->prepare("update asignacion set contador_traslado = 1 where idasignacion = ?");
                $stmt_update_contador->bind_param("i", $idasignacion);
                $idasignacion = $_GET['idasignacion'];
                $stmt_update_contador->execute();
                $stmt_update_contador->close();
                $query = $conn->prepare("update asignacion set tarjeta_responsable = ?, fecha_asignacion = ?, empleado_idempleado = ? 
                where idasignacion = ?");
                $query->bind_param("isii", $tarjeta_responsable, $fecha_asignacion, $empleado_idempleado, $idasignacion);
                $tarjeta_responsable = $_POST['tarjeta_responsable'];
                $fecha_asignacion = $_POST['fecha_asignacion'];
                $empleado_idempleado = $_POST['empleado_idempleado'];
                $query->execute();
                $query->close();

            }else{
                $query = $conn->prepare("update asignacion set tarjeta_responsable = ?, fecha_asignacion = ?, empleado_idempleado = ? 
                where idasignacion = ?");
                $query->bind_param("isii", $tarjeta_responsable, $fecha_asignacion, $empleado_idempleado, $idasignacion);
                $tarjeta_responsable = $_POST['tarjeta_responsable'];
                $fecha_asignacion = $_POST['fecha_asignacion'];
                $empleado_idempleado = $_POST['empleado_idempleado'];
                $query->execute();
                $query->close();
            }

            
            $_SESSION['message'] = '¡Registro actualizado!';
            $_SESSION['message_type'] = 'info';

            header('location: ../asignaciones_tb.php');
            $conn->close();
    
        }else{
            $_SESSION['message'] = 'Debe completar todos los campos.';
            $_SESSION['message_type'] = 'danger';

            header('location: ../asignaciones_tb.php');

        }

    }
    

?>