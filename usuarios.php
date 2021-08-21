<?php 
    require 'database.php';
    if(!isset($_SESSION['rol'])){
        header('location: login.php');
      }else{
          if($_SESSION['rol'] != 2){
              header('location: login.php');
          }
      }
?>
<?php include("partials/header.php")?>
<?php include("partials/navbar.php")?>
<body>
    <main class="container-fluid p-4">
        <div class="text-center mb-4">
            <h1>Administración de Usuarios</h1>
        </div>
        <div class="row">
            <div class="col-md-10 mx-auto">
                <table class="table table-responsive-lg table-bordered text-center" id="tabla_usuarios">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Nombre Completo</th>
                            <th>Privilegios</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $query = "select u.usuario, u.nombres, u.apellidos, r.rol, p.crear, p.leer, p.actualizar, p.eliminar from usuario u 
                            inner join rol r on u.rol_idrol = r.idrol inner join privilegio p on p.rol_id = r.idrol";
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
<?php include("partials/footer.php")?>