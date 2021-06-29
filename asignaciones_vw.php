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
        <h1>Asignaciones</h1>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card card-body text-center">
                <h1>Datos del artículo</h1>
                <form action="#" method="POST">
                    <div class="form-group">
                        <input type="text" name="no_clave_control" class="form-control" value="<?php echo $row['no_clave_control']?>" readonly>
                    </div>
                    <div class="form-group">
                    <textarea name="descripcion" rows="4" class="form-control"  readonly required><?php echo $row['descripcion']?></textarea>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Q</span>
                        <input type="number" name="valor" class="form-control" value="<?php echo $row['valor']?>" placeholder="Valor" min="0" step="0.01" readonly>
                    </div>
                    <div class="form-group">
                        <input type="date" name="fecha_ingreso" value="<?php echo $row['fecha_ingreso']?>" class="form-control" readonly>
                    </div>
                    <div class="input-group mb-1">
                            <select class="custom-select" id="categoria" name="categoria_idcategoria">
                            <?php

                                $query2 = "select * from categoria order by descripcion asc";
                                $result_categoria = mysqli_query($conn, $query2);

                                while($row = mysqli_fetch_assoc($result_categoria)){?>
                                <option value="<?php echo $row['idcategoria']?>"><?php echo $row['descripcion']?></option>
                                <?php } ?>
                            </select>
                    </div>
                    <div class="input-group mb-1">
                            <select class="custom-select" id="tipo_bien" name="tipo_idtipo">
                            <?php

                                $query3 = "select * from tipo order by descripcion asc";
                                $result_tipo = mysqli_query($conn, $query3);

                                while($row = mysqli_fetch_assoc($result_tipo)){?>
                                <option value="<?php echo $row['idtipo']?>"><?php echo $row['descripcion']?></option>
                                <?php } ?>
                            </select>
                    </div>
                    
                    
                    <button class="btn btn-success btn-block" name="actualizar">Actualizar</button>

                </form>
            </div>
        </div>
    </div>
</main>


<?php include("partials/footer.php")?>