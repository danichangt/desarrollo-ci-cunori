<?php
    require 'database.php';
?>

<?php include("partials/header.php")?>

<?php include("partials/navbar.php")?>

<main class="container-fluid p-4">
  <div class="row">
    <div class="col-md-4 mx-auto mb-3">
    
      <!-- MESSAGES -->
      <?php if (isset($_SESSION['message'])) { ?>
      <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['message']?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php session_unset(); } ?>
      <!-- MESSAGES -->

      <div class="card card-body">
      <h1 class="text-center">Registrar Bienes</h1>
        <form action="control/create_articulo.php" method="POST">
            <div class="form-group">
                <input type="text" name="no_clave_control" class="form-control" placeholder="No. de Clave de Control" autofocus required>
            </div>
            <div class="form-group">
            <textarea name="descripcion" rows="4" class="form-control" placeholder="Descripción" required></textarea>
            </div>
            <label for="areaemp_idarea">Categoría:</label>
            <div class="input-group mb-1">
                    <select class="custom-select" id="categoria" name="categoria">
                      <?php

                        $query = "select * from categoria order by descripcion asc";
                        $result_categoria = mysqli_query($conn, $query);

                        while($row = mysqli_fetch_assoc($result_categoria)){?>
                          <option value="<?php echo $row['idcategoria']?>"><?php echo $row['descripcion']?></option>
                        <?php } ?>
                    </select>
            </div>
            <div class="text-center"><span><a href="categoria_vw.php">Nueva categoría</a></span></div>
            <label for="tipo_bien">Tipo de Bien:</label>
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
            <div class="text-center"><span><a href="tipo_bien_vw.php">Nuevo tipo de bien</a></span></div>
            <div class="input-group mb-3 mt-4">
                <span class="input-group-text">Q</span>
                <input type="number" name="valor" class="form-control" placeholder="Valor" min="0" step="0.01">
            </div>
            <label>Fecha de ingreso:</label>
            <div class="form-group">
                <input type="date" name="fecha_ingreso" class="form-control">
            </div>
            <input type="submit" class="btn btn-primary btn-block" name="create_articulo" value="Agregar">
        </form>
      </div>
    </div>

    <div class="col-md-10 mx-auto mb-3">
      <table class="table table-bordered text-center">
        <thead>
          <tr>
            <th>No. de Clave de Control</th>
            <th>Descripción</th>
            <th>Valor</th>
            <th>Tipo de Bien</th>
            <th>Fecha de Ingreso</th>
            <th>Activo</th>
            <th>Disponible</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
        
          <?php

            $query = "select a.idarticulo, a.no_clave_control, a.descripcion, a.valor, t.descripcion as tipo_bien_descripcion, a.fecha_ingreso, a.activo, a.disponible from articulo a inner join tipo t on a.tipo_idtipo = t.idtipo;";
            $result_articulo = mysqli_query($conn, $query);

            while($row = mysqli_fetch_assoc($result_articulo)){?>

              <tr>

                <td><?php echo $row['no_clave_control']; ?></td>
                <td><?php echo $row['descripcion']; ?></td>
                <td><?php echo $row['valor']; ?></td>
                <td><?php echo $row['tipo_bien_descripcion']; ?></td>
                <td><?php echo $row['fecha_ingreso']; ?></td>
                <td><?php echo $row['activo']; ?></td>
                <td><?php echo $row['disponible']; ?></td>
                <td>
                  <a href="control/update_articulo.php?idarticulo=<?php echo $row['idarticulo']?>"class="btn btn-success"><i class="fas fa-user-plus"></i>Asignar</a>
                  <a href="control/update_articulo.php?idarticulo=<?php echo $row['idarticulo']?>"class="btn btn-secondary"><i class="fas fa-edit"></i>Editar</a>
                </td>
              </tr>

            <?php } ?>                
          
        </tbody>
        
      </table>
    </div>
  </div>
</main>

<?php include("partials/footer.php")?>