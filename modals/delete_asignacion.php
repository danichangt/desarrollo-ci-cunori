<!-- Modal -->
<div class="modal fade" id="Modal_delete<?php echo $row['idasignacion']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar Registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card card-body">
            <p>
                ¿Desea desasignar el bien que ha selecionado?
            </p>
        </div>
        <p class="font-weight-light">Nota: Esta acción no se puede deshacer.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-danger" onclick="location.href='./control/delete_asignacion.php?idasignacion=<?php echo $row['idasignacion']?>'">Desasignar</button>
      </div>
    </div>
  </div>
</div>