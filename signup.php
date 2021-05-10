<?php
    require 'database.php';

    $message = '';

    if (!empty($_POST['usuario']) && !empty($_POST['clave'])){
        $sql = "insert into usuario (usuario, clave) values(:usuario, :clave)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':usuario', $_POST['usuario']);
        $clave = password_hash($_POST['clave'], PASSWORD_BCRYPT);
        $stmt->bindParam(':clave', $clave);

        if ($stmt->execute()) {
            $message = 'Usuario creado satisfactoriamente.';
        }else{
            $message = 'Ha ocurrido un error creando su cuenta.';
        }
    }
?>
<?php include("partials/header.php")?>

    <?php include("partials/navbar.php")?>
    <div class="container p-5">
        
        <div class="row">

            
            <div class="col-md-4 offset-md-4">
                
                <div class="card card-body text-center">
                    <h1>Registrarse</h1>
                    <span><a href="login.php">Iniciar Sesión</a></span>
                    <form action="signup.php" method="POST">
                        <div class="form-group">
                                <input type="email" name="usuario" class="form-control" placeholder="Correo electrónico" autofocus>
                        </div>
                        <div class="form-group">
                                <input type="password" name="clave" class="form-control" placeholder="Contraseña" autofocus>
                        </div>
                        <input type="submit" class="btn btn-primary btn-block" name="registrar" value="Registrarse">
                    </form>

                </div>
            </div>

        </div>

    </div>

<?php include("partials/footer.php")?>