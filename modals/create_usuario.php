<!-- Modal -->
<div class="modal fade" id="nuevo_usuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <form id="create_usr" action="./signup.php" method="POST">
                            <div class="form-group">
                                <input type="text" name="nombres" class="form-control" placeholder="Nombres" autofocus required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="apellidos" class="form-control" placeholder="Apellidos" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name="usuario" class="form-control" placeholder="Correo electrónico" required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="clave" class="form-control" placeholder="Contraseña"  value="ci_cunori"required>
                            </div>
                            <div class="input-group mb-3">
                            <select class="custom-select" id="rol_idrol" name="rol_idrol" required>
                                <option value="">Rol...</option>
                                <?php 
                                $query_rol = "select idrol, rol from rol";
                                $result_rol = mysqli_query($conn, $query_rol);
                                while ($row_rol = mysqli_fetch_assoc($result_rol)) { ?>
                                    <option value="<?php echo $row_rol['idrol'] ?>"><?php echo $row_rol['rol'] ?></option>
                                <?php } ?>
                            </select>
                            </div>
                            <button type="submit" id="btnAgregar" class="btn btn-primary btn-block">Agregar</button>
                        </form>
                        <script> 
                            $(document).ready(function() {
                                $('#btnAgregar').click(function() {
                                    $(this).prop("disabled", true);
                                    $(this).html(
                                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
                                    );
                                    $('#create_usr').submit();
                                });
                            });
                        </script>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
        </div>