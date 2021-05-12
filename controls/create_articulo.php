<?php 

    include("database.php");

    if (isset($_POST['create_articulo'])) {
        
        $no_clave_control = $_POST['no_clave_control'];
        $descripcion = $_POST['descripcion'];
        $categoria = $_POST['categoria'];
        $tipo_bien = $_POST['tipo_bien'];
        $valor = $_POST['valor'];
        $fecha_ingreso = $_POST['fecha_ingreso'];

        
    }

?>