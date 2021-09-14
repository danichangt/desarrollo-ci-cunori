<nav class="navbar navbar-dark navbar-expand-lg" style="background-color: #253b80">
  <img src="http://cunori.edu.gt/wp-content/uploads/2020/06/logotipoCUNORI-2.png" alt="" width="55" height="51">
  <a class="navbar-brand" href="/controlinventarios_cunori/add_articulo.php">Control Inventarios - CUNORI</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="/controlinventarios_cunori/add_articulo.php">Inventario Anual</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/controlinventarios_cunori/inventario_general.php">Inventario General</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/controlinventarios_cunori/empleado_vw.php">Empleados</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/controlinventarios_cunori/mantenimientos_vw.php">Mantenimientos</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Asignaciones
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/controlinventarios_cunori/asignaciones_tb.php">Asignaciones</a>
          <a class="dropdown-item" href="/controlinventarios_cunori/traslados_tb.php">Traslados</a>
        </div>
      </li>
    </ul>
    <div class="dropdown mr-2">
      <button class="btn btn-secondary dropdown-toggle" style="background-color: #253b80" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-user"></i> Usuario
      </button>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="/controlinventarios_cunori/cuenta_usuario.php"><i class="fas fa-user" style="color: green"></i> Cuenta</a>
        <?php 
          if($_SESSION['rol'] == 1){ ?>
          <a class="dropdown-item" href="/controlinventarios_cunori/usuarios.php"><i class="fas fa-users" style = "color: blue"></i> Usuarios</a>
          <a class="dropdown-item" href="/controlinventarios_cunori/roles.php"><i class="fas fa-user-tag"></i></i> Roles</a>
        <?php } ?>
        <a class="dropdown-item" href="/controlinventarios_cunori/logout.php"><i class="fas fa-power-off" style = "color: red"></i> Salir</a>
      </div>
      </div>
  </div>
</nav>
