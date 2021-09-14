<?php 
    require 'database.php';
    if(!isset($_SESSION['rol'])){
        header('location: login.php');
      }else{
          if($_SESSION['rol'] != 1){
              session_unset();
              session_destroy();
              header('location: login.php');
          }
      }
?>
<?php include("partials/header.php")?>
<?php include("partials/navbar.php")?>
<body>
    <main class="container-fluid p-4">
        <div class="text-center mb-4">
            <h1>Roles de Usuarios</h1>
        </div>
        <div class="col-md-10 mx-auto">
            <div class="mb-2">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuevo_rol">
                    <i class="fas fa-plus"></i> Agregar
                </button>
            </div>
            <?php include('modals/create_rol.php'); ?>
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
            <table class="table table-responsive-lg table-bordered text-center" id="tabla_roles">
                <thead>
                    <tr>
                        <th>Rol</th>
                        <th>Privilegios</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                        <?php 
                            $query = "select idrol, rol, crear, leer, editar, eliminar from rol";
                            $result = mysqli_query($conn, $query);

                            while ($row = mysqli_fetch_assoc($result)) {?>
                            <tr>
                                <td><?php echo $row['rol'] ?></td>
                                <td class="align-center" style="width: 200px">
                                        <?php if ($row['crear'] == 1) { ?>
                                            <span data-toggle="tooltip" data-placement="top" title="Crear"><i class="fas fa-plus fa-2x" style="color: green" ></i></span>
                                        <?php } ?>
                                        <?php if ($row['eliminar'] == 1) { ?>
                                            <span data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fas fa-minus fa-2x" style="color: red"></i></span>
                                        <?php } ?>
                                        <?php if ($row['leer'] == 1) { ?>
                                            <span data-toggle="tooltip" data-placement="top" title="Leer"><i class="fas fa-eye fa-2x" style="color: blue"></i></span>
                                        <?php } ?>
                                        <?php if ($row['editar'] == 1) { ?>
                                            <span data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-pen fa-2x" style="color: grey"></i></span>
                                        <?php } ?>
                                </td>
                                <td class="align-center" style="width: 100px">
                                    <?php if ($row['idrol'] != 1) { ?>
                                        <span data-toggle="tooltip" data-placement="top" title="Editar"><button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#Modal_update_rol<?php echo $row['idrol'] ?>" style="width: 44px">
                                        <i class="fas fa-edit"></i></button></span>
                                    <?php } ?>
                                    
                                </td>
                            </tr>
                            <?php include('modals/update_rol.php'); ?>
                        <?php } ?>
                </tbody>
            </table>
        </div>

    </main>

<?php include("partials/footer.php")?>
<script>
    $(document).ready(function() {
        $('#tabla_roles').DataTable( {
          order: [[ 0, "asc" ]],
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