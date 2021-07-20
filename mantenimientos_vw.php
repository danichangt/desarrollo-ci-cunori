<?php
    require 'database.php';
?>

<?php include("partials/header.php")?>

<?php include("partials/navbar.php")?>

<main class="container-fluid p-4">
    <div class="text-center mb-4">
        <h1>Mantenimiento de Vehículos y Equipo</h1>
    </div>
    <div class="row">
        <div class="col-md-10 mx-auto mb-3">
            <div class="mb-2">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mtos">
                <i class="fas fa-plus"></i> Agregar
                </button>
            </div>

            <div class="modal fade" id="mtos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Registro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-body">
                        <form action="control/create_mantenimiento.php" method="POST">
                            <label>Fecha de Mantenimiento: </label>
                            <div class="form-group">
                                <input type="date" name="fecha_mantenimiento" class="form-control" required>
                            </div>
                            <label>No. Clave de Control: </label>
                            <div class="form-group">
                                <input type="text" name="no_clave_control" class="form-control" placeholder="No. de Clave de Control" required>
                            </div>
                            <label>No. Tarjeta de Responsable: </label>
                            <div class="form-group">
                                <input type="number" name="tarjeta_responsable" class="form-control" placeholder="No. de Tarjeta de responsable" value="0" min="0" step="1">
                            </div>
                            <label>Descripción: </label>
                            <div class="form-group">
                                <textarea name="descripcion" rows="4" class="form-control" placeholder="Descripción" required></textarea>
                            </div>
                            <label>No. Factura: </label>
                            <div class="form-group">
                            <input type="text" name="no_factura" class="form-control" placeholder="No. de Factura" value="">
                            </div>
                            <label>Valor Neto: </label>
                            <div class="input-group mb-3">
                            <span class="input-group-text">Q</span>
                            <input type="number" name="valor_neto" class="form-control" placeholder="Valor Neto" min="0" step="0.01" required>
                            </div>

                            <button type="submit" id="btnAgregar" class="btn btn-primary btn-block" name="create_mantenimiento">Agregar</button>
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
            <table class="table table-responsive-lg table-bordered text-center" id="tb_mantenimientos">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>No. Clave de Control</th>
                        <th>No. Tarjeta de Responsable</th>
                        <th>Descripción</th>
                        <th>No. Factura</th>
                        <th>Valor Neto Q</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $query = "select idmantenimiento, fecha_mantenimiento, no_clave_control, tarjeta_responsable, descripcion, no_factura, valor_neto from mantenimiento";
                        $result = mysqli_query($conn, $query);

                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $row['fecha_mantenimiento']?></td>
                                <td><?php echo $row['no_clave_control']?></td>
                                <td><?php echo $row['tarjeta_responsable']?></td>
                                <td><?php echo $row['descripcion']?></td>
                                <td><?php echo $row['no_factura']?></td>
                                <td>Q<?php echo $row['valor_neto']?></td>
                                <td class="position: absolute">
                                    <a href="reports/report_mantenimiento.php?idmantenimiento=<?php echo $row['idmantenimiento']?>" class="btn btn-success"><i class="fas fa-file-pdf"></i> Reporte</a>
                                    <a href="control/update_mantenimiento.php?idmantenimiento=<?php echo $row['idmantenimiento']?>" class="btn btn-secondary"><i class="fas fa-edit"></i> Editar</a>
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
        $('#tb_mantenimientos').DataTable( {
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
            },
        } );
    } );
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