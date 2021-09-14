<!-- Modal -->
<div class="modal fade" id="Modal_categoria<?php echo $row['idcategoria']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <form action="./control/update_categoria.php?idcategoria=<?php echo $row['idcategoria']; ?>" method="POST">
                    <label>No. Código de Control: </label>
                    <div class="form-group">
                    <input name="codigo_control" type="text" class="form-control" value="<?php echo $row['codigo_control'] ?>" placeholder="Actualizar Código de Control" required>
                    </div>
                    <label>Descripción: </label>
                    <div class="form-group">
                    <textarea name="descripcion" class="form-control"  rows="5" required><?php echo $row['descripcion'] ?></textarea>
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