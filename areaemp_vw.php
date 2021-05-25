<?php include('database.php')?>
<?php include("partials/header.php")?>
<?php include("partials/navbar.php")?>

<main class="container-fluid p-4">
  <div class="row">
    <div class="col-md-4 mx-auto mb-3">
      <div class="card card-body text-center">
      <h1>Área de Empleados</h1>
        <form action="control/create_areaemp.php" method="POST">
            <div class="form-group">
            <textarea name="descripcion" rows="4" class="form-control" placeholder="Descripción" required></textarea>
            </div>
            <input type="submit" class="btn btn-primary btn-block" name="create_areaemp" value="Agregar">
        </form>
      </div>
    </div>
    <div class="col-md-8 mx-auto mb-3">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Descripción</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
            <?php
                $query = "select * from areaemp";
                $result_areaemp = mysqli_query($conn, $query);

                while($row = mysqli_fetch_assoc($result_areaemp)){?>

                <tr>
                    <td><?php echo $row['descripcion']; ?></td>
                    <td>
                      <a href="control/update_areaemp.php?idarea=<?php echo $row['idarea']?>"class="btn btn-secondary"><i class="fas fa-edit"></i>Editar</a>
                      <a href="control/delete_areaemp.php?idarea=<?php echo $row['idarea']?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i>Eliminar</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</main>

<?php include("partials/footer.php")?>