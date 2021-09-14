<?php 
    require('../database.php');

    if (isset($_POST['create_asignacion'])) {
        if (!empty($_POST['tarjeta_responsable']) && !empty($_POST['fecha_asignacion']) && !empty($_POST['empleados']) && 
        !empty($_POST['localizacion'])) {
            
            $stmt = $conn->prepare("insert into asignacion (tarjeta_responsable, fecha_asignacion, localizacion, articulo_idarticulo, 
            empleado_idempleado) values (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssii", $tarjeta_responsable, $fecha_asignacion, $localizacion, $articulo_idarticulo, $empleado_idempleado);
            $result = mysqli_query($conn, $query);
            $tarjeta_responsable = $_POST['tarjeta_responsable'];
            $fecha_asignacion = $_POST['fecha_asignacion'];
            $articulo_idarticulo = $_GET['idarticulo'];
            $empleado_idempleado = $_POST['empleados'];
            $localizacion = $_POST['localizacion'];
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();

            if (count($result) > 0) {
                $stmt_update = $conn->prepare("update articulo set disponible = 0 where idarticulo = ?");
                $stmt_update->bind_param("i", $articulo_idarticulo);
                $stmt_update->execute();
                $stmt_update->close();

                $_SESSION['message'] = '¡Registro creado!';
                $_SESSION['message_type'] = 'success';

                header('location: ../add_articulo.php');
                
                $conn->close();
            }else{
                $conn->close();
                die("Consulta ha fallado.");
            }

            
        }else{
            $_SESSION['message'] = 'Debe completar todos los campos.';
            $_SESSION['message_type'] = 'danger';
            header('location: ../add_articulo.php');
        }
        
    }

    if (isset($_GET['idasignacion'])) { 
        if (!empty($_POST['tarjeta_responsable']) && !empty($_POST['fecha_asignacion']) && !empty($_POST['localizacion']) && 
        !empty($_POST['autorizacion']) && !empty($_POST['seccion']) && !empty($_POST['empleados'])) {

            $idasignacion = $_GET['idasignacion'];
            $contador_traslado = '';
            $articulo_idarticulo = '';

            $stmt_selct = $conn->prepare("select articulo_idarticulo, contador_traslado  from asignacion where idasignacion = ?");
            $stmt_selct->bind_param("i", $idasignacion);
            $stmt_selct->execute();
            $result_select = $stmt_selct->get_result();
            if (count($result_select) > 0) {
                $row_select = $result_select->fetch_assoc();
                $articulo_idarticulo = $row_select['articulo_idarticulo'];
                $contador_traslado = $row_select['contador_traslado'];
                $result_select->free_result();
                $stmt_selct->close();
            }

            $contador_traslado = $contador_traslado + 1;
            $stmt_insert = $conn->prepare("insert into asignacion (tarjeta_responsable, fecha_asignacion, localizacion, autorizacion, seccion, 
            contador_traslado, articulo_idarticulo, empleado_idempleado, asignacion_idasignacion) values (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt_insert->bind_param("issssiiii", $tarjeta_responsable, $fecha_asignacion, $localizacion, $autorizacion, $seccion, $contador_traslado, 
            $articulo_idarticulo, $empleado_idempleado, $asignacion_idasignacion);
            $tarjeta_responsable = $_POST['tarjeta_responsable'];
            $fecha_asignacion = $_POST['fecha_asignacion'];
            $localizacion = $_POST['localizacion'];
            $autorizacion = $_POST['autorizacion'];
            $seccion = $_POST['seccion'];
            $empleado_idempleado = $_POST['empleados'];
            $asignacion_idasignacion = $idasignacion;
            $stmt_insert->execute();
            $result_insert = $stmt_insert->get_result();

            if (count($result_insert) > 0) {
                $stmt_update_articulo = $conn->prepare("update asignacion inner join articulo on articulo_idarticulo = idarticulo 
                set articulo.disponible = 0, asignacion.estado = 0 where idasignacion = ?");
                $stmt_update_articulo->bind_param("i", $idasignacion);
                $stmt_update_articulo->execute();
                $result_update_articulo = $stmt_update_articulo->get_result();
                $stmt_update_articulo->close();
                if (count($result_update_articulo) > 0) {
                    $_SESSION['message'] = '¡Registro creado!';
                    $_SESSION['message_type'] = 'success';

                    header('location: ../traslados_tb.php');

                    $conn->close();
                }
                
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