<?php 

    require '../database.php';

    if (!isset($_SESSION['rol'])) {
    header('location: login.php');
    }

    $idempleado = '';

    $codigo = '';
    $nombres = '';
    $apellidos = '';

    $ae_descripcion = '';

    if(isset($_GET['idempleado'])){
        
        $stmt = $conn->prepare("select e.codigo, e.nombres, e.apellidos, ae.descripcion as area from empleado e inner join 
        areaemp ae on e.areaemp_idarea = ae.idarea where e.idempleado = ?");
        $stmt->bind_param("i",$idempleado);
        $idempleado = $_GET['idempleado'];
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if (count($result) > 0) {
            $row = $result->fetch_assoc();

            $codigo = $row['codigo'];
            $nombres = $row['nombres'];
            $apellidos = $row['apellidos'];
            $ae_descripcion = $row['area'];

            $result->free_result();
            
        }
    }
?>
<?php include('../partials/header.php')?>
<?php include('../partials/navbar.php')?>
<body>
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
                <button type="button" onclick="window.open('../reports/report_asignaciones.php?idempleado=<?php echo $idempleado ?>')" class="btn btn-success"><i class="fas fa-file-pdf"></i> Generar Reporte</button>
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

                        $stmt2 = $conn->prepare("select a.fecha_asignacion, a.tarjeta_responsable, b.no_clave_control, b.descripcion, b.valor from asignacion a inner join articulo b 
                        on a.articulo_idarticulo = b.idarticulo where a.empleado_idempleado = ? and a.estado = 1 order by a.fecha_asignacion asc");
                        $stmt2->bind_param("i", $idempleado);
                        $stmt2->execute();
                        $result2 = $stmt2->get_result();
                        $stmt2->close();
                        while ($row2 = $result2->fetch_assoc()) {?>
                            <tr>
                                <td style="width: 100px"><?php echo $row2['fecha_asignacion'] ?></td>
                                <td><?php echo $row2['tarjeta_responsable'] ?></td>
                                <td><?php echo $row2['no_clave_control'] ?></td>
                                <td><?php echo $row2['descripcion'] ?></td>
                                <td>Q <?php echo $row2['valor'] ?></td>
                            </tr>
                    <?php }
                        $result2->free_result();
                        $conn->close();
                    ?>
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