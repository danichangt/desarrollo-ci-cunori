<?php 
    require 'database.php';

?>
<?php include("partials/header.php")?>
<?php include("partials/navbar.php")?>
<body>
    <main class="container-fluid p-4">
        <div class="text-center mb-4">
            <h1>Administración de Usuarios</h1>
        </div>
        <div class="row">
            <div class="col-md-10 mx-auto">
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
            <div class="mb-2">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuevo_usuario">
                    <i class="fas fa-plus"></i> Agregar
                </button>
            </div>
            <?php include('modals/create_usuario.php'); ?>
                
                <table class="table table-responsive-lg table-bordered text-center" id="tabla_usuarios">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Nombre Completo</th>
                            <th>Rol</th>
                            <th>Activo</th>
                            <th>Privilegios</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $query = "select u.idusuario, u.usuario, u.nombres, u.apellidos, u.estado, r.crear, r.leer, r.editar, r.eliminar, r.rol from usuario u 
                            inner join rol r on u.rol_idrol = r.idrol";
                            $result = mysqli_query($conn, $query);

                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?php echo $row['usuario'] ?></td>
                                    <td><?php echo $row['nombres'].$row['apellidos'] ?></td>
                                    <td><?php echo $row['rol'] ?></td>
                                        <?php 
                                            if ($row['estado'] == 1) { ?>
                                                <td><i class="fas fa-check fa-2x" style = "color: green"></i></td>
                                        <?php }else{ ?>
                                                <td><i class="fas fa-times fa-2x" style = "color: red"></i></td>
                                        <?php } ?>
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
                                        <span data-toggle="tooltip" data-placement="top" title="Editar"><button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#Modal_update_usuario<?php echo $row['idusuario'] ?>" style="width: 44px">
                                        <i class="fas fa-edit"></i></button></span>
                                        <span data-toggle="tooltip" data-placement="top" title="Eliminar"><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Modal_delete_usuario<?php echo $row['idusuario'] ?>" style="width: 44px">
                                        <i class="fas fa-trash-alt"></i></button></span>
                                    </td>
                                </tr>
                                <?php include('modals/update_usuario.php'); ?>
                                <?php include('modals/delete_usuario.php'); ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
<?php include("partials/footer.php")?>
<script>
    $(document).ready(function() {
        $('#tabla_usuarios').DataTable( {
          order: [[ 1, "asc" ]],
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