<?php
  
    require 'database.php';

    if(isset($_SESSION['rol'])){
        session_unset();

        session_destroy();
  
        header('Location: login.php');
    }

    if(isset($_POST['iniciar_sesion'])){
        $usuario = $_POST['usuario'];
        $sql = "select idusuario, usuario, clave, estado, crear, leer, editar, eliminar, rol_idrol from usuario inner join 
        rol on rol_idrol = idrol where usuario = '$usuario'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $rol = $row['rol_idrol'];
            $user = $row['idusuario'];
            $crear = $row['crear'];
            $leer = $row['leer'];
            $editar = $row['editar'];
            $eliminar = $row['eliminar'];
            $estado = $row['estado'];
            if (count($row) > 0 && password_verify($_POST['clave'], $row['clave'])) {
                if ($estado == 1) {
                    $_SESSION['rol'] = $rol;
                    $_SESSION['user'] = $user;
                    $_SESSION['crear'] = $crear;
                    $_SESSION['leer'] = $leer;
                    $_SESSION['editar'] = $editar;
                    $_SESSION['eliminar'] = $eliminar;
                    header('location: add_articulo.php');
                }else{
                    $_SESSION['message'] = 'El usuario debe ser activado por el administrador.';
                    $_SESSION['message_type'] = 'danger';
                }
            }else{
                $_SESSION['message'] = 'El usuario y/o contraseña no son válidos.';
                $_SESSION['message_type'] = 'danger';
            }
        }
        
    }

?>

<?php include("partials/header.php")?>
<body class="m-0 row vh-100 justify-content-center align-items-center">
<div class="container p-4">  
        <div class="row">   
            <div class="col-md-5 mx-auto">
                      <!-- MESSAGES -->
                        <?php if (isset($_SESSION['message'])) { ?>
                        <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
                            <?= $_SESSION['message']?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php unset($_SESSION['message']); } ?>
                        <!-- MESSAGES -->
                <div class="card card-body text-center">
                    <div class="mb-4">
                        <img src="images/cunori.png" alt="" width="200" height="210">
                    </div>
                    <h3>Iniciar Sesión</h3>
                    <form action="login.php" method="POST">
                        <div class="form-group">
                                <input type="email" name="usuario" class="form-control" placeholder="Correo electrónico" autofocus>
                        </div>
                        <div class="form-group">
                                <input type="password" name="clave" class="form-control" placeholder="Contraseña" autofocus>
                        </div>
                        <button type="submit" id="btnAgregar" class="btn btn-primary btn-block" name="iniciar_sesion">Iniciar Sesión</button>
                        <span><a href="recuperar_clave.php">¿Olvidaste tu contraseña?</a></span>
                    </form>
                </div>
            </div>
        </div>
</div>
<?php include("partials/footer.php")?>