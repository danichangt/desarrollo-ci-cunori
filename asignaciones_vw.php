<?php 

    include('database.php');

    $no_clave_control = '';
    $descripcion = '';
    $valor = '';
    $categoria = '';
    $tipo = '';
    $fecha_ingreso = '';


    if (isset($_GET['idarticulo'])) {
        $idarticulo = $_GET['idarticulo'];
        $query = "select a.no_clave_control, a.descripcion, a.valor, c.descripcion as categoria, 
        t.descripcion as tipo_bien_descripcion, a.fecha_ingreso from articulo a inner join tipo t 
        on a.tipo_idtipo = t.idtipo inner join categoria c on a.categoria_idcategoria = c.idcategoria where a.idarticulo = $idarticulo";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            $no_clave_control = $row['no_clave_control'];
            $descripcion = $row['descripcion'];
            $valor = $row['valor'];
            $categoria = $row['categoria'];
            $tipo = $row['tipo_bien_descripcion'];
            $fecha_ingreso = $row['fecha_ingreso'];
        }
    }


?>
<?php include("partials/header.php")?>
<?php include("partials/navbar.php")?>
<main class="contaier-fluid p-4">
    <div class="text-center mb-4">
        <h1>Asignar Bien</h1>
    </div>
    <div class="row">
        <div class="col-md-5 mx-auto">
            <div class="card card-body">
                <div class="text-center"><h4>Datos del artículo</h4></div>
                <form action="control/create_asignacion.php?idarticulo=<?php echo $_GET['idarticulo']?>" method="POST">
                    <label for="no_clave_control">No. Clave de Control: </label>
                    <div class="form-group">
                        <input type="text" name="no_clave_control" class="form-control" value="<?php echo $row['no_clave_control']?>" readonly>
                    </div>
                    <label for="descripcion">Descripción: </label>
                    <div class="form-group">
                    <textarea name="descripcion" rows="4" class="form-control"  readonly required><?php echo $row['descripcion']?></textarea>
                    </div>
                    <label for="valor">Valor: </label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Q</span>
                        <input type="number" name="valor" class="form-control" value="<?php echo $row['valor']?>" placeholder="Valor" min="0" step="0.01" readonly>
                    </div>
                    <label for="fecha_ingreso">Fecha de Ingreso: </label>
                    <div class="form-group">
                        <input type="date" name="fecha_ingreso" value="<?php echo $row['fecha_ingreso']?>" class="form-control" readonly>
                    </div>
                    <label for="categoria">Categoría: </label>
                    <div class="form-group">
                        <input type="text" name="categoria" class="form-control" value="<?php echo $row['categoria']?>" readonly>
                    </div>
                    <label for="tipo_bien">Tipo de Bien: </label>
                    <div class="form-group">
                        <input type="text" name="tipo_bien" class="form-control" value="<?php echo $row['tipo_bien_descripcion']?>" readonly>
                    </div>
                    <label for="tipo_bien">No. de Tarjeta de Responsable: </label>
                    <div class="form-group">
                        <input type="number" name="tarjeta_responsable" class="form-control" placeholder="No. Tarjeta de Responsable" min="0" step="1" required>
                    </div>
                    <label for="areaemp">Área de Empleado: </label>
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
                    <label for="areaemp">Empleado: </label>
                    <div class="input-group mb-3">
                        <select class="custom-select" id="empleados" name="empleados" required>
                        </select>
                    </div>
                    <label for="fecha_ingreso">Fecha de Asignación: </label>
                    <div class="form-group">
                        <input type="date" name="fecha_asignacion" class="form-control" required>
                    </div>
                    </br>
                    <button class="btn btn-success btn-block"  id="btnAgregar" name="create_asignacion">Asignar</button>
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