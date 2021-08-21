<?php 
    include('database.php');
    $idasignacion = '';
    $tarjeta_responsable = '';
    $localiacion = '';

    $no_clave_control = '';
    $descripcion = '';
    $nombres = '';
    $apellidos = '';


    if (isset($_GET['idasignacion'])) {
        $idasignacion = $_GET['idasignacion'];
        $query = "select b.no_clave_control, a.tarjeta_responsable, e.nombres, e.apellidos, b.descripcion, a.localizacion from asignacion a 
        inner join articulo b on a.articulo_idarticulo = b.idarticulo inner join empleado e on a.empleado_idempleado = e.idempleado where idasignacion = $idasignacion";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1 ) {
            $row = mysqli_fetch_array($result);
            $no_clave_control = $row['no_clave_control'];
            $tarjeta_responsable = $row['tarjeta_responsable'];
            $nombres = $row['nombres'];
            $apellidos = $row['apellidos'];
            $descripcion = $row['descripcion'];
            $localizacion = $row['localizacion'];
        }
    }

?>

<?php include("partials/header.php")?>
<?php include("partials/navbar.php")?>
<main class="container-fluid p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <div class="text-center mb-4">
                    <h4>Datos de la Asignación</h4>
                </div>
                <form action="control/create_asignacion.php?idasignacion=<?php echo $_GET['idasignacion']?>"" method="POST">
                    <div class="form-group">
                        <label>No. Clave de control: </label>
                        <input type="text" name="no_clave_control" class="form-control" value="<?php echo $no_clave_control ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Tarjeta de Responsable: </label>
                        <input type="text" name="tarjeta_responsable" class="form-control" value="<?php echo $tarjeta_responsable ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Responsable: </label>
                        <input type="text" name="responsable" class="form-control" value="<?php echo $nombres.$apellidos ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Localización: </label>
                        <input type="text" class="form-control" value="<?php echo $localizacion ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Descripción: </label>
                        <textarea name="descripcion" rows="3" class="form-control" readonly><?php echo $descripcion?></textarea>
                    </div>
                    <div class="text-center mt-4">
                    <h4>Datos del Traslado</h4>
                    </div>
                    <div class="form-group">
                        <label>Área de Empleado: </label>
                        <div class="input-group mb-3">
                            <select class="custom-select" id="areaemp" name="areaemp" required>
                                <option value="">Seleccionar...</option>
                                <?php
                                    $query_area = "select * from areaemp";
                                    $result_area = mysqli_query($conn, $query_area);

                                    while($row_area = mysqli_fetch_assoc($result_area)){ ?>
                                        <option value="<?php echo $row_area['idarea']?>"><?php echo $row_area['descripcion']?></option>

                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <label for="areaemp">Empleado: </label>
                    <div class="input-group mb-3">
                        <select class="custom-select" id="empleados" name="empleados" required>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Localización: </label>
                        <input type="text" name="localizacion" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Autorización: </label>
                        <input type="text" name="autorizacion" class="form-control" value="Dirección" required>
                    </div>
                    <div class="form-group">
                        <label>Sección: </label>
                        <input type="text" name="seccion" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Fecha de Traslado: </label>
                        <input type="date" name="fecha_asignacion" class="form-control"  required>
                    </div>
                    <button class="btn btn-success btn-block"  id="btnAgregar" name="create_traslado">Agregar</button>
                </form>
            </div>
        </div>
    </div>
</main>
<?php include("partials/footer.php")?>

<script> 
    $(document).ready(function() {
        $("#areaemp").change(function () {
            $("#areaemp option:selected").each(function () {
                idarea = $(this).val();
                $.post("utils/getEmpleado.php", {idarea : idarea}, function(data){
                    $("#empleados").html(data);
                });
            });
        });
    });
</script>