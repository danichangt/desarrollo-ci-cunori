<?php 

    require('../database.php');

    if (isset($_POST)) {
        if (!empty($_POST['no_clave_control']) && !empty($_POST['descripcion']) && !empty($_POST['categoria']) && 
        !empty($_POST['tipo_bien']) && !empty($_POST['valor']) && !empty($_POST['fecha_ingreso']) && !empty($_POST['folio'])) {
            
            $stmt = $conn->prepare("insert into articulo (no_clave_control, descripcion, valor, fecha_ingreso, folio, categoria_idcategoria, 
            tipo_idtipo) values (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssdsiii",$no_clave_control, $descripcion, $valor, $fecha_ingreso, $folio, $categoria, $tipo_bien);
            $no_clave_control = $_POST['no_clave_control'];
            $descripcion = $_POST['descripcion'];
            $categoria = $_POST['categoria'];
            $tipo_bien = $_POST['tipo_bien'];
            $valor = $_POST['valor'];
            $fecha_ingreso = $_POST['fecha_ingreso'];
            $folio = $_POST['folio'];
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();

            if (count($result) > 0) {
                $_SESSION['message'] = '¡Registro creado!';
                $_SESSION['message_type'] = 'success';
                header('location: ../add_articulo.php'); 

                $conn->close();
            }else{
                $conn->close();
                die("Consulta ha fallado"); 
            }
        }else{
            $_SESSION['message'] = 'Debe completar todos los campos.';
            $_SESSION['message_type'] = 'danger';
            header('location: ../add_articulo.php');
        }      
    }

?>