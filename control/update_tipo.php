<?php 

    include("../database.php"); 


    $idtipo ='';
    $descripcion = '';

    if (isset($_GET['idtipo'])) {
        $idtipo = $_GET['idtipo'];
        $query = "select * from tipo where idtipo = $idtipo";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            $descripcion = $row['descripcion'];
        }
    }

    if (isset($_POST['actualizar'])) {
        $idtipo = $_GET['idtipo'];
        $descripcion = $_POST['descripcion'];

        $query = "update tipo set descripcion = '$descripcion' where idtipo = $idtipo";
        mysqli_query($conn, $query);

        header('Location: ../tipo_bien_vw.php');
    }

?>

<?php include('../partials/header.php')?>
<?php include('../partials/navbar.php')?>

    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <div class="card card-body text-center">
                <h1>Actualizar Tipo de Artículo</h1>
                <form action="update_tipo.php?idtipo=<?php echo $_GET['idtipo']; ?>" method="POST">
                    <div class="form-group">
                        <textarea name="descripcion" class="form-control" cols="30" rows="10" required><?php echo $descripcion;?></textarea>
                    </div>
                    <button class="btn btn-success btn-block" name="actualizar">Actualizar</button>
                </form>
                </div>
            </div>
        </div>
    </div>

<?php include('../partials/footer.php')?>