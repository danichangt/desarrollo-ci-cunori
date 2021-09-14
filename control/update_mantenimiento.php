<?php 

    require("../database.php"); 

    if (isset($_POST['actualizar'])) {
        if (!empty($_POST['fecha_mantenimiento']) && !empty($_POST['descripcion']) && !empty($_POST['no_factura']) && !empty($_POST['valor_neto'])) {
            
            $stmt = $conn->prepare("update mantenimiento set fecha_mantenimiento = ?, descripcion = ?, no_factura = ?,
            valor_neto = ? where idmantenimiento = ?");
            $stmt->bind_param("sssdi", $fecha_mantenimiento, $descripcion, $no_factura, $valor_neto, $idmantenimiento);
            $idmantenimiento = $_GET['idmantenimiento'];
            $fecha_mantenimiento = $_POST['fecha_mantenimiento'];
            $descripcion = $_POST['descripcion'];
            $no_factura = $_POST['no_factura'];
            $valor_neto = $_POST['valor_neto'];
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            if (count($result) > 0) {
                $_SESSION['message'] = '¡Registro actualizado!';
                $_SESSION['message_type'] = 'info';

                header('location: ../mantenimientos_vw.php');
                $conn->close();
            }else{
                $conn->close();
                die("Consulta ha fallado.");
            }
        }else{
            $_SESSION['message'] = 'Debe completar todos los campos.';
            $_SESSION['message_type'] = 'danger';

            header('location: ../mantenimientos_vw.php');
        }
        
    }

?>