<!-- Modal -->
<div class="modal fade" id="Modal_update_usuario<?php echo $row['idusuario'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <form action="./control/update_usuario.php?idusuario=<?php echo $row['idusuario']; ?>" method="POST">
            <label>Usuario: </label>
            <div class="form-group">
                <input type="text" name="usuario" class="form-control" value="<?php echo $row['usuario'] ?>" readonly>
            </div>
            <label>Nombre: </label>
            <div class="form-group mb-4">
                <input type="text" name="nombre" class="form-control" value="<?php echo $row['nombres'].$row['apellidos'] ?>" readonly>
            </div>
            <div class="input-group mb-3">
              <select class="custom-select" id="rol<?php echo $row['idusuario'] ?>" name="rol_idrol" required>
                <option value="">Rol...</option>
                <?php 
                  $query_rol = "select idrol, rol from rol";
                  $result_rol = mysqli_query($conn, $query_rol);
                  while ($row_rol = mysqli_fetch_assoc($result_rol)) { ?>
                    <option value="<?php echo $row_rol['idrol'] ?>"><?php echo $row_rol['rol'] ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="input-group mb-3">
              <select class="custom-select" id="estado<?php echo $row['idusuario'] ?>" name="estado" required>
                <option value="">Estado...</option>
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
              </select>
            </div>
            <button class="btn btn-success btn-block mt-4" name="actualizar">Actualizar</button>
            </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>