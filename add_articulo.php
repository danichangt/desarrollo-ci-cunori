<?php
    require 'database.php';
?>

<?php include("partials/header.php")?>

<?php include("partials/navbar.php")?>

<main class="container-fluid p-4">
  <div class="row">
    <div class="col-md-4 mx-auto mb-3">
      

      <div class="card card-body text-center">
      <h1>Registrar Bienes</h1>
        <form action="control/create_articulo.php" method="POST">
            <div class="form-group">
                <input type="text" name="no_clave_control" class="form-control" placeholder="No. de Clave de Control" autofocus>
            </div>
            <div class="form-group">
            <textarea name="descripcion" rows="4" class="form-control" placeholder="Descripción"></textarea>
            </div>
            <div class="input-group mb-1">
                    <select class="custom-select" id="categoria" name="categoria">
                      <?php

                        $query = "select * from categoria order by descripcion asc";
                        $result_categoria = mysqli_query($conn, $query);

                        while($row = mysqli_fetch_assoc($result_categoria)){?>
                          <option value="<?php echo $row['codigo_control']?>"><?php echo $row['descripcion']?></option>
                        <?php } ?>
                    </select>
            </div>
            <span><a href="categoria_vw.php">Nueva Categoría</a></span>
            <div class="input-group mb-1">
                    <select class="custom-select" id="tipo_bien" name="tipo_bien">
                      <?php

                        $query = "select * from tipo order by descripcion asc";
                        $result_tipo = mysqli_query($conn, $query);

                        while($row = mysqli_fetch_assoc($result_tipo)){?>
                          <option value="<?php echo $row['idtipo']?>"><?php echo $row['descripcion']?></option>
                        <?php } ?>
                    </select>
            </div>
            <span><a href="tipo_bien_vw.php">Nuevo Tipo de Bien</a></span>
            <div class="input-group mb-3">
                <span class="input-group-text">Q</span>
                <input type="number" name="valor" class="form-control" placeholder="Valor" min="0" step="0.01">
            </div>
            <div class="form-group">
                <input type="date" name="fecha_ingreso" class="form-control">
            </div>
            <input type="submit" class="btn btn-primary btn-block" name="create_articulo" value="Agregar">

        </form>
      </div>
    </div>

    <div class="col-md-10 mx-auto mb-3">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>No. de Clave de Control</th>
            <th>Descripción</th>
            <th>Valor</th>
            <th>Tipo de Bien</th>
            <th>Fecha de Ingreso</th>
            <th>Activo</th>
            <th>Disponible</th>
          </tr>
        </thead>
        
      </table>
    </div>
  </div>
</main>

<?php include("partials/footer.php")?>