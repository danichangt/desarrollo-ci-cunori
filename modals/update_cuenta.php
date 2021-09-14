<!-- Modal Datos -->
<div class="modal fade" id="Modal_update_datos<?php echo $row['idusuario'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <form action="./control/update_cuenta.php?idusuario=<?php echo $row['idusuario']; ?>" method="POST">
                <label>Usuario: </label>
                <div class="form-group">
                    <input type="email" name="usuario" class="form-control" value="<?php echo $row['usuario'] ?>" required>
                </div>
                <label>Nombres: </label>
                <div class="form-group">
                    <input type="text" name="nombres" class="form-control" value="<?php echo $row['nombres'] ?>" required>
                </div>
                <label>Apellidos: </label>
                <div class="form-group">
                    <input type="text" name="apellidos" class="form-control" value="<?php echo $row['apellidos'] ?>" required>
                </div>
                <button class="btn btn-success btn-block" name="actualizar_datos">Actualizar</button>
            </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Clave -->
<div class="modal fade" id="Modal_update_clave<?php echo $row['idusuario'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <form action="./control/update_cuenta.php?idusuario=<?php echo $row['idusuario']; ?>" method="POST">
                <label>Contraseña anterior: </label>
                <div class="form-group">
                    <input type="password" name="clave_anterior" class="form-control" required>
                </div>
                <label>Contraseña nueva: </label>
                <div class="form-group">
                    <input type="password" name="clave" class="form-control" required>
                </div>
                <button class="btn btn-success btn-block" name="actualizar_clave">Actualizar</button>
            </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>