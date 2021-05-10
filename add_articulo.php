<?php
    require 'database.php';
?>

<?php include("partials/header.php")?>

    <?php include("partials/navbar.php")?>

    <div class="container p-5">
            
            <div class="row">
            
                <div class="col-md-6 offset-md-3">
                    
                    <div class="card card-body text-center">
                        <h1>Registrar Bienes</h1>
                        <form action="add_articulo.php" method="POST">
                            <div class="form-group mt-3">
                                    <input type="text" name="no_clave_control" class="form-control" placeholder="No. de Clave de Control" autofocus> 
                            </div>
                            <div class="form-group">
                                <textarea name="descripcion" rows="4" class="form-control" placeholder="Descripción"></textarea>
                            </div>
                            <div class="input-group mb-3">
                                <select class="custom-select" id="inputGroupSelect01">
                                    <option selected>Categoría</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="form-group">
                                    <input type="text" name="tipo_bien" class="form-control" placeholder="Tipo de bien">                                  
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Q</span>
                                <input type="text" class="form-control" placeholder="Valor">
                            </div>
                            <div class="form-group">
                                <input type="date" name="fecha_ingreso" class="form-control">
                            </div>
                            
                            <input type="submit" class="btn btn-primary btn-block" name="agregar" value="Agregar">

                        </form>

                    </div>
                </div>

            </div>

    </div>
<?php include("partials/footer.php")?>