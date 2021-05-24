<?php

    include('../database.php');

    if (isset($_GET['idarticulo'])) {
        $idarticulo = $_GET['idarticulo'];
        $query = "delete from articulo where idarticulo = $idarticulo";
        $result = mysqli_query($conn, $query);

        if(!$result){
            die("La eliminación ha fallado.");
        }
        $_SESSION['message'] = 'Articulo eliminado satisfactoriamente.';
        $_SESSION['message_type'] = 'danger';

        
        header('Location: ../add_articulo.php');
    }

?>