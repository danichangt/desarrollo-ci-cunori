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
      
      <div class="card card-body text-center">
      <h1>Categorías</h1>
        <form action="control/create_categoria.php" method="POST">
            <div class="form-group">
                <input type="text" name="codigo_control" class="form-control" placeholder="Código de Control" autofocus>
            </div>
            <div class="form-group">
            <textarea name="descripcion" rows="4" class="form-control" placeholder="Descripción"></textarea>
            </div>
            <input type="submit" class="btn btn-primary btn-block" name="create_categoria" value="Agregar">
        </form>
      </div>
    </div>

    <div class="col-md-10 mx-auto mb-3">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Código de Control</th>
            <th>Descripción</th>
          </tr>
        </thead>
        <tbody>

            <?php

                $query = "select * from categoria";
                $result_cagoria = mysqli_query($conn, $query);

                while($row = mysqli_fetch_assoc($result_cagoria)){?>

                <tr>
                    <td><?php echo $row['codigo_control']; ?></td>
                    <td><?php echo $row['descripcion']; ?></td>
                
                </tr>

            <?php } ?>

        </tbody>
      </table>
    </div>
  </div>
</main>


<?php include("partials/footer.php")?>