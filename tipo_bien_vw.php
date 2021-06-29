<?php
    require 'database.php';
?>

<?php include("partials/header.php")?>

<?php include("partials/navbar.php")?>

<main class="container-fluid p-4">
  <div class="text-center mb-4">
    <h1>Tipos de Bienes</h1>
  </div>
  <div class="row">
    <div class="col-md-8 mx-auto mb-3">
      <div class="mb-2">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tipobien">
          <i class="fas fa-plus"></i> Agregar Tipo de Bien
        </button>
      </div>
              
      <div class="modal fade" id="tipobien" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Nuevo Tipo de Bien</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="card card-body text-center">
                <form action="control/create_tipobien.php" method="POST">
                  <div class="form-group">
                    <textarea name="descripcion" rows="4" class="form-control" placeholder="Descripción" required></textarea>
                  </div>
                    <input type="submit" class="btn btn-primary btn-block" name="create_tipobien" value="Agregar">
                </form>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>

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
      <table class="table table-bordered text-center" id="tipo_bien">
        <thead>
          <tr>
            <th>Descripción</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>

            <?php

                $query = "select * from tipo";
                $result_tipo = mysqli_query($conn, $query);

                while($row = mysqli_fetch_assoc($result_tipo)){?>

                <tr>

                    <td><?php echo $row['descripcion']; ?></td>
                    <td>
                      <a href="control/update_tipo.php?idtipo=<?php echo $row['idtipo']?>"class="btn btn-secondary"><i class="fas fa-edit"></i>Editar</a>
                    </td>
                
                </tr>

            <?php } ?>

        </tbody>
      </table>
    </div>
  </div>
</main>


<?php include("partials/footer.php")?>
<script >
    $(document).ready(function() {
        $('#tipo_bien').DataTable( {
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
            }
        } );
    } );
</script>