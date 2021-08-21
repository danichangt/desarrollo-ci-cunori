<!-- Modal -->
<div class="modal fade" id="Modal_update_asignacion<?php echo $row['idasignacion']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <form action="./control/update_asignacion.php?idasignacion=<?php echo $row['idasignacion']?>" method="POST">
                <label for="tipo_bien">No. de Tarjeta de Responsable: </label>
                    <div class="form-group">
                        <input type="number" name="tarjeta_responsable" class="form-control" value="<?php echo $row['tarjeta_responsable'] ?>" min="0" step="1" required>
                    </div>
                    <label for="fecha_ingreso">Fecha de Asignación: </label>
                    <div class="form-group">
                        <input type="date" name="fecha_asignacion" value="<?php echo $row['fecha_asignacion'] ?>"class="form-control" required>
                    </div>
                    <label for="areaemp">Área de Empleado: </label>
                    <div class="input-group mb-3">
                        <select class="custom-select" id="areaemp<?php echo $row['idasignacion']; ?>" name="areaemp" required>
                            <option value="">Seleccionar...</option>
                            <?php
                                $query_area = "select * from areaemp";
                                $result_area = mysqli_query($conn, $query_area);

                                while($row_area = mysqli_fetch_assoc($result_area)){ ?>
                                    <option value="<?php echo $row_area['idarea']?>"><?php echo $row_area['descripcion']?></option>

                            <?php } ?>
                        </select>
                    </div>
                    <label for="areaemp">Empleado: </label>
                    <div class="input-group mb-3">
                        <select class="custom-select" id="empleados<?php echo $row['idasignacion']; ?>" name="empleado_idempleado" required>
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
<script> 
    $(document).ready(function() {
        $("#areaemp<?php echo $row['idasignacion']; ?>").change(function () {
            $("#areaemp<?php echo $row['idasignacion']; ?> option:selected").each(function () {
                idarea = $(this).val();
                $.post("./utils/getEmpleado.php", {idarea : idarea}, function(data){
                    $("#empleados<?php echo $row['idasignacion']; ?>").html(data);
                });
            });
        });
    });
</script>