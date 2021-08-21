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
            <?php unset($_SESSION['message']); } ?>
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
                        $query = "select a.idasignacion, a.fecha_asignacion, a.tarjeta_responsable, a.estado, a.contador_traslado, b.descripcion, b.valor, e.nombres, e.apellidos, ae.descripcion as area
                        from asignacion a inner join articulo b on a.articulo_idarticulo = b.idarticulo inner join empleado e on a.empleado_idempleado = e.idempleado
                        inner join areaemp ae on e.areaemp_idarea = ae.idarea order by a.fecha_asignacion asc";
                        $result_asignaciones = mysqli_query($conn, $query);

                        while ($row = mysqli_fetch_assoc($result_asignaciones)) { ?>
                            <tr>
                                <td><?php echo $row['tarjeta_responsable'] ?></td>
                                <td style="width: 100px"><?php echo $row['fecha_asignacion'] ?></td>
                                <td><?php echo $row['descripcion'] ?></td>
                                <td><div style = "width: 75px">Q <?php echo $row['valor'] ?></div></td>
                                <?php
                                    if ($row['estado'] == 1) { ?>
                                        <td><i class="fas fa-check fa-2x" style = "color: green"></i></td>
                                    <?php }else{ ?>
                                        <td><i class="fas fa-times fa-2x" style = "color: red"></i></td>
                                <?php } ?>
                                <td><?php echo $row['nombres'].$row['apellidos']?></td>
                                <td><?php echo $row['area'] ?></td>
                                <td class="align-center" style="width: 250px">
                                    <?php if ($row['estado'] == 1) { ?>
                                        <span data-toggle="tooltip" data-placement="top" title="Anular"><button type="button" class="btn btn-danger" data-toggle="modal" 
                                        data-target="#Modal_delete<?php echo $row['idasignacion']; ?>" style="width: 44px"><i class="fas fa-user-times"></i></button></span>
                                        <span data-toggle="tooltip" data-placement="top" title="Mantenimiento"><button type="button" class="btn btn-dark" data-toggle="modal" 
                                        data-target="#Modal_mantenimiento<?php echo $row['idasignacion']; ?>"style="width: 44px"><i class="fas fa-tools"></i></button></span>
                                        <?php if ($row['contador_traslado'] <= 4) { ?>
                                            <span data-toggle="tooltip" data-placement="top" title="Traslado"><button type="button" class="btn btn-primary" data-toggle="modal" 
                                            data-target="#Modal_traslado<?php echo $row['idasignacion']; ?>" style="width: 44px"><i class="fas fa-arrows-alt-h"></i></button></span>
                                        <?php } else { ?>
                                            <button type="button" class="btn btn-warning" style="color: white" disabled style="width: 44px"><i class="fas fa-arrows-alt-h"></i></button>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <button type="button" class="btn btn-danger" disabled style="width: 44px"><i class="fas fa-user-times"></i></button>
                                        <button type="button" class="btn btn-dark" disabled style="width: 44px"><i class="fas fa-tools"></i></button>
                                        <button type="button" class="btn btn-primary" disabled style="width: 44px"><i class="fas fa-arrows-alt-h"></i></button>
                                    <?php } ?>
                                        <span data-toggle="tooltip" data-placement="top" title="Reporte"><button type="button" onclick="window.open('reports/report_asignacion.php?idasignacion=<?php echo $row['idasignacion']?>')" 
                                        class="btn btn-success" style="width: 44px"><i class="fas fa-print"></i></button></span>
                                        <span data-toggle="tooltip" data-placement="top" title="Editar"><button type="button" class="btn btn-secondary" data-toggle="modal" 
                                        data-target="#Modal_update_asignacion<?php echo $row['idasignacion']; ?>" style="width: 44px"><i class="fas fa-edit"></i></button></span>
                                </td>
                            </tr>
                            <?php include('modals/delete_asignacion.php'); ?>
                            <?php include('modals/update_asignacion.php'); ?> 
                            <?php include('modals/create_mantenimiento.php'); ?>
                            <?php include('modals/create_traslado.php'); ?>    
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
        $('#tabla_asignaciones').DataTable( {
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