<?php require 'database.php'?>
<?php include("partials/header.php")?>
<?php include("partials/navbar.php")?>

<main class="container-fluid p-4">
    <div class="text-center mb-4">
        <h1>Inventario General</h1>
    </div>
    <div class="col-md-10 mx-auto mt-4">
        <table class="table table-bordered text-center" id="inventario_general" >
            <thead>
                <tr>
                    <th>No. de Clave de Control</th>
                    <th>Descripción</th>
                    <th>Valor</th>
                    <th>Tipo de Bien</th>
                    <th>Fecha de Ingreso</th>
                    <th>Activo</th>
                    <th>Disponible</th>
                </tr>
            </thead>
            <tbody>
            
                <?php

                    $query = "select a.idarticulo, a.no_clave_control, a.descripcion, a.valor, t.descripcion as tipo_bien_descripcion, a.fecha_ingreso, a.activo, a.disponible from articulo a inner join tipo t on a.tipo_idtipo = t.idtipo;";
                    $result_articulo = mysqli_query($conn, $query);

                    while($row = mysqli_fetch_assoc($result_articulo)){?>

                    <tr>

                        <td><?php echo $row['no_clave_control']; ?></td>
                        <td><?php echo $row['descripcion']; ?></td>
                        <td><?php echo $row['valor']; ?></td>
                        <td><?php echo $row['tipo_bien_descripcion']; ?></td>
                        <td><?php echo $row['fecha_ingreso']; ?></td>
                        <td><?php echo $row['activo']; ?></td>
                        <td><?php echo $row['disponible']; ?></td>
                    </tr>
                <?php } ?>                
            </tbody>
        </table>
    </div>
</main>
    
<?php include("partials/footer.php")?>
<script >
    $(document).ready(function() {
        $('#inventario_general').DataTable( {
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
            }
        } );
    } );
</script>