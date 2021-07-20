<?php 

    include('../database.php');

    $idempleado = '';

    $codigo = '';
    $nombres = '';
    $apellidos = '';

    $ae_descripcion = '';

    if(isset($_GET['idempleado'])){
        $idempleado = $_GET['idempleado'];
        $query = "select e.codigo, e.nombres, e.apellidos, ae.descripcion as area from empleado e inner join areaemp ae on e.areaemp_idarea = ae.idarea where e.idempleado = $idempleado";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);

            $codigo = $row['codigo'];
            $nombres = $row['nombres'];
            $apellidos = $row['apellidos'];

            $ae_descripcion = $row['area'];
        }
    }
?>

<?php include('../partials/header.php')?>
<?php include('../partials/navbar.php')?>

<div class="container-fluid p-4">
    
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="text-center mb-3">
                <h2>Lista de Bienes Asignados</h2>
            </div>
            <div>
                <label class="text-left"><strong>Código de Empleado: </strong><?php echo $codigo ?></label>
            </div>
            <div>
                <label class="text-left"><strong>Nombre Completo: </strong> <?php echo $nombres.$apellidos ?></label>
            </div>
            <div>
                <label class="text-left"><strong>Área de Empleado: </strong><?php echo $ae_descripcion ?></label>
            </div>
            <div class="text-right mb-2">
                <a href="../reports/report_asignaciones.php?idempleado=<?php echo $idempleado ?>" class="btn btn-success"><i class="fas fa-file-pdf"></i> Generar Reporte</a>
            </div>
            <table class="table table-responsive-lg table-bordered text-center" id="tb_lista">
                <thead>
                    <tr>
                        <th>Fecha de Asignación</th>
                        <th>No. Tarjeta de Responsable</th>
                        <th>No. Clave de Control</th>
                        <th>Descripción del Bien</th>
                        <th>Precio Unitario Q</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 

                        $query2 = "select a.fecha_asignacion, a.tarjeta_responsable, b.no_clave_control, b.descripcion, b.valor from asignacion a inner join articulo b 
                        on a.articulo_idarticulo = b.idarticulo where a.empleado_idempleado = $idempleado order by a.fecha_asignacion asc";
                        $result2 = mysqli_query($conn, $query2);
                        while ($row = mysqli_fetch_assoc($result2)) {?>
                            <tr>
                                <td><?php echo $row['fecha_asignacion'] ?></td>
                                <td><?php echo $row['tarjeta_responsable'] ?></td>
                                <td><?php echo $row['no_clave_control'] ?></td>
                                <td><?php echo $row['descripcion'] ?></td>
                                <td>Q <?php echo $row['valor'] ?></td>
                            </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include('../partials/footer.php')?>

<script >
    $(document).ready(function() {
        $('#tb_lista').DataTable( {
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
            }
        } );
    } );
</script>