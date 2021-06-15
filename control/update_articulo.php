<?php

    include('../database.php');

    $no_clave_control = '';
    $descripcion = '';
    $categoria_idcategoria = '';
    $tipo_idtipo = '';
    $valor = '';
    $fecha_ingreso = '';

    if (isset($_GET['idarticulo'])) {
        $idarticulo = $_GET['idarticulo'];
        $query = "select idarticulo, no_clave_control, descripcion, categoria_idcategoria, tipo_idtipo, valor, fecha_ingreso from articulo where idarticulo = $idarticulo";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            $no_clave_control = $row['no_clave_control'];
            $descripcion = $row['descripcion'];
            $categoria_idcategoria = $row['categoria_idcategoria'];
            $tipo_idtipo = ['tipo_idtipo'];
            $valor = $row['valor'];
            $fecha_ingreso = $row['fecha_ingreso'];
        }

    }

    if (isset($_POST['actualizar'])) {
        $idarticulo = $_GET['idarticulo'];
        $no_clave_control = $_POST['no_clave_control'];
        $descripcion = $_POST['descripcion'];
        $categoria_idcategoria = $_POST['categoria_idcategoria'];
        $tipo_idtipo = $_POST['tipo_idtipo'];
        $valor = $_POST['valor'];
        $fecha_ingreso = $_POST['fecha_ingreso'];

        $query = "update articulo set no_clave_control = '$no_clave_control', descripcion = '$descripcion', categoria_idcategoria = $categoria_idcategoria, 
                    tipo_idtipo = $tipo_idtipo, valor = $valor, fecha_ingreso = '$fecha_ingreso' where idarticulo = $idarticulo";
        mysqli_query($conn, $query);

        $_SESSION['message'] = '¡Artículo editado exitosamente!';
        $_SESSION['message_type'] = 'info';
        header('Location: ../add_articulo.php');
    }

?>

<?php include('../partials/header.php')?>
<?php include('../partials/navbar.php')?>

<main class="container-fluid p-4">
  <div class="row">
    <div class="col-md-4 mx-auto mb-3">
      

      <div class="card card-body text-center">
      <h1>Actualizar Bienes</h1>
        <form action="update_articulo.php?idarticulo=<?php echo $_GET['idarticulo']?>" method="POST">
            <div class="form-group">
                <input type="text" name="no_clave_control" class="form-control" value="<?php echo $row['no_clave_control']?>" placeholder="No. de Clave de Control" autofocus required>
            </div>
            <div class="form-group">
            <textarea name="descripcion" rows="4" class="form-control" placeholder="Descripción" required><?php echo $row['descripcion']?></textarea>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Q</span>
                <input type="number" name="valor" class="form-control" value="<?php echo $row['valor']?>" placeholder="Valor" min="0" step="0.01">
            </div>
            <div class="form-group">
                <input type="date" name="fecha_ingreso" value="<?php echo $row['fecha_ingreso']?>" class="form-control">
            </div>
            <div class="input-group mb-1">
                    <select class="custom-select" id="categoria" name="categoria_idcategoria">
                      <?php

                        $query2 = "select * from categoria order by descripcion asc";
                        $result_categoria = mysqli_query($conn, $query2);

                        while($row = mysqli_fetch_assoc($result_categoria)){?>
                          <option value="<?php echo $row['idcategoria']?>"><?php echo $row['descripcion']?></option>
                        <?php } ?>
                    </select>
            </div>
            <div class="input-group mb-1">
                    <select class="custom-select" id="tipo_bien" name="tipo_idtipo">
                      <?php

                        $query3 = "select * from tipo order by descripcion asc";
                        $result_tipo = mysqli_query($conn, $query3);

                        while($row = mysqli_fetch_assoc($result_tipo)){?>
                          <option value="<?php echo $row['idtipo']?>"><?php echo $row['descripcion']?></option>
                        <?php } ?>
                    </select>
            </div>
            
            
            <button class="btn btn-success btn-block" name="actualizar">Actualizar</button>

        </form>
      </div>
    </div>
    </div>
</main>

<?php include('../partials/footer.php')?>