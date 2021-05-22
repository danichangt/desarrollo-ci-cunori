<?php 

    include('../database.php'); 


    $codigo_control ='';
    $descripcion = '';

    if (isset($_GET['codigo_control'])) {
        $codigo_control = $_GET['codigo_control'];
        $query = "select * from categoria where codigo_control = '$codigo_control'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            $codigo_control = $row['codigo_control'];
            $descripcion = $row['descripcion'];
        }
    }

    if (isset($_POST['actualizar'])) {
        $codigo_control = $_POST['codigo_control'];
        $descripcion = $_POST['descripcion'];

        $query = "update categoria set codigo_control = '$codigo_control', descripcion = '$descripcion' where codigo_control = $codigo_control";
        mysqli_query($conn, $query);

        header('Loctacion: ../categoria_vw.php');
    }

?>
<?php include('../partials/header.php')?>
<?php include('../partials/navbar.php')?>

    <div class="container p-4">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <div class="card card-body">
                <form action="update_categoria.php?id=<?php echo $_GET['codigo_control']; ?>" method="POST">
                    <div class="form-group">
                    <input name="codigo_control" type="text" class="form-control" value="<?php echo $codigo_control; ?>" placeholder="Actualizar Código de Control">
                    </div>
                    <div class="form-group">
                    <textarea name="descripcion" class="form-control" cols="30" rows="10"><?php echo $descripcion;?></textarea>
                    </div>
                    <button class="btn btn-success btn-block" name="actualizar">Actualizar</button>
                </form>
                </div>
            </div>
        </div>
    </div>

<?php include('../partials/footer.php')?>