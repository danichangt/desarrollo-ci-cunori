<?php
    require 'database.php';
?>

<?php include("partials/header.php")?>

<?php include("partials/navbar.php")?>

<main class="container-fluid p-4">
  <div class="text-center mb-4">
    <h1>Inventario Anual</h1>
  </div>
  <div class="row">
    <div class="col-md-10 mx-auto mb-3">

      <div class="mb-2">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#articulos">
          <i class="fas fa-plus"></i> Agregar
        </button>
      </div>

      <div class="modal fade" id="articulos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Nuevo Registro</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <div class="card card-body">
              <form action="control/create_articulo.php" method="POST">
                  <div class="form-group">
                      <input type="text" name="no_clave_control" class="form-control" placeholder="No. de Clave de Control" autofocus required>
                  </div>
                  <div class="form-group">
                  <textarea name="descripcion" rows="4" class="form-control" placeholder="Descripción" required></textarea>
                  </div>
                  <label for="areaemp_idarea">Categoría:</label>
                  <div class="input-group mb-1">
                          <select class="custom-select" id="categoria" name="categoria" required>
                            <?php

                              $query = "select * from categoria order by descripcion asc";
                              $result_categoria = mysqli_query($conn, $query);

                              while($row = mysqli_fetch_assoc($result_categoria)){?>
                                <option value="<?php echo $row['idcategoria']?>"><?php echo $row['descripcion']?></option>
                              <?php } ?>
                          </select>
                  </div>
                  <div class="text-center"><span><a href="categoria_vw.php">Nueva categoría</a></span></div>
                  <label for="tipo_bien">Tipo de Bien:</label>
                  <div class="input-group mb-1">
                          <select class="custom-select" id="tipo_bien" name="tipo_bien" required>
                            <?php

                              $query = "select * from tipo order by descripcion asc";
                              $result_tipo = mysqli_query($conn, $query);

                              while($row = mysqli_fetch_assoc($result_tipo)){?>
                                <option value="<?php echo $row['idtipo']?>"><?php echo $row['descripcion']?></option>
                              <?php } ?>
                          </select>
                  </div>
                  <div class="text-center"><span><a href="tipo_bien_vw.php">Nuevo tipo de bien</a></span></div>
                  <div class="input-group mb-3 mt-4">
                      <span class="input-group-text">Q</span>
                      <input type="number" name="valor" class="form-control" placeholder="Valor" min="0" step="0.01" required>
                  </div>
                  <label>Fecha de ingreso:</label>
                  <div class="form-group">
                      <input type="date" name="fecha_ingreso" class="form-control" required>
                  </div>
                  <button type="submit" id="btnAgregar" class="btn btn-primary btn-block" name="create_articulo">Agregar</button>
              </form>
            </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>

      <!-- MESSAGES -->
      <?php if (isset($_SESSION['message'])) { ?>
      <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['message']?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php session_unset(); } ?>
      <!-- MESSAGES -->

      <table class="table table-responsive-lg table-bordered text-center" id="inventario_anual">
        <thead>
          <tr>
            <th>No. de Clave de Control</th>
            <th>Descripción</th>
            <th>Valor Q</th>
            <th>Categoría</th>
            <th>Tipo de Bien</th>
            <th>Fecha de Ingreso</th>
            <th>Activo</th>
            <th>Disponible</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
        
          <?php

            $query = "select a.idarticulo, a.no_clave_control, a.descripcion, a.valor, c.descripcion as categoria, 
            t.descripcion as tipo_bien_descripcion, a.fecha_ingreso, a.activo, a.disponible from articulo a inner join tipo t 
            on a.tipo_idtipo = t.idtipo inner join categoria c on a.categoria_idcategoria = c.idcategoria;";
            $result_articulo = mysqli_query($conn, $query);

            while($row = mysqli_fetch_assoc($result_articulo)){?>

              <tr>

                <td><?php echo $row['no_clave_control']; ?></td>
                <td><?php echo $row['descripcion']; ?></td>
                <td>Q<?php echo $row['valor']; ?></td>
                <td><?php echo $row['categoria']; ?></td>
                <td><?php echo $row['tipo_bien_descripcion']; ?></td>
                <td><?php echo $row['fecha_ingreso']; ?></td>
                <?php

                  if ($row['activo'] == 1) { ?>
                    <td><i class="fas fa-check fa-2x" style = "color: green"></i></td>
                <?php }else{ ?>
                    <td><i class="fas fa-times fa-2x" style = "color: red"></i></td>
                <?php } ?>
                <?php 

                  if ($row['disponible'] != 1 || $row['activo'] != 1) { ?>
                    <td><i class="fas fa-times fa-2x" style = "color: red"></i></td>
                <?php }else{ ?>
                    <td><i class="fas fa-check fa-2x" style = "color: green"></i></td>
                <?php } ?>
                <td>
                  <?php 
                    if ($row['disponible'] != 1 || $row['activo'] != 1) { ?>
                      <a href="asignaciones_vw.php?idarticulo=<?php echo $row['idarticulo']?>" class="btn btn-success disabled"><i class="fas fa-user-plus"></i> Asignar</a>
                  <?php }else{ ?>
                     <a href="asignaciones_vw.php?idarticulo=<?php echo $row['idarticulo']?>" class="btn btn-success"><i class="fas fa-user-plus"></i> Asignar</a>
                  <?php } ?>
                  <a href="control/update_articulo.php?idarticulo=<?php echo $row['idarticulo']?>" class="btn btn-secondary"><i class="fas fa-edit"></i> Editar</a>
                </td>
              </tr>

            <?php } ?>                
          
        </tbody>
        
      </table>
    </div>
  </div>
</main>

<?php include("partials/footer.php")?>

<script >
    $(document).ready(function() {
        $('#inventario_anual').DataTable( {
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
            }
        } );
    } );
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