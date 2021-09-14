<!-- Modal -->
<div class="modal fade" id="Modal_update_rol<?php echo $row['idrol'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <form action="./control/update_rol.php?idrol=<?php echo $row['idrol']; ?>" method="POST">
            <label>Rol: </label>
            <div class="form-group">
                <input type="text" name="rol" class="form-control" value="<?php echo $row['rol'] ?>" required>
            </div>
            <label>Privilegios: </label>
            <div class="mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="crear" id="crear" value="1" <?php if($row['crear'] ==1 ){?> checked <?php } ?>>
                    <label class="form-check-label" for="crear">Crear</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="leer" id="leer" value="1" <?php if($row['leer'] ==1 ){?> checked <?php } ?>>
                    <label class="form-check-label" for="leer">Leer</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="editar" id="editar" value="1" <?php if($row['editar'] ==1 ){?> checked <?php } ?>>
                    <label class="form-check-label" for="editar">Editar</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="eliminar" id="eliminar" value="1" <?php if($row['eliminar'] ==1 ){?> checked <?php } ?>>
                    <label class="form-check-label" for="eliminar">Eliminar</label>
                </div>
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