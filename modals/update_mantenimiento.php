<!-- Modal -->
<div class="modal fade" id="Modal_mantenimiento<?php echo $row['idmantenimiento']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <form action="./control/update_mantenimiento.php?idmantenimiento=<?php echo $row['idmantenimiento']?>" method="POST">
                    <label>Descripción: </label>
                    <div class="form-group">
                        <textarea name="descripcion" rows="4" class="form-control" required><?php echo $row['descripcion'] ?></textarea>
                    </div>
                    <label>No. Factura: </label>
                    <div class="form-group">
                        <input type="text" name="no_factura" class="form-control" value="<?php echo $row['no_factura'] ?>">
                    </div>
                    <label>Valor Neto: </label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Q</span>
                        <input type="number" name="valor_neto" class="form-control" value="<?php echo $row['valor_neto']?>" min="0" step="0.01" required>
                    </div>
                    <label>Fecha de Mantenimiento: </label>
                    <div class="form-group">
                        <input type="date" name="fecha_mantenimiento" class="form-control"  value="<?php echo $row['fecha_mantenimiento'] ?>" required>
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