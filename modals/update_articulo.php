<!-- Modal -->
<div class="modal fade" id="Modal_articulo<?php echo $row['idarticulo']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card card-body">
        <form action="./control/update_articulo.php?idarticulo=<?php echo $row['idarticulo']?>" method="POST">
            <label for="no_clave_control">No. Clave de Control: </label>
            <div class="form-group">
                <input type="text" name="no_clave_control" class="form-control" value="<?php echo $row['no_clave_control']?>"  autofocus required>
            </div>
            <label for="descripcion">Descripción: </label>
            <div class="form-group">
            <textarea name="descripcion" rows="4" class="form-control" required><?php echo $row['descripcion']?></textarea>
            </div>
            <label for="valor">Valor: </label>
            <div class="input-group mb-3">
                <span class="input-group-text">Q</span>
                <input type="number" name="valor" class="form-control" value="<?php echo $row['valor']?>" min="0" step="0.01" required>
            </div>
            <label for="fecha_ingreso">Fecha de Ingreso: </label>
            <div class="form-group">
                <input type="date" name="fecha_ingreso" value="<?php echo $row['fecha_ingreso']?>" class="form-control" required>
            </div>
            <label for="categoria_idcategoria">Categoría: </label>
            <div class="input-group mb-1">
                    <select class="custom-select" id="categoria" name="categoria_idcategoria" required>
                      <?php

                        $query2 = "select * from categoria order by descripcion asc";
                        $result_categoria = mysqli_query($conn, $query2);

                        while($row = mysqli_fetch_assoc($result_categoria)){?>
                          <option value="<?php echo $row['idcategoria']?>"><?php echo $row['descripcion']?></option>
                        <?php } ?>
                    </select>
            </div>
            <label for="tipo_idtipo">No. Clave de Control: </label>
            <div class="input-group mb-1">
                    <select class="custom-select" id="tipo_bien" name="tipo_idtipo"required>
                      <?php

                        $query3 = "select * from tipo order by descripcion asc";
                        $result_tipo = mysqli_query($conn, $query3);

                        while($row = mysqli_fetch_assoc($result_tipo)){?>
                          <option value="<?php echo $row['idtipo']?>"><?php echo $row['descripcion']?></option>
                        <?php } ?>
                    </select>
            </div>
            <label for="activo">Activo: </label>
            <div class="input-group mb-3">
              <select class="custom-select" id="activo" name="activo" required>
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
              </select>
            </div>
            
            <button class="btn btn-success btn-block" name="actualizar">Actualizar</button>

        </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>