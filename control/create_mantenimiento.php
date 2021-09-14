<?php 
    require('../database.php');

    if (isset($_POST['create_mantenimiento'])) {
        if (!empty($_POST['fecha_mantenimiento']) && !empty($_POST['fecha_mantenimiento']) && !empty($_POST['fecha_mantenimiento']) && 
        !empty($_POST['fecha_mantenimiento'])) {
        
            $stmt = $conn->prepare("insert into mantenimiento (fecha_mantenimiento, descripcion, no_factura, valor_neto, asignacion_idasignacion) 
            values (?,?,?,?,?)");
            $stmt->bind_param("sssdi", $fecha_mantenimiento, $descripcion, $no_factura, $valor_neto, $idasignacion);
            $result = mysqli_query($conn, $query);
            $idasignacion = $_GET['idasignacion'];
            $fecha_mantenimiento = $_POST['fecha_mantenimiento'];
            $descripcion = $_POST['descripcion'];
            $no_factura = $_POST['no_factura'];
            $valor_neto = $_POST['valor_neto'];
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();

            if (count($result) > 0) {
                $_SESSION['message'] = '¡Registro creado!';
                $_SESSION['message_type'] = 'success';

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