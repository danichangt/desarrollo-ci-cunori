<?php 

    include("../database.php"); 

    $idmantenimiento = '';
    $fecha_mantenimiento = '';
    $no_clave_control = '';
    $tarjeta_responsable = '';
    $descripcion = '';
    $no_factura = '';
    $valor_neto = '';

    if (isset($_GET['idmantenimiento'])) {
        $idmantenimiento = $_GET['idmantenimiento'];

        $query = "select idmantenimiento, fecha_mantenimiento, no_clave_control, tarjeta_responsable, descripcion, no_factura, valor_neto from mantenimiento 
        where idmantenimiento = $idmantenimiento";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            $fecha_mantenimiento = $row['fecha_mantenimiento'];
            $no_clave_control = $row['no_clave_control'];
            $tarjeta_responsable = $row['tarjeta_responsable'];
            $descripcion = $row['descripcion'];
            $no_factura = $row['no_factura'];
            $valor_neto = $row['valor_neto'];
        }
    }

    if (isset($_POST['actualizar'])) {
        $idmantenimiento = $_GET['idmantenimiento'];
        $fecha_mantenimiento = $_POST['fecha_mantenimiento'];
        $no_clave_control = $_POST['no_clave_control'];
        $tarjeta_responsable = $_POST['tarjeta_responsable'];
        $descripcion = $_POST['descripcion'];
        $no_factura = $_POST['no_factura'];
        $valor_neto = $_POST['valor_neto'];

        $query = "update mantenimiento set fecha_mantenimiento = '$fecha_mantenimiento', no_clave_control = '$no_clave_control', tarjeta_responsable = $tarjeta_responsable,  
        descripcion = '$descripcion', no_factura = '$no_factura', valor_neto = $valor_neto where idmantenimiento = $idmantenimiento";
        mysqli_query($conn, $query);

        if (!mysqli_query($conn, $query)) {
           die("fallo");
        }
        $_SESSION['message'] = '¡Mantenimiento actualizado exitosamente!';
        $_SESSION['message_type'] = 'info';
        header('Location: ../mantenimientos_vw.php');
    }

?>
<?php include('../partials/header.php')?>
<?php include('../partials/navbar.php')?>

<main class="container-fluid p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body text-center">
                <h1>Actualizar Mantenimiento</h1>
                <form action="update_mantenimiento.php?idmantenimiento=<?php echo $_GET['idmantenimiento']?>" method="POST">
                    <label>Fecha de Mantenimiento: </label>
                    <div class="form-group">
                        <input type="date" name="fecha_mantenimiento" class="form-control"  value="<?php echo $fecha_mantenimiento?>" required>
                    </div>
                    <label>No. Clave de Control: </label>
                    <div class="form-group">
                        <input type="text" name="no_clave_control" class="form-control"  value="<?php echo $no_clave_control?>" required>
                    </div>
                    <label>No. Tarjeta de Responsable: </label>
                    <div class="form-group">
                        <input type="number" name="tarjeta_responsable" class="form-control" value="<?php echo $tarjeta_responsable?>" min="0" step="1">
                    </div>
                    <label>Descripción: </label>
                    <div class="form-group">
                        <textarea name="descripcion" rows="4" class="form-control" required><?php echo $descripcion?></textarea>
                    </div>
                    <label>No. Factura: </label>
                    <div class="form-group">
                        <input type="text" name="no_factura" class="form-control" value="<?php echo $no_factura?>">
                    </div>
                    <label>Valor Neto: </label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Q</span>
                        <input type="number" name="valor_neto" class="form-control" value="<?php echo $valor_neto?>" min="0" step="0.01" required>
                    </div>

                    <button class="btn btn-primary btn-block" name="actualizar">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</main>