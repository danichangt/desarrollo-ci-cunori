<?php

    include('../database.php');

    $dpi = '';
    $codigo = '';
    $nombres = '';
    $apellidos = '';
    $areaemp_idarea = '';

    if (isset($_GET['idempleado'])) {
        $idempleado = $_GET['idempleado'];
        $query = "select * from empleado where idempleado = $idempleado";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            $dpi = $row['dpi'];
            $codigo = $row['codigo'];
            $nombres = $row['nombres'];
            $apellidos = $row['apellidos'];
            $areaemp_idarea = $row['areaemp_idarea'];
        }
    }

    if (isset($_POST['actualizar'])) {
        $idempleado = $_GET['idempleado'];
        $dpi = $_POST['dpi'];
        $codigo = $_POST['codigo'];
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $areaemp_idarea = $_POST['areaemp_idarea'];


        $query = "update empleado set dpi = '$dpi', codigo = '$codigo', nombres = '$nombres', apellidos = '$apellidos', areaemp_idarea = $areaemp_idarea where idempleado = $idempleado";
        mysqli_query($conn, $query);

        $_SESSION['message'] = '¡Empleado editado exitosamente!';
        $_SESSION['message_type'] = 'info';
        header('Location: ../empleado_vw.php');

    }

?>
<?php include('../partials/header.php')?>
<?php include('../partials/navbar.php')?>

<div class="container-fluid p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <h1 class="text-center">Actualizar Empleado</h1>
                <form action="update_empleado.php?idempleado=<?php echo $_GET['idempleado']; ?>" method="POST">
                    <div class="form-group">
                        <input type="text" name="dpi" class="form-control" value="<?php echo $dpi; ?>" placeholder="DPI" required autofocus>
                    </div>
                    <div class="form-group">
                        <input type="text" name="codigo" class="form-control" value="<?php echo $codigo; ?>" placeholder="Código de empleado" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="nombres" class="form-control" value="<?php echo $nombres; ?>" placeholder="Nombres" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="apellidos" class="form-control" value="<?php echo $apellidos; ?>" placeholder="Apellidos" required>
                    </div>
                    <label for="areaemp_idarea">Área:</label>
                    <div class="input-group mb-1">
                        <select class="custom-select" id="areaemp_idarea" name="areaemp_idarea">
                            <?php

                                $query = "select * from areaemp order by descripcion asc";
                                $result_area = mysqli_query($conn, $query);

                                while($row = mysqli_fetch_assoc($result_area)){?>
                                    <option value="<?php echo $row['idarea']?>"><?php echo $row['descripcion']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="text-center mb-3"><span><a href="../areaemp_vw.php">Nueva área</a></span></div>
                    <button class="btn btn-success btn-block" name="actualizar">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>

    

<?php include('../partials/footer.php')?>