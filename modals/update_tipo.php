<!-- Modal -->
<div class="modal fade" id="Modal_tipo<?php echo $row['idtipo']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card card-body text-center">
            <form action="./control/update_tipo.php?idtipo=<?php echo $row['idtipo']; ?>" method="POST">
            <div class="form-group">
                <textarea name="descripcion" class="form-control" cols="30" rows="10" required><?php echo $row['descripcion'] ?></textarea>
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