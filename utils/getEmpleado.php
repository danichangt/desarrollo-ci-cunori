<?php

    require('../database.php');

    $idarea = $_POST['idarea'];
    $queryE = "select idempleado, nombres, apellidos from empleado where areaemp_idarea = $idarea order by nombres asc";
    $resultado_empleado = mysqli_query($conn, $queryE);


    while($row_empleado = mysqli_fetch_assoc($resultado_empleado)){
        $html.= "<option value='".$row_empleado['idempleado']."'>".$row_empleado['nombres']." ".$row_empleado['apellidos']."</option>";
    }

    echo $html;

?>