<?php 
    include("../database.php"); 

    $idasignacion = '';
    $tarjeta_responsable = '';
    $fecha_asignacion = '';
    $articulo_idarticulo = '';
    $empleado_idempleado = '';
    $a_no_clave_control = '';
    $a_descripcion = '';
    $a_valor ='';
    $a_fecha_ingreso = '';
    $a_categoria = '';
    $a_tipo = '';
    $e_nombres = '';
    $e_apellidos = '';
    $ae_area = '';

    if (isset($_GET['idasignacion'])) {
        $idasignacion = $_GET['idasignacion'];
        $query = "select s.idasignacion, s.tarjeta_responsable, s.articulo_idarticulo, s.fecha_asignacion, a.no_clave_control, a.descripcion, a.valor, 
        a.fecha_ingreso, c.descripcion as categoria, t.descripcion as tipo, e.nombres, e.apellidos, ae.descripcion as area from asignacion s inner join 
        articulo a on s.articulo_idarticulo = a.idarticulo inner join empleado e on s.empleado_idempleado inner join categoria c on 
        a.categoria_idcategoria = c.idcategoria inner join tipo t on a.tipo_idtipo = t.idtipo inner join areaemp ae on 
        e.areaemp_idarea = ae.idarea where s.idasignacion = $idasignacion";

        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            $tarjeta_responsable = $row['tarjeta_responsable'];
            $fecha_asignacion = $row['fecha_asignacion'];
            $articulo_idarticulo = $row['articulo_idarticulo'];
            $a_no_clave_control = $row['no_clave_control'];
            $a_descripcion = $row['descripcion'];
            $a_valor = $row['valor'];
            $a_fecha_ingreso = $row['fecha_ingreso'];
            $a_categoria = $row['categoria'];
            $a_tipo = $row['tipo']; 
            $e_nombres = $row['nombres'];
            $e_apellidos = $row['apellidos'];
            $ae_area = $row['area'];
        }
    }

    if (isset($_POST['actualizar'])) {
        $idasignacion = $_GET['idasignacion'];
        $tarjeta_responsable = $_POST['tarjeta_responsable'];
        $fecha_asignacion = $_POST['fecha_asignacion'];
        $empleado_idempleado = $_POST['empleado_idempleado'];
        $articulo_idarticulo = $_POST['articulo_idarticulo'];

        $query = "update asignacion set tarjeta_responsable = $tarjeta_responsable, fecha_asignacion = '$fecha_asignacion', empleado_idempleado = $empleado_idempleado 
        where idasignacion = $idasignacion";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            die("fallo");
        }
        $_SESSION['message'] = '¡Asignación actualizada exitosamente!';
        $_SESSION['message_type'] = 'info';

        header('Location: ../asignaciones_tb.php');
    }


?>
<?php include('../partials/header.php')?>
<?php include('../partials/navbar.php')?>
<main class="contaier-fluid p-4">
    <div class="text-center mb-4">
        <h1>Actualizar Bien</h1>
    </div>
    <div class="row">
        <div class="col-md-5 mx-auto">
            <div class="card card-body">
                <div class="text-center"><h4>Datos del artículo</h4></div>
                <form action="update_asignacion.php?idasignacion=<?php echo $_GET['idasignacion']?>" method="POST">
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
                        <input type="text" name="tipo_bien" class="form-control" value="<?php echo $row['tipo']?>" readonly>
                    </div>
                    <div class="text-center"><h4>Datos del empleado</h4></div>
                    <label for="tipo_bien">No. de Tarjeta de Responsable: </label>
                    <div class="form-group">
                        <input type="number" name="tarjeta_responsable" class="form-control" value="<?php echo $row['tarjeta_responsable']?>" placeholder="No. Tarjeta de Responsable" min="0" step="1" required>
                    </div>
                    <label for="fecha_ingreso">Fecha de Asignación: </label>
                    <div class="form-group">
                        <input type="date" name="fecha_asignacion" value="<?php echo $row['fecha_asignacion']?>"class="form-control" required>
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
                        <select class="custom-select" id="empleado_idempleado" name="empleado_idempleado" required>
                        </select>
                    </div>
                    </br>
                    <button class="btn btn-success btn-block" name="actualizar">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</main>


<?php include('../partials/footer.php')?>
<script> 
    $(document).ready(function() {
        $("#areaemp").change(function () {
            $("#areaemp option:selected").each(function () {
                idarea = $(this).val();
                $.post("../utils/getEmpleado.php", {idarea : idarea}, function(data){
                    $("#empleado_idempleado").html(data);
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