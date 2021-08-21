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
    <h1>Categorías</h1>
  </div>
  <div class="row">
    
    <div class="col-md-8 mx-auto mb-3">
      <div class="mb-2">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#categoria">
          <i class="fas fa-plus"></i> Agregar
        </button>
      </div>

      <div class="modal fade" id="categoria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <form action="control/create_categoria.php" method="POST">
                    <div class="form-group">
                        <input type="text" name="codigo_control" class="form-control" placeholder="Código de Control"  required autofocus>
                    </div>
                    <div class="form-group">
                    <textarea name="descripcion" rows="4" class="form-control" placeholder="Descripción" required></textarea>
                    </div>
                    <button type="submit" id="btnAgregar" class="btn btn-primary btn-block" name="create_categoria">Agregar</button>
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
      <?php unset($_SESSION['message']); } ?>
      <!-- MESSAGES -->

      <table class="table table-responsive-lg table-bordered text-center" id="categorias">
        <thead>
          <tr>
            <th>Código de Control</th>
            <th>Descripción</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>

            <?php

                $query = "select idcategoria, codigo_control, descripcion from categoria";
                $result_cagoria = mysqli_query($conn, $query);

                while($row = mysqli_fetch_assoc($result_cagoria)){?>

                <tr>
                    <td><?php echo $row['codigo_control']; ?></td>
                    <td><?php echo $row['descripcion']; ?></td>
                    <td class="align-center" style="width: 100px">
                      <span data-toggle="tooltip" data-placement="top" title="Editar"><button type="button" class="btn btn-secondary" data-toggle="modal" 
                      data-target="#Modal_categoria<?php echo $row['idcategoria']; ?>" style="width: 44px"><i class="fas fa-edit"></i></button></span>
                    </td>
                </tr>
                <?php include('modals/update_categoria.php'); ?>

            <?php } ?>

        </tbody>
      </table>
    </div>
  </div>
</main>
</body>
<?php include("partials/footer.php")?>
<script >
    $(document).ready(function() {
        $('#categorias').DataTable( {
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
<script> 
    $(document).ready(function() {
        $('#btnAgregar').submit(function() {
            $(this).prop("disabled", true);
            $(this).html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
            );
        });
    });
</script>