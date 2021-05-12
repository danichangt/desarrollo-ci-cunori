<?php
    require 'database.php';
?>

<?php include("partials/header.php")?>

<?php include("partials/navbar.php")?>

<main class="container-fluid p-4">
  <div class="row">
    <div class="col-md-4 mx-auto mb-3">
      

      <div class="card card-body text-center">
      <h1>Registrar Bienes</h1>
        <form action="controls/create_articulo.php" method="POST">
            <div class="form-group">
                <input type="text" name="no_clave_control" class="form-control" placeholder="No. de Clave de Control" autofocus>
            </div>
            <div class="form-group">
            <textarea name="descripcion" rows="4" class="form-control" placeholder="Descripción"></textarea>
            </div>
            <div class="input-group mb-3">
                    <select class="custom-select" id="categoria" name="categoria">
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
                <input type="number" name="valor" class="form-control" placeholder="Valor" min="0">
            </div>
            <div class="form-group">
                <input type="date" name="fecha_ingreso" class="form-control">
            </div>
            <input type="submit" class="btn btn-primary btn-block" name="create_articulo" value="Agregar">

        </form>
      </div>
    </div>

    <div class="col-md-10 mx-auto mb-3">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>No. de Clave de Control</th>
            <th>Descripción</th>
            <th>Valor</th>
            <th>Tipo de Bien</th>
            <th>Fecha de Ingreso</th>
            <th>Activo</th>
            <th>Disponible</th>
          </tr>
        </thead>
        
      </table>
    </div>
  </div>
</main>

<?php include("partials/footer.php")?>