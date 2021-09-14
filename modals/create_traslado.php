<!-- Modal -->
<div class="modal fade" id="Modal_traslado<?php echo $row['idasignacion']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?php 
        $idasignacion = $row['idasignacion'];
        $tarjeta_responsable = '';
        $localiacion = '';
    
        $no_clave_control = '';
        $descripcion = '';
        $nombres = '';
        $apellidos = '';
        $query = "select b.no_clave_control, a.tarjeta_responsable, e.nombres, e.apellidos, b.descripcion, a.localizacion from asignacion a 
        inner join articulo b on a.articulo_idarticulo = b.idarticulo inner join empleado e on a.empleado_idempleado = e.idempleado where idasignacion = $idasignacion";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1 ) {
            $row = mysqli_fetch_array($result);
            $no_clave_control = $row['no_clave_control'];
            $tarjeta_responsable = $row['tarjeta_responsable'];
            $nombres = $row['nombres'];
            $apellidos = $row['apellidos'];
            $descripcion = $row['descripcion'];
            $localizacion = $row['localizacion'];
        }
    ?>
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
                <div class="text-center">
                    <h5>Datos de la Asignación</h5>
                </div>
                <form action="./control/create_asignacion.php?idasignacion=<?php echo $idasignacion ?>" method="POST">
                    <div class="form-group">
                        <label>No. Clave de control: </label>
                        <input type="text" name="no_clave_control" class="form-control" value="<?php echo $no_clave_control ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Tarjeta de Responsable: </label>
                        <input type="text" name="tarjeta_responsable" class="form-control" value="<?php echo $tarjeta_responsable ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Responsable: </label>
                        <input type="text" name="responsable" class="form-control" value="<?php echo $nombres.$apellidos ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Localización: </label>
                        <input type="text" class="form-control" value="<?php echo $localizacion ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Descripción: </label>
                        <textarea name="descripcion" rows="3" class="form-control" readonly><?php echo $descripcion?></textarea>
                    </div>
                    <div class="text-center mt-4">
                    <h5>Datos del Traslado</h5>
                    </div>
                    <div class="form-group">
                        <label>Área de Empleado: </label>
                        <div class="input-group mb-3">
                            <select class="custom-select" id="areaemp_traslado<?php echo $idasignacion ?>" name="areaemp" required>
                                <option value="">Seleccionar...</option>
                                <?php
                                    $query_area = "select * from areaemp";
                                    $result_area = mysqli_query($conn, $query_area);

                                    while($row_area = mysqli_fetch_assoc($result_area)){ ?>
                                        <option value="<?php echo $row_area['idarea']?>"><?php echo $row_area['descripcion']?></option>

                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <label for="areaemp">Empleado: </label>
                    <div class="input-group mb-3">
                        <select class="custom-select" id="empleados_traslado<?php echo $idasignacion ?>" name="empleados" required>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Localización: </label>
                        <input type="text" name="localizacion" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Autorización: </label>
                        <input type="text" name="autorizacion" class="form-control" value="Dirección" required>
                    </div>
                    <div class="form-group">
                        <label>Sección: </label>
                        <input type="text" name="seccion" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Fecha de Traslado: </label>
                        <input type="date" name="fecha_asignacion" class="form-control"  required>
                    </div>
                    <button class="btn btn-success btn-block" name="create_traslado">Agregar</button>
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
        $("#areaemp_traslado<?php echo $idasignacion;?>").change(function () {
            console.log('hola');
            $("#areaemp_traslado<?php echo $idasignacion; ?> option:selected").each(function () {
                idarea = $(this).val();
                $.post("./utils/getEmpleado.php", {idarea : idarea}, function(data){
                    $("#empleados_traslado<?php echo $idasignacion; ?>").html(data);
                });
            });
        });
    });
</script>