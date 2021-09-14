<?php
    require 'database.php';

    if (!isset($_SESSION['rol'])) {
      header('location: login.php');
    }
?>

<?php include("partials/header.php")?>

<?php include("partials/navbar.php")?>
<body>
<main class="container-fluid p-4">
  <div class="text-center mb-4">
    <h1>Tipos de Bienes</h1>
  </div>
  <div class="row">
    <div class="col-md-8 mx-auto mb-3">
      <!-- MESSAGES -->
      <?php if (isset($_SESSION['message'])) { ?>
      <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['message']?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php unset($_SESSION['message']); } ?>
      <!-- MESSAGES -->
      <?php if ($_SESSION['crear'] == 1) { ?>
      <div class="mb-2">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tipobien">
          <i class="fas fa-plus"></i> Agregar
        </button>
      </div>
      <?php } ?>      
      <div class="modal fade" id="tipobien" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Nuevo Registro</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="card card-body text-center">
                <form id="formtipo_bien" action="control/create_tipobien.php" method="POST">
                  <div class="form-group">
                    <textarea name="descripcion" rows="4" class="form-control" placeholder="Descripción" required></textarea>
                  </div>
                    <button type="submit" id="btnAgregar" class="btn btn-primary btn-block">Agregar</button>
                </form>
                <script> 
                    $(document).ready(function() {
                        $('#btnAgregar').click(function() {
                            $(this).prop("disabled", true);
                            $(this).html(
                            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
                            );
                            $('#formtipo_bien').submit();
                        });
                    });
                </script>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>

      <table class="table table-responsive-lg table-bordered text-center" id="tipo_bien">
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
                    <td class="align-center" style="width: 100px">
                      <?php if ($_SESSION['editar'] == 1) { ?>
                      <span data-toggle="tooltip" data-placement="top" title="Editar"><button type="button" class="btn btn-secondary" data-toggle="modal" 
                      data-target="#Modal_tipo<?php echo $row['idtipo']; ?>" style="width: 44px"><i class="fas fa-edit"></i></button></span>
                      <?php } ?>
                    </td>
                
                </tr>
                <?php include('modals/update_tipo.php'); ?>
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
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>
