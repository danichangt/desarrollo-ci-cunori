<?php
    require 'database.php';
?>

<?php include("partials/header.php")?>

<?php include("partials/navbar.php")?>

<main class="container-fluid p-4">
    <div class="text-center mb-4">
        <h1>Asignaciones</h1>
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
            <?php session_unset(); } ?>
            <!-- MESSAGES -->
            <table class="table table-responsive-lg table-bordered text-center" id="tabla_asignaciones">
                <thead>
                    <tr>
                        <th>Tarjeta de Responsable</th>
                        <th>Fecha de Asignación</th>
                        <th>Descripción del bien</th>
                        <th>Valor</th>
                        <th>Activo</th>
                        <th>Responsable</th>
                        <th>Área</th>
                        <th>Acciones</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $query = "select a.idasignacion, a.tarjeta_responsable, a.fecha_asignacion, b.descripcion, b.valor, b.activo, e.nombres, e.apellidos, ae.descripcion as area
                        from asignacion a inner join articulo b on a.articulo_idarticulo = b.idarticulo inner join empleado e on a.empleado_idempleado = e.idempleado
                        inner join areaemp ae on e.areaemp_idarea = ae.idarea";
                        $result_asignaciones = mysqli_query($conn, $query);

                        while ($row = mysqli_fetch_assoc($result_asignaciones)) { ?>
                            <tr>
                                <td><?php echo $row['tarjeta_responsable'] ?></td>
                                <td><?php echo $row['fecha_asignacion'] ?></td>
                                <td><?php echo $row['descripcion'] ?></td>
                                <td><?php echo $row['valor'] ?></td>
                                <?php
                                    if ($row['activo'] == 1) { ?>
                                        <td><i class="fas fa-check fa-2x" style = "color: green"></i></td>
                                    <?php }else{ ?>
                                        <td><i class="fas fa-times fa-2x" style = "color: red"></i></td>
                                <?php } ?>
                                <td><?php echo $row['nombres'].$row['apellidos']?></td>
                                <td><?php echo $row['area'] ?></td>
                                <td>
                                    <a href="control/delete_asignacion.php?idasignacion=<?php echo $row['idasignacion']?>" class="btn btn-danger"><i class="fas fa-user-times"></i> Anular</a>
                                    <a href="control/update_asignacion.php?idasignacion=<?php echo $row['idasignacion']?>" class="btn btn-secondary"><i class="fas fa-edit"></i> Editar</a>
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
        $('#tabla_asignaciones').DataTable( {
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
            }
        } );
    } );
</script>