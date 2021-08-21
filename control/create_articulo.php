<?php 

    include('../database.php');

    if (isset($_POST['create_articulo'])) {
        
        $no_clave_control = $_POST['no_clave_control'];
        $descripcion = $_POST['descripcion'];
        $categoria = $_POST['categoria'];
        $tipo_bien = $_POST['tipo_bien'];
        $valor = $_POST['valor'];
        $fecha_ingreso = $_POST['fecha_ingreso'];
        $folio = $_POST['folio'];

        $query = "insert into articulo(no_clave_control, descripcion, valor, fecha_ingreso, folio, categoria_idcategoria, tipo_idtipo) values ('$no_clave_control', '$descripcion', $valor, '$fecha_ingreso', $folio, '$categoria', $tipo_bien)";
        $result = mysqli_query($conn, $query);

        if (!$result) {

            die("Consulta ha fallado");
            
        }

        $_SESSION['message'] = '¡Registro creado!';
        $_SESSION['message_type'] = 'success';
        header('location: ../add_articulo.php');
    }

?>