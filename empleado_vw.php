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
            <h1>Empleados</h1>
    </div>    
    <div class="row">
        <div class="col-md-10 mx-auto mb-3">
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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#empleado">
                    <i class="fas fa-plus"></i> Agregar
                </button>
            </div>
            <?php } ?>

            <div class="modal fade" id="empleado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nuevo Registro</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card card-body">
                                <form id="crear_emp" action="control/create_empleado.php" method="POST">
                                    <div class="form-group">
                                        <input type="text" name="dpi" class="form-control" placeholder="DPI" required autofocus>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="codigo" class="form-control" placeholder="Código de empleado" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="nombres" class="form-control" placeholder="Nombres" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="apellidos" class="form-control" placeholder="Apellidos" required>
                                    </div>
                                    <label for="areaemp_idarea">Área:</label>
                                    <div class="input-group mb-1">
                                        <select class="custom-select" id="areaemp_idarea" name="areaemp_idarea" required>
                                            <option value="">Área...</option>
                                        <?php

                                            $query = "select * from areaemp order by descripcion asc";
                                            $result_area = mysqli_query($conn, $query);

                                            while($row = mysqli_fetch_assoc($result_area)){?>
                                            <option value="<?php echo $row['idarea']?>"><?php echo $row['descripcion']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="text-center mb-3"><span><a href="areaemp_vw.php">Nueva área</a></span></div>
                                    <button type="submit" id="btnAgregar" class="btn btn-primary btn-block">Agregar</button>
                                </form>
                                <script> 
                                    $(document).ready(function() {
                                        $('#btnAgregar').click(function() {
                                            $(this).prop("disabled", true);
                                            $(this).html(
                                            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
                                            );
                                            $('#crear_emp').submit();
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
            
            <table class="table table-responsive-lg table-bordered text-center" id="empleados">
                <thead>
                    <tr>
                        <th>DPI</th>
                        <th>Código de empleado</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Área</th>
                        <th>Acciones</th>
                    </tr>
                </thead>    
                <tbody>
                    <?php
                        $query = "select idempleado, dpi, codigo, nombres, apellidos, a.descripcion from empleado inner join areaemp a on a.idarea = areaemp_idarea order by nombres asc";
                        $result_empleado = mysqli_query($conn, $query);

                        while($row = mysqli_fetch_assoc($result_empleado)){?>

                            <tr>
                                <td><?php echo $row['dpi']; ?></td>
                                <td><?php echo $row['codigo']; ?></td>
                                <td><?php echo $row['nombres']; ?></td>
                                <td><?php echo $row['apellidos']; ?></td>
                                <td><?php echo $row['descripcion']; ?></td>
                                <td class="align-center" style="width: 100px">
                                    <?php if ($_SESSION['leer'] == 1){ ?>
                                        <span data-toggle="tooltip" data-placement="top" title="Asignaciones"><button type="button" onclick="location.href='control/list_asignaciones_empleado.php?idempleado=<?php echo $row['idempleado'] ?>'" 
                                        class="btn btn-success" style="width: 44px"><i class="fas fa-clipboard-list"></i></button></span>
                                        <?php } ?>
                                        <?php if ($_SESSION['editar'] == 1) { ?>
                                        <span data-toggle="tooltip" data-placement="top" title="Editar"><button type="button" class="btn btn-secondary" data-toggle="modal" 
                                        data-target="#Modal_empleado<?php echo $row['idempleado']; ?>" style="width: 44px"><i class="fas fa-edit"></i></button></span>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php include('modals/update_empleado.php'); ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<?php include("partials/footer.php")?>
<script >
    $(document).ready(function() {
        $('#empleados').DataTable( {
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