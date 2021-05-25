<?php 

    include("../database.php"); 


    $idarea ='';
    $descripcion = '';

    if (isset($_GET['idarea'])) {
        $idarea = $_GET['idarea'];
        $query = "select * from areaemp where idarea = $idarea";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            $descripcion = $row['descripcion'];
        }
    }

    if (isset($_POST['actualizar'])) {
        $idarea = $_GET['idarea'];
        $descripcion = $_POST['descripcion'];

        $query = "update areaemp set descripcion = '$descripcion' where idarea = $idarea";
        mysqli_query($conn, $query);

        header('Location: ../areaemp_vw.php');
    }

?>
<?php include('../partials/header.php')?>
<?php include('../partials/navbar.php')?>

    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <div class="card card-body text-center">
                <h1>Actualizar Área de Empleados</h1>
                <form action="update_areaemp.php?idarea=<?php echo $_GET['idarea']; ?>" method="POST">
                    <div class="form-group">
                        <textarea name="descripcion" class="form-control" cols="30" rows="10" required><?php echo $descripcion?></textarea>
                    </div>
                    <button class="btn btn-success btn-block" name="actualizar">Actualizar</button>
                </form>
                </div>
            </div>
        </div>
    </div>

<?php include('../partials/footer.php')?>