<?php 
    require('../database.php');

    if(isset($_GET['idasignacion'])) {
        $stmt_articulo = $conn->prepare("select articulo_idarticulo from asignacion where idasignacion = ?");
        $stmt_articulo->bind_param("i", $idasignacion);
        $idasignacion = $_GET['idasignacion'];
        $stmt_articulo->execute();
        $result_articulo = $stmt_articulo->get_result();
        if (count($result_articulo) > 0) {
            $row_articulo = $result_articulo->fetch_assoc();
            $idarticulo = $row_articulo['articulo_idarticulo'];
            $stmt = $conn->prepare("update asignacion set estado = 0 where idasignacion = ?");
            $stmt->bind_param("i", $idasignacion);
            $stmt->execute();

            $stmt_update = $conn->prepare("update articulo set disponible = 1 where idarticulo = ?");
            $stmt_update->bind_param("i", $idarticulo);
            $stmt_update->execute();

            $_SESSION['message'] = '¡Desasignación realizada satisfactoriamente!';
            $_SESSION['message_type'] = 'danger';
    
            header('location: ../asignaciones_tb.php');
            $result_articulo->free_result();
            $stmt_articulo->close();
            $stmt->close();
            $stmt_update->close();
            $conn->close();
        }else{
            $conn->close();
            die("La deshasignación ha fallado.");
        }
        
    }
?>