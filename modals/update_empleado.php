<!-- Modal -->
<div class="modal fade" id="Modal_empleado<?php echo $row['idempleado']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <form action="./control/update_empleado.php?idempleado=<?php echo $row['idempleado']; ?>" method="POST">
                    <label>DPI: </label>
                    <div class="form-group">
                        <input type="text" name="dpi" class="form-control" value="<?php echo $row['dpi'] ?>" required autofocus>
                    </div>
                    <label>Código: </label>
                    <div class="form-group">
                        <input type="text" name="codigo" class="form-control" value="<?php echo $row['codigo']  ?>" required>
                    </div>
                    <label>Nombres: </label>
                    <div class="form-group">
                        <input type="text" name="nombres" class="form-control" value="<?php echo $row['nombres'] ?>" required>
                    </div>
                    <label>Apellidos: </label>
                    <div class="form-group">
                        <input type="text" name="apellidos" class="form-control" value="<?php echo $row['apellidos'] ?>" required>
                    </div>
                    <label for="areaemp_idarea">Área:</label>
                    <div class="input-group">
                        <select class="custom-select" id="areaemp_idarea" name="areaemp_idarea">
                            <?php

                                $query = "select * from areaemp order by descripcion asc";
                                $result_area = mysqli_query($conn, $query);

                                while($row = mysqli_fetch_assoc($result_area)){?>
                                    <option value="<?php echo $row['idarea']?>"><?php echo $row['descripcion']?></option>
                            <?php } ?>
                        </select>
                    </div>
                                </br>
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