<!-- Modal -->
<div class="modal fade" id="Modal_update_traslado<?php echo $row['idasignacion']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
              <form action="./control/update_traslado.php?idasignacion=<?php echo $row['idasignacion'] ?>" method="POST">
                  <label>Autorización: </label>
                  <div class="form-group">
                      <input type="text" name="autorizacion" class="form-control" value="<?php echo $row['autorizacion'] ?>">
                  </div>
                  <label>Sección: </label>
                  <div class="form-group">
                      <textarea name="seccion" class="form-control" rows="2"><?php echo $row['seccion'] ?></textarea>
                  </div>
                  <label>Fecha de Traslado: </label>
                  <div class="form-group">
                      <input type="date" name="fecha_asignacion" class="form-control" value="<?php echo $row['fecha_asignacion'] ?>">
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