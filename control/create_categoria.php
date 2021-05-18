<?php
    
    include('../database.php');

    if (isset($_POST['create_categoria'])) {
        
        $codigo_control = $_POST['codigo_control'];
        $descripcion = $_POST['descripcion'];

        $query = "insert into categoria(codigo_control, descripcion) values('$codigo_control', '$descripcion')";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Consulta ha fallado.");
        }

        $_SESSION['message'] = '¡Categoría agregada exitosamente!';
        $_SESSION['message_type'] = 'success';

        header('Location: ../categoria_vw.php');
    }


?>