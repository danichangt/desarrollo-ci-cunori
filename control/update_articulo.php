<?php

    include('../database.php');

    $no_clave_control = '';
    $descripcion = '';
    $categoria_idcategoria = '';
    $tipo_idtipo = '';
    $valor = '';
    $fecha_ingreso = '';
    $activo = '';

    if (isset($_POST['actualizar'])) {
        $idarticulo = $_GET['idarticulo'];
        $no_clave_control = $_POST['no_clave_control'];
        $descripcion = $_POST['descripcion'];
        $categoria_idcategoria = $_POST['categoria_idcategoria'];
        $tipo_idtipo = $_POST['tipo_idtipo'];
        $valor = $_POST['valor'];
        $fecha_ingreso = $_POST['fecha_ingreso'];
        $activo = $_POST['activo'];

        $query = "update articulo set no_clave_control = '$no_clave_control', descripcion = '$descripcion', categoria_idcategoria = $categoria_idcategoria, 
                    tipo_idtipo = $tipo_idtipo, valor = $valor, fecha_ingreso = '$fecha_ingreso', activo = $activo where idarticulo = $idarticulo";
        mysqli_query($conn, $query);

        $_SESSION['message'] = '¡Registro actualizado!';
        $_SESSION['message_type'] = 'info';
        header('Location: ../add_articulo.php');
    }

?>