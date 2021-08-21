<!-- Modal -->
<div class="modal fade" id="Modal_asignacion<?php echo $row['idarticulo']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card card-body">
                <form action="./control/create_asignacion.php?idarticulo=<?php echo $row['idarticulo']?>" method="POST">
                    <label for="no_clave_control">No. Clave de Control: </label>
                    <div class="form-group">
                        <input type="text" name="no_clave_control" class="form-control" value="<?php echo $row['no_clave_control']?>" readonly>
                    </div>
                    <label for="descripcion">Descripción: </label>
                    <div class="form-group">
                    <textarea name="descripcion" rows="4" class="form-control"  readonly required><?php echo $row['descripcion']?></textarea>
                    </div>
                    <label for="valor">Valor: </label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Q</span>
                        <input type="number" name="valor" class="form-control" value="<?php echo $row['valor']?>" min="0" step="0.01" readonly>
                    </div>
                    <label for="fecha_ingreso">Fecha de Ingreso: </label>
                    <div class="form-group">
                        <input type="date" name="fecha_ingreso" value="<?php echo $row['fecha_ingreso']?>" class="form-control" readonly>
                    </div>
                    <label for="categoria">Categoría: </label>
                    <div class="form-group">
                        <input type="text" name="categoria" class="form-control" value="<?php echo $row['categoria']?>" readonly>
                    </div>
                    <label for="tipo_bien">Tipo de Bien: </label>
                    <div class="form-group">
                        <input type="text" name="tipo_bien" class="form-control" value="<?php echo $row['tipo_bien_descripcion']?>" readonly>
                    </div>
                    <label for="tipo_bien">No. de Tarjeta de Responsable: </label>
                    <div class="form-group">
                        <input type="number" name="tarjeta_responsable" class="form-control" min="0" step="1" required>
                    </div>
                    <label for="localizacion">Localización: </label>
                    <div class="form-group">
                        <input type="text" name="localizacion" class="form-control" required>
                    </div>
                    <label>Área de Empleado: </label>
                    <div class="input-group mb-3">
                        <select class="custom-select" id="areaemp<?php echo $row['idarticulo']; ?>" name="areaemp" required>
                            <option value="">Seleccionar...</option>
                            <?php
                                $query_area = "select * from areaemp";
                                $result_area = mysqli_query($conn, $query_area);

                                while($row_area = mysqli_fetch_assoc($result_area)){ ?>
                                    <option value="<?php echo $row_area['idarea']?>"><?php echo $row_area['descripcion']?></option>

                            <?php } ?>
                        </select>
                    </div>
                    <label>Empleado: </label>
                    <div class="input-group mb-3">
                        <select class="custom-select" id="empleados<?php echo $row['idarticulo']; ?>" name="empleados" required>
                        </select>
                    </div>
                    <label for="fecha_ingreso">Fecha de Asignación: </label>
                    <div class="form-group">
                        <input type="date" name="fecha_asignacion" class="form-control" required>
                    </div>
                    </br>
                    <button class="btn btn-success btn-block"  id="btnAgregar" name="create_asignacion">Asignar</button>
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
        $("#areaemp<?php echo $row['idarticulo']; ?>").change(function () {
            $("#areaemp<?php echo $row['idarticulo']; ?> option:selected").each(function () {
                idarea = $(this).val();
                $.post("./utils/getEmpleado.php", {idarea : idarea}, function(data){
                    $("#empleados<?php echo $row['idarticulo']; ?>").html(data);
                });
            });
        });
    });
</script>

