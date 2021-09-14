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
        <h1>Traslados</h1>
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
            <table class="table table-responsive-lg table-bordered text-center" id="tabla_traslados">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Tarjeta de Responsable</th>
                        <th>Autorización</th>
                        <th>Descripción del bien</th>
                        <th>Sección</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $query = "select a.idasignacion, a.fecha_asignacion, a.tarjeta_responsable, a.autorizacion, b.descripcion, a.seccion from asignacion a inner join articulo b on 
                        a.articulo_idarticulo = b.idarticulo inner join asignacion c on  c.idasignacion = a.asignacion_idasignacion order by fecha_asignacion asc";

                        $result = mysqli_query($conn, $query);

                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td style="width: 100px"><?php echo $row['fecha_asignacion']?></td>
                                <td><?php echo $row['tarjeta_responsable']?></td>
                                <td><?php echo $row['autorizacion']?></td>
                                <td><?php echo $row['descripcion']?></td>
                                <td><?php echo $row['seccion']?></td>
                                <td class="align-center" style="width: 100px">
                                    <?php if ($_SESSION['crear'] == 1) { ?>
                                    <span data-toggle="tooltip" data-placement="top" title="Reporte"><button type="button" onclick="window.open('reports/report_traslado.php?idasignacion=<?php echo $row['idasignacion']?>')" 
                                    class="btn btn-success" style="width: 44px"><i class="fas fa-print"></i></button></span>
                                    <?php } ?>
                                    <?php if ($_SESSION['editar'] == 1) { ?>
                                    <span data-toggle="tooltip" data-placement="top" title="Editar"><button type="button" class="btn btn-secondary" data-toggle="modal" 
                                    data-target="#Modal_update_traslado<?php echo $row['idasignacion']; ?>" style="width: 44px"><i class="fas fa-edit"></i></button></span>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php include('modals/update_traslado.php'); ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<?php include("partials/footer.php")?>
<script >
    $(document).ready(function() {
        $('#tabla_traslados').DataTable( {
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