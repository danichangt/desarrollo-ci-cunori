<?php

    require('../database.php');

    if (isset($_POST['actualizar'])) {
        if (!empty($_POST['no_clave_control']) && !empty($_POST['descripcion']) && !empty($_POST['categoria_idcategoria']) && 
        !empty($_POST['tipo_idtipo']) && !empty($_POST['valor']) && !empty($_POST['fecha_ingreso']) && !empty($_POST['activo'])) {
            $stmt = $conn->prepare("update articulo set no_clave_control = ?, descripcion = ?, categoria_idcategoria = ?, tipo_idtipo = ?, 
            valor = ?, fecha_ingreso = ?, activo = ? where idarticulo = ?");
            $stmt->bind_param("isiidsii", $no_clave_control, $descripcion, $categoria_idcategoria, $tipo_idtipo, $valor, $fecha_ingreso, 
            $activo, $idarticulo);
            $idarticulo = $_GET['idarticulo'];
            $no_clave_control = $_POST['no_clave_control'];
            $descripcion = $_POST['descripcion'];
            $categoria_idcategoria = $_POST['categoria_idcategoria'];
            $tipo_idtipo = $_POST['tipo_idtipo'];
            $valor = $_POST['valor'];
            $fecha_ingreso = $_POST['fecha_ingreso'];
            $activo = $_POST['activo'];
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            if (count($result) > 0) {
                $_SESSION['message'] = '¡Registro actualizado!';
                $_SESSION['message_type'] = 'info';

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

?>