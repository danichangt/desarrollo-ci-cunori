<?php
    require 'database.php';

    if (!isset($_SESSION['rol'])) {
      header('Location: login.php');
    }
?>

<?php include("partials/header.php")?>

<?php include("partials/navbar.php")?>
<body>
<main class="container-fluid p-4">
    <div class="text-center mb-4">
        <h1>Mantenimiento de Vehículos y Equipo</h1>
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
            <table class="table table-responsive-lg table-bordered text-center" id="tb_mantenimientos">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>No. Clave de Control</th>
                        <th>No. Tarjeta de Responsable</th>
                        <th>Responsable</th>
                        <th>Descripción</th>
                        <th>No. Factura</th>
                        <th>Valor Neto Q</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $query = "select m.idmantenimiento, m.fecha_mantenimiento, b.no_clave_control, a.tarjeta_responsable, m.descripcion, m.no_factura, m.valor_neto, 
                        e.nombres, e.apellidos from mantenimiento m inner join asignacion a on m.asignacion_idasignacion = a.idasignacion inner join articulo b on 
                        a.articulo_idarticulo = b.idarticulo inner join empleado e on a.empleado_idempleado = e.idempleado";
                        $result = mysqli_query($conn, $query);

                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td style="width: 100px"><?php echo $row['fecha_mantenimiento']?></td>
                                <td><?php echo $row['no_clave_control']?></td>
                                <td><?php echo $row['tarjeta_responsable']?></td>
                                <td><?php echo $row['nombres'].$row['apellidos']?></td>
                                <td><?php echo $row['descripcion']?></td>
                                <td><?php echo $row['no_factura']?></td>
                                <td>Q<?php echo $row['valor_neto']?></td>
                                <td class="align-center" style="width: 100px">
                                    <?php if ($_SESSION['crear'] == 1) { ?>
                                    <span data-toggle="tooltip" data-placement="top" title="Reporte"><button type="button" onclick="window.open('reports/report_mantenimiento.php?idmantenimiento=<?php echo $row['idmantenimiento']; ?>')" 
                                    class="btn btn-success" style="width: 44px"><i class="fas fa-print"></i></button></span>
                                    <?php } ?>
                                    <?php if ($_SESSION['editar'] == 1) { ?>
                                    <span data-toggle="tooltip" data-placement="top" title="Editar"><button type="button" class="btn btn-secondary" data-toggle="modal" 
                                    data-target="#Modal_mantenimiento<?php echo $row['idmantenimiento']; ?>" style="width: 44px"><i class="fas fa-edit"></i></button></span>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php include('modals/update_mantenimiento.php'); ?>
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