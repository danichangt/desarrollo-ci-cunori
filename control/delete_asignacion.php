<?php 
    include('../database.php');

    if(isset($_GET['idasignacion'])) {
        $idasignacion = $_GET['idasignacion'];
        $query_idarticulo = "select articulo_idarticulo from asignacion where idasignacion = $idasignacion";
        $idarticulo_result = mysqli_query($conn, $query_idarticulo);
        $idarticulo = $idarticulo_result->fetch_array()['articulo_idarticulo'];
        $query = "delete from asignacion where idasignacion = $idasignacion";
        $result = mysqli_query($conn, $query);

        if(!$result){
            die("La deshasignación ha fallado.");
        }
        $query_update = "update articulo set disponible = 1 where idarticulo = $idarticulo";
        mysqli_query($conn, $query_update);
        $_SESSION['message'] = '¡Desasignación realizada satisfactoriamente!';
        $_SESSION['message_type'] = 'danger';

        header('Location: ../asignaciones_tb.php');
    }
?>